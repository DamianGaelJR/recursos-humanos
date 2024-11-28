@extends('layouts.app')

@section('title', 'Evaluaciones')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Evaluaciones</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <!-- Botón para registrar evaluación -->
    <div class="text-end mb-4">
        <a href="{{ route('evaluaciones.create') }}" class="btn-custom">Registrar Evaluación</a>
    </div>

    <!-- Tabla estilizada de evaluaciones -->
    <div class="table-container">
        <table class="styled-table">
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
                @forelse($evaluaciones as $evaluacion)
                    <tr>
                        <td>{{ $evaluacion->id }}</td>
                        <td>{{ $evaluacion->empleado->nombre }} {{ $evaluacion->empleado->apellido }}</td>
                        <td>{{ $evaluacion->fecha }}</td>
                        <td>{{ $evaluacion->calificacion }}</td>
                        <td>{{ $evaluacion->comentarios }}</td>
                        <td class="actions">
                            <a href="{{ route('evaluaciones.edit', $evaluacion) }}" class="btn-custom btn-sm edit">Editar</a>
                            <form action="{{ route('evaluaciones.destroy', $evaluacion) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center">No se encontraron evaluaciones.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
