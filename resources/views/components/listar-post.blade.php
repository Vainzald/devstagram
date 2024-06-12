<div>
    {{-- {{$slot}}
    {{$titulo}} --}}
    @if ($posts->count())
            

        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 " >
            
            {{-- Otra forma de poder hacer el query es, gracias a la relacion de user con post, no necesariamente, 
                tiene que esperar como argumento posts, solo el usuario la coleccion padre, 
                que seria de la seguiente manera $user->posts() --}}
            @foreach ($posts as $post )
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div>
            {{ $posts->links() }}
        </div>
        @else
            <p class=" text-gray-600 uppercase text-sm text-center font-bold ">No hay posts</p>

        @endif
</div>