@extends('adminlte::page')

@section('title', 'Pedido | Consulta pedidos')

@section('content_header')
    <h1>Pedido</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <label for="fecha_venta">Fecha:</label>
                {{ date('d-m-Y H:i:s', strtotime($pedido->created_at)) }}
            </li>
            <li>
                <label for="nombre_cliente">Cliente:</label>
                {{ $pedido->cliente->nombre }}
            </li>
            <li>
                <label for="total_venta">Total venta:</label>
                Q.{{ $pedido->total }}
            </li>
        </ul>

        <div class="mt-3">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <td>Sabor</td>
                        <td>Precio</td>
                        <td>Cantidad</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->sabor->nombre }}</td>
                            <td>Q.{{ $detalle->sabor->precio }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>Q.{{ $detalle->sabor->precio * $detalle->cantidad }}</td>                  
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Sin resultados</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">Subtotal:</td>
                        <td>{{ $pedido->total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop