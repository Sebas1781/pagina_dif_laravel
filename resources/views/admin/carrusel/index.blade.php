@extends('admin.layouts.app')

@section('title', 'Carrusel')
@section('page-title', 'Carrusel de Inicio')

@section('content')

    {{-- Cabecera --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-gray-500 mt-0.5">Gestiona las diapositivas del carrusel de la página de inicio.</p>
        </div>
        <a href="{{ route('admin.carrusel.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-dif-pink text-white text-sm font-semibold rounded-xl shadow hover:bg-dif-pink-dark transition-colors duration-200">
            <i class="fas fa-plus text-xs"></i>
            Nueva diapositiva
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
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600 w-14">Orden</th>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600 w-28">Imagen</th>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600">Título</th>
                    <th class="px-5 py-3.5 text-left font-semibold text-gray-600">Enlace / Archivo</th>
                    <th class="px-5 py-3.5 text-center font-semibold text-gray-600 w-24">Estado</th>
                    <th class="px-5 py-3.5 text-center font-semibold text-gray-600 w-36">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($slides as $slide)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-4 text-gray-500 text-center font-medium">{{ $slide->orden }}</td>
                        <td class="px-5 py-4">
                            @if($slide->imagen)
                                <img src="{{ asset('storage/' . $slide->imagen) }}" alt="{{ $slide->titulo }}"
                                     class="w-20 h-12 object-cover rounded-lg border border-gray-100">
                            @else
                                <div class="w-20 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-5 py-4 font-medium text-dif-dark max-w-xs">
                            {{ $slide->titulo }}
                        </td>
                        <td class="px-5 py-4 text-gray-500 max-w-sm">
                            @if($slide->url)
                                <span class="inline-flex items-center gap-1.5 text-xs text-blue-600">
                                    <i class="fas fa-link"></i>
                                    <span class="truncate max-w-[180px]" title="{{ $slide->url }}">{{ $slide->url }}</span>
                                </span>
                            @elseif($slide->archivo)
                                <span class="inline-flex items-center gap-1.5 text-xs text-dif-pink">
                                    <i class="fas fa-file-pdf"></i>
                                    {{ basename($slide->archivo) }}
                                </span>
                            @else
                                <span class="text-xs text-gray-300 italic">Sin enlace</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($slide->activo)
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
                                <a href="{{ route('admin.carrusel.edit', $slide) }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-dif-pink border border-dif-pink rounded-lg hover:bg-dif-pink hover:text-white transition-colors duration-200">
                                    <i class="fas fa-pen text-[10px]"></i> Editar
                                </a>
                                <form method="POST" action="{{ route('admin.carrusel.destroy', $slide) }}"
                                      onsubmit="return confirm('¿Eliminar esta diapositiva?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-500 border border-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-trash text-[10px]"></i> Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center text-gray-400">
                            <i class="fas fa-images text-4xl mb-3 block"></i>
                            No hay diapositivas registradas aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    @if($slides->hasPages())
        <div class="mt-5">{{ $slides->links() }}</div>
    @endif

@endsection
