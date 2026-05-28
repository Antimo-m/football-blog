import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

// IMPORT CORRETTO BOOTSTRAP JS
import * as bootstrap from 'bootstrap';

// rende bootstrap globale (fondamentale per modali)
window.bootstrap = bootstrap;

document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('userToggle');
    const menu = document.getElementById('userMenu');
    const icon = document.getElementById('userIcon');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            menu.classList.toggle('d-none');

            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        });
    }
});
