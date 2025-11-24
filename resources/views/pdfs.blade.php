@extends('layouts.app')

@section('title', $carpeta['name'] . ' | PDFs')

@section('content')
<div class="pdf-page">
    <h2 class="titulo">{{ $carpeta['name'] }}</h2>
    <p>{{ $carpeta['description'] }}</p>

    <ul class="pdf__list">
        @foreach ($carpeta['pdfs'] as $pdf)
        <li class="pdf">
            <a href="{{ asset($pdf) }}" target="_blank" >
                {{ basename($pdf) }}
                <img src="{{ asset('images/download.png') }}" alt="">
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection
