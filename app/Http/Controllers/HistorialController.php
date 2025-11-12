<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        $historial = Ingreso::with(['persona', 'area'])
            ->orderBy('created_at', 'desc')
            ->get(); 

        return view('vistas.historial', compact('historial'));
    }
}
