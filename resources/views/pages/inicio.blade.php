@extends('layouts.app')
@section('title', 'DIF Tecámac - Inicio')

@section('content')

{{-- ══════════════════════════════════════════════
     CARRUSEL PRINCIPAL (Vanilla JS)
══════════════════════════════════════════════ --}}
@if($slides->count())
<style>
    /* ── Carrusel animations ── */
    #carrusel-hero .slide {
        position: absolute; inset: 0;
        opacity: 0;
        transform: translateX(60px);
        transition: opacity 0.7s ease, transform 0.7s ease;
        z-index: 0;
        pointer-events: none;
    }
    #carrusel-hero .slide.active {
        opacity: 1;
        transform: translateX(0);
        z-index: 10;
        pointer-events: auto;
    }
    #carrusel-hero .slide.leaving {
        opacity: 0;
        transform: translateX(-60px);
        z-index: 5;
    }
    /* Title animation */
    @keyframes carruselTitleIn {
        from { transform: translateY(22px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }
    #carrusel-hero .slide.active .slide-title {
        animation: carruselTitleIn 0.65s 0.15s ease both;
    }
    /* Dot active */
    .dot-carrusel { width: 10px; height: 10px; border-radius: 9999px; background: rgba(255,255,255,0.45); transition: all 0.35s; cursor: pointer; border: none; }
    .dot-carrusel.active { width: 24px; background: #fff; }
</style>

<section class="relative w-full overflow-hidden bg-dif-pink-dark" style="height: clamp(360px, 70vw, 800px);" id="carrusel-hero">

    {{-- Slides --}}
    <div class="relative w-full h-full">
        @foreach($slides as $i => $slide)
            @php
                $enlace = $slide->archivo
                    ? asset('storage/' . $slide->archivo)
                    : ($slide->url ?: null);
                $target = $enlace ? '_blank' : null;
            @endphp
            <div class="slide {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">
                {{-- Si tiene enlace: toda la imagen es clickeable --}}
                @if($enlace)
                    <a href="{{ $enlace }}" target="{{ $target }}" rel="noopener noreferrer" class="absolute inset-0 z-[1]">
                        <span class="sr-only">{{ $slide->titulo }}</span>
                    </a>
                @endif

                {{-- Imagen de fondo --}}
                @if($slide->imagen)
                    <img src="{{ asset('storage/' . $slide->imagen) }}" alt="{{ $slide->titulo }}"
                         class="absolute inset-0 w-full h-full object-cover">
                @else
                    <div class="absolute inset-0 bg-linear-to-br from-dif-pink-dark to-dif-magenta"></div>
                @endif

                {{-- Overlay degradado --}}
                <div class="absolute inset-0 bg-linear-to-r from-black/60 via-black/25 to-transparent"></div>

                {{-- Título del slide --}}
                <div class="absolute inset-0 flex items-end sm:items-center pointer-events-none">
                    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 w-full pb-16 sm:pb-0">
                        <h2 class="slide-title text-white font-extrabold text-2xl sm:text-4xl lg:text-5xl leading-tight drop-shadow-lg max-w-xl">
                            {{ $slide->titulo }}
                        </h2>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Botón anterior --}}
    <button type="button" id="carrusel-prev"
            class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/35 backdrop-blur-sm text-white flex items-center justify-center hover:bg-black/60 transition-all duration-200 cursor-pointer focus:outline-none">
        <i class="fas fa-chevron-left text-sm sm:text-base"></i>
    </button>

    {{-- Botón siguiente --}}
    <button type="button" id="carrusel-next"
            class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/35 backdrop-blur-sm text-white flex items-center justify-center hover:bg-black/60 transition-all duration-200 cursor-pointer focus:outline-none">
        <i class="fas fa-chevron-right text-sm sm:text-base"></i>
    </button>

    {{-- Indicadores (dots) --}}
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
        @foreach($slides as $i => $slide)
            <button type="button" class="dot-carrusel {{ $i === 0 ? 'active' : '' }}" data-goto="{{ $i }}"></button>
        @endforeach
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const section = document.getElementById('carrusel-hero');
    if (!section) return;

    const slides = section.querySelectorAll('.slide');
    const dots   = section.querySelectorAll('.dot-carrusel');
    const total  = slides.length;
    if (total === 0) return;

    let current = 0;
    let timer   = null;
    let touchX  = 0;

    function goTo(index) {
        if (index === current || index < 0 || index >= total) return;
        // leaving
        slides[current].classList.remove('active');
        slides[current].classList.add('leaving');
        dots[current].classList.remove('active');
        // activate new
        const prev = current;
        current = index;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
        // remove leaving after transition
        setTimeout(function () { slides[prev].classList.remove('leaving'); }, 750);
        resetTimer();
    }

    function next() { goTo((current + 1) % total); }
    function prev() { goTo((current - 1 + total) % total); }

    function autoPlay() { timer = setInterval(next, 5000); }
    function resetTimer() { clearInterval(timer); autoPlay(); }

    // Buttons
    section.querySelector('#carrusel-prev').addEventListener('click', function (e) { e.stopPropagation(); prev(); });
    section.querySelector('#carrusel-next').addEventListener('click', function (e) { e.stopPropagation(); next(); });

    // Dots
    dots.forEach(function (dot) {
        dot.addEventListener('click', function (e) {
            e.stopPropagation();
            goTo(parseInt(this.dataset.goto));
        });
    });

    // Touch / Swipe
    section.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].clientX; }, { passive: true });
    section.addEventListener('touchend', function (e) {
        var dx = e.changedTouches[0].clientX - touchX;
        if (Math.abs(dx) > 40) { dx < 0 ? next() : prev(); }
    }, { passive: true });

    // Start
    autoPlay();
});
</script>
@endif

