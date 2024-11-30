@extends('layouts.app')

@section('title', 'Evaluar Empleado')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Evaluar Empleado</h1>

    <form action="{{ route('evaluaciones.store') }}" method="POST" class="form-container p-4 bg-light rounded shadow-sm">
        @csrf

        <!-- Selección de Empleado -->
        <div class="mb-3">
            <label for="id_empleado" class="form-label">Empleado</label>
            <select name="id_empleado" id="id_empleado" class="form-select" required>
                <option value="" disabled selected>Seleccione un empleado</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}">
                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                    </option>
                @endforeach
            </select>
            @error('id_empleado')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Fecha de la Evaluación -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Evaluación</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
            @error('fecha')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Calificación -->
        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificación</label>
            <input type="number" name="calificacion" id="calificacion" class="form-control" value="{{ old('calificacion') }}" min="0" max="10" step="0.1" required>
            <small class="form-text text-muted">Calificación del 1 al 5</small>
            @error('calificacion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Comentarios -->
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea name="comentarios" id="comentarios" rows="4" class="form-control" placeholder="Comentarios sobre el desempeño del empleado">{{ old('comentarios') }}</textarea>
            @error('comentarios')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botones -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-submit">Guardar Evaluación</button>
            <a href="{{ route('evaluaciones.index') }}" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
