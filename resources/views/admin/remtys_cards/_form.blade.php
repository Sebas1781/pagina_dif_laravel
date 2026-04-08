<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $card->nombre ?? '') }}"
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
</div>

<div class="mb-5">
    <label for="icono" class="block text-sm font-medium text-gray-700 mb-1.5">Icono</label>
    <input type="text" id="icono" name="icono" value="{{ old('icono', $card->icono ?? 'fa-file-lines') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
</div>

<div class="mb-5">
    <label for="color_gradiente" class="block text-sm font-medium text-gray-700 mb-1.5">Gradiente</label>
    <input type="text" id="color_gradiente" name="color_gradiente" value="{{ old('color_gradiente', $card->color_gradiente ?? 'from-purple-700/80 to-purple-500/80') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
</div>

<div class="grid grid-cols-2 gap-5 mb-6">
    <div>
        <label for="orden" class="block text-sm font-medium text-gray-700 mb-1.5">Orden</label>
        <input type="number" id="orden" name="orden" value="{{ old('orden', $card->orden ?? 0) }}" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Estado</label>
        <label class="flex items-center gap-3 mt-3 cursor-pointer">
            <input type="checkbox" name="activo" value="1" {{ old('activo', $card->activo ?? true) ? 'checked' : '' }} class="w-4 h-4 accent-dif-pink rounded">
            <span class="text-sm text-gray-600">Card activa</span>
        </label>
    </div>
</div>
