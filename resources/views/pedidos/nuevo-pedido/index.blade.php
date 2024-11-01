@extends('adminlte::page')

@section('title', 'Pedidos | Nuevo pedido')

@section('content_header')
    <h1>Nuevo Pedido</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('agregarItem.index') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_sabor">Sabor *</label>
            <select name="id_sabor" id="id_sabor" class="form-control">
                @forelse ($sabores as $sabor)
                    <option value="{{ $sabor->id }}">{{ $sabor->nombre }}</option>
                @empty
                    Sin resultados
                @endforelse
            </select>
        </div>
        <div class="mb-3">
            <label for="cantidad">Cantidad *</label>
            <input 
                type="text"
                id="cantidad"
                name="cantidad"
                class="form-control"
            >
        </div>
        <button type="submit" class="btn btn-sm btn-success">
            Agregar
        </button>
    </form>

    <div class="mt-3">
        <h1>Detalle del pedido</h1>

        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Finalizar pedido
        </button>
    </div>
    <table class="table mt-3">
        <thead class="table-dark">
            <tr>
                <td>Sabor</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @forelse (Cart::content() as $detalle)
                <tr>
                    <td>{{ $detalle->name }}</td>
                    <td>Q.{{ $detalle->price }}</td>
                    <td>{{ $detalle->qty }}</td>
                    <td>Q.{{ $detalle->subtotal }}</td>
                    <td>
                        <form action="{{ route('eliminarItem', $detalle->rowId) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el registro?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>                    
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Sin resultados</td>
                </tr>
            @endforelse
        </tbody>
        @if (Cart::content()->count())
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Subtotal:</td>
                    <td>{{ Cart::subtotal() }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Finalizar pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('finalizarPedido') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_cliente">Cliente *</label>
                        <select name="id_cliente" id="id_cliente" class="form-control">
                            @forelse ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @empty
                                Sin resultados
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="total">Total *</label>
                        <input type="text" class="form-control" id="total" name="total" value="{{ Cart::subtotal() }}" readonly>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
        </div>
        </div>
    </div>
@stop