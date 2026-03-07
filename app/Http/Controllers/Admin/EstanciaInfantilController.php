<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstanciaInfantil;
use Illuminate\Http\Request;

class EstanciaInfantilController extends Controller
{
    public function index()
    {
        $items = EstanciaInfantil::orderBy('orden')->orderBy('nombre')->paginate(10);
        return view('admin.estancias_infantiles.index', compact('items'));
    }

    public function create()
    {
        return view('admin.estancias_infantiles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'           => ['required', 'string', 'max:255'],
            'icono'            => ['nullable', 'string', 'max:100'],
            'color_gradiente'  => ['nullable', 'string', 'max:100'],
            'activo'           => ['nullable', 'boolean'],
            'orden'            => ['nullable', 'integer', 'min:0'],
        ]);

        $data['activo'] = $request->boolean('activo', true);
        EstanciaInfantil::create($data);

        return redirect()->route('admin.estancias_infantiles.index')->with('success', 'Estancia Infantil creada correctamente.');
    }

    public function edit(EstanciaInfantil $estanciasInfantile)
    {
        return view('admin.estancias_infantiles.edit', ['item' => $estanciasInfantile]);
    }

    public function update(Request $request, EstanciaInfantil $estanciasInfantile)
    {
        $data = $request->validate([
            'nombre'           => ['required', 'string', 'max:255'],
            'icono'            => ['nullable', 'string', 'max:100'],
            'color_gradiente'  => ['nullable', 'string', 'max:100'],
            'activo'           => ['nullable', 'boolean'],
            'orden'            => ['nullable', 'integer', 'min:0'],
        ]);

        $data['activo'] = $request->boolean('activo');
        $estanciasInfantile->update($data);

        return redirect()->route('admin.estancias_infantiles.index')->with('success', 'Estancia Infantil actualizada.');
    }

    public function destroy(EstanciaInfantil $estanciasInfantile)
    {
        $estanciasInfantile->delete();
        return redirect()->route('admin.estancias_infantiles.index')->with('success', 'Estancia Infantil eliminada.');
    }
}
