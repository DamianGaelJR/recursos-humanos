@extends('layouts.app')

@section('title', 'Registrar Salario')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Registrar Salario</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('salarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_empleado" class="form-label">Empleado</label>
            <select name="id_empleado" id="id_empleado" class="form-select" required>
                <option value="">Seleccionar</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" name="salario" id="salario" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
            <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('salarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
