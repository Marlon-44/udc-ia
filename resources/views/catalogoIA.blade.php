@extends('layouts.app')

@section('title', 'Repositorio Digital | Universidad de Cartagena | Catálogo Único de Oferta IA')

@section('description', 'Consolidado de políticas, normas, programas, herramientas y espacios de Inteligencia Artificial liderados o cofinanciados por el Estado colombiano. Fuentes oficiales: DNP, MinTIC, MinCiencias, Congreso.')

@section('og_image', asset('images/oferta.png'))

@section('content')

    <section class="catalogoIA__hero">
        <div class="titulo">
            <h1>Catálogo Único de Oferta IA</h1>
        </div>
        <p class="catalogoIA__subtitulo">
            Consolidado de políticas, normas, programas, herramientas y espacios de Inteligencia Artificial
            liderados o cofinanciados por el Estado colombiano. Fuentes oficiales: DNP, MinTIC, MinCiencias, Congreso.
        </p>
    </section>

    <div id="catalogoIA-wrapper" class="catalogoIA__section">

        <div class="catalogoIA__filtros">
            <div class="search-bar">
                <input type="text" id="ciaFiltroTexto" placeholder="Buscar por nombre, entidad o descripción...">
                <img id="ciaIconoBuscar" src="{{ asset('images/search__icon.svg') }}" alt="Buscar" class="search-icon">
            </div>

            <div class="catalogoIA__selects">
                <select id="ciaFiltroCategoria" class="filter__option__btn">
                    <option value="">Categoría</option>
                </select>
                <select id="ciaFiltroAnio" class="filter__option__btn">
                    <option value="">Año</option>
                </select>
                <select id="ciaFiltroEstado" class="filter__option__btn">
                    <option value="">Estado</option>
                </select>
                <select id="ciaFiltroNaturaleza" class="filter__option__btn">
                    <option value="">Naturaleza</option>
                </select>
                <button id="ciaLimpiarFiltros" class="filter__option__btn">Limpiar</button>
            </div>

            <div class="catalogoIA__vista">
                <span id="ciaContador" class="catalogoIA__contador"></span>
                <div class="catalogoIA__vista__botones">
                    <button id="ciaVistaTarjetas" class="cia-view-btn active">Tarjetas</button>
                    <button id="ciaVistaTabla" class="cia-view-btn">Tabla</button>
                    <button id="ciaDescargarJson" class="cia-view-btn cia-download-btn">Descargar JSON</button>
                    <a href="{{ asset('data/catalogo-ia.xlsx') }}" download class="cia-view-btn cia-download-btn">Descargar
                        Excel</a>
                </div>
            </div>
        </div>

        <div id="ciaListaTarjetas" class="catalogoIA__grid"></div>

        <div id="ciaVistaTablaWrapper" class="table-container catalogoIA__tabla hidden">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Año</th>
                        <th>Iniciativa / Herramienta</th>
                        <th>Categoría</th>
                        <th>Entidad</th>
                        <th>Naturaleza</th>
                        <th>Estado</th>
                        <th>Enlace</th>
                    </tr>
                </thead>
                <tbody id="ciaTablaBody"></tbody>
            </table>
        </div>

        <p id="ciaSinResultados" class="catalogoIA__sin__resultados hidden">
            No se encontraron fichas con los filtros seleccionados.
        </p>

    </div>

    {{-- Modal ficha de detalle --}}
    <div class="modal fade" id="ciaFichaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content catalogoIA__modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="ciaModalTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="ciaModalBody"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        window.CATALOGO_IA_URL = "{{ asset('data/catalogoIA.json') }}";
    </script>
@endpush
