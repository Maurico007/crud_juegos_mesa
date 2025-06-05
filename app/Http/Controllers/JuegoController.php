<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JuegoController extends Controller
{
    public function index()
    {
        // Consulta con fabricante para mostrar nombre de fabricante en la vista
        $juegos = Juego::with('fabricante')->orderBy('nombre')->paginate(10);
        return view('juegos.index', compact('juegos'));
    }

    public function create()
    {
        // Necesitamos lista de fabricantes para el <select>
        $fabricantes = Fabricante::orderBy('nombre')->get();
        return view('juegos.create', compact('fabricantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'             => 'required|string|max:255',
            'edad_recomendada'   => 'required|integer|min:0|max:120',
            'fabricante_id'      => 'required|exists:fabricantes,id',
            'imagen'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            // Guardar la imagen en storage/app/public/juegos
            $rutaImagen = $request->file('imagen')->store('juegos', 'public');
        }

        Juego::create([
            'nombre'             => $request->nombre,
            'edad_recomendada'   => $request->edad_recomendada,
            'fabricante_id'      => $request->fabricante_id,
            'imagen'             => $rutaImagen,
        ]);

        return redirect()->route('juegos.index')
                         ->with('success', 'Juego creado correctamente.');
    }

    public function show(Juego $juego)
    {
        return view('juegos.show', compact('juego'));
    }

    public function edit(Juego $juego)
    {
        $fabricantes = Fabricante::orderBy('nombre')->get();
        return view('juegos.edit', compact('juego', 'fabricantes'));
    }

    public function update(Request $request, Juego $juego)
    {
        $request->validate([
            'nombre'             => 'required|string|max:255',
            'edad_recomendada'   => 'required|integer|min:0|max:120',
            'fabricante_id'      => 'required|exists:fabricantes,id',
            'imagen'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si suben nueva imagen, eliminar la anterior (si existe) y guardar la nueva
        if ($request->hasFile('imagen')) {
            // Eliminar imagen vieja si existe
            if ($juego->imagen && Storage::disk('public')->exists($juego->imagen)) {
                Storage::disk('public')->delete($juego->imagen);
            }
            $juego->imagen = $request->file('imagen')->store('juegos', 'public');
        }

        $juego->nombre = $request->nombre;
        $juego->edad_recomendada = $request->edad_recomendada;
        $juego->fabricante_id = $request->fabricante_id;
        $juego->save();

        return redirect()->route('juegos.index')
                         ->with('success', 'Juego actualizado correctamente.');
    }

    public function destroy(Juego $juego)
    {
        // Eliminar imagen del storage si existe
        if ($juego->imagen && Storage::disk('public')->exists($juego->imagen)) {
            Storage::disk('public')->delete($juego->imagen);
        }

        $juego->delete();
        return redirect()->route('juegos.index')
                         ->with('success', 'Juego eliminado correctamente.');
    }
}
