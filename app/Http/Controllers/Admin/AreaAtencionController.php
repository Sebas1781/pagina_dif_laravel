<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaAtencion;
use Illuminate\Http\Request;

class AreaAtencionController extends Controller
{
    public function index()
    {
        $items = AreaAtencion::orderBy('orden')->orderBy('id')->paginate(12);

        return view('admin.areas_atencion.index', compact('items'));
    }

    public function create()
    {
        return view('admin.areas_atencion.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'enlace' => ['nullable', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-stethoscope';
        $data['color_gradiente'] = $this->colorGradienteAleatorio();
        $data['activo'] = $request->boolean('activo', true);

        AreaAtencion::create($data);

        return redirect()->route('admin.areas_atencion.index')->with('success', 'Elemento de area de atencion creado correctamente.');
    }

    public function edit(AreaAtencion $areasAtencion)
    {
        return view('admin.areas_atencion.edit', ['item' => $areasAtencion]);
    }

    public function update(Request $request, AreaAtencion $areasAtencion)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'enlace' => ['nullable', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-stethoscope';
        $data['color_gradiente'] = $areasAtencion->color_gradiente ?: $this->colorGradienteAleatorio();
        $data['activo'] = $request->boolean('activo');

        $areasAtencion->update($data);

        return redirect()->route('admin.areas_atencion.index')->with('success', 'Elemento de area de atencion actualizado.');
    }

    public function destroy(AreaAtencion $areasAtencion)
    {
        $areasAtencion->delete();

        return redirect()->route('admin.areas_atencion.index')->with('success', 'Elemento de area de atencion eliminado.');
    }

    private function colorGradienteAleatorio(): string
    {
        $gradientes = [
            'from-dif-pink to-dif-pink-light',
            'from-teal-500 to-teal-400',
            'from-purple-800 to-purple-600',
            'from-rose-400 to-pink-300',
            'from-amber-500 to-amber-400',
            'from-purple-700 to-purple-500',
            'from-blue-600 to-blue-400',
            'from-green-600 to-green-400',
        ];

        return $gradientes[array_rand($gradientes)];
    }
}
