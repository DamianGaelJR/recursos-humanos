@extends('layouts.app')

@section('title', 'Salarios')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Lista de Salarios</h1>
    <a href="{{ route('salarios.create') }}" class="btn btn-success mb-3">Registrar Salario</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
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
            @foreach($salarios as $salario)
                <tr>
                    <td>{{ $salario->id }}</td>
                    <td>{{ $salario->empleado->nombre }} {{ $salario->empleado->apellido }}</td>
                    <td>${{ number_format($salario->salario, 2) }}</td>
                    <td>{{ $salario->fecha_registro }}</td>
                    <td>
                        <a href="{{ route('salarios.edit', $salario) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('salarios.destroy', $salario) }}" method="POST" style="display:inline;">
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
