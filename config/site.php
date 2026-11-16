<?php

/*
|--------------------------------------------------------------------------
| Identité du site
|--------------------------------------------------------------------------
|
| Informations centralisées réutilisées par les vues, le SEO (JSON-LD,
| llms.txt), l'e-mail de contact et les pages légales.
|
*/

return [

    'name' => 'Arthur Cottey',

    'url' => env('APP_URL', 'https://www.arthurcottey.fr'),

    'job_title' => 'Développeur web full stack',

    'tagline' => 'Développeur web full stack PHP & Laravel à Tours',

    'description' => 'Arthur Cottey, développeur web full stack basé à Tours, spécialisé en PHP et Laravel. Applications web sur mesure, CRM, sites vitrines et e-commerce : un code propre, maintenable et pensé pour les utilisateurs.',

    'email' => env('CONTACT_EMAIL', 'arthur.cottey1@gmail.com'),

    'linkedin' => 'https://www.linkedin.com/in/arthur-cottey-456a4236b/',

    'location' => [
        'city' => 'Tours',
        'region' => 'Centre-Val de Loire',
        'country' => 'FR',
    ],

    /*
    | Adresses autorisées à se connecter au panneau Filament (/admin).
    | Séparées par des virgules dans ADMIN_EMAILS.
    */
    'admin_emails' => array_filter(array_map(
        'trim',
        explode(',', (string) env('ADMIN_EMAILS', env('CONTACT_EMAIL', 'arthur.cottey1@gmail.com')))
    )),

    'analytics' => [
        // Google Analytics 4 : chargé uniquement après consentement explicite.
        'enabled' => (bool) env('ANALYTICS_ENABLED', env('APP_ENV') === 'production'),
        'ga_id' => env('GOOGLE_ANALYTICS_ID', 'G-BNVSMRP3FP'),
        'google_site_verification' => env('GOOGLE_SITE_VERIFICATION', 'T71uwKDUytypzMZWDxUibdPyno_hehEfqqXAdQF064I'),
    ],

    'consent' => [
        // Incrémenter pour redemander le consentement après un changement de politique.
        'version' => 1,
        // Durée de conservation du choix (recommandation CNIL : 6 mois).
        'lifetime_days' => 180,
        'cookie' => 'cookie_consent',
    ],

    /*
    | Mentions légales (art. 6-III de la LCEN) : l'hébergeur doit être identifié.
    */
    'host' => [
        'name' => env('LEGAL_HOST_NAME'),
        'address' => env('LEGAL_HOST_ADDRESS'),
        'phone' => env('LEGAL_HOST_PHONE'),
        'url' => env('LEGAL_HOST_URL'),
    ],

    // Date affichée sur les pages légales.
    'legal_updated_at' => '2026-11-16',

];
