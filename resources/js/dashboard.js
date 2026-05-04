document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
    const sidebarClose = document.getElementById('sidebarClose');
    const userToggle = document.getElementById('userToggle');
    const userMenu = document.getElementById('userMenu');

    console.log('dashboard.js caricato');

    // MOBILE SIDEBAR
    if (sidebarToggleMobile && sidebar) {
        sidebarToggleMobile.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    }

    if (sidebarClose && sidebar) {
        sidebarClose.addEventListener('click', () => {
            sidebar.classList.remove('open');
        });
    }

    document.addEventListener('click', function (event) {
        if (
            window.innerWidth <= 768 &&
            sidebar &&
            !sidebar.contains(event.target)
        ) {
            sidebar.classList.remove('open');
        }
    });

    // USER MENU
    if (userToggle && userMenu) {

        userToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            userMenu.classList.toggle('show');
        });

        userMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        document.addEventListener('click', function () {
            userMenu.classList.remove('show');
        });
    }

});