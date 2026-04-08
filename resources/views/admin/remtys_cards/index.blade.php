@extends('admin.layouts.app')
@section('title', 'REMTYS')
@section('page-title', 'REMTYS')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <i class="fas fa-tags text-amber-500 text-xl"></i>
        <h2 class="text-3xl font-extrabold text-slate-900">Categorias REMTYS</h2>
    </div>
    <a href="{{ route('admin.remtys_cards.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200"><i class="fas fa-plus text-xs"></i> Nueva Categoria</a>
</div>

@if(session('success'))
<div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($cards as $card)
        <article class="rounded-2xl overflow-hidden border border-gray-200 bg-white shadow-sm">
            <div class="h-28 bg-gradient-to-r {{ $card->color_gradiente }} px-6 py-4">
                <h3 class="text-2xl font-extrabold text-white uppercase leading-tight tracking-wide">{{ $card->nombre }}</h3>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between gap-3 text-sm text-gray-600 mb-3">
                    <div>
                        <span class="font-semibold">Slug:</span>
                        <span class="font-mono bg-gray-100 px-2 py-0.5 rounded">{{ \Illuminate\Support\Str::slug($card->nombre) }}</span>
                    </div>
                    <div><span class="font-semibold">Orden:</span> {{ $card->orden }}</div>
                </div>
                <p class="text-xl text-gray-700 mb-4"><i class="fas fa-file-alt text-gray-400 mr-1"></i> {{ $card->documentos_count }} documentos</p>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.remtys_cards.edit', $card) }}" class="flex-1 text-center px-4 py-2 rounded-lg bg-amber-500 text-white font-semibold hover:bg-amber-600 transition-colors">Editar</a>
                    <a href="{{ route('admin.remtys_documentos.index', ['categoria' => $card->id]) }}" class="flex-1 text-center px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition-colors">Ver docs</a>
                </div>
            </div>
        </article>
    @empty
        <div class="col-span-full rounded-2xl border border-dashed border-gray-300 p-10 text-center text-gray-400">No hay categorias registradas.</div>
    @endforelse
</div>

@if($cards->hasPages())
    <div class="mt-6">{{ $cards->links() }}</div>
@endif
@endsection
