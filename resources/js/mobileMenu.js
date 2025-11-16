// resources/js/mobileMenu.js
console.log('[mobileMenu] script cargado');

document.addEventListener("DOMContentLoaded", () => {
    console.log('[mobileMenu] DOM listo');

    const navBtn = document.querySelector(".nav__btn");
    const nav = document.querySelector(".header__nav");

    if (!navBtn) {
        console.warn('[mobileMenu] No se encontró .nav__btn en el DOM');
        return;
    }
    if (!nav) {
        console.warn('[mobileMenu] No se encontró .header__nav en el DOM');
        return;
    }

    // estado inicial: asegurar que el nav no esté abierto por defecto
    nav.classList.remove('show');

    navBtn.addEventListener("click", (e) => {
        e.preventDefault();
        nav.classList.toggle("show");
        console.log('[mobileMenu] toggle ->', nav.classList.contains('show'));
    });
});
