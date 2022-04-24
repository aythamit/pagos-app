<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
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
        ];
    }
}
