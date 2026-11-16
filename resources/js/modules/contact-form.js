import { showToast } from './toast';

const NETWORK_ERROR = 'Connexion impossible. Vérifiez votre réseau puis réessayez.';

/**
 * Envoi du formulaire de contact en AJAX, avec repli naturel sur
 * l'envoi classique si JavaScript est désactivé.
 */
export function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const submit = form.querySelector('[type="submit"]');
    const submitLabel = submit.textContent;

    const clearErrors = () => {
        form.querySelectorAll('[data-error-for]').forEach((el) => {
            el.textContent = '';
            el.hidden = true;
        });
        form.querySelectorAll('[aria-invalid]').forEach((el) => el.removeAttribute('aria-invalid'));
    };

    const showErrors = (errors) => {
        let first = null;

        Object.entries(errors).forEach(([field, messages]) => {
            const input = form.elements.namedItem(field);
            const error = form.querySelector(`[data-error-for="${field}"]`);

            if (input) {
                input.setAttribute('aria-invalid', 'true');
                input.classList.add('shake');
                setTimeout(() => input.classList.remove('shake'), 300);
                first ??= input;
            }

            if (error) {
                error.textContent = messages[0];
                error.hidden = false;
            }
        });

        first?.focus();
    };

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearErrors();

        submit.disabled = true;
        submit.textContent = 'Envoi en cours…';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(form),
            });

            const data = await response.json().catch(() => ({}));

            if (response.ok) {
                form.reset();
                showToast(data.message, 'success');
            } else if (response.status === 422 && data.errors) {
                showErrors(data.errors);
            } else if (response.status === 419) {
                showToast('Votre session a expiré. Rechargez la page puis renvoyez votre message.', 'error');
            } else {
                showToast(data.message || NETWORK_ERROR, 'error');
            }
        } catch {
            showToast(NETWORK_ERROR, 'error');
        } finally {
            submit.disabled = false;
            submit.textContent = submitLabel;
        }
    });
}
