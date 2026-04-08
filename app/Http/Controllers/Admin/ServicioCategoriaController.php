<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicioCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicioCategoriaController extends Controller
{
    public function create()
    {
        return view('admin.servicio_categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'subtitulo' => ['nullable', 'string', 'max:180'],
            'icono' => ['nullable', 'string', 'max:100'],
            'tema' => ['nullable', 'string', 'max:30'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $baseClave = Str::slug($data['nombre'], '_');
        $clave = $baseClave;
        $i = 1;
        while (ServicioCategoria::where('clave', $clave)->exists()) {
            $clave = $baseClave . '_' . $i;
            $i++;
        }

        ServicioCategoria::create([
            'clave' => $clave,
            'nombre' => $data['nombre'],
            'subtitulo' => $data['subtitulo'] ?? null,
            'icono' => $data['icono'] ?: 'fa-check',
            'tema' => $data['tema'] ?: 'pink',
            'orden' => $data['orden'] ?? 0,
            'activo' => $request->boolean('activo', true),
        ]);

        return redirect()->route('admin.servicio_items.index')->with('success', 'Categoria creada correctamente.');
    }
}
