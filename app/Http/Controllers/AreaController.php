<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::where('active', true)->get();
        return view('vistas.areas', compact('areas'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|max:255',
    ]);

    $area = Area::where('nombre', $request->nombre)->first();

    if ($area && $area->active === 'false') {
        $area->update([
            'active' => 'true',
        ]);

        return redirect()
            ->route('areas')
            ->with('success', 'Área activada nuevamente.');
    }

    if ($area && $area->active === 'true') {
        return back()
            ->withErrors([
                'nombre' => 'El nombre del área ya existe, Por favor, ingrese un nombre diferente.',
            ])
            ->withInput();
    }

    Area::create([
        'nombre' => $request->nombre,
        'active' => 'true',
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

   public function area_destroy($id)
{
    
    $area = Area::findOrFail($id);

  
    $area->update([
        'active' => 'false',
    ]);

   
    return redirect()->back()->with('success', 'Área Eliminada correctamente.');
}
}