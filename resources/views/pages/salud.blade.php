@extends('layouts.app')
@section('title', 'DIF Tecámac - Salud')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/images/page1_img1.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute bottom-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden"><i class="fas fa-heartbeat mr-2"></i>ÁREA DE SALUD</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">Servicios de Salud</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">Atención médica integral para toda la familia tecamaquense.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- SERVICES LIST --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Servicios que <span class="text-dif-pink">Ofrecemos</span></h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Consultas médicas especializadas y terapias para la salud integral de la comunidad.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($saludServicios as $i => $servicio)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-2xl p-6 border border-gray-100 text-center group hover:border-dif-pink/30">
                <div class="w-14 h-14 mx-auto bg-gradient-to-br {{ $servicio->color_gradiente }} rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                    <i class="fas {{ $servicio->icono }} text-white text-xl"></i>
                </div>
                <h3 class="font-bold text-dif-dark text-sm">{{ $servicio->nombre }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- MEDICAL FACILITIES --}}
<section class="py-20 bg-dif-cream bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-hidden">
            <span class="inline-block bg-white text-dif-pink font-semibold text-sm px-4 py-1.5 rounded-full mb-4 shadow-sm">NUESTRAS SEDES MÉDICAS</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-dif-dark">Unidades <span class="text-dif-pink">Médicas</span></h2>
        </div>
        @php
            $temaUnidad = [
                'pink' => ['overlay' => 'from-dif-pink-dark/80 to-dif-magenta/80', 'hover' => 'hover:bg-dif-cream', 'icon' => 'text-dif-pink'],
                'green' => ['overlay' => 'from-green-900/80 to-green-700/80', 'hover' => 'hover:bg-green-50', 'icon' => 'text-green-600'],
                'blue' => ['overlay' => 'from-blue-900/80 to-blue-700/80', 'hover' => 'hover:bg-blue-50', 'icon' => 'text-blue-600'],
                'purple' => ['overlay' => 'from-purple-900/80 to-purple-700/80', 'hover' => 'hover:bg-purple-50', 'icon' => 'text-purple-600'],
                'teal' => ['overlay' => 'from-teal-900/80 to-teal-700/80', 'hover' => 'hover:bg-teal-50', 'icon' => 'text-teal-600'],
                'amber' => ['overlay' => 'from-amber-900/80 to-amber-700/80', 'hover' => 'hover:bg-amber-50', 'icon' => 'text-amber-600'],
            ];
        @endphp

        @foreach($unidadesMedicas as $i => $unidad)
            @php
                $tema = $temaUnidad[$unidad->tema ?? 'pink'] ?? $temaUnidad['pink'];
                $invertida = $i % 2 === 1;
                $src = null;
                if (!empty($unidad->imagen)) {
                    $src = str_starts_with($unidad->imagen, 'unidades_medicas/') ? asset('storage/' . $unidad->imagen) : asset('images/' . $unidad->imagen);
                }
            @endphp

            <div class="scroll-hidden {{ $loop->last ? '' : 'mb-10' }}">
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex {{ $invertida ? 'lg:flex-row-reverse' : '' }}">
                    <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                        <img src="{{ $src ?: asset('images/page1_img8.png') }}" alt="{{ $unidad->nombre }}" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $tema['overlay'] }}"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas {{ $unidad->icono ?: 'fa-hospital' }} text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-extrabold mb-2">{{ $unidad->nombre }}</h3>
                            @if(!empty($unidad->subtitulo))
                                <p class="text-white/90 text-sm font-medium mb-2">{{ $unidad->subtitulo }}</p>
                            @endif
                            @if(!empty($unidad->direccion))
                                <p class="text-white/80 text-sm"><i class="fas fa-map-marker-alt mr-2"></i>{{ $unidad->direccion }}</p>
                            @endif
                            <div class="mt-4 space-y-1">
                                @if(!empty($unidad->horario_1))
                                    <p class="text-sm"><i class="fas fa-clock mr-2"></i>{{ $unidad->horario_1 }}</p>
                                @endif
                                @if(!empty($unidad->horario_2))
                                    <p class="text-sm"><i class="fas fa-clock mr-2"></i>{{ $unidad->horario_2 }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-2/3 p-8">
                        <h4 class="font-bold text-dif-dark mb-4 text-lg">Servicios disponibles:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach(($unidad->servicios ?? []) as $servicio)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 {{ $tema['hover'] }} transition-colors">
                                    <i class="fas fa-check-circle {{ $tema['icon'] }}"></i>
                                    <span class="text-sm text-dif-dark font-medium">{{ $servicio }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection
