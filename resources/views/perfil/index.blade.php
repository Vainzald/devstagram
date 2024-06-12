@extends('layouts.app')

@section('titulo')

    Editar Perfil: {{ auth()->user()->username }}

@endsection


@section('contenido')

    <div class="md:flex md:justify-center rounded md:flex-row">
        <div class="md:w-1/2 bg-white shadow p-6 rounded">
            <form  method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>
                    <input 
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg
                        @error('name')
                            border-red-500
                        @enderror                        
                        "
                        value="{{ auth()->user()->username }}"

                    />
                </div>
                @error('username')
                    <p class="bg-red-500 text-white rounded-lg text-sm py-2 text-center ">
                        {{$message}}    
                    </p>
                @enderror

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input 
                        type="file"
                        id="imagen"
                        name="imagen"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"

                    />
                </div>

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
                        value="{{auth()->user()->email}}"

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
                        placeholder="Tu Nueva Contraseña"
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
                    <label for="password_confirmation" id="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input 
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repetir Nueva Contraseña"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                
                <input 
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                     uppercase font-bold w-full p-3 text-white rounded-lg
                    "
                />
            </form>
           
        </div>
      
    </div>

@endsection

