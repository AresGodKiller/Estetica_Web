<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Empleada;
use App\Models\Cita;
use App\Models\HorarioDisponible;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios
        $admin = User::create([
            'nombre'   => 'Admin',
            'apellido' => 'Jazmín',
            'email'    => 'admin@jazmin.com',
            'password' => Hash::make('password'),
            'rol'      => 'administrador',
            'telefono' => '4491234567',
        ]);

        $cliente1 = User::create([
            'nombre'   => 'María',
            'apellido' => 'Cruz',
            'email'    => 'maria@gmail.com',
            'password' => Hash::make('password'),
            'rol'      => 'cliente',
            'telefono' => '4497654321',
        ]);

        $cliente2 = User::create([
            'nombre'   => 'Sofía',
            'apellido' => 'Ramos',
            'email'    => 'sofia@gmail.com',
            'password' => Hash::make('password'),
            'rol'      => 'cliente',
            'telefono' => '4491112233',
        ]);

        // Servicios
        $corte = Servicio::create([
            'nombre'           => 'Corte de cabello',
            'descripcion'      => 'Corte personalizado según el estilo del cliente.',
            'precio'           => 180.00,
            'duracion_minutos' => 45,
            'icono'            => 'scissors',
        ]);

        $tinte = Servicio::create([
            'nombre'           => 'Tinte',
            'descripcion'      => 'Coloración completa con productos de calidad.',
            'precio'           => 650.00,
            'duracion_minutos' => 120,
            'icono'            => 'palette',
        ]);

        $manicure = Servicio::create([
            'nombre'           => 'Manicure',
            'descripcion'      => 'Arreglo y esmaltado de uñas.',
            'precio'           => 120.00,
            'duracion_minutos' => 40,
            'icono'            => 'hand',
        ]);

        $pedicure = Servicio::create([
            'nombre'           => 'Pedicure',
            'descripcion'      => 'Cuidado y esmaltado de uñas de los pies.',
            'precio'           => 150.00,
            'duracion_minutos' => 50,
            'icono'            => 'foot',
        ]);

        // Empleadas
        $laura = Empleada::create([
            'nombre'   => 'Laura',
            'apellido' => 'González',
            'telefono' => '4493334455',
        ]);

        $daniela = Empleada::create([
            'nombre'   => 'Daniela',
            'apellido' => 'Martínez',
            'telefono' => '4496667788',
        ]);

        // Relación empleada-servicio
        $laura->servicios()->attach([$corte->id, $tinte->id]);
        $daniela->servicios()->attach([$corte->id, $manicure->id, $pedicure->id]);

        // Horarios
        foreach ([1, 2, 3, 4, 5] as $dia) {
            HorarioDisponible::create([
                'empleada_id' => $laura->id,
                'dia_semana'  => $dia,
                'hora_inicio' => '09:00',
                'hora_fin'    => '18:00',
            ]);
        }

        foreach ([1, 2, 3, 4, 5, 6] as $dia) {
            HorarioDisponible::create([
                'empleada_id' => $daniela->id,
                'dia_semana'  => $dia,
                'hora_inicio' => '10:00',
                'hora_fin'    => '19:00',
            ]);
        }

        // Citas
        Cita::create([
            'user_id'      => $cliente1->id,
            'servicio_id'  => $corte->id,
            'empleada_id'  => $laura->id,
            'fecha'        => now()->addDays(1)->toDateString(),
            'hora_inicio'  => '10:00',
            'hora_fin'     => '10:45',
            'estado'       => 'confirmada',
            'precio_final' => 180.00,
        ]);

        Cita::create([
            'user_id'      => $cliente2->id,
            'servicio_id'  => $tinte->id,
            'empleada_id'  => $daniela->id,
            'fecha'        => now()->addDays(2)->toDateString(),
            'hora_inicio'  => '11:30',
            'hora_fin'     => '13:30',
            'estado'       => 'pendiente',
            'precio_final' => 650.00,
        ]);
    }
}