<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index () 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);

        // dd($request->get('name'));
        $request->request->add(['username'=>Str::slug($request->username)]);


        $this->validate($request,[
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:5',
            
            
        ]);

        User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        //Autenticar a un usuario

        // auth()->attempt([
        //     'email'=> $request->email,
        //     'password'=>$request->password,
        // ]);

        //Otra forma de autenticar al usuario

        auth()->attempt($request->only('email','password'));

        

        return redirect()->route('home');
        
    }
}
