@extends('adminlte::page')

@section('title', 'Sabores')

@section('content_header')
    <h1>Sabores</h1>
@stop

@section('content')
    <a 
        href="{{ route('sabores.index') }}"
        class="btn btn-sm btn-primary"
    >
        Regresar
    </a>

    @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('sabores.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="nombre">Nombre *</label>
            <input 
                type="text"
                id="nombre"
                name="nombre"
                class="form-control"
            >
        </div>
        <div class="mb-3">
            <label for="descripcion">Descripcion *</label>
            <input 
                type="text"
                id="descripcion"
                name="descripcion"
                class="form-control"
            >
        </div>
        <div class="mb-3">
            <label for="precio">Precio *</label>
            <input 
                type="number"
                id="precio"
                name="precio"
                class="form-control"
                step="0.01"
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