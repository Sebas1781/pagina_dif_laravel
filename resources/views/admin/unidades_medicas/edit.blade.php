@extends('admin.layouts.app')
@section('title', 'Editar Unidad Medica')
@section('page-title', 'Editar Unidad Medica')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.unidades_medicas.update', $item) }}" enctype="multipart/form-data" novalidate>
            @csrf @method('PUT')
            @include('admin.unidades_medicas._form')
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">Actualizar</button>
                <a href="{{ route('admin.unidades_medicas.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
