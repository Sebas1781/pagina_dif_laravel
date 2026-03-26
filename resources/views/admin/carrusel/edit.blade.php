@extends('admin.layouts.app')

@section('title', 'Editar Diapositiva')
@section('page-title', 'Editar Diapositiva')

@section('content')

<div class="max-w-2xl">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.carrusel.index') }}" class="hover:text-dif-pink transition-colors">Carrusel</a>
        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
        <span class="text-dif-dark font-medium">Editar</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.carrusel.update', $carrusel) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            {{-- Título --}}
            <div class="mb-5">
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $carrusel->titulo) }}"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('titulo') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                       placeholder="Ej. Programa Verano 2026">
                @error('titulo')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div class="mb-5">
                <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Imagen del banner
                    <span class="text-gray-400 font-normal">(jpg, png, webp — máx. 50 MB)</span>
                </label>
                @if($carrusel->imagen)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $carrusel->imagen) }}" alt="{{ $carrusel->titulo }}"
                             class="h-36 w-full object-cover rounded-xl border border-gray-200">
                        <p class="text-xs text-gray-400 mt-1">Imagen actual — sube una nueva para reemplazarla.</p>
                    </div>
                @endif
                <input type="file" id="imagen" name="imagen" accept="image/*"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                              file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
                @error('imagen')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
                <div id="preview-container" class="hidden mt-3">
                    <img id="preview-img" src="#" alt="Vista previa"
                         class="h-40 w-full object-cover rounded-xl border border-gray-200">
                </div>
            </div>

            {{-- URL --}}
            <div class="mb-5">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-1.5">
                    URL de enlace
                    <span class="text-gray-400 font-normal">(opcional — se usa si no hay archivo)</span>
                </label>
                <input type="text" id="url" name="url" value="{{ old('url', $carrusel->url) }}"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent
                              {{ $errors->has('url') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                       placeholder="Ej. https://diftecamac.gob.mx/servicios o /servicios">
                @error('url')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Archivo --}}
            <div class="mb-5">
                <label for="archivo" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Archivo adjunto
                    <span class="text-gray-400 font-normal">(pdf, doc, xls — máx. 200 MB — tiene prioridad sobre la URL)</span>
                </label>
                @if($carrusel->archivo)
                    <div class="flex items-center gap-3 mb-3 p-3 bg-dif-pink/5 rounded-xl border border-dif-pink/20">
                        <i class="fas fa-file-pdf text-dif-pink text-lg"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-dif-dark truncate">{{ basename($carrusel->archivo) }}</p>
                            <a href="{{ asset('storage/' . $carrusel->archivo) }}" target="_blank"
                               class="text-xs text-blue-500 hover:underline">Ver archivo</a>
                        </div>
                        <label class="flex items-center gap-1.5 cursor-pointer text-xs text-red-500">
                            <input type="checkbox" name="eliminar_archivo" value="1" class="accent-red-500">
                            Eliminar
                        </label>
                    </div>
                @endif
                <input type="file" id="archivo" name="archivo"
                       accept=".pdf,.doc,.docx,.xls,.xlsx"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                              file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
                @error('archivo')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Orden y Estado --}}
            <div class="grid grid-cols-2 gap-5 mb-6">
                <div>
                    <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden de posición</label>
                    <input type="number" id="orden" name="orden" value="{{ old('orden', $carrusel->orden) }}" min="0"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Estado</label>
                    <label class="flex items-center gap-3 mt-3 cursor-pointer">
                        <input type="checkbox" name="activo" value="1"
                               {{ old('activo', $carrusel->activo) ? 'checked' : '' }}
                               class="w-4 h-4 accent-dif-pink rounded">
                        <span class="text-sm text-gray-600">Visible en el carrusel</span>
                    </label>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">
                    Actualizar diapositiva
                </button>
                <a href="{{ route('admin.carrusel.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        document.getElementById('preview-img').src = ev.target.result;
        document.getElementById('preview-container').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});
</script>

@endsection
