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

    Route::get('/citas',               [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/crear',         [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas',              [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/{cita}/editar', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{cita}',        [CitaController::class, 'update'])->name('citas.update');
    Route::delete('/citas/{cita}',     [CitaController::class, 'destroy'])->name('citas.destroy');

});

// ── Rutas del administrador ───────────────────────────────
Route::middleware(['auth', 'es.admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Servicios
    Route::get('/servicios',                   [AdminServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios/crear',             [AdminServicioController::class, 'create'])->name('servicios.create');
    Route::post('/servicios',                  [AdminServicioController::class, 'store'])->name('servicios.store');
    Route::get('/servicios/{servicio}/editar', [AdminServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('/servicios/{servicio}',        [AdminServicioController::class, 'update'])->name('servicios.update');
    Route::delete('/servicios/{servicio}',     [AdminServicioController::class, 'destroy'])->name('servicios.destroy');

    // Empleadas
    Route::get('/empleadas',                   [AdminEmpleadaController::class, 'index'])->name('empleadas.index');
    Route::get('/empleadas/crear',             [AdminEmpleadaController::class, 'create'])->name('empleadas.create');
    Route::post('/empleadas',                  [AdminEmpleadaController::class, 'store'])->name('empleadas.store');
    Route::get('/empleadas/{empleada}/editar', [AdminEmpleadaController::class, 'edit'])->name('empleadas.edit');
    Route::put('/empleadas/{empleada}',        [AdminEmpleadaController::class, 'update'])->name('empleadas.update');
    Route::delete('/empleadas/{empleada}',     [AdminEmpleadaController::class, 'destroy'])->name('empleadas.destroy');

    // Citas
    Route::get('/citas',                 [AdminCitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/crear',           [AdminCitaController::class, 'create'])->name('citas.create');
    Route::post('/citas',                [AdminCitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/{cita}/editar',   [AdminCitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{cita}',          [AdminCitaController::class, 'update'])->name('citas.update');
    Route::delete('/citas/{cita}',       [AdminCitaController::class, 'destroy'])->name('citas.destroy');
    Route::patch('/citas/{cita}/estado', [AdminCitaController::class, 'cambiarEstado'])->name('citas.estado');

});

require __DIR__.'/auth.php';