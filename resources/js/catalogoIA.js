import { Modal } from "bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.getElementById("catalogoIA-wrapper");
    if (!wrapper) return;

    const gridEl = document.getElementById("ciaListaTarjetas");
    const tablaBodyEl = document.getElementById("ciaTablaBody");
    const tablaWrapperEl = document.getElementById("ciaVistaTablaWrapper");
    const sinResultadosEl = document.getElementById("ciaSinResultados");
    const contadorEl = document.getElementById("ciaContador");

    const inputTexto = document.getElementById("ciaFiltroTexto");
    const iconoBuscar = document.getElementById("ciaIconoBuscar");
    const selectCategoria = document.getElementById("ciaFiltroCategoria");
    const selectAnio = document.getElementById("ciaFiltroAnio");
    const selectEstado = document.getElementById("ciaFiltroEstado");
    const selectNaturaleza = document.getElementById("ciaFiltroNaturaleza");
    const btnLimpiar = document.getElementById("ciaLimpiarFiltros");

    const btnVistaTarjetas = document.getElementById("ciaVistaTarjetas");
    const btnVistaTabla = document.getElementById("ciaVistaTabla");
    const btnDescargarJson = document.getElementById("ciaDescargarJson");

    const modalEl = document.getElementById("ciaFichaModal");
    const modalTitulo = document.getElementById("ciaModalTitulo");
    const modalBody = document.getElementById("ciaModalBody");
    const modalInstance = new Modal(modalEl);

    let registros = [];
    let filtrados = [];

    fetch(window.CATALOGO_IA_URL)
        .then((res) => res.json())
        .then((data) => {
            registros = data;
            filtrados = [...registros];
            cargarOpciones(registros);
            render();
        })
        .catch((error) => {
            gridEl.innerHTML = `<p class="catalogoIA__sin__resultados">Error cargando el catálogo.</p>`;
            console.error("ERROR FETCH catalogoIA:", error);
        });

    function cargarOpciones(data) {
        llenarSelect(selectCategoria, uniqueSorted(data.map((r) => r.categoria)));
        llenarSelect(selectAnio, uniqueSorted(data.map((r) => r.anio)).sort((a, b) => a - b));
        llenarSelect(selectEstado, uniqueSorted(data.map((r) => r.estado)));
        llenarSelect(selectNaturaleza, uniqueSorted(data.map((r) => r.naturaleza)));
    }

    function uniqueSorted(values) {
        return [...new Set(values.filter(Boolean))].sort((a, b) =>
            String(a).localeCompare(String(b))
        );
    }

    function llenarSelect(select, values) {
        values.forEach((value) => {
            const opt = document.createElement("option");
            opt.value = value;
            opt.textContent = value;
            select.appendChild(opt);
        });
    }

    function aplicarFiltros() {
        const texto = inputTexto.value.trim().toLowerCase();
        const categoria = selectCategoria.value;
        const anio = selectAnio.value;
        const estado = selectEstado.value;
        const naturaleza = selectNaturaleza.value;

        filtrados = registros.filter((r) => {
            const coincideTexto =
                !texto ||
                [r.nombre, r.descripcion, r.entidad, r.publico]
                    .filter(Boolean)
                    .some((campo) => campo.toLowerCase().includes(texto));

            return (
                coincideTexto &&
                (!categoria || r.categoria === categoria) &&
                (!anio || String(r.anio) === anio) &&
                (!estado || r.estado === estado) &&
                (!naturaleza || r.naturaleza === naturaleza)
            );
        });

        render();
    }

    function limpiarFiltros() {
        inputTexto.value = "";
        selectCategoria.value = "";
        selectAnio.value = "";
        selectEstado.value = "";
        selectNaturaleza.value = "";
        filtrados = [...registros];
        render();
    }

    iconoBuscar.addEventListener("click", aplicarFiltros);
    inputTexto.addEventListener("keydown", (e) => {
        if (e.key === "Enter") aplicarFiltros();
    });
    [selectCategoria, selectAnio, selectEstado, selectNaturaleza].forEach((select) => {
        select.addEventListener("change", aplicarFiltros);
    });
    btnLimpiar.addEventListener("click", limpiarFiltros);

    btnVistaTarjetas.addEventListener("click", () => cambiarVista("tarjetas"));
    btnVistaTabla.addEventListener("click", () => cambiarVista("tabla"));
    btnDescargarJson.addEventListener("click", descargarJson);

    function descargarJson() {
        const blob = new Blob([JSON.stringify(filtrados, null, 2)], { type: "application/json" });
        const url = URL.createObjectURL(blob);
        const link = document.createElement("a");
        link.href = url;
        link.download = "catalogo-ia.json";
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    }

    function cambiarVista(vista) {
        const esTarjetas = vista === "tarjetas";
        btnVistaTarjetas.classList.toggle("active", esTarjetas);
        btnVistaTabla.classList.toggle("active", !esTarjetas);
        gridEl.classList.toggle("hidden", !esTarjetas);
        tablaWrapperEl.classList.toggle("hidden", esTarjetas);
    }

    function render() {
        contadorEl.textContent = `${filtrados.length} de ${registros.length} fichas`;
        sinResultadosEl.classList.toggle("hidden", filtrados.length > 0);
        renderTarjetas();
        renderTabla();
    }

    function badgeNaturaleza(naturaleza) {
        const clase = (naturaleza || "").toLowerCase().startsWith("mixta")
            ? "cia-badge--mixta"
            : (naturaleza || "").toLowerCase().startsWith("privada")
            ? "cia-badge--privada"
            : "cia-badge--publica";
        return `<span class="cia-badge ${clase}">${escapeHtml(naturaleza)}</span>`;
    }

    function botonConsultar(reg, extraClass = "") {
        if (reg.enlaceVerificado) {
            return `<a href="${escapeHtml(reg.enlace)}" target="_blank" rel="noopener" class="cia-btn-consultar ${extraClass}">Consultar</a>`;
        }
        return `<span class="cia-btn-consultar disabled ${extraClass}" title="Enlace oficial en verificación">Por verificar</span>`;
    }

    const CATEGORIA_BANNER = {
        "Política y normativa": "cia-banner--politica",
        "Gobernanza y ética": "cia-banner--gobernanza",
        "Formación y talento": "cia-banner--formacion",
        "Investigación e infraestructura": "cia-banner--investigacion",
        "Herramientas y plataformas": "cia-banner--herramientas",
        "Adopción territorial y sector público": "cia-banner--adopcion",
        "Datos abiertos e innovación": "cia-banner--datos",
        "Articulación y eventos": "cia-banner--articulacion",
    };

    function claseBanner(categoria) {
        return CATEGORIA_BANNER[categoria] || "cia-banner--default";
    }

    function renderTarjetas() {
        gridEl.innerHTML = "";
        filtrados.forEach((reg) => {
            const card = document.createElement("div");
            card.className = "cia-card";
            card.innerHTML = `
                <div class="cia-card__banner ${claseBanner(reg.categoria)}">
                    <span class="cia-card__id">${escapeHtml(reg.id)}</span>
                    <span class="cia-card__anio">${escapeHtml(reg.anio)}</span>
                    ${escapeHtml(reg.categoria)}
                </div>
                <div class="cia-card__body">
                    <h3 class="cia-card__title">${escapeHtml(reg.nombre)}</h3>
                    <p class="cia-card__desc">${escapeHtml(reg.descripcion)}</p>
                    <div class="cia-card__buttons">
                        <button type="button" class="cia-btn-ficha" data-id="${escapeHtml(reg.id)}">Ver ficha</button>
                        ${botonConsultar(reg)}
                    </div>
                </div>
            `;
            gridEl.appendChild(card);
        });

        gridEl.querySelectorAll(".cia-btn-ficha").forEach((btn) => {
            btn.addEventListener("click", () => abrirFicha(btn.dataset.id));
        });
    }

    function renderTabla() {
        tablaBodyEl.innerHTML = "";
        filtrados.forEach((reg) => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td class="number">${escapeHtml(reg.id)}</td>
                <td>${escapeHtml(reg.anio)}</td>
                <td class="name">${escapeHtml(reg.nombre)}</td>
                <td>${escapeHtml(reg.categoria)}</td>
                <td>${escapeHtml(reg.entidad)}</td>
                <td>${badgeNaturaleza(reg.naturaleza)}</td>
                <td>${escapeHtml(reg.estado)}</td>
                <td>${botonConsultar(reg)}</td>
            `;
            tablaBodyEl.appendChild(fila);
        });
    }

    function abrirFicha(id) {
        const reg = registros.find((r) => r.id === id);
        if (!reg) return;

        modalTitulo.textContent = `${reg.id} — ${reg.nombre}`;
        modalBody.innerHTML = `
            <dl>
                <dt>Año</dt><dd>${escapeHtml(reg.anio)}</dd>
                <dt>Categoría</dt><dd>${escapeHtml(reg.categoria)}</dd>
                <dt>Tipo de oferta</dt><dd>${escapeHtml(reg.tipoOferta)}</dd>
                <dt>Descripción</dt><dd>${escapeHtml(reg.descripcion)}</dd>
                <dt>Entidad responsable</dt><dd>${escapeHtml(reg.entidad)}</dd>
                <dt>Naturaleza</dt><dd>${badgeNaturaleza(reg.naturaleza)}</dd>
                <dt>Público objetivo</dt><dd>${escapeHtml(reg.publico)}</dd>
                <dt>Estado</dt><dd>${escapeHtml(reg.estado)}</dd>
                <dt>Fuente oficial</dt><dd>${escapeHtml(reg.fuenteOficial)}</dd>
                <dt>Enlace de consulta</dt><dd>${botonConsultar(reg)}</dd>
            </dl>
        `;

        modalInstance.show();
    }

    function escapeHtml(value) {
        if (value === null || value === undefined) return "";
        return String(value)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;");
    }
});
