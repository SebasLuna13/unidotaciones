<?php
    require_once('../../conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'costeo'){
            header("Location: inicio_costeo.php");
        }
    }

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
        
        <title>Costeo | Reportes</title>
    <head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%);">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="navbar-brand text-center" href="inicio_costeo.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 60px;">
                    </a>
                </div>
                <hr class="sidebar-divider my-0 bg-white opacity-50">
                
                <!-- MENU -->
                <div class="px-2 mt-3">
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="inicio_costeo.php">
                            <i class="bi bi-clipboard-data-fill"></i><span>Realizar Cotización</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedido_confirmado.php">
                            <i class="bi bi-ui-checks sidebar-icon"></i><span>Cotizaciones Realizadas</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedidos_finalizados.php">
                            <i class="bi bi-bag-check-fill sidebar-icon"></i><span>Pedidos Finalizados</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedidos_inactivos.php">
                            <i class="bi bi-bag-x-fill sidebar-icon"></i><span>Pedidos Inactivos</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="pedidos_pausados.php">
                            <i class="bi bi-pause-circle-fill sidebar-icon"></i><span>Pedidos en Pausa</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseManoObra" aria-expanded="false">
                            <div class="d-flex align-items-center w-100">
                                <div>
                                    <i class="bi bi-universal-access sidebar-icon"></i><span>Mano de Obra</span>
                                </div>
                                <i class="bi bi-chevron-down ms-auto small"></i>
                            </div>
                        </a>

                        <div id="collapseManoObra" class="collapse" data-bs-parent="#accordionSidebar">
                            <div class="collapse-inner rounded bg-white shadow-sm py-2">
                                <h6 class="collapse-header text-primary fw-bold">Tipo de Prenda</h6>

                                <?php
                                $consulta = "SELECT id_tipo_prenda, tipo_prenda FROM tipo_prenda WHERE id_tipo_prenda > 0";
                                $resultado = mysqli_query($enlace, $consulta);

                                if ($resultado->num_rows > 0) {
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '
                                        <a class="collapse-item text-wrap" href="mano_obra.php?id_tipo_prenda=' . $fila["id_tipo_prenda"] . '">' . $fila["tipo_prenda"] . '
                                        </a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="acabado.php">
                            <i class="bi bi-brush-fill sidebar-icon"></i><span>Tipos de Acabado</span>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="reportes_costeo.php">
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
                    $consulta = "SELECT reportes.ganancia_actual, reportes.ganancia_pasada, 
                    reportes.ventas_ene, reportes.ventas_feb, reportes.ventas_mar, reportes.ventas_abr, reportes.ventas_may, reportes.ventas_jun, reportes.ventas_jul, reportes.ventas_ago, reportes.ventas_sep, reportes.ventas_oct, reportes.ventas_nov, reportes.ventas_dic,
                    reportes.pasado_ene, reportes.pasado_feb, reportes.pasado_mar, reportes.pasado_abr, reportes.pasado_may, reportes.pasado_jun, reportes.pasado_jul, reportes.pasado_ago, reportes.pasado_sep, reportes.pasado_oct, reportes.pasado_nov, reportes.pasado_dic
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
                                                    <i class="bi bi-bank fa-2x text-gray-300"></i>
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
                                                    <i class="bi bi-cash fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-coin fa-2x text-gray-300"></i>
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
                                                    <i class="bi bi-cash fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <i class="bi bi-coin fa-2x text-gray-300"></i>
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
    </body>
</html>