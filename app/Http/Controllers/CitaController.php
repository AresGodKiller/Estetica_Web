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