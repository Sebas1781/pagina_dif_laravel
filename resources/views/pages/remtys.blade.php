@extends('layouts.app')
@section('title', 'DIF Tecámac - REMTYS')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/90 via-dif-pink/75 to-dif-magenta/85"></div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 right-20 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden">
            <i class="fas fa-file-lines mr-2"></i>TRÁMITES Y SERVICIOS
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">
            REMTYS
        </h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">
            Registro Municipal de Trámites y Servicios
        </p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- ABOUT REMTYS --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-16 scroll-hidden">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-1 h-12 bg-gradient-to-b from-dif-pink to-dif-magenta rounded-full"></div>
                <h2 class="text-3xl font-extrabold text-dif-dark">¿Qué es el REMTYS?</h2>
            </div>
            <p class="text-gray-600 leading-relaxed text-lg">
                Conoce el Registro Municipal de Trámites y Servicios (REMTYS), una herramienta diseñada para brindar a la ciudadanía información clara, precisa y actualizada sobre los trámites y servicios que ofrece el municipio. Aquí encontrarás requisitos, costos, tiempos de atención y puntos de contacto, fomentando la transparencia, la eficiencia administrativa y el derecho a un buen servicio público.
            </p>
        </div>

        {{-- CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Consejería Jurídica --}}
            <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-1">
                <div class="h-56 bg-gradient-to-br from-purple-700/80 to-purple-500/80 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    <div class="relative z-10 text-center p-6">
                        <div class="w-16 h-16 mx-auto mb-4 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-gavel text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Consejería Jurídica</h3>
                    </div>
                </div>
            </div>

            {{-- Tesorería Municipal --}}
            <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-2">
                <div class="h-56 bg-gradient-to-br from-red-700/80 to-red-500/80 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    <div class="relative z-10 text-center p-6">
                        <div class="w-16 h-16 mx-auto mb-4 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-coins text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Tesorería Municipal</h3>
                    </div>
                </div>
            </div>

            {{-- Órgano Interno de Control Municipal --}}
            <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-3">
                <div class="h-56 bg-gradient-to-br from-blue-700/80 to-blue-500/80 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    <div class="relative z-10 text-center p-6">
                        <div class="w-16 h-16 mx-auto mb-4 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-building-shield text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Órgano Interno de Control Municipal</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
