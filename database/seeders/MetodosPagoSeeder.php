<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Seeder;

class MetodosPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $metodos = ['Efectivo', 'Paypal', 'Tarjeta'];
        $tipo = ['efectivo', 'paypal', 'tarjeta'];

        foreach ($metodos as $index=>$metodo){
            if(MetodoPago::query()->where('nombre', $metodo)->count() === 0){
                MetodoPago::create([
                    'nombre' => $metodo,
                    'tipo' => $tipo[$index],
                    'estado' => 0,
                    'configuracion' => null,
                ]);
            }
        }
    }
}
