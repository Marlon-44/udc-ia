<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>@yield('title')</title>

    {{-- Cargar Vite SOLO UNA VEZ --}}
    @vite([
    'resources/css/app.css',
    'resources/css/header.css',
    'resources/js/app.js',
    'resources/css/bannerBusqueda.css',
    'resources/css/comunidades.css',
    'resources/css/repositoriosPagination.css',
    'resources/css/herramientaCard.css',
    'resources/css/footer.css',
    'resources/css/carpetaCard.css',
    'resources/css/pdfs.css',
    'resources/css/tool__info.css',
    'resources/css/colaboradores.css'])

    @stack('styles')
</head>

<body>
    <div id="loader"
        style="
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: #fff;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        ">
        <div class="spinner"></div>
    </div>

    <x-header />

    <main>
        @yield('content')
    </main>

    @stack('scripts')

    <x-footer />


    <script>
        window.addEventListener('load', function() {
            // Espera que TODO (html, imágenes, css, js) esté cargado
            var loader = document.getElementById('loader');
            if (loader) loader.style.display = 'none';
        });
        window.JSON_URL = "{{ asset('data/carpetasPdf.json') }}";
    </script>

</body>

</html>