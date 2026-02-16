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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Tardes de Serenata --}}
            <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-1">
                <div class="h-64 overflow-hidden">
                    <img src="/images/serenata.png" alt="Tardes de Serenata" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">Tardes de Serenata</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Tardes de Serenata en Tecámac nos regaló una jornada llena de sentimiento, donde el Mariachi Municipal "Orgullo de Tecámac" acompañó cada dedicatoria dada con el corazón.
                    </p>
                </div>
            </div>

            {{-- Bodas Comunitarias --}}
            <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-2">
                <div class="h-64 overflow-hidden">
                    <img src="/images/bodas.png" alt="Bodas Comunitarias 2026" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">Bodas Comunitarias 2026: Tecámac, Late por Ti</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim.
                    </p>
                </div>
            </div>

            {{-- Apoyo a Comunidades Escolares --}}
            <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-3">
                <div class="h-64 overflow-hidden">
                    <img src="/images/apoyo-comunidades.png" alt="Apoyo a Comunidades Escolares" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">Apoyo a Comunidades Escolares</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Apoyo a Comunidades Escolares", por instrucciones de nuestra Presidenta Municipal Rosi Wong, fortaleciendo así los espacios educativos y brindando mejores condiciones para nuestras niñas, niños y jóvenes.
                    </p>
                </div>
            </div>

            {{-- Bienestar para los Hombres --}}
            <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-4">
                <div class="h-64 overflow-hidden">
                    <img src="/images/bienestar.png" alt="Bienestar para los Hombres de Tecámac" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">Bienestar para los Hombres de Tecámac</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Por instrucciones de nuestra Presidenta Municipal, Rosi Wong llevamos a cabo la Jornada de Cuidado Integral del Hombre en el, acercando servicios de salud gratuitos a nuestra comunidad.
                    </p>
                </div>
            </div>

            {{-- Inauguración de Cursos y Talleres --}}
            <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-5">
                <div class="h-64 overflow-hidden">
                    <img src="/images/cursos.png" alt="Inauguración de Cursos y Talleres" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">Inauguración de Cursos y Talleres</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Con el compromiso de seguir construyendo un Tecámac incluyente y respetuoso, iniciamos nuestros cursos en los Centros de Atención Integral a la Diversidad Sexual.
                    </p>
                </div>
            </div>

            {{-- Atmósfera Mundialista 2026 --}}
            <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 scroll-hidden stagger-6">
                <div class="h-64 overflow-hidden">
                    <img src="/images/atmosfera.png" alt="Atmósfera Mundialista 2026" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-extrabold text-dif-dark uppercase mb-3">Atmósfera Mundialista 2026</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Estamos a menos de un mes de iniciar este gran festival, no te lo puedes perder. ¡Atmósfera Mundialista 2026!
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
