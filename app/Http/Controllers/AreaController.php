<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('vistas.areas', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:areas|max:255',
        ], [
            'nombre.unique' => 'El nombre del área ya existe. Por favor, ingrese un nombre diferente.',
        ]);

        Area::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('areas')->with('success', 'Área creada exitosamente.');
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:areas,nombre,' . $area->id,
        ], [
            'nombre.unique' => 'El nombre del área ya existe. Por favor, ingrese un nombre diferente.',
        ]);
        
        $area->update(['nombre' => $request->nombre]);
        return redirect()->route('areas')->with('success', 'Área actualizada exitosamente.');
    }
}