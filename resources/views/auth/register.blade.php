<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro — Estética Jazmín</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F9E8F2] flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-lg p-10 w-full max-w-lg">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#B5517A]" style="font-family: 'Playfair Display', serif;">
                Estética Jazmín
            </h1>
            <p class="text-gray-500 mt-1 text-sm">Crea tu cuenta</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-lg p-3 mb-4 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                        placeholder="María">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                        placeholder="García">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                    placeholder="449 123 4567">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                    placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                    placeholder="••••••••">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B5517A]"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-[#B5517A] text-white py-2 rounded-full font-semibold hover:bg-[#9e4169] transition">
                Crear Cuenta
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-[#B5517A] font-medium hover:underline">Inicia sesión</a>
        </p>

    </div>

</body>
</html>