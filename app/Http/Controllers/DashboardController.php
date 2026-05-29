<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class DashboardController extends Controller
{
    public function index()
    {
        $servicios = Servicio::where('activo', true)->take(6)->get();
        return view('dashboard', compact('servicios'));
    }
}