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
            <h2 class="text-3xl font-extrabold text-dif-dark mb-4">Sistema de EvaluaciÃ³n de ArmonizaciÃ³n Contable</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Selecciona el periodo que deseas consultar.</p>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-12 scroll-hidden stagger-1">
            @php
                $sevacTabs = [
                    'general' => 'General',
                    '2018'    => 'SEVAC 2018',
                    '2019'    => 'SEVAC 2019',
                    '2020'    => 'SEVAC 2020',
                    '2021'    => 'SEVAC 2021',
                    '2022'    => 'SEVAC 2022',
                    '2023'    => 'SEVAC 2023',
                    '2024'    => 'SEVAC 2024',
                ];
            @endphp
            @foreach($sevacTabs as $key => $label)
            <button
                onclick="showSevacTab('sevac-{{ $key }}')"
                id="btn-sevac-{{ $key }}"
                class="sevac-tab-btn px-5 py-2.5 rounded-full text-sm font-semibold border-2 bg-white text-dif-dark border-gray-200 hover:border-dif-pink hover:text-dif-pink transition-all duration-300 cursor-pointer">
                {{ $label }}
            </button>
            @endforeach
        </div>

        {{-- Tab Content Panels --}}
        <div class="min-h-64">

            {{-- Placeholder panels: General, 2018-2023 --}}
            @foreach(['general','2018','2019','2020','2021','2022','2023'] as $year)
            <div id="panel-sevac-{{ $year }}" class="sevac-panel hidden">
                <div class="text-center py-16 px-4">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-dif-cream flex items-center justify-center">
                        <i class="fas fa-chart-bar text-3xl text-dif-pink"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dif-dark mb-2">
                        {{ $year === 'general' ? 'SEVAC General' : 'SEVAC ' . $year }}
                    </h3>
                    <p class="text-gray-400 text-sm">Contenido en preparaciÃ³n.</p>
                </div>
            </div>
            @endforeach

            {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â• SEVAC 2024 â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
            <div id="panel-sevac-2024" class="sevac-panel hidden">
                @php
                $sevacData = json_decode(file_get_contents(resource_path('data/sevac.json')), true);
                $sevac2024Sections = $sevacData['2024'] ?? [];
                @endphp

                <div class="space-y-8">
                    @foreach($sevac2024Sections as $sectionTitle => $docs)
                    <div>
                        {{-- Section title --}}
                        <h4 class="text-base font-extrabold text-dif-dark uppercase tracking-wide mb-3 pb-2 border-b-2 border-dif-pink/30">
                            {{ $sectionTitle }}
                        </h4>
                        {{-- 4-column document grid --}}
                        <div class="border border-gray-200 rounded overflow-hidden">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach($docs as $i => [$name, $url])
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-2 px-4 py-3 border-b border-r border-gray-200 hover:bg-red-50 transition-colors duration-150 group
                                          {{ ($i % 4 === 3) ? 'lg:border-r-0' : '' }}
                                          {{ ($i >= count($docs) - ($i % 4 === 0 ? min(4, count($docs) % 4 ?: 4) : 0)) ? '' : '' }}">
                                    <i class="fas fa-file-pdf text-dif-pink text-sm flex-shrink-0"></i>
                                    <span class="text-xs font-semibold text-dif-pink uppercase leading-tight group-hover:underline">{{ $name }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â• /SEVAC 2024 â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}

        </div>

    </div>
</section>

<script>
    const sevacIds = [
        'sevac-general','sevac-2018','sevac-2019','sevac-2020',
        'sevac-2021','sevac-2022','sevac-2023','sevac-2024'
    ];

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

    function initFromHash() {
        const hash = window.location.hash.slice(1);
        const tabId = sevacIds.includes(hash) ? hash : 'sevac-general';
        showSevacTab(tabId);
        if (sevacIds.includes(hash)) {
            setTimeout(() => {
                document.getElementById('sevac').scrollIntoView({ behavior: 'smooth' });
            }, 150);
        }
    }

    document.addEventListener('DOMContentLoaded', initFromHash);

    window.addEventListener('hashchange', function () {
        const hash = window.location.hash.slice(1);
        if (sevacIds.includes(hash)) {
            showSevacTab(hash);
            document.getElementById('sevac').scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>

@endsection
