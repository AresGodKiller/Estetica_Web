<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Estética Jazmín'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen bg-[#F5F5F5]">

    <nav class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

            <a href="{{ route('dashboard') }}"
               class="text-2xl font-bold text-[#B5517A]" style="font-family: 'Playfair Display', serif;">
                Estética Jazmín
            </a>

            <div class="flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="{{ route('dashboard') }}"
                   class="hover:text-[#B5517A] {{ request()->routeIs('dashboard') ? 'text-[#B5517A]' : '' }}">
                   Inicio
                </a>
                <a href="{{ route('servicios.index') }}"
                   class="hover:text-[#B5517A] {{ request()->routeIs('servicios.*') ? 'text-[#B5517A]' : '' }}">
                   Servicios
                </a>
                <a href="{{ route('citas.index') }}"
                   class="hover:text-[#B5517A] {{ request()->routeIs('citas.*') ? 'text-[#B5517A]' : '' }}">
                   Mis Citas
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-[#B5517A] text-white px-4 py-1.5 rounded-full hover:bg-[#9e4169] transition text-sm">
                        Cerrar Sesión
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>