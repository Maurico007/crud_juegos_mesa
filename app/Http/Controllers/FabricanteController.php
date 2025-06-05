<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    public function index()
    {
        $fabricantes = Fabricante::orderBy('nombre')->paginate(10);
        return view('fabricantes.index', compact('fabricantes'));
    }

    public function create()
    {
        return view('fabricantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:fabricantes,nombre|max:255',
            'pais'   => 'required|string|max:100',
        ]);

        Fabricante::create($request->only('nombre', 'pais'));

        return redirect()->route('fabricantes.index')
                         ->with('success', 'Fabricante creado correctamente.');
    }

    public function show(Fabricante $fabricante)
    {
        return view('fabricantes.show', compact('fabricante'));
    }

    public function edit(Fabricante $fabricante)
    {
        return view('fabricantes.edit', compact('fabricante'));
    }

    public function update(Request $request, Fabricante $fabricante)
    {
        $request->validate([
            'nombre' => 'required|string|unique:fabricantes,nombre,' . $fabricante->id . '|max:255',
            'pais'   => 'required|string|max:100',
        ]);

        $fabricante->update($request->only('nombre', 'pais'));

        return redirect()->route('fabricantes.index')
                         ->with('success', 'Fabricante actualizado correctamente.');
    }

    public function destroy(Fabricante $fabricante)
    {
        $fabricante->delete();
        return redirect()->route('fabricantes.index')
                         ->with('success', 'Fabricante eliminado correctamente.');
    }
}
