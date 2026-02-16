@extends('layouts.app')
@section('title', 'DIF Tecámac - Inicio')

@section('content')

{{-- HERO SECTION --}}
<section class="relative min-h-screen flex items-center overflow-hidden">
    {{-- Background image with overlay --}}
    <div class="absolute inset-0">
        <img src="/images/directorio.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    {{-- Animated circles --}}
    <div class="absolute top-20 left-10 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-dif-rose/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm rounded-full px-5 py-2 mb-8 scroll-hidden">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">Al servicio de la comunidad</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 scroll-hidden stagger-1">
                    TRABAJANDO AL<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-dif-pink-light to-white">SERVICIO DEL PUEBLO</span>
                </h1>
                <p class="text-lg sm:text-xl text-white/85 leading-relaxed mb-10 max-w-lg scroll-hidden stagger-2">
                    Por el bien de las y los tecamaquenses, día a día trabajamos por ser una institución que sea una red de apoyo para todos los habitantes de nuestro municipio.
                </p>
                <div class="flex flex-wrap gap-4 scroll-hidden stagger-3 mb-8">
                    <a href="{{ route('servicios') }}" class="btn-ripple inline-flex items-center gap-2 bg-white text-dif-pink font-bold px-8 py-4 rounded-xl shadow-2xl hover:shadow-white/25 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-hand-holding-heart"></i>
                        Conoce nuestros servicios
                    </a>
                    <a href="{{ route('nosotros') }}" class="inline-flex items-center gap-2 border-2 border-white/40 text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/10 backdrop-blur-sm transition-all duration-300">
                        <i class="fas fa-info-circle"></i>
                        Sobre nosotros
                    </a>
                </div>

                {{-- PDF Download Buttons --}}
                <div class="flex flex-wrap gap-4 scroll-hidden stagger-4">
                    <a href="/pdf/pada.pdf" download class="inline-flex items-center gap-2 bg-dif-pink/90 backdrop-blur text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:bg-dif-pink hover:scale-105 transition-all duration-300 text-xs sm:text-sm">
                        <i class="fas fa-file-pdf"></i>
                        Programa Anual de Desarrollo Archivístico (PADA) 2026
                    </a>
                    <a href="/pdf/programa.pdf" download class="inline-flex items-center gap-2 bg-dif-pink/90 backdrop-blur text-white font-bold px-6 py-3 rounded-xl shadow-lg hover:bg-dif-pink hover:scale-105 transition-all duration-300 text-xs sm:text-sm">
                        <i class="fas fa-file-pdf"></i>
                        Resultados del Programa Anual de Evaluación 2025
                    </a>
                </div>
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
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-dif-cream text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4">NUESTRAS ÁREAS</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">
                Áreas de <span class="animate-gradient-text">Atención</span>
            </h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Contamos con diversas áreas especializadas para brindarte la mejor atención</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
            {{-- Salud y Bienestar --}}
            <a href="{{ route('salud') }}" class="card-hover scroll-hidden stagger-1 group flex items-center gap-4 bg-gradient-to-r from-dif-pink to-dif-pink-light rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-stethoscope text-white text-xl"></i>
                </div>
                <h3 class="font-extrabold text-white text-sm uppercase">Salud y Bienestar</h3>
            </a>
            {{-- Educación y Cultura --}}
            <a href="{{ route('educacion') }}" class="card-hover scroll-hidden stagger-2 group flex items-center gap-4 bg-gradient-to-r from-teal-500 to-teal-400 rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-book-open text-white text-xl"></i>
                </div>
                <h3 class="font-extrabold text-white text-sm uppercase">Educación y Cultura</h3>
            </a>
            {{-- Jurídico --}}
            <a href="{{ route('servicios') }}" class="card-hover scroll-hidden stagger-3 group flex items-center gap-4 bg-gradient-to-r from-purple-800 to-purple-600 rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-gavel text-white text-xl"></i>
                </div>
                <h3 class="font-extrabold text-white text-sm uppercase">Jurídico</h3>
            </a>
            {{-- Centros de Atención Integral a la Diversidad Sexual --}}
            <div class="card-hover scroll-hidden stagger-4 group flex items-center gap-4 bg-gradient-to-r from-rose-400 to-pink-300 rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-heart text-white text-xl"></i>
                </div>
                <h3 class="font-extrabold text-white text-xs uppercase leading-tight">Centros de Atención Integral a la Diversidad Sexual</h3>
            </div>
            {{-- Centros de Desarrollo Juvenil --}}
            <div class="card-hover scroll-hidden stagger-5 group flex items-center gap-4 bg-gradient-to-r from-amber-500 to-amber-400 rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h3 class="font-extrabold text-white text-sm uppercase">Centros de Desarrollo Juvenil</h3>
            </div>
            {{-- Puerta Violeta --}}
            <div class="card-hover scroll-hidden stagger-6 group flex items-center gap-4 bg-gradient-to-r from-purple-700 to-purple-500 rounded-full pl-2 pr-6 py-2 shadow-lg hover:shadow-xl cursor-pointer">
                <div class="w-14 h-14 bg-white/30 backdrop-blur rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-door-open text-white text-xl"></i>
                </div>
                <h3 class="font-extrabold text-white text-sm uppercase">Puerta Violeta</h3>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES OVERVIEW --}}
