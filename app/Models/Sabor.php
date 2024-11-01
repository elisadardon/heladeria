<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    use HasFactory;

    protected $table = 'sabores';
    protected $fillable = ['nombre', 'descripcion', 'precio'];

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class, 'id_sabor');
    }
}
