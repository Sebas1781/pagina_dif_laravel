<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventoCultural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoCulturalController extends Controller
{
    public function index()
    {
        $items = EventoCultural::orderBy('orden')->orderByDesc('created_at')->paginate(10);
        return view('admin.eventos_culturales.index', compact('items'));
    }

    public function create()
    {
        return view('admin.eventos_culturales.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'subtitulo'   => ['nullable', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'imagen'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo'      => ['nullable', 'boolean'],
            'orden'       => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('eventos_culturales', 'public');
        }

        $data['activo'] = $request->boolean('activo', true);
        EventoCultural::create($data);

        return redirect()->route('admin.eventos_culturales.index')->with('success', 'Evento Cultural creado correctamente.');
    }

    public function edit(EventoCultural $eventosCulturale)
    {
        return view('admin.eventos_culturales.edit', ['item' => $eventosCulturale]);
    }

    public function update(Request $request, EventoCultural $eventosCulturale)
    {
        $data = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'subtitulo'   => ['nullable', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'imagen'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo'      => ['nullable', 'boolean'],
            'orden'       => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($eventosCulturale->imagen && str_starts_with($eventosCulturale->imagen, 'eventos_culturales/')) {
                Storage::disk('public')->delete($eventosCulturale->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('eventos_culturales', 'public');
        }

        $data['activo'] = $request->boolean('activo');
        $eventosCulturale->update($data);

        return redirect()->route('admin.eventos_culturales.index')->with('success', 'Evento Cultural actualizado.');
    }

    public function destroy(EventoCultural $eventosCulturale)
    {
        if ($eventosCulturale->imagen && str_starts_with($eventosCulturale->imagen, 'eventos_culturales/')) {
            Storage::disk('public')->delete($eventosCulturale->imagen);
        }
        $eventosCulturale->delete();

        return redirect()->route('admin.eventos_culturales.index')->with('success', 'Evento Cultural eliminado.');
    }
}
