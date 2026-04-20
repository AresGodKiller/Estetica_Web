<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'servicio_id',
        'empleada_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'notas',
        'precio_final',
    ];

    protected function casts(): array
    {
        return [
            'fecha'        => 'date',
            'precio_final' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }

    public function empleada(): BelongsTo
    {
        return $this->belongsTo(Empleada::class);
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeConfirmadas($query)
    {
        return $query->where('estado', 'confirmada');
    }

    public function scopeHoy($query)
    {
        return $query->whereDate('fecha', today());
    }

    public function badgeColor(): string
    {
        return match($this->estado) {
            'confirmada' => 'green',
            'pendiente'  => 'amber',
            'cancelada'  => 'red',
            'completada' => 'blue',
            default      => 'gray',
        };
    }
}