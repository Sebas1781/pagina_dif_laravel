@extends('admin.layouts.app')
@section('title', 'Documentos REMTYS')
@section('page-title', 'Documentos REMTYS')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <i class="fas fa-folder text-amber-400 text-2xl"></i>
        <h2 class="text-4xl font-extrabold text-slate-900">Documentos REMTYS</h2>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.remtys_documentos.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200"><i class="fas fa-plus text-xs"></i> Agregar Documento</a>
    </div>
</div>

@if(session('success'))
<div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
@endif

<form method="GET" action="{{ route('admin.remtys_documentos.index') }}" class="bg-white rounded-2xl border border-gray-200 p-5 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label for="categoria" class="block text-sm font-semibold text-gray-700 mb-1.5">Categoria</label>
            <select id="categoria" name="categoria" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                <option value="">Todas</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ (string) $categoriaId === (string) $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label for="buscar" class="block text-sm font-semibold text-gray-700 mb-1.5">Buscar</label>
            <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" placeholder="Titulo del documento..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-800 text-white font-semibold">Filtrar</button>
            <a href="{{ route('admin.remtys_documentos.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-300 text-slate-800 font-semibold">Limpiar</a>
        </div>
    </div>
</form>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800 text-white"><tr><th class="px-5 py-3.5 text-left font-semibold">#</th><th class="px-5 py-3.5 text-left font-semibold">Categoria</th><th class="px-5 py-3.5 text-left font-semibold">Titulo</th><th class="px-5 py-3.5 text-left font-semibold">Tipo</th><th class="px-5 py-3.5 text-left font-semibold">Ver</th><th class="px-5 py-3.5 text-left font-semibold">Acciones</th></tr></thead>
        <tbody class="divide-y divide-gray-100">
        @forelse($documentos as $doc)
            <tr>
                <td class="px-5 py-4 text-gray-500">{{ $loop->iteration + (($documentos->currentPage() - 1) * $documentos->perPage()) }}</td>
                <td class="px-5 py-4"><span class="inline-flex px-3 py-1 rounded-full bg-pink-50 text-pink-700 font-semibold text-xs uppercase">{{ $doc->card->nombre ?? 'Sin categoria' }}</span></td>
                <td class="px-5 py-4 font-semibold text-slate-800">{{ $doc->titulo }}</td>
                <td class="px-5 py-4">{{ $doc->archivo ? 'PDF' : 'LINK' }}</td>
                <td class="px-5 py-4"><a href="{{ $doc->archivo ? asset('storage/' . $doc->archivo) : $doc->url }}" target="_self" class="text-indigo-500 hover:underline">Abrir</a></td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.remtys_documentos.edit', $doc) }}" class="px-3 py-1.5 rounded bg-amber-500 text-white font-semibold text-xs">Editar</a>
                        <form method="POST" action="{{ route('admin.remtys_documentos.destroy', $doc) }}" onsubmit="return confirm('¿Eliminar este documento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded bg-red-600 text-white font-semibold text-xs">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-5 py-16 text-center text-gray-400">No hay documentos registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
    @if($documentos->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $documentos->links() }}</div>
    @endif
</div>
@endsection
