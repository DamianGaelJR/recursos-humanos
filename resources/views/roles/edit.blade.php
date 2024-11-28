@extends('layouts.app')

@section('title', 'Editar Rol')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 600; color: #2C3E50;">Editar Rol</h1>

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

    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="form-container p-4 bg-light rounded shadow-sm">
        @csrf
        @method('PUT')

        {{-- Nombre del rol --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Rol</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $role->nombre) }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Descripción del rol --}}
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $role->descripcion) }}</textarea>
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-submit">Actualizar</button>
            <a href="{{ route('roles.index') }}" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
