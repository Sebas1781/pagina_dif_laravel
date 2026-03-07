<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biblioteca;
use Illuminate\Http\Request;

class BibliotecaController extends Controller
{
    public function index()
    {
        $items = Biblioteca::orderBy('orden')->orderBy('nombre')->paginate(15);
        return view('admin.bibliotecas.index', compact('items'));
    }

    public function create()
    {
        return view('admin.bibliotecas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden'  => ['nullable', 'integer', 'min:0'],
        ]);

        $data['activo'] = $request->boolean('activo', true);
        Biblioteca::create($data);

        return redirect()->route('admin.bibliotecas.index')->with('success', 'Biblioteca creada correctamente.');
    }

    public function edit(Biblioteca $biblioteca)
    {
        return view('admin.bibliotecas.edit', ['item' => $biblioteca]);
    }

    public function update(Request $request, Biblioteca $biblioteca)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden'  => ['nullable', 'integer', 'min:0'],
        ]);

        $data['activo'] = $request->boolean('activo');
        $biblioteca->update($data);

        return redirect()->route('admin.bibliotecas.index')->with('success', 'Biblioteca actualizada.');
    }

    public function destroy(Biblioteca $biblioteca)
    {
        $biblioteca->delete();
        return redirect()->route('admin.bibliotecas.index')->with('success', 'Biblioteca eliminada.');
    }
}
