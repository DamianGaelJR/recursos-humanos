@extends('layouts.app')

@section('title', 'Editar Salario')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Editar Salario</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('salarios.update', $salario) }}" method="POST" class="form-container p-4 bg-light rounded shadow-sm">
        @csrf
        @method('PUT')

        <!-- Selección de Empleado -->
        <div class="mb-3">
            <label for="id_empleado" class="form-label">Empleado</label>
            <select name="id_empleado" id="id_empleado" class="form-select" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ $empleado->id == $salario->id_empleado ? 'selected' : '' }}>
                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                    </option>
                @endforeach
            </select>
            @error('id_empleado')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Salario -->
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" name="salario" id="salario" class="form-control" value="{{ $salario->salario }}" step="0.01" required>
            @error('salario')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Fecha de Registro -->
        <div class="mb-3">
            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
            <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" value="{{ $salario->fecha_registro }}" required>
            @error('fecha_registro')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botones -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-submit">Actualizar</button>
            <a href="{{ route('salarios.index') }}" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
