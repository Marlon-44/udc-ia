<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/repositorio', function () {
    return view('repositorio');
});
