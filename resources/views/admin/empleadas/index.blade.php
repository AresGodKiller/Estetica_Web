@extends('layouts.admin')
@section('title', 'Gestión de Empleadas')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#2C2020]">Empleadas</h2>
        <a href="{{ route('admin.empleadas.create') }}"
           class="bg-[#B5517A] text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-[#9e4169] transition">
            + Agregar Empleada
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 rounded-xl p-3 mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @forelse ($empleadas as $empleada)
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-[#F9E8F2] flex items-center justify-center text-xl font-bold text-[#B5517A]">
                    {{ strtoupper(substr($empleada->nombre, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-[#2C2020]">{{ $empleada->nombreCompleto() }}</p>
                    <p class="text-xs text-gray-400">{{ $empleada->telefono ?? 'Sin teléfono' }}</p>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-xs text-gray-500 font-medium mb-1">Servicios:</p>
                <div class="flex flex-wrap gap-1">
                    @forelse ($empleada->servicios as $s)
                        <span class="bg-[#F9E8F2] text-[#B5517A] text-xs px-2 py-0.5 rounded-full">{{ $s->nombre }}</span>
                    @empty
                        <span class="text-xs text-gray-400">Sin servicios asignados</span>
                    @endforelse
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.empleadas.edit', $empleada) }}"
                   class="flex-1 text-center text-xs border border-gray-300 px-3 py-1.5 rounded-full hover:bg-gray-100 transition">
                    Editar
                </a>
                <form method="POST" action="{{ route('admin.empleadas.destroy', $empleada) }}">
                    @csrf @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('¿Eliminar esta empleada?')"
                        class="text-xs border border-red-300 text-red-500 px-3 py-1.5 rounded-full hover:bg-red-50 transition">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-400 py-10">No hay empleadas registradas</div>
        @endforelse
    </div>

@endsection