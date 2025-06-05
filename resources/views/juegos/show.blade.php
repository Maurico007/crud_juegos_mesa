@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-semibold text-gray-800 mb-6">Juego: {{ $juego->nombre }}</h1>

<div class="bg-white p-6 rounded shadow-md max-w-lg">
    <p class="mb-2"><span class="font-semibold">Edad Recomendada:</span> {{ $juego->edad_recomendada }} años</p>
    <p class="mb-2"><span class="font-semibold">Fabricante:</span> {{ $juego->fabricante->nombre }} ({{ $juego->fabricante->pais }})</p>
    @if($juego->imagen)
        <div class="mb-4">
            <span class="font-semibold">Imagen:</span><br>
            <img src="{{ asset('storage/'.$juego->imagen) }}"
                 alt="Imagen {{ $juego->nombre }}"
                 class="h-40 w-40 object-cover rounded border mt-2">
        </div>
    @else
        <p class="text-gray-500"><em>Este juego no tiene imagen asignada.</em></p>
    @endif
    <a href="{{ route('juegos.index') }}"
       class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">Volver</a>
</div>
@endsection
