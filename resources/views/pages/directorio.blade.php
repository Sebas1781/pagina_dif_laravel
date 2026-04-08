@extends('layouts.app')
@section('title', 'DIF Tecámac - Directorio')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/images/directorio.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute bottom-10 right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden"><i class="fas fa-map-location-dot mr-2"></i>DIRECTORIO</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">Directorio</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">Encuentra la sede más cercana con sus horarios y servicios disponibles.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- DIRECTORY CARDS --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($directorioItems as $i => $dir)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="bg-gradient-to-r {{ $dir->color_gradiente }} p-6 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-pattern opacity-10"></div>
                    <div class="relative z-10 flex items-start gap-4">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center shrink-0">
                            <i class="fas {{ $dir->icono }} text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-lg leading-tight">{{ $dir->nombre }}</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3 mb-5">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-dif-pink mt-1 shrink-0"></i>
                            <span class="text-sm text-gray-600">{{ $dir->direccion }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-dif-pink mt-1 shrink-0"></i>
                            <span class="text-sm text-gray-600">{{ $dir->horario }}</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-3">Servicios principales:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(($dir->servicios ?? []) as $service)
                            <span class="text-xs bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg border border-gray-100 hover:bg-dif-cream hover:text-dif-pink hover:border-dif-pink/30 transition-colors cursor-default">{{ $service }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CONTACT CTA --}}
<section class="py-20 bg-dif-cream bg-pattern">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center scroll-scale">
        <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">
            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-dif-pink to-dif-magenta rounded-2xl flex items-center justify-center mb-6 shadow-lg animate-pulse-glow">
                <i class="fas fa-phone text-white text-3xl"></i>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-dif-dark mb-4">¿Necesitas más información?</h2>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto">Acude a cualquiera de nuestras sedes o contáctanos a través de nuestras redes sociales. Estamos para servirte.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://www.facebook.com/profile.php?id=100069002108088" class="inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:scale-105 transition-all duration-300">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>

            </div>
        </div>
    </div>
</section>

@endsection
