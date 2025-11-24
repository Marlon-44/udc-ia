@extends('layouts.app')

@section('title', $info['nombre'] . ' | Información de herramienta')

@section('content')
    <div class="info-card">
        <h2>{{ $info['nombre'] }}</h2>
        <p><strong>Descripción:</strong> {{ $info['descripcion'] }}</p>
        <p><strong>Categoría:</strong> {{ $info['categoria'] }}</p>
        <p><strong>Limitaciones:</strong> {{ $info['limitaciones'] }}</p>
        <p><strong>Requisitos:</strong> {{ $info['insumos'] }}</p>
        <p><strong>Pasos:</strong> {{ $info['pasos'] }}</p>
        <p><strong>Resultado:</strong> {{ $info['resultado'] }}</p>
        <p>
            <a href="{{ $info['enlace'] }}" target="_blank" class="btn btn-primary">Ir a la herramienta</a>
            @if ($info['video'])
                <a href="{{ $info['video'] }}" target="_blank" class="btn btn-secondary">Video tutorial</a>
            @endif
        </p>

        @if (!empty($info['video_embed']))
            <div style="margin-top:2rem;text-align:center;">
                <iframe width="560" height="315" src="{{ $info['video_embed'] }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        @endif
    </div>
@endsection
