<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentoSevac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SevacController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentoSevac::query();

        // Filtros
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

        // Años disponibles para el filtro
        $anios = DocumentoSevac::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.sevac.index', compact('documentos', 'anios'));
    }

    public function create()
    {
        // Categorías existentes para el datalist
        $categorias = DocumentoSevac::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $anios = DocumentoSevac::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.sevac.create', compact('categorias', 'anios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anio'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'categoria'    => ['required', 'string', 'max:255'],
            'nombre'       => ['required', 'string', 'max:255'],
            'tipo_fuente'  => ['required', 'in:archivo,link'],
            'archivo'      => ['nullable', 'required_if:tipo_fuente,archivo', 'file', 'mimes:pdf', 'max:10240'],
            'link_externo' => ['nullable', 'required_if:tipo_fuente,link', 'url', 'max:500'],
            'orden'        => ['nullable', 'integer', 'min:0'],
            'activo'       => ['nullable', 'boolean'],
        ]);

        $doc = new DocumentoSevac();
        $doc->anio      = $data['anio'];
        $doc->categoria = $data['categoria'];
        $doc->nombre    = $data['nombre'];
        $doc->orden     = $data['orden'] ?? 0;
        $doc->activo    = $request->boolean('activo', true);

        if ($request->tipo_fuente === 'archivo' && $request->hasFile('archivo')) {
            $doc->archivo = $request->file('archivo')->store('sevac/' . $data['anio'], 'public');
        } elseif ($request->tipo_fuente === 'link') {
            $doc->link_externo = $data['link_externo'];
        }

        $doc->save();

        return redirect()->route('admin.sevac.index')
            ->with('success', 'Documento SEVAC creado correctamente.');
    }

    public function edit(DocumentoSevac $sevac)
    {
        $categorias = DocumentoSevac::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $anios = DocumentoSevac::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('admin.sevac.edit', compact('sevac', 'categorias', 'anios'));
    }

    public function update(Request $request, DocumentoSevac $sevac)
    {
        $data = $request->validate([
            'anio'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'categoria'    => ['required', 'string', 'max:255'],
            'nombre'       => ['required', 'string', 'max:255'],
            'tipo_fuente'  => ['required', 'in:archivo,link'],
            'archivo'      => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'link_externo' => ['nullable', 'url', 'max:500'],
            'orden'        => ['nullable', 'integer', 'min:0'],
            'activo'       => ['nullable', 'boolean'],
        ]);

        $sevac->anio      = $data['anio'];
        $sevac->categoria = $data['categoria'];
        $sevac->nombre    = $data['nombre'];
        $sevac->orden     = $data['orden'] ?? 0;
        $sevac->activo    = $request->boolean('activo');

        if ($request->tipo_fuente === 'archivo') {
            if ($request->hasFile('archivo')) {
                // Borrar archivo anterior si existe
                if ($sevac->archivo) {
                    Storage::disk('public')->delete($sevac->archivo);
                }
                $sevac->archivo      = $request->file('archivo')->store('sevac/' . $data['anio'], 'public');
                $sevac->link_externo = null;
            }
        } elseif ($request->tipo_fuente === 'link') {
            // Borrar archivo si cambia a link
            if ($sevac->archivo) {
                Storage::disk('public')->delete($sevac->archivo);
                $sevac->archivo = null;
            }
            $sevac->link_externo = $data['link_externo'];
        }

        $sevac->save();

        return redirect()->route('admin.sevac.index')
            ->with('success', 'Documento SEVAC actualizado correctamente.');
    }

    public function destroy(DocumentoSevac $sevac)
    {
        if ($sevac->archivo) {
            Storage::disk('public')->delete($sevac->archivo);
        }

        $sevac->delete();

        return redirect()->route('admin.sevac.index')
            ->with('success', 'Documento SEVAC eliminado.');
    }
}
