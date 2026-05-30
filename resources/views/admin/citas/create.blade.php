@extends('layouts.admin')
@section('title', 'Nueva Cita')

@section('content')
    <div class="max-w-2xl mx-auto">

        <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Nueva Cita</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-xl p-3 mb-4 text-sm">
                @foreach ($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.citas.store') }}"
              class="bg-white rounded-2xl shadow-sm p-8 space-y-5">
            @csrf

            <!-- Tipo de cliente -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo de cliente</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_cliente" value="existente"
                               id="tipo_existente"
                               class="text-[#B5517A]"
                               {{ old('tipo_cliente', 'existente') === 'existente' ? 'checked' : '' }}
                               onchange="toggleCliente()">
                        <span class="text-sm text-gray-700">Cliente existente</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_cliente" value="nuevo"
                               id="tipo_nuevo"
                               class="text-[#B5517A]"
                               {{ old('tipo_cliente') === 'nuevo' ? 'checked' : '' }}
                               onchange="toggleCliente()">
                        <span class="text-sm text-gray-700">Cliente nuevo</span>
                    </label>
                </div>
            </div>

            <!-- Cliente existente -->
            <div id="seccion_existente" class="{{ old('tipo_cliente') === 'nuevo' ? 'hidden' : '' }}">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar cliente</label>
                <select name="user_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                    <option value="">Selecciona un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('user_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombreCompleto() }} — {{ $cliente->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Cliente nuevo -->
            <div id="seccion_nuevo" class="{{ old('tipo_cliente') === 'nuevo' ? '' : 'hidden' }} space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                            placeholder="María">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Apellido</label>
                        <input type="text" name="apellido" value="{{ old('apellido') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                            placeholder="García">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                        placeholder="correo@ejemplo.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                        placeholder="449 123 4567">
                </div>
            </div>

            <!-- Servicio -->
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

            <!-- Estilista -->
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

            <!-- Fecha -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha') }}"
                    min="{{ date('Y-m-d') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
            </div>

            <!-- Hora -->
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

            <!-- Notas -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Notas (opcional)</label>
                <textarea name="notas" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                    placeholder="Indicaciones especiales...">{{ old('notas') }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-[#B5517A] text-white px-8 py-2 rounded-full font-semibold hover:bg-[#9e4169] transition">
                    Crear Cita
                </button>
                <a href="{{ route('admin.citas.index') }}"
                   class="border border-gray-300 px-6 py-2 rounded-full text-sm text-gray-600 hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        function toggleCliente() {
            const esNuevo = document.getElementById('tipo_nuevo').checked;
            document.getElementById('seccion_existente').classList.toggle('hidden', esNuevo);
            document.getElementById('seccion_nuevo').classList.toggle('hidden', !esNuevo);
        }
    </script>

@endsection