<section class="py-20 bg-dif-cream bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-white text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm">SERVICIOS PRINCIPALES</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Servicios de <span class="text-dif-pink">Salud</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Service Card 1 --}}
            <div class="card-hover scroll-hidden stagger-1 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page1_img8.png" alt="Unidad Médica Mandarinas" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-dif-dark mb-2">Unidad Médica Mandarinas</h3>
                    <p class="text-sm text-gray-500 mb-4">Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770</p>
                    <div class="flex items-center gap-2 text-dif-pink text-sm font-medium">
                        <i class="fas fa-clock"></i>
                        <span>Lunes a Viernes: 9:00 - 18:00 hrs | Sábados: 9:00 - 13:00 hrs</span>
                    </div>
                </div>
            </div>
            {{-- Service Card 2 --}}
            <div class="card-hover scroll-hidden stagger-2 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page1_img29.png" alt="Centro de Equinoterapia" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-dif-dark mb-2">Centro de Equinoterapia</h3>
                    <p class="text-sm text-gray-500 mb-4">Carretera Federal México – Pachuca, Km. 38, Sierra Hermosa, 55740</p>
                    <div class="flex items-center gap-2 text-green-600 text-sm font-medium">
                        <i class="fas fa-clock"></i>
                        <span>Lunes a Viernes: 9:00 - 15:00 hrs</span>
                    </div>
                </div>
            </div>
            {{-- Service Card 3 --}}
            <div class="card-hover scroll-hidden stagger-3 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page1_img38.png" alt="Clínica Materno Infantil" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-dif-dark mb-2">Clínica Materno Infantil</h3>
                    <p class="text-sm text-gray-500 mb-4">Juana Belén Gutiérrez de Mendoza</p>
                    <div class="flex items-center gap-2 text-blue-600 text-sm font-medium">
                        <i class="fas fa-clock"></i>
                        <span>Lunes a Viernes: 9:00 - 15:00 hrs</span>
                    </div>
                </div>
            </div>
            {{-- Service Card 4 --}}
            <div class="card-hover scroll-hidden stagger-4 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page1_img37.png" alt="U.B.R.I.S" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-dif-dark mb-2">U.B.R.I.S</h3>
                    <p class="text-sm text-gray-500 mb-4">Unidad Básica de Rehabilitación e Integración Social</p>
                    <div class="flex items-center gap-2 text-purple-600 text-sm font-medium">
                        <i class="fas fa-clock"></i>
                        <span>Lunes a Viernes: 9:00 - 15:00 hrs</span>
                    </div>
                </div>
            </div>
            {{-- Service Card 5 --}}
            <div class="card-hover scroll-hidden stagger-5 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page1_img11.png" alt="Unidad Médica Reyes Acozac" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-dif-dark mb-2">Unidad Médica Reyes Acozac</h3>
                    <p class="text-sm text-gray-500 mb-4">C. Niños Héroes No. 14, Barrio el Calvario, Reyes Acozac, C.P. 55755</p>
                    <div class="flex items-center gap-2 text-teal-600 text-sm font-medium">
                        <i class="fas fa-clock"></i>
                        <span>Lunes a Viernes: 9:00 - 18:00 hrs</span>
                    </div>
                </div>
            </div>
            {{-- Service Card 6 --}}
            <div class="card-hover scroll-hidden stagger-6 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page1_img21.png" alt="Laboratorio de Análisis Clínicos" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-dif-dark mb-2">Laboratorio de Análisis Clínicos</h3>
                    <p class="text-sm text-gray-500 mb-4">Análisis clínicos y pruebas especializadas</p>
                    <div class="flex items-center gap-2 text-amber-600 text-sm font-medium">
                        <i class="fas fa-clock"></i>
                        <span>Lunes a Viernes: 9:00 - 15:00 hrs</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12 scroll-hidden">
            <a href="{{ route('salud') }}" class="btn-ripple inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:shadow-xl hover:scale-105 transition-all duration-300">
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
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
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
                <div class="mt-8">
                    <a href="{{ route('educacion') }}" class="btn-ripple inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:scale-105 transition-all duration-300">
                        Explorar Educación y Cultura
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="scroll-right">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden h-[500px] relative">
                        <img src="/images/page2_img3.png" alt="Orquesta Filarmónica Municipal de Tecámac" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <h3 class="text-2xl font-bold">Orquesta Filarmónica</h3>
                            <p class="text-white/80 mt-1">Municipal de Tecámac</p>
                            <p class="text-sm text-dif-pink-light font-medium mt-1">"Ilustre Músico Tecamaquense"</p>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-dif-pink rounded-2xl flex items-center justify-center animate-float shadow-xl text-white">
                        <div class="text-center">
                            <i class="fas fa-theater-masks text-2xl"></i>
                            <p class="text-xs mt-1 font-bold">Cultura</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BOLETINES PREVIEW --}}
