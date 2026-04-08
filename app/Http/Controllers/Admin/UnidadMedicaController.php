<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnidadMedica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnidadMedicaController extends Controller
{
    public function index()
    {
        $items = UnidadMedica::orderBy('orden')->orderBy('id')->paginate(12);

        return view('admin.unidades_medicas.index', compact('items'));
    }

    public function create()
    {
        return view('admin.unidades_medicas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'subtitulo' => ['nullable', 'string', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'icono' => ['nullable', 'string', 'max:100'],
            'tema' => ['nullable', 'string', 'max:30'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'horario_1' => ['nullable', 'string', 'max:255'],
            'horario_2' => ['nullable', 'string', 'max:255'],
            'servicios_texto' => ['nullable', 'string'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('unidades_medicas', 'public');
        }

        $data['icono'] = $data['icono'] ?: 'fa-hospital';
        $data['tema'] = $data['tema'] ?: 'pink';
        $data['servicios'] = $this->parseServicios($data['servicios_texto'] ?? '');
        $data['activo'] = $request->boolean('activo', true);
        unset($data['servicios_texto']);

        UnidadMedica::create($data);

        return redirect()->route('admin.unidades_medicas.index')->with('success', 'Unidad medica agregada.');
    }

    public function edit(UnidadMedica $unidadesMedica)
    {
        return view('admin.unidades_medicas.edit', ['item' => $unidadesMedica]);
    }

    public function update(Request $request, UnidadMedica $unidadesMedica)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'subtitulo' => ['nullable', 'string', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'icono' => ['nullable', 'string', 'max:100'],
            'tema' => ['nullable', 'string', 'max:30'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'horario_1' => ['nullable', 'string', 'max:255'],
            'horario_2' => ['nullable', 'string', 'max:255'],
            'servicios_texto' => ['nullable', 'string'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($unidadesMedica->imagen && str_starts_with($unidadesMedica->imagen, 'unidades_medicas/')) {
                Storage::disk('public')->delete($unidadesMedica->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('unidades_medicas', 'public');
        }

        $data['icono'] = $data['icono'] ?: 'fa-hospital';
        $data['tema'] = $data['tema'] ?: 'pink';
        $data['servicios'] = $this->parseServicios($data['servicios_texto'] ?? '');
        $data['activo'] = $request->boolean('activo');
        unset($data['servicios_texto']);

        $unidadesMedica->update($data);

        return redirect()->route('admin.unidades_medicas.index')->with('success', 'Unidad medica actualizada.');
    }

    public function destroy(UnidadMedica $unidadesMedica)
    {
        if ($unidadesMedica->imagen && str_starts_with($unidadesMedica->imagen, 'unidades_medicas/')) {
            Storage::disk('public')->delete($unidadesMedica->imagen);
        }

        $unidadesMedica->delete();

        return redirect()->route('admin.unidades_medicas.index')->with('success', 'Unidad medica eliminada.');
    }

    private function parseServicios(string $texto): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $texto))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
