@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Listado de Roles</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <!-- Botón para agregar nuevo rol -->
    <div class="text-end mb-4">
        <a href="{{ route('roles.create') }}" class="btn-custom">Agregar Nuevo Rol</a>
    </div>

    <!-- Tabla estilizada de roles -->
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iterar roles desde el controlador -->
                @forelse ($roles as $rol)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rol->nombre }}</td>
                        <td class="actions">
                            <a href="{{ route('roles.edit', $rol) }}" class="btn-custom btn-sm edit">Editar</a>
                            <form action="{{ route('roles.destroy', $rol) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted text-center">No se encontraron roles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
