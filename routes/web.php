<?php

use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;

Route::get('/info/{nombre}', [InfoController::class, 'show'])->name('info.show');

Route::get('/', function () {
    return view('repositorio');
});
