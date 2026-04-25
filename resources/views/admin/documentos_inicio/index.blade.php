@extends('admin.layouts.app')

@section('title', 'PDFs de Inicio')
@section('page-title', 'PDFs de Inicio')

@section('content')

    {{-- Cabecera --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-gray-500 mt-0.5">Gestiona los botones de descarga de PDF que aparecen en la sección principal de la página de inicio.</p>
        </div>
        <a href="{{ route('admin.documentos_inicio.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200">
            <i class="fas fa-plus text-xs"></i>
            Nuevo PDF
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-2">
            <i class="fas fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-4 py-3.5 text-left font-semibold text-gray-600 w-14">Orden</th>
                    <th class="px-4 py-3.5 text-left font-semibold text-gray-600">Nombre (etiqueta del botón)</th>
                    <th class="px-4 py-3.5 text-center font-semibold text-gray-600 w-20">Fuente</th>
                    <th class="px-4 py-3.5 text-center font-semibold text-gray-600 w-20">Estado</th>
                    <th class="px-4 py-3.5 text-center font-semibold text-gray-600 w-32">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($documentos as $doc)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-3 text-gray-500 text-center">{{ $doc->orden }}</td>
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
                                <a href="{{ route('admin.documentos_inicio.edit', $doc) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-dif-pink border border-dif-pink rounded-lg hover:bg-dif-pink hover:text-white transition-colors duration-200">
                                    <i class="fas fa-pen text-[10px]"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.documentos_inicio.destroy', $doc) }}"
                                      onsubmit="return confirm('¿Eliminar este documento?')">
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
                        <td colspan="5" class="px-5 py-16 text-center text-gray-400">
                            <i class="fas fa-file-pdf text-4xl mb-3 block"></i>
                            No hay documentos de inicio registrados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
