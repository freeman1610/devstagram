@extends('layouts.app')
@section('titulo')
    {{ $post->titulo }}
@endsection
@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3 flex items-center gap-4">
                @auth

                    <livewire:like-post :post="$post" />

                @endauth
            </div>
            <div>
                <p class="font-bold">
                    <a href="{{ route('posts.index', $post->user->username) }}">{{ $post->user->username }}</a>
                    <span class="font-normal">
                        {{ $post->descripcion }}
                    </span>
                </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar Publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2">
            @auth
                <div class="shadow bg-white p-5 mb-5">
                    <p class="text-xl font-bold text-center mb-4">Agregar un Nuevo Comentario</p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('commentary.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="commentary" class="mb-2 block uppercase text-gray-500 font-bold">Añade un
                                Comentario</label>
                            <textarea class="border p-3 w-full rounded-lg @error('comentario')  border-red-500 @enderror"
                                placeholder="Agregar un Comentario" name="commentary" id="commentary"></textarea>
                            @error('commentary')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                            @enderror
                            <input type="submit" value="Comentar"
                                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                        </div>
                    </form>
                </div>
            @endauth
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                @if ($post->commentary->count())
                    @foreach ($post->commentary as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <p>
                                <a href="{{ route('posts.index', $comentario->user) }}">
                                    <span class="font-bold">{{ $comentario->user->username }}</span>
                                </a>
                                {{-- {{ $comentario->user }} --}}
                                <span class="">{{ $comentario->commentary }}</span>

                            </p>
                            <span class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</span>

                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center">No Hay Comentarios</p>
                @endif
            </div>
        </div>
    </div>
@endsection
