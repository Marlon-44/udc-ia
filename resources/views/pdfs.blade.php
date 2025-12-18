@extends('layouts.app')

@section('title', $carpeta['name'] . ' | PDFs')

@section('content')
    <div class="pdf-page">
        <h2 class="titulo">{{ $carpeta['name'] }}</h2>
        <p>{{ $carpeta['description'] }}</p>

        <div class="pdf-grid">
            @foreach ($carpeta['pdfs'] as $pdf)
                <a href="{{ asset($pdf) }}" target="_blank" class="pdf-card">
                    <span class="pdf-card__title">
                        {{ basename($pdf) }}
                    </span>
                    <img src="{{ asset('images/download.png') }}" alt="Descargar PDF" class="pdf-card__icon">
                </a>
            @endforeach
        </div>
    </div>
@endsection
