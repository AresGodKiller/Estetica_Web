@extends('layouts.app')
@section('title', 'Página no encontrada')

@section('content')
    <div class="flex flex-col items-center justify-center py-24 text-center">
        <p class="text-6xl mb-4"></p>
        <h2 class="text-2xl font-bold text-[#2C2020] mb-2">Página no encontrada</h2>
        <p class="text-gray-500 mb-6">La página que buscas no existe.</p>
        <a href="{{ route('dashboard') }}"
           class="bg-[#B5517A] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#9e4169] transition">
            Regresar al inicio
        </a>
    </div>
@endsection