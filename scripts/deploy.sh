#!/usr/bin/env bash
#
# Déploie la branche main de GitHub sur O2Switch, par SSH.
#
#   bash scripts/deploy.sh              # déploie les nouveaux commits de main
#   bash scripts/deploy.sh --force      # relance même sans nouveau commit
#   bash scripts/deploy.sh --revision   # affiche la version déployée (lecture seule)
#
# Prérequis (docs/DEPLOIEMENT.md) : alias SSH (DEPLOY_HOST, par défaut « arthurcottey »)
# et projet cloné sur le serveur avec son .env, dans ~/DEPLOY_PATH (par défaut « portfolio »).
# Les assets compilés (public/build) sont versionnés : pas de Node.js sur le serveur.

set -euo pipefail

HOST="${DEPLOY_HOST:-arthurcottey}"
APP_PATH="${DEPLOY_PATH:-portfolio}"
BRANCH="${DEPLOY_BRANCH:-main}"
REVISION_FILE="storage/app/deploy-revision"

FORCE=0
REVISION_ONLY=0

for arg in "$@"; do
    case "$arg" in
        --force) FORCE=1 ;;
        --revision) REVISION_ONLY=1 ;;
        -h | --help)
            sed -n '3,11p' "$0" | sed 's/^# \{0,1\}//'
            exit 0
            ;;
        *)
            echo "Option inconnue : $arg" >&2
            exit 2
            ;;
    esac
done

ssh_run() {
    ssh -o BatchMode=yes "$HOST" "$@"
}

if [ "$REVISION_ONLY" = "1" ]; then
    ssh_run "cat ~/$APP_PATH/$REVISION_FILE 2>/dev/null || echo 'Aucune version enregistrée.'"
    exit 0
fi

echo "→ Déploiement de $BRANCH sur $HOST:~/$APP_PATH"

ssh_run bash -s -- "$APP_PATH" "$BRANCH" "$FORCE" "$REVISION_FILE" <<'REMOTE'
set -euo pipefail

cd ~/"$1"
BRANCH="$2"
FORCE="$3"
REVISION_FILE="$4"

git fetch --quiet origin "$BRANCH"

if [ "$(git branch --show-current)" != "$BRANCH" ]; then
    echo "✗ Le serveur n'est pas sur la branche $BRANCH ($(git branch --show-current))." >&2
    exit 1
fi

CURRENT=$(git rev-parse --short HEAD)
TARGET=$(git rev-parse --short "origin/$BRANCH")

if [ "$CURRENT" = "$TARGET" ] && [ "$FORCE" != "1" ]; then
    echo "✓ Déjà à jour ($CURRENT). Rien à déployer (--force pour relancer)."
    exit 0
fi

echo "→ $CURRENT → $TARGET"
git log --oneline --no-decorate "HEAD..origin/$BRANCH" | sed 's/^/    /'

# Fichiers modifiés à la main sur le serveur et aussi par les nouveaux commits : la fusion
# échouerait, on s'arrête avant de mettre le site en maintenance.
LOCAL_CHANGES=$(git diff HEAD --name-only)
CONFLICTS=""
if [ -n "$LOCAL_CHANGES" ]; then
    CONFLICTS=$(git diff --name-only HEAD "origin/$BRANCH" | grep -Fx -e "$LOCAL_CHANGES" || true)
fi
if [ -n "$CONFLICTS" ]; then
    echo "✗ Modifiés sur le serveur et dans les nouveaux commits (site non touché) :" >&2
    echo "$CONFLICTS" | sed 's/^/    /' >&2
    exit 1
fi

php artisan down --retry=60 --refresh=15

# En cas d'échec, le site reste en maintenance : mieux vaut une page 503 qu'un site cassé.
trap 'echo "✗ Échec : le site est resté en maintenance. Corriger puis relancer, ou « php artisan up »." >&2' ERR

git merge --ff-only --quiet "origin/$BRANCH"
composer install --no-dev --optimize-autoloader --no-interaction --no-progress --quiet
php artisan optimize:clear
php artisan migrate --force
php artisan filament:optimize
php artisan optimize

{
    echo "branch=$BRANCH"
    echo "commit=$(git rev-parse HEAD)"
    echo "date=$(date -u +%Y-%m-%dT%H:%M:%SZ)"
} >"$REVISION_FILE"

php artisan up
echo "✓ Déployé : $(git log -1 --format='%h %s')"
REMOTE
