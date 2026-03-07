<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — DIF Tecámac</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside class="w-64 flex-shrink-0 bg-dif-pink-dark flex flex-col shadow-xl">
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
                <img src="/images/logo-dif.png" alt="DIF Tecámac" class="h-10 w-auto brightness-0 invert">
                <div>
                    <p class="text-white font-bold text-sm leading-tight">DIF Tecámac</p>
                    <p class="text-white/60 text-xs">Panel de Administrador</p>
                </div>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-chart-line w-4 text-center"></i>
                    Dashboard
                </a>

                <p class="px-4 pt-4 pb-1 text-xs font-semibold text-white/30 uppercase tracking-widest">Contenido</p>

                <a href="{{ route('admin.boletines.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.boletines.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-newspaper w-4 text-center"></i>
                    Boletines
                </a>

                <p class="px-4 pt-4 pb-1 text-xs font-semibold text-white/30 uppercase tracking-widest">Educación y Cultura</p>

                <a href="{{ route('admin.casas_cultura.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.casas_cultura.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-landmark w-4 text-center"></i>
                    Casas de Cultura
                </a>

                <a href="{{ route('admin.bibliotecas.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.bibliotecas.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-book-open w-4 text-center"></i>
                    Bibliotecas
                </a>

                <a href="{{ route('admin.estancias_infantiles.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.estancias_infantiles.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-child w-4 text-center"></i>
                    Estancias Infantiles
                </a>

                <a href="{{ route('admin.eventos_culturales.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.eventos_culturales.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-star w-4 text-center"></i>
                    Eventos Culturales
                </a>
                {{-- Aquí se agregarán más secciones --}}
            </nav>

            {{-- Footer sidebar --}}
            <div class="px-4 py-4 border-t border-white/10">
                <div class="flex items-center gap-3 px-3 py-2 mb-2">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-user text-white text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-white/50 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-white/70 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-right-from-bracket w-4 text-center"></i>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Top bar --}}
            <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between flex-shrink-0">
                <h1 class="text-lg font-semibold text-dif-dark">@yield('page-title', 'Dashboard')</h1>
                <span class="text-xs text-gray-400">{{ now()->format('d/m/Y') }}</span>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>
