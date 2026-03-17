const SELECTORS = {
    passwordToggles: '.toggle-password',
    alerts: '.alert'
};

const AUTO_DISMISS_DELAY = 5000;

function togglePasswordVisibility(e) {
    const btn = e.currentTarget;
    const input = btn.closest('.input-wrapper').querySelector('input');
    if (!input) return;

    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';

    const icon = btn.querySelector('i');
    if (icon) {
        icon.classList.toggle('fa-eye', !isPassword);
        icon.classList.toggle('fa-eye-slash', isPassword);
    }
}

function autoDismissAlerts() {
    document.querySelectorAll(SELECTORS.alerts).forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s, transform 0.5s';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, AUTO_DISMISS_DELAY);
    });
}

function init() {
    document.querySelectorAll(SELECTORS.passwordToggles).forEach(function(toggle) {
        toggle.addEventListener('click', togglePasswordVisibility);
    });

    autoDismissAlerts();
}

document.addEventListener('DOMContentLoaded', init);
