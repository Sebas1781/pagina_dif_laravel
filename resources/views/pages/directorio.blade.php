@extends('layouts.app')
@section('title', 'DIF Tecámac - Directorio')

@section('content')

{{-- HERO --}}
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/images/page1_img7.png" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/85 via-dif-pink/70 to-dif-magenta/80"></div>
    </div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute bottom-10 right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden"><i class="fas fa-map-location-dot mr-2"></i>DIRECTORIO</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">Directorio</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">Encuentra la sede más cercana con sus horarios y servicios disponibles.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- DIRECTORY CARDS --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
        $directorio = [
            [
                'name' => 'Oficinas Centrales DIF Villas del Real',
                'address' => 'Av. Esmeralda S/N colonia Lomas de Tecámac, Tecámac, Méx.',
                'schedule' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icon' => 'fa-building',
                'gradient' => 'from-dif-pink to-dif-magenta',
                'services' => ['Atención ciudadana', 'Información general', 'Trámites administrativos'],
            ],
            [
                'name' => 'Unidad Médica Mandarinas',
                'address' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'schedule' => 'Lunes a Viernes: 9:00 - 18:00 hrs | Sábados: 9:00 - 13:00 hrs',
                'icon' => 'fa-hospital',
                'gradient' => 'from-dif-pink to-dif-pink-light',
                'services' => ['Consulta médica', 'Terapia psicológica', 'Consulta Nutrición', 'Consulta Dental', 'Salud en tu hogar'],
            ],
            [
                'name' => 'Centro de Equinoterapia',
                'address' => 'Carretera Federal México – Pachuca, Km. 38, Sierra Hermosa, 55740 Tecámac',
                'schedule' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icon' => 'fa-horse',
                'gradient' => 'from-green-700 to-green-500',
                'services' => ['Equinoterapia', 'Clase de monta', 'Terapia psicológica', 'Terapia de lenguaje', 'Lengua de señas mexicanas'],
            ],
            [
                'name' => 'Clínica Materno Infantil Juana Belén Gutiérrez de Mendoza',
                'address' => 'Av. Esmeralda S/N colonia Lomas de Tecámac, Tecámac, Méx.',
                'schedule' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icon' => 'fa-baby',
                'gradient' => 'from-blue-700 to-blue-500',
                'services' => ['Consulta médica', 'Terapia psicológica', 'Consulta nutricional', 'Consulta dental', 'Ginecología', 'Pediatra'],
            ],
            [
                'name' => 'U.B.R.I.S',
                'address' => 'Mandarinas S/N Esq. Naranjos, Col. Fracc. Ojo de Agua, C.P. 55770',
                'schedule' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icon' => 'fa-wheelchair',
                'gradient' => 'from-purple-700 to-purple-500',
                'services' => ['Médico especialista en rehabilitación', 'Certificado de discapacidad', 'Terapia física', 'Terapia ocupacional', 'Terapia de lenguaje', 'Braille'],
            ],
            [
                'name' => 'Unidad Médica Reyes Acozac',
                'address' => 'C. Niños Héroes No. 14, Barrio el Calvario, Pueblo de los Reyes Acozac, C.P. 55755',
                'schedule' => 'Lunes a Viernes: 9:00 - 18:00 hrs',
                'icon' => 'fa-stethoscope',
                'gradient' => 'from-teal-700 to-teal-500',
                'services' => ['Consulta médica', 'Terapia psicológica', 'Consulta Nutrición', 'Consulta Dental', 'Terapia Física'],
            ],
            [
                'name' => 'Laboratorio de Análisis Clínicos',
                'address' => 'Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770',
                'schedule' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icon' => 'fa-flask',
                'gradient' => 'from-amber-700 to-amber-500',
                'services' => ['Química sanguínea 25 elementos', 'Examen General de Orina', 'Biometría Hemática', 'Antígeno prostático', 'Prueba de embarazo'],
            ],
            [
                'name' => 'Centro de Diversidad Los Héroes Tecámac',
                'address' => 'Col. Héroes de Tecámac, Ojo de Agua, Méx.',
                'schedule' => 'Lunes a Viernes: 9:00 - 15:00 hrs',
                'icon' => 'fa-people-group',
                'gradient' => 'from-indigo-700 to-indigo-500',
                'services' => ['Atención a la diversidad', 'Asesoría psicológica', 'Programas de inclusión'],
            ],
        ];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($directorio as $i => $dir)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="bg-gradient-to-r {{ $dir['gradient'] }} p-6 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-pattern opacity-10"></div>
                    <div class="relative z-10 flex items-start gap-4">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center shrink-0">
                            <i class="fas {{ $dir['icon'] }} text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-lg leading-tight">{{ $dir['name'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3 mb-5">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-dif-pink mt-1 shrink-0"></i>
                            <span class="text-sm text-gray-600">{{ $dir['address'] }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-dif-pink mt-1 shrink-0"></i>
                            <span class="text-sm text-gray-600">{{ $dir['schedule'] }}</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-3">Servicios principales:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($dir['services'] as $service)
                            <span class="text-xs bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg border border-gray-100 hover:bg-dif-cream hover:text-dif-pink hover:border-dif-pink/30 transition-colors cursor-default">{{ $service }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CONTACT CTA --}}
<section class="py-20 bg-dif-cream bg-pattern">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center scroll-scale">
        <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">
            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-dif-pink to-dif-magenta rounded-2xl flex items-center justify-center mb-6 shadow-lg animate-pulse-glow">
                <i class="fas fa-phone text-white text-3xl"></i>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-dif-dark mb-4">¿Necesitas más información?</h2>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto">Acude a cualquiera de nuestras sedes o contáctanos a través de nuestras redes sociales. Estamos para servirte.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://www.facebook.com/profile.php?id=100069002108088" class="inline-flex items-center gap-2 bg-dif-pink text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-dif-pink-dark hover:scale-105 transition-all duration-300">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>

            </div>
        </div>
    </div>
</section>

@endsection
