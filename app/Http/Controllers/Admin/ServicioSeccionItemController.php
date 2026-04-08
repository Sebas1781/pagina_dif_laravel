<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicioCategoria;
use App\Models\ServicioSeccionItem;
use Illuminate\Http\Request;

class ServicioSeccionItemController extends Controller
{
    public function index()
    {
        $categorias = ServicioCategoria::orderBy('orden')->orderBy('id')->get(['clave', 'nombre']);
        $itemsPorCategoria = ServicioSeccionItem::orderBy('categoria')
            ->orderBy('orden')
            ->orderBy('id')
            ->get()
            ->groupBy('categoria');

        return view('admin.servicio_items.index', compact('categorias', 'itemsPorCategoria'));
    }

    public function create()
    {
        $categorias = ServicioCategoria::orderBy('orden')->orderBy('id')->pluck('nombre', 'clave')->toArray();

        return view('admin.servicio_items.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria' => ['required', 'exists:servicio_categorias,clave'],
            'nombre' => ['required', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['activo'] = $request->boolean('activo', true);

        ServicioSeccionItem::create($data);

        return redirect()->route('admin.servicio_items.index')->with('success', 'Elemento de servicio creado correctamente.');
    }

    public function edit(ServicioSeccionItem $servicioItem)
    {
        $categorias = ServicioCategoria::orderBy('orden')->orderBy('id')->pluck('nombre', 'clave')->toArray();

        return view('admin.servicio_items.edit', ['item' => $servicioItem, 'categorias' => $categorias]);
    }

    public function update(Request $request, ServicioSeccionItem $servicioItem)
    {
        $data = $request->validate([
            'categoria' => ['required', 'exists:servicio_categorias,clave'],
            'nombre' => ['required', 'string', 'max:255'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['activo'] = $request->boolean('activo');

        $servicioItem->update($data);

        return redirect()->route('admin.servicio_items.index')->with('success', 'Elemento de servicio actualizado.');
    }

    public function destroy(ServicioSeccionItem $servicioItem)
    {
        $servicioItem->delete();

        return redirect()->route('admin.servicio_items.index')->with('success', 'Elemento de servicio eliminado.');
    }
}
