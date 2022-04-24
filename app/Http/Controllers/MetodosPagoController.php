<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\TiendaRequest;
use App\Models\MetodoPago;
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

class MetodosPagoController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->nameCrud = 'métodos de pago';
        //$this->crudTranslated = __('backpanel/pizarra.empleados');
    }

    public function index()
    {
        $metodos = MetodoPago::all();
        $permiso_editar = $this->user->hasPermiso('Tiendas','Editar');
        return view('/content/admin/metodospago/pizarra', ['nameCrud' => $this->nameCrud, 'metodos' => $metodos, 'permiso_editar' => $permiso_editar]);
    }

    public function edit(Request $request, $id) {
        $method = 'Editar';
        $tienda = Tienda::query()->where('id', $id)->first();
        $tienda->imagenes = isset($tienda->imagenes) ? Helper::getStoredImage($tienda->imagenes) : null;
        return view('/content/admin/tiendas/formulario', ['nameCrud' => $this->nameCrud, 'method' => $method, 'tienda' => $tienda]);
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

    public function cambiarestado(Request $request){
        if(isset($request->metodoId)){
            $metodo = MetodoPago::query()->find($request->metodoId);
            if(is_null($metodo)){
                return response(['errors' => ['errores' => ['No se ha podido encontrar el método de pago.']]], 400);
            }
            $metodo->estado = $request->estado == true ? 1 : 0;
            if($metodo->save()){
                return response(['titulo' => 'Método actualizado','mensaje' => 'Se ha actualizado el método de pago correctamente'], 200);
            }else{
                return response(['errors' => ['errores' => ['No se pudo actualizar el método de pago']]], 400);
            }
        }
    }

    public function configurar(Request $request, $tipo){
        try{
            DB::beginTransaction();

            switch ($tipo) {
                case 'paypal':
                    $this->configurarPaypal($request);
                    break;
                default:
                    # code...
                    break;
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return response(['errors' => ['errores' => [$e->getMessage()]]], 400);
        }
    }

    public function configurarPaypal($data)
    {
        $paypal_config = [
            'tipo'=>'paypal',
            'paypal_client_id' => $data->paypal_client_id,
            'paypal_action' => $data->paypal_action,
            'paypal_currency' => $data->paypal_currency,
            'paypal_notify_url' => isset($data->paypal_notify_url) ? $data->paypal_notify_url : '',
        ];

        foreach ($paypal_config as $key => $value) {
            if(is_null($value)){
                throw new \Exception('Hay campos obligatorios vacíos. Por favor, rellene todos los campos.',400);
            }
        }
        $paypal = MetodoPago::query()->where('tipo','paypal')->first();
        if(isset($paypal)){
            $paypal->configuracion = json_encode($paypal_config);
            $paypal->save();
            return response(['message' => __('backpanel/metodos-de-pago/form.exito')], 200);
        }else{
            throw new \Exception('Ha ocurrido un error. Método de pago Paypal no existe.',400);
        }
    }

    public function getConfig(Request $request, $id){
        $metodo = MetodoPago::where('id',$id)->first();

        if(!isset($metodo)){
            return response(['errors' => ['errores' => ['No se ha podido recuperar la configuración del método de pago']]], 400);
        }
        if(isset($metodo->configuracion)){
            $config = json_decode($metodo->configuracion);
            return response()->json($config,200);
        }
        return response()->json(null,200);
    }
}