{{-- HERO SECTION --}}
<section class="relative min-h-screen flex items-center overflow-x-hidden">
    {{-- Background image with overlay --}}
    <div class="absolute inset-0">
        <img src="/images/directorio.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    {{-- Animated circles (hidden on mobile to prevent overflow) --}}
    <div class="hidden sm:block absolute top-20 left-10 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="hidden sm:block absolute bottom-20 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] sm:w-[600px] h-[300px] sm:h-[600px] bg-dif-rose/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-32">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm rounded-full px-4 sm:px-5 py-2 mb-6 sm:mb-8 scroll-hidden">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-xs sm:text-sm font-medium">Al servicio de la comunidad</span>
                </div>
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-4 sm:mb-6 scroll-hidden stagger-1">
                    TRABAJANDO AL<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-dif-pink-light to-white">SERVICIO DEL PUEBLO</span>
                </h1>
                <p class="text-base sm:text-xl text-white/85 leading-relaxed mb-6 sm:mb-10 max-w-lg scroll-hidden stagger-2">
                    Por el bien de las y los tecamaquenses, día a día trabajamos por ser una institución que sea una red de apoyo para todos los habitantes de nuestro municipio.
                </p>
                <div class="flex flex-wrap gap-3 sm:gap-4 scroll-hidden stagger-3 mb-6 sm:mb-8">
                    <a href="{{ route('servicios') }}" class="btn-ripple inline-flex items-center gap-2 bg-white text-dif-pink font-bold px-5 sm:px-8 py-3 sm:py-4 rounded-xl shadow-2xl hover:shadow-white/25 hover:scale-105 transition-all duration-300 text-sm sm:text-base">
                        <i class="fas fa-hand-holding-heart"></i>
                        Conoce nuestros servicios
                    </a>
                    <a href="{{ route('nosotros') }}" class="inline-flex items-center gap-2 border-2 border-white/40 text-white font-semibold px-5 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-white/10 backdrop-blur-sm transition-all duration-300 text-sm sm:text-base">
                        <i class="fas fa-info-circle"></i>
                        Sobre nosotros
                    </a>
                </div>

                {{-- PDF Download Buttons --}}
                @if($documentosInicio->count())
                <div class="flex flex-col sm:flex-row flex-wrap gap-3 scroll-hidden stagger-4">
                    @foreach($documentosInicio as $docInicio)
                        <a href="{{ $docInicio->url }}"
                           {{ $docInicio->tieneArchivo() ? 'download' : 'target="_blank" rel="noopener noreferrer"' }}
                           class="inline-flex items-center gap-2 bg-dif-pink/90 backdrop-blur text-white font-bold px-4 sm:px-6 py-3 rounded-xl shadow-lg hover:bg-dif-pink hover:scale-105 transition-all duration-300 text-xs sm:text-sm">
                            <i class="fas fa-file-pdf shrink-0"></i>
                            <span>{{ $docInicio->nombre }}</span>
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="hidden lg:flex justify-center scroll-scale">
                <div class="relative">
                    <div class="w-96 h-96 bg-white rounded-3xl p-4 flex items-center justify-center animate-float shadow-2xl overflow-hidden">
                        <img src="/images/DIF-NEW.jpg" alt="DIF Tecámac" class="max-w-full max-h-full object-contain">
                    </div>
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-green-400/80 backdrop-blur rounded-2xl flex items-center justify-center animate-float shadow-xl" style="animation-delay: 1s;">
                        <i class="fas fa-heart-pulse text-white text-2xl"></i>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-amber-400/80 backdrop-blur rounded-2xl flex items-center justify-center animate-float shadow-xl" style="animation-delay: 3s;">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V60Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- CATEGORIES SECTION --}}
