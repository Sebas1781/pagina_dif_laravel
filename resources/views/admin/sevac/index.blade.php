@extends('admin.layouts.app')

@section('title', 'Documentos SEVAC')
@section('page-title', 'Documentos SEVAC')

@section('content')

    {{-- Cabecera --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-gray-500 mt-0.5">Gestiona los documentos del Sistema de Evaluación de Armonización Contable.</p>
        </div>
        <a href="{{ route('admin.sevac.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200">
            <i class="fas fa-plus text-xs"></i>
            Nuevo documento
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2">
            <i class="fas fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Filtros --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-5">
        <form method="GET" action="{{ route('admin.sevac.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Año</label>
                <select name="anio" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent">
                    <option value="">Todos</option>
                    @foreach($anios as $anio)
                        <option value="{{ $anio }}" {{ request('anio') == $anio ? 'selected' : '' }}>{{ $anio }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Categoría</label>
                <input type="text" name="categoria" value="{{ request('categoria') }}" placeholder="Ej. CONAC, Trimestre..."
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent w-56">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Buscar nombre</label>
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Ej. Balanza, Estado..."
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-dif-pink focus:border-transparent w-56">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-dif-pink text-white text-sm font-semibold rounded-lg hover:bg-dif-pink-dark transition-colors">
                    <i class="fas fa-search mr-1"></i> Filtrar
                </button>
                @if(request()->hasAny(['anio', 'categoria', 'buscar']))
                    <a href="{{ route('admin.sevac.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-4 py-3.5 text-left font-semibold text-gray-600 w-14">Orden</th>
                    <th class="px-4 py-3.5 text-left font-semibold text-gray-600 w-16">Año</th>
                    <th class="px-4 py-3.5 text-left font-semibold text-gray-600">Categoría</th>
                    <th class="px-4 py-3.5 text-left font-semibold text-gray-600">Nombre</th>
                    <th class="px-4 py-3.5 text-center font-semibold text-gray-600 w-20">Fuente</th>
                    <th class="px-4 py-3.5 text-center font-semibold text-gray-600 w-20">Estado</th>
                    <th class="px-4 py-3.5 text-center font-semibold text-gray-600 w-32">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($documentos as $doc)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-3 text-gray-500 text-center">{{ $doc->orden }}</td>
                        <td class="px-4 py-3 font-semibold text-dif-dark">{{ $doc->anio }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs">
                            <p class="line-clamp-1">{{ $doc->categoria }}</p>
                        </td>
                        <td class="px-4 py-3 font-medium text-dif-dark max-w-xs">
                            <p class="line-clamp-1">{{ $doc->nombre }}</p>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($doc->tieneArchivo())
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                    <i class="fas fa-file-pdf text-[10px]"></i> PDF
                                </span>
                            @elseif($doc->tieneLink())
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                    <i class="fas fa-link text-[10px]"></i> Link
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($doc->activo)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Activo
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Oculto
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                @if($doc->url)
                                    <a href="{{ $doc->url }}" target="_blank"
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                                       title="Ver documento">
                                        <i class="fas fa-eye text-[10px]"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.sevac.edit', $doc) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-dif-pink border border-dif-pink rounded-lg hover:bg-dif-pink hover:text-white transition-colors duration-200">
                                    <i class="fas fa-pen text-[10px]"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.sevac.destroy', $doc) }}"
                                      onsubmit="return confirm('¿Eliminar este documento SEVAC?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-500 border border-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center text-gray-400">
                            <i class="fas fa-file-pdf text-4xl mb-3 block"></i>
                            No hay documentos SEVAC registrados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($documentos->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $documentos->links() }}
            </div>
        @endif
    </div>

@endsection
