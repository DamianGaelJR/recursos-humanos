@extends('layouts.app')

@section('title', 'Evaluaciones')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Lista de Evaluaciones</h1>
    <a href="{{ route('evaluaciones.create') }}" class="btn btn-success mb-3">Registrar Evaluación</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Calificación</th>
                <th>Comentarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluaciones as $evaluacion)
                <tr>
                    <td>{{ $evaluacion->id }}</td>
                    <td>{{ $evaluacion->empleado->nombre }} {{ $evaluacion->empleado->apellido }}</td>
                    <td>{{ $evaluacion->fecha }}</td>
                    <td>{{ $evaluacion->calificacion }}</td>
                    <td>{{ $evaluacion->comentarios }}</td>
                    <td>
                        <a href="{{ route('evaluaciones.edit', $evaluacion) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('evaluaciones.destroy', $evaluacion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
