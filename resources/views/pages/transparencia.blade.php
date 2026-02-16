@extends('layouts.app')
@section('title', 'DIF Tecámac - Transparencia')

@section('content')

{{-- HERO --}}
<section class="relative py-20 sm:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/90 via-dif-pink/75 to-dif-magenta/85"></div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 left-20 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden">
            <i class="fas fa-balance-scale mr-2"></i>TRANSPARENCIA
        </span>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">
            Ley General de Contabilidad Gubernamental
        </h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">
            Accede a los portales de transparencia y rendición de cuentas del DIF Tecámac.
        </p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- CARDS --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <h2 class="text-3xl font-extrabold text-dif-dark mb-4">Portales de Transparencia</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Consulta la información de transparencia a través de los siguientes organismos oficiales.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- SEVAC --}}
            <a href="https://www.gob.mx/imta/acciones-y-programas/sistema-de-evaluacion-de-armonizacion-contable-sevac-250543" target="_blank" rel="noopener noreferrer"
               class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-dif-pink/30 transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-1">
                <div class="h-52 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center p-6 group-hover:from-dif-cream group-hover:to-white transition-all duration-500">
                    <img src="/images/sevac.jpeg" alt="Sevac" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-dif-dark group-hover:text-dif-pink transition-colors">Sevac</h3>
                    <p class="text-sm text-gray-500 mt-2">Sistema de Evaluación de Armonización Contable</p>
                    <div class="mt-4 inline-flex items-center text-sm font-semibold text-dif-pink opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Visitar <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </a>

            {{-- CONAC --}}
            <a href="https://www.conac.gob.mx/" target="_blank" rel="noopener noreferrer"
               class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-dif-pink/30 transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-2">
                <div class="h-52 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center p-6 group-hover:from-dif-cream group-hover:to-white transition-all duration-500">
                    <img src="/images/conac.png" alt="Conac" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-dif-dark group-hover:text-dif-pink transition-colors">Conac</h3>
                    <p class="text-sm text-gray-500 mt-2">Consejo Nacional de Armonización Contable</p>
                    <div class="mt-4 inline-flex items-center text-sm font-semibold text-dif-pink opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Visitar <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </a>

            {{-- IPOMEX --}}
            <a href="https://ipomex.org.mx/ipomex/#/" target="_blank" rel="noopener noreferrer"
               class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-dif-pink/30 transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-3">
                <div class="h-52 bg-gradient-to-br from-cyan-50 to-cyan-100 flex items-center justify-center p-6 group-hover:from-dif-cream group-hover:to-white transition-all duration-500">
                    <img src="/images/ipomex.png" alt="Ipomex" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-dif-dark group-hover:text-dif-pink transition-colors">Ipomex</h3>
                    <p class="text-sm text-gray-500 mt-2">Información Pública de Oficio Mexiquense</p>
                    <div class="mt-4 inline-flex items-center text-sm font-semibold text-dif-pink opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Visitar <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </a>

            {{-- INFOEM --}}
            <a href="https://www.infoem.org.mx/es/content/informacion-publica" target="_blank" rel="noopener noreferrer"
               class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-dif-pink/30 transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-4">
                <div class="h-52 bg-gradient-to-br from-orange-50 to-orange-100 flex items-center justify-center p-6 group-hover:from-dif-cream group-hover:to-white transition-all duration-500">
                    <img src="/images/infoem.png" alt="Infoem" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-dif-dark group-hover:text-dif-pink transition-colors">Infoem</h3>
                    <p class="text-sm text-gray-500 mt-2">Instituto de Transparencia, Acceso a la Información Pública y Protección de Datos Personales del Estado de México</p>
                    <div class="mt-4 inline-flex items-center text-sm font-semibold text-dif-pink opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Visitar <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </a>

        </div>
    </div>
</section>

@endsection
