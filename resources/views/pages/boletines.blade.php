@extends('layouts.app')
@section('title', 'DIF Tecámac - Boletines')

@section('content')

{{-- HERO --}}
<section class="relative py-20 sm:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/90 via-dif-pink/75 to-dif-magenta/85"></div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 right-20 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white mb-6 scroll-hidden stagger-1 uppercase">
            Boletines
        </h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">
            Mantente informado sobre las actividades y eventos del DIF Tecámac.
        </p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- BOLETINES GRID --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($boletines->isEmpty())
            <p class="text-center text-gray-400 py-16">No hay boletines disponibles por el momento.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($boletines as $i => $boletin)
                    @php
                        $stagger = ($i % 6) + 1;
                        $src = $boletin->imagen
                            ? (str_starts_with($boletin->imagen, 'boletines/')
                                ? asset('storage/' . $boletin->imagen)
                                : asset('images/' . $boletin->imagen))
                            : null;
                    @endphp
                    <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-{{ $stagger }}">
                        @if($src)
                            <div class="h-64 overflow-hidden">
                                <img src="{{ $src }}" alt="{{ $boletin->titulo }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">
                                {{ $boletin->titulo }}
                            </h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ $boletin->descripcion }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
