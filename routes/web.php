<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/info/{nombre}', [InfoController::class, 'show'])->name('info.show');

Route::get('/repositorio', function () {
    return view('repositorio');
});

Route::get('/carpetas', function () {
    return view('carpetasPdf');
});

Route::get('/pdfs/{id}', [PdfController::class, 'show'])->name('pdfs.show');

Route::get('/colaboradores', function () {
    return view('colaboradores');
});

