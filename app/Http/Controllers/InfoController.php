<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InfoController extends Controller
{
    public function show($nombre)
    {
        // Ruta al archivo JSON (ajusta si necesario)
        $json = File::get(public_path('data/repositorio.json'));
        $records = json_decode($json, true);

        // Buscar por nombre (case sensitive)
        $info = collect($records)->firstWhere('nombre', urldecode($nombre));

        if (!$info) {
            abort(404, 'Herramienta no encontrada');
        }

        return view('infoCard', compact('info'));
    }
}
