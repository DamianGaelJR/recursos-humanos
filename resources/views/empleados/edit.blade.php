@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Editar Empleado</h1>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Formulario de edición -->
    <form action="{{ route('empleados.update', $empleado) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $empleado->apellido) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $empleado->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $empleado->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control" value="{{ old('fecha_contratacion', $empleado->fecha_contratacion) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_departamento" class="form-label">Departamento</label>
            <select name="id_departamento" id="id_departamento" class="form-select" required>
                <option value="">Selecciona un Departamento</option>
                @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}" {{ old('id_departamento', $empleado->id_departamento) == $departamento->id ? 'selected' : '' }}>
                    {{ $departamento->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_rol" class="form-label">Rol</label>
            <select name="id_rol" id="id_rol" class="form-select" required>
                <option value="">Selecciona un Rol</option>
                @foreach ($roles as $rol)
                <option value="{{ $rol->id }}" {{ old('id_rol', $empleado->id_rol) == $rol->id ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-submit">Actualizar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection