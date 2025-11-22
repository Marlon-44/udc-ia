<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PdfController extends Controller
{
    public function show($id)
    {
        // 1. Leer JSON
        $json = File::get(public_path('data/carpetasPdf.json'));
        $carpetas = json_decode($json, true);

        // 2. Verificar que exista
        if (!isset($carpetas[$id])) {
            abort(404, "Carpeta no encontrada");
        }

        // 3. Seleccionar carpeta por ID
        $carpeta = $carpetas[$id];

        // 4. Retornar vista
        return view('pdfs', compact('carpeta'));
    }
}
