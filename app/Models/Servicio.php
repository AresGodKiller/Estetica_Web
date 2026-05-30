<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion_minutos',
        'icono',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'precio'           => 'decimal:2',
            'duracion_minutos' => 'integer',
            'activo'           => 'boolean',
        ];
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function empleadas(): BelongsToMany
    {
        return $this->belongsToMany(Empleada::class, 'empleada_servicio');
    }

    public function duracionFormateada(): string
    {
        $horas   = intdiv($this->duracion_minutos, 60);
        $minutos = $this->duracion_minutos % 60;

        if ($horas > 0 && $minutos > 0) {
            return "{$horas}h {$minutos}min";
        }
        return $horas > 0 ? "{$horas}h" : "{$minutos}min";
    }
}