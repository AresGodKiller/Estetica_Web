@extends('layouts.admin')
@section('title', 'Gestión de Servicios')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#2C2020]">Servicios</h2>
        <a href="{{ route('admin.servicios.create') }}"
           class="bg-[#B5517A] text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-[#9e4169] transition">
            + Agregar Servicio
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 rounded-xl p-3 mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-[#F9E8F2] text-[#B5517A] font-semibold">
                <tr>
                    <th class="text-left px-5 py-3">Servicio</th>
                    <th class="text-left px-5 py-3">Descripción</th>
                    <th class="text-left px-5 py-3">Precio</th>
                    <th class="text-left px-5 py-3">Duración</th>
                    <th class="text-left px-5 py-3">Estado</th>
                    <th class="text-left px-5 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($servicios as $servicio)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 font-medium">{{ $servicio->nombre }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ Str::limit($servicio->descripcion, 40) }}</td>
                    <td class="px-5 py-3">${{ number_format($servicio->precio, 0) }}</td>
                    <td class="px-5 py-3">{{ $servicio->duracionFormateada() }}</td>
                    <td class="px-5 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            {{ $servicio->activo ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $servicio->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 flex gap-2">
                        <a href="{{ route('admin.servicios.edit', $servicio) }}"
                           class="text-xs border border-gray-300 px-3 py-1 rounded-full hover:bg-gray-100 transition">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('admin.servicios.destroy', $servicio) }}">
                            @csrf @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('¿Eliminar este servicio?')"
                                class="text-xs border border-red-300 text-red-500 px-3 py-1 rounded-full hover:bg-red-50 transition">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-gray-400">No hay servicios registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection