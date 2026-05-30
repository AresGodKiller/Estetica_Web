<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Empleada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['servicio', 'empleada'])
            ->where('user_id', Auth::id())
            ->orderBy('fecha', 'desc')
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $servicios = Servicio::where('activo', true)->get();
        $empleadas = Empleada::where('activo', true)->get();
        return view('citas.create', compact('servicios', 'empleadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'empleada_id' => 'required|exists:empleadas,id',
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
        ]);

        $servicio = Servicio::find($request->servicio_id);
        $horaFin  = date('H:i', strtotime($request->hora_inicio) + $servicio->duracion_minutos * 60);

        Cita::create([
            'user_id'      => Auth::id(),
            'servicio_id'  => $request->servicio_id,
            'empleada_id'  => $request->empleada_id,
            'fecha'        => $request->fecha,
            'hora_inicio'  => $request->hora_inicio,
            'hora_fin'     => $horaFin,
            'estado'       => 'pendiente',
            'precio_final' => $servicio->precio,
        ]);

        return redirect()->route('citas.index')->with('success', '¡Cita agendada correctamente!');
    }

    public function edit(Cita $cita)
    {
        abort_if($cita->user_id !== Auth::id(), 403);

        $servicios = Servicio::where('activo', true)->get();
        $empleadas = Empleada::where('activo', true)->get();
        return view('citas.edit', compact('cita', 'servicios', 'empleadas'));
    }

    public function update(Request $request, Cita $cita)
    {
        abort_if($cita->user_id !== Auth::id(), 403);

        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'empleada_id' => 'required|exists:empleadas,id',
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
        ]);

        $servicio = Servicio::find($request->servicio_id);
        $horaFin  = date('H:i', strtotime($request->hora_inicio) + $servicio->duracion_minutos * 60);

        $cita->update([
            'servicio_id'  => $request->servicio_id,
            'empleada_id'  => $request->empleada_id,
            'fecha'        => $request->fecha,
            'hora_inicio'  => $request->hora_inicio,
            'hora_fin'     => $horaFin,
            'precio_final' => $servicio->precio,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita modificada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        abort_if($cita->user_id !== Auth::id(), 403);
        $cita->update(['estado' => 'cancelada']);
        return redirect()->route('citas.index')->with('success', 'Cita cancelada.');
    }
}