@extends('layouts.app')
@section('title', 'DIF Tecámac - ' . $boletin->titulo)

@section('content')

{{-- HERO --}}
<section class="relative py-20 sm:py-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/90 via-dif-pink/75 to-dif-magenta/85"></div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 right-20 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <a href="{{ route('boletines') }}" class="inline-flex items-center gap-2 text-white/70 hover:text-white text-sm font-medium mb-6 transition-colors duration-200">
            <i class="fas fa-arrow-left text-xs"></i> Todos los boletines
        </a>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight uppercase scroll-hidden stagger-1">
            {{ $boletin->titulo }}
        </h1>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- CONTENIDO --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-12">

            {{-- Contenido principal --}}
            <div class="lg:col-span-2">
                @php
                    $src = $boletin->imagen
                        ? (str_starts_with($boletin->imagen, 'boletines/')
                            ? asset('storage/' . $boletin->imagen)
                            : asset('images/' . $boletin->imagen))
                        : null;
                @endphp

                @if($src)
                    <div class="rounded-2xl overflow-hidden shadow-lg mb-8 scroll-hidden">
                        <img src="{{ $src }}" alt="{{ $boletin->titulo }}"
                             class="w-full object-cover max-h-[500px]"
                             id="boletin-img-trigger">
                    </div>
                @endif

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed scroll-hidden stagger-1">
                    {!! nl2br(e($boletin->descripcion)) !!}
                </div>

                @if($boletin->url_referencia)
                    <div class="mt-8 p-5 bg-dif-pink/5 border border-dif-pink/20 rounded-2xl flex items-center gap-4 scroll-hidden stagger-2">
                        <div class="w-10 h-10 rounded-xl bg-dif-pink/15 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-link text-dif-pink text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Más información</p>
                            <a href="{{ $boletin->url_referencia }}" target="_blank" rel="noopener noreferrer"
                               class="text-dif-pink font-semibold text-sm hover:underline break-all">
                                {{ $boletin->url_referencia }}
                                <i class="fas fa-external-link-alt text-[10px] ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="mt-10 pt-6 border-t border-gray-100 scroll-hidden stagger-2">
                    <a href="{{ route('boletines') }}"
                       class="inline-flex items-center gap-2 text-dif-pink font-semibold hover:underline text-sm transition-all duration-200">
                        <i class="fas fa-arrow-left text-xs"></i> Volver a boletines
                    </a>
                </div>
            </div>

            {{-- Sidebar: boletines recientes --}}
            <aside class="mt-12 lg:mt-0">
                <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-5">Otros boletines</h3>
                <div class="flex flex-col gap-5">
                    @forelse($recientes as $reciente)
                        @php
                            $rSrc = $reciente->imagen
                                ? (str_starts_with($reciente->imagen, 'boletines/')
                                    ? asset('storage/' . $reciente->imagen)
                                    : asset('images/' . $reciente->imagen))
                                : null;
                        @endphp
                        <a href="{{ route('boletines.show', $reciente) }}"
                           class="group flex gap-4 items-start bg-gray-50 hover:bg-dif-pink/5 rounded-xl p-3 transition-colors duration-200">
                            @if($rSrc)
                                <img src="{{ $rSrc }}" alt="{{ $reciente->titulo }}"
                                     class="w-20 h-14 object-cover rounded-lg flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-20 h-14 rounded-lg bg-dif-pink/10 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-newspaper text-dif-pink opacity-40"></i>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-dif-dark uppercase line-clamp-2 group-hover:text-dif-pink transition-colors duration-200">
                                    {{ $reciente->titulo }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $reciente->descripcion }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-gray-400">No hay otros boletines.</p>
                    @endforelse
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection
