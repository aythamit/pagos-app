<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\ConceptoTipo;
use App\Models\User;
use Illuminate\Http\Request;

class ConceptoTipoController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

//    $numeroTiendas = Tienda::query()->count();

        $viewStatsTipo = $this->getStatsTipo(1);
        $viewConceptosPagadosTipo = $this->getViewConceptosFinalizadosStatsTipo(1);
        $viewConceptosPendientesTipo = $this->getViewConceptosPendientesStatsTipo(1);
        $tipos = ConceptoTipo::query()->where('activo',1)->get();
        return view('/content/conceptos_tipos/index', [
            'pageConfigs' => $pageConfigs,
            'method' => 'Nuevo',
            'nameCrud' => 'conceptos',
            'tiposConcepto' => $tipos,
            'numeroTiendas' => 0,
            'viewStatsTipo' => $viewStatsTipo,
            'viewConceptosPagadosTipo' => $viewConceptosPagadosTipo,
            'viewConceptosPendientesTipo' => $viewConceptosPendientesTipo,
        ]);
    }

    public function getUserConceptosQuery($id, $pendientes = false){

        $users = User::query()
            ->whereHas('conceptos', function($query) use($id){
                 $query->where('conceptos_tipos_id', $id);
            })
            ->with(['conceptos' => function($query) use($id, $pendientes){
                $query->where('conceptos_tipos_id', $id)
                ->where('is_pagado', ($pendientes) ? 0 : 1);
            }]);


        return $users;
    }

    public function getViewConceptosPendientesStatsTipo($id){

        $users = $this->getUserConceptosQuery($id,true)
            ->get();

        return view('/content/conceptos_tipos/pagos-pendientes', [
            'users' => $users,
        ]);

    }

    public function getViewConceptosFinalizadosStatsTipo($id){

        $users = $this->getUserConceptosQuery($id)
            ->get();

        return view('/content/conceptos_tipos/pagos-pagados', [
            'users' => $users,
        ]);

    }


    public function getStatsTipo($id){

        $users = $this->getUserConceptosQuery($id,true)
            ->get();


        $totalConceptosPendientes = Concepto::query()
            ->where('conceptos_tipos_id', $id)
            ->where('is_pagado', 0)
            ->sum('euro');


        foreach ($users as $user){
            $total_acumulado = 0;
            foreach ($user->conceptos as $concepto){
                $total_acumulado+= $concepto->euro;
            }

            $user->totalConceptoAcumulado = $total_acumulado;
            $user->resultadoDeber = round(($totalConceptosPendientes / sizeof($users)) - $total_acumulado, 2);
        }

        return view('/content/conceptos_tipos/pagos-stats', [
            'users' => $users,
        ]);


    }
}
