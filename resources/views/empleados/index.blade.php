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

    <!-- Barra de búsqueda y botón para agregar empleados -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Formulario de búsqueda -->
        <form action="{{ route('empleados.index') }}" method="GET" class="d-flex align-items-center" id="searchForm">
            <!-- Menú desplegable -->
            <select name="campo" class="form-select me-2" id="searchField" style="width: 150px;">
                <option value="id" {{ request('campo') == 'id' ? 'selected' : '' }}>ID</option>
                <option value="nombre" {{ request('campo') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                <option value="departamento" {{ request('campo') == 'departamento' ? 'selected' : '' }}>Departamento</option>
                <option value="rol" {{ request('campo') == 'rol' ? 'selected' : '' }}>Rol</option>
            </select>

            <!-- Barra de búsqueda -->
            <input type="text" name="valor" class="form-control me-2" id="searchValue" placeholder="Buscar empleado..." value="{{ request('valor') }}">
        </form>

        <!-- Botón para agregar empleados -->
        <a href="{{ route('empleados.create') }}" class="btn-custom">Agregar Empleado</a>
    </div>

    <!-- Tabla estilizada de empleados -->
    <div class="table-container">
        <table class="styled-table" id="empleadosTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Departamento</th>
                    <th>Rol</th>
                    <th>Fecha de Contratación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="empleadosTableBody">
                @foreach($empleados as $empleado)
                    <tr class="empleadoRow">
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->apellido }}</td>
                        <td>{{ $empleado->correo }}</td>
                        <td>{{ $empleado->telefono }}</td>
                        <td>{{ $empleado->departamento->nombre ?? 'Sin departamento' }}</td>
                        <td>{{ $empleado->rol->nombre ?? 'Sin rol' }}</td>
                        <td>{{ $empleado->fecha_contratacion }}</td>
                        <td class="actions">
                            <a href="{{ route('empleados.edit', $empleado) }}" class="btn-custom btn-sm edit">Editar</a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Función para filtrar empleados en la tabla
    document.getElementById('searchValue').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase(); // Obtener el valor de búsqueda
        let searchField = document.getElementById('searchField').value; // Obtener el campo seleccionado
        let rows = document.querySelectorAll('#empleadosTableBody tr'); // Filtrar las filas de la tabla

        // Iterar sobre las filas de la tabla
        for (let row of rows) {
            let cellValue = ''; // Inicializamos el valor de la celda que vamos a comparar

            // Dependiendo del campo de búsqueda seleccionado, obtenemos el valor de la celda
            switch (searchField) {
                case 'id':
                    cellValue = row.cells[0].textContent; // Obtener el valor de la primera columna (ID)
                    break;
                case 'nombre':
                    cellValue = row.cells[1].textContent + " " + row.cells[2].textContent; // Concatenar nombre y apellido
                    break;
                case 'departamento':
                    cellValue = row.cells[5].textContent; // Obtener el valor de la columna Departamento
                    break;
                case 'rol':
                    cellValue = row.cells[6].textContent; // Obtener el valor de la columna Rol
                    break;
            }

            // Comparar si el valor de la celda contiene lo que buscamos
            if (cellValue.toLowerCase().includes(searchValue)) {
                row.style.display = ''; // Mostrar la fila si hay coincidencia
            } else {
                row.style.display = 'none'; // Ocultar la fila si no hay coincidencia
            }
        }
    });
</script>

@endsection
