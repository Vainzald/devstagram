<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20',
            'not_in:twitter,editar-perfil'],
            'email' => ['required','unique:users,email,'.auth()->user()->id,'max:60'],
            'password' => ['required','confirmed','min:5']
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid(). "." . $imagen->extension();
    
            $imageServidor = Image::make($imagen);
            $imageServidor->fit(1000,1000);
    
            $imagenPath = public_path('perfiles'). '/' . $nombreImagen;
            $imageServidor->save($imagenPath);
        }

        //Guardar Cambios 

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);

        $usuario->save();

        auth()->attempt($request->only('email','password'));

        return redirect()->route('posts.index', $usuario->username);
    }

}