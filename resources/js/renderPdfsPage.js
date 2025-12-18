const params = new URLSearchParams(window.location.search);
const index = params.get("index");
const container = document.getElementById("pdfs-container");

fetch(JSON_URL)
    .then((res) => res.json())
    .then((data) => {
        const carpeta = data[index];

        carpeta.pdfs.forEach((pdf) => {
            container.insertAdjacentHTML(
                "beforeend",
                `
        <a class="pdf-card" target="_blank" href="${pdf}">
          <span class="pdf-card__title">${pdf.split("/").pop()}</span>
          <img class="pdf-card__icon" src="images/download.png" alt="Descargar PDF">
        </a>
      `
            );
        });
    });
