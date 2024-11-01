<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Sabor;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetallePedidoController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $sabores = Sabor::all();

        return view('pedidos.nuevo-pedido.index', [
            'clientes' => $clientes,
            'sabores' => $sabores
        ]);
    }

    public function agregarItem(Request $request)
    {
        $sabor = Sabor::find($request->id_sabor);

        Cart::add([
            'id' => $request->id_sabor, 
            'name' => $sabor->nombre, 
            'qty' => $request->cantidad, 
            'price' => $sabor->precio,
        ]);

        session()->flash('success', 'Registro agregado al carrito.');

        return to_route('DetallePedidos.index');
    }

    public function eliminarItem($rowId)
    {
        Cart::remove($rowId);

        session()->flash('success', 'Registro eliminado del carrito.');

        return to_route('DetallePedidos.index');
    }

    public function finalizarPedido(Request $request)
    {
        DB::beginTransaction();

        // Obtener dato del carrito
        $cartItems = Cart::content();

        try {
            // Almacenar pedido
            $pedido = Pedido::create([
                'id_cliente' => $request->id_cliente,
                'total' => $request->total
            ]);
        
            // Obtener el ID del pedido
            $pedido_id = $pedido->id;
        
            // Formatear arreglo
            $detallePedido = [];
        
            // Almacenar detalles de la orden
            foreach ($cartItems as $cartItem) {
                // Almacenar detalles de la orden
                $detallePedido[] = [
                    'id_pedido' => $pedido_id,
                    'id_sabor' => $cartItem->id,
                    'cantidad' => $cartItem->qty,
                    'precio_unitario' => $cartItem->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        
            // Almacenar detalles de la orden en la BD
            DetallePedido::insert($detallePedido);
        
            // Eliminar carrito
            Cart::destroy();

            DB::commit();

            session()->flash('success', 'Pedido finalizado correctamente.');

            return to_route('DetallePedidos.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al finalizar pedido: ' . $e->getMessage());
        }
    }
}
