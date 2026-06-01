<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleada;
use App\Models\Servicio;
use Illuminate\Http\Request;

class AdminEmpleadaController extends Controller
{
    public function index()
    {
        $empleadas = Empleada::with('servicios')->orderBy('nombre')->get();
        return view('admin.empleadas.index', compact('empleadas'));
    }

    public function create()
    {
        $servicios = Servicio::where('activo', true)->get();
        return view('admin.empleadas.create', compact('servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $empleada = Empleada::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        if ($request->has('servicios')) {
            $empleada->servicios()->sync($request->servicios);
        }

        return redirect()->route('admin.empleadas.index')->with('success', 'Empleada registrada correctamente.');
    }

    public function edit(Empleada $empleada)
    {
        $servicios = Servicio::where('activo', true)->get();
        return view('admin.empleadas.edit', compact('empleada', 'servicios'));
    }

    public function update(Request $request, Empleada $empleada)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $empleada->update([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        $empleada->servicios()->sync($request->servicios ?? []);

        return redirect()->route('admin.empleadas.index')->with('success', 'Empleada actualizada correctamente.');
    }

    public function destroy(Empleada $empleada)
    {
        $empleada->delete();
        return redirect()->route('admin.empleadas.index')->with('success', 'Empleada eliminada.');
    }
}