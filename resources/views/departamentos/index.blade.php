@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Departamentos</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <!-- Formulario de búsqueda -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <form action="{{ route('departamentos.index') }}" method="GET" class="d-flex align-items-center" id="searchForm">
            <!-- Menú desplegable para elegir el campo de búsqueda -->
            <select name="campo" class="form-select me-2" id="searchField" style="width: 150px;">
                <option value="id" {{ request('campo') == 'id' ? 'selected' : '' }}>ID</option>
                <option value="nombre" {{ request('campo') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                <option value="descripcion" {{ request('campo') == 'descripcion' ? 'selected' : '' }}>Descripción</option>
            </select>

            <!-- Barra de búsqueda -->
            <input type="text" name="valor" class="form-control me-2" id="searchValue" placeholder="Buscar departamento..." value="{{ request('valor') }}">
        </form>

        <!-- Botón para agregar departamentos -->
        <a href="{{ route('departamentos.create') }}" class="btn-custom">Agregar Departamento</a>
    </div>

    <!-- Tabla estilizada de departamentos -->
    <div class="table-container">
        <table class="styled-table" id="departamentosTable">
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
<script>
    // Obtener los elementos relevantes
    const searchField = document.getElementById('searchField');
    const searchValue = document.getElementById('searchValue');
    const table = document.getElementById('departamentosTable');
    const rows = table.getElementsByTagName('tr');
    
    // Evento de búsqueda al escribir en el campo
    searchValue.addEventListener('input', function() {
        const campo = searchField.value;
        const valor = searchValue.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) { // Comenzar desde 1 para evitar la cabecera
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            // Verificar el valor de cada celda según el campo de búsqueda seleccionado
            switch (campo) {
                case 'id':
                    match = cells[0].innerText.toLowerCase().includes(valor);
                    break;
                case 'nombre':
                    match = cells[1].innerText.toLowerCase().includes(valor);
                    break;
                case 'descripcion':
                    match = cells[2].innerText.toLowerCase().includes(valor);
                    break;
            }

            // Mostrar u ocultar la fila dependiendo de si hay una coincidencia
            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
</script>
@endsection