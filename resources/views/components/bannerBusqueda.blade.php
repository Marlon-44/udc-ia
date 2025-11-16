<section class="busqueda__section">
    <div class="titulo">
        <h1><span>Repositorio</span> Digital</h1>
    </div>
    <div class="busqueda">
        <form class="search-bar" action="#" method="GET">
        <label for="search" class="sr-only">Buscar</label>

        <input
            type="text"
            id="search"
            name="search"
            placeholder="Buscar..."
            autocomplete="off">

        <button type="submit" class="search-btn">
            <img src="{{ Vite::asset('resources/images/search__icon.svg') }}"
                alt="Buscar"
                class="search-icon">
        </button>
    </form>

    <div class="atajos__container">

        <!-- Atajo 1 -->
        <div class="atajo__box " data-filter="colecciones">
            <div class="icon__container rojo">
                <img src="{{ Vite::asset('resources/images/search__icon.svg') }}" alt="Colecciones">
            </div>
            <a href="" class="rojo">Buscar por <br>colecciones</a>
            
        </div>

        <!-- Atajo 2 -->
        <div class="atajo__box " data-filter="titulo">
            <div class="icon__container amarillo">
                <img src="{{ Vite::asset('resources/images/search__icon.svg') }}" alt="Título">
            </div>
            <a href="" class="amarillo"> Buscar por <br> Título</a>
        </div>

        <!-- Atajo 3 -->
        <div class="atajo__box " data-filter="autor">
            <div class="icon__container rojo">
                <img src="{{ Vite::asset('resources/images/search__icon.svg') }}" alt="Autor">
            </div>
            <a href="" class="rojo">Buscar por<br> Autor</a>
        </div>

        <!-- Atajo 4 -->
        <div class="atajo__box" data-filter="fecha">
            <div class="icon__container amarillo">
                <img src="{{ Vite::asset('resources/images/search__icon.svg') }}" alt="Fecha">
            </div>
            <a href="" class="amarillo">Buscar por <br>Fecha</a>
        </div>

        <!-- Atajo 5 -->
        <div class="atajo__box" data-filter="materias">
            <div class="icon__container rojo">
                <img src="{{ Vite::asset('resources/images/search__icon.svg') }}" alt="Materias">
            </div>
            <a href="" class="rojo">Buscar por <br>Materias</a>
        </div>

        <!-- Atajo 6 -->
        <div class="atajo__box" data-filter="tipo">
            <div class="icon__container amarillo">
                <img src="{{ Vite::asset('resources/images/search__icon.svg') }}" alt="Tipo de material">
            </div>
            <a href="" class="amarillo">Buscar por <br>Tipo de material</a>
        </div>

    </div>
    </div>
    

</section>
