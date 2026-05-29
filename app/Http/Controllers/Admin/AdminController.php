<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Empleada;

class AdminController extends Controller
{
    public function index()
    {
        $citasHoy   = Cita::hoy()->count();
        $pendientes = Cita::pendientes()->count();
        $ingresos   = number_format(Cita::hoy()->whereIn('estado', ['confirmada','completada'])->sum('precio_final'), 0);
        $estilistas = Empleada::where('activo', true)->count();
        $citas      = Cita::with(['user', 'servicio', 'empleada'])->hoy()->orderBy('hora_inicio')->get();

        return view('admin.dashboard', compact('citasHoy', 'pendientes', 'ingresos', 'estilistas', 'citas'));
    }
}