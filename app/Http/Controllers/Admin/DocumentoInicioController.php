<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentoInicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoInicioController extends Controller
{
    public function index()
    {
        $documentos = DocumentoInicio::orderBy('orden')->orderBy('id')->get();

        return view('admin.documentos_inicio.index', compact('documentos'));
    }

    public function create()
    {
        return view('admin.documentos_inicio.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => ['required', 'string', 'max:255'],
            'tipo_fuente'  => ['required', 'in:archivo,link'],
            'archivo'      => ['nullable', 'required_if:tipo_fuente,archivo', 'file', 'mimes:pdf', 'max:204800'],
            'link_externo' => ['nullable', 'required_if:tipo_fuente,link', 'url', 'max:500'],
            'orden'        => ['nullable', 'integer', 'min:0'],
            'activo'       => ['nullable', 'boolean'],
        ]);

        $doc = new DocumentoInicio();
        $doc->nombre = $data['nombre'];
        $doc->orden  = $data['orden'] ?? 0;
        $doc->activo = $request->boolean('activo', true);

        if ($request->tipo_fuente === 'archivo' && $request->hasFile('archivo')) {
            $doc->archivo = $request->file('archivo')->store('documentos_inicio', 'public');
        } elseif ($request->tipo_fuente === 'link') {
            $doc->link_externo = $data['link_externo'];
        }

        $doc->save();

        return redirect()->route('admin.documentos_inicio.index')
            ->with('success', 'Documento de inicio creado correctamente.');
    }

    public function edit(DocumentoInicio $documentosInicio)
    {
        return view('admin.documentos_inicio.edit', ['documento' => $documentosInicio]);
    }

    public function update(Request $request, DocumentoInicio $documentosInicio)
    {
        $data = $request->validate([
            'nombre'       => ['required', 'string', 'max:255'],
            'tipo_fuente'  => ['required', 'in:archivo,link'],
            'archivo'      => ['nullable', 'file', 'mimes:pdf', 'max:204800'],
            'link_externo' => ['nullable', 'url', 'max:500'],
            'orden'        => ['nullable', 'integer', 'min:0'],
            'activo'       => ['nullable', 'boolean'],
        ]);

        $doc = $documentosInicio;
        $doc->nombre = $data['nombre'];
        $doc->orden  = $data['orden'] ?? 0;
        $doc->activo = $request->boolean('activo');

        if ($request->tipo_fuente === 'archivo') {
            if ($request->hasFile('archivo')) {
                if ($doc->archivo) {
                    Storage::disk('public')->delete($doc->archivo);
                }
                $doc->archivo      = $request->file('archivo')->store('documentos_inicio', 'public');
                $doc->link_externo = null;
            }
        } elseif ($request->tipo_fuente === 'link') {
            if ($doc->archivo) {
                Storage::disk('public')->delete($doc->archivo);
                $doc->archivo = null;
            }
            $doc->link_externo = $data['link_externo'];
        }

        $doc->save();

        return redirect()->route('admin.documentos_inicio.index')
            ->with('success', 'Documento de inicio actualizado correctamente.');
    }

    public function destroy(DocumentoInicio $documentosInicio)
    {
        if ($documentosInicio->archivo) {
            Storage::disk('public')->delete($documentosInicio->archivo);
        }

        $documentosInicio->delete();

        return redirect()->route('admin.documentos_inicio.index')
            ->with('success', 'Documento eliminado correctamente.');
    }
}
