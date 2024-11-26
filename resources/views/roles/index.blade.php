@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Roles</h1>
    
    <!-- Aquí puedes añadir contenido para la lista de roles -->
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí puedes iterar los roles desde el controlador -->
            @foreach ($roles as $rol)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $rol->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('roles.edit', $rol) }}" class="text-blue-500 hover:underline">Editar</a>
                        <form action="{{ route('roles.destroy', $rol) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
