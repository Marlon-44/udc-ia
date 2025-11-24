const BASE_URL = "/udc-ia/public"; // Ajusta si cambia en tu servidor

export default function carpetaCard({ index, name, description, color }) {
    return `
        <a href="${BASE_URL}/pdfs/${index}" class="carpeta__link">
            <div class="carpeta-card" data-index="${index}">
                <img src="${folderIcon}" alt="folder" style="background-color:${color}" class="folder__img">

                <h3 class="carpeta-card__title">${name}</h3>
                <p class="carpeta-card__desc">${description}</p>
            </div>
        </a>
    `;
}
