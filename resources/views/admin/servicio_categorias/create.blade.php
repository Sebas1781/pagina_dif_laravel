@extends('admin.layouts.app')
@section('title', 'Nueva Categoria de Servicios')
@section('page-title', 'Nueva Categoria de Servicios')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.servicio_items.index') }}" class="hover:text-dif-pink">Elementos de Servicios</a>
        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
        <span class="text-dif-dark font-medium">Nueva categoria</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.servicio_categorias.store') }}" novalidate>
            @csrf
            <div class="mb-5">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                       class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                @error('nombre') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label for="subtitulo" class="block text-sm font-medium text-gray-700 mb-1.5">Subtitulo</label>
                <input type="text" id="subtitulo" name="subtitulo" value="{{ old('subtitulo') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
            </div>

            <div class="grid grid-cols-2 gap-5 mb-6">
                <div>
                    <label for="icono" class="block text-sm font-medium text-gray-700 mb-1.5">Icono</label>
                    <input type="text" id="icono" name="icono" value="{{ old('icono', 'fa-check') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                </div>
                <div>
                    <label for="tema" class="block text-sm font-medium text-gray-700 mb-1.5">Tema</label>
                    <select id="tema" name="tema" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                        @foreach(['pink','purple','red','blue','amber','teal','green'] as $tema)
                            <option value="{{ $tema }}" {{ old('tema', 'pink') === $tema ? 'selected' : '' }}>{{ ucfirst($tema) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5 mb-6">
                <div>
                    <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
                    <input type="number" id="orden" name="orden" value="{{ old('orden', 0) }}" min="0"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Estado</label>
                    <label class="flex items-center gap-3 mt-3 cursor-pointer">
                        <input type="checkbox" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }} class="w-4 h-4 accent-dif-pink rounded">
                        <span class="text-sm text-gray-600">Visible en el sitio</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl hover:bg-dif-pink-dark transition-colors duration-200">Guardar</button>
                <a href="{{ route('admin.servicio_items.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
