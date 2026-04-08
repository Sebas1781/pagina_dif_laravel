<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RemtysCard;
use App\Models\RemtysDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RemtysDocumentoController extends Controller
{
    public function index(RemtysCard $remtysCard)
    {
        $documentos = $remtysCard->documentos()->get();

        return view('admin.remtys_documentos.index', ['card' => $remtysCard, 'documentos' => $documentos]);
    }

    public function create(RemtysCard $remtysCard)
    {
        return view('admin.remtys_documentos.create', ['card' => $remtysCard]);
    }

    public function store(Request $request, RemtysCard $remtysCard)
    {
        $data = $request->validate([
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
        }

        $data['remtys_card_id'] = $remtysCard->id;
        $data['activo'] = $request->boolean('activo', true);

        RemtysDocumento::create($data);

        return redirect()->route('admin.remtys_cards.edit', $remtysCard)->with('success', 'Documento agregado correctamente.');
    }

    public function destroy(RemtysCard $remtysCard, RemtysDocumento $remtysDocumento)
    {
        if ($remtysDocumento->remtys_card_id !== $remtysCard->id) {
            abort(404);
        }

        if ($remtysDocumento->archivo && str_starts_with($remtysDocumento->archivo, 'remtys/')) {
            Storage::disk('public')->delete($remtysDocumento->archivo);
        }

        $remtysDocumento->delete();

        return redirect()->route('admin.remtys_cards.edit', $remtysCard)->with('success', 'Documento eliminado.');
    }
}
