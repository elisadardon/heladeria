@extends('adminlte::page')

@section('title', 'Sabores')

@section('content_header')
    <h1>Sabores</h1>
@stop

@section('content')
    <a 
        href="{{ route('sabores.create') }}"
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
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Precio</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @forelse ($sabores as $sabor)
                <tr>
                    <td>{{ $sabor->nombre }}</td>
                    <td>{{ $sabor->descripcion }}</td>
                    <td>Q.{{ $sabor->precio }}</td>
                    <td>
                        <div class="d-inline">
                            <a href="{{ route('sabores.edit', $sabor) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('sabores.destroy', $sabor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el registro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>                    
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Sin resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop