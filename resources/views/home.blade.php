@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    
    @auth
        {{-- <x-listar-post>
            <h1>Mostrando post desde Slots</h1>
            @slot('titulo')
                <header>Esto es un header</header>
            @endslot
        </x-listar-post> --}}
        <x-listar-post :posts="$posts"/>
       
        
    @endauth

    

@endsection