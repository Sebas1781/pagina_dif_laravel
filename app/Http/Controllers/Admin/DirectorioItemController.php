<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DirectorioItem;
use Illuminate\Http\Request;

class DirectorioItemController extends Controller
{
    public function index()
    {
        $items = DirectorioItem::orderBy('orden')->orderBy('id')->paginate(12);

        return view('admin.directorio_items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.directorio_items.create', ['item' => new DirectorioItem()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'horario' => ['nullable', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'servicios_texto' => ['nullable', 'string'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-building';
        $data['color_gradiente'] = $this->gradienteAleatorio();
        $data['servicios'] = $this->parseServicios($data['servicios_texto'] ?? '');
        $data['activo'] = $request->boolean('activo', true);
        unset($data['servicios_texto']);

        DirectorioItem::create($data);

        return redirect()->route('admin.directorio_items.index')->with('success', 'Elemento de directorio creado correctamente.');
    }

    public function edit(DirectorioItem $directorioItem)
    {
        return view('admin.directorio_items.edit', ['item' => $directorioItem]);
    }

    public function update(Request $request, DirectorioItem $directorioItem)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'horario' => ['nullable', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'servicios_texto' => ['nullable', 'string'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-building';
        $data['color_gradiente'] = $directorioItem->color_gradiente ?: $this->gradienteAleatorio();
        $data['servicios'] = $this->parseServicios($data['servicios_texto'] ?? '');
        $data['activo'] = $request->boolean('activo');
        unset($data['servicios_texto']);

        $directorioItem->update($data);

        return redirect()->route('admin.directorio_items.index')->with('success', 'Elemento de directorio actualizado.');
    }

    public function destroy(DirectorioItem $directorioItem)
    {
        $directorioItem->delete();

        return redirect()->route('admin.directorio_items.index')->with('success', 'Elemento de directorio eliminado.');
    }

    private function parseServicios(string $texto): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $texto))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    private function gradienteAleatorio(): string
    {
        $gradientes = [
            'from-dif-pink to-dif-magenta',
            'from-dif-pink to-dif-pink-light',
            'from-green-700 to-green-500',
            'from-blue-700 to-blue-500',
            'from-purple-700 to-purple-500',
            'from-teal-700 to-teal-500',
            'from-amber-700 to-amber-500',
            'from-indigo-700 to-indigo-500',
        ];

        return $gradientes[array_rand($gradientes)];
    }
}
