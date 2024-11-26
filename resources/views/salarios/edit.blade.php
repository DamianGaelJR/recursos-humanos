@extends('layouts.app')

@section('title', 'Editar Salario')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar Salario</h1>

    <form action="{{ route('salarios.update', $salario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_empleado" class="form-label">Empleado</label>
            <select name="id_empleado" id="id_empleado" class="form-select" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ $empleado->id == $salario->id_empleado ? 'selected' : '' }}>
                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" name="salario" id="salario" class="form-control" value="{{ $salario->salario }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
            <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" value="{{ $salario->fecha_registro }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('salarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
