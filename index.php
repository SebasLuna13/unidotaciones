<?php
require 'conexion.php';
session_start();

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $consulta = "SELECT * FROM usuario WHERE user='$user' AND pass='$pass'";
    $ejecutar = mysqli_query($enlace, $consulta);
    $row = mysqli_fetch_array($ejecutar);

    if ($row) {
        $id_usuario = $row[0];
        $rol = $row[2];

        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['rol'] = $rol;

        switch ($rol) {
            case 'comercial':
            case 'comercial2':
            case 'comercial3':
            case 'comercial4':
                header("Location: usuarios/comercial/inicio_comercial.php?id_usuario=$id_usuario");
                exit();
            case 'compras':
                header("Location: usuarios/compras/inicio_compras.php?id_usuario=$id_usuario");
                exit();
            case 'costeo':
                header("Location: usuarios/costeo/inicio_costeo.php?id_usuario=$id_usuario");
                exit();
            case 'diseño':
                header("Location: usuarios/diseño/inicio_diseño.php?id_usuario=$id_usuario");
                exit();
            case 'inventario':
                header("Location: usuarios/inventario/inicio_inventario.php?id_usuario=$id_usuario");
                exit();
            case 'produccion':
                header("Location: usuarios/produccion/inicio_produccion.php?id_usuario=$id_usuario");
                exit();

            default:
                break;
        }
    } else {
        $error_message = 'Error de autenticación, vuelva a intentar';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/png" href="img/Logo.png">

    <title>Unidotaciones</title>
</head>

<body>
    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/Logo.png" alt="Logo" width="70" height="50" class="rounded img-fluid d-inline-block align-text-top">
            </a>
        </div>
    </nav>
    <!-- medio -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-4">
                <!-- Contorno -->
                <div class="card border-2 shadow-lg rounded-4 overflow-hidden">
                    <div class="text-center">
                        <img src="img/Logot.png" alt="" width="150" height="150" class="rounded img-fluid d-inline-block align-text-top">

                        <p class="mb-0 small opacity-75">
                            Inicia sesión para continuar
                        </p>
                    </div>
                    
                    <!-- Formulario -->
                    <div class="card-body p-4">

                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo $error_message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="post" name="Formulario">
                            <div class="mb-4">
                                <label for="user" class="form-label fw-semibold">Usuario:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </span>
                                    <input type="text" name="user" id="user" class="form-control py-2" placeholder="Ingresa tu usuario" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Contraseña:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-lock-fill text-primary"></i>
                                    </span>
                                    <input type="password" name="pass" id="password" class="form-control py-2" placeholder="Ingresa tu contraseña" required>
                                </div>
                            </div>

                            <!-- Botón -->
                            <div class="d-grid">
                                <button type="submit"
                                    class="btn btn-primary btn-lg rounded-3 fw-semibold shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>