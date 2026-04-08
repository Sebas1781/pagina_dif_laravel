<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre ?? '') }}"
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
    @error('nombre') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1.5">
        Icono
        <span class="text-gray-400 font-normal">Selecciona visualmente</span>
    </label>
    @php
        $iconoSeleccionado = old('icono', $item->icono ?? 'fa-stethoscope');
        $iconosDisponibles = [
            'fa-stethoscope',
            'fa-book-open',
            'fa-gavel',
            'fa-heart',
            'fa-users',
            'fa-door-open',
            'fa-hands-helping',
            'fa-scale-balanced',
            'fa-graduation-cap',
            'fa-child-reaching',
            'fa-house-medical',
            'fa-ribbon',
        ];
    @endphp
    <input type="hidden" id="icono" name="icono" value="{{ $iconoSeleccionado }}">

    <div class="grid grid-cols-[1fr_auto] gap-2 items-start">
        <div class="grid grid-cols-6 gap-2">
            @foreach($iconosDisponibles as $valor)
                <button type="button"
                        class="icono-option h-10 rounded-lg border border-gray-200 text-gray-600 hover:border-dif-pink hover:text-dif-pink transition-colors"
                        data-icono="{{ $valor }}"
                        title="{{ $valor }}">
                    <i class="fas {{ $valor }}"></i>
                </button>
            @endforeach
        </div>
        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-dif-pink/10 mt-0.5">
            <i id="icon-preview" class="fas {{ $iconoSeleccionado }} text-dif-pink text-2xl"></i>
        </div>
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1.5">Color</label>
    <p class="text-xs text-gray-500 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2">
        El color del elemento se asigna automaticamente de forma aleatoria al crearlo.
    </p>
</div>

<script>
(function () {
    const input = document.getElementById('icono');
    const preview = document.getElementById('icon-preview');
    const buttons = document.querySelectorAll('.icono-option');

    function renderSelected() {
        buttons.forEach((btn) => {
            const isSelected = btn.dataset.icono === input.value;
            btn.classList.toggle('ring-2', isSelected);
            btn.classList.toggle('ring-dif-pink', isSelected);
            btn.classList.toggle('border-dif-pink', isSelected);
        });
        preview.className = 'fas ' + input.value + ' text-dif-pink text-2xl';
    }

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.icono;
            renderSelected();
        });
    });

    renderSelected();
})();
</script>

<div class="mb-5">
    <label for="enlace" class="block text-sm font-medium text-gray-700 mb-1.5">
        Enlace
        <span class="text-gray-400 font-normal">Ej: /salud, /educacion</span>
    </label>
    <input type="text" id="enlace" name="enlace" value="{{ old('enlace', $item->enlace ?? '') }}"
           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
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
