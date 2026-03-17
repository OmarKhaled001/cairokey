document.addEventListener("DOMContentLoaded", function () {

    /* ─── Elements ─────────────────────────────────────────────── */
    const toggle  = document.getElementById("menuToggle");
    const menu    = document.getElementById("navMenu");
    const overlay = document.getElementById("menuOverlay");

    if (!toggle || !menu) return;

    /* ─── State ─────────────────────────────────────────────────── */
    let isOpen = false;

    /* ─── Helpers ───────────────────────────────────────────────── */
    function openMenu() {
        isOpen = true;
        menu.classList.add("active");
        overlay?.classList.add("active");
        document.body.classList.add("menu-open");
        toggle.setAttribute("aria-expanded", "true");
        toggle.classList.add("is-open");           // CSS swaps the icon via content/mask
        document.addEventListener("click", onOutsideClick);
    }

    function closeMenu() {
        isOpen = false;
        menu.classList.remove("active");
        overlay?.classList.remove("active");
        document.body.classList.remove("menu-open");
        toggle.setAttribute("aria-expanded", "false");
        toggle.classList.remove("is-open");
        document.removeEventListener("click", onOutsideClick);
    }

    function onOutsideClick(e) {
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            closeMenu();
        }
    }

    /* ─── Events ─────────────────────────────────────────────────── */
    toggle.addEventListener("click", () => isOpen ? closeMenu() : openMenu());

    overlay?.addEventListener("click", closeMenu);

    // Close when the user navigates (nav-link or mobile logo tap)
    menu.addEventListener("click", function (e) {
        if (e.target.closest(".nav-link, .mobile-logo")) {
            closeMenu();
        }
    });

    // Close on Escape
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && isOpen) closeMenu();
    });
});
