<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $fillable = ['id_pedido', 'id_sabor', 'cantidad', 'precio_unitario'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function sabor()
    {
        return $this->belongsTo(Sabor::class, 'id_sabor');
    }
}
