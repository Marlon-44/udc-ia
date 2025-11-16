<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    'resources/css/footer.css'
    ])

    @stack('styles')
</head>

<body>

    <x-header />

    <main>
        @yield('content')
    </main>

    @stack('scripts')

    <x-footer/>

</body>

</html>