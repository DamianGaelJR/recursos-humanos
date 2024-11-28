@extends('layouts.app')

@section('title', 'Evaluaciones')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Evaluaciones</h1>

    @if(session('success'))
    <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <!-- Barra de búsqueda y botón -->
    <div class="d-flex justify-content-between mb-4">
        <!-- Barra de búsqueda -->
        <div class="d-flex">
            <select id="filterField" class="form-select me-2" style="width: 180px;">
                <option value="id">Buscar por ID</option>
                <option value="nombre">Buscar por Nombre</option>
                <option value="fecha">Buscar por Fecha</option>
                <option value="calificacion">Buscar por Calificación</option>
            </select>
            <input type="text" id="searchInput" class="form-control" placeholder="Escribe para buscar..." oninput="filterTable()">
        </div>
        <!-- Botón para registrar evaluación -->
        <a href="{{ route('evaluaciones.create') }}" class="btn-custom">Registrar Evaluación</a>
    </div>

    <!-- Tabla estilizada de evaluaciones -->
    <div class="table-container">
        <table class="styled-table" id="evaluacionesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Fecha</th>
                    <th>Calificación</th>
                    <th>Comentarios</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse($evaluaciones as $evaluacion)
                <tr>
                    <td>{{ $evaluacion->id }}</td>
                    <td>{{ $evaluacion->empleado->nombre }} {{ $evaluacion->empleado->apellido }}</td>
                    <td>{{ $evaluacion->fecha }}</td>
                    <td>{{ $evaluacion->calificacion }}</td>
                    <td>{{ $evaluacion->comentarios }}</td>
                    <td class="actions">
                        <form action="{{ route('evaluaciones.destroy', $evaluacion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted text-center">No se encontraron evaluaciones.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Filtrar tabla según el campo seleccionado y el texto de búsqueda
    function filterTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const filterField = document.getElementById("filterField").value;
        const table = document.getElementById("evaluacionesTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let text = "";

            // Seleccionar la columna según el campo seleccionado
            switch (filterField) {
                case "id":
                    text = cells[0]?.textContent || "";
                    break;
                case "nombre":
                    text = cells[1]?.textContent || "";
                    break;
                case "fecha":
                    text = cells[2]?.textContent || "";
                    break;
                case "calificacion":
                    text = cells[3]?.textContent || "";
                    break;
                default:
                    text = "";
            }

            rows[i].style.display = text.toLowerCase().includes(input) ? "" : "none";
        }
    }
</script>
@endsection