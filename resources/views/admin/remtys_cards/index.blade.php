@extends('admin.layouts.app')
@section('title', 'REMTYS')
@section('page-title', 'REMTYS')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Administra cards y documentos de REMTYS.</p>
    <a href="{{ route('admin.remtys_cards.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200"><i class="fas fa-plus text-xs"></i> Nueva Card</a>
</div>

@if(session('success'))
<div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100"><tr><th class="px-5 py-3.5 text-left font-semibold text-gray-600">Orden</th><th class="px-5 py-3.5 text-left font-semibold text-gray-600">Nombre</th><th class="px-5 py-3.5 text-left font-semibold text-gray-600">Documentos</th><th class="px-5 py-3.5 text-center font-semibold text-gray-600">Estado</th><th class="px-5 py-3.5 text-center font-semibold text-gray-600">Acciones</th></tr></thead>
        <tbody class="divide-y divide-gray-50">
        @forelse($cards as $card)
            <tr>
                <td class="px-5 py-4">{{ $card->orden }}</td>
                <td class="px-5 py-4 font-medium text-dif-dark">{{ $card->nombre }}</td>
                <td class="px-5 py-4 text-gray-500">{{ $card->documentos_count }}</td>
                <td class="px-5 py-4 text-center">{{ $card->activo ? 'Activa' : 'Oculta' }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-center gap-2 flex-wrap">
                        <a href="{{ route('admin.remtys_documentos.index', $card) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-300 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-200"><i class="fas fa-file-lines text-[10px]"></i> Documentos</a>
                        <a href="{{ route('admin.remtys_cards.edit', $card) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-dif-pink border border-dif-pink rounded-lg hover:bg-dif-pink hover:text-white transition-colors duration-200"><i class="fas fa-pen text-[10px]"></i> Editar</a>
                        <form method="POST" action="{{ route('admin.remtys_cards.destroy', $card) }}" onsubmit="return confirm('¿Eliminar esta card y sus documentos?')">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-500 border border-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-200"><i class="fas fa-trash text-[10px]"></i> Borrar</button></form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-5 py-16 text-center text-gray-400">No hay cards registradas.</td></tr>
        @endforelse
        </tbody>
    </table>
    @if($cards->hasPages())<div class="px-5 py-4 border-t border-gray-100">{{ $cards->links() }}</div>@endif
</div>
@endsection
