<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre ?? '') }}"
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
    @error('nombre') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-5 mb-5">
    <div>
        <label for="icono" class="block text-sm font-medium text-gray-700 mb-1.5">Icono</label>
        <input type="text" id="icono" name="icono" value="{{ old('icono', $item->icono ?? 'fa-stethoscope') }}"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
    <div>
        <label for="color_gradiente" class="block text-sm font-medium text-gray-700 mb-1.5">Gradiente</label>
        <input type="text" id="color_gradiente" name="color_gradiente" value="{{ old('color_gradiente', $item->color_gradiente ?? 'from-dif-pink to-dif-magenta') }}"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
</div>

<div class="grid grid-cols-2 gap-5 mb-6">
    <div>
        <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
        <input type="number" id="orden" name="orden" value="{{ old('orden', $item->orden ?? 0) }}" min="0"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Estado</label>
        <label class="flex items-center gap-3 mt-3 cursor-pointer">
            <input type="checkbox" name="activo" value="1" {{ old('activo', $item->activo ?? true) ? 'checked' : '' }} class="w-4 h-4 accent-dif-pink rounded">
            <span class="text-sm text-gray-600">Visible en el sitio</span>
        </label>
    </div>
</div>
