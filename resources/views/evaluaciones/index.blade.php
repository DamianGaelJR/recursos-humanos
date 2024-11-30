@extends('layouts.app')

@section('title', 'Evaluaciones')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Lista de Evaluaciones</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center mb-4">{{ session('error') }}</div>
    @endif

    <!-- Barra de búsqueda y botón -->
    <div class="d-flex justify-content-between mb-4">
        <div class="d-flex">
            <select id="filterField" class="form-select me-2" style="width: 180px;">
                <option value="id">Buscar por ID</option>
                <option value="nombre">Buscar por Nombre</option>
                <option value="fecha">Buscar por Fecha</option>
                <option value="calificacion">Buscar por Calificación</option>
            </select>
            <input type="text" id="searchInput" class="form-control" placeholder="Escribe para buscar..." oninput="filterTable()">
        </div>
        <a href="{{ route('evaluaciones.create') }}" class="btn-custom">Registrar Evaluación</a>
    </div>

    <!-- Tabla de evaluaciones -->
    <div class="table-container">
        <table class="styled-table" id="evaluacionesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Fecha</th>
                    <th>Calificación</th>
                    <th>Comentarios</th>
                    <!--th>Acciones</th-->
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
                    <!--td>
                        <form action="{{ route('evaluaciones.destroy', $evaluacion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-custom btn-sm delete" onclick="return confirm('¿Estás seguro de eliminar esta evaluación?')">Eliminar</button>
                        </form>
                    </td-->
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No se encontraron evaluaciones.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const filterField = document.getElementById("filterField").value;
        const rows = document.querySelectorAll("#evaluacionesTable tbody tr");

        rows.forEach(row => {
            const cells = row.getElementsByTagName("td");
            let text = "";

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
            }

            row.style.display = text.toLowerCase().includes(input) ? "" : "none";
        });
    }
</script>
@endsection
