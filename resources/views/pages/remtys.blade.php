@extends('layouts.app')
@section('title', 'DIF Tecámac - REMTYS')

@section('content')

{{-- HERO --}}
<section class="relative py-20 sm:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dif-pink-dark/90 via-dif-pink/75 to-dif-magenta/85"></div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-20 right-20 w-72 h-72 bg-dif-pink-light/20 rounded-full blur-3xl animate-float"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block bg-white/15 text-white font-semibold text-sm px-5 py-2 rounded-full mb-6 scroll-hidden">
            <i class="fas fa-file-lines mr-2"></i>TRÁMITES Y SERVICIOS
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 scroll-hidden stagger-1">
            REMTYS
        </h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto scroll-hidden stagger-2">
            Registro Municipal de Trámites y Servicios
        </p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- ABOUT REMTYS --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-16 scroll-hidden">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-1 h-12 bg-gradient-to-b from-dif-pink to-dif-magenta rounded-full"></div>
                <h2 class="text-3xl font-extrabold text-dif-dark">¿Qué es el REMTYS?</h2>
            </div>
            <p class="text-gray-600 leading-relaxed text-lg">
                Conoce el Registro Municipal de Trámites y Servicios (REMTYS), una herramienta diseñada para brindar a la ciudadanía información clara, precisa y actualizada sobre los trámites y servicios que ofrece el municipio. Aquí encontrarás requisitos, costos, tiempos de atención y puntos de contacto, fomentando la transparencia, la eficiencia administrativa y el derecho a un buen servicio público.
            </p>
        </div>

        {{-- CATEGORIAS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
            @foreach($remtysCards as $i => $card)
                <a href="{{ route('remtys', ['categoria' => $card->id]) }}#tramites" class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 scroll-hidden stagger-{{ ($i % 6) + 1 }}">
                    <div class="h-56 bg-gradient-to-br {{ $card->color_gradiente }} flex items-end relative p-6">
                        <div class="absolute top-6 left-6 w-14 h-14 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                            <i class="fas {{ $card->icono }} text-white text-2xl"></i>
                        </div>
                        <div class="absolute top-5 right-6 text-white/30 text-5xl"><i class="fas fa-check"></i></div>
                        <div class="relative z-10 max-w-full">
                            <p class="text-lg md:text-xl font-extrabold text-white uppercase leading-snug break-words">{{ $card->nombre }}</p>
                            <p class="text-white/90 mt-2 text-lg">Ver tramites <i class="fas fa-arrow-down ml-2"></i></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- TABLA DE TRAMITES --}}
        <div id="tramites" class="rounded-2xl border border-gray-200 overflow-hidden bg-gray-50">
            <div class="px-8 py-6 border-b border-gray-200 bg-white flex items-center justify-between gap-4 flex-wrap">
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $remtysCategoriaSeleccionada?->nombre }} - Tramites y Servicios</h3>
                <a href="{{ route('remtys') }}" class="text-gray-400 hover:text-gray-600 text-4xl leading-none">&times;</a>
            </div>

            <div class="p-8 bg-white border-b border-gray-200 flex justify-end">
                <input type="text" id="buscarTramite" placeholder="Buscar tramite..." class="w-full max-w-sm px-4 py-2.5 border border-gray-300 rounded-lg text-sm">
            </div>

            <div class="p-8 bg-white">
                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="w-full text-sm" id="tablaTramites">
                        <thead class="bg-dif-pink-dark text-white">
                            <tr>
                                <th class="px-5 py-3.5 text-left w-14">#</th>
                                <th class="px-5 py-3.5 text-left">Tramite / Servicio</th>
                                <th class="px-5 py-3.5 text-left w-36">Archivo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse(($remtysCategoriaSeleccionada?->documentos ?? collect()) as $doc)
                                <tr class="tramite-row">
                                    <td class="px-5 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 font-medium text-slate-800 tramite-titulo">{{ $doc->titulo }}</td>
                                    <td class="px-5 py-4">
                                        <a href="{{ $doc->archivo ? asset('storage/' . $doc->archivo) : $doc->url }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-dif-pink-dark text-white font-semibold text-xs hover:bg-dif-pink transition-colors"><i class="fas fa-file-alt"></i> Ver</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-5 py-10 text-center text-gray-400">No hay tramites en esta categoria.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    const input = document.getElementById('buscarTramite');
    const rows = Array.from(document.querySelectorAll('.tramite-row'));

    if (!input || rows.length === 0) return;

    input.addEventListener('input', function () {
        const term = this.value.toLowerCase().trim();
        rows.forEach((row) => {
            const text = row.querySelector('.tramite-titulo')?.textContent?.toLowerCase() || '';
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
})();
</script>

@endsection
