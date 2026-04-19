<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioDisponible extends Model
{
    use HasFactory;

    protected $table = 'horarios_disponibles';

    protected $fillable = [
        'empleada_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'dia_semana' => 'integer',
            'activo'     => 'boolean',
        ];
    }

    public function empleada(): BelongsTo
    {
        return $this->belongsTo(Empleada::class);
    }

    public function nombreDia(): string
    {
        $dias = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
        ];

        return $dias[$this->dia_semana] ?? 'Desconocido';
    }
}