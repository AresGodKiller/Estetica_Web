@extends('layouts.admin')
@section('title', 'Nuevo Servicio')

@section('content')
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Nuevo Servicio</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-xl p-3 mb-4 text-sm">
                @foreach ($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.servicios.store') }}"
              class="bg-white rounded-2xl shadow-sm p-8 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">{{ old('descripcion') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Precio ($)</label>
                    <input type="number" name="precio" value="{{ old('precio') }}" step="0.01" min="0" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Duración (minutos)</label>
                    <input type="number" name="duracion_minutos" value="{{ old('duracion_minutos') }}" min="1" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="activo" id="activo" value="1"
                    {{ old('activo', '1') ? 'checked' : '' }} class="rounded">
                <label for="activo" class="text-sm text-gray-700">Servicio activo</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-[#B5517A] text-white px-8 py-2 rounded-full font-semibold hover:bg-[#9e4169] transition">
                    Guardar
                </button>
                <a href="{{ route('admin.servicios.index') }}"
                   class="border border-gray-300 px-6 py-2 rounded-full text-sm text-gray-600 hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection