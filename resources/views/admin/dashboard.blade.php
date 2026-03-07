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
        <h3 class="text-base font-semibold text-dif-dark mb-4">Accesos rápidos</h3>
        <p class="text-sm text-gray-400">Próximamente podrás gestionar boletines, servicios, directorio y más desde aquí.</p>
    </div>

@endsection
