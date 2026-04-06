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

document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    // 🔄 Reset erreurs
    document.querySelectorAll('[id^="error-"]').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });

    document.querySelectorAll('input, textarea').forEach(el => {
        el.classList.remove('border-red-500');
    });

    fetch(form.action, {
        method: form.method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    })
        .then(async response => {
            let data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            showToast(data.message || "Message envoyé !");
            form.reset();
        })
        .catch(error => {
            if (error.errors) {
                Object.keys(error.errors).forEach(field => {
                    let input = document.getElementById(field);
                    let errorEl = document.getElementById('error-' + field);

                    if (input) {
                        // 🔴 Bordure rouge + animation
                        input.classList.add('border-red-500', 'shake');

                        // relancer le shake si revalidation
                        setTimeout(() => {
                            input.classList.remove('shake');
                        }, 300);
                    }

                    if (errorEl) {
                        // 💬 Message erreur
                        errorEl.textContent = error.errors[field][0];

                        // reset état
                        errorEl.classList.remove('hidden');
                        errorEl.classList.add('opacity-0');

                        // ✨ animation fade-in
                        setTimeout(() => {
                            errorEl.classList.remove('opacity-0');
                        }, 10);
                    }
                });
            } else {
                showToast("Une erreur est survenue", 'error');
            }
        });
});

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const content = document.getElementById('toastContent');

    // Texte
    content.textContent = message;

    // Reset classes (position hors écran en bas)
    content.className = "px-6 py-4 rounded shadow-lg text-white font-medium transform transition-all duration-300 translate-y-full opacity-0";

    // Couleurs
    if (type === 'success') {
        content.classList.add('bg-green-600');
    } else {
        content.classList.add('bg-red-600');
    }

    // Afficher
    toast.classList.remove('hidden');

    // 🔥 Animation entrée (remonte + fade)
    setTimeout(() => {
        content.classList.remove('translate-y-full', 'opacity-0');
    }, 10);

    // ⏱️ Disparition
    setTimeout(() => {
        // Redescend
        content.classList.add('translate-y-full', 'opacity-0');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 300);

    }, 3000);
}
