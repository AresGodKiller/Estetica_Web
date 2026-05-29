@extends('layouts.admin')
@section('title', 'Citas')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#2C2020]">Todas las Citas</h2>
        <div class="flex gap-2">
            @foreach (['todas', 'pendiente', 'confirmada', 'completada', 'cancelada'] as $filtro)
            <a href="{{ route('admin.citas.index', ['estado' => $filtro]) }}"
               class="text-xs px-3 py-1.5 rounded-full border transition
                      {{ request('estado', 'todas') === $filtro ? 'bg-[#B5517A] text-white border-[#B5517A]' : 'border-gray-300 hover:bg-gray-100' }}">
                {{ ucfirst($filtro) }}
            </a>
            @endforeach
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 rounded-xl p-3 mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-[#F9E8F2] text-[#B5517A] font-semibold">
                <tr>
                    <th class="text-left px-5 py-3">Fecha</th>
                    <th class="text-left px-5 py-3">Cliente</th>
                    <th class="text-left px-5 py-3">Servicio</th>
                    <th class="text-left px-5 py-3">Estilista</th>
                    <th class="text-left px-5 py-3">Hora</th>
                    <th class="text-left px-5 py-3">Estado</th>
                    <th class="text-left px-5 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($citas as $cita)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">{{ $cita->fecha->format('d/m/Y') }}</td>
                    <td class="px-5 py-3">{{ $cita->user->nombreCompleto() }}</td>
                    <td class="px-5 py-3">{{ $cita->servicio->nombre }}</td>
                    <td class="px-5 py-3">{{ $cita->empleada->nombreCompleto() }}</td>
                    <td class="px-5 py-3">{{ $cita->hora_inicio }}</td>
                    <td class="px-5 py-3">
                        @php
                            $colores = [
                                'confirmada' => 'bg-green-100 text-green-700',
                                'pendiente'  => 'bg-amber-100 text-amber-700',
                                'cancelada'  => 'bg-red-100 text-red-700',
                                'completada' => 'bg-blue-100 text-blue-700',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $colores[$cita->estado] ?? '' }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </td>
                    <td class="px-5 py-3">
                        <form method="POST" action="{{ route('admin.citas.estado', $cita) }}" class="flex gap-1">
                            @csrf @method('PATCH')
                            @if ($cita->estado === 'pendiente')
                                <button name="estado" value="confirmada"
                                    class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full hover:bg-green-200 transition">
                                    ✓ Confirmar
                                </button>
                                <button name="estado" value="cancelada"
                                    class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full hover:bg-red-200 transition">
                                    ✗ Cancelar
                                </button>
                            @elseif ($cita->estado === 'confirmada')
                                <button name="estado" value="completada"
                                    class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full hover:bg-blue-200 transition">
                                    ✓ Completar
                                </button>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-8 text-center text-gray-400">No hay citas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $citas->links() }}</div>

@endsection
