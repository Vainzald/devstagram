@extends('layouts.app')

@section('titulo')
    Inicia Sesion en DevStagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center mb-10 md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf 
                
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white rounded-lg text-sm py-2 text-center ">
                        
                        {{session('mensaje')}}    
                    </p>
                @endif
                    

                    <div class="mb-5">
                        <label for="mail" id="name" class="mb-2 block uppercase text-gray-500 font-bold">
                            Correo
                        </label>
                        <input 
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Tu Correo"
                            class="border p-3 w-full rounded-lg"
                            @error('email')
                                border-red-500
                            @enderror                        
                            "
                            value="{{old('email')}}"
    
                        />
                        @error('email')
                        <p class="bg-red-500 text-white rounded-lg text-sm py-2 text-center ">
                            {{$message}}    
                        </p>
                    @enderror
                    </div>
                
                <div class="mb-5">
                    <label for="password" id="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input 
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu Contraseña"
                        class="border p-3 w-full rounded-lg"
                        @error('password')
                            border-red-500
                        @enderror                        
                        "
                        value="{{old('password')}}"
                        
                        />

                        @error('password')
                        <p class="bg-red-500 text-white rounded-lg text-sm py-2 text-center ">
                        {{$message}}    
                        </p>
                        @enderror

                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm" for="remember">Mantener mi sesion abierta</label>
                </div>
                
                <input 
                    type="submit"
                    value="Iniciar Sesion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                     uppercase font-bold w-full p-3 text-white rounded-lg
                    "
                />


            </form>
        </div>

    </div>

@endsection