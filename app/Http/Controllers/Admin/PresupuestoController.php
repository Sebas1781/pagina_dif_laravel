<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentoPresupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresupuestoController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentoPresupuesto::query();

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

        $anios = DocumentoPresupuesto::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.presupuesto.index', compact('documentos', 'anios'));
    }

    public function create()
    {
        $categorias = DocumentoPresupuesto::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $anios = DocumentoPresupuesto::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.presupuesto.create', compact('categorias', 'anios'));
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

        $doc = new DocumentoPresupuesto();
        $doc->anio      = $data['anio'];
        $doc->categoria = $data['categoria'];
        $doc->nombre    = $data['nombre'];
        $doc->orden     = $data['orden'] ?? 0;
        $doc->activo    = $request->boolean('activo', true);

        if ($request->tipo_fuente === 'archivo' && $request->hasFile('archivo')) {
            $doc->archivo = $request->file('archivo')->store('presupuesto/' . $data['anio'], 'public');
        } elseif ($request->tipo_fuente === 'link') {
            $doc->link_externo = $data['link_externo'];
        }

        $doc->save();

        return redirect()->route('admin.presupuesto.index')
            ->with('success', 'Documento de Presupuesto creado correctamente.');
    }

    public function edit(DocumentoPresupuesto $presupuesto)
    {
        $categorias = DocumentoPresupuesto::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $anios = DocumentoPresupuesto::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.presupuesto.edit', compact('presupuesto', 'categorias', 'anios'));
    }

    public function update(Request $request, DocumentoPresupuesto $presupuesto)
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

        $presupuesto->anio      = $data['anio'];
        $presupuesto->categoria = $data['categoria'];
        $presupuesto->nombre    = $data['nombre'];
        $presupuesto->orden     = $data['orden'] ?? 0;
        $presupuesto->activo    = $request->boolean('activo');

        if ($request->tipo_fuente === 'archivo') {
            if ($request->hasFile('archivo')) {
                if ($presupuesto->archivo) {
                    Storage::disk('public')->delete($presupuesto->archivo);
                }
                $presupuesto->archivo      = $request->file('archivo')->store('presupuesto/' . $data['anio'], 'public');
                $presupuesto->link_externo = null;
            }
        } elseif ($request->tipo_fuente === 'link') {
            if ($presupuesto->archivo) {
                Storage::disk('public')->delete($presupuesto->archivo);
                $presupuesto->archivo = null;
            }
            $presupuesto->link_externo = $data['link_externo'];
        }

        $presupuesto->save();

        return redirect()->route('admin.presupuesto.index')
            ->with('success', 'Documento de Presupuesto actualizado correctamente.');
    }

    public function destroy(DocumentoPresupuesto $presupuesto)
    {
        if ($presupuesto->archivo) {
            Storage::disk('public')->delete($presupuesto->archivo);
        }

        $presupuesto->delete();

        return redirect()->route('admin.presupuesto.index')
            ->with('success', 'Documento de Presupuesto eliminado.');
    }
}
