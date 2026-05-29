@extends('layouts.app')
@section('title', 'Servicios')

@section('content')

    <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Nuestros Servicios</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($servicios as $servicio)
        <div class="bg-white rounded-2xl shadow-sm p-6 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <p class="text-3xl mb-3"></p>
                <h3 class="text-lg font-semibold text-[#2C2020]">{{ $servicio->nombre }}</h3>
                <p class="text-gray-500 text-sm mt-1">{{ $servicio->descripcion }}</p>
            </div>
            <div class="mt-4 flex items-center justify-between">
                <div>
                    <p class="text-[#B5517A] font-bold text-xl">${{ number_format($servicio->precio, 0) }}</p>
                    <p class="text-gray-400 text-xs">{{ $servicio->duracionFormateada() }}</p>
                </div>
                <a href="{{ route('citas.create') }}?servicio={{ $servicio->id }}"
                   class="bg-[#B5517A] text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-[#9e4169] transition">
                    Agendar
                </a>
            </div>
        </div>
        @endforeach
    </div>

@endsection