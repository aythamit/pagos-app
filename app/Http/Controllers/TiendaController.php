<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\TiendaRequest;
use App\Models\Permiso;
use App\Models\Tienda;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Yajra\DataTables\Facades\DataTables;

class TiendaController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->nameCrud = 'tiendas';
        //$this->crudTranslated = __('backpanel/pizarra.empleados');
    }

    public function index()
    {
        return view('/content/admin/tiendas/pizarra', ['nameCrud' => $this->nameCrud]);
    }

    public function new() {
        $method = 'Nuevo';
        return view('/content/admin/tiendas/formulario', ['nameCrud' => $this->nameCrud, 'method' => $method]);
    }

    public function edit(Request $request, $id) {
        $method = 'Editar';
        $tienda = Tienda::query()->where('id', $id)->first();
        $tienda->imagenes = isset($tienda->imagenes) ? Helper::getStoredImage($tienda->imagenes) : null;
        return view('/content/admin/tiendas/formulario', ['nameCrud' => $this->nameCrud, 'method' => $method, 'tienda' => $tienda]);
    }

    public function show(Request $request, $id)
    {
        $tienda = Tienda::query()->where('id', $id)->first();
        $tienda->imagenes = isset($tienda->imagenes) ? Helper::getStoredImage($tienda->imagenes) : null;

        return view('content.admin.tiendas.formulario', [
            'method' => 'Ver',
            'nameCrud' => $this->nameCrud,
            'tienda' => $tienda,
        ]);

    }

    public function store(TiendaRequest $request, $id = null) {
        try {
            DB::beginTransaction();

            if ($id === null) {
                $tienda = new Tienda();
                $mensaje = 'creado';
            } else {
                $tienda = Tienda::find($id);
                if ($tienda === null) {
                    return response('No se pudo encontrar la tienda', 400);
                }
                $mensaje = 'editado';
            }

            $fields = $request->only($tienda->getFillable());
            $tienda->fill($fields);

            // Borramos la imagen si ya tenía una
            Storage::disk('tiendas')->delete($tienda->imagenes);

            // Guardamos la imagen
            $img = Helper::base64toStore($request->imagen);
            Storage::disk('tiendas')->put($img[0], base64_decode($img[2]));
            $tienda->imagenes = $img[0];
            $tienda->save();

            DB::commit();
            return response(['mensaje' => 'La tienda se ha ' . $mensaje . ' correctamente', 'tienda' => $tienda], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Se ha producido un error al guardar la tienda", 500);
        }
    }


    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $tienda = Tienda::find($id);
            if ($tienda === null) {
                return response(['errores' => __('No se pudo encontrar la tienda')], 400);
            }
            // Borramos la imagen si tenía una
            if(isset($tienda->imagenes)){
                Storage::disk('tiendas')->delete($tienda->imagenes);
            }

            Tienda::destroy($id);
            DB::commit();
            return response('La tienda se ha borrado correctamente', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("No se ha podido borrar la tienda", 500);
        }
    }
    public function destroyAll(Request $request)
    {
        try {
            $tienda = Tienda::whereIn('id', $request->ids)->delete();
            return response('Las tiendas se han borrado correctamente', 200);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function block(Request $request, $id)
    {
        try {
            $tienda = Tienda::find($id);
            $tienda->is_blocked = $request->estado == '0' ? 1 : 0;
            $tienda->save();
            return response('La tienda se ha bloqueado correctamente', 200);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getDataJson(Request $request) {
        // Traemos todos los usuarios admins (tando admin como empleados)
        $tiendas = Tienda::query();

        $permisoLeer = $this->user->hasPermiso('Tiendas','Leer');
        $permisoEditar = $this->user->hasPermiso('Tiendas','Editar');
        $permisoBorrar = $this->user->hasPermiso('Tiendas','Borrar');

        return DataTables::eloquent($tiendas)
            ->addColumn('permiso_leer', function ($model) use($permisoLeer){
                return $permisoLeer;
            })
            ->addColumn('permiso_borrar', function ($model) use($permisoBorrar){
                return $permisoBorrar;
            })
            ->addColumn('permiso_editar', function ($model) use($permisoEditar){
                return $permisoEditar;
            })
            ->editColumn('imagen', function ($model){
                if(isset($model->imagenes)){
                    return Helper::getStoredImage($model->imagenes);
                }
                return null;
            })
            ->editColumn('created_at', function ($model){
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d/m/Y');
            })
            ->toJson();
    }

//    public function block(Request $request, $id){
//        try {
//            DB::beginTransaction();
//            $user = User::find($id);
//            if (!isset($user)) {
//                return response('No se pudo encontrar el usuario', 400);
//            }
//            $user->is_blocked = !$user->is_blocked;
//            $user->update();
//            DB::commit();
//            $mensaje = ($user->is_blocked) ? 'bloqueado' : 'desbloqueado';
//            return response(['mensaje' => 'El usuario se ha ' . $mensaje . ' correctamente',
//                'userBlocked' => $user->is_blocked
//
//            ], 200);
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return response()->json("No se ha podido actualizar los permisos del usuario el usuario", 500);
//        }
//    }


}
