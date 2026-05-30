<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin — Estetica Jazmin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F5F5F5] flex">

    <aside class="w-56 min-h-screen bg-white shadow-sm flex flex-col">
        <div class="px-6 py-5 border-b">
            <h1 class="text-lg font-bold text-[#B5517A]" style="font-family: 'Playfair Display', serif;">
                Jazmin Admin
            </h1>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1 text-sm font-medium text-gray-600">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-[#F9E8F2] text-[#B5517A]' : 'hover:bg-gray-100' }}">
               Panel
            </a>
            <a href="{{ route('admin.citas.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.citas.*') ? 'bg-[#F9E8F2] text-[#B5517A]' : 'hover:bg-gray-100' }}">
               Citas
            </a>
            <a href="{{ route('admin.servicios.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.servicios.*') ? 'bg-[#F9E8F2] text-[#B5517A]' : 'hover:bg-gray-100' }}">
               Servicios
            </a>
            <a href="{{ route('admin.empleadas.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.empleadas.*') ? 'bg-[#F9E8F2] text-[#B5517A]' : 'hover:bg-gray-100' }}">
               Empleadas
            </a>
        </nav>
        <div class="px-4 py-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-gray-500 hover:text-[#B5517A] w-full text-left">
                    Cerrar Sesion
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 p-8">

        <h2 class="text-2xl font-bold text-[#2C2020] mb-6">Panel de Administrador</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @foreach ([
                ['label' => 'Citas hoy',   'valor' => $citasHoy,     'color' => 'bg-[#B5517A]'],
                ['label' => 'Pendientes',  'valor' => $pendientes,   'color' => 'bg-amber-500'],
                ['label' => 'Ingresos hoy','valor' => '$'.$ingresos, 'color' => 'bg-green-600'],
                ['label' => 'Estilistas',  'valor' => $estilistas,   'color' => 'bg-blue-500'],
            ] as $card)
            <div class="bg-white rounded-xl shadow-sm p-5">
                <p class="text-sm text-gray-500 mb-1">{{ $card['label'] }}</p>
                <p class="text-3xl font-bold {{ str_replace('bg-', 'text-', $card['color']) }}">
                    {{ $card['valor'] }}
                </p>
            </div>
            @endforeach
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-semibold text-[#2C2020]">Citas de Hoy</h3>
                <a href="{{ route('admin.citas.create') }}"
                   class="bg-[#B5517A] text-white px-4 py-1.5 rounded-full text-sm hover:bg-[#9e4169] transition">
                    + Nueva Cita
                </a>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-[#F9E8F2] text-[#B5517A] font-semibold">
                    <tr>
                        <th class="text-left px-5 py-3">Cliente</th>
                        <th class="text-left px-5 py-3">Servicio</th>
                        <th class="text-left px-5 py-3">Estilista</th>
                        <th class="text-left px-5 py-3">Hora</th>
                        <th class="text-left px-5 py-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($citas as $cita)
                    <tr class="hover:bg-gray-50">
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-gray-400">
                            No hay citas para hoy
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>