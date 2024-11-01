@extends('adminlte::page')

@section('title', 'Pedidos | Consulta pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
    <a 
        href="{{ route('DetallePedidos.index') }}"
        class="btn btn-sm btn-primary"
    >
        Crear
    </a>

    @if (session('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead class="table-dark">
            <tr>
                <td>Cliente</td>
                <td>Telefono</td>
                <td>Total</td>
                <td>Fecha pedido</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->cliente->nombre }}</td>
                    <td>{{ $pedido->cliente->telefono }}</td>
                    <td>Q.{{ $pedido->total }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($pedido->created_at)) }}</td>
                    <td>
                        <div class="d-inline">
                            <a href="{{ route('pedidos.view', $pedido) }}" class="btn btn-sm btn-warning">
                                <i class="far fa-eye"></i>
                            </a>
                        </div>
                    </td>                    
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Sin resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop