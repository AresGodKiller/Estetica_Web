<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Estética Jazmín</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F5F5F5] flex">

    <aside class="w-56 min-h-screen bg-white shadow-sm flex flex-col fixed">
        <div class="px-6 py-5 border-b">
            <h1 class="text-lg font-bold text-[#B5517A]" style="font-family: 'Playfair Display', serif;">
                Jazmín Admin
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
            <p class="text-xs text-gray-400 mb-2">{{ Auth::user()->nombreCompleto() }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-gray-500 hover:text-[#B5517A] w-full text-left">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 ml-56 p-8">
        @yield('content')
    </div>

</body>
</html>
