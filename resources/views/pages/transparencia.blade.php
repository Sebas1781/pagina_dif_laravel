@extends('layouts.app')
@section('title', 'DIF TecÃ¡mac - Transparencia')

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
            Accede a los portales de transparencia y rendiciÃ³n de cuentas del DIF TecÃ¡mac.
        </p>
    </div>
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none"><path d="M0 60L60 52C120 44 240 28 360 24C480 20 600 28 720 40C840 52 960 68 1080 72C1200 76 1320 68 1380 64L1440 60V120H0V60Z" fill="white"/></svg>
    </div>
</section>

{{-- SEVAC --}}
<section id="sevac" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12 scroll-hidden">
            <span class="inline-block bg-dif-pink/10 text-dif-pink font-semibold text-sm px-5 py-2 rounded-full mb-4">
                <i class="fas fa-chart-bar mr-2"></i>SEVAC
            </span>
            <h2 class="text-3xl font-extrabold text-dif-dark mb-4">Sistema de Evaluación de Armonización Contable</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Selecciona el periodo que deseas consultar.</p>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-12 scroll-hidden stagger-1">
            @foreach($sevacAnios as $anio)
            <button
                onclick="showSevacTab('sevac-{{ $anio }}')"
                id="btn-sevac-{{ $anio }}"
                class="sevac-tab-btn px-5 py-2.5 rounded-full text-sm font-semibold border-2 bg-white text-dif-dark border-gray-200 hover:border-dif-pink hover:text-dif-pink transition-all duration-300 cursor-pointer">
                SEVAC {{ $anio }}
            </button>
            @endforeach
        </div>

        {{-- Tab Content Panels (dinámicos desde BD) --}}
        <div class="min-h-64">
            @foreach($sevacData as $anio => $secciones)
            <div id="panel-sevac-{{ $anio }}" class="sevac-panel hidden">
                <div class="space-y-8">
                    @foreach($secciones as $sectionTitle => $docs)
                    <div>
                        <h4 class="text-base font-extrabold text-dif-dark uppercase tracking-wide mb-3 pb-2 border-b-2 border-dif-pink/30">
                            {{ $sectionTitle }}
                        </h4>
                        <div class="border border-gray-200 rounded overflow-hidden">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach($docs as $i => $doc)
                                <a href="{{ $doc->url }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-2 px-4 py-3 border-b border-r border-gray-200 hover:bg-red-50 transition-colors duration-150 group
                                          {{ ($i % 4 === 3) ? 'lg:border-r-0' : '' }}">
                                    <i class="fas fa-file-pdf text-dif-pink text-sm shrink-0"></i>
                                    <span class="text-xs font-semibold text-dif-pink uppercase leading-tight group-hover:underline">{{ $doc->nombre }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- CONAC --}}
