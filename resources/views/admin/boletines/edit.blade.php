@extends('admin.layouts.app')

@section('title', 'Editar Boletín')
@section('page-title', 'Editar Boletín')

@section('content')

<div class="max-w-2xl">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.boletines.index') }}" class="hover:text-dif-pink transition-colors">Boletines</a>
        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
        <span class="text-dif-dark font-medium truncate max-w-xs">{{ $boletin->titulo }}</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.boletines.update', $boletin) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            {{-- Título --}}
            <div class="mb-5">
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $boletin->titulo) }}"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('titulo') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
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
                                 {{ $errors->has('descripcion') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">{{ old('descripcion', $boletin->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen actual --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Imagen actual
                </label>
                @if($boletin->imagen)
                    @php
                        $src = str_starts_with($boletin->imagen, 'boletines/')
                            ? asset('storage/' . $boletin->imagen)
                            : asset('images/' . $boletin->imagen);
                    @endphp
                    <img src="{{ $src }}" alt="{{ $boletin->titulo }}"
                         id="current-img"
                         class="h-40 rounded-xl object-cover border border-gray-200 mb-3">
                @else
                    <p class="text-sm text-gray-400 mb-3">Sin imagen.</p>
                @endif

                <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Reemplazar imagen
                    <span class="text-gray-400 font-normal">(dejar vacío para conservar la actual)</span>
                </label>
                <input type="file" id="imagen" name="imagen" accept="image/*"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                              file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
                @error('imagen')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
                <div id="preview-container" class="hidden mt-3">
                    <img id="preview-img" src="#" alt="Vista previa"
                         class="h-40 rounded-xl object-cover border border-dif-pink/30">
                </div>
            </div>

            {{-- Orden y Estado --}}
            <div class="grid grid-cols-2 gap-5 mb-6">
                <div>
                    <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
                    <input type="number" id="orden" name="orden" value="{{ old('orden', $boletin->orden) }}" min="0"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Estado</label>
                    <label class="flex items-center gap-3 mt-3 cursor-pointer">
                        <input type="checkbox" name="activo" value="1"
                               {{ old('activo', $boletin->activo) ? 'checked' : '' }}
                               class="w-4 h-4 accent-dif-pink rounded">
                        <span class="text-sm text-gray-600">Visible en el sitio</span>
                    </label>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">
                    Actualizar boletín
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
            const img = document.getElementById('preview-img');
            img.src = ev.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
            // Atenuar imagen actual
            const cur = document.getElementById('current-img');
            if (cur) cur.classList.add('opacity-40');
        };
        reader.readAsDataURL(file);
    });
</script>

@endsection
