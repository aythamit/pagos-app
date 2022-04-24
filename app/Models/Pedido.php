<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'doc',
        'user_id',
        'tienda_id',
        'estado',
        'info_pago',
        'pedido',
        'observaciones',
        'fecha_entrega',
    ];

    public function cliente()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
