@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-3xl font-semibold text-gray-800">Juegos de Mesa</h1>
    <a href="{{ route('juegos.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
       Nuevo Juego
    </a>
</div>

<table class="min-w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-50">
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nombre</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Edad Recom.</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Fabricante</th>
            <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Imagen</th>
            <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($juegos as $juego)
            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                <td class="px-4 py-2 text-sm text-gray-700">{{ $juego->id }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $juego->nombre }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $juego->edad_recomendada }} años</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $juego->fabricante->nombre }}</td>
                <td class="px-4 py-2 text-center">
                    @if($juego->imagen)
                        <img src="{{ asset('storage/'.$juego->imagen) }}"
                             alt="Imagen {{ $juego->nombre }}"
                             class="h-12 w-12 object-cover rounded">
                    @else
                        <span class="text-gray-400 text-sm">Sin imagen</span>
                    @endif
                </td>
                <td class="px-4 py-2 text-center space-x-2">
                    <a href="{{ route('juegos.edit', $juego) }}"
                       class="text-indigo-600 hover:text-indigo-800">Editar</a>
                    <form action="{{ route('juegos.destroy', $juego) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('¿Eliminar este juego?')"
                                class="text-red-600 hover:text-red-800">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-2 text-center text-gray-500">No hay juegos registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $juegos->links() }} {{-- Paginación --}}
</div>
@endsection
