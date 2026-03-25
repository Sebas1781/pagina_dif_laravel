<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentoConac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConacController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentoConac::query();

        if ($request->filled('anio')) {
            $query->where('anio', $request->anio);
        }
        if ($request->filled('categoria')) {
            $query->where('categoria', 'like', '%' . $request->categoria . '%');
        }
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $documentos = $query->orderByDesc('anio')
            ->orderBy('categoria')
            ->orderBy('orden')
            ->paginate(20)
            ->withQueryString();

        $anios = DocumentoConac::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.conac.index', compact('documentos', 'anios'));
    }

    public function create()
    {
        $categorias = DocumentoConac::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $anios = DocumentoConac::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.conac.create', compact('categorias', 'anios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anio'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'categoria'    => ['required', 'string', 'max:255'],
            'nombre'       => ['required', 'string', 'max:255'],
            'tipo_fuente'  => ['required', 'in:archivo,link'],
            'archivo'      => ['nullable', 'required_if:tipo_fuente,archivo', 'file', 'mimes:pdf', 'max:204800'],
            'link_externo' => ['nullable', 'required_if:tipo_fuente,link', 'url', 'max:500'],
            'orden'        => ['nullable', 'integer', 'min:0'],
            'activo'       => ['nullable', 'boolean'],
        ]);

        $doc = new DocumentoConac();
        $doc->anio      = $data['anio'];
        $doc->categoria = $data['categoria'];
        $doc->nombre    = $data['nombre'];
        $doc->orden     = $data['orden'] ?? 0;
        $doc->activo    = $request->boolean('activo', true);

        if ($request->tipo_fuente === 'archivo' && $request->hasFile('archivo')) {
            $doc->archivo = $request->file('archivo')->store('conac/' . $data['anio'], 'public');
        } elseif ($request->tipo_fuente === 'link') {
            $doc->link_externo = $data['link_externo'];
        }

        $doc->save();

        return redirect()->route('admin.conac.index')
            ->with('success', 'Documento CONAC creado correctamente.');
    }

    public function edit(DocumentoConac $conac)
    {
        $categorias = DocumentoConac::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $anios = DocumentoConac::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.conac.edit', compact('conac', 'categorias', 'anios'));
    }

    public function update(Request $request, DocumentoConac $conac)
    {
        $data = $request->validate([
            'anio'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'categoria'    => ['required', 'string', 'max:255'],
            'nombre'       => ['required', 'string', 'max:255'],
            'tipo_fuente'  => ['required', 'in:archivo,link'],
            'archivo'      => ['nullable', 'file', 'mimes:pdf', 'max:204800'],
            'link_externo' => ['nullable', 'url', 'max:500'],
            'orden'        => ['nullable', 'integer', 'min:0'],
            'activo'       => ['nullable', 'boolean'],
        ]);

        $conac->anio      = $data['anio'];
        $conac->categoria = $data['categoria'];
        $conac->nombre    = $data['nombre'];
        $conac->orden     = $data['orden'] ?? 0;
        $conac->activo    = $request->boolean('activo');

        if ($request->tipo_fuente === 'archivo') {
            if ($request->hasFile('archivo')) {
                if ($conac->archivo) {
                    Storage::disk('public')->delete($conac->archivo);
                }
                $conac->archivo      = $request->file('archivo')->store('conac/' . $data['anio'], 'public');
                $conac->link_externo = null;
            }
        } elseif ($request->tipo_fuente === 'link') {
            if ($conac->archivo) {
                Storage::disk('public')->delete($conac->archivo);
                $conac->archivo = null;
            }
            $conac->link_externo = $data['link_externo'];
        }

        $conac->save();

        return redirect()->route('admin.conac.index')
            ->with('success', 'Documento CONAC actualizado correctamente.');
    }

    public function destroy(DocumentoConac $conac)
    {
        if ($conac->archivo) {
            Storage::disk('public')->delete($conac->archivo);
        }

        $conac->delete();

        return redirect()->route('admin.conac.index')
            ->with('success', 'Documento CONAC eliminado.');
    }
}
