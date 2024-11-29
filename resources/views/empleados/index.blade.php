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
            <select name="campo" class="form-select me-2" id="searchField" style="width: 200px;">
                <option value="id" {{ request('campo') == 'id' ? 'selected' : '' }}>ID</option>
                <option value="nombre" {{ request('campo') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                <option value="apellido" {{ request('campo') == 'apellido' ? 'selected' : '' }}>Apellido</option>
                <option value="email" {{ request('campo') == 'email' ? 'selected' : '' }}>Correo</option>
                <option value="telefono" {{ request('campo') == 'telefono' ? 'selected' : '' }}>Teléfono</option>
                <option value="departamento" {{ request('campo') == 'departamento' ? 'selected' : '' }}>Departamento</option>
                <option value="rol" {{ request('campo') == 'rol' ? 'selected' : '' }}>Rol</option>
                <option value="fecha_contratacion" {{ request('campo') == 'fecha_contratacion' ? 'selected' : '' }}>Fecha de Contratación</option>
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
                    <td>{{ $empleado->email }}</td>
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

    <!-- Paginación -->
    <div class="mt-4">
        {{ $empleados->links() }}
    </div>
</div>

<script>
    // Filtrar empleados en tiempo real en la tabla
    document.getElementById('searchValue').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase(); // Obtener el valor de búsqueda
        let searchField = document.getElementById('searchField').value; // Obtener el campo seleccionado
        let rows = document.querySelectorAll('#empleadosTableBody tr'); // Todas las filas de la tabla

        // Iterar sobre las filas de la tabla
        for (let row of rows) {
            let cellValue = ''; // Inicializamos el valor de la celda que vamos a comparar

            // Dependiendo del campo de búsqueda seleccionado, obtenemos el valor de la celda
            switch (searchField) {
                case 'id':
                    cellValue = row.cells[0].textContent; // Valor de la columna ID
                    break;
                case 'nombre':
                    cellValue = row.cells[1].textContent; // Valor de la columna Nombre
                    break;
                case 'apellido':
                    cellValue = row.cells[2].textContent; // Valor de la columna Apellido
                    break;
                case 'email':
                    cellValue = row.cells[3].textContent; // Valor de la columna Email
                    break;
                case 'telefono':
                    cellValue = row.cells[4].textContent; // Valor de la columna Teléfono
                    break;
                case 'departamento':
                    cellValue = row.cells[5].textContent; // Valor de la columna Departamento
                    break;
                case 'rol':
                    cellValue = row.cells[6].textContent; // Valor de la columna Rol
                    break;
                case 'fecha_contratacion':
                    cellValue = row.cells[7].textContent; // Valor de la columna Fecha de Contratación
                    break;
            }

            // Comparar si el valor de la celda contiene el texto de búsqueda
            if (cellValue.toLowerCase().includes(searchValue)) {
                row.style.display = ''; // Mostrar la fila si hay coincidencia
            } else {
                row.style.display = 'none'; // Ocultar la fila si no hay coincidencia
            }
        }
    });
</script>
@endsection
