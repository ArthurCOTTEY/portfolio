<?php

namespace App\Support;

/**
 * Mesure d'audience avec Matomo, sans cookie : exemptée de consentement
 * selon les recommandations de la CNIL (pas de bandeau nécessaire).
 * Active seulement si MATOMO_URL (https) et MATOMO_SITE_ID sont renseignés.
 */
class Analytics
{
    public static function enabled(): bool
    {
        return self::trackerUrl() !== null && self::siteId() !== null;
    }

    /**
     * Adresse de Matomo terminée par « / », ou null si elle est absente ou invalide
     * (https uniquement, sans identifiants, paramètres ni fragment).
     */
    public static function trackerUrl(): ?string
    {
        $url = trim((string) config('site.analytics.matomo_url'));
        $parts = parse_url($url);

        if ($url === '' || ! is_array($parts)
            || ($parts['scheme'] ?? '') !== 'https'
            || blank($parts['host'] ?? null)
            || isset($parts['user']) || isset($parts['pass']) || isset($parts['query']) || isset($parts['fragment'])) {
            return null;
        }

        return rtrim($url, '/').'/';
    }

    public static function siteId(): ?int
    {
        $id = filter_var(config('site.analytics.matomo_site_id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        return $id === false ? null : $id;
    }
}