<section class="py-20 bg-dif-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 scroll-hidden">
            <span class="inline-block bg-white text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm">NOTICIAS</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">
                Últimos <span class="text-dif-pink">Boletines</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Boletin 1 --}}
            <div class="card-hover scroll-hidden stagger-1 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 overflow-hidden">
                    <img src="/images/serenata.png" alt="Tardes de Serenata" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-dif-dark text-sm uppercase">Tardes de Serenata</h3>
                    <p class="text-xs text-gray-500 mt-2 line-clamp-3">Tardes de Serenata en Tecámac nos regaló una jornada llena de sentimiento, donde el Mariachi Municipal acompañó cada dedicatoria.</p>
                </div>
            </div>
            {{-- Boletin 2 --}}
            <div class="card-hover scroll-hidden stagger-2 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 overflow-hidden">
                    <img src="/images/bodas.png" alt="Bodas Comunitarias" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-dif-dark text-sm uppercase">Bodas Comunitarias 2026</h3>
                    <p class="text-xs text-gray-500 mt-2 line-clamp-3">Tecámac, Late por Ti. Una celebración llena de amor para las familias tecamaquenses.</p>
                </div>
            </div>
            {{-- Boletin 3 --}}
            <div class="card-hover scroll-hidden stagger-3 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 overflow-hidden">
                    <img src="/images/atmosfera.png" alt="Atmósfera Mundialista" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-dif-dark text-sm uppercase">Atmósfera Mundialista 2026</h3>
                    <p class="text-xs text-gray-500 mt-2 line-clamp-3">Estamos a menos de un mes de iniciar este gran festival, ¡no te lo puedes perder!</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-12 scroll-hidden">
            <a href="{{ route('boletines') }}" class="btn-ripple inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:shadow-xl hover:scale-105 transition-all duration-300">
                Ver todos los boletines
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-20 bg-gradient-to-br from-dif-pink to-dif-magenta relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 scroll-scale">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-6">¿Necesitas alguno de nuestros servicios?</h2>
        <p class="text-lg text-white/80 mb-10 max-w-2xl mx-auto">
            Consulta nuestro directorio para encontrar la sede más cercana y los horarios de atención disponibles.
        </p>
        <a href="{{ route('directorio') }}" class="btn-ripple inline-flex items-center gap-2 bg-white text-dif-pink font-bold px-10 py-4 rounded-xl shadow-2xl hover:scale-105 transition-all duration-300">
            <i class="fas fa-map-location-dot"></i>
            Ver Directorio Completo
        </a>
    </div>
</section>

@endsection
