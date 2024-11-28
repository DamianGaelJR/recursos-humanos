@extends('layouts.app')

@section('title', 'Agregar Departamento')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Agregar Departamento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departamentos.store') }}" method="POST" class="form-container p-4 bg-light rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-actions text-center">
            <button type="submit" class="btn btn-submit">Guardar</button>
            <a href="{{ route('departamentos.index') }}" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
