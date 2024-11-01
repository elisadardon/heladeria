@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Editar cliente</h1>
@stop

@section('content')
    <a 
        href="{{ route('clientes.index') }}"
        class="btn btn-sm btn-primary"
    >
        Regresar
    </a>

    @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre">Nombre *</label>
            <input 
                type="text"
                id="nombre"
                name="nombre"
                class="form-control"
                value="{{ $cliente->nombre }}"
            >
        </div>
        <div class="mb-3">
            <label for="correo">Correo *</label>
            <input 
                type="email"
                id="correo"
                name="correo"
                class="form-control"
                value="{{ $cliente->correo }}"
            >
        </div>
        <div class="mb-3">
            <label for="telefono">Telefono *</label>
            <input 
                type="text"
                id="telefono"
                name="telefono"
                class="form-control"
                value="{{ $cliente->telefono }}"
            >
        </div>
        <button
            type="submit"
            class="btn btn-sm btn-success"
        >
            Guardar
        </button>
        
    </form>
@stop