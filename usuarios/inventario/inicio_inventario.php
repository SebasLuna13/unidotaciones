<?php
    require_once('../../conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'inventario') {
            header("Location: inicio_inventario.php");
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
        
        <title>Inventario | Inicio Inventario</title>
    <head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion shadow" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%); min-height: 100vh;">
                <!-- LOGO -->
                <div class="d-flex justify-content-center align-items-center">
                    <!-- PC -->
                    <a class="navbar-brand d-none d-md-block text-center" href="inicio_inventario.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 80px;">
                    </a>

                    <!-- Mobile -->
                    <a class="navbar-brand d-block d-md-none text-center" href="inicio_inventario.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 60px;">
                    </a>
                </div>
                <hr class="sidebar-divider my-0 bg-white opacity-50">

                <!-- MENU -->
                <div class="px-2 mt-3">
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTelas">
                            <div class="d-flex align-items-center w-100">
                                <div>
                                    <i class="bi bi-journal-text sidebar-icon"></i><span>Telas</span>
                                </div>
                                <i class="bi bi-chevron-down ms-auto small"></i>
                            </div>
                        </a>
                        

                        <div id="collapseTelas" class="collapse" data-bs-parent="#accordionSidebar">
                            <div class="collapse-inner rounded bg-white shadow-sm py-2">
                                <h6 class="collapse-header text-primary fw-bold">Tipos de telas</h6>

                                <?php
                                $consulta = "SELECT id_tipo_tela, tipo_tela FROM tipo_tela WHERE id_tipo_tela > 0";
                                $resultado = mysqli_query($enlace, $consulta);

                                if ($resultado->num_rows > 0) {
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '<a class="collapse-item text-wrap" href="telas.php?id_tipo_tela=' . $fila["id_tipo_tela"] . '"> ' . $fila["tipo_tela"] . '
                                        </a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInsumos">
                            <div class="d-flex align-items-center w-100">
                                <div>
                                    <i class="bi bi-journal-text sidebar-icon"></i><span>Insumos</span>
                                </div>
                                <i class="bi bi-chevron-down ms-auto small"></i>
                            </div>
                        </a>

                        <div id="collapseInsumos" class="collapse" data-bs-parent="#accordionSidebar">
                            <div class="collapse-inner rounded bg-white shadow-sm py-2">
                                <h6 class="collapse-header text-primary fw-bold">Listado de insumos</h6>

                                <?php
                                $consulta = "SELECT id_tipoinsumo, nombre FROM tipo_insumo WHERE id_tipoinsumo > 0 ORDER BY nombre ASC";
                                $resultado = mysqli_query($enlace, $consulta);

                                if ($resultado->num_rows > 0) {
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo ' <a class="collapse-item text-wrap" href="insumos.php?id_tipoinsumo=' . $fila["id_tipoinsumo"] . '"> ' . $fila["nombre"] . '
                                        </a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link" href="prenda_comprada.php">
                            <i class="bi bi-bag-plus-fill"></i><span>Prendas Compradas</span>
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

                    <!-- medio -->
                    <div class="text-center mt-3">
                        <h1 style="font-family: 'Times New Roman'">Datos del Inventario</h1>
                    </div><br>

                    <!-- Promedios -->
                    <div class="container">
                        <div class="mb-1 mt-1 text-center border rounded p-1">
                            <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Cantidad de Proveedores</h6>
                            <div class="mb-2 row justify-content-center">
                                <div class="row">
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proveedores de insumos</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_proveedor)-1) AS total_proveedores FROM proveedor";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_proveedores = mysqli_fetch_assoc($resultado)['total_proveedores'];
                                                        echo $cantidad_proveedores;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-person-video2 fa-2x text-gray-300"></i>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-auto">
                                        <div class="card border-left-secondary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Proveedores de Telas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_proveedor)-1) AS total_proveedores FROM proveedor_tela";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_proveedores = mysqli_fetch_assoc($resultado)['total_proveedores'];
                                                        echo $cantidad_proveedores;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">

                                                    <i class="bi bi-person-vcard-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 mt-1 text-center border rounded p-1">
                            <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Cantidad de Insumos</h6>
                            <div class="mb-2 row justify-content-center">
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">cantidad de tipos de bolsa</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_bolsa)-1) AS total_bolsa FROM bolsa";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_bolsa = mysqli_fetch_assoc($resultado)['total_bolsa'];
                                                        echo $cantidad_bolsa;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">cantidad de tipos de botones</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_boton)-1) AS total_boton FROM boton";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_boton = mysqli_fetch_assoc($resultado)['total_boton'];
                                                        echo $cantidad_boton;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de broche</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_broche)-1) AS total_broche FROM broche";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_broche = mysqli_fetch_assoc($resultado)['total_broche'];
                                                        echo $cantidad_broche;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de cinta Faya</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_faya)-1) AS total_faya FROM cinta_faya";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_faya = mysqli_fetch_assoc($resultado)['total_faya'];
                                                        echo $cantidad_faya;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de cinta reflectiva</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_cinta)-1) AS total_cinta FROM cinta_reflectiva";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_cinta = mysqli_fetch_assoc($resultado)['total_cinta'];
                                                        echo $cantidad_cinta;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de cordon</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_cordon)-1) AS total_cordon FROM cordon";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_cordon = mysqli_fetch_assoc($resultado)['total_cordon'];
                                                        echo $cantidad_cordon;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de cremalleras</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_cremallera)-1) AS total_cremallera FROM cremallera";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_cremallera = mysqli_fetch_assoc($resultado)['total_cremallera'];
                                                        echo $cantidad_cremallera;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de cuellos</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_cuello)-1) AS total_cuello FROM cuello";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_cuello = mysqli_fetch_assoc($resultado)['total_cuello'];
                                                        echo $cantidad_cuello;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de entretela</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_entretela)-1) AS total_entretela FROM entretela";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_entretela = mysqli_fetch_assoc($resultado)['total_entretela'];
                                                        echo $cantidad_entretela;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de fusionado</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_fusionado)-1) AS total_fusionado FROM fusionado";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_fusionado = mysqli_fetch_assoc($resultado)['total_fusionado'];
                                                        echo $cantidad_fusionado;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de guata</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_guata)-1) AS total_guata FROM guata";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_guata = mysqli_fetch_assoc($resultado)['total_guata'];
                                                        echo $cantidad_guata;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de hombreras</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_hombrera)-1) AS total_hombrera FROM hombrera";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_hombrera = mysqli_fetch_assoc($resultado)['total_hombrera'];
                                                        echo $cantidad_hombrera;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de marquilla</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT id_marquilla AS total_marquilla FROM marquilla";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_marquilla = mysqli_fetch_assoc($resultado)['total_marquilla'];
                                                        echo $cantidad_marquilla;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de plumilla</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_plumilla)-1) AS total_plumilla FROM plumilla";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_plumilla = mysqli_fetch_assoc($resultado)['total_plumilla'];
                                                        echo $cantidad_plumilla;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de pretinas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_pretina)-1) AS total_pretina FROM pretina";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_pretina = mysqli_fetch_assoc($resultado)['total_pretina'];
                                                        echo $cantidad_pretina;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de punteras</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_puntera)-1) AS total_puntera FROM puntera";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_puntera = mysqli_fetch_assoc($resultado)['total_puntera'];
                                                        echo $cantidad_puntera;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                   
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de puños</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_puño)-1) AS total_puño FROM puño";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_puño = mysqli_fetch_assoc($resultado)['total_puño'];
                                                        echo $cantidad_puño;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de resortes</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_resorte)-1) AS total_resorte FROM resorte";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_resorte = mysqli_fetch_assoc($resultado)['total_resorte'];
                                                        echo $cantidad_resorte;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de sesgo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_sesgo)-1) AS total_sesgo FROM sesgo";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_sesgo = mysqli_fetch_assoc($resultado)['total_sesgo'];
                                                        echo $cantidad_sesgo;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de telas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_tela)-1) AS total_tela FROM tela";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_tela = mysqli_fetch_assoc($resultado)['total_tela'];
                                                        echo $cantidad_tela;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                        
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de trabillas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_trabilla)-1) AS total_trabilla FROM trabilla";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_trabilla = mysqli_fetch_assoc($resultado)['total_trabilla'];
                                                        echo $cantidad_trabilla;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de velcro</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_velcro)-1) AS total_velcro FROM velcro";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_velcro = mysqli_fetch_assoc($resultado)['total_velcro'];
                                                        echo $cantidad_velcro;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de vinilo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_vinilo)-1) AS total_vinilo FROM vinilo";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_vinilo = mysqli_fetch_assoc($resultado)['total_vinilo'];
                                                        echo $cantidad_vinilo;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body d-flex align-items-center">
                                                <div>
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de vivo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $consulta = "SELECT (COUNT(id_vivo)-1) AS total_vivo FROM vivo";
                                                        $resultado = mysqli_query($enlace, $consulta);
                                                        $cantidad_vivo = mysqli_fetch_assoc($resultado)['total_vivo'];
                                                        echo $cantidad_vivo;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
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