@extends('layouts.app')
@section('title', 'Mis Citas')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#2C2020]">Mis Citas</h2>
        <a href="{{ route('citas.create') }}"
           class="bg-[#B5517A] text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-[#9e4169] transition">
            + Nueva Cita
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 rounded-xl p-3 mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($citas->isEmpty())
        <div class="bg-white rounded-xl shadow-sm p-10 text-center text-gray-400">
            <p class="text-4xl mb-3"></p>
            <p>No tienes citas agendadas aún.</p>
            <a href="{{ route('citas.create') }}" class="text-[#B5517A] font-medium hover:underline mt-2 inline-block">
                Agenda tu primera cita
            </a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-[#F9E8F2] text-[#B5517A] font-semibold">
                    <tr>
                        <th class="text-left px-5 py-3">Fecha</th>
                        <th class="text-left px-5 py-3">Hora</th>
                        <th class="text-left px-5 py-3">Servicio</th>
                        <th class="text-left px-5 py-3">Estilista</th>
                        <th class="text-left px-5 py-3">Estado</th>
                        <th class="text-left px-5 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($citas as $cita)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3">{{ $cita->fecha->format('d/m/Y') }}</td>
                        <td class="px-5 py-3">{{ $cita->hora_inicio }}</td>
                        <td class="px-5 py-3">{{ $cita->servicio->nombre }}</td>
                        <td class="px-5 py-3">{{ $cita->empleada->nombreCompleto() }}</td>
                        <td class="px-5 py-3">
                            @php
                                $colores = [
                                    'confirmada' => 'bg-green-100 text-green-700',
                                    'pendiente'  => 'bg-amber-100 text-amber-700',
                                    'cancelada'  => 'bg-red-100 text-red-700',
                                    'completada' => 'bg-blue-100 text-blue-700',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $colores[$cita->estado] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                        <td class="px-5 py-3 flex gap-2">
                            @if ($cita->estado === 'pendiente')
                                <a href="{{ route('citas.edit', $cita) }}"
                                   class="text-xs border border-gray-300 px-3 py-1 rounded-full hover:bg-gray-100 transition">
                                    Modificar
                                </a>
                                <form method="POST" action="{{ route('citas.destroy', $cita) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('¿Cancelar esta cita?')"
                                        class="text-xs border border-red-300 text-red-500 px-3 py-1 rounded-full hover:bg-red-50 transition">
                                        Cancelar
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection