const btnFiltros = document.getElementById("btnFiltros");
const panelFiltros = document.getElementById("panelFiltros");

btnFiltros.addEventListener("click", () => {
    panelFiltros.classList.toggle("visible");
    panelFiltros.classList.toggle("hidden");
});
function cargarCategorias(records) {
    const categorias = [...new Set(records.map((r) => r.categoria))];
    const select = document.getElementById("filtroCategoria");

    categorias.forEach((cat) => {
        const opt = document.createElement("option");
        opt.value = cat;
        opt.textContent = cat;
        select.appendChild(opt);
    });
}

function aplicarFiltros() {
    const nombre = document.getElementById("filtroNombre").value.toLowerCase();
    const categoria = document.getElementById("filtroCategoria").value;

    window.filteredRecords = window.records.filter((item) => {
        return (
            (!nombre || item.nombre.toLowerCase().includes(nombre)) &&
            (!categoria || item.categoria === categoria)
        );
    });

    window.currentPage = 1;
    window.renderPage();
}

// Botón aplicar filtros
document
    .getElementById("btnAplicarFiltros")
    .addEventListener("click", aplicarFiltros);

// Lupa (ícono de buscar)
document
    .getElementById("iconoBuscar")
    .addEventListener("click", aplicarFiltros);

// ENTER en el input para buscar por nombre
document
    .getElementById("filtroNombre")
    .addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            aplicarFiltros();
        }
    });

// Botón limpiar filtros
document.getElementById("btnLimpiarFiltros").addEventListener("click", () => {
    document.getElementById("filtroNombre").value = "";
    document.getElementById("filtroCategoria").value = "";
    filteredRecords = [...window.records];
    window.currentPage = 1;
    window.renderPage();
});

window.cargarCategorias = cargarCategorias;
