@extends('admin.layouts.app')
@section('title', 'Editar Documento REMTYS')
@section('page-title', 'Editar Documento REMTYS')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.remtys_documentos.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-dif-pink mb-4"><i class="fas fa-arrow-left"></i> Volver a REMTYS</a>
    <h2 class="text-5xl font-extrabold text-slate-900 mb-6">Editar Documento REMTYS</h2>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.remtys_documentos.update', $remtysDocumento) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="remtys_card_id" class="block text-sm font-medium text-gray-700 mb-1.5">Categoria <span class="text-red-500">*</span></label>
                <select id="remtys_card_id" name="remtys_card_id" class="w-full px-4 py-2.5 border rounded-xl text-sm {{ $errors->has('remtys_card_id') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                    <option value="">Seleccionar categoria...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ (string) old('remtys_card_id', $remtysDocumento->remtys_card_id) === (string) $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1.5">Titulo del documento <span class="text-red-500">*</span></label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $remtysDocumento->titulo) }}" class="w-full px-4 py-2.5 border rounded-xl text-sm {{ $errors->has('titulo') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
            </div>

            @php
                $tipoActual = old('tipo_archivo', $remtysDocumento->archivo ? 'pdf' : 'link');
            @endphp
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de archivo <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-6 text-lg">
                    <label class="inline-flex items-center gap-2"><input type="radio" name="tipo_archivo" value="pdf" {{ $tipoActual === 'pdf' ? 'checked' : '' }}> <span><i class="fas fa-file-pdf text-gray-400"></i> Subir PDF</span></label>
                    <label class="inline-flex items-center gap-2"><input type="radio" name="tipo_archivo" value="link" {{ $tipoActual === 'link' ? 'checked' : '' }}> <span><i class="fas fa-link text-purple-200"></i> Link externo</span></label>
                </div>
            </div>

            <div class="mb-5" id="archivoWrap">
                <label for="archivo" class="block text-sm font-medium text-gray-700 mb-1.5">Archivo PDF</label>
                <input type="file" id="archivo" name="archivo" accept="application/pdf" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                @if($remtysDocumento->archivo)
                    <p class="text-xs text-gray-500 mt-1">Archivo actual: {{ $remtysDocumento->archivo }}</p>
                @endif
            </div>

            <div class="mb-5 hidden" id="urlWrap">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-1.5">Link externo</label>
                <input type="url" id="url" name="url" value="{{ old('url', $remtysDocumento->url) }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div class="mb-6">
                <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
                <input type="number" id="orden" name="orden" value="{{ old('orden', $remtysDocumento->orden) }}" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark">Actualizar</button>
                <a href="{{ route('admin.remtys_documentos.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
(function () {
    const radios = document.querySelectorAll('input[name="tipo_archivo"]');
    const archivoWrap = document.getElementById('archivoWrap');
    const urlWrap = document.getElementById('urlWrap');

    function toggleByType() {
        const selected = document.querySelector('input[name="tipo_archivo"]:checked')?.value || 'pdf';
        archivoWrap.classList.toggle('hidden', selected !== 'pdf');
        urlWrap.classList.toggle('hidden', selected !== 'link');
    }

    radios.forEach((radio) => radio.addEventListener('change', toggleByType));
    toggleByType();
})();
</script>
@endsection
