@extends('layouts.app')
@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection
@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store', auth()->user()) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" name="username" id="username" placeholder="Tu nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de Perfil</label>
                    <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .gif"
                        class="border p-3 w-full rounded-l">
                </div>
                <input type="submit" value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
