<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — Admin DIF Tecámac</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans min-h-screen flex items-center justify-center bg-gradient-to-br from-dif-pink-dark via-dif-pink to-dif-pink-light">

    <div class="w-full max-w-md px-4">
        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-dif-pink-dark px-8 py-8 text-center">
                <img src="/images/logo-dif.png" alt="DIF Tecámac" class="h-16 mx-auto mb-3 brightness-0 invert">
                <h1 class="text-white font-bold text-xl tracking-wide">DIF Tecámac</h1>
                <p class="text-white/60 text-sm mt-1">Panel de Administrador</p>
            </div>

            {{-- Form --}}
            <div class="px-8 py-8">
                <h2 class="text-dif-dark font-semibold text-lg mb-6 text-center">Iniciar sesión</h2>

                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-2">
                        <i class="fas fa-circle-exclamation mt-0.5 flex-shrink-0"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" novalidate>
                    @csrf

                    {{-- Email --}}
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Correo electrónico
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none">
                                <i class="fas fa-envelope text-sm"></i>
                            </span>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full pl-10 pr-4 py-2.5 border rounded-xl text-sm transition-colors duration-200
                                       focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                                       {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300 bg-gray-50' }}"
                                placeholder="admin@dif.gob.mx">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Contraseña
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 bg-gray-50 rounded-xl text-sm transition-colors duration-200
                                       focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent"
                                placeholder="••••••••">
                        </div>
                    </div>

                    {{-- Recordarme --}}
                    <div class="flex items-center mb-6">
                        <input id="remember" name="remember" type="checkbox"
                               class="w-4 h-4 accent-dif-pink rounded">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Recordarme</label>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-dif-pink text-white font-semibold rounded-xl shadow-md
                               hover:bg-dif-pink-dark transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-dif-pink focus:ring-offset-2">
                        Ingresar
                    </button>
                </form>
            </div>

        </div>

        <p class="text-center text-white/50 text-xs mt-6">© {{ date('Y') }} DIF Tecámac — Acceso restringido</p>
    </div>

</body>
</html>