<section class="py-12 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16 scroll-hidden">
            <span class="inline-block bg-dif-cream text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4">NUESTRAS ÁREAS</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">
                Áreas de <span class="animate-gradient-text">Atención</span>
            </h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Contamos con diversas áreas especializadas para brindarte la mejor atención</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
            @foreach($areasAtencion as $i => $area)
                @php
                    $stagger = ($i % 6) + 1;
                    $enlace = $area->enlace ?: null;
                    $esTextoLargo = strlen($area->nombre) > 32;
                @endphp

                @if($enlace)
                    <a href="{{ $enlace }}" class="card-hover scroll-hidden stagger-{{ $stagger }} group flex items-center gap-4 bg-gradient-to-r {{ $area->color_gradiente }} rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                        <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas {{ $area->icono }} text-white text-xl"></i>
                        </div>
                        <h3 class="font-extrabold text-white {{ $esTextoLargo ? 'text-xs leading-tight' : 'text-sm' }} uppercase">{{ $area->nombre }}</h3>
                    </a>
                @else
                    <div class="card-hover scroll-hidden stagger-{{ $stagger }} group flex items-center gap-4 bg-gradient-to-r {{ $area->color_gradiente }} rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                        <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas {{ $area->icono }} text-white text-xl"></i>
                        </div>
                        <h3 class="font-extrabold text-white {{ $esTextoLargo ? 'text-xs leading-tight' : 'text-sm' }} uppercase">{{ $area->nombre }}</h3>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- SERVICES OVERVIEW --}}
<section class="py-12 sm:py-20 bg-dif-cream bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16 scroll-hidden">
            <span class="inline-block bg-white text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm">SERVICIOS PRINCIPALES</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Servicios de <span class="text-dif-pink">Salud</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($serviciosSalud as $i => $servicio)
                @php
                    $stagger = ($i % 6) + 1;
                    $src = null;
                    if (!empty($servicio->imagen)) {
                        $src = str_starts_with($servicio->imagen, 'servicios_salud/')
                            ? asset('storage/' . $servicio->imagen)
                            : asset('images/' . $servicio->imagen);
                    }
                @endphp
                <div class="card-hover scroll-hidden stagger-{{ $stagger }} bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ $src ?: asset('images/page1_img8.png') }}" alt="{{ $servicio->nombre }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-dif-dark mb-2">{{ $servicio->nombre }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $servicio->descripcion }}</p>
                        <div class="flex items-start gap-2 {{ $servicio->color_horario ?: 'text-dif-pink' }} text-xs sm:text-sm font-medium">
                            <i class="fas fa-clock mt-0.5 shrink-0"></i>
                            <span>{{ $servicio->horario }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:mt-12 scroll-hidden">
            <a href="{{ route('salud') }}" class="btn-ripple inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:shadow-xl hover:scale-105 transition-all duration-300 text-sm sm:text-base">
                Ver todos los servicios de salud
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="py-16 bg-gradient-to-r from-dif-pink-dark via-dif-pink to-dif-magenta relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center scroll-hidden stagger-1">
                <div class="text-4xl sm:text-5xl font-extrabold text-white mb-2">
                    <span data-count="6">0</span>+
                </div>
                <p class="text-white/80 text-sm font-medium">Sedes de Salud</p>
            </div>
            <div class="text-center scroll-hidden stagger-2">
                <div class="text-4xl sm:text-5xl font-extrabold text-white mb-2">
                    <span data-count="6">0</span>+
                </div>
                <p class="text-white/80 text-sm font-medium">Casas de Cultura</p>
            </div>
            <div class="text-center scroll-hidden stagger-3">
                <div class="text-4xl sm:text-5xl font-extrabold text-white mb-2">
                    <span data-count="15">0</span>+
                </div>
                <p class="text-white/80 text-sm font-medium">Bibliotecas</p>
            </div>
            <div class="text-center scroll-hidden stagger-4">
                <div class="text-4xl sm:text-5xl font-extrabold text-white mb-2">
                    <span data-count="7">0</span>+
                </div>
                <p class="text-white/80 text-sm font-medium">Estancias Infantiles</p>
            </div>
        </div>
    </div>
</section>

{{-- EDUCATION & CULTURE PREVIEW --}}
<section class="py-12 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div class="scroll-left">
                <span class="inline-block bg-blue-50 text-blue-600 font-semibold text-sm px-4 py-1.5 rounded-full mb-4">EDUCACIÓN Y CULTURA</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark mb-6">
                    Formando el <span class="text-dif-pink">futuro</span> de Tecámac
                </h2>
                <p class="text-gray-500 leading-relaxed mb-8">
                    Contamos con casas de cultura, bibliotecas, estancias infantiles y diversos programas educativos y culturales para el desarrollo integral de nuestra comunidad.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-dif-cream transition-colors cursor-pointer group">
                        <div class="w-12 h-12 bg-dif-pink rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-palette text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dif-dark">Casas de Cultura</h4>
                            <p class="text-sm text-gray-400">6 sedes en todo el municipio</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-dif-cream transition-colors cursor-pointer group">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-book text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dif-dark">Bibliotecas</h4>
                            <p class="text-sm text-gray-400">15+ bibliotecas municipales</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-dif-cream transition-colors cursor-pointer group">
                        <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-child text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-dif-dark">Estancias Infantiles</h4>
                            <p class="text-sm text-gray-400">Lactantes, maternales y preescolar</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 sm:mt-8">
                    <a href="{{ route('educacion') }}" class="btn-ripple inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:scale-105 transition-all duration-300 text-sm sm:text-base">
                        Explorar Educación y Cultura
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="scroll-right">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden h-[300px] sm:h-[400px] lg:h-[500px] relative">
                        <img src="/images/page2_img3.png" alt="Orquesta Filarmónica Municipal de Tecámac" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6 text-white">
                            <h3 class="text-xl sm:text-2xl font-bold">Orquesta Filarmónica</h3>
                            <p class="text-white/80 mt-1 text-sm sm:text-base">Municipal de Tecámac</p>
                            <p class="text-xs sm:text-sm text-dif-pink-light font-medium mt-1">"Ilustre Músico Tecamaquense"</p>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 w-20 h-20 sm:w-24 sm:h-24 bg-dif-pink rounded-2xl hidden sm:flex items-center justify-center animate-float shadow-xl text-white">
                        <div class="text-center">
                            <i class="fas fa-theater-masks text-xl sm:text-2xl"></i>
                            <p class="text-xs mt-1 font-bold">Cultura</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BOLETINES PREVIEW --}}
