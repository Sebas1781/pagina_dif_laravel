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
            @php
            $servicios = [
                ['Consulta médica', 'fa-user-doctor', 'from-dif-pink to-dif-magenta'],
                ['Terapia psicológica', 'fa-brain', 'from-purple-600 to-purple-400'],
                ['Consulta nutricional', 'fa-apple-whole', 'from-green-600 to-green-400'],
                ['Consulta dental', 'fa-tooth', 'from-blue-500 to-blue-400'],
                ['Consulta ginecología', 'fa-venus', 'from-pink-500 to-pink-400'],
                ['Consulta pediatra', 'fa-baby', 'from-cyan-500 to-cyan-400'],
                ['Terapia física', 'fa-person-walking', 'from-orange-500 to-orange-400'],
                ['Terapia ocupacional', 'fa-hands', 'from-teal-600 to-teal-400'],
                ['Terapia de lenguaje', 'fa-comments', 'from-indigo-500 to-indigo-400'],
                ['Equinoterapia', 'fa-horse', 'from-amber-600 to-amber-400'],
                ['Clase de monta', 'fa-horse-head', 'from-yellow-600 to-yellow-400'],
                ['Salud en tu hogar', 'fa-house-medical', 'from-red-500 to-red-400'],
                ['Certificado de discapacidad', 'fa-id-card', 'from-slate-600 to-slate-400'],
                ['Lengua de señas mexicana', 'fa-hands-asl-interpreting', 'from-violet-600 to-violet-400'],
                ['Lectura y escritura braille', 'fa-braille', 'from-stone-600 to-stone-400'],
                ['Curso de oftalmología', 'fa-eye', 'from-sky-600 to-sky-400'],
            ];
            @endphp

            @foreach($servicios as $i => $servicio)
            <div class="card-hover scroll-hidden stagger-{{ ($i % 6) + 1 }} bg-white rounded-2xl p-6 border border-gray-100 text-center group hover:border-dif-pink/30">
                <div class="w-14 h-14 mx-auto bg-gradient-to-br {{ $servicio[2] }} rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                    <i class="fas {{ $servicio[1] }} text-white text-xl"></i>
                </div>
                <h3 class="font-bold text-dif-dark text-sm">{{ $servicio[0] }}</h3>
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

        {{-- Facility 1: Unidad Médica Mandarinas --}}
        <div class="scroll-hidden mb-10">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex">
                <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                    <img src="/images/page1_img8.png" alt="" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/80 to-dif-magenta/80"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-hospital text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">Unidad Médica Mandarinas</h3>
                        <p class="text-white/80 text-sm"><i class="fas fa-map-marker-alt mr-2"></i>Fracc. Ojo de Agua, calle Mandarinas, esq. Naranjos, C.P. 55770</p>
                        <div class="mt-4 space-y-1">
                            <p class="text-sm"><i class="fas fa-clock mr-2"></i>Lunes a Viernes: 9:00 - 18:00 hrs</p>
                            <p class="text-sm"><i class="fas fa-clock mr-2"></i>Sábados: 9:00 - 13:00 hrs</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-2/3 p-8">
                    <h4 class="font-bold text-dif-dark mb-4 text-lg">Servicios disponibles:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Consulta médica', 'Terapia psicológica', 'Consulta Nutrición', 'Consulta Dental', 'Salud en tu hogar', 'Consulta ginecología', 'Consulta pediatra', 'Curso de oftalmología'] as $s)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-dif-cream transition-colors">
                            <i class="fas fa-check-circle text-dif-pink"></i>
                            <span class="text-sm text-dif-dark font-medium">{{ $s }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Facility 2: Centro de Equinoterapia --}}
        <div class="scroll-hidden mb-10">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex lg:flex-row-reverse">
                <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                    <img src="/images/page1_img29.png" alt="" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-900/80 to-green-700/80"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-horse text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">Centro de Equinoterapia</h3>
                        <p class="text-white/80 text-sm"><i class="fas fa-map-marker-alt mr-2"></i>Carretera Federal México – Pachuca, Km. 38, Sierra Hermosa, 55740</p>
                        <p class="mt-4 text-sm"><i class="fas fa-clock mr-2"></i>Lunes a Viernes: 9:00 - 15:00 hrs</p>
                    </div>
                </div>
                <div class="lg:w-2/3 p-8">
                    <h4 class="font-bold text-dif-dark mb-4 text-lg">Servicios disponibles:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Equinoterapia', 'Clase de monta', 'Terapia psicológica', 'Terapia de lenguaje', 'Lengua de señas mexicanas', 'Lectura y escritura de braille'] as $s)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-green-50 transition-colors">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-sm text-dif-dark font-medium">{{ $s }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Facility 3: Clínica Materno Infantil --}}
        <div class="scroll-hidden mb-10">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex">
                <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                    <img src="/images/page1_img38.png" alt="" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 to-blue-700/80"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-baby text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">Clínica Materno Infantil</h3>
                        <p class="text-dif-pink-light text-sm font-medium mb-2">Juana Belén Gutiérrez de Mendoza</p>
                        <p class="text-white/80 text-sm"><i class="fas fa-map-marker-alt mr-2"></i>Av. Esmeralda S/N colonia Lomas de Tecámac, Tecámac, Méx.</p>
                        <p class="mt-4 text-sm"><i class="fas fa-clock mr-2"></i>Lunes a Viernes: 9:00 - 18:00 hrs</p>
                    </div>
                </div>
                <div class="lg:w-2/3 p-8">
                    <h4 class="font-bold text-dif-dark mb-4 text-lg">Servicios disponibles:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Consulta médica', 'Terapia psicológica', 'Consulta nutricional', 'Consulta dental', 'Consulta ginecología', 'Consulta pediatra', 'Curso de oftalmología'] as $s)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-blue-50 transition-colors">
                            <i class="fas fa-check-circle text-blue-600"></i>
                            <span class="text-sm text-dif-dark font-medium">{{ $s }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Facility 4: U.B.R.I.S --}}
        <div class="scroll-hidden mb-10">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex lg:flex-row-reverse">
                <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                    <img src="/images/page1_img37.png" alt="" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-900/80 to-purple-700/80"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-wheelchair text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">U.B.R.I.S</h3>
                        <p class="text-purple-200 text-sm mb-2">Unidad Básica de Rehabilitación e Integración Social</p>
                        <p class="text-white/80 text-sm"><i class="fas fa-map-marker-alt mr-2"></i>Mandarinas S/N Esq. Naranjos, Col. Fracc. Ojo de Agua, C.P. 55770</p>
                        <p class="mt-4 text-sm"><i class="fas fa-clock mr-2"></i>Lunes a Viernes: 9:00 - 15:00 hrs</p>
                    </div>
                </div>
                <div class="lg:w-2/3 p-8">
                    <h4 class="font-bold text-dif-dark mb-4 text-lg">Servicios disponibles:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Consulta con médico especialista en rehabilitación', 'Certificado de discapacidad', 'Terapia física', 'Terapia ocupacional', 'Terapia psicológica', 'Terapia de lenguaje', 'Curso de lengua de señas mexicana', 'Curso lectura y escritura de braille'] as $s)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-purple-50 transition-colors">
                            <i class="fas fa-check-circle text-purple-600"></i>
                            <span class="text-sm text-dif-dark font-medium">{{ $s }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Facility 5: Unidad Médica Reyes Acozac --}}
        <div class="scroll-hidden mb-10">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex">
                <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                    <img src="/images/page1_img11.png" alt="" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-900/80 to-teal-700/80"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-stethoscope text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">Unidad Médica Reyes Acozac</h3>
                        <p class="text-white/80 text-sm"><i class="fas fa-map-marker-alt mr-2"></i>C. Niños Héroes No. 14, Barrio el Calvario, Pueblo de los Reyes Acozac, C.P. 55755</p>
                        <p class="mt-4 text-sm"><i class="fas fa-clock mr-2"></i>Lunes a Viernes: 9:00 - 18:00 hrs</p>
                    </div>
                </div>
                <div class="lg:w-2/3 p-8">
                    <h4 class="font-bold text-dif-dark mb-4 text-lg">Servicios disponibles:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Consulta médica', 'Terapia psicológica', 'Consulta Nutrición', 'Consulta Dental', 'Terapia Física', 'Curso de lengua de señas mexicana', 'Curso lectura y escritura de braille'] as $s)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-teal-50 transition-colors">
                            <i class="fas fa-check-circle text-teal-600"></i>
                            <span class="text-sm text-dif-dark font-medium">{{ $s }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Facility 6: Laboratorio --}}
        <div class="scroll-hidden">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 lg:flex lg:flex-row-reverse">
                <div class="lg:w-1/3 relative p-8 flex flex-col justify-center text-white overflow-hidden min-h-[280px]">
                    <img src="/images/page1_img21.png" alt="" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-900/80 to-amber-700/80"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-flask text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">Laboratorio de Análisis Clínicos</h3>
                        <p class="mt-4 text-sm"><i class="fas fa-clock mr-2"></i>Lunes a Viernes: 9:00 - 15:00 hrs</p>
                    </div>
                </div>
                <div class="lg:w-2/3 p-8">
                    <h4 class="font-bold text-dif-dark mb-4 text-lg">Estudios disponibles:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Química sanguínea de 25 elementos', 'Examen General de Orina', 'Biometría Hemática', 'Paquete promoción (QS 25, EGO, BH)', 'Prueba de antígeno prostático', 'Prueba de embarazo', 'Prueba de antidoping', 'Grupo sanguíneo y factor RH', 'VSG'] as $s)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-amber-50 transition-colors">
                            <i class="fas fa-check-circle text-amber-600"></i>
                            <span class="text-sm text-dif-dark font-medium">{{ $s }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
