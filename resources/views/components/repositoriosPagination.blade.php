<div id="repositorios-wrapper" class="herramientas__section">

    <div class="herramientas__header">
        <div class="herramientas__header">

            <!-- Botón -->
            <button id="btnFiltros" class="filter__btn">
                <img src="{{ asset('images/filter.png') }}" alt="Filtros" class="filter__icon">
                <span>Filtros</span>
            </button>

            <div class="titulo">
                <h1><span>Repositorio</span> Digital</h1>
            </div>

            <div class="search-bar">
                <input type="text" id="filtroNombre" placeholder="Buscar por nombre...">

                <!-- Lupa que también aplica el filtro -->
                <img id="iconoBuscar" src="{{ asset('images/search__icon.svg') }}" alt="Buscar" class="search-icon">
            </div>

            <div class="filters-actions">
                <p>Buscar por: </p>
                
                <select class="filter__option__btn" id="filtroCategoria">
                    <option value="">Categorias</option>
                </select>
                <button id="btnAplicarFiltros" class="filter__option__btn buscar"> Buscar</button>
                <button id="btnLimpiarFiltros" class="filter__option__btn">Limpiar</button>

            </div>
        </div>

        <!-- Panel de filtros 
        <div id="panelFiltros" class="filters-panel hidden">

            <h3>Filtrar Resultados</h3>

        </div>-->



    </div>



    <div id="repositorios-list" class="herramientas__list"></div>

    <nav>
        <ul id="pagination-controls" class="pagination justify-content-center mt-4"></ul>
    </nav>

</div>