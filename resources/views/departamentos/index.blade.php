@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Departamentos</h1>
    
    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <div class="text-end mb-4">
        <a href="{{ route('departamentos.create') }}" class="btn-custom">Agregar Departamento</a>
    </div>

    <div class="table-container">
        <table class="styled-table">
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
                        <td class="actions">
                            <a href="{{ route('departamentos.edit', $departamento) }}" class="btn-custom btn-sm edit">Editar</a>
                            <form action="{{ route('departamentos.destroy', $departamento) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
