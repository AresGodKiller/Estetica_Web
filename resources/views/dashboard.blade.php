@extends('layouts.app')
@section('title', 'Inicio — Estética Jazmín')

@section('content')

    <!-- Hero -->
    <div class="bg-[#B5517A] rounded-2xl text-white text-center py-16 px-8 mb-10">
        <h2 class="text-4xl font-bold mb-2" style="font-family: 'Playfair Display', serif;">
            Hola, {{ Auth::user()->nombre }} 👋
        </h2>
        <p class="text-pink-100 mb-6">Tu mejor versión comienza aquí</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('citas.create') }}"
               class="bg-white text-[#B5517A] font-semibold px-6 py-2 rounded-full hover:bg-pink-50 transition">
                Agendar Cita
            </a>
            <a href="{{ route('servicios.index') }}"
               class="border border-white text-white font-semibold px-6 py-2 rounded-full hover:bg-white hover:text-[#B5517A] transition">
                Ver Servicios
            </a>
        </div>
    </div>

    <!-- Servicios destacados -->
    <h3 class="text-xl font-semibold text-[#2C2020] mb-4">Nuestros Servicios</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($servicios as $servicio)
        <div class="bg-white rounded-xl shadow-sm p-5 text-center hover:shadow-md transition">
            <p class="text-2xl mb-2">✂️</p>
            <p class="font-semibold text-[#2C2020]">{{ $servicio->nombre }}</p>
            <p class="text-[#B5517A] font-bold mt-1">${{ number_format($servicio->precio, 0) }}</p>
            <p class="text-gray-400 text-xs mt-1">{{ $servicio->duracionFormateada() }}</p>
        </div>
        @endforeach
    </div>

@endsection