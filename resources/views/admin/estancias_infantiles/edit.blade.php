@extends('admin.layouts.app')
@section('title', 'Editar Estancia Infantil')
@section('page-title', 'Editar Estancia Infantil')

@section('content')
<div class="max-w-lg">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.estancias_infantiles.index') }}" class="hover:text-dif-pink">Estancias Infantiles</a>
        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
        <span class="text-dif-dark font-medium truncate max-w-xs">{{ $item->nombre }}</span>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.estancias_infantiles.update', $item) }}" novalidate>
            @csrf @method('PUT')
            @include('admin.estancias_infantiles._form')
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">Actualizar</button>
                <a href="{{ route('admin.estancias_infantiles.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
