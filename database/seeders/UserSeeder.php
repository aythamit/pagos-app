<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN
        User::create([
            'nombre' => 'Juan José',
            'apellidos' => 'Díaz',
            'dni' => '828701918',
            'telefono' => '828701918',
            'tipo' => 'admin',
            'email' => 'admin@gmail.com',
            'descripcion' => 'Me encanta el chocolate. ¡Qué bien sienta desayunar chocolate caliente!',
            'rol' => 'admin',
            'email_verified_at' => now(),
            'email_verify_token' => Hash::make('admin@gmail.com'),
            'password' => '$2y$10$t1BD1uLo7T9lz5MgwllVd.maotIJLYN/byf8gzxc91PRXgCVi7OW2', // password
            'remember_token' => Str::random(10),
            'imagen' => null,
            'tienda_id' => null,
        ]);

        // TIENDA
        User::create([
            'nombre' => 'Aythami',
            'apellidos' => 'Pérez',
            'dni' => '41102254',
            'telefono' => '656555887',
            'tipo' => 'tienda',
            'email' => 'tienda@gmail.com',
            'descripcion' => '¡Los videojuegos es mi pasión!',
            'rol' => 'admin',
            'email_verified_at' => now(),
            'email_verify_token' => Hash::make('tienda@gmail.com'),
            'password' => '$2y$10$t1BD1uLo7T9lz5MgwllVd.maotIJLYN/byf8gzxc91PRXgCVi7OW2', // password
            'remember_token' => Str::random(10),
            'imagen' => null,
            'tienda_id' => 1,
        ]);
    }
}
