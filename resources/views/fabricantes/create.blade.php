@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-semibold text-gray-800 mb-6">Crear Fabricante</h1>

<form action="{{ route('fabricantes.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
    @csrf

    <div class="mb-4">
        <label for="nombre" class="block text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre"
               value="{{ old('nombre') }}"
               class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('nombre')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="pais" class="block text-gray-700">País</label>
        <input type="text" name="pais" id="pais"
               value="{{ old('pais') }}"
               class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('pais')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
        Guardar
    </button>
    <a href="{{ route('fabricantes.index') }}"
       class="ml-2 text-gray-600 hover:text-gray-800">Cancelar</a>
</form>
@endsection
