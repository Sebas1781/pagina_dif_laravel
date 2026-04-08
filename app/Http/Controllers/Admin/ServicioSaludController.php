<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicioSalud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioSaludController extends Controller
{
    public function index()
    {
        $items = ServicioSalud::orderBy('orden')->orderBy('id')->paginate(12);

        return view('admin.servicios_salud.index', compact('items'));
    }

    public function create()
    {
        return view('admin.servicios_salud.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'horario' => ['nullable', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('servicios_salud', 'public');
        }

        $data['color_horario'] = $this->colorHorarioAleatorio();
        $data['activo'] = $request->boolean('activo', true);

        ServicioSalud::create($data);

        return redirect()->route('admin.servicios_salud.index')->with('success', 'Servicio de salud creado correctamente.');
    }

    public function edit(ServicioSalud $serviciosSalud)
    {
        return view('admin.servicios_salud.edit', ['item' => $serviciosSalud]);
    }

    public function update(Request $request, ServicioSalud $serviciosSalud)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'horario' => ['nullable', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($serviciosSalud->imagen && str_starts_with($serviciosSalud->imagen, 'servicios_salud/')) {
                Storage::disk('public')->delete($serviciosSalud->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('servicios_salud', 'public');
        }

        $data['color_horario'] = $serviciosSalud->color_horario ?: $this->colorHorarioAleatorio();
        $data['activo'] = $request->boolean('activo');

        $serviciosSalud->update($data);

        return redirect()->route('admin.servicios_salud.index')->with('success', 'Servicio de salud actualizado.');
    }

    public function destroy(ServicioSalud $serviciosSalud)
    {
        if ($serviciosSalud->imagen && str_starts_with($serviciosSalud->imagen, 'servicios_salud/')) {
            Storage::disk('public')->delete($serviciosSalud->imagen);
        }

        $serviciosSalud->delete();

        return redirect()->route('admin.servicios_salud.index')->with('success', 'Servicio de salud eliminado.');
    }

    private function colorHorarioAleatorio(): string
    {
        $colores = [
            'text-dif-pink',
            'text-green-600',
            'text-blue-600',
            'text-purple-600',
            'text-teal-600',
            'text-amber-600',
        ];

        return $colores[array_rand($colores)];
    }
}
