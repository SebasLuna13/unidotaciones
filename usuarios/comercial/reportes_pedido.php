<?php
    require_once('../../conexion.php');
    session_start();

    $roles_permitidos = ['comercial', 'comercial2', 'comercial3', 'comercial4', 'comercial5'];

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
        exit;
    }

    if (!in_array($_SESSION['rol'], $roles_permitidos)) {
        header("Location: inicio_comercial.php");
        exit;
    }

    $id_usuario = $_SESSION['id_usuario'];

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    $consulta = "INSERT INTO reportes (id_reporte, ganancia_actual, ganancia_pasada, ventas_ene, ventas_feb, ventas_mar, ventas_abr, ventas_may, ventas_jun, ventas_jul, ventas_ago, ventas_sep, ventas_oct, ventas_nov, ventas_dic, 
    pasado_ene, pasado_feb, pasado_mar, pasado_abr, pasado_may, pasado_jun, pasado_jul, pasado_ago, pasado_sep, pasado_oct, pasado_nov, pasado_dic)
    VALUES (1,
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE(), '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0)
    )
    ON DUPLICATE KEY UPDATE
        ganancia_actual = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE(), '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        ganancia_pasada = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_ene = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_feb = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_mar = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_abr = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_may = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_jun = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_jul = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_ago = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_sep = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_oct = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_nov = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_dic = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_ene = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_feb = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_mar = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_abr = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_may = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_jun = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_jul = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_ago = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_sep = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_oct = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_nov = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_dic = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0)";

    $resultado = mysqli_query($enlace, $consulta);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

        <!-- Datatables -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.8/af-2.7.1/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cr-2.1.2/cc-1.2.1/date-1.6.3/fc-5.0.5/fh-4.0.6/kt-2.12.2/r-3.0.8/rg-1.6.0/rr-1.5.1/sc-2.4.3/sb-1.8.4/sp-2.3.5/sl-3.1.3/sr-1.4.3/datatables.min.css" rel="stylesheet" integrity="sha384-1o7sFw27lA5gA0UkeloH1lchqgpZ0RIBKb7SPql28Hfwm0AZG+SwyquMZmkHjbW8" crossorigin="anonymous">

        <!-- Para los estilos -->
        <link rel="stylesheet" href="../../css/barra.css">
        <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="../../img/Logo.png">
        
        <title>Comercial | Reportes Comercial</title>
    <head>

    <body id="page-top">
        <?php
        $consulta = "SELECT id_usuario FROM usuario ";
        ?>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion shadow" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%); min-height: 100vh;">
                <!-- LOGO -->
                <div class="d-flex justify-content-center align-items-center">
                    <!-- PC -->
                    <a class="navbar-brand d-none d-md-block text-center" href="inicio_comercial.php?id_usuario=<?php echo $id_usuario; ?>">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 80px;">
                    </a>

                    <!-- Mobile -->
                    <a class="navbar-brand d-block d-md-none text-center" href="inicio_comercial.php?id_usuario=<?php echo $id_usuario; ?>">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 60px;">
                    </a>
                </div>
                <hr class="sidebar-divider my-0 bg-white opacity-50">

                <!-- MENU -->
                <div class="px-2 mt-3">
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="inicio_comercial.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-list-ul sidebar-icon"></i><span>Registro de Visitas</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClientes">
                            <div class="d-flex align-items-center w-100">
                                <div>
                                    <i class="bi bi-people-fill sidebar-icon"></i><span>Gestión de Clientes</span>
                                </div>
                                <i class="bi bi-chevron-down ms-auto small"></i>
                            </div>
                        </a>
                        <div id="collapseClientes" class="collapse" data-bs-parent="#accordionSidebar">
                            <div class="collapse-inner rounded bg-white shadow-sm py-2">
                                <h6 class="collapse-header text-primary fw-bold">Tipos de Clientes</h6>

                                <?php
                                $consulta = "SELECT id_entidad, tipo_entidad FROM entidad";
                                $resultado = mysqli_query($enlace, $consulta);

                                if ($resultado->num_rows > 0) {
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '
                                        <a class="collapse-item text-wrap" href="clientes.php?id_entidad=' . $fila["id_entidad"] . '&id_usuario=' . $id_usuario . '"> ' . $fila["tipo_entidad"] . '
                                        </a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePrendas" aria-expanded="false">
                            <div class="d-flex align-items-center w-100">
                                <div>
                                    <i class="bi bi-universal-access sidebar-icon"></i><span>Gestión de Prendas</span>
                                </div>
                                <i class="bi bi-chevron-down ms-auto small"></i>
                            </div>
                        </a>

                        <div id="collapsePrendas" class="collapse" data-bs-parent="#accordionSidebar">
                            <div class="collapse-inner rounded bg-white shadow-sm py-2">
                                <h6 class="collapse-header text-primary fw-bold">Tipo de Prenda</h6>

                                <?php
                                $consulta = "SELECT id_tipo_prenda, tipo_prenda FROM tipo_prenda WHERE id_tipo_prenda > 0";
                                $resultado = mysqli_query($enlace, $consulta);

                                if ($resultado->num_rows > 0) {
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '
                                        <a class="collapse-item text-wrap" href="prendas.php?id_tipo_prenda=' . $fila["id_tipo_prenda"] . '">' . $fila["tipo_prenda"] . '
                                        </a>';
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="solicitudes.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-file-text sidebar-icon"></i><span>Solicitud de Cotizaciones</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedido_confirmado_comercial.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-ui-checks sidebar-icon"></i><span>Pedidos por Confirmar</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedidos_activos.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-bag-fill sidebar-icon"></i><span>Pedidos Aceptados</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedidos_finalizadosC.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-bag-check-fill sidebar-icon"></i><span>Pedidos Finalizados</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="reportes_pedido.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-speedometer2 sidebar-icon"></i><span>Reporte</span>
                        </a>
                    </li>

                </div>
            </ul>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <ul class="navbar-nav ml-auto">
                            <div class="navbar-nav mr-auto">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSalir">Cerrar Sesión <i class="bi bi-box-arrow-right"></i></button>
                                <!-- Modal Salir -->
                                <div class="modal fade" id="modalSalir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de salir?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-warning" role="alert">
                                                    Al cerrar la sesión, se desconectará de su cuenta actual. ¿Desea continuar?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="../../salir.php">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sí, cerrar sesión</button>
                                                </a>
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </nav>
                    <?php
                        $consulta = "SELECT reportes.ganancia_actual, reportes.ganancia_pasada, reportes.ventas_ene, reportes.ventas_feb, reportes.ventas_mar, reportes.ventas_abr, reportes.ventas_may, reportes.ventas_jun, reportes.ventas_jul, reportes.ventas_ago, reportes.ventas_sep, reportes.ventas_oct, 
                        reportes.ventas_nov, reportes.ventas_dic, reportes.pasado_ene, reportes.pasado_feb, reportes.pasado_mar, reportes.pasado_abr, reportes.pasado_may, reportes.pasado_jun, reportes.pasado_jul, reportes.pasado_ago, reportes.pasado_sep, reportes.pasado_oct, reportes.pasado_nov, reportes.pasado_dic
                        FROM reportes ";
                        $resultado = mysqli_query($enlace, $consulta);
                        $fila = mysqli_fetch_array($resultado)
                    ?>

                    

                    <!-- medio -->
                    <div class="text-center mt-3">
                        <h1 style="font-family: 'Times New Roman'">Reportes</h1>
                    </div>

                    <!-- Promedios -->
                    <div class="container">
                        <div class="mb-1 mt-1 text-center border rounded p-1">
                            <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Ponderados de Ventas</h6>
                            <div class="mb-2 row justify-content-center">
                                <div class="row">
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ingresos Actuales</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ganancia_actual'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-secondary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div> 
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Ingresos del Año Pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ganancia_pasada'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                    </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-piggy-bank-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ventas meses Actuales -->
                        <div class="mb-1 mt-1 text-center border rounded p-1">
                            <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Porcentaje de Ventas por Mes</h6>
                            <div class="mb-2 row justify-content-center">
                                <div class="row">
                                    <!--Enero -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas de Enero</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_ene'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosEneroModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosEneroModal" tabindex="-1" role="dialog" aria-labelledby="productosEneroModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosEneroModalLabel" style="color: white; text-align: center;">Productos Entregados en Enero</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 1 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Febrero -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas de Febrero</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_feb'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosFebModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosFebModal" tabindex="-1" role="dialog" aria-labelledby="productosFebModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosFebModalLabel" style="color: white; text-align: center;">Productos Entregados en Febrero</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 2 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Marzo -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas de Marzo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_mar'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosMarModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosMarModal" tabindex="-1" role="dialog" aria-labelledby="productosMarModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosMarModalLabel" style="color: white; text-align: center;">Productos Entregados en Marzo</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 3 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Abril -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas de Abril</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_abr'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosAbrModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosAbrModal" tabindex="-1" role="dialog" aria-labelledby="productosAbrModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosAbrModalLabel" style="color: white; text-align: center;">Productos Entregados en Abril</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 4 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Mayo -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas de mayo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_may'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosMayModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosMayModal" tabindex="-1" role="dialog" aria-labelledby="productosMayModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosMayModalLabel" style="color: white; text-align: center;">Productos Entregados en Mayo</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 5 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Junio -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas de junio</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_jun'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosJunModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosJunModal" tabindex="-1" role="dialog" aria-labelledby="productosJunModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosJunModalLabel" style="color: white; text-align: center;">Productos Entregados en Junio</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en junio del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                            FROM producto 
                                                                            LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                            LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                            LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                            WHERE MONTH(producto.fecha_finalizado) = 6 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Julio -->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas de julio</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_jul'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosJulModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosJulModal" tabindex="-1" role="dialog" aria-labelledby="productosJulModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosJulModalLabel" style="color: white; text-align: center;">Productos Entregados en Julio</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 7 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Agosto-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas de agosto</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_ago'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosAgoModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosAgoModal" tabindex="-1" role="dialog" aria-labelledby="productosAgoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosAgoModalLabel" style="color: white; text-align: center;">Productos Entregados en Agosto</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 8 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Septiembre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas de septiembre</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_sep'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosSepModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosSepModal" tabindex="-1" role="dialog" aria-labelledby="productosSepModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosSepModalLabel" style="color: white; text-align: center;">Productos Entregados en Septiembre</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 9 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Octubre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas de octubre</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_oct'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosOctModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosOctModal" tabindex="-1" role="dialog" aria-labelledby="productosOctModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosOctModalLabel" style="color: white; text-align: center;">Productos Entregados en Octubre</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 10 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Noviembre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas de noviembre</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_nov'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosNovModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosNovModal" tabindex="-1" role="dialog" aria-labelledby="productosNovModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosNovModalLabel" style="color: white; text-align: center;">Productos Entregados en Noviembre</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 11 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--diciembre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas de diciembre</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['ventas_dic'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosDicModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosDicModal" tabindex="-1" role="dialog" aria-labelledby="productosDicModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosDicModalLabel" style="color: white; text-align: center;">Productos Entregados en Diciembre</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 12 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE)";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ventas meses Año Pasado -->
                        <div class="mb-1 mt-1 text-center border rounded p-1">
                            <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Porcentaje de Ventas por Meses del Año Pasado</h6>
                            <div class="mb-2 row justify-content-center">
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Enero del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_ene'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosEnePModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosEnePModal" tabindex="-1" role="dialog" aria-labelledby="productosEnePModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosEnePModalLabel" style="color: white; text-align: center;">Productos Entregados en Enero del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 1 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--febrero-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Febrero del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_feb'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosFebPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosFebPModal" tabindex="-1" role="dialog" aria-labelledby="productosFebPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosFebPModalLabel" style="color: white; text-align: center;">Productos Entregados en Febrero del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 2 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Marzo-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Marzo del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_mar'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosMarPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosMarPModal" tabindex="-1" role="dialog" aria-labelledby="productosMarPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosMarPModalLabel" style="color: white; text-align: center;">Productos Entregados en Marzo del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 3 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Abril-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Abril del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_abr'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosAbrPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosAbrPModal" tabindex="-1" role="dialog" aria-labelledby="productosAbrPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosAbrPModalLabel" style="color: white; text-align: center;">Productos Entregados en Abril del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 4 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Mayo-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">mayo del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_may'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosMayPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosMayPModal" tabindex="-1" role="dialog" aria-labelledby="productosMayPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosMayPModalLabel" style="color: white; text-align: center;">Productos Entregados en Mayo del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 5 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--junio-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">junio del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_jun'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosJunPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosJunPModal" tabindex="-1" role="dialog" aria-labelledby="productosJunPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosJunPModalLabel" style="color: white; text-align: center;">Productos Entregados en Julio del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 6 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Julio-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">julio del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_jul'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosJulPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosJulPModal" tabindex="-1" role="dialog" aria-labelledby="productosJulPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosJulPModalLabel" style="color: white; text-align: center;">Productos Entregados en Julio del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 7 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Agosto-->
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">agosto del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_ago'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosAgoPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosAgoPModal" tabindex="-1" role="dialog" aria-labelledby="productosAgoPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosAgoPModalLabel" style="color: white; text-align: center;">Productos Entregados en Agosto del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 8 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Septiembre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">septiembre del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_sep'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosSepPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosSepPModal" tabindex="-1" role="dialog" aria-labelledby="productosSepPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosSepPModalLabel" style="color: white; text-align: center;">Productos Entregados en Septiembre del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 9 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Octubre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">octubre del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_oct'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosOctPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosOctPModal" tabindex="-1" role="dialog" aria-labelledby="productosOctPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosOctPModalLabel" style="color: white; text-align: center;">Productos Entregados en Octubre del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 10 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Noviembre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">noviembre del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_nov'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosNovPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosNovPModal" tabindex="-1" role="dialog" aria-labelledby="productosNovPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosNovPModalLabel" style="color: white; text-align: center;">Productos Entregados en Noviembre del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto 
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 11 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Diciembre-->
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">diciembre del Año pasado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php $precio_formateado = number_format($fila['pasado_dic'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#productosDicPModal">
                                                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="productosDicPModal" tabindex="-1" role="dialog" aria-labelledby="productosDicPModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="productosDicPModalLabel" style="color: white; text-align: center;">Productos Entregados en Diciembre del año Pasado</h5>
                                                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    // Consulta SQL para obtener los productos entregados en enero del año actual
                                                    $consulta_productos = "SELECT producto.id_producto, producto.precio_total, producto.fecha_finalizado, prenda.nombre_prenda, cliente.cliente, producto.nombre_producto
                                                                                FROM producto 
                                                                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                                WHERE MONTH(producto.fecha_finalizado) = 12 AND YEAR(producto.fecha_finalizado) = YEAR(CURRENT_DATE) - 1";
                                                    $resultado_productos = mysqli_query($enlace, $consulta_productos);
                                                    while ($fila_producto = mysqli_fetch_array($resultado_productos)) {
                                                        echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                        echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Fecha y hora de entrega: ' . $fila_producto['fecha_finalizado'] . '</h6>';

                                                        if (isset($fila_producto['nombre_prenda']) && !empty($fila_producto['nombre_prenda'])) {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_prenda'] . '</p>';
                                                        } else {
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Producto:</span> ' . $fila_producto['nombre_producto'] . '</p>';
                                                        }

                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Cliente:</span> ' . $fila_producto['cliente'] . '</p>';
                                                        $precio_formateado = number_format($fila_producto['precio_total'], 2, ',', '.');
                                                        echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Precio Total:</span> <span style="color: #FF0000;">$' . $precio_formateado . '</span></p>';

                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        
        <!-- Datatables -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.8/af-2.7.1/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cr-2.1.2/cc-1.2.1/date-1.6.3/fc-5.0.5/fh-4.0.6/kt-2.12.2/r-3.0.8/rg-1.6.0/rr-1.5.1/sc-2.4.3/sb-1.8.4/sp-2.3.5/sl-3.1.3/sr-1.4.3/datatables.min.js" integrity="sha384-XCTQyNrbAXZ28p4As7vVXvKGdi4hZcqfqw3LOoZdYriqxbs4EHeHmxLwlsz9DW4l" crossorigin="anonymous"></script>
    </body>
</html>