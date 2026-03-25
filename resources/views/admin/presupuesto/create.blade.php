@extends('admin.layouts.app')

@section('title', 'Nuevo Documento Presupuesto')
@section('page-title', 'Nuevo Documento Presupuesto')

@section('content')

<div class="max-w-2xl">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.presupuesto.index') }}" class="hover:text-dif-pink transition-colors">Documentos Presupuesto</a>
        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
        <span class="text-dif-dark font-medium">Nuevo</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.presupuesto.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- Año --}}
            <div class="mb-5">
                <label for="anio" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Año <span class="text-red-500">*</span>
                </label>
                <input type="number" id="anio" name="anio" value="{{ old('anio', date('Y')) }}" min="2000" max="2099"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('anio') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                       placeholder="Ej. 2024">
                @error('anio')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categoría --}}
            <div class="mb-5">
                <label for="categoria" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Categoría / Sección <span class="text-red-500">*</span>
                </label>
                <input type="text" id="categoria" name="categoria" value="{{ old('categoria') }}" list="lista-categorias"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('categoria') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                       placeholder="Ej. Presupuesto de Egresos, Cuenta Pública...">
                <datalist id="lista-categorias">
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}">
                    @endforeach
                </datalist>
                <p class="mt-1 text-xs text-gray-400">Puedes escribir una nueva o seleccionar una existente.</p>
                @error('categoria')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nombre --}}
            <div class="mb-5">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Nombre del documento <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                       placeholder="Ej. Presupuesto de Egresos Aprobado 2024">
                @error('nombre')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipo de fuente (PDF o Link) --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Fuente del documento <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-6 mb-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_fuente" value="archivo"
                               {{ old('tipo_fuente', 'archivo') === 'archivo' ? 'checked' : '' }}
                               class="accent-dif-pink" onclick="toggleFuente('archivo')">
                        <span class="text-sm text-gray-600"><i class="fas fa-file-pdf mr-1 text-dif-pink"></i> Subir archivo PDF</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_fuente" value="link"
                               {{ old('tipo_fuente') === 'link' ? 'checked' : '' }}
                               class="accent-dif-pink" onclick="toggleFuente('link')">
                        <span class="text-sm text-gray-600"><i class="fas fa-link mr-1 text-purple-500"></i> Link externo</span>
                    </label>
                </div>

                {{-- Archivo PDF --}}
                <div id="fuente-archivo" class="{{ old('tipo_fuente', 'archivo') === 'archivo' ? '' : 'hidden' }}">
                    <input type="file" id="archivo" name="archivo" accept=".pdf"
                           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                  file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
                    <p class="mt-1 text-xs text-gray-400">Solo archivos PDF. Máx. 30 MB.</p>
                    @error('archivo')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Link externo --}}
                <div id="fuente-link" class="{{ old('tipo_fuente') === 'link' ? '' : 'hidden' }}">
                    <input type="url" id="link_externo" name="link_externo" value="{{ old('link_externo') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent"
                           placeholder="https://drive.google.com/file/d/...">
                    <p class="mt-1 text-xs text-gray-400">URL completa del documento (Google Drive, etc.)</p>
                    @error('link_externo')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Orden y Estado --}}
            <div class="grid grid-cols-2 gap-5 mb-6">
                <div>
                    <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
                    <input type="number" id="orden" name="orden" value="{{ old('orden', 0) }}" min="0"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Estado</label>
                    <label class="flex items-center gap-3 mt-3 cursor-pointer">
                        <input type="checkbox" name="activo" value="1"
                               {{ old('activo', '1') ? 'checked' : '' }}
                               class="w-4 h-4 accent-dif-pink rounded">
                        <span class="text-sm text-gray-600">Visible en el sitio</span>
                    </label>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">
                    Guardar documento
                </button>
                <a href="{{ route('admin.presupuesto.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function toggleFuente(tipo) {
    document.getElementById('fuente-archivo').classList.toggle('hidden', tipo !== 'archivo');
    document.getElementById('fuente-link').classList.toggle('hidden', tipo !== 'link');
}
</script>

@endsection
