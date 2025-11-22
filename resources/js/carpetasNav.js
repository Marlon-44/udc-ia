import carpetaCard from "./templatesComponents/carpetaCardTemplate";

const container = document.getElementById("carpetas-container");
console.log("carpetasNav JS cargado");

const BASE_URL = "/udc-ia/public";

const colors = [
    "#F2C14E",
    "#6CCFF6",
    "#FF6B6B",
    "#8ED081",
    "#C692F6"
];

fetch(JSON_URL)
    .then(res => res.json())
    .then(data => renderCarpetas(data));

function renderCarpetas(list) {
    container.innerHTML = "";

    list.forEach((item, index) => {
        const color = colors[index % colors.length];

        const html = carpetaCard({
            index,
            name: item.name,
            description: item.description,
            color
        });

        container.insertAdjacentHTML("beforeend", html);
    });
}
