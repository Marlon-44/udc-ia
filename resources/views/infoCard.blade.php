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
                <img src="{{ asset('images/mintic.svg') }}" alt="Logo del gobierno" class="gov__icon mintic"
                    style="fill: white">

            </div>
        </div>

        <div class="nav__herramienta__section">

            <div class="info__card__container">
                <div class="item__card">
                    <h3>Limitaciones</h3>
                    <p>{{ $info['limitaciones'] }}</p>
                </div>
                <div class="item__card">
                    <h3>Insumos</h3>
                    <p>{{ $info['insumos'] }}</p>
                </div>
                <div class="item__card">
                    <h3>Insumos</h3>
                    <P>{{ $info['insumos'] }}</P>
                </div>


                <div class="item__card">
                    <h3>Resultados</h3>
                    <p>{{ $info['resultado'] }}</p>
                </div>
            </div>

            <a href="{{ $info['enlace'] }}" target="_blank" class="nav__tool__btn">Ir a la herramienta</a>
        </div>

    </div>
    <div class="pasos__section">

        <h2 class="section__title">Pasos</h2>
        <ol class="steps-list">
            @foreach ($info['pasos_array'] as $index => $paso)
            <li class="step-item">
                <div class="step-number">{{ $index + 1 }}</div>
                <p>{{ $paso }}</p>
            </li>
            @endforeach
        </ol>

    </div>

    <div class="video__section">
        <div class="video__container__up">
            <h2 class="section__title">Video tutorial</h2>
        </div>
        <div class="video__container__down">
            @if (!empty($info['video_embed']))
            <div class="video__container"">
                        <iframe class=" video" src="{{ $info['video_embed'] }}" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
                </iframe>
            </div>
            @endif
        </div>

    </div>
</section>

@endsection