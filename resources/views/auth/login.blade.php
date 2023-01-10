@extends('layouts.app')
@section('titulo')
    Inicio de Sesión en DevStagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen registro">
        </div>
        <div class="md:w-4/12 bg-gray-100 p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ session('mensaje') }} </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu Email"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Tu Contraseña"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5 font-bold">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Mantener mi sesión abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
