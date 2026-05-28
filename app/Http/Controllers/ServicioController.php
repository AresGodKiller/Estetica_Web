<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::where('activo', true)->orderBy('nombre')->get();
        return view('servicios.index', compact('servicios'));
    }
}