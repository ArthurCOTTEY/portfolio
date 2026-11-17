# Déploiement sur O2Switch

Dans les exemples, `cpaneluser` est l’identifiant cPanel du compte d’arthurcottey.fr (à remplacer).
Le code est installé dans `~/portfolio`, hors de `public_html`, et le domaine pointe sur
`~/portfolio/public`. Les assets compilés (`public/build`) sont versionnés : **pas besoin de
Node.js sur le serveur**.

## 1. Préparer l’hébergement dans cPanel (une seule fois)

1. **Autorisation SSH** : autoriser l’adresse IP de votre ordinateur.
2. **Sélectionner une version de PHP** : **PHP 8.4** (exigé par `composer.lock`), extensions
   `pdo_mysql`, `mbstring`, `intl`, `fileinfo`, `gd` cochées.
3. **Bases de données MySQL** : créer une base (ex. `cpaneluser_portfolio`), un utilisateur avec
   un mot de passe fort, et lui donner **tous les privilèges** sur la base.
4. **Comptes de messagerie** : créer `contact@arthurcottey.fr` (adresse d’envoi du formulaire).
5. **Lets Encrypt™ SSL** (ou _AutoSSL_) : générer le certificat pour `arthurcottey.fr` **et**
   `www.arthurcottey.fr`. Le site redirige tout vers `https://www.arthurcottey.fr` : sans
   certificat valide, il est inaccessible.

## 2. Alias SSH sur votre ordinateur (une seule fois)

Dans `~/.ssh/config` :

```
Host arthurcottey
    HostName arthurcottey.fr
    User cpaneluser
```

Vérifier : `ssh arthurcottey "php -v"` doit afficher PHP 8.4. Si ce n’est pas le cas, utiliser
`/opt/alt/php84/usr/bin/php` à la place de `php` dans les commandes ci-dessous.

## 3. Premier déploiement (SSH)

```bash
ssh arthurcottey
cd ~
git clone https://github.com/ArthurCOTTEY/portfolio.git
cd portfolio
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
nano .env
```

Dans le `.env` :

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www.arthurcottey.fr

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpaneluser_portfolio
DB_USERNAME=cpaneluser_portfolio
DB_PASSWORD=…

MAIL_MAILER=smtp
MAIL_HOST=arthurcottey.fr        # ou le serveur indiqué dans cPanel → Comptes de messagerie
MAIL_PORT=465
MAIL_SCHEME=smtps
MAIL_USERNAME=contact@arthurcottey.fr
MAIL_PASSWORD=…
MAIL_FROM_ADDRESS=contact@arthurcottey.fr
MAIL_FROM_NAME="Arthur Cottey"

ADMIN_EMAILS=arthur.cottey1@gmail.com
MATOMO_URL=https://stats.cekale.fr
MATOMO_SITE_ID=…                 # ID du site créé dans Matomo
```

Puis :

```bash
php artisan migrate --force          # tables + projet Cekale
php artisan filament:optimize
php artisan optimize
php artisan make:filament-user       # compte de l’admin (même e-mail que ADMIN_EMAILS)
```

**Images de la page d’accueil** : envoyer `image_hero.webp` (638 × 456) et `image_about.webp`
(317 × 596) dans `~/portfolio/public/storage/`, par exemple depuis votre ordinateur :

```bash
scp image_hero.webp image_about.webp arthurcottey:~/portfolio/public/storage/
```

> Ne pas lancer `php artisan storage:link` : `public/storage` est un vrai dossier du dépôt.
> Les icônes des compétences s’envoient depuis l’admin.

## 4. Brancher le domaine (cPanel)

_Domaines_ → `arthurcottey.fr` → **racine du document** : `/home/cpaneluser/portfolio/public`.

Vérifier ensuite :

- `https://www.arthurcottey.fr` s’affiche, `http://arthurcottey.fr` y redirige ;
- `/admin` : connexion avec le compte créé ;
- le formulaire de contact envoie bien un e-mail ;
- `/sitemap.xml` et `/llms.txt` répondent.

Enfin, déclarer le site et `https://www.arthurcottey.fr/sitemap.xml` dans Google Search Console
et Bing Webmaster Tools.

## 5. Mises à jour

Depuis votre ordinateur, dans le dossier du projet, une fois les changements fusionnés dans `main` :

```bash
bash scripts/deploy.sh              # met en maintenance, met à jour, migre, remet en ligne
bash scripts/deploy.sh --revision   # version actuellement en ligne
```

En cas d’échec, le site reste en maintenance (page 503) : corriger, relancer, ou
`ssh arthurcottey "cd ~/portfolio && php artisan up"`.
