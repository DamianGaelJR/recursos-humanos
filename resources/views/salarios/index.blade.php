@extends('layouts.app')

@section('title', 'Salarios')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Salarios</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <!-- Formulario de búsqueda -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <form action="{{ route('salarios.index') }}" method="GET" class="d-flex align-items-center" id="searchForm">
            <!-- Menú desplegable para elegir el campo de búsqueda -->
            <select name="campo" class="form-select me-2" id="searchField" style="width: 150px;">
                <option value="id" {{ request('campo') == 'id' ? 'selected' : '' }}>ID</option>
                <option value="empleado" {{ request('campo') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                <option value="salario" {{ request('campo') == 'salario' ? 'selected' : '' }}>Salario</option>
                <option value="fecha_registro" {{ request('campo') == 'fecha_registro' ? 'selected' : '' }}>Fecha de Registro</option>
            </select>

            <!-- Barra de búsqueda -->
            <input type="text" name="valor" class="form-control me-2" id="searchValue" placeholder="Buscar salario..." value="{{ request('valor') }}">
        </form>

        <!-- Botón para registrar salario -->
        <a href="{{ route('salarios.create') }}" class="btn-custom">Registrar Salario</a>
    </div>

    <!-- Tabla estilizada de salarios -->
    <div class="table-container">
        <table class="styled-table" id="salariosTable">
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
                <!-- Iterar salarios desde el controlador -->
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
<script>
    // Obtener los elementos relevantes
    const searchField = document.getElementById('searchField');
    const searchValue = document.getElementById('searchValue');
    const table = document.getElementById('salariosTable');
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
                case 'empleado':
                    match = (cells[1].innerText.toLowerCase().includes(valor));
                    break;
                case 'salario':
                    match = (cells[2].innerText.replace(/[^0-9.]/g, '').toLowerCase().includes(valor)); // Filtramos el símbolo de dólar
                    break;
                case 'fecha_registro':
                    match = (cells[3].innerText.toLowerCase().includes(valor));
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