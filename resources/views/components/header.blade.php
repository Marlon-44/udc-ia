<header class="main__header">

    <div class="header__top">
        <img src="{{ asset('images/gov__img.webp') }}" alt="Logo del gobierno" class="gov__icon">

        <div class="header__actions">

            <button class="action-btn">
                <img src="{{ asset('images/search__icon.svg') }}" alt="Buscar" class="icon search__icon">

            </button>

            <button class="action-btn">
                <img src="{{ asset('images/world.png') }}" alt="Cambiar idioma" class="icon world__icon">

            </button>

            <button class="login-btn">
                <h3>Iniciar Sesión</h3>
                <img src="{{ asset('images/dropdown.png') }}" alt="Icono usuario" class="icon user__icon">
            </button>

            <button class="action-btn nav__btn">
                <img src="{{ asset('images/burger__menu.png') }}" alt="Icono usuario" class="icon world__icon">

            </button>

        </div>
    </div>

    <div class="header__brand">
        <img src="{{ asset('images/Logo MinTic.png') }}" alt="Logo MinTic" class="minTic__logo">
        
        <img src="{{ asset('images/logo__udc.svg') }}" alt="Logo UDC" class="udc__logo">
    </div>

    <nav class="header__nav">
        <a href="{{ asset('/') }}" class="nav__option">Inicio</a>
        <a href="{{ asset('/colaboradores') }}" class="nav__option">Colaboradores</a>

        <!-- <a href="#" class="nav__option">Comunidades</a> -->
        <!-- <a href="#" class="nav__option">Navegar <img src="{{ asset('images/dropdown.png') }}" alt="Icono usuario" class="icon user__icon"></a> -->
        <!-- <a href="#" class="nav__option">Estadísticas</a> -->
        <!-- <a href="#" class="nav__option">Acerca</a> -->
        <!-- <a href="#" class="nav__option">Cómo depositar</a> -->
        <!-- <a href="#" class="nav__option">Políticas</a> -->
        <!-- <a href="#" class="nav__option">Servicios</a> -->
        <!-- <a href="#" class="nav__option">Contactos</a> -->

        {{-- <div class="nav__item dropdown nav__option"> --}}
        {{-- <a href="#" class="nav__option">
                Biblioteca
                <img src="{{ asset('images/dropdown.png') }}" class="icon user__icon">
            </a> --}}

        {{-- <div class="dropdown__menu">
                <a href="{{ asset('/repositorio') }}">Repositorio</a>
            </div> --}}
        {{-- </div> --}}

    </nav>

</header>
