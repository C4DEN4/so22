<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Ingreso;
use App\Models\Persona;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::where('estado', 'ingreso')->with(['persona', 'area'])->get();
        $areas = Area::all();

        return view('vistas.ingresos', compact('ingresos', 'areas'));
    }

public function store(Request $request)
{
    $request->validate([
        'personas_cedula' => 'required|exists:personas,cedula',
        'area_id'         => 'required|exists:areas,id',
        'estado'          => 'nullable|in:ingreso,terminado',
        'observaciones'   => 'nullable|string|max:500',
    ], [
        'personas_cedula.exists' => 'La cédula ingresada no existe en el sistema. Regístrela primero en la sección Personas.',
    ]);

   
    $persona = Persona::where('cedula', $request->personas_cedula)->first();

    if ($persona && $persona->active === 'false') {
        return back()
            ->withErrors([
                'personas_cedula' => 'La persona está inactiva y no puede registrar ingresos.',
            ])
            ->withInput();
    }

    Ingreso::create([
        'personas_cedula' => $request->personas_cedula,
        'area_id'         => $request->area_id,
        'observaciones'   => $request->observaciones,
        'estado'          => 'ingreso',
    ]);

    return redirect()->route('ingresos')->with('success', 'Ingreso registrado exitosamente.');
}


    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'observaciones' => 'nullable|string',
        ]);

        $ingreso->update([
            'area_id' => $request->area_id,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('ingresos')->with('success', 'Área de ingreso actualizada exitosamente.');
    }

    public function checkout(Ingreso $ingreso)
    {
        if ($ingreso->estado === 'terminado') {
            return redirect()->route('ingresos')->with('error', 'Este ingreso ya había sido marcado como terminado.');
        }

        $ingreso->update([
            'estado' => 'terminado',
        ]);

        return redirect()->route('ingresos')->with('success', 'Salida registrada exitosamente para '.$ingreso->persona->nombre.'.');
    }
}
