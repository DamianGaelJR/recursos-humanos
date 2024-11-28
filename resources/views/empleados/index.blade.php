@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Empleados</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para agregar empleados -->
    <div class="text-end mb-4">
        <a href="{{ route('empleados.create') }}" class="btn-custom">Agregar Empleado</a>
    </div>

    <!-- Tabla estilizada de empleados -->
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Departamento</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                        <td>{{ $empleado->departamento->nombre ?? 'Sin departamento' }}</td>
                        <td>{{ $empleado->rol->nombre ?? 'Sin rol' }}</td>
                        <td class="actions">
                            <a href="{{ route('empleados.edit', $empleado) }}" class="btn-custom btn-sm edit">Editar</a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted text-center">No se encontraron empleados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
