// User Dropdown Toggle
document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.getElementById("user-dropdown");
    const button = document.getElementById("user-dropdown-button");
    const menu = document.getElementById("user-dropdown-menu");

    if (dropdown && button && menu) {
        button.addEventListener("click", function (e) {
            e.stopPropagation();
            menu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (e) {
            if (!dropdown.contains(e.target)) {
                menu.classList.add("hidden");
            }
        });
    }

    // Mobile Sidebar Toggle
    const toggleBtn = document.getElementById("mobile-menu-toggle");
    const closeBtn = document.getElementById("mobile-menu-close");
    const sidebar = document.getElementById("mobile-sidebar");
    const overlay = document.getElementById("mobile-overlay");

    function openSidebar() {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
    }

    function closeSidebar() {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    }

    if (toggleBtn && sidebar && overlay) {
        toggleBtn.addEventListener("click", openSidebar);
    }

    if (closeBtn && sidebar && overlay) {
        closeBtn.addEventListener("click", closeSidebar);
    }

    if (overlay) {
        overlay.addEventListener("click", closeSidebar);
    }

    // Close sidebar on Escape key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeSidebar();
        }
    });
});
