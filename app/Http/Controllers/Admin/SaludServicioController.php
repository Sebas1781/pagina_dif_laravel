<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaludServicio;
use Illuminate\Http\Request;

class SaludServicioController extends Controller
{
    public function index()
    {
        $items = SaludServicio::orderBy('orden')->orderBy('id')->paginate(16);

        return view('admin.salud_servicios.index', compact('items'));
    }

    public function create()
    {
        return view('admin.salud_servicios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color_gradiente' => ['nullable', 'string', 'max:120'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-stethoscope';
        $data['color_gradiente'] = $data['color_gradiente'] ?: 'from-dif-pink to-dif-magenta';
        $data['activo'] = $request->boolean('activo', true);

        SaludServicio::create($data);

        return redirect()->route('admin.salud_servicios.index')->with('success', 'Servicio de salud agregado.');
    }

    public function edit(SaludServicio $saludServicio)
    {
        return view('admin.salud_servicios.edit', ['item' => $saludServicio]);
    }

    public function update(Request $request, SaludServicio $saludServicio)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color_gradiente' => ['nullable', 'string', 'max:120'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-stethoscope';
        $data['color_gradiente'] = $data['color_gradiente'] ?: 'from-dif-pink to-dif-magenta';
        $data['activo'] = $request->boolean('activo');

        $saludServicio->update($data);

        return redirect()->route('admin.salud_servicios.index')->with('success', 'Servicio de salud actualizado.');
    }

    public function destroy(SaludServicio $saludServicio)
    {
        $saludServicio->delete();

        return redirect()->route('admin.salud_servicios.index')->with('success', 'Servicio de salud eliminado.');
    }
}
