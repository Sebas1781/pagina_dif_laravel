<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionNosotros;
use Illuminate\Http\Request;

class ConfiguracionNosotrosController extends Controller
{
    public function edit()
    {
        $item = ConfiguracionNosotros::firstOrCreate(['id' => 1], [
            'mision' => null,
            'vision' => null,
            'valores' => [],
        ]);

        return view('admin.configuracion_nosotros.edit', compact('item'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mision' => ['required', 'string'],
            'vision' => ['required', 'string'],
            'valores_texto' => ['nullable', 'string'],
        ]);

        $valores = collect(preg_split('/\r\n|\r|\n/', $data['valores_texto'] ?? ''))
            ->map(fn ($linea) => trim($linea))
            ->filter()
            ->values()
            ->all();

        ConfiguracionNosotros::updateOrCreate(
            ['id' => 1],
            [
                'mision' => $data['mision'],
                'vision' => $data['vision'],
                'valores' => $valores,
            ]
        );

        return redirect()->route('admin.configuracion_nosotros.edit')->with('success', 'Textos de Nosotros actualizados correctamente.');
    }
}
