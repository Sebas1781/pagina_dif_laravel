<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RemtysCard;
use App\Models\RemtysDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RemtysDocumentoController extends Controller
{
    public function index(Request $request)
    {
        $categorias = RemtysCard::orderBy('orden')->orderBy('id')->get();
        $categoriaId = $request->input('categoria');
        $buscar = trim((string) $request->input('buscar'));

        $documentos = RemtysDocumento::with('card')
            ->when($categoriaId, fn ($q) => $q->where('remtys_card_id', $categoriaId))
            ->when($buscar !== '', fn ($q) => $q->where('titulo', 'like', '%' . $buscar . '%'))
            ->orderBy('orden')
            ->orderBy('id')
            ->paginate(30)
            ->withQueryString();

        return view('admin.remtys_documentos.index', compact('categorias', 'categoriaId', 'buscar', 'documentos'));
    }

    public function create()
    {
        $categorias = RemtysCard::orderBy('orden')->orderBy('id')->get();

        return view('admin.remtys_documentos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'remtys_card_id' => ['required', 'exists:remtys_cards,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'archivo' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'url' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        if (!$request->hasFile('archivo') && empty($data['url'])) {
            return back()->withErrors(['archivo' => 'Debes subir un PDF o indicar una URL.'])->withInput();
        }

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('remtys', 'public');
            $data['url'] = null;
        } else {
            $data['archivo'] = null;
        }

        $data['activo'] = $request->boolean('activo', true);

        RemtysDocumento::create($data);

        return redirect()->route('admin.remtys_documentos.index', ['categoria' => $data['remtys_card_id']])->with('success', 'Documento agregado correctamente.');
    }

    public function edit(RemtysDocumento $remtysDocumento)
    {
        $categorias = RemtysCard::orderBy('orden')->orderBy('id')->get();

        return view('admin.remtys_documentos.edit', compact('remtysDocumento', 'categorias'));
    }

    public function update(Request $request, RemtysDocumento $remtysDocumento)
    {
        $data = $request->validate([
            'remtys_card_id' => ['required', 'exists:remtys_cards,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'archivo' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'url' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
        ]);

        if (!$request->hasFile('archivo') && empty($data['url']) && empty($remtysDocumento->archivo)) {
            return back()->withErrors(['archivo' => 'Debes subir un PDF o indicar una URL.'])->withInput();
        }

        if ($request->hasFile('archivo')) {
            if ($remtysDocumento->archivo && str_starts_with($remtysDocumento->archivo, 'remtys/')) {
                Storage::disk('public')->delete($remtysDocumento->archivo);
            }
            $data['archivo'] = $request->file('archivo')->store('remtys', 'public');
            $data['url'] = null;
        } elseif (!empty($data['url'])) {
            if ($remtysDocumento->archivo && str_starts_with($remtysDocumento->archivo, 'remtys/')) {
                Storage::disk('public')->delete($remtysDocumento->archivo);
            }
            $data['archivo'] = null;
        } else {
            $data['archivo'] = $remtysDocumento->archivo;
            $data['url'] = $remtysDocumento->url;
        }

        $data['activo'] = $request->boolean('activo', true);

        $remtysDocumento->update($data);

        return redirect()->route('admin.remtys_documentos.index', ['categoria' => $data['remtys_card_id']])->with('success', 'Documento actualizado correctamente.');
    }

    public function destroy(RemtysDocumento $remtysDocumento)
    {
        $categoriaId = $remtysDocumento->remtys_card_id;

        if ($remtysDocumento->archivo && str_starts_with($remtysDocumento->archivo, 'remtys/')) {
            Storage::disk('public')->delete($remtysDocumento->archivo);
        }

        $remtysDocumento->delete();

        return redirect()->route('admin.remtys_documentos.index', ['categoria' => $categoriaId])->with('success', 'Documento eliminado.');
    }
}
