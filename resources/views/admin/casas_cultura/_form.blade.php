{{-- Partial reutilizable para create y edit --}}

{{-- Nombre --}}
<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre ?? '') }}"
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
    @error('nombre') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

{{-- Dirección --}}
<div class="mb-5">
    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1.5">Dirección</label>
    <textarea id="direccion" name="direccion" rows="2"
              class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm resize-none focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">{{ old('direccion', $item->direccion ?? '') }}</textarea>
</div>

{{-- Icono Font Awesome --}}
<div class="mb-5">
    <label for="icono" class="block text-sm font-medium text-gray-700 mb-1.5">
        Icono (Font Awesome)
        <span class="text-gray-400 font-normal">Ej: fa-landmark, fa-palette, fa-music</span>
    </label>
    <div class="flex gap-2 items-center">
        <input type="text" id="icono" name="icono" value="{{ old('icono', $item->icono ?? 'fa-landmark') }}"
               class="flex-1 px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent"
               oninput="document.getElementById('icon-preview').className='fas '+this.value+' text-dif-pink text-2xl'">
        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-dif-pink/10">
            <i id="icon-preview" class="fas {{ old('icono', $item->icono ?? 'fa-landmark') }} text-dif-pink text-2xl"></i>
        </div>
    </div>
</div>

{{-- Color Gradiente --}}
<div class="mb-5">
    <label for="color_gradiente" class="block text-sm font-medium text-gray-700 mb-1.5">
        Color Gradiente
        <span class="text-gray-400 font-normal">Ej: from-dif-pink to-dif-magenta</span>
    </label>
    <input type="text" id="color_gradiente" name="color_gradiente" value="{{ old('color_gradiente', $item->color_gradiente ?? 'from-dif-pink to-dif-magenta') }}"
           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
</div>

{{-- Imagen --}}
<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1.5">Imagen <span class="text-gray-400 font-normal">(jpg, png, webp — máx. 2 MB)</span></label>
    @if(isset($item) && $item->imagen)
        @php
            $src = str_starts_with($item->imagen, 'casas_cultura/')
                ? asset('storage/'.$item->imagen) : asset('images/'.$item->imagen);
        @endphp
        <img src="{{ $src }}" id="current-img" class="h-32 rounded-xl object-cover border border-gray-200 mb-3">
    @endif
    <input type="file" name="imagen" accept="image/*" id="img-input"
           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
    <div id="preview-container" class="hidden mt-3">
        <img id="preview-img" src="#" class="h-32 rounded-xl object-cover border border-dif-pink/30">
    </div>
    @error('imagen') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
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

<script>
document.getElementById('img-input').addEventListener('change', function(e){
    const file = e.target.files[0]; if(!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('preview-img').src = ev.target.result;
        document.getElementById('preview-container').classList.remove('hidden');
        const cur = document.getElementById('current-img');
        if(cur) cur.classList.add('opacity-40');
    };
    reader.readAsDataURL(file);
});
</script>
