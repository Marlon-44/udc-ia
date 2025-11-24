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
        cargarCategorias(
            window.records.sort((a, b) =>
                a.categoria.localeCompare(b.categoria)
            )
        );

        window.renderPage(); // Llama a la función global, no local
    } catch (error) {
        listEl.innerHTML = `
            <div class="alert alert-danger">
                Error cargando los registros.
            </div>
        `;
        console.error("ERROR FETCH:", error);

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
        const thumbnail = reg.logo
            ? reg.logo
            : videoID
            ? `https://img.youtube.com/vi/${videoID}/0.jpg`
            : "/images/default-thumbnail.jpg";

        const nombre = reg.nombre ?? "Sin nombre";
        const descripcion = reg.descripcion ?? "Sin descripción";
        const enlace = reg.enlace ?? "#";
        const video = reg.video ?? "#";
        const BASE_URL = "/udc-ia/public";

        const card = `
        <a href="${BASE_URL}/info/${encodeURIComponent(
            nombre
        )}" class="herramienta__link">
            <div class="herramienta__card">
                <img src="${
                    reg.logo ? BASE_URL.concat(thumbnail) : thumbnail
                }" alt="Miniatura del video" class="card__img">
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
    const current = window.currentPage;

    function createButton(
        page,
        label = null,
        disabled = false,
        active = false,
        dots = false
    ) {
        if (dots) {
            return `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        return `<li class="page-item ${active ? "active" : ""} ${
            disabled ? "disabled" : ""
        }">
                    <button class="page-link" data-page="${page}">${
            label || page
        }</button>
                </li>`;
    }

    // Anterior
    paginationEl.innerHTML += createButton(
        current - 1,
        "Anterior",
        current === 1
    );

    // Paginas
    let pages = [];
    if (totalPages <= 5) {
        // Mostrar todas
        for (let i = 1; i <= totalPages; i++) pages.push(i);
    } else {
        if (current <= 3) {
            pages = [1, 2, 3, 4, 0, totalPages];
        } else if (current >= totalPages - 2) {
            pages = [
                1,
                0,
                totalPages - 3,
                totalPages - 2,
                totalPages - 1,
                totalPages,
            ];
        } else {
            pages = [1, 0, current - 1, current, current + 1, 0, totalPages];
        }
    }

    // Render paginación con puntos
    let prev = 0;
    for (const p of pages) {
        if (p === 0) {
            paginationEl.innerHTML += createButton(
                null,
                null,
                true,
                false,
                true
            );
        } else {
            if (p !== prev) {
                paginationEl.innerHTML += createButton(
                    p,
                    p,
                    false,
                    p === current
                );
                prev = p;
            }
        }
    }

    // Siguiente
    paginationEl.innerHTML += createButton(
        current + 1,
        "Siguiente",
        current === totalPages
    );

    // Click listeners
    paginationEl.querySelectorAll("button[data-page]").forEach((btn) => {
        const page = parseInt(btn.dataset.page);
        btn.addEventListener("click", () => {
            if (page > 0 && page <= totalPages) {
                window.currentPage = page;
                window.renderPage();
                // Scroll arriba en móvil para UX mejorada
                if (window.innerWidth < 768)
                    window.scrollTo({ top: 0, behavior: "smooth" });
            }
        });
    });
};
