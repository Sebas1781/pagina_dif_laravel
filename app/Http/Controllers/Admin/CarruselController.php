<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrusel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarruselController extends Controller
{
    public function index()
    {
        $slides = Carrusel::orderBy('orden')->orderByDesc('created_at')->paginate(10);
        return view('admin.carrusel.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.carrusel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'   => ['required', 'string', 'max:255'],
            'imagen'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:51200'],
            'url'      => ['nullable', 'string', 'max:500'],
            'archivo'  => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:204800'],
            'activo'   => ['nullable', 'boolean'],
            'orden'    => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('carrusel', 'public');
        }

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('carrusel/archivos', 'public');
        }

        $data['activo'] = $request->boolean('activo', true);

        Carrusel::create($data);

        return redirect()->route('admin.carrusel.index')
            ->with('success', 'Diapositiva creada correctamente.');
    }

    public function edit(Carrusel $carrusel)
    {
        return view('admin.carrusel.edit', compact('carrusel'));
    }

    public function update(Request $request, Carrusel $carrusel)
    {
        $data = $request->validate([
            'titulo'   => ['required', 'string', 'max:255'],
            'imagen'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:51200'],
            'url'      => ['nullable', 'string', 'max:500'],
            'archivo'  => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:204800'],
            'activo'   => ['nullable', 'boolean'],
            'orden'    => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($carrusel->imagen && str_starts_with($carrusel->imagen, 'carrusel/')) {
                Storage::disk('public')->delete($carrusel->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('carrusel', 'public');
        }

        if ($request->hasFile('archivo')) {
            if ($carrusel->archivo) {
                Storage::disk('public')->delete($carrusel->archivo);
            }
            $data['archivo'] = $request->file('archivo')->store('carrusel/archivos', 'public');
        }

        if ($request->input('eliminar_archivo') && $carrusel->archivo) {
            Storage::disk('public')->delete($carrusel->archivo);
            $data['archivo'] = null;
        }

        $data['activo'] = $request->boolean('activo');

        $carrusel->update($data);

        return redirect()->route('admin.carrusel.index')
            ->with('success', 'Diapositiva actualizada correctamente.');
    }

    public function destroy(Carrusel $carrusel)
    {
        if ($carrusel->imagen && str_starts_with($carrusel->imagen, 'carrusel/')) {
            Storage::disk('public')->delete($carrusel->imagen);
        }
        if ($carrusel->archivo) {
            Storage::disk('public')->delete($carrusel->archivo);
        }
        $carrusel->delete();

        return redirect()->route('admin.carrusel.index')
            ->with('success', 'Diapositiva eliminada correctamente.');
    }
}
