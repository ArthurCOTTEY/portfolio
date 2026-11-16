let hideTimer;

/**
 * Notification courte annoncée aux lecteurs d'écran (role="status" dans le layout).
 */
export function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    if (!toast) return;

    toast.textContent = message;
    toast.dataset.type = type;
    toast.hidden = false;

    requestAnimationFrame(() => toast.classList.remove('translate-y-4', 'opacity-0'));

    clearTimeout(hideTimer);
    hideTimer = setTimeout(() => {
        toast.classList.add('translate-y-4', 'opacity-0');
        setTimeout(() => (toast.hidden = true), 300);
    }, 5000);
}
