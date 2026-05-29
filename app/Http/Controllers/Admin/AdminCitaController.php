<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class AdminCitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Cita::with(['user', 'servicio', 'empleada'])->orderBy('fecha', 'desc')->orderBy('hora_inicio');

        if ($request->estado && $request->estado !== 'todas') {
            $query->where('estado', $request->estado);
        }

        $citas = $query->paginate(15);
        return view('admin.citas.index', compact('citas'));
    }

    public function cambiarEstado(Request $request, Cita $cita)
    {
        $request->validate([
            'estado' => 'required|in:confirmada,completada,cancelada',
        ]);

        $cita->update(['estado' => $request->estado]);
        return redirect()->back()->with('success', 'Estado de cita actualizado.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada.');
    }
}