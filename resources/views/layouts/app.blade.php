<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Juegos de Mesa</title>
    {{-- Incluir CSS compilado por Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Barra de navegación --}}
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('juegos.index') }}" class="text-2xl font-bold text-indigo-600">JuegosMesa</a>
            <div class="space-x-4">
                <a href="{{ route('juegos.index') }}" class="text-gray-700 hover:text-indigo-600">Juegos</a>
                <a href="{{ route('fabricantes.index') }}" class="text-gray-700 hover:text-indigo-600">Fabricantes</a>
            </div>
        </div>
    </nav>

    {{-- Contenido principal --}}
    <main class="container mx-auto px-4 py-6 flex-grow">
        {{-- Mensajes flash de éxito/error --}}
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Pie de página --}}
    <footer class="bg-white text-center py-4 shadow-inner">
        <p class="text-gray-600 text-sm">© {{ date('Y') }} Gestión Juegos de Mesa. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
