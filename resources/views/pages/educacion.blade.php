@extends('layouts.app')
@section('title', 'DIF Tecámac - Educación y Cultura')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/images/page2_img3.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/85 via-blue-700/75 to-purple-700/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 right-20 w-80 h-80 bg-purple-400/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden"><i class="fas fa-book-open mr-2"></i>EDUCACIÓN Y CULTURA</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">Educación y Cultura</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">Formando el futuro de Tecámac a través de programas educativos, culturales y artísticos.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- CASAS DE CULTURA --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-dif-cream text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4">ESPACIOS CULTURALES</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Casas de <span class="text-dif-pink">Cultura</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $casas = [
                ['Casa de Cultura, Tecámac Centro', 'Av. 5 de Mayo 46, Tecámac Centro, 55740 Tecámac de Felipe Villanueva, Méx.', 'fa-landmark', 'from-dif-pink to-dif-magenta', '/images/page2_img14.png'],
                ['Casa de Cultura, Los Reyes Acozac', 'Av. Sanchez Colín, Tlalzompa Manzana 036, Reyes Acozac, 55755 Los Reyes Acozac, Méx.', 'fa-palette', 'from-purple-600 to-purple-400', '/images/page1_img3.png'],
                ['Casa de Cultura, San Pedro Pozohuacan', 'Manzana 013, Centro, San Pedro Pozohuacan, 55744 Santa María Ajoloapan, Méx.', 'fa-masks-theater', 'from-blue-600 to-blue-400', '/images/sp_pozo.jpg'],
                ['Casa de Cultura, Geo Sierra Hermosa', 'Rancho Grande, Sierra Hermosa, 55749 Ojo de Agua, Méx.', 'fa-music', 'from-indigo-600 to-indigo-400', '/images/geo_sierra.jpg'],
                ['Casa de Cultura, Héroes Tecámac', 'Manzana 022, Col. Héroes de Tecámac, 55763 Ojo de Agua, Méx.', 'fa-guitar', 'from-teal-600 to-teal-400', '/images/heroes_tecamac.jpg'],
                ['Casa de Cultura, San Jerónimo Xonacahuacan', 'Manzana 029, San Jerónimo Xonacahuacan, 55745 Santa María Ajoloapan, Méx.', 'fa-paintbrush', 'from-rose-600 to-rose-400', '/images/page2_img2.png'],
            ];
            @endphp

            @foreach($casas as $i => $casa)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="h-40 relative overflow-hidden">
                    <img src="{{ $casa[4] }}" alt="{{ $casa[0] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t {{ $casa[3] }} opacity-40"></div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-dif-dark text-lg mb-2">{{ $casa[0] }}</h3>
                    <p class="text-sm text-gray-500 flex items-start gap-2">
                        <i class="fas fa-map-marker-alt text-dif-pink mt-1 shrink-0"></i>
                        {{ $casa[1] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BIBLIOTECAS --}}
