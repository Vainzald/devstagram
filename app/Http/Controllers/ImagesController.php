<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function store(Request $request) {
        $input = $request->all();
        
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid(). "." . $imagen->extension();

        $imageServidor = Image::make($imagen);
        $imageServidor->fit(1000,1000);

        $imagenPath = public_path('uploads'). '/' . $nombreImagen;
        $imageServidor->save($imagenPath);

        return response()->json(['image' => $nombreImagen]);
    }
}
