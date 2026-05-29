<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminServicioController;
use App\Http\Controllers\Admin\AdminEmpleadaController;
use App\Http\Controllers\Admin\AdminCitaController;

Route::get('/', fn() => redirect()->route('login'));

// ── Rutas del cliente ─────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::resource('citas', CitaController::class)->except(['show']);
});

// ── Rutas del administrador ───────────────────────────────
Route::middleware(['auth', 'es.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('servicios', AdminServicioController::class);
    Route::resource('empleadas', AdminEmpleadaController::class);
    Route::resource('citas', AdminCitaController::class)->except(['create', 'store']);
    Route::patch('citas/{cita}/estado', [AdminCitaController::class, 'cambiarEstado'])->name('citas.estado');
});

require __DIR__.'/auth.php';