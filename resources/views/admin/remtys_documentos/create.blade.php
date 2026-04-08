@extends('admin.layouts.app')
@section('title', 'Nuevo Documento REMTYS')
@section('page-title', 'Nuevo Documento REMTYS')

@section('content')
<div class="max-w-3xl"><div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8"><p class="text-sm text-gray-500 mb-5">Card: <span class="font-semibold text-dif-dark">{{ $card->nombre }}</span></p><form method="POST" action="{{ route('admin.remtys_documentos.store', $card) }}" enctype="multipart/form-data">@csrf
    <div class="mb-5">
        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1.5">Titulo <span class="text-red-500">*</span></label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('titulo') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
    </div>
    <div class="mb-5">
        <label for="archivo" class="block text-sm font-medium text-gray-700 mb-1.5">Archivo PDF</label>
        <input type="file" id="archivo" name="archivo" accept="application/pdf" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
        <p class="text-xs text-gray-500 mt-1">Opcional si agregas URL.</p>
    </div>
    <div class="mb-5">
        <label for="url" class="block text-sm font-medium text-gray-700 mb-1.5">URL</label>
        <input type="url" id="url" name="url" value="{{ old('url') }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
        <p class="text-xs text-gray-500 mt-1">Opcional si subes PDF.</p>
    </div>
    <div class="mb-6">
        <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
        <input type="number" id="orden" name="orden" value="{{ old('orden', 0) }}" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
    <div class="flex items-center gap-3 pt-4 border-t border-gray-100"><button type="submit" class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">Guardar</button><a href="{{ route('admin.remtys_documentos.index', $card) }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">Cancelar</a></div>
</form></div></div>
@endsection
