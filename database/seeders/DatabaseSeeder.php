<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TiendaSeeder::class,
            UserSeeder::class,
            PermisosSeeder::class,
            MetodosPagoSeeder::class,
        ]);
    }
}
