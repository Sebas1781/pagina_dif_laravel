@extends('admin.layouts.app')
@section('title', 'Unidades Medicas')
@section('page-title', 'Unidades Medicas')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Gestiona las unidades medicas de la pagina Salud.</p>
    <a href="{{ route('admin.unidades_medicas.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200">
        <i class="fas fa-plus text-xs"></i> Nueva Unidad
    </a>
</div>

@if(session('success'))
    <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600 w-14">Orden</th>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600">Nombre</th>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600">Tema</th>
                <th class="px-5 py-3.5 text-left font-semibold text-gray-600">Servicios</th>
                <th class="px-5 py-3.5 text-center font-semibold text-gray-600 w-24">Estado</th>
                <th class="px-5 py-3.5 text-center font-semibold text-gray-600 w-32">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($items as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-5 py-4 text-gray-500 text-center">{{ $item->orden }}</td>
                    <td class="px-5 py-4 font-medium text-dif-dark">{{ $item->nombre }}</td>
                    <td class="px-5 py-4 text-gray-500">{{ ucfirst($item->tema) }}</td>
                    <td class="px-5 py-4 text-gray-500">{{ count($item->servicios ?? []) }}</td>
                    <td class="px-5 py-4 text-center">{{ $item->activo ? 'Activo' : 'Oculto' }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.unidades_medicas.edit', $item) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-dif-pink border border-dif-pink rounded-lg hover:bg-dif-pink hover:text-white transition-colors duration-200"><i class="fas fa-pen text-[10px]"></i> Editar</a>
                            <form method="POST" action="{{ route('admin.unidades_medicas.destroy', $item) }}" onsubmit="return confirm('¿Eliminar esta unidad?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-500 border border-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-200"><i class="fas fa-trash text-[10px]"></i> Borrar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-16 text-center text-gray-400">No hay unidades registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($items->hasPages())<div class="px-5 py-4 border-t border-gray-100">{{ $items->links() }}</div>@endif
</div>
@endsection
