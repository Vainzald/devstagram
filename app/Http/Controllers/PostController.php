<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }
    
    public function index(User $user)
    {
        
        $post = Post::where('user_id', $user->id)->latest()->paginate(20);
       

        return view('dashboard', [
            'user' => $user,
            'posts' => $post
        ]);
    }

    public function create () {
        return view('posts.create');
    }

    public function store(Request $request) {
        //Creo que el this se refiere a que valida como el modelo que se le pasa
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'image'=> 'required',
            // 'user_id'=> auth()->user()->id
        ]);

        // Post::create([
        //     'titulo'=> $request->titulo,
        //     'descripcion'=> $request->descripcion,
        //     'image'=>$request->image,
        //     'user_id' => auth()->user()->id
        // ]);

        $request->user()->post()->create([
            'titulo'=> $request->titulo,
            'descripcion'=> $request->descripcion,
            'image'=>$request->image,
            'user_id' => auth()->user()->id
        ]); 

        return redirect()->route('posts.index', auth()->user()->username);

        
    }

    public function show(User $user ,Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    public function destroy(Post $post){
        $this->authorize('delete', $post);
        

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->image);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        $post->delete();

        return redirect()->route('posts.index', auth()->user()->username);
    }

   
}
