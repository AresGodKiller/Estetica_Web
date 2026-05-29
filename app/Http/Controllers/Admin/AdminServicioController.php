<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class AdminServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::orderBy('nombre')->get();
        return view('admin.servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('admin.servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'descripcion'      => 'nullable|string',
            'precio'           => 'required|numeric|min:0',
            'duracion_minutos' => 'required|integer|min:1',
        ]);

        Servicio::create([
            'nombre'           => $request->nombre,
            'descripcion'      => $request->descripcion,
            'precio'           => $request->precio,
            'duracion_minutos' => $request->duracion_minutos,
            'activo'           => $request->has('activo'),
        ]);

        return redirect()->route('admin.servicios.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Servicio $servicio)
    {
        return view('admin.servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'descripcion'      => 'nullable|string',
            'precio'           => 'required|numeric|min:0',
            'duracion_minutos' => 'required|integer|min:1',
        ]);

        $servicio->update([
            'nombre'           => $request->nombre,
            'descripcion'      => $request->descripcion,
            'precio'           => $request->precio,
            'duracion_minutos' => $request->duracion_minutos,
            'activo'           => $request->has('activo'),
        ]);

        return redirect()->route('admin.servicios.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('admin.servicios.index')->with('success', 'Servicio eliminado.');
    }
}