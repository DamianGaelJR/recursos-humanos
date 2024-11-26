@extends('layouts.app')

@section('title', 'Empleados')

@section('content')

<div class="container mt-5 text-center">
    
    <h1 class="mb-4" style="font-weight: 600; color: #333;">Lista de Empleados</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('empleados.create') }}" class="btn btn-success mb-4">Agregar Empleado</a>

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> Nombre Completo </th>
                    <th> Departamento </th>
                    <th> Rol </th>
                    <th> Acciones </th>
                </tr>
            </thead>
            <tbody>
                @forelse($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                        <td>{{ $empleado->departamento->nombre ?? 'Sin departamento' }}</td>
                        <td>{{ $empleado->rol->nombre ?? 'Sin rol' }}</td>
                        <td>
                            <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">No se encontraron empleados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
