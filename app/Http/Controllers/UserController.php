<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoUpdateRequest;
use App\Models\Expediente;
use App\Models\ExpedienteArchivo;
use App\Notifications\NewEmpleadoNotify;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\Permisos;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $nameCrud = 'empleados';
        return view('/content/empleados/pizarra', compact('nameCrud'));
    }

    public function new() {
        $permisos = Permisos::where('rol_admin', 1)->get()->toArray();
        $permisos_normales = array_filter($permisos, function($permiso) {
            return ($permiso['especial'] == 0);
        });
        $permisos_especiales = array_filter($permisos, function($permiso) {
            return ($permiso['especial'] == 1);
        });
        return view('content.empleados.formulario', [
            'permisos' => $permisos_normales,
            'permisos_especiales' => $permisos_especiales,
            'method' => 'Nuevo'
        ]);
    }

    public function edit($id)
    {
        $empleado = User::query()->where('id', $id)->first();

        $allPermisos = Permisos::with(['users' => function($query) use($id){
            $query->where('users.id', $id);
        }])->where('rol_admin', 1)->get()->toArray();

        $permisos_normales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 0);
        });
        $permisos_especiales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 1);
        });


        return view('content.empleados.formulario', [
            'permisos' => $permisos_normales,
            'permisos_especiales' => $permisos_especiales,
            'empleado' => $empleado,
            'method' => 'Editar'
        ]);

    }

    public function show($id)
    {
        $empleado = User::query()->where('id', $id)->first();

        $allPermisos = Permisos::with(['users' => function($query) use($id){
            $query->where('users.id', $id);
        }])->where('rol_admin', 1)->get()->toArray();

        $permisos_normales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 0);
        });
        $permisos_especiales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 1);
        });


        return view('content.empleados.formulario', [
            'permisos' => $permisos_normales,
            'permisos_especiales' => $permisos_especiales,
            'empleado' => $empleado,
            'method' => 'Ver'
        ]);

    }

    public function get(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        return response($user, 200);
    }

    /**
     * Store a new blog post.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(UserRequest $request, $id = null) {
        try {
            DB::beginTransaction();
            $is_portada = (is_null($request->is_portada) || $request->is_portada == 'false') ? 0 : 1;
            $mensaje = 'creado';
            if ($id === null) {
                $user = new User();
            } else {
                $user = User::find($id);
                if ($user === null) {
                    return response('No se pudo encontrar el usuario', 400);
                }
            }

            if(($request->tipo == 'admin') ) {
                $usersPortada = User::query()->where('is_portada', 1)->where('tipo', 'admin')->where('id', '!=', $id)->count();

                if (($is_portada && ((is_null($id) && $usersPortada == 2) || (!is_null($id) && $usersPortada > 1)))) {
                    return response(['errors' => ['usuario_portada' => ['Ya existen dos empleados en portada']]], 400);
                }
            }
            $fields = $request->only($user->getFillable());
            $passActual = $user->password;
            $fields = $request->only($user->getFillable());
            $user->is_blocked = 0;
            $user->tipo = is_null($request->tipo) ? 'admin' : $request->tipo;

            if(!is_null($request->password)){
                $user->password = bcrypt($request->password);
            }else{
                $user->password = $passActual;
            }

            $user->is_portada = $is_portada;
            $user->imagen = is_null($request->imagen) ? null : $request->imagen;
//            dd(($request->all()), $user);

            if ($id === null) {
                $user->save();
                $user->nuevoPass = $request->password;

                try {
                    $user->notify(new NewEmpleadoNotify());
                }catch (\Exception $e){

                }
            } else {
                $mensaje = 'editado';
                $user->update();
            }
            if (!is_null($request->permisos)) {
                $this->savePermisos(json_decode($request->permisos), $user);
            }
            DB::commit();
            return response(['mensaje' => 'El usuario se ha ' . $mensaje . ' correctamente',
                'user' => $user], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("'No se ha  $mensaje el usuario", 500);
        }
    }

    public function updatePermisos(Request $request, $id){

        try {
            DB::beginTransaction();
            $user = User::find($id);
            if ($user === null) {
                return response('No se pudo encontrar el usuario', 400);
            }


            if (!is_null($request->permisos)) {
                $this->savePermisos(json_decode($request->permisos), $user);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("'No se ha podido actualizar los permisos del usuario el usuario", 500);
        }

    }

    public function savePermisos($permisos, $user) {
//        $user = User::findOrFail($id);
        $permisosAux = [];
        $tipos = [
            'leer' => 0,
            'editar' => 0,
            'borrar' => 0,
            'especial' => 0,
            'updated_at' => Carbon::now()
        ];
        foreach ($permisos as $key => $permiso) {
            $permisosAux[$key] = $tipos;
            foreach ($permiso as $keyTipo => $valorTipoPermiso) {
                $permisosAux[$key][$keyTipo] = intval($valorTipoPermiso);
            }
        }
        $user->permisos()->sync($permisosAux);
        return response('OK', 200);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if ($user === null) {
                return response('No se pudo encontrar el usuario', 400);
            }

            User::destroy($id);
            DB::commit();
            return response('El usuario se ha borrado correctamente', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("'No se ha podido actualizar los permisos del usuario el usuario", 500);
        }
    }
    public function destroyAll(Request  $request)
    {
        try {
            $agentes = User::whereIn('id', $request->ids)->delete();
            return response('Los agentes se han borrado correctamente', 200);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function getDataJson(Request $request) {
        $admins = User::query()->where('tipo','admin');
//        $permisoLeer = \auth()->user()->hasPermiso('Empleados','Leer');
//        $permisoEditar = \auth()->user()->hasPermiso('Empleados','Editar');
//        $permisoBorrar = \auth()->user()->hasPermiso('Empleados','Borrar');
        return DataTables::eloquent($admins)
//            ->addColumn('permiso_leer', function ($model) use($permisoLeer){
//                return $permisoLeer;
//            })
//            ->addColumn('permiso_borrar', function ($model) use($permisoBorrar){
//                return $permisoBorrar;
//            })
//            ->addColumn('permiso_editar', function ($model) use($permisoEditar){
//                return $permisoEditar;
//            })
//            ->editColumn('users_id', function ($model){
//                return User::find(intval($model->users_id), 'id')->value('name');
//            })
            ->editColumn('created_at', function ($model){
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d-m-Y');
            })
            ->toJson();
    }

    public function block(Request $request, $id){
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if ($user === null) {
                return response('No se pudo encontrar el usuario', 400);
            }
            $user->is_blocked = !$user->is_blocked;
            $user->update();
            DB::commit();
            $mensaje = ($user->is_blocked) ? 'bloqueado' : 'desbloqueado';
            return response(['mensaje' => 'El usuario se ha ' . $mensaje . ' correctamente',
                'userBlocked' => $user->is_blocked

            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("'No se ha podido actualizar los permisos del usuario el usuario", 500);
        }
    }

    public function update(Request $request)
    {
        try {//isDirty mira si
            // los campos han cambiado.
            $user = $this->user;
            if ($request->password === null) {
                if ($user->email !== $request->email) {
                    $validator = $this->validate($request, ['nombre' => 'required|min:3|max:50', 'email' => 'email|unique:users', 'apellidos' => 'required|min:3|max:50', 'dni' => 'required|min:3|max:20',]);
                } else {
                    $validator = $this->validate($request, ['nombre' => 'required|min:3|max:50', 'apellidos' => 'required|min:3|max:50', 'email' => 'required|min:3|max:20',]);
                }
                if ($validator) {
                    $fields = $request->only($user->getFillable());
                    $user->fill($fields);
                    $request->has('avatar')!=null?$user->imagen = $request->get('avatar'):$user->imagen;

                    if ($user->isDirty()) {
                        foreach ($user->getDirty() as $campo => $valor) {
                            $user->$campo = $valor;
                        }
                    } else {
                        \Illuminate\Support\Facades\Session::flash('perfil_nada_actualizar','Nada que actualizar');
                        return response([
                            'code'=>200,
                            'type'=>'info',
                            'message'=>'Los datos no han cambiado.'
                        ]);
                    }

                    $user->save();
                    if ($user->save()) {
                        return response([
                            'code'=>200,
                            'type'=>'',
                            'message'=>'Se han modificado sus datos.'
                        ]);
                    } else {
                        return response([
                            'code'=>401,
                            'type'=>'error',
                            'message'=>'No se han podido modificar los datos'
                        ]);
                    }
                } else {
                    return response([
                        'code'=>401,
                        'type'=>'error',
                        'message'=>'No se han podido modificar los datos'
                    ]);
                }
            } elseif ($request->has('newAvatar')) {


            } else {
                $validator = $this->validate($request, ['nombre' => 'required|min:3|max:50', 'apellidos' => 'required|min:3|max:50', 'dni' => 'required|min:3|max:15', 'email' => 'email', 'password' => 'required|confirmed|min:6']);
                if ($validator) {
                    if (trim($request->oldPassword !== '')) {
                        if (Hash::check(trim($request->oldPassword), $user->password)) {
                            $user->nombre = trim($request->nombre);
                            $user->dni = trim($request->dni);
                            $user->apellidos = trim($request->apellidos);
                            $user->email = trim($request->email);
                            $request->has('avatar')!=null?$user->imagen = $request->get('avatar'):$user->imagen;
                            $user->password = Hash::make(trim($request->password));
                            $user->save();
                            if ($user->save()) {
                                return response([
                                    'code'=>200,
                                    'type'=>'',
                                    'message'=>$user->nombre . ' ' . $user->apellidos . ' actualizado!'
                                ]);
                            } else {
                                return response([
                                    'code'=>401,
                                    'type'=>'error',
                                    'message'=>'Error al actualizar datos.'
                                ]);
                            }
                        } else {
                            return response([
                                'code'=>402,
                                'type'=>'error',
                                'message'=>'La contraseña antigua es incorrecta'
                            ]);
                        }
                    } else {
                        return response([
                            'code'=>402,
                            'type'=>'error',
                            'message'=>'Error en la contraseña. L'
                        ]);
                    }
                } else {
                    return response([
                        'code'=>401,
                        'type'=>'error',
                        'message'=>'Error al actualizar datos.'
                    ]);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response([
                'code'=>401,
                'type'=>'error',
                'message'=>'Error al actualizar datos.'
            ]);
        }
    }

    /** AGENTES */
    //getAgents de los selects 2
    public function getAgents(Request $request){
        $patron = " ";
        if(isset($request->term)){
            $patron = $request->term;
        }
        $searchValues = preg_split('/\s+/', $patron, -1, PREG_SPLIT_NO_EMPTY);
        return DB::table('users')
            ->where('tipo', 'agente')
            ->where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
                $q->orWhere('users.nombre', 'LIKE', "%{$value}%");
            }
        })->select('users.id', 'users.nombre', 'users.apellidos', 'users.email' )->limit(20)->get();
    }

    public function indexAgentes()
    {
        $nameCrud = 'agentes';
        return view('/content/agentes/agentes', compact('nameCrud'));
    }
    public function getDataJsonAgentes(Request $request) {
        $agentes = User::query()->where('tipo','agente');
        $permisoLeer = \auth()->user()->hasPermiso('Empleados','Leer');
        $permisoEditar = \auth()->user()->hasPermiso('Agentes','Editar');
        $permisoBorrar = \auth()->user()->hasPermiso('Agentes','Borrar');
        return DataTables::eloquent($agentes)
            ->addColumn('permiso_leer', function ($model) use($permisoLeer){
                return $permisoLeer;
            })
            ->addColumn('permiso_borrar', function ($model) use($permisoBorrar){
                return $permisoBorrar;
            })
            ->addColumn('permiso_editar', function ($model) use($permisoEditar){
                return $permisoEditar;
            })
//            ->editColumn('users_id', function ($model){
//                return User::find(intval($model->users_id), 'id')->value('name');
//            })
            ->editColumn('created_at', function ($model){
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d-m-Y');
            })
            ->toJson();
    }
    public function newAgente(Request $request) {
        $permisos = Permisos::where('rol_agente', 1)->get()->toArray();
        $permisos_normales = array_filter($permisos, function($permiso) {
            return ($permiso['especial'] == 0);
        });
        $permisos_especiales = array_filter($permisos, function($permiso) {
            return ($permiso['especial'] == 1);
        });
        return view('content.agentes.formulario', [
            'permisos' => $permisos_normales,
            'permisos_especiales' => $permisos_especiales,
            'method' => 'Nuevo'
        ]);
    }
    public function editAgente($id)
    {
        $empleado = User::query()->where('id', $id)->first();

        $allPermisos = Permisos::with(['users' => function($query) use($id){
            $query->where('users.id', $id);
        }])->where('rol_agente', 1)->get()->toArray();

        $permisos_normales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 0);
        });
        $permisos_especiales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 1);
        });


        return view('content.agentes.formulario', [
            'permisos' => $permisos_normales,
            'permisos_especiales' => $permisos_especiales,
            'empleado' => $empleado,
            'method' => 'Editar'
        ]);

    }

    public function showAgente($id)
    {
        $empleado = User::query()->where('id', $id)->first();

        $allPermisos = Permisos::with(['users' => function($query) use($id){
            $query->where('users.id', $id);
        }])->where('rol_agente', 1)->get()->toArray();

        $permisos_normales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 0);
        });
        $permisos_especiales = array_filter($allPermisos, function($permiso) {
            return ($permiso['especial'] == 1);
        });


        return view('content.agentes.formulario', [
            'permisos' => $permisos_normales,
            'permisos_especiales' => $permisos_especiales,
            'empleado' => $empleado,
            'method' => 'Ver'
        ]);

    }
}
