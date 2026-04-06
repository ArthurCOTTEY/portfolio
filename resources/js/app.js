import './bootstrap';


const btn = document.getElementById('menu-btn');
const menu = document.getElementById('mobile-menu');
const spans = btn.querySelectorAll('span');

btn.addEventListener('click', () => {
    const isOpen = btn.getAttribute('aria-expanded') === 'true';

    btn.setAttribute('aria-expanded', !isOpen);

    // menu animation
    menu.classList.toggle('opacity-0');
    menu.classList.toggle('-translate-y-5');
    menu.classList.toggle('pointer-events-none');

    // burger animation → croix
    spans[0].classList.toggle('rotate-45');
    spans[0].classList.toggle('translate-y-1.5');

    spans[1].classList.toggle('opacity-0');

    spans[2].classList.toggle('-rotate-45');
    spans[2].classList.toggle('-translate-y-1.5');
});
