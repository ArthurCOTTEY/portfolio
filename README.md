# arthurcottey.fr

Portfolio d’Arthur Cottey, développeur web full stack PHP & Laravel à Tours.

**Stack :** Laravel 13 · Tailwind CSS 4 · Vite · Pest

## Installation locale

```bash
composer install
npm install
cp .env.example .env && php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm run build                # ou npm run dev
php artisan serve
```

Tout le contenu (services, compétences, projets, parcours, FAQ) est versionné dans
`config/content.php` ; les études de cas sont en Markdown dans `resources/content/projects/`.

## Organisation

| Élément | Emplacement |
| --- | --- |
| Identité, contact, analytics, hébergeur | `config/site.php` (+ variables `.env`) |
| Services, parcours, FAQ (page + JSON-LD + llms.txt) | `config/content.php` |
| Pages | `resources/views/pages` |
| Mesure d’audience (Matomo) | `app/Support/Analytics.php`, `resources/js/modules/analytics.js` |
| Compétences et projets | `config/content.php` (icônes : `public/images/skills`, logos Simple Icons CC0) |
| Visuels des projets | `public/media/projects` |
| Sitemap et llms.txt (générés) | `app/Http/Controllers/SeoController.php` |

## Mesure d’audience et RGPD

- Matomo **sans cookie** (`MATOMO_URL`, `MATOMO_SITE_ID`) : exempté de consentement par la CNIL,
  donc aucun bandeau cookies. Inactif tant que les deux variables ne sont pas renseignées.
- Réglages Matomo requis pour l’exemption : anonymisation de l’IP (2 octets minimum) et
  suppression des données brutes après 13 mois.
- Seuls des cookies strictement nécessaires (session, CSRF) ; polices auto-hébergées.

## Mise en production

Hébergement O2Switch : procédure complète (cPanel, `.env`, premier déploiement) dans
[`docs/DEPLOIEMENT.md`](docs/DEPLOIEMENT.md). Mises à jour : `bash scripts/deploy.sh`.

## Tests

```bash
php artisan test
```
