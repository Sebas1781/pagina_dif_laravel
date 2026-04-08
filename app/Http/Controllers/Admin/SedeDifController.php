<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SedeDif;
use Illuminate\Http\Request;

class SedeDifController extends Controller
{
    public function index()
    {
        $items = SedeDif::orderBy('orden')->orderBy('id')->paginate(12);

        return view('admin.sedes_dif.index', compact('items'));
    }

    public function create()
    {
        return view('admin.sedes_dif.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:30'],
            'enlace' => ['nullable', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-building';
        $data['color'] = $data['color'] ?: 'dif-pink';
        $data['activo'] = $request->boolean('activo', true);

        SedeDif::create($data);

        return redirect()->route('admin.sedes_dif.index')->with('success', 'Sede registrada correctamente.');
    }

    public function edit(SedeDif $sedesDif)
    {
        return view('admin.sedes_dif.edit', ['item' => $sedesDif]);
    }

    public function update(Request $request, SedeDif $sedesDif)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:30'],
            'enlace' => ['nullable', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-building';
        $data['color'] = $data['color'] ?: 'dif-pink';
        $data['activo'] = $request->boolean('activo');

        $sedesDif->update($data);

        return redirect()->route('admin.sedes_dif.index')->with('success', 'Sede actualizada.');
    }

    public function destroy(SedeDif $sedesDif)
    {
        $sedesDif->delete();

        return redirect()->route('admin.sedes_dif.index')->with('success', 'Sede eliminada.');
    }
}
