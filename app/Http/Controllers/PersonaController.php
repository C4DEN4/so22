<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::where('active','true')->get();
        return view('vistas.personas', compact('personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|unique:personas,cedula|max:255',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'telefono' => 'nullable|max:255',
            'correo' => 'nullable|email|max:255',
        ], [
            'cedula.unique' => 'La cédula ingresada ya está registrada. Por favor, verifique el número.',
        ]);

        Persona::create([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo ?? null,
            'numero' => $request->telefono ?? null,
        ]);

        return redirect()->route('personas')->with('success', 'Persona registrada exitosamente.');
    }
    
    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'cedula' => 'required|unique:personas,cedula|max:255',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'telefono' => 'nullable|max:255',
            'correo' => 'nullable|email|max:255',
        ]);

        $persona->update([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo ?? $persona->correo,
            'numero' => $request->telefono ?? $persona->numero,
        ]);

        return redirect()->route('personas')->with('success', 'Persona actualizada exitosamente.');
    }

    public function personas_destroy($cedula)
{
            
    $persona = Persona::findOrFail($cedula);
  
    $persona->update([
        'active' => 'false',
    ]);

    return redirect()->back()->with('success', 'Persona Eliminada correctamente.');

}
}