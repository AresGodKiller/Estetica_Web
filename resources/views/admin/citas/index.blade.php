@extends('layouts.admin')
@section('title', 'Gestión de Empleadas')

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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @forelse ($empleadas as $empleada)
        <div class="bg-white rounded-2xl shadow-sm p-6 {{ !$empleada->activo ? 'opacity-60' : '' }}">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-[#F9E8F2] flex items-center justify-center text-xl font-bold text-[#B5517A]">
                    {{ strtoupper(substr($empleada->nombre, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-[#2C2020]">
                        {{ $empleada->nombreCompleto() }}
                        @if (!$empleada->activo)
                            <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full ml-1">Inactiva</span>
                        @endif
                    </p>
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
                @if ($empleada->activo)
                    <a href="{{ route('admin.empleadas.edit', $empleada) }}"
                       class="flex-1 text-center text-xs border border-gray-300 px-3 py-1.5 rounded-full hover:bg-gray-100 transition">
                        Editar
                    </a>
                @endif

                <form method="POST" action="{{ route('admin.empleadas.destroy', $empleada) }}">
                    @csrf @method('DELETE')
                    @if ($empleada->activo)
                        @php $tieneCitas = $empleada->citas()->count() > 0; @endphp
                        <button type="submit"
                            onclick="return confirm('{{ $tieneCitas ? '¿Desactivar esta empleada? Tiene citas registradas y no puede eliminarse.' : '¿Eliminar esta empleada? Esta acción no se puede deshacer.' }}')"
                            class="text-xs border border-red-300 text-red-500 px-3 py-1.5 rounded-full hover:bg-red-50 transition">
                            {{ $tieneCitas ? 'Desactivar' : 'Eliminar' }}
                        </button>
                    @else
                        <span class="text-xs text-gray-400 px-3 py-1.5">Inactiva</span>
                    @endif
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-400 py-10">No hay empleadas registradas</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $citas->links() }}</div>

@endsection
