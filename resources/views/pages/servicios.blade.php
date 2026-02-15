@extends('layouts.app')
@section('title', 'DIF Tecámac - Servicios')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/images/page1_img2.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 left-20 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden"><i class="fas fa-concierge-bell mr-2"></i>NUESTROS SERVICIOS</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">Servicios</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">Todos los servicios que el DIF Tecámac ofrece a la comunidad.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- ALL AREAS --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- BIENESTAR SOCIAL --}}
        <div class="mb-20 scroll-hidden">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-dif-pink to-dif-magenta rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-dif-dark">Bienestar Social</h2>
                    <p class="text-sm text-gray-400">Programas de apoyo a la comunidad</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Apoyos alimentarios', 'Programas de asistencia social', 'Atención a grupos vulnerables', 'Solidarios de Corazón', 'Centro M.I.E.L Urbi Villas', 'Comedores comunitarios'] as $i => $s)
                <div class="card-hover bg-white rounded-xl p-5 border border-gray-100 flex items-center gap-4 group hover:border-dif-pink/30 stagger-{{ $i + 1 }}">
                    <div class="w-10 h-10 bg-dif-cream rounded-lg flex items-center justify-center shrink-0 group-hover:bg-dif-pink transition-colors">
                        <i class="fas fa-check text-dif-pink text-sm group-hover:text-white transition-colors"></i>
                    </div>
                    <span class="font-medium text-dif-dark text-sm">{{ $s }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- DERECHOS --}}
        <div class="mb-20 scroll-hidden">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-purple-400 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-shield-heart text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-dif-dark">Atención y Defensa de Derechos</h2>
                    <p class="text-sm text-gray-400">Mujeres, juventud y diversidad sexual</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Atención a mujeres víctimas de violencia', 'Asesoría psicológica', 'Programas de equidad de género', 'Atención a la diversidad sexual', 'Programas para jóvenes', 'Centro de Diversidad Los Héroes'] as $i => $s)
                <div class="card-hover bg-white rounded-xl p-5 border border-gray-100 flex items-center gap-4 group hover:border-purple-300 stagger-{{ $i + 1 }}">
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center shrink-0 group-hover:bg-purple-600 transition-colors">
                        <i class="fas fa-check text-purple-600 text-sm group-hover:text-white transition-colors"></i>
                    </div>
                    <span class="font-medium text-dif-dark text-sm">{{ $s }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- SALUD --}}
        <div class="mb-20 scroll-hidden">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-rose-400 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-heartbeat text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-dif-dark">Salud</h2>
                    <p class="text-sm text-gray-400">Atención médica integral</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Consulta médica general', 'Terapia psicológica', 'Consulta nutricional', 'Consulta dental', 'Consulta ginecología', 'Consulta pediatra', 'Terapia física', 'Equinoterapia', 'Laboratorio de análisis clínicos'] as $i => $s)
                <div class="card-hover bg-white rounded-xl p-5 border border-gray-100 flex items-center gap-4 group hover:border-red-300 stagger-{{ ($i % 6) + 1 }}">
                    <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center shrink-0 group-hover:bg-red-500 transition-colors">
                        <i class="fas fa-check text-red-500 text-sm group-hover:text-white transition-colors"></i>
                    </div>
                    <span class="font-medium text-dif-dark text-sm">{{ $s }}</span>
                </div>
                @endforeach
            </div>
            <div class="mt-6">
                <a href="{{ route('salud') }}" class="inline-flex items-center gap-2 text-dif-pink font-semibold hover:underline">
                    Ver detalle completo de salud <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

        {{-- EDUCACIÓN --}}
        <div class="mb-20 scroll-hidden">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-book-open text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-dif-dark">Educación y Cultura</h2>
                    <p class="text-sm text-gray-400">Aprendizaje y desarrollo cultural</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Casas de Cultura (6 sedes)', 'Bibliotecas municipales (15+)', 'Estancias infantiles (7 sedes)', 'Eventos culturales', 'Orquesta Filarmónica Municipal', 'Servicio social y colaboraciones'] as $i => $s)
                <div class="card-hover bg-white rounded-xl p-5 border border-gray-100 flex items-center gap-4 group hover:border-blue-300 stagger-{{ $i + 1 }}">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center shrink-0 group-hover:bg-blue-600 transition-colors">
                        <i class="fas fa-check text-blue-600 text-sm group-hover:text-white transition-colors"></i>
                    </div>
                    <span class="font-medium text-dif-dark text-sm">{{ $s }}</span>
                </div>
                @endforeach
            </div>
            <div class="mt-6">
                <a href="{{ route('educacion') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:underline">
                    Ver detalle de educación y cultura <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

        {{-- JURÍDICO --}}
        <div class="scroll-hidden">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-600 to-amber-400 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-scale-balanced text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-dif-dark">Jurídico</h2>
                    <p class="text-sm text-gray-400">Asesoría legal gratuita</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Asesoría jurídica familiar', 'Mediación y conciliación', 'Protección a la infancia', 'Trámites de custodia y pensión', 'Atención a adultos mayores', 'Defensa de derechos'] as $i => $s)
                <div class="card-hover bg-white rounded-xl p-5 border border-gray-100 flex items-center gap-4 group hover:border-amber-300 stagger-{{ $i + 1 }}">
                    <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center shrink-0 group-hover:bg-amber-600 transition-colors">
                        <i class="fas fa-check text-amber-600 text-sm group-hover:text-white transition-colors"></i>
                    </div>
                    <span class="font-medium text-dif-dark text-sm">{{ $s }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
