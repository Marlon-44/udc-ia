<div id="repositorios-wrapper" class="herramientas__section">
    <div class="herramientas__header">
        <div class="herramientas__header">

            <!-- Botón -->
            <button id="btnFiltros" class="filter__btn">
                <img src="{{ Vite::asset('resources/images/filter.png') }}" alt="Filtros" class="filter__icon">
                <span>Filtros</span>
            </button>

            <h1 class="pagination__title">Repositorio Digital</h1>
        </div>

        <!-- Panel de filtros -->
        <div id="panelFiltros" class="filters-panel hidden">

            <h3>Filtrar Resultados</h3>

            <div class="filter-group">
                <label for="filtroNombre">Nombre</label>
                <input type="text" id="filtroNombre" placeholder="Buscar por nombre...">
            </div>

            <div class="filter-group">
                <label for="filtroCategoria">Categoría</label>
                <select id="filtroCategoria">
                    <option value="">Todas</option>
                </select>
            </div>

            <div class="filters-actions">
                <button id="btnAplicarFiltros" class="btn-apply">Aplicar</button>
                <button id="btnLimpiarFiltros" class="btn-clear">Limpiar</button>
            </div>

        </div>



    </div>



    <div id="repositorios-list" class="herramientas__list"></div>

    <nav>
        <ul id="pagination-controls" class="pagination justify-content-center mt-4"></ul>
    </nav>

</div>