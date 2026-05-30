<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Empleada;
use Illuminate\Http\Request;

class AdminCitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Cita::with(['user', 'servicio', 'empleada'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio');

        if ($request->estado && $request->estado !== 'todas') {
            $query->where('estado', $request->estado);
        }

        $citas = $query->paginate(15);
        return view('admin.citas.index', compact('citas'));
    }

    public function create()
    {
        $clientes  = User::where('rol', 'cliente')->orderBy('nombre')->get();
        $servicios = Servicio::where('activo', true)->orderBy('nombre')->get();
        $empleadas = Empleada::where('activo', true)->orderBy('nombre')->get();
        return view('admin.citas.create', compact('clientes', 'servicios', 'empleadas'));
    }

    public function store(Request $request)
{
    $tipoCliente = $request->tipo_cliente ?? 'existente';

    if ($tipoCliente === 'nuevo') {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'apellido'    => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'telefono'    => 'nullable|string|max:20',
            'servicio_id' => 'required|exists:servicios,id',
            'empleada_id' => 'required|exists:empleadas,id',
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
        ]);

        // Crear el nuevo cliente
        $user = \App\Models\User::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'rol'      => 'cliente',
        ]);

    } else {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'servicio_id' => 'required|exists:servicios,id',
            'empleada_id' => 'required|exists:empleadas,id',
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
        ]);

        $user = \App\Models\User::find($request->user_id);
    }

    $servicio = \App\Models\Servicio::find($request->servicio_id);
    $horaFin  = date('H:i', strtotime($request->hora_inicio) + $servicio->duracion_minutos * 60);

    Cita::create([
        'user_id'      => $user->id,
        'servicio_id'  => $request->servicio_id,
        'empleada_id'  => $request->empleada_id,
        'fecha'        => $request->fecha,
        'hora_inicio'  => $request->hora_inicio,
        'hora_fin'     => $horaFin,
        'estado'       => 'confirmada',
        'notas'        => $request->notas,
        'precio_final' => $servicio->precio,
    ]);

    return redirect()->route('admin.citas.index')->with('success', 'Cita creada correctamente.');
}

    public function cambiarEstado(Request $request, Cita $cita)
    {
        $request->validate([
            'estado' => 'required|in:confirmada,completada,cancelada',
        ]);

        $cita->update(['estado' => $request->estado]);
        return redirect()->back()->with('success', 'Estado actualizado.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada.');
    }
}