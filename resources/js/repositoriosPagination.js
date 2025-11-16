// resources/js/repositoriosPagination.js

document.addEventListener("DOMContentLoaded", () => {
    initRepositorio();
});

async function initRepositorio() {
    const listEl = document.getElementById("repositorios-list");
    const paginationEl = document.getElementById("pagination-controls");

    let records = [];
    let currentPage = 1;
    const itemsPerPage = 12;

    // CONFIG flexible según donde esté el JSON
    const MODO_API = false;

    const URL_API = "./api/repositorio";   // Cuando tu compañero lo defina
    const URL_LOCAL = "./data/repositorio.json"; // Archivo estático público

    // ⏳ Loading
    listEl.innerHTML = `<div class="text-center py-5">Cargando datos...</div>`;

    try {
        const response = await fetch(MODO_API ? URL_API : URL_LOCAL);
        records = await response.json();

        renderPage();
    } catch (error) {
        listEl.innerHTML = `
            <div class="alert alert-danger">
                Error cargando los registros.
            </div>
        `;
        return;
    }

    function renderPage() {
        listEl.innerHTML = "";

        const start = (currentPage - 1) * itemsPerPage;
        const paginatedItems = records.slice(start, start + itemsPerPage);

        paginatedItems.forEach(reg => {

            // Obtener ID del video
            const videoID = getYoutubeID(reg.video);
            const thumbnail = videoID
                ? `https://img.youtube.com/vi/${videoID}/hqdefault.jpg`
                : "https://via.placeholder.com/300x200?text=Sin+imagen"; // fallback seguro

            // Sanear campos vacíos
            const nombre = reg.nombre ?? "Sin nombre";
            const descripcion = reg.descripcion ?? "Sin descripción";
            const enlace = reg.enlace ?? "#";
            const video = reg.video ?? "#";

            const card = `
            
                <div class="herramienta__card">
                    <img src="${thumbnail}" alt="Miniatura del video" class="card__img">

                    <div class="herramienta__card__content">
                        <h5 class="herramienta__card__title">${nombre}</h5>
                        <p class="herramienta__card__description">${descripcion}</p>

                        <div class="herramienta__card__buttons">
                            <a href="${enlace}" target="_blank" class="herramienta__button">Herramienta</a>
                            <a href="${video}" target="_blank" class="video__button">Video</a>
                        </div>
                    </div>
                </div>
        `;

            listEl.insertAdjacentHTML("beforeend", card);
        });

        renderPagination();
    }


    function getYoutubeID(url) {
        if (!url) return null;

        const regex = /(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|shorts\/))([^?&]+)/;
        const match = url.match(regex);

        return match ? match[1] : null;
    }


    function renderPagination() {
        paginationEl.innerHTML = "";

        const totalPages = Math.ceil(records.length / itemsPerPage);

        // Botón anterior
        paginationEl.innerHTML += `
            <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                <button class="page-link" data-page="${currentPage - 1}"> Anterior </button>
            </li>
        `;

        // Números
        for (let i = 1; i <= totalPages; i++) {
            paginationEl.innerHTML += `
                <li class="page-item ${i === currentPage ? "active" : ""}">
                    <button class="page-link" data-page="${i}">${i}</button>
                </li>
            `;
        }

        // Botón siguiente
        paginationEl.innerHTML += `
            <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
                <button class="page-link" style='color: #E79D19' data-page="${currentPage + 1}"> Siguiente </button>
            </li>
        `;

        // Listeners
        paginationEl.querySelectorAll("button[data-page]").forEach(btn => {
            btn.addEventListener("click", () => {
                const page = parseInt(btn.dataset.page);
                if (page > 0) {
                    currentPage = page;
                    renderPage();
                }
            });
        });
    }
}
