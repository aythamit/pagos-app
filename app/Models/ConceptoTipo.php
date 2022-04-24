<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptoTipo extends Model
{
    use HasFactory;

    protected $table = "conceptos_tipos";


    public function conceptos(){
        return $this->hasMany(Concepto::class, 'conceptos_tipos_id' , 'id');
    }
}
