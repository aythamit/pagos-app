<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

  public function indexAdmin()
  {
    $pageConfigs = ['pageHeader' => false];

    $numeroTiendas = Tienda::query()->count();
    return view('/content/dashboard/admin/dashboard', [
        'pageConfigs' => $pageConfigs,
        'numeroTiendas' => $numeroTiendas
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
