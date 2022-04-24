<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'tipo' => 'admin',
            'password' => '$2y$10$t1BD1uLo7T9lz5MgwllVd.maotIJLYN/byf8gzxc91PRXgCVi7OW2', // password
            'remember_token' => Str::random(10),
            'imagen' => null,
        ];
    }
}
