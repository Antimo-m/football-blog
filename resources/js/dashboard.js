document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
    const sidebarClose = document.getElementById('sidebarClose');
    const userToggle = document.getElementById('userToggle');
    const userMenu = document.getElementById('userMenu');

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

    document.querySelectorAll('[data-file-upload]').forEach((upload) => {
        const input = upload.querySelector('[data-file-input]');
        const preview = upload.querySelector('[data-upload-preview]');
        const previewWrapper = preview ? preview.closest('.upload-preview') : null;
        const confirmation = upload.querySelector('[data-upload-confirmation]');
        const fileName = upload.parentElement.querySelector('[data-file-name]');
        const uploadTitle = upload.querySelector('.upload-title');

        if (!input || !preview || !previewWrapper) {
            return;
        }

        input.addEventListener('change', () => {
            const file = input.files && input.files[0];

            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            preview.src = URL.createObjectURL(file);
            preview.onload = () => URL.revokeObjectURL(preview.src);
            previewWrapper.classList.remove('d-none');
            upload.classList.add('has-file');

            if (confirmation) {
                confirmation.classList.remove('d-none');
            }

            if (fileName) {
                fileName.textContent = file.name;
            }

            if (uploadTitle) {
                uploadTitle.textContent = 'Anteprima immagine selezionata';
            }
        });
    });

    document.querySelectorAll('[data-delete-form]').forEach((form) => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('button[type="submit"]');

            if (!button) {
                return;
            }

            button.disabled = true;
            button.dataset.originalText = button.textContent.trim();
            button.textContent = button.dataset.loadingText || 'Eliminazione...';
        });
    });

});
