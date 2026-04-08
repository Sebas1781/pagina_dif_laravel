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
        @php
            $mapaTema = [
                'pink' => ['header' => 'from-dif-pink to-dif-magenta', 'hoverBorder' => 'hover:border-dif-pink/30', 'iconBg' => 'bg-dif-cream', 'iconHover' => 'group-hover:bg-dif-pink', 'iconText' => 'text-dif-pink', 'linkColor' => 'text-dif-pink'],
                'purple' => ['header' => 'from-purple-600 to-purple-400', 'hoverBorder' => 'hover:border-purple-300', 'iconBg' => 'bg-purple-50', 'iconHover' => 'group-hover:bg-purple-600', 'iconText' => 'text-purple-600', 'linkColor' => 'text-purple-600'],
                'red' => ['header' => 'from-red-500 to-rose-400', 'hoverBorder' => 'hover:border-red-300', 'iconBg' => 'bg-red-50', 'iconHover' => 'group-hover:bg-red-500', 'iconText' => 'text-red-500', 'linkColor' => 'text-dif-pink'],
                'blue' => ['header' => 'from-blue-600 to-blue-400', 'hoverBorder' => 'hover:border-blue-300', 'iconBg' => 'bg-blue-50', 'iconHover' => 'group-hover:bg-blue-600', 'iconText' => 'text-blue-600', 'linkColor' => 'text-blue-600'],
                'amber' => ['header' => 'from-amber-600 to-amber-400', 'hoverBorder' => 'hover:border-amber-300', 'iconBg' => 'bg-amber-50', 'iconHover' => 'group-hover:bg-amber-600', 'iconText' => 'text-amber-600', 'linkColor' => 'text-amber-600'],
                'teal' => ['header' => 'from-teal-600 to-teal-400', 'hoverBorder' => 'hover:border-teal-300', 'iconBg' => 'bg-teal-50', 'iconHover' => 'group-hover:bg-teal-600', 'iconText' => 'text-teal-600', 'linkColor' => 'text-teal-600'],
                'green' => ['header' => 'from-green-600 to-green-400', 'hoverBorder' => 'hover:border-green-300', 'iconBg' => 'bg-green-50', 'iconHover' => 'group-hover:bg-green-600', 'iconText' => 'text-green-600', 'linkColor' => 'text-green-600'],
            ];
        @endphp

        @foreach($categoriasServicios as $categoria)
            @php
                $tema = $mapaTema[$categoria->tema ?? 'pink'] ?? $mapaTema['pink'];
                $itemsCategoria = $serviciosPorCategoria->get($categoria->clave, collect());
            @endphp

            <div class="{{ $loop->last ? '' : 'mb-20' }} scroll-hidden">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br {{ $tema['header'] }} rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas {{ $categoria->icono ?: 'fa-check' }} text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-dif-dark">{{ $categoria->nombre }}</h2>
                        @if(!empty($categoria->subtitulo))
                            <p class="text-sm text-gray-400">{{ $categoria->subtitulo }}</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($itemsCategoria as $i => $s)
                        <div class="card-hover bg-white rounded-xl p-5 border border-gray-100 flex items-center gap-4 group {{ $tema['hoverBorder'] }} stagger-{{ ($i % 6) + 1 }}">
                            <div class="w-10 h-10 {{ $tema['iconBg'] }} rounded-lg flex items-center justify-center shrink-0 {{ $tema['iconHover'] }} transition-colors">
                                <i class="fas fa-check {{ $tema['iconText'] }} text-sm group-hover:text-white transition-colors"></i>
                            </div>
                            <span class="font-medium text-dif-dark text-sm">{{ $s->nombre }}</span>
                        </div>
                    @endforeach
                </div>

                @if($categoria->clave === 'salud')
                    <div class="mt-6">
                        <a href="{{ route('salud') }}" class="inline-flex items-center gap-2 {{ $tema['linkColor'] }} font-semibold hover:underline">
                            Ver detalle completo de salud <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                @endif

                @if($categoria->clave === 'educacion_cultura')
                    <div class="mt-6">
                        <a href="{{ route('educacion') }}" class="inline-flex items-center gap-2 {{ $tema['linkColor'] }} font-semibold hover:underline">
                            Ver detalle de educación y cultura <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

@endsection
