@extends('layouts.app')
@section('title', 'Modificar Cita')

@section('content')

    <div class="max-w-2xl mx-auto">

        <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Modificar Cita</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-xl p-3 mb-4 text-sm">
                @foreach ($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('citas.update', $cita) }}"
              class="bg-white rounded-2xl shadow-sm p-8 space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Servicio</label>
                <select name="servicio_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}" {{ $cita->servicio_id == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre }} — ${{ number_format($servicio->precio, 0) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estilista</label>
                <select name="empleada_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                    @foreach ($empleadas as $empleada)
                        <option value="{{ $empleada->id }}" {{ $cita->empleada_id == $empleada->id ? 'selected' : '' }}>
                            {{ $empleada->nombreCompleto() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ $cita->fecha->format('Y-m-d') }}"
                    min="{{ date('Y-m-d') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Hora</label>
                <div class="flex flex-wrap gap-2">
                    @foreach (['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'] as $hora)
                        <label class="cursor-pointer">
                            <input type="radio" name="hora_inicio" value="{{ $hora }}"
                                   class="hidden peer" {{ $cita->hora_inicio === $hora ? 'checked' : '' }}>
                            <span class="border border-gray-300 rounded-full px-4 py-1.5 text-sm
                                         peer-checked:bg-[#B5517A] peer-checked:text-white peer-checked:border-[#B5517A]
                                         hover:border-[#B5517A] transition">
                                {{ $hora }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-[#B5517A] text-white px-8 py-2 rounded-full font-semibold hover:bg-[#9e4169] transition">
                    Guardar Cambios
                </button>
                <a href="{{ route('citas.index') }}"
                   class="border border-gray-300 px-6 py-2 rounded-full text-sm text-gray-600 hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

@endsection