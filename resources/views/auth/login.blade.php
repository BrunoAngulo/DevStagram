@extends('layouts.app')
@section('titulo')
    Inicia Sesion en DevStagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-4/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen login usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje')}}</p>
                @endif
                <div class="mb-5">
                    <label id="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label id="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember"><label class="text-gray-500 text-sm ">Mantener mi sesión abierta</label>
                </div>
                <input 
                    type="submit"
                    value="Iniciar cuenta"
                    class="bg-sky-600 hover:bg-sky-700 uppercase font-bold w-full p-3 text-white rounded-lg"
                    />
            </form>
        </div>
    </div>
@endsection