<section class="py-12 sm:py-20 bg-dif-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12 scroll-hidden">
            <span class="inline-block bg-white text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm">NOTICIAS</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">
                Últimos <span class="text-dif-pink">Boletines</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($boletines as $i => $boletin)
                @php
                    $src = $boletin->imagen
                        ? (str_starts_with($boletin->imagen, 'boletines/')
                            ? asset('storage/' . $boletin->imagen)
                            : asset('images/' . $boletin->imagen))
                        : null;
                @endphp
                <div class="card-hover scroll-hidden stagger-{{ $i + 1 }} bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <a href="{{ route('boletines.show', $boletin) }}" class="block group">
                        <div class="h-48 overflow-hidden">
                            @if($src)
                                <img src="{{ $src }}" alt="{{ $boletin->titulo }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-dif-pink/10 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-dif-pink text-4xl opacity-40"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-dif-dark text-sm uppercase group-hover:text-dif-pink transition-colors duration-200">{{ $boletin->titulo }}</h3>
                            <p class="text-xs text-gray-500 mt-2 line-clamp-3">{{ $boletin->descripcion }}</p>
                            <span class="inline-flex items-center gap-1 mt-3 text-xs font-semibold text-dif-pink">
                                Leer más <i class="fas fa-arrow-right text-[10px]"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="md:col-span-3 text-center py-10 text-gray-400">
                    <i class="fas fa-newspaper text-4xl mb-2 block"></i>
                    No hay boletines disponibles.
                </div>
            @endforelse
        </div>

        <div class="text-center mt-8 sm:mt-12 scroll-hidden">
            <a href="{{ route('boletines') }}" class="btn-ripple inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:shadow-xl hover:scale-105 transition-all duration-300 text-sm sm:text-base">
                Ver todos los boletines
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-12 sm:py-20 bg-gradient-to-br from-dif-pink to-dif-magenta relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 scroll-scale">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white mb-4 sm:mb-6">¿Necesitas alguno de nuestros servicios?</h2>
        <p class="text-base sm:text-lg text-white/80 mb-8 sm:mb-10 max-w-2xl mx-auto">
            Consulta nuestro directorio para encontrar la sede más cercana y los horarios de atención disponibles.
        </p>
        <a href="{{ route('directorio') }}" class="btn-ripple inline-flex items-center gap-2 bg-white text-dif-pink font-bold px-6 sm:px-10 py-3 sm:py-4 rounded-xl shadow-2xl hover:scale-105 transition-all duration-300 text-sm sm:text-base">
            <i class="fas fa-map-location-dot"></i>
            Ver Directorio Completo
        </a>
    </div>
</section>

@endsection
