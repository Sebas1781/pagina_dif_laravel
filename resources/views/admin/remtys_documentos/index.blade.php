@extends('admin.layouts.app')
@section('title', 'Documentos REMTYS')
@section('page-title', 'Documentos REMTYS')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Card: <span class="font-semibold text-dif-dark">{{ $card->nombre }}</span></p>
        <p class="text-xs text-gray-400 mt-1">Agrega documentos PDF o enlaces externos.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.remtys_documentos.create', $card) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200"><i class="fas fa-plus text-xs"></i> Nuevo Documento</a>
        <a href="{{ route('admin.remtys_cards.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">Volver</a>
    </div>
</div>

@if(session('success'))
<div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100"><tr><th class="px-5 py-3.5 text-left font-semibold text-gray-600">Orden</th><th class="px-5 py-3.5 text-left font-semibold text-gray-600">Titulo</th><th class="px-5 py-3.5 text-left font-semibold text-gray-600">Tipo</th><th class="px-5 py-3.5 text-center font-semibold text-gray-600">Acciones</th></tr></thead>
        <tbody class="divide-y divide-gray-50">
        @forelse($documentos as $doc)
            <tr>
                <td class="px-5 py-4">{{ $doc->orden }}</td>
                <td class="px-5 py-4 font-medium text-dif-dark">{{ $doc->titulo }}</td>
                <td class="px-5 py-4 text-gray-500">{{ $doc->archivo ? 'PDF' : 'URL' }}</td>
                <td class="px-5 py-4"><div class="flex items-center justify-center gap-2"><a href="{{ $doc->archivo ? asset('storage/' . $doc->archivo) : $doc->url }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-300 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-200" target="_self"><i class="fas fa-eye text-[10px]"></i> Ver</a><form method="POST" action="{{ route('admin.remtys_documentos.destroy', [$card, $doc]) }}" onsubmit="return confirm('¿Eliminar este documento?')">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-500 border border-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-200"><i class="fas fa-trash text-[10px]"></i> Borrar</button></form></div></td>
            </tr>
        @empty
            <tr><td colspan="4" class="px-5 py-16 text-center text-gray-400">No hay documentos para esta card.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
