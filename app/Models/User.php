<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'telefono',
        'tipo',
        'imagen',
        'email',
        'email_verified_at',
        'cargo_empresa',
        'password',
        'is_blocked',
        'tienda_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verify_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $permisos_usuario = [];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'users_has_permisos', 'users_id', 'permisos_id')->withPivot('leer', 'editar', 'borrar');
    }

    public function hasPermiso($modulo, $permiso)
    {
         if (count($this->permisos_usuario) == 0){
             $permisos = [];
             $permisos_user = $this->permisos;

             foreach ($permisos_user as $permiso_user) {
                 $permisos[strtolower($permiso_user->modulo)] = $permiso_user->toArray()['pivot'];
             }
             $this->permisos_usuario =  $permisos;
         }

         return (isset($this->permisos_usuario[strtolower($modulo)]) && $this->permisos_usuario[strtolower($modulo)][strtolower($permiso)] == 1);
    }

    public function conceptos(){
        return $this->hasMany(Concepto::class, 'users_id' , 'id');
    }
}
