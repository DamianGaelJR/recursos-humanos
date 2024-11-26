<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Fondo de la página con degradado */
        body {
            
            background: linear-gradient(120deg, #012E40, #024959, #026773);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        /* Estilo del formulario */
        .login-form {
            background: linear-gradient(135deg, #026773, #3CA6A6);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        /* Botón de inicio de sesión */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Sombra en el botón al pasar el cursor */
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Texto de registro */
        .register-link {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2 class="text-center text-white">Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label text-white">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
        <p class="mt-3 text-center text-white">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="register-link">Regístrate</a>
        </p>
    </div>
</body>
</html>
