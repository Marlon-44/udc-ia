<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InfoController extends Controller
{
    public function show($nombre)
    {
        $json = File::get(public_path('data/repositorio.json'));
        $records = json_decode($json, true);
        $info = collect($records)->first(function ($item) use ($nombre) {
            return strtolower($item['nombre']) === strtolower(urldecode($nombre));
        });

        // Convertir el video a embebido
        if (!empty($info['video'])) {
            $info['video_embed'] = $this->getYoutubeEmbed($info['video']);
        }

        return view('infoCard', compact('info'));
    }

    private function getYoutubeEmbed($url)
    {
        if (strpos($url, 'youtu.be/') !== false) {
            $id = substr($url, strrpos($url, '/') + 1);
        } elseif (preg_match('/v=([^&]+)/', $url, $matches)) {
            $id = $matches[1];
        } else {
            $id = $url;
        }
        return 'https://www.youtube.com/embed/' . $id;
    }
}
