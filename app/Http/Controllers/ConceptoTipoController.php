<?php

namespace App\Http\Controllers;

use App\Models\ConceptoTipo;
use Illuminate\Http\Request;

class ConceptoTipoController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

//    $numeroTiendas = Tienda::query()->count();

        $tipos = ConceptoTipo::query()->where('activo',1)->get();
        return view('/content/dashboard/admin/dashboard', [
            'pageConfigs' => $pageConfigs,
            'method' => 'Nuevo',
            'nameCrud' => 'conceptos',
            'tiposConcepto' => $tipos,
            'numeroTiendas' => 0
        ]);
    }
}
