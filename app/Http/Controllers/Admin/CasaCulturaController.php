<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CasaCultura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CasaCulturaController extends Controller
{
    public function index()
    {
        $items = CasaCultura::orderBy('orden')->orderBy('nombre')->paginate(10);
        return view('admin.casas_cultura.index', compact('items'));
    }

    public function create()
    {
        return view('admin.casas_cultura.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'           => ['required', 'string', 'max:255'],
            'direccion'        => ['nullable', 'string'],
            'icono'            => ['nullable', 'string', 'max:100'],
            'color_gradiente'  => ['nullable', 'string', 'max:100'],
            'imagen'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo'           => ['nullable', 'boolean'],
            'orden'            => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('casas_cultura', 'public');
        }

        $data['activo'] = $request->boolean('activo', true);
        CasaCultura::create($data);

        return redirect()->route('admin.casas_cultura.index')->with('success', 'Casa de Cultura creada correctamente.');
    }

    public function edit(CasaCultura $casasCultura)
    {
        return view('admin.casas_cultura.edit', ['item' => $casasCultura]);
    }

    public function update(Request $request, CasaCultura $casasCultura)
    {
        $data = $request->validate([
            'nombre'           => ['required', 'string', 'max:255'],
            'direccion'        => ['nullable', 'string'],
            'icono'            => ['nullable', 'string', 'max:100'],
            'color_gradiente'  => ['nullable', 'string', 'max:100'],
            'imagen'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo'           => ['nullable', 'boolean'],
            'orden'            => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($casasCultura->imagen && str_starts_with($casasCultura->imagen, 'casas_cultura/')) {
                Storage::disk('public')->delete($casasCultura->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('casas_cultura', 'public');
        }

        $data['activo'] = $request->boolean('activo');
        $casasCultura->update($data);

        return redirect()->route('admin.casas_cultura.index')->with('success', 'Casa de Cultura actualizada.');
    }

    public function destroy(CasaCultura $casasCultura)
    {
        if ($casasCultura->imagen && str_starts_with($casasCultura->imagen, 'casas_cultura/')) {
            Storage::disk('public')->delete($casasCultura->imagen);
        }
        $casasCultura->delete();

        return redirect()->route('admin.casas_cultura.index')->with('success', 'Casa de Cultura eliminada.');
    }
}
