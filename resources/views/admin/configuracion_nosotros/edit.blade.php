@extends('admin.layouts.app')
@section('title', 'Mision, Vision y Valores')
@section('page-title', 'Mision, Vision y Valores')

@section('content')
<div class="max-w-4xl">
    @if(session('success'))
        <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2">
            <i class="fas fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.configuracion_nosotros.update') }}" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="mision" class="block text-sm font-medium text-gray-700 mb-1.5">Mision <span class="text-red-500">*</span></label>
                <textarea id="mision" name="mision" rows="5"
                          class="w-full px-4 py-2.5 border rounded-xl text-sm resize-y focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('mision') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">{{ old('mision', $item->mision ?? '') }}</textarea>
                @error('mision') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="vision" class="block text-sm font-medium text-gray-700 mb-1.5">Vision <span class="text-red-500">*</span></label>
                <textarea id="vision" name="vision" rows="5"
                          class="w-full px-4 py-2.5 border rounded-xl text-sm resize-y focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('vision') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">{{ old('vision', $item->vision ?? '') }}</textarea>
                @error('vision') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="valores_texto" class="block text-sm font-medium text-gray-700 mb-1.5">Valores (uno por linea)</label>
                <textarea id="valores_texto" name="valores_texto" rows="8"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm resize-y focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">{{ old('valores_texto', implode(PHP_EOL, $item->valores ?? [])) }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
