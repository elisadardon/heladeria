<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();

        return view('pedidos.consulta-pedidos.index', [
            'pedidos' => $pedidos
        ]);
    }

    public function view(Pedido $pedido)
    {
        $detalles = DetallePedido::where('id_pedido', $pedido->id)->get();

        return view('pedidos.consulta-pedidos.view', [
            'pedido' => $pedido,
            'detalles' => $detalles
        ]);
    }
}
