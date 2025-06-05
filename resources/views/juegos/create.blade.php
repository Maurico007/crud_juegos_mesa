@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-semibold text-gray-800 mb-6">Crear Juego de Mesa</h1>

{{-- Si no hay fabricantes, mostramos mensaje y un botón para crear uno --}}
@if($fabricantes->isEmpty())
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-6">
        <p class="font-semibold">¡Aviso!</p>
        <p>No hay fabricantes registrados. Para poder crear un juego, primero debes crear un fabricante.</p>
        <a href="{{ route('fabricantes.create') }}"
           class="mt-2 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
           Crear Fabricante
        </a>
    </div>
@else
    <form id="formJuego" action="{{ route('juegos.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf

        {{-- Nombre del juego --}}
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre"
                   value="{{ old('nombre') }}"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Edad recomendada --}}
        <div class="mb-4">
            <label for="edad_recomendada" class="block text-gray-700">Edad Recomendada</label>
            <input type="number" name="edad_recomendada" id="edad_recomendada"
                   value="{{ old('edad_recomendada') }}"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   min="0" max="120">
            <p id="mensajeEdad" class="text-red-500 text-sm mt-1 hidden">
                No puedes acceder a este sitio porque eres menor de edad.
            </p>
            @error('edad_recomendada')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fabricante --}}
        <div class="mb-4">
            <label for="fabricante_id" class="block text-gray-700">Fabricante</label>
            <select name="fabricante_id" id="fabricante_id"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="" disabled {{ old('fabricante_id') ? '' : 'selected' }}>-- Seleccionar --</option>
                @foreach($fabricantes as $fab)
                    <option value="{{ $fab->id }}"
                        {{ old('fabricante_id') == $fab->id ? 'selected' : '' }}>
                        {{ $fab->nombre }} ({{ $fab->pais }})
                    </option>
                @endforeach
            </select>
            @error('fabricante_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Imagen del juego --}}
        <div class="mb-4">
            <label for="imagen" class="block text-gray-700">Imagen del Juego (opcional)</label>
            <input type="file" name="imagen" id="imagen"
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   accept="image/*">
            @error('imagen')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
            Guardar
        </button>
        <a href="{{ route('juegos.index') }}"
           class="ml-2 text-gray-600 hover:text-gray-800">Cancelar</a>
    </form>

    {{-- Script para validar edad en front --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputEdad = document.getElementById('edad_recomendada');
            const mensajeEdad = document.getElementById('mensajeEdad');
            const form = document.getElementById('formJuego');

            inputEdad.addEventListener('input', function() {
                const valor = parseInt(inputEdad.value);
                if (!isNaN(valor) && valor < 18) {
                    mensajeEdad.classList.remove('hidden');
                } else {
                    mensajeEdad.classList.add('hidden');
                }
            });

            form.addEventListener('submit', function(e) {
                const valor = parseInt(inputEdad.value);
                if (!isNaN(valor) && valor < 18) {
                    e.preventDefault();
                    alert('No puedes acceder a este sitio porque eres menor de edad.');
                }
            });
        });
    </script>
@endif

@endsection

