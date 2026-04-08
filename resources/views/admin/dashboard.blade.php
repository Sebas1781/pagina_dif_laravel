@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Bienvenida --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-dif-dark">
            ¡Bienvenido, {{ auth()->user()->name }}!
        </h2>
        <p class="text-gray-500 mt-1 text-sm">Desde aquí puedes gestionar el contenido del sitio web de DIF Tecámac.</p>
    </div>

    {{-- Tarjetas de resumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-dif-pink/10 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-newspaper text-dif-pink text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Boletines</p>
                <p class="text-2xl font-bold text-dif-dark">{{ $totalBoletines }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-hands-helping text-blue-500 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Servicios</p>
                <p class="text-2xl font-bold text-dif-dark">—</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-address-book text-green-500 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Directorio</p>
                <p class="text-2xl font-bold text-dif-dark">—</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-purple-500 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Usuarios</p>
                <p class="text-2xl font-bold text-dif-dark">—</p>
            </div>
        </div>

    </div>

    {{-- Panel de accesos rápidos --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-base font-semibold text-dif-dark mb-5">Accesos rápidos</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('admin.boletines.index') }}" class="group rounded-xl border border-gray-200 p-4 hover:border-dif-pink/40 hover:bg-dif-pink/5 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-dif-pink/10 text-dif-pink flex items-center justify-center">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-dif-dark">Boletines</p>
                        <p class="text-xs text-gray-500">Crear y editar notas</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.remtys_cards.index') }}" class="group rounded-xl border border-gray-200 p-4 hover:border-indigo-300 hover:bg-indigo-50/60 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-dif-dark">REMTYS: Categorías</p>
                        <p class="text-xs text-gray-500">Gestionar categorías</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.remtys_documentos.index') }}" class="group rounded-xl border border-gray-200 p-4 hover:border-indigo-300 hover:bg-indigo-50/60 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-dif-dark">REMTYS: Documentos</p>
                        <p class="text-xs text-gray-500">Alta, filtro y edición</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.directorio_items.index') }}" class="group rounded-xl border border-gray-200 p-4 hover:border-green-300 hover:bg-green-50/60 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-dif-dark">Directorio</p>
                        <p class="text-xs text-gray-500">Sedes y servicios</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.salud_servicios.index') }}" class="group rounded-xl border border-gray-200 p-4 hover:border-rose-300 hover:bg-rose-50/60 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-dif-dark">Salud: Servicios</p>
                        <p class="text-xs text-gray-500">Catálogo de servicios</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.unidades_medicas.index') }}" class="group rounded-xl border border-gray-200 p-4 hover:border-rose-300 hover:bg-rose-50/60 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-dif-dark">Salud: Unidades</p>
                        <p class="text-xs text-gray-500">Gestionar unidades médicas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
