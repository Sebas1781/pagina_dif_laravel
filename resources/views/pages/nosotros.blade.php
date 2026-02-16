@extends('layouts.app')
@section('title', 'DIF Tecámac - Nosotros')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/images/nosotros.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden">CONÓCENOS</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">Nosotros</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">Conoce nuestra misión, visión y los valores que nos guían cada día al servicio de la comunidad de Tecámac.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- MISIÓN, VISIÓN, VALORES --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Misión --}}
            <div class="card-hover scroll-hidden stagger-1 bg-gradient-to-br from-dif-cream to-white rounded-3xl p-8 border border-pink-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-dif-pink/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-dif-pink to-dif-magenta rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-dif-dark mb-4">Misión</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Ser una institución que brinde atención integral a las familias tecamaquenses, promoviendo el bienestar social, la salud, la educación y la cultura, con un enfoque de derechos humanos e igualdad de género, contribuyendo al desarrollo pleno de la comunidad.
                    </p>
                </div>
            </div>

            {{-- Visión --}}
            <div class="card-hover scroll-hidden stagger-2 bg-gradient-to-br from-blue-50 to-white rounded-3xl p-8 border border-blue-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-dif-dark mb-4">Visión</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Consolidarnos como la institución referente en el municipio de Tecámac en materia de desarrollo integral familiar, reconocida por su calidad en los servicios, innovación en programas sociales y compromiso genuino con las necesidades de cada habitante.
                    </p>
                </div>
            </div>

            {{-- Valores --}}
            <div class="card-hover scroll-hidden stagger-3 bg-gradient-to-br from-amber-50 to-white rounded-3xl p-8 border border-amber-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-400 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-dif-dark mb-4">Valores</h3>
                    <ul class="text-gray-500 space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-amber-500 text-sm"></i> Honestidad y transparencia</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-amber-500 text-sm"></i> Respeto a la dignidad humana</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-amber-500 text-sm"></i> Compromiso social</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-amber-500 text-sm"></i> Igualdad e inclusión</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-amber-500 text-sm"></i> Servicio con calidad y calidez</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-amber-500 text-sm"></i> Solidaridad comunitaria</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SEDES --}}
<section class="py-20 bg-dif-cream bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-white text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm">NUESTRAS SEDES</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Sedes del <span class="text-dif-pink">DIF Tecámac</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $sedes = [
                ['name' => 'Oficinas Centrales DIF Villas del Real', 'icon' => 'fa-building', 'color' => 'dif-pink'],
                ['name' => 'Unidad Médica Mandarinas', 'icon' => 'fa-hospital', 'color' => 'dif-pink'],
                ['name' => 'Unidad Médica Los Reyes Acozac', 'icon' => 'fa-stethoscope', 'color' => 'teal-600'],
                ['name' => 'Centro de Equinoterapia', 'icon' => 'fa-horse', 'color' => 'green-600'],
                ['name' => 'Centro de Diversidad Los Héroes Tecámac', 'icon' => 'fa-people-group', 'color' => 'purple-600'],
                ['name' => 'Centro M.I.E.L Urbi Villas', 'icon' => 'fa-hand-holding-heart', 'color' => 'amber-600'],
                ['name' => 'Solidarios de Corazón', 'icon' => 'fa-heart', 'color' => 'red-500'],
                ['name' => 'U.B.R.I.S', 'icon' => 'fa-wheelchair', 'color' => 'blue-600'],
                ['name' => 'Laboratorio de Análisis Clínicos', 'icon' => 'fa-flask', 'color' => 'indigo-600'],
            ];
            @endphp

            @foreach($sedes as $i => $sede)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-2xl p-6 border border-gray-100 flex items-center gap-4 group cursor-pointer">
                <div class="w-14 h-14 bg-{{ $sede['color'] }}/10 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-{{ $sede['color'] }} transition-colors duration-300">
                    <i class="fas {{ $sede['icon'] }} text-{{ $sede['color'] }} text-xl group-hover:text-white transition-colors duration-300"></i>
                </div>
                <div>
                    <h4 class="font-bold text-dif-dark group-hover:text-dif-pink transition-colors">{{ $sede['name'] }}</h4>
                </div>
                <i class="fas fa-chevron-right text-gray-300 ml-auto group-hover:text-dif-pink group-hover:translate-x-1 transition-all"></i>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
