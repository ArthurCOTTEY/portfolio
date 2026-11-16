/**
 * Menu mobile : ouverture/fermeture accessible (aria-expanded, Échap, clic sur un lien).
 */
export function initMenu() {
    const button = document.getElementById('menu-button');
    const menu = document.getElementById('mobile-menu');

    if (!button || !menu) return;

    const setOpen = (open) => {
        button.setAttribute('aria-expanded', String(open));
        button.setAttribute('aria-label', open ? 'Fermer le menu' : 'Ouvrir le menu');
        menu.hidden = !open;
    };

    button.addEventListener('click', () => setOpen(button.getAttribute('aria-expanded') !== 'true'));

    menu.addEventListener('click', (event) => {
        if (event.target.closest('a')) setOpen(false);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
            setOpen(false);
            button.focus();
        }
    });

    window.matchMedia('(min-width: 768px)').addEventListener('change', (event) => {
        if (event.matches) setOpen(false);
    });
}
