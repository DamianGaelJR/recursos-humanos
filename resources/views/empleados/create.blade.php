@extends('layouts.app')

@section('title', 'Agregar Empleado')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Agregar Empleado</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('empleados.store') }}" method="POST" class="form-container p-4 bg-light rounded shadow-sm">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control" value="{{ old('fecha_contratacion') }}" required>
            </div>
            <div class="col-md-6">
                <label for="departamento_id" class="form-label">Departamento</label>
                <select name="id_departamento" id="id_departamento" class="form-select" required>
                    <option value="">Seleccionar</option>
                    @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->id }}" {{ old('id_departamento') == $departamento->id ? 'selected' : '' }}>
                        {{ $departamento->nombre }}
                    </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="id_rol" class="form-label">Rol</label>
                <select name="id_rol" id="id_rol" class="form-select" required>
                <option value="">Seleccionar</option>
                    @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions text-center">
            <button type="submit" class="btn btn-submit">Guardar</button>

            <a href="{{ route('empleados.index') }}" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection