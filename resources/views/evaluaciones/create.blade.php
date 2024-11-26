@extends('layouts.app')

@section('title', 'Evaluar Empleado')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Evaluar Empleado</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('evaluaciones.store') }}" method="POST">
                            @csrf

                            <!-- Selección de Empleado -->
                            <div class="form-group mb-3">
                                <label for="id_empleado" class="form-label">Empleado</label>
                                <select name="id_empleado" id="id_empleado" class="form-control" required>
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
                            <div class="form-group mb-3">
                                <label for="fecha" class="form-label">Fecha de Evaluación</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
                                @error('fecha')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Calificación -->
                            <div class="form-group mb-3">
                                <label for="calificacion" class="form-label">Calificación</label>
                                <input type="number" name="calificacion" id="calificacion" class="form-control" value="{{ old('calificacion') }}" min="0" max="10" step="0.1" required>
                                <small class="form-text text-muted">Calificación del 0 al 10</small>
                                @error('calificacion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Comentarios -->
                            <div class="form-group mb-3">
                                <label for="comentarios" class="form-label">Comentarios</label>
                                <textarea name="comentarios" id="comentarios" rows="4" class="form-control" placeholder="Comentarios sobre el desempeño del empleado">{{ old('comentarios') }}</textarea>
                                @error('comentarios')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success">Guardar Evaluación</button>
                                <a href="{{ route('evaluaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
