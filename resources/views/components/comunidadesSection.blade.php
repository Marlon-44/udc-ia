@php
$comunidades = [
    'Biblioteca',
    'Libros',
    'Perfiles de investigación',
    'Revistas',
    'Trabajos de grado',
    'Trabajos de investigación',
];
@endphp

<section class="comunidades">
    <h2 class="comunidades__titulo">Comunidades</h2>

    <ul class="comunidades__lista">
        @foreach($comunidades as $comunidad)
            <li class="comunidad">{{ $comunidad }}</li>
        @endforeach
    </ul>
</section>
