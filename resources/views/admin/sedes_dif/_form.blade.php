<div class="mb-5">
    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1.5">Nombre <span class="text-red-500">*</span></label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre ?? '') }}"
           class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent {{ $errors->has('nombre') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
    @error('nombre') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-5 mb-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Icono</label>
        @php
            $iconos = ['fa-building','fa-hospital','fa-stethoscope','fa-horse','fa-people-group','fa-hand-holding-heart','fa-heart','fa-wheelchair','fa-flask','fa-house-medical','fa-child-reaching'];
            $iconoSeleccionado = old('icono', $item->icono ?? 'fa-building');
        @endphp
        <input type="hidden" id="icono" name="icono" value="{{ $iconoSeleccionado }}">
        <div class="grid grid-cols-6 gap-2">
            @foreach($iconos as $icono)
                <button type="button"
                        class="icono-option h-10 rounded-lg border border-gray-200 text-gray-600 hover:border-dif-pink hover:text-dif-pink transition-colors"
                        data-icono="{{ $icono }}"
                        title="{{ $icono }}">
                    <i class="fas {{ $icono }}"></i>
                </button>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Color</label>
        @php
            $colores = ['dif-pink','teal-600','green-600','purple-600','amber-600','red-500','blue-600','indigo-600'];
            $colorSeleccionado = old('color', $item->color ?? 'dif-pink');

            $swatches = [
                'dif-pink' => 'bg-dif-pink',
                'teal-600' => 'bg-teal-600',
                'green-600' => 'bg-green-600',
                'purple-600' => 'bg-purple-600',
                'amber-600' => 'bg-amber-600',
                'red-500' => 'bg-red-500',
                'blue-600' => 'bg-blue-600',
                'indigo-600' => 'bg-indigo-600',
            ];
        @endphp
        <input type="hidden" id="color" name="color" value="{{ $colorSeleccionado }}">
        <div class="grid grid-cols-8 gap-2">
            @foreach($colores as $color)
                <button type="button"
                        class="color-option h-10 rounded-lg border border-gray-200 flex items-center justify-center transition-colors"
                        data-color="{{ $color }}"
                        title="{{ $color }}">
                    <span class="w-5 h-5 rounded-full {{ $swatches[$color] ?? 'bg-dif-pink' }}"></span>
                </button>
            @endforeach
        </div>
    </div>
</div>

<div class="mb-5">
    <label for="enlace" class="block text-sm font-medium text-gray-700 mb-1.5">Enlace (opcional)</label>
    <input type="text" id="enlace" name="enlace" value="{{ old('enlace', $item->enlace ?? '') }}"
           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
</div>

<div class="grid grid-cols-[1fr_1fr_auto] gap-5 mb-6 items-end">
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
    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-dif-pink/10 mb-1">
        <i id="icono-preview" class="fas {{ $iconoSeleccionado }} text-dif-pink text-xl"></i>
    </div>
</div>

<script>
(function () {
    const iconInput = document.getElementById('icono');
    const colorInput = document.getElementById('color');
    const iconPreview = document.getElementById('icono-preview');

    const iconButtons = document.querySelectorAll('.icono-option');
    const colorButtons = document.querySelectorAll('.color-option');

    const colorClasses = {
        'dif-pink': 'text-dif-pink',
        'teal-600': 'text-teal-600',
        'green-600': 'text-green-600',
        'purple-600': 'text-purple-600',
        'amber-600': 'text-amber-600',
        'red-500': 'text-red-500',
        'blue-600': 'text-blue-600',
        'indigo-600': 'text-indigo-600',
    };

    function renderSelected() {
        iconButtons.forEach((btn) => {
            const isSelected = btn.dataset.icono === iconInput.value;
            btn.classList.toggle('ring-2', isSelected);
            btn.classList.toggle('ring-dif-pink', isSelected);
            btn.classList.toggle('border-dif-pink', isSelected);
        });

        colorButtons.forEach((btn) => {
            const isSelected = btn.dataset.color === colorInput.value;
            btn.classList.toggle('ring-2', isSelected);
            btn.classList.toggle('ring-dif-pink', isSelected);
            btn.classList.toggle('border-dif-pink', isSelected);
        });

        const colorClass = colorClasses[colorInput.value] || 'text-dif-pink';
        iconPreview.className = 'fas ' + iconInput.value + ' ' + colorClass + ' text-xl';
    }

    iconButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            iconInput.value = btn.dataset.icono;
            renderSelected();
        });
    });

    colorButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            colorInput.value = btn.dataset.color;
            renderSelected();
        });
    });

    renderSelected();
})();
</script>
