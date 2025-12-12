document.addEventListener('DOMContentLoaded', () => {

    // Mobile Menu Logic
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }

    // General Dropdown Logic for Click interaction (Mobile/Touch)
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.nav-link, .profile-btn');

        if (toggle) {
            toggle.addEventListener('click', (e) => {
                // Only prevent default if it's a link acting as a toggle
                if (toggle.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                e.stopPropagation();

                // Close other opened dropdowns
                dropdowns.forEach(other => {
                    if (other !== dropdown) {
                        other.classList.remove('show');
                    }
                });

                dropdown.classList.toggle('show');
            });
        }
    });

    // Close dropdowns when clicking outside
    window.addEventListener('click', () => {
        dropdowns.forEach(dropdown => {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });
    });
});
