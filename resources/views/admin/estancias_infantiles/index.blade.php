@extends('admin.layouts.app')
@section('title', 'Estancias Infantiles')
@section('page-title', 'Estancias Infantiles')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Gestiona las Estancias Infantiles del municipio.</p>
    <a href="{{ route('admin.estancias_infantiles.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200">
        <i class="fas fa-plus text-xs"></i> Nueva Estancia
    </a>
</div>

@if(session('success'))
    <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2">
        <i class="fas fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600 w-14">Orden</th>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600">Nombre</th>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600 w-40">Icono</th>
                <th class="px-5 py-3.5 text-center font-semibold text-gray-600 w-24">Estado</th>
                <th class="px-5 py-3.5 text-center font-semibold text-gray-600 w-32">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($items as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-5 py-4 text-gray-500 text-center">{{ $item->orden }}</td>
                    <td class="px-5 py-4 font-medium text-dif-dark">{{ $item->nombre }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas {{ $item->icono }}"></i> {{ $item->icono }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        @if($item->activo)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Oculto
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.estancias_infantiles.edit', $item) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-dif-pink border border-dif-pink rounded-lg hover:bg-dif-pink hover:text-white transition-colors duration-200">
                                <i class="fas fa-pen text-[10px]"></i> Editar
                            </a>
                            <form method="POST" action="{{ route('admin.estancias_infantiles.destroy', $item) }}"
                                  onsubmit="return confirm('¿Eliminar esta Estancia?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-500 border border-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-200">
                                    <i class="fas fa-trash text-[10px]"></i> Borrar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-16 text-center text-gray-400">
                    <i class="fas fa-child text-4xl mb-3 block"></i> No hay Estancias registradas.
                </td></tr>
            @endforelse
        </tbody>
    </table>
    @if($items->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $items->links() }}</div>
    @endif
</div>
@endsection
