@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')
<div class="container mt-5 form-container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Editar Empleado</h4>
        </div>
        <div class="card-body">
            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $empleado->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Apellido --}}
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido', $empleado->apellido) }}" required>
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Correo Electrónico --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $empleado->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $empleado->telefono) }}" required>
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Fecha de Contratación --}}
                <div class="mb-3">
                    <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                    <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control @error('fecha_contratacion') is-invalid @enderror" value="{{ old('fecha_contratacion', $empleado->fecha_contratacion) }}" required>
                    @error('fecha_contratacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Departamento --}}
                <div class="mb-3">
                    <label for="id_departamento" class="form-label">Departamento</label>
                    <select name="id_departamento" id="id_departamento" class="form-select @error('id_departamento') is-invalid @enderror" required>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" {{ $departamento->id == old('id_departamento', $empleado->id_departamento) ? 'selected' : '' }}>
                                {{ $departamento->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_departamento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Rol --}}
                <div class="mb-3">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select name="id_rol" id="id_rol" class="form-select @error('id_rol') is-invalid @enderror" required>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ $rol->id == old('id_rol', $empleado->id_rol) ? 'selected' : '' }}>
                                {{ $rol->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_rol')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-submit">Actualizar</button>
                    <a href="{{ route('empleados.index') }}" class="btn btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
