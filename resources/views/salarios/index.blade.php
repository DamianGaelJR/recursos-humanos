@extends('layouts.app')

@section('title', 'Salarios')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Salarios</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <!-- Botón para registrar salario -->
    <div class="text-end mb-4">
        <a href="{{ route('salarios.create') }}" class="btn-custom">Registrar Salario</a>
    </div>

    <!-- Tabla estilizada de salarios -->
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Salario</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salarios as $salario)
                    <tr>
                        <td>{{ $salario->id }}</td>
                        <td>{{ $salario->empleado->nombre }} {{ $salario->empleado->apellido }}</td>
                        <td>${{ number_format($salario->salario, 2) }}</td>
                        <td>{{ $salario->fecha_registro }}</td>
                        <td class="actions">
                            <a href="{{ route('salarios.edit', $salario) }}" class="btn-custom btn-sm edit">Editar</a>
                            <form action="{{ route('salarios.destroy', $salario) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted text-center">No se encontraron salarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