<section id="conac" class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12 scroll-hidden">
            <span class="inline-block bg-dif-pink/10 text-dif-pink font-semibold text-sm px-5 py-2 rounded-full mb-4">
                <i class="fas fa-landmark mr-2"></i>CONAC
            </span>
            <h2 class="text-3xl font-extrabold text-dif-dark mb-4">Consejo Nacional de Armonización Contable</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Selecciona el periodo que deseas consultar.</p>
        </div>

        @if(count($conacAnios) > 0)

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-12 scroll-hidden stagger-1">
            @foreach($conacAnios as $anio)
            <button
                onclick="showConacTab('conac-{{ $anio }}')"
                id="btn-conac-{{ $anio }}"
                class="conac-tab-btn px-5 py-2.5 rounded-full text-sm font-semibold border-2 bg-white text-dif-dark border-gray-200 hover:border-dif-pink hover:text-dif-pink transition-all duration-300 cursor-pointer">
                CONAC {{ $anio }}
            </button>
            @endforeach
        </div>

        {{-- Tab Content Panels --}}
        <div class="min-h-64">
            @foreach($conacData as $anio => $secciones)
            <div id="panel-conac-{{ $anio }}" class="conac-panel hidden">
                <div class="space-y-8">
                    @foreach($secciones as $sectionTitle => $docs)
                    <div>
                        <h4 class="text-base font-extrabold text-dif-dark uppercase tracking-wide mb-3 pb-2 border-b-2 border-dif-pink/30">
                            {{ $sectionTitle }}
                        </h4>
                        <div class="border border-gray-200 rounded overflow-hidden">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach($docs as $i => $doc)
                                <a href="{{ $doc->url }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-2 px-4 py-3 border-b border-r border-gray-200 hover:bg-red-50 transition-colors duration-150 group
                                          {{ ($i % 4 === 3) ? 'lg:border-r-0' : '' }}">
                                    <i class="fas fa-file-pdf text-dif-pink text-sm shrink-0"></i>
                                    <span class="text-xs font-semibold text-dif-pink uppercase leading-tight group-hover:underline">{{ $doc->nombre }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-20 text-gray-400">
            <i class="fas fa-folder-open text-5xl mb-4 block"></i>
            <p class="text-lg font-medium">Próximamente</p>
            <p class="text-sm mt-1">Los documentos CONAC estarán disponibles en breve.</p>
        </div>
        @endif

    </div>
</section>

{{-- PRESUPUESTO --}}
<section id="presupuesto" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12 scroll-hidden">
            <span class="inline-block bg-dif-pink/10 text-dif-pink font-semibold text-sm px-5 py-2 rounded-full mb-4">
                <i class="fas fa-coins mr-2"></i>PRESUPUESTO
            </span>
            <h2 class="text-3xl font-extrabold text-dif-dark mb-4">Presupuesto y Ejercicio del Gasto</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Selecciona el periodo que deseas consultar.</p>
        </div>

        @if(count($presupuestoAnios) > 0)

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-12 scroll-hidden stagger-1">
            @foreach($presupuestoAnios as $anio)
            <button
                onclick="showPresupuestoTab('presupuesto-{{ $anio }}')"
                id="btn-presupuesto-{{ $anio }}"
                class="presupuesto-tab-btn px-5 py-2.5 rounded-full text-sm font-semibold border-2 bg-white text-dif-dark border-gray-200 hover:border-dif-pink hover:text-dif-pink transition-all duration-300 cursor-pointer">
                Presupuesto {{ $anio }}
            </button>
            @endforeach
        </div>

        {{-- Tab Content Panels --}}
        <div class="min-h-64">
            @foreach($presupuestoData as $anio => $secciones)
            <div id="panel-presupuesto-{{ $anio }}" class="presupuesto-panel hidden">
                <div class="space-y-8">
                    @foreach($secciones as $sectionTitle => $docs)
                    <div>
                        <h4 class="text-base font-extrabold text-dif-dark uppercase tracking-wide mb-3 pb-2 border-b-2 border-dif-pink/30">
                            {{ $sectionTitle }}
                        </h4>
                        <div class="border border-gray-200 rounded overflow-hidden">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach($docs as $i => $doc)
                                <a href="{{ $doc->url }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-2 px-4 py-3 border-b border-r border-gray-200 hover:bg-red-50 transition-colors duration-150 group
                                          {{ ($i % 4 === 3) ? 'lg:border-r-0' : '' }}">
                                    <i class="fas fa-file-pdf text-dif-pink text-sm shrink-0"></i>
                                    <span class="text-xs font-semibold text-dif-pink uppercase leading-tight group-hover:underline">{{ $doc->nombre }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-20 text-gray-400">
            <i class="fas fa-folder-open text-5xl mb-4 block"></i>
            <p class="text-lg font-medium">Próximamente</p>
            <p class="text-sm mt-1">Los documentos de Presupuesto estarán disponibles en breve.</p>
        </div>
        @endif

    </div>
</section>

<script>
    const sevacIds = [@foreach($sevacAnios as $anio)'sevac-{{ $anio }}',@endforeach];
    const conacIds = [@foreach($conacAnios as $anio)'conac-{{ $anio }}',@endforeach];
    const presupuestoIds = [@foreach($presupuestoAnios as $anio)'presupuesto-{{ $anio }}',@endforeach];

    function showSevacTab(tabId) {
        sevacIds.forEach(id => {
            document.getElementById('panel-' + id).classList.add('hidden');
            const btn = document.getElementById('btn-' + id);
            btn.classList.remove('bg-dif-pink', 'text-white', 'border-dif-pink', 'shadow-lg');
            btn.classList.add('bg-white', 'text-dif-dark', 'border-gray-200');
        });
        document.getElementById('panel-' + tabId).classList.remove('hidden');
        const active = document.getElementById('btn-' + tabId);
        active.classList.add('bg-dif-pink', 'text-white', 'border-dif-pink', 'shadow-lg');
        active.classList.remove('bg-white', 'text-dif-dark', 'border-gray-200');
    }

    function showConacTab(tabId) {
        conacIds.forEach(id => {
            document.getElementById('panel-' + id).classList.add('hidden');
            const btn = document.getElementById('btn-' + id);
            btn.classList.remove('bg-dif-pink', 'text-white', 'border-dif-pink', 'shadow-lg');
            btn.classList.add('bg-white', 'text-dif-dark', 'border-gray-200');
        });
        document.getElementById('panel-' + tabId).classList.remove('hidden');
        const active = document.getElementById('btn-' + tabId);
        active.classList.add('bg-dif-pink', 'text-white', 'border-dif-pink', 'shadow-lg');
        active.classList.remove('bg-white', 'text-dif-dark', 'border-gray-200');
    }

    function showPresupuestoTab(tabId) {
        presupuestoIds.forEach(id => {
            document.getElementById('panel-' + id).classList.add('hidden');
            const btn = document.getElementById('btn-' + id);
            btn.classList.remove('bg-dif-pink', 'text-white', 'border-dif-pink', 'shadow-lg');
            btn.classList.add('bg-white', 'text-dif-dark', 'border-gray-200');
        });
        document.getElementById('panel-' + tabId).classList.remove('hidden');
        const active = document.getElementById('btn-' + tabId);
        active.classList.add('bg-dif-pink', 'text-white', 'border-dif-pink', 'shadow-lg');
        active.classList.remove('bg-white', 'text-dif-dark', 'border-gray-200');
    }

    function initFromHash() {
        const hash = window.location.hash.slice(1);
        // Inicializar SEVAC
        const defaultSevac = sevacIds.length ? sevacIds[0] : null;
        const sevacTab = sevacIds.includes(hash) ? hash : defaultSevac;
        if (sevacTab) showSevacTab(sevacTab);
        // Inicializar CONAC
        const defaultConac = conacIds.length ? conacIds[0] : null;
        if (defaultConac && !sevacIds.includes(hash)) showConacTab(defaultConac);
        if (conacIds.includes(hash)) showConacTab(hash);
        // Inicializar Presupuesto
        const defaultPresupuesto = presupuestoIds.length ? presupuestoIds[0] : null;
        if (defaultPresupuesto && !sevacIds.includes(hash) && !conacIds.includes(hash)) showPresupuestoTab(defaultPresupuesto);
        if (presupuestoIds.includes(hash)) showPresupuestoTab(hash);
        // Scroll al apartado correcto
        if (sevacIds.includes(hash)) {
            setTimeout(() => document.getElementById('sevac').scrollIntoView({ behavior: 'smooth' }), 150);
        }
        if (conacIds.includes(hash)) {
            setTimeout(() => document.getElementById('conac').scrollIntoView({ behavior: 'smooth' }), 150);
        }
        if (presupuestoIds.includes(hash)) {
            setTimeout(() => document.getElementById('presupuesto').scrollIntoView({ behavior: 'smooth' }), 150);
        }
    }

    document.addEventListener('DOMContentLoaded', initFromHash);

    window.addEventListener('hashchange', function () {
        const hash = window.location.hash.slice(1);
        if (sevacIds.includes(hash)) {
            showSevacTab(hash);
            document.getElementById('sevac').scrollIntoView({ behavior: 'smooth' });
        }
        if (conacIds.includes(hash)) {
            showConacTab(hash);
            document.getElementById('conac').scrollIntoView({ behavior: 'smooth' });
        }
        if (presupuestoIds.includes(hash)) {
            showPresupuestoTab(hash);
            document.getElementById('presupuesto').scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>

@endsection
