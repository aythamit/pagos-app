<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['modulo', 'display', 'nombre_es', 'nombre_it', 'rol', 'leer', 'editar', 'crear', 'borrar'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_has_permisos', 'permisos_id', 'users_id')->withPivot('leer', 'editar', 'borrar');
    }
}
