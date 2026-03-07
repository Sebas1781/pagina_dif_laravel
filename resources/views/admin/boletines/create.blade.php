@extends('admin.layouts.app')

@section('title', 'Nuevo Boletín')
@section('page-title', 'Nuevo Boletín')

@section('content')

<div class="max-w-2xl">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.boletines.index') }}" class="hover:text-dif-pink transition-colors">Boletines</a>
        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
        <span class="text-dif-dark font-medium">Nuevo</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.boletines.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- Título --}}
            <div class="mb-5">
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('titulo') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                       placeholder="Ej. Tardes de Serenata">
                @error('titulo')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="mb-5">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Descripción <span class="text-red-500">*</span>
                </label>
                <textarea id="descripcion" name="descripcion" rows="5"
                          class="w-full px-4 py-2.5 border rounded-xl text-sm resize-none focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                                 {{ $errors->has('descripcion') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                          placeholder="Texto del boletín...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div class="mb-5">
                <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Imagen
                    <span class="text-gray-400 font-normal">(jpg, png, webp — máx. 2 MB)</span>
                </label>
                <input type="file" id="imagen" name="imagen" accept="image/*"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                              file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
                @error('imagen')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
                {{-- Vista previa --}}
                <div id="preview-container" class="hidden mt-3">
                    <img id="preview-img" src="#" alt="Vista previa"
                         class="h-40 rounded-xl object-cover border border-gray-200">
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
                    Guardar boletín
                </button>
                <a href="{{ route('admin.boletines.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('imagen').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('preview-img').src = ev.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>

@endsection
