<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RemtysCard;
use Illuminate\Http\Request;

class RemtysCardController extends Controller
{
    public function index()
    {
        $cards = RemtysCard::withCount('documentos')->orderBy('orden')->orderBy('id')->paginate(12);

        return view('admin.remtys_cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.remtys_cards.create', ['card' => new RemtysCard()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color_gradiente' => ['nullable', 'string', 'max:120'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-file-lines';
        $data['color_gradiente'] = $data['color_gradiente'] ?: 'from-purple-700/80 to-purple-500/80';
        $data['activo'] = $request->boolean('activo', true);

        RemtysCard::create($data);

        return redirect()->route('admin.remtys_cards.index')->with('success', 'Card de REMTYS creada.');
    }

    public function edit(RemtysCard $remtysCard)
    {
        $remtysCard->load(['documentos' => fn ($q) => $q->orderBy('orden')->orderBy('id')]);

        return view('admin.remtys_cards.edit', ['card' => $remtysCard]);
    }

    public function update(Request $request, RemtysCard $remtysCard)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'icono' => ['nullable', 'string', 'max:100'],
            'color_gradiente' => ['nullable', 'string', 'max:120'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['icono'] = $data['icono'] ?: 'fa-file-lines';
        $data['color_gradiente'] = $data['color_gradiente'] ?: 'from-purple-700/80 to-purple-500/80';
        $data['activo'] = $request->boolean('activo');

        $remtysCard->update($data);

        return redirect()->route('admin.remtys_cards.edit', $remtysCard)->with('success', 'Card de REMTYS actualizada.');
    }

    public function destroy(RemtysCard $remtysCard)
    {
        $remtysCard->delete();

        return redirect()->route('admin.remtys_cards.index')->with('success', 'Card de REMTYS eliminada.');
    }
}
