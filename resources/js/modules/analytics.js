/**
 * Mesure d'audience Matomo sans cookie (aucun consentement requis, cf. CNIL).
 * Configuration lue dans les balises <meta name="matomo-…"> du layout.
 */
export function initAnalytics() {
    const url = document.querySelector('meta[name="matomo-url"]')?.content;
    const siteId = document.querySelector('meta[name="matomo-site-id"]')?.content;

    if (!url || !siteId) return;

    const paq = (window._paq = window._paq || []);
    paq.push(['disableCookies']);
    paq.push(['trackPageView']);
    paq.push(['enableLinkTracking']);
    paq.push(['setTrackerUrl', `${url}matomo.php`]);
    paq.push(['setSiteId', siteId]);

    const script = document.createElement('script');
    script.async = true;
    script.src = `${url}matomo.js`;
    document.head.appendChild(script);
}
