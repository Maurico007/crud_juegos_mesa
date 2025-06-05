@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-3xl font-semibold text-gray-800">Fabricantes</h1>
    <a href="{{ route('fabricantes.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
       Nuevo Fabricante
    </a>
</div>

<table class="min-w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-50">
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nombre</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">País</th>
            <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($fabricantes as $fabricante)
            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                <td class="px-4 py-2 text-sm text-gray-700">{{ $fabricante->id }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $fabricante->nombre }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $fabricante->pais }}</td>
                <td class="px-4 py-2 text-center space-x-2">
                    <a href="{{ route('fabricantes.edit', $fabricante) }}"
                       class="text-indigo-600 hover:text-indigo-800">Editar</a>
                    <form action="{{ route('fabricantes.destroy', $fabricante) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('¿Eliminar este fabricante?')"
                                class="text-red-600 hover:text-red-800">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-2 text-center text-gray-500">No hay fabricantes registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $fabricantes->links() }} {{-- Paginación --}}
</div>
@endsection
