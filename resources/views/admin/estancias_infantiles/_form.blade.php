{{-- Nombre --}}
<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre ?? '') }}"
           placeholder='Ej: Estancia Infantil "Paola Espinoza"'
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
    @error('nombre') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

{{-- Icono --}}
<div class="mb-5">
    <label for="icono" class="block text-sm font-medium text-gray-700 mb-1.5">
        Icono (Font Awesome) <span class="text-gray-400 font-normal">Ej: fa-baby, fa-school, fa-child</span>
    </label>
    <div class="flex gap-2 items-center">
        <input type="text" id="icono" name="icono" value="{{ old('icono', $item->icono ?? 'fa-baby') }}"
               class="flex-1 px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent"
               oninput="document.getElementById('icon-preview').className='fas '+this.value+' text-white text-2xl'">
        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-400">
            <i id="icon-preview" class="fas {{ old('icono', $item->icono ?? 'fa-baby') }} text-white text-2xl"></i>
        </div>
    </div>
</div>

{{-- Color Gradiente --}}
<div class="mb-5">
    <label for="color_gradiente" class="block text-sm font-medium text-gray-700 mb-1.5">
        Color Gradiente <span class="text-gray-400 font-normal">Ej: from-pink-500 to-pink-400</span>
    </label>
    <input type="text" id="color_gradiente" name="color_gradiente" value="{{ old('color_gradiente', $item->color_gradiente ?? 'from-pink-500 to-pink-400') }}"
           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
</div>

{{-- Orden y Estado --}}
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
