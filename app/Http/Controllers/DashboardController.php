<?php

namespace App\Http\Controllers;

use App\Models\ConceptoTipo;
use App\Models\Tienda;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

  public function indexAdmin()
  {
    $pageConfigs = ['pageHeader' => false];

//    $numeroTiendas = Tienda::query()->count();

      $tipos = ConceptoTipo::query()->where('activo',1)->get();
      $usuarios = User::query()->where('rol','admin')->get();
    return view('/content/dashboard/admin/dashboard', [
        'pageConfigs' => $pageConfigs,
        'method' => 'Nuevo',
        'nameCrud' => 'conceptos',
        'tiposConcepto' => $tipos,
        'usuarios' => $usuarios,
        'numeroTiendas' => 0
    ]);
  }

    public function indexTienda()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('/content/dashboard/tienda/dashboard', [
            'pageConfigs' => $pageConfigs,
        ]);
    }


}
