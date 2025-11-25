@extends('layouts.app')

@section('title', $info['nombre'] . ' | Información de herramienta')

@section('content')
<section class="info-page">
    <div class="text__information__container">
        <div class="titles__section">
            <div class="titles__container">
                <h1>{{ $info['nombre'] }}</h1>
                <p>{{ $info['descripcion'] }}</p>
                <div class="categoria">
                    <img src="{{ asset('images/play.png') }}" alt="Logo del gobierno" class="gov__icon">
                    <h3>Categoria: {{ $info['categoria'] }}</h3>
                </div>
            </div>
            <div class="logos__container">
                <img src="{{ asset('images/udc_bw.png') }}" alt="Logo del gobierno" class="gov__icon udc">
                <img src="{{ asset('images/mintic.svg') }}" alt="Logo del gobierno" class="gov__icon mintic">
                
            </div>
        </div>

        <div class="nav__herramienta__section">
            
            <div class="info__card__container">
                <div class="item__card">
                    <h3 >Limitaciones</h3>
                    <p>{{ $info['limitaciones'] }}</p>
                    <a href="" >CONTACT NOW</a>
                </div>
                <div class="item__card">
                    <h3 >Insumos</h3>
                    <p>{{ $info['insumos'] }}</p>
                    <a href="" >BILL CHECK</a>
                </div>
                <div class="item__card">
                    <h3 >Pasos</h3>
                    <p>{{ $info['pasos'] }}</p>
                    <a href="" >LOCATION</a>
                </div>
                <div class="item__card">
                    <h3 >Resultados</h3>
                    <p>{{ $info['resultado'] }}</p>
                    <a href="" >LOCATION</a>
                </div>
            </div>

            <a href="{{ $info['enlace'] }}" target="_blank" class="nav__tool__btn">Ir a la herramienta</a>
        </div>

    </div>

    <div class="video__section">
        <div class="video__container__up">
            <h2>Video tutorial</h2>
        </div>
        <div class="video__container__down">
            @if (!empty($info['video_embed']))
            <div class="video__container"">
                <iframe class="video" src="{{ $info['video_embed'] }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
            @endif
        </div>

    </div>
</section>
<!--
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
-->
@endsection