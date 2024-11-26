@extends('layouts.app')

@section('title', 'Editar Rol')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar Rol</h1>

    <form action="{{ route('roles.update', $rol->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo para el nombre del rol -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Rol</label>
            <input type="text" name="nombre" id="nombre" class="form-control" 
                   value="{{ old('nombre', $role->nombre) }}" required>
        </div>

        <!-- Campo para la descripción del rol -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $rol->descripcion) }}</textarea>
        </div>

        <!-- Botones de acción -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
