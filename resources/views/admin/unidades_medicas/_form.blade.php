<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre ?? '') }}"
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
</div>

<div class="mb-5">
    <label for="subtitulo" class="block text-sm font-medium text-gray-700 mb-1.5">Subtitulo</label>
    <input type="text" id="subtitulo" name="subtitulo" value="{{ old('subtitulo', $item->subtitulo ?? '') }}"
           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
</div>

<div class="mb-5">
    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1.5">Direccion</label>
    <textarea id="direccion" name="direccion" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm resize-none focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">{{ old('direccion', $item->direccion ?? '') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-5 mb-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Icono</label>
        @php
            $iconos = ['fa-hospital','fa-stethoscope','fa-horse','fa-baby','fa-wheelchair','fa-flask','fa-house-medical','fa-user-doctor'];
            $iconoSeleccionado = old('icono', $item->icono ?? 'fa-hospital');
        @endphp
        <input type="hidden" id="icono" name="icono" value="{{ $iconoSeleccionado }}">
        <div class="grid grid-cols-4 gap-2">
            @foreach($iconos as $icono)
                <button type="button" class="icono-option h-10 rounded-lg border border-gray-200 text-gray-600 hover:border-dif-pink hover:text-dif-pink transition-colors" data-icono="{{ $icono }}" title="{{ $icono }}">
                    <i class="fas {{ $icono }}"></i>
                </button>
            @endforeach
        </div>
    </div>
    <div>
        <label for="tema" class="block text-sm font-medium text-gray-700 mb-1.5">Tema</label>
        <select id="tema" name="tema" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
            @foreach(['pink','green','blue','purple','teal','amber'] as $tema)
                <option value="{{ $tema }}" {{ old('tema', $item->tema ?? 'pink') === $tema ? 'selected' : '' }}>{{ ucfirst($tema) }}</option>
            @endforeach
        </select>
    </div>
</div>

<script>
(function () {
    const iconInput = document.getElementById('icono');
    const buttons = document.querySelectorAll('.icono-option');

    function renderSelected() {
        buttons.forEach((btn) => {
            const isSelected = btn.dataset.icono === iconInput.value;
            btn.classList.toggle('ring-2', isSelected);
            btn.classList.toggle('ring-dif-pink', isSelected);
            btn.classList.toggle('border-dif-pink', isSelected);
        });
    }

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            iconInput.value = btn.dataset.icono;
            renderSelected();
        });
    });

    renderSelected();
})();
</script>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1.5">Imagen</label>
    @if(isset($item) && $item->imagen)
        @php
            $src = str_starts_with($item->imagen, 'unidades_medicas/') ? asset('storage/'.$item->imagen) : asset('images/'.$item->imagen);
        @endphp
        <img src="{{ $src }}" class="h-32 rounded-xl object-cover border border-gray-200 mb-3">
    @endif
    <input type="file" name="imagen" accept="image/*" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-dif-pink/10 file:text-dif-pink hover:file:bg-dif-pink/20 cursor-pointer">
</div>

<div class="grid grid-cols-2 gap-5 mb-5">
    <div>
        <label for="horario_1" class="block text-sm font-medium text-gray-700 mb-1.5">Horario 1</label>
        <input type="text" id="horario_1" name="horario_1" value="{{ old('horario_1', $item->horario_1 ?? '') }}"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
    <div>
        <label for="horario_2" class="block text-sm font-medium text-gray-700 mb-1.5">Horario 2</label>
        <input type="text" id="horario_2" name="horario_2" value="{{ old('horario_2', $item->horario_2 ?? '') }}"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
    </div>
</div>

<div class="mb-5">
    <label for="servicios_texto" class="block text-sm font-medium text-gray-700 mb-1.5">Servicios disponibles (uno por linea)</label>
    <textarea id="servicios_texto" name="servicios_texto" rows="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm resize-y focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">{{ old('servicios_texto', implode(PHP_EOL, $item->servicios ?? [])) }}</textarea>
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
