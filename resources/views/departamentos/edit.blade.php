@extends('layouts.app')

@section('title', 'Editar Departamento')

@section('content')
<div class="container mt-5 form-container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Editar Departamento</h4>
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

            <form action="{{ route('departamentos.update', $departamento) }}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- Campo Nombre --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $departamento->nombre }}" required>
                </div>
                
                {{-- Campo Descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ $departamento->descripcion }}</textarea>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-submit">Actualizar</button>
                    <a href="{{ route('departamentos.index') }}" class="btn btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
