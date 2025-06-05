@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-semibold text-gray-800 mb-6">Editar Juego: {{ $juego->nombre }}</h1>

<form action="{{ route('juegos.update', $juego) }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow-md max-w-lg">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="nombre" class="block text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre"
               value="{{ old('nombre', $juego->nombre) }}"
               class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('nombre')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="edad_recomendada" class="block text-gray-700">Edad Recomendada</label>
        <input type="number" name="edad_recomendada" id="edad_recomendada"
               value="{{ old('edad_recomendada', $juego->edad_recomendada) }}"
               class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('edad_recomendada')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="fabricante_id" class="block text-gray-700">Fabricante</label>
        <select name="fabricante_id" id="fabricante_id"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @foreach($fabricantes as $fab)
                <option value="{{ $fab->id }}"
                    {{ old('fabricante_id', $juego->fabricante_id) == $fab->id ? 'selected' : '' }}>
                    {{ $fab->nombre }} ({{ $fab->pais }})
                </option>
            @endforeach
        </select>
        @error('fabricante_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="imagen" class="block text-gray-700">Imagen del Juego (dejar vacío para no cambiar)</label>
        <input type="file" name="imagen" id="imagen"
               class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               accept="image/*">
        @error('imagen')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        @if($juego->imagen)
            <div class="mt-2">
                <span class="text-gray-600 text-sm">Imagen actual:</span><br>
                <img src="{{ asset('storage/'.$juego->imagen) }}"
                     alt="Imagen actual {{$juego->nombre}}"
                     class="h-20 w-20 object-cover rounded border">
            </div>
        @endif
    </div>

    <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
        Actualizar
    </button>
    <a href="{{ route('juegos.index') }}"
       class="ml-2 text-gray-600 hover:text-gray-800">Cancelar</a>
</form>
@endsection
