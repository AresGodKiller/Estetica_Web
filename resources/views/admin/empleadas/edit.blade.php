@extends('layouts.admin')
@section('title', 'Editar Empleada')

@section('content')
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Editar Empleada</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-xl p-3 mb-4 text-sm">
                @foreach ($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.empleadas.update', $empleada) }}"
              class="bg-white rounded-2xl shadow-sm p-8 space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $empleada->nombre) }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido', $empleada->apellido) }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $empleada->telefono) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Servicios que ofrece</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($servicios as $servicio)
                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                        <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                            {{ in_array($servicio->id, old('servicios', $empleada->servicios->pluck('id')->toArray())) ? 'checked' : '' }}
                            class="rounded text-[#B5517A]">
                        {{ $servicio->nombre }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-[#B5517A] text-white px-8 py-2 rounded-full font-semibold hover:bg-[#9e4169] transition">
                    Actualizar
                </button>
                <a href="{{ route('admin.empleadas.index') }}"
                   class="border border-gray-300 px-6 py-2 rounded-full text-sm text-gray-600 hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection