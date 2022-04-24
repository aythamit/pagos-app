<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ConceptoRequest;
use App\Http\Requests\TiendaRequest;
use App\Models\Concepto;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConceptoController extends Controller
{


    public function store(ConceptoRequest $request, $id = null) {
        try {
            DB::beginTransaction();

            $isNew = $id === null;

            if ($isNew) {
                $concepto = new Concepto();
                $mensaje = 'creado';
            } else {
                $concepto = Concepto::find($id);
                if ($concepto === null) {
                    return response('No se pudo encontrar la tienda', 400);
                }
                $mensaje = 'editado';
            }

            $fields = $request->only($concepto->getFillable());
            $concepto->fill($fields);


            $isNew ? $concepto->save() : $concepto->update();

            DB::commit();
            return response(['mensaje' => 'La tienda se ha ' . $mensaje . ' correctamente', 'tienda' => $concepto], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Se ha producido un error al guardar la tienda", 500);
        }
    }
}