<section class="py-20 bg-dif-cream bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-white text-blue-600 font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm"><i class="fas fa-book mr-2"></i>CONOCIMIENTO</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Bibliotecas <span class="text-blue-600">Municipales</span></h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @php
            $bibliotecas = [
                'Felipe Villanueva', 'San Lucas Xolox', 'Nezahualcóyotl', 'Los Héroes Tecámac',
                'Acozahuac', 'Amado Nervo', 'Ángeles Mastretta', 'Santa Cruz',
                'Benito Juárez', 'Ricardo Flores Magón', 'Haciendas Del Bosque',
                'Sor Juana Inés De La Cruz', 'Joaquín Fernández De Lizardi'
            ];
            @endphp

            @foreach($bibliotecas as $i => $bib)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-xl p-4 border border-gray-100 text-center group hover:border-blue-300 cursor-pointer">
                <div class="w-12 h-12 mx-auto bg-blue-50 rounded-xl flex items-center justify-center mb-3 group-hover:bg-blue-600 transition-colors duration-300">
                    <i class="fas fa-book-open text-blue-600 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <p class="text-xs font-bold text-dif-dark leading-tight">Biblioteca {{ $bib }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ESTANCIAS INFANTILES --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-amber-50 text-amber-600 font-semibold text-sm px-4 py-1.5 rounded-full mb-4"><i class="fas fa-child mr-2"></i>CUIDADO INFANTIL</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Estancias <span class="text-amber-600">Infantiles</span></h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Atención para lactantes, maternales y preescolar</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $estancias = [
                ['Estancia Infantil "Paola Espinoza"', 'fa-baby', 'from-pink-500 to-pink-400'],
                ['Estancia Infantil "Juan Pablo II"', 'fa-child-reaching', 'from-blue-500 to-blue-400'],
                ['Estancia Infantil "Los Héroes Tecámac"', 'fa-children', 'from-green-500 to-green-400'],
                ['Estancia Infantil "Hellen Keller"', 'fa-hands-holding-child', 'from-purple-500 to-purple-400'],
                ['Estancia Infantil "Leona Vicario"', 'fa-child-dress', 'from-amber-500 to-amber-400'],
                ['Estancia Infantil "Sor Juana Inés de la Cruz"', 'fa-school', 'from-teal-500 to-teal-400'],
                ['Preescolar "Laura Méndez de Cuenca"', 'fa-graduation-cap', 'from-indigo-500 to-indigo-400'],
            ];
            @endphp

            @foreach($estancias as $i => $est)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-2xl p-6 border border-gray-100 flex items-center gap-4 group hover:border-amber-300">
                <div class="w-14 h-14 bg-gradient-to-br {{ $est[2] }} rounded-2xl flex items-center justify-center shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="fas {{ $est[1] }} text-white text-xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-dif-dark text-sm">{{ $est[0] }}</h4>
                    <p class="text-xs text-gray-400 mt-1">Lactantes · Maternales · Preescolar</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center scroll-hidden">
            <div class="inline-flex items-center gap-6 bg-amber-50 rounded-2xl p-6 border border-amber-100">
                <div class="text-center">
                    <p class="font-bold text-amber-600 text-lg">EDADES</p>
                    <p class="text-sm text-gray-500">Atención integral</p>
                </div>
                <div class="flex gap-4">
                    <div class="bg-white rounded-xl px-4 py-3 text-center shadow-sm">
                        <i class="fas fa-baby text-pink-500 text-xl mb-1"></i>
                        <p class="text-xs font-bold text-dif-dark">Lactantes</p>
                    </div>
                    <div class="bg-white rounded-xl px-4 py-3 text-center shadow-sm">
                        <i class="fas fa-child text-blue-500 text-xl mb-1"></i>
                        <p class="text-xs font-bold text-dif-dark">Maternales</p>
                    </div>
                    <div class="bg-white rounded-xl px-4 py-3 text-center shadow-sm">
                        <i class="fas fa-school text-green-500 text-xl mb-1"></i>
                        <p class="text-xs font-bold text-dif-dark">Preescolar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- EVENTOS CULTURALES --}}
<section class="py-20 bg-gradient-to-br from-dif-pink-dark via-dif-pink to-dif-magenta relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-white/15 text-white font-semibold text-sm px-4 py-1.5 rounded-full mb-4"><i class="fas fa-star mr-2"></i>EVENTOS</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Eventos <span class="text-dif-pink-light">Culturales</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Event 1 --}}
            <div class="card-hover scroll-hidden stagger-1 bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden border border-white/20 text-white group hover:bg-white/20">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page2_img3.png" alt="Orquesta Filarmónica" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-8">
                <h3 class="text-xl font-extrabold mb-3">Orquesta Filarmónica Municipal</h3>
                <p class="text-sm font-medium text-dif-pink-light mb-3">"Ilustre Músico Tecamaquense"</p>
                <p class="text-white/70 text-sm leading-relaxed">Conoce toda la información que necesitas para hacer uso de estos servicios culturales.</p>
                </div>
            </div>
            {{-- Event 2 --}}
            <div class="card-hover scroll-hidden stagger-2 bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden border border-white/20 text-white group hover:bg-white/20">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page2_img11.png" alt="Festival Atmósfera 2025" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-8">
                <h3 class="text-xl font-extrabold mb-3">Festival Atmósfera 2025</h3>
                <p class="text-white/70 text-sm leading-relaxed">Evento cultural y artístico que reúne a la comunidad tecamaquense en un espacio de convivencia y entretenimiento.</p>
                </div>
            </div>
            {{-- Event 3 --}}
            <div class="card-hover scroll-hidden stagger-3 bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden border border-white/20 text-white group hover:bg-white/20">
                <div class="h-48 relative overflow-hidden">
                    <img src="/images/page2_img12.png" alt="Feria Regional de Tecámac" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-8">
                <h3 class="text-xl font-extrabold mb-3">Feria Regional de Tecámac</h3>
                <p class="text-white/70 text-sm leading-relaxed">La celebración más importante del municipio con actividades culturales, artísticas y recreativas para toda la familia.</p>
                </div>
            </div>
        </div>

        {{-- Programs & Social Service --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
            <div class="card-hover scroll-hidden bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 text-white group hover:bg-white/20">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-list-check text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-extrabold">Programas</h3>
                </div>
                <p class="text-white/70 text-sm leading-relaxed">Diversos programas educativos y culturales diseñados para el desarrollo integral de la comunidad.</p>
            </div>
            <div class="card-hover scroll-hidden bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 text-white group hover:bg-white/20">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-handshake-angle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-extrabold">Servicio Social</h3>
                </div>
                <p class="text-white/70 text-sm leading-relaxed">Colaboraciones con escuelas y oportunidades de servicio social para estudiantes y profesionistas.</p>
            </div>
        </div>
    </div>
</section>

@endsection
