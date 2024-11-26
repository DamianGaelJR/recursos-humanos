@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Lista de Departamentos</h1>
    <a href="{{ route('departamentos.create') }}" class="btn btn-success mb-3">Agregar Departamento</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departamentos as $departamento)
                <tr>
                    <td>{{ $departamento->id }}</td>
                    <td>{{ $departamento->nombre }}</td>
                    <td>{{ $departamento->descripcion }}</td>
                    <td>
                        <a href="{{ route('departamentos.edit', $departamento) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('departamentos.destroy', $departamento) }}" method="POST" style="display:inline;">
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
