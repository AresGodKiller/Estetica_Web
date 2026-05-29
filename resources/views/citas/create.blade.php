@extends('layouts.app')
@section('title', 'Agendar Cita')

@section('content')

    <div class="max-w-2xl mx-auto">

        <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Agendar Cita</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-xl p-3 mb-4 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('citas.store') }}"
              class="bg-white rounded-2xl shadow-sm p-8 space-y-5">
            @csrf

            <!-- Paso 1: Servicio -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Servicio</label>
                <select name="servicio_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                    <option value="">Selecciona un servicio</option>
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}" {{ old('servicio_id') == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre }} — ${{ number_format($servicio->precio, 0) }} ({{ $servicio->duracionFormateada() }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Paso 2: Estilista -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estilista</label>
                <select name="empleada_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                    <option value="">Selecciona una estilista</option>
                    @foreach ($empleadas as $empleada)
                        <option value="{{ $empleada->id }}" {{ old('empleada_id') == $empleada->id ? 'selected' : '' }}>
                            {{ $empleada->nombreCompleto() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Paso 3: Fecha -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha') }}"
                    min="{{ date('Y-m-d') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
            </div>

            <!-- Paso 4: Hora -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Hora</label>
                <div class="flex flex-wrap gap-2">
                    @foreach (['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'] as $hora)
                        <label class="cursor-pointer">
                            <input type="radio" name="hora_inicio" value="{{ $hora }}"
                                   class="hidden peer" {{ old('hora_inicio') == $hora ? 'checked' : '' }}>
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
                    Confirmar Cita
                </button>
                <a href="{{ route('citas.index') }}"
                   class="border border-gray-300 px-6 py-2 rounded-full text-sm text-gray-600 hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

@endsection