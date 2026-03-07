<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boletin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoletinController extends Controller
{
    public function index()
    {
        $boletines = Boletin::orderBy('orden')->orderByDesc('created_at')->paginate(10);
        return view('admin.boletines.index', compact('boletines'));
    }

    public function create()
    {
        return view('admin.boletines.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'imagen'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo'      => ['nullable', 'boolean'],
            'orden'       => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('boletines', 'public');
        }

        $data['activo'] = $request->boolean('activo', true);

        Boletin::create($data);

        return redirect()->route('admin.boletines.index')
            ->with('success', 'Boletín creado correctamente.');
    }

    public function edit(Boletin $boletin)
    {
        return view('admin.boletines.edit', compact('boletin'));
    }

    public function update(Request $request, Boletin $boletin)
    {
        $data = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'imagen'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo'      => ['nullable', 'boolean'],
            'orden'       => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si es de storage (no las originales del /images/)
            if ($boletin->imagen && str_starts_with($boletin->imagen, 'boletines/')) {
                Storage::disk('public')->delete($boletin->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('boletines', 'public');
        }

        $data['activo'] = $request->boolean('activo');

        $boletin->update($data);

        return redirect()->route('admin.boletines.index')
            ->with('success', 'Boletín actualizado correctamente.');
    }

    public function destroy(Boletin $boletin)
    {
        if ($boletin->imagen && str_starts_with($boletin->imagen, 'boletines/')) {
            Storage::disk('public')->delete($boletin->imagen);
        }

        $boletin->delete();

        return redirect()->route('admin.boletines.index')
            ->with('success', 'Boletín eliminado.');
    }
}
