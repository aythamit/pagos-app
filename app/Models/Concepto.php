<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    protected $fillable = ['concepto', 'euro', 'is_pagado' , 'fecha_pago', 'users_id', 'conceptos_tipos_id'];
}
