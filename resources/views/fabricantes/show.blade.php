@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-semibold text-gray-800 mb-6">Fabricante: {{ $fabricante->nombre }}</h1>

<div class="bg-white p-6 rounded shadow-md max-w-lg">
    <p class="mb-2"><span class="font-semibold">País:</span> {{ $fabricante->pais }}</p>
    <p class="mb-2"><span class="font-semibold">Creado:</span> {{ $fabricante->created_at->format('d/m/Y') }}</p>
    <p class="mb-2"><span class="font-semibold">Actualizado:</span> {{ $fabricante->updated_at->format('d/m/Y') }}</p>
    <a href="{{ route('fabricantes.index') }}"
       class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">Volver</a>
</div>
@endsection
