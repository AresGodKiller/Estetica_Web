<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
 
/**
 * Modelo User — Axel Johab Rodríguez Ortiz (23151212)
 *
 * Representa tanto a clientes como a administradores del sistema.
 * El rol se distingue mediante el campo 'rol' (cliente | administrador).
 *
 * Relaciones:
 *  - hasMany(Cita) → Un usuario puede tener muchas citas agendadas
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
 
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'password',
        'rol',
        'activo',
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'activo'            => 'boolean',
        ];
    }
 
    // ─── Relaciones ───────────────────────────────────────────────
 
    /**
     * Un usuario (cliente) puede tener muchas citas.
     * Relación: uno a muchos
     */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
 
    // ─── Helpers ──────────────────────────────────────────────────
 
    public function esAdministrador(): bool
    {
        return $this->rol === 'administrador';
    }
 
    public function nombreCompleto(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
