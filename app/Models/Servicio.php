<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion_minutos',
        'activo',
    ];

    // Un servicio puede estar en muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    // Un servicio puede ser realizado por muchas empleadas (muchos a muchos)
    public function empleadas()
    {
        return $this->belongsToMany(Empleada::class, 'empleada_servicio');
    }
}