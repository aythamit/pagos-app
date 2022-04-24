<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;
use App\Models\PermisoUser;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permiso::query()->delete();

        // ADMIN
        $permisos = ['Empleados', 'Tiendas', 'Metodos de pago', 'Configuracion'];
        foreach ($permisos as $index=>$permiso){
            Permiso::create([
                'modulo' => strtolower($permiso),
                'display' => strtolower($permiso),
                'nombre' => $permiso,
                'borrar' => $permiso === 'Metodos de pago' ? 0 : 1,
                'rol' => 'admin',
            ]);
        }

        foreach (Permiso::all() as $permiso){
            PermisoUser::create([
                'users_id' => 1,
                'permisos_id' => $permiso->id,
            ]);
        }

        // TIENDA
        $permisos = ['Carta', 'Pedidos', 'Monitor', 'Notificaciones', 'Empleados'];
        foreach ($permisos as $index=>$permiso){
            Permiso::create([
                'modulo' => strtolower($permiso),
                'display' => strtolower($permiso),
                'nombre' => $permiso,
                'rol' => 'tienda',
            ]);
        }

        foreach (Permiso::query()->where('rol', 'tienda')->get() as $permiso){
            PermisoUser::create([
                'users_id' => 2,
                'permisos_id' => $permiso->id,
            ]);
        }


    }
}
