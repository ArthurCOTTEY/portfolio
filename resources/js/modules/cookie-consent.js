/**
 * Gestion du consentement aux cookies, conforme aux lignes directrices de la CNIL :
 * - aucun traceur non essentiel n'est déposé avant un choix explicite ;
 * - refuser est aussi simple qu'accepter (mêmes boutons, même niveau) ;
 * - le choix est conservé 6 mois puis redemandé ;
 * - il peut être modifié à tout moment (lien « Gestion des cookies ») ;
 * - en cas de retrait, Google Analytics est désactivé et ses cookies supprimés.
 */

const root = document.getElementById('cookie-consent');

const config = {
    gaId: root?.dataset.gaId || null,
    version: Number(root?.dataset.version || 1),
    lifetimeDays: Number(root?.dataset.lifetimeDays || 180),
    cookieName: root?.dataset.cookieName || 'cookie_consent',
};

// Durée de vie maximale des cookies Google Analytics : 13 mois (recommandation CNIL).
const GA_COOKIE_MAX_AGE = 60 * 60 * 24 * 395;

function readConsent() {
    const raw = document.cookie
        .split('; ')
        .find((row) => row.startsWith(`${config.cookieName}=`))
        ?.split('=')
        .slice(1)
        .join('=');

    if (!raw) return null;

    try {
        const consent = JSON.parse(decodeURIComponent(raw));
        return consent?.v === config.version ? consent : null;
    } catch {
        return null;
    }
}

function writeConsent(analytics) {
    const value = encodeURIComponent(JSON.stringify({ v: config.version, analytics, at: new Date().toISOString() }));
    const secure = location.protocol === 'https:' ? '; Secure' : '';

    document.cookie = `${config.cookieName}=${value}; Max-Age=${config.lifetimeDays * 86400}; Path=/; SameSite=Lax${secure}`;
}

function loadAnalytics() {
    if (!config.gaId || window.gtag) return;

    window[`ga-disable-${config.gaId}`] = false;
    window.dataLayer = window.dataLayer || [];
    window.gtag = function gtag() {
        window.dataLayer.push(arguments);
    };

    window.gtag('js', new Date());
    window.gtag('config', config.gaId, {
        cookie_expires: GA_COOKIE_MAX_AGE,
        cookie_flags: 'SameSite=Lax;Secure',
        // Aucune exploitation publicitaire des données (cf. politique de confidentialité).
        allow_google_signals: false,
        allow_ad_personalization_signals: false,
    });

    const script = document.createElement('script');
    script.src = `https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(config.gaId)}`;
    script.async = true;
    document.head.appendChild(script);
}

function removeAnalytics() {
    if (config.gaId) window[`ga-disable-${config.gaId}`] = true;

    const parts = location.hostname.split('.');
    const domains = [''];
    for (let i = 0; i < parts.length - 1; i++) {
        const domain = parts.slice(i).join('.');
        domains.push(`; Domain=${domain}`, `; Domain=.${domain}`);
    }

    document.cookie
        .split('; ')
        .map((row) => row.split('=')[0])
        .filter((name) => /^(_ga|_gid|_gat)/.test(name))
        .forEach((name) => {
            domains.forEach((domain) => {
                document.cookie = `${name}=; Max-Age=0; Path=/${domain}`;
            });
        });
}

export function initCookieConsent() {
    if (!root) return;

    const banner = document.getElementById('cookie-banner');
    const dialog = document.getElementById('cookie-preferences');
    const analyticsToggle = document.getElementById('consent-analytics');

    const showBanner = (visible) => {
        banner.hidden = !visible;
    };

    const apply = (analytics) => {
        writeConsent(analytics);
        analytics ? loadAnalytics() : removeAnalytics();
        showBanner(false);
        if (dialog.open) dialog.close();
    };

    const openPreferences = () => {
        analyticsToggle.checked = readConsent()?.analytics === true;
        dialog.showModal();
    };

    root.addEventListener('click', (event) => {
        const action = event.target.closest('[data-consent]')?.dataset.consent;

        if (action === 'accept') apply(true);
        if (action === 'refuse') apply(false);
        if (action === 'save') apply(analyticsToggle.checked);
        if (action === 'customize') openPreferences();
        if (action === 'close') dialog.close();
    });

    // Clic sur le fond du dialogue : fermeture sans enregistrer.
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });

    document.querySelectorAll('[data-open-cookie-preferences]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            openPreferences();
        });
    });

    const consent = readConsent();

    if (consent) {
        if (consent.analytics) loadAnalytics();
    } else if (config.gaId) {
        // Aucun choix valide : on demande, sans rien déposer.
        removeAnalytics();
        showBanner(true);
    }
}
