<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Proyecto galpones de pollo</title>
    <link  rel="icon"  type="image/jpeg" href="pollo2.jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstr -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: #f5f7fa;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        /* Encabezado */
        .header-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .header-box img {
            max-height: 110px;
        }

        .header-title {
            font-weight: 700;
            font-size: 24px;
            color: #333;
        }

        /* Imagen principal */
        .main-img {
            border-radius: 15px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.10);
        }

        /* Tarjeta de login */
        .login-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.10);
        }

        .login-card h3 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        button.btn-warning {
            width: 100%;
            font-weight: bold;
            border-radius: 10px;
        }

        footer {
            margin-top: 40px;
            padding: 15px;
            background: #ffffff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.07);
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Encabezado -->
        <div class="header-box text-center">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="imagenes/pollo2.jpeg" class="img-fluid" alt="">
                </div>

                <div class="col-md-6">
                    <h3 class="header-title">
                        PROYECTO DE GALPONES PARA POLLOS <br>
                        NORTE DE SAN TANDER
                    </h3>
                </div>

                <div class="col-md-3">
                    <img src="imagenes/galpo2.jpeg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

        <!-- Contenido -->
        <div class="row mt-4">

            <!-- Imagen bienvenida -->
            <div class="col-md-8 text-center mt-4">
                <h2 style="font-weight:600;">Bienvenido</h2>
                <img src="imagenes/galpon.jpeg" class="img-fluid main-img" alt="">
            </div>

            <!-- Login -->
            <div class="col-md-4">
                <div class="login-card mt-4">
                    <h3>Iniciar sesión</h3>

                    <form action="modelo/login.php" method="POST">

                        <label>Usuario</label>
                        <input type="text" name="usuario" class="form-control mb-3" required>

                        <label>Contraseña</label>
                        <input type="password" name="contrasena" class="form-control mb-2" required>

                        <a href="#" style="font-size: 13px;">¿Has olvidado tu contraseña?</a>

                        <button type="submit" class="btn btn-warning mt-3">Iniciar sesión</button>

                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-5">
            <p>SISTEMA Version 1.0 © Galpónes 2025 - Norte de Santander</p>
            <p>Desarrollado por: Carlos Javier Lopez - Cúcuta</p>
            <p>Dominio de pruebas para desarrollo he implementación</p>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>