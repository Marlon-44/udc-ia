window.records = [];
window.filteredRecords = [];
window.currentPage = 1;
const itemsPerPage = 12;

document.addEventListener("DOMContentLoaded", () => {
    initRepositorio();
});

async function initRepositorio() {
    const listEl = document.getElementById("repositorios-list");
    const paginationEl = document.getElementById("pagination-controls");

    // CONFIG flexible según donde esté el JSON
    const MODO_API = false;
    const URL_API = "./api/repositorio"; // Cuando tu compañero lo defina
    const URL_LOCAL = "./data/repositorio.json"; // Archivo estático público

    // ⏳ Loading
    listEl.innerHTML = `<div class="text-center py-5">Cargando datos...</div>`;

    try {
        const response = await fetch(MODO_API ? URL_API : URL_LOCAL);
        window.records = await response.json();
        window.filteredRecords = [...window.records];

        window.renderPage(); // Llama a la función global, no local
    } catch (error) {
        listEl.innerHTML = `
            <div class="alert alert-danger">
                Error cargando los registros.
            </div>
        `;
        return;
    }
}

// Función de render fuera de initRepositorio
window.renderPage = function () {
    const listEl = document.getElementById("repositorios-list");
    const start = (window.currentPage - 1) * itemsPerPage;
    const paginatedItems = window.filteredRecords.slice(
        start,
        start + itemsPerPage
    );

    listEl.innerHTML = "";

    paginatedItems.forEach((reg) => {
        const videoID = getYoutubeID(reg.video);
        const thumbnail = videoID
            ? `https://img.youtube.com/vi/${videoID}/hqdefault.jpg`
            : "https://via.placeholder.com/300x200?text=Sin+imagen";

        const nombre = reg.nombre ?? "Sin nombre";
        const descripcion = reg.descripcion ?? "Sin descripción";
        const enlace = reg.enlace ?? "#";
        const video = reg.video ?? "#";
        const BASE_URL = "/udc-ia/public";

        const card = `
        <a href="${BASE_URL}/info/${encodeURIComponent(
            nombre
        )}" target="_blank" class="herramienta__link">
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
        </a>

        `;

        listEl.insertAdjacentHTML("beforeend", card);
    });

    window.renderPagination();
};

function getYoutubeID(url) {
    if (!url) return null;
    const regex =
        /(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|shorts\/))([^?&]+)/;
    const match = url.match(regex);
    return match ? match[1] : null;
}

window.renderPagination = function () {
    const paginationEl = document.getElementById("pagination-controls");
    paginationEl.innerHTML = "";

    const totalPages = Math.ceil(window.filteredRecords.length / itemsPerPage);

    paginationEl.innerHTML += `
        <li class="page-item ${window.currentPage === 1 ? "disabled" : ""}">
            <button class="page-link" data-page="${
                window.currentPage - 1
            }">Anterior</button>
        </li>
    `;

    for (let i = 1; i <= totalPages; i++) {
        paginationEl.innerHTML += `
            <li class="page-item ${i === window.currentPage ? "active" : ""}">
                <button class="page-link" data-page="${i}">${i}</button>
            </li>
        `;
    }

    paginationEl.innerHTML += `
        <li class="page-item ${
            window.currentPage === totalPages ? "disabled" : ""
        }">
            <button class="page-link" style='color: #E79D19' data-page="${
                window.currentPage + 1
            }">Siguiente</button>
        </li>
    `;

    paginationEl.querySelectorAll("button[data-page]").forEach((btn) => {
        btn.addEventListener("click", () => {
            const page = parseInt(btn.dataset.page);
            if (page > 0 && page <= totalPages) {
                window.currentPage = page;
                window.renderPage();
            }
        });
    });
};
