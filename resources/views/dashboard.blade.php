@extends('layouts.app')

@section('title', 'Bienvenido a Recursos Humanos')

@section('content')
<div class="welcome-container">
    <div class="content-overlay">
        <div class="text-center">
            <h1 style="font-size: 3rem; font-weight: bold; color: #f5f5f5;">Bienvenido a Recursos Humanos</h1>
            <p style="font-size: 1.5rem; font-style: italic; color: #f5f5f5; margin-top: 20px;">
                "El éxito no se logra solo, sino trabajando juntos con pasión y dedicación."
            </p>
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

    /* Texto del título y frase */
    .text-center h1 {
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .text-center p {
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
    }

    /* Ajuste responsivo */
    @media (max-width: 768px) {
        .text-center h1 {
            font-size: 2rem;
        }

        .text-center p {
            font-size: 1.2rem;
        }
    }
</style>
@endsection
