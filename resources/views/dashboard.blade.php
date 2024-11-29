@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<div class="welcome-container">
    <div class="content-overlay">
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">
            <!-- Tarjeta: Agregar Empleado -->
            <a href="{{ route('empleados.create') }}" class="card-container text-decoration-none">
                <div class="card-image">
                    <img src="https://th.bing.com/th/id/OIP.o5wooEZBaKg3Mbg1WH9daQHaDt?w=329&h=174&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                        alt="Agregar Empleado">
                    <div class="card-overlay">
                        <h5>Agregar Empleado</h5>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Dar de Baja -->
            <a href="{{ route('empleados.index') }}" class="card-container text-decoration-none">
                <div class="card-image">
                    <img src="https://th.bing.com/th/id/OIP.C37EUjTF_2ITxq2jH8oyyQHaHa?rs=1&pid=ImgDetMain"
                        alt="Dar de Baja">
                    <div class="card-overlay">
                        <h5>Dar de Baja</h5>
                    </div>
                </div>
            </a>
            
        </div>
    </div>
</div>

<style>
    /* Estilos del menú */
    .navbar {
        margin-bottom: 20px;
    }

    /* Contenedor principal con imagen de fondo */
    .welcome-container {
        background-image: url('https://th.bing.com/th/id/R.7049f96a7ab04d4ffe56f6b7a180dd31?rik=KXuBl64z1lEW%2fw&riu=http%3a%2f%2fwww.solofondos.com%2fwp-content%2fuploads%2f2015%2f11%2fFondos-para-paginas-web-profesionales-3D.jpg&ehk=lWv3MXhrf5twGIElvqeFkf1879q3Y4fb8nZFCm8U5hQ%3d&risl=&pid=ImgRaw&r=0');
        background-size: cover;
        background-position: center;
        height: 100vh;
        color: white;
        text-align: center;
    }

    .content-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    /* Estilo de las tarjetas */
    .card-container {
        position: relative;
        width: 300px;
        height: 200px;
        overflow: hidden;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .card-container:hover {
        transform: scale(1.05);
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        transition: opacity 0.3s ease-in-out;
    }

    .card-container:hover .card-image img {
        opacity: 0.7;
    }

    /* Superposición y sombra */
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        border-radius: 10px;
        transition: opacity 0.3s ease-in-out;
    }

    .card-container:hover .card-overlay {
        opacity: 1;
    }

    .card-overlay h5 {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 0px 2px 5px rgba(0, 0, 0, 0.7);
    }

    /* Flexbox para alinear horizontalmente */
    .d-flex {
        display: flex;
        justify-content: space-evenly;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 20px;
    }

    /* Ajuste responsivo */
    @media (max-width: 768px) {
        .card-container {
            width: 100%;
            max-width: 300px;
        }
    }
</style>
@endsection