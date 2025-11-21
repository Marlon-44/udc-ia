<?php

use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/info/{nombre}', [InfoController::class, 'show'])->name('info.show');

Route::get('/repositorio', function () {
    return view('repositorio');
});

Route::get('/herramientas', function () {
    return view('herramientas');
});

Route::get('/herramientas/{nombre}', function () {
    return view('about');
});
