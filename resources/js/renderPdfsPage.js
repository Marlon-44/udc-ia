const params = new URLSearchParams(window.location.search);
const index = params.get("index");
const container = document.getElementById("pdfs-container");

fetch(JSON_URL)
    .then(res => res.json())
    .then(data => {
        const carpeta = data[index];

        carpeta.pdfs.forEach(pdf => {
            container.insertAdjacentHTML("beforeend", `
                <div class="pdf-item">
                    <a target="_blank" href="${pdf}">
                        Ver PDF
                    </a>
                </div>
            `);
        });
    });
