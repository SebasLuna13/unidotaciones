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

    $id_tipoinsumo = 0;

    if (isset($_GET['id_tipoinsumo'])) {
        $id_tipoinsumo = intval($_GET['id_tipoinsumo']);
    }

    if (isset($_POST['submit_crear'])) {

        $id_tipoinsumo = intval($_POST['id_tipoinsumo']);

        $consulta_tipo = "SELECT tipo_insumo FROM tipo_insumo WHERE id_tipoinsumo = $id_tipoinsumo";
        $resultado_tipo = mysqli_query($enlace, $consulta_tipo);
        $fila_tipo = mysqli_fetch_assoc($resultado_tipo);

        $tabla = $fila_tipo['tipo_insumo'];

        $insumo = $_POST['insumo'];
        $medida = $_POST['medida'];
        $id_proveedor = $_POST['id_proveedor'];
        $precio = $_POST['precio'];
        $unidades = $_POST['unidades'];
        $fecha_actualizacion = date('Y-m-d'); 

        // 🔹 Query base
        $sql = "INSERT INTO $tabla 
            (insumo, medida, precio, fecha_actualizacion, unidades, id_proveedor, id_tipoinsumo) 
            VALUES 
            ('$insumo', '$medida', '$precio', '$fecha_actualizacion', '$unidades', '$id_proveedor', '$id_tipoinsumo')";

        // 🔹 AQUÍ va lo que preguntas
        $tablas_con_doble = ['boton', 'cremallera', 'entretela', 'resorte'];

        mysqli_query($enlace, $sql);

        if (in_array($tabla, $tablas_con_doble)) {
            $tabla2 = $tabla . "2";
            mysqli_query($enlace, str_replace($tabla, $tabla2, $sql));
        }

        header("Location: insumos.php?id_tipoinsumo=$id_tipoinsumo");
        exit();
    }

    if (isset($_POST['submit_editar'])) {

        // Datos del formulario
        $id_tipoinsumo = intval($_POST['id_tipoinsumo']);
        $id = intval($_POST['id']);
        $insumo = mysqli_real_escape_string($enlace, $_POST['insumo']);
        $medida = mysqli_real_escape_string($enlace, $_POST['medida']);
        $id_proveedor = intval($_POST['id_proveedor']);
        $precio = floatval($_POST['precio']);
        $unidades = intval($_POST['unidades']);

        // Obtener tipo de tabla
        $consulta_tipo = "SELECT tipo_insumo FROM tipo_insumo WHERE id_tipoinsumo = $id_tipoinsumo";
        $resultado_tipo = mysqli_query($enlace, $consulta_tipo);
        $fila_tipo = mysqli_fetch_assoc($resultado_tipo);

        $tabla = $fila_tipo['tipo_insumo'];

        // 🔥 Definir el campo ID correctamente
        $id_campo = "id_" . $tabla;

        // Casos especiales
        if ($tabla == 'cinta_faya') {
            $id_campo = "id_faya";
        } elseif ($tabla == 'cinta_reflectiva') {
            $id_campo = "id_cinta";
        }

        // Query principal
        $sql = "UPDATE $tabla SET insumo = '$insumo', medida = '$medida', id_proveedor = '$id_proveedor', precio = '$precio', unidades = '$unidades', fecha_actualizacion = NOW() WHERE $id_campo = '$id'";

        // 🔥 CASOS DOBLES (boton, cremallera, etc.)
        if ($tabla == 'boton' || $tabla == 'cremallera' || $tabla == 'entretela' || $tabla == 'resorte') {

            // Actualiza tabla principal
            mysqli_query($enlace, $sql);

            // Segunda tabla (ej: boton2)
            $tabla2 = $tabla . "2";
            $id_campo2 = "id_" . $tabla2;

            $sql2 = "UPDATE $tabla2 SET insumo = '$insumo', medida = '$medida', id_proveedor = '$id_proveedor', precio = '$precio', unidades = '$unidades', fecha_actualizacion = NOW() WHERE $id_campo2 = '$id'";

            mysqli_query($enlace, $sql2);

        } else {
            // Caso normal
            mysqli_query($enlace, $sql);
        }

        // Redirección
        header("Location: insumos.php?id_tipoinsumo=$id_tipoinsumo");
        exit();
    }
    
    if (isset($_POST['submit_eliminar'])) {

        // Datos del formulario
        $id_tipoinsumo = intval($_POST['id_tipoinsumo']);
        $id = intval($_POST['id']);

        // Obtener tipo de tabla
        $consulta_tipo = "SELECT tipo_insumo FROM tipo_insumo WHERE id_tipoinsumo = $id_tipoinsumo";
        $resultado_tipo = mysqli_query($enlace, $consulta_tipo);
        $fila_tipo = mysqli_fetch_assoc($resultado_tipo);

        $tabla = $fila_tipo['tipo_insumo'];

        // 🔥 Definir campo ID dinámico
        $id_campo = "id_" . $tabla;

        // Casos especiales
        if ($tabla == 'cinta_faya') {
            $id_campo = "id_faya";
        } elseif ($tabla == 'cinta_reflectiva') {
            $id_campo = "id_cinta";
        }

        // Query principal
        $sql = "DELETE FROM $tabla WHERE $id_campo = '$id'";

        // 🔥 CASOS DOBLES
        if ($tabla == 'boton' || $tabla == 'cremallera' || $tabla == 'entretela' || $tabla == 'resorte') {

            // Eliminar en tabla principal
            mysqli_query($enlace, $sql);

            // Segunda tabla (ej: boton2)
            $tabla2 = $tabla . "2";
            $id_campo2 = "id_" . $tabla2;

            $sql2 = "DELETE FROM $tabla2 WHERE $id_campo2 = '$id'";

            mysqli_query($enlace, $sql2);

        } else {
            // Caso normal
            mysqli_query($enlace, $sql);
        }

        // Redirección
        header("Location: insumos.php?id_tipoinsumo=$id_tipoinsumo");
        exit();
    }
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
        
        <title>Inventario | Inventario de Insumos</title>
    <head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%);">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="navbar-brand text-center" href="inicio_inventario.php">
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
                                        echo '<a class="collapse-item text-wrap" href="telas_inventario.php?id_tipo_tela=' . $fila["id_tipo_tela"] . '"> ' . $fila["tipo_tela"] . '
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
                                        echo ' <a class="collapse-item text-wrap" href="insumos_inventario.php?id_tipoinsumo=' . $fila["id_tipoinsumo"] . '"> ' . $fila["nombre"] . '
                                        </a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item mb-1">
                        <a class="nav-link" href="prenda_comprada_inventario.php">
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

                    <?php
                        $id_tipoinsumo = intval($_GET['id_tipoinsumo']);

                        $consulta_tipo = "SELECT id_tipoinsumo, tipo_insumo, nombre FROM tipo_insumo WHERE id_tipoinsumo = $id_tipoinsumo";
                        $resultado_tipo = mysqli_query($enlace, $consulta_tipo);
                        $fila_tipo = mysqli_fetch_assoc($resultado_tipo);

                        $tabla = $fila_tipo['tipo_insumo'];

                        $mapa_ids = [
                            'cinta_faya' => 'id_faya',
                            'cinta_reflectiva' => 'id_cinta',
                        ];

                        $id_campo = isset($mapa_ids[$tabla]) ? $mapa_ids[$tabla] : "id_" . $tabla;
                    ?>
                    
                    <!-- medio -->
                    <div class="text-center mt-3">
                        <h1 style="font-family: 'Times New Roman'">Insumos Tipo <?php echo $fila_tipo['nombre']; ?></h1>
                    </div>

                    <!-- DataTable -->
                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                    <!-- Modal Crear -->
                                    <div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content shadow rounded-4 border-0">

                                                <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title fw-semibold"><i class="bi bi-box-seam me-2"></i>Nuevo Insumo - <?php echo $fila_tipo['nombre']; ?></h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_tipoinsumo" value="<?php echo $fila_tipo['id_tipoinsumo']; ?>">
                                                        <input type="hidden" name="tipo_insumo" value="<?php echo $fila_tipo['tipo_insumo']; ?>">

                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Ingrese Nombre del insumo</label>
                                                            <input type="text" class="form-control" name="insumo" placeholder="Escribe el nombre del Insumo..." pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200" required>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Ingrese el tipo de medida</label>
                                                                <input type="text" class="form-control" name="medida" placeholder="Ej: Metro, Unidad, Kg" maxlength="30">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Elija un Proveedor</label>
                                                                <select name="id_proveedor" class="form-select">
                                                                    <option value="0">Seleccione un proveedor</option>
                                                                    <?php
                                                                    $consulta_mysql = 'select * from proveedor WHERE id_proveedor >= 1';
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                        echo "<option value='" . $lista["id_proveedor"] . "'>" . $lista["nombre"] . "</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Ingrese el precio del insumo</label>
                                                                <input type="number" class="form-control" name="precio" placeholder="0.00" min="0" step="any" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Ingrese la cantidad de unidades</label>
                                                                <input type="number" class="form-control" name="unidades" placeholder="Cantidad disponible" min="0">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer border-0 mt-4">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" name="submit_crear" class="btn btn-success">Agregar Insumo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="table-responsive">
                                <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><center>Tipo de insumo</center></th>
                                            <th><center>medida</center></th>
                                            <th><center>proveedor</center></th>
                                            <th><center>Precio</center></th>
                                            <th><center>Fecha Actualizacion</center></th>
                                            <th><center>Opciones</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = "SELECT $tabla.$id_campo AS id, $tabla.insumo, $tabla.medida, $tabla.precio,
                                        proveedor.id_proveedor, proveedor.nombre, $tabla.unidades, $tabla.fecha_actualizacion
                                        FROM $tabla
                                        LEFT JOIN proveedor ON $tabla.id_proveedor = proveedor.id_proveedor WHERE $tabla.$id_campo > 0";

                                        $resultado = mysqli_query($enlace, $consulta);

                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                                <td><center><?php echo $fila['insumo']; ?></center></td>
                                                <td><center><?php echo $fila['medida']; ?></center></td>
                                                <td><center><?php echo $fila['nombre']; ?></center></td>
                                                <td><center><?php $precio = $fila['precio']; $precio_formateado = $precio == intval($precio) ? number_format($precio, 0, ',', '.') : number_format($precio, 2, ',', '.');?>$<?= $precio_formateado ?></center></td>
                                                <td><center><?php echo $fila['fecha_actualizacion']; ?></center></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id']; ?>">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id']; ?>">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } // Fin del bucle while ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                ?>
                                <!-- Modal Editar -->
                                <div class="modal fade" id="modalEditar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content shadow rounded-4 border-0">

                                        <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                            <h5 class="modal-title fw-semibold"><i class="bi bi-box-seam me-2"></i>Editar Insumo - <?php echo $fila_tipo['nombre']; ?></h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                            <div class="modal-body">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_tipoinsumo" value="<?php echo $fila_tipo['id_tipoinsumo']; ?>">
                                                    <input type="hidden" name="tipo_insumo" value="<?php echo $fila_tipo['tipo_insumo']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Ingrese Nombre del insumo</label>
                                                        <input type="text" class="form-control" name="insumo" value="<?php echo $fila['insumo']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200" required>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Ingrese el tipo de medida</label>
                                                            <input type="text" class="form-control" name="medida" value="<?php echo $fila['medida']; ?>" maxlength="30">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Elija un Proveedor</label>
                                                            <select name="id_proveedor" class="form-select">
                                                                <option value="0">Seleccione una opción</option> 
                                                                <?php $consulta_mysql = 'select * from proveedor WHERE id_proveedor >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                    $id = $lista["id_proveedor"];
                                                                    $nombreProveedor = $lista["nombre"];
                                                                    $selected = ($nombreProveedor == $fila['nombre']) ? 'selected' : ''; 
                                                                    echo "<option value='$id' $selected>$nombreProveedor</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Ingrese el precio del insumo</label>
                                                            <?php $value = str_replace(['.', ','], ['', '.'], $fila['precio']);?>
                                                            <input type="number" class="form-control" name="precio" value="<?php echo $value; ?>" min="0" step="any" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Ingrese la cantidad de unidades</label>
                                                            <input type="number" class="form-control" name="unidades" value="<?php echo $fila['unidades']; ?>" min="0">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer border-0 mt-4">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar Insumo</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Eliminar -->                   
                                <div class="modal fade" id="modalEliminar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar el insumo: <?php echo $fila['insumo']; ?>?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-warning" role="alert">
                                                    Si continúa, el insumo sera eliminado de la base de datos.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST">
                                                    <input type="hidden" name="id_tipoinsumo" value="<?php echo $fila_tipo['id_tipoinsumo']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                                    <button type="submit" name="submit_eliminar" class="btn btn-danger">
                                                        Eliminar
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
            
        <!-- Datatables -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.8/af-2.7.1/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cr-2.1.2/cc-1.2.1/date-1.6.3/fc-5.0.5/fh-4.0.6/kt-2.12.2/r-3.0.8/rg-1.6.0/rr-1.5.1/sc-2.4.3/sb-1.8.4/sp-2.3.5/sl-3.1.3/sr-1.4.3/datatables.min.js" integrity="sha384-XCTQyNrbAXZ28p4As7vVXvKGdi4hZcqfqw3LOoZdYriqxbs4EHeHmxLwlsz9DW4l" crossorigin="anonymous"></script>
        
        <!-- Configuración de DataTable -->
        <script>
            $(document).ready(function() {
                var table = new DataTable('#mytabla', {
                    language: {
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "search": "Buscar:",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "<<",
                            "last": ">>",
                            "next": ">",
                            "previous": "<"
                        },
                        "aria": {
                            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "collection": "Colección",
                            "colvisRestore": "Restaurar visibilidad",
                            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                            "copySuccess": {
                                "1": "Copiada 1 fila al portapapeles",
                                "_": "Copiadas %ds fila al portapapeles"
                            },
                            "copyTitle": "Copiar al portapapeles",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Mostrar todas las filas",
                                "_": "Mostrar %d filas"
                            },
                            "pdf": "PDF",
                            "print": "Imprimir",
                            "renameState": "Cambiar nombre",
                            "updateState": "Actualizar",
                            "createState": "Crear Estado",
                            "removeAllStates": "Remover Estados",
                            "removeState": "Remover",
                            "savedStates": "Estados Guardados",
                            "stateRestore": "Estado %d"
                        },
                        "autoFill": {
                            "cancel": "Cancelar",
                            "fill": "Rellene todas las celdas con <i>%d<\/i>",
                            "fillHorizontal": "Rellenar celdas horizontalmente",
                            "fillVertical": "Rellenar celdas verticalmente"
                        },
                        "decimal": ",",
                        "searchBuilder": {
                            "add": "Añadir condición",
                            "button": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "clearAll": "Borrar todo",
                            "condition": "Condición",
                            "conditions": {
                                "date": {
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vacío",
                                    "equals": "Igual a",
                                    "notBetween": "No entre",
                                    "not": "Diferente de",
                                    "after": "Después",
                                    "notEmpty": "No Vacío"
                                },
                                "number": {
                                    "between": "Entre",
                                    "equals": "Igual a",
                                    "gt": "Mayor a",
                                    "gte": "Mayor o igual a",
                                    "lt": "Menor que",
                                    "lte": "Menor o igual que",
                                    "notBetween": "No entre",
                                    "notEmpty": "No vacío",
                                    "not": "Diferente de",
                                    "empty": "Vacío"
                                },
                                "string": {
                                    "contains": "Contiene",
                                    "empty": "Vacío",
                                    "endsWith": "Termina en",
                                    "equals": "Igual a",
                                    "startsWith": "Empieza con",
                                    "not": "Diferente de",
                                    "notContains": "No Contiene",
                                    "notStartsWith": "No empieza con",
                                    "notEndsWith": "No termina con",
                                    "notEmpty": "No Vacío"
                                },
                                "array": {
                                    "not": "Diferente de",
                                    "equals": "Igual",
                                    "empty": "Vacío",
                                    "contains": "Contiene",
                                    "notEmpty": "No Vacío",
                                    "without": "Sin"
                                }
                            },
                            "data": "Data",
                            "deleteTitle": "Eliminar regla de filtrado",
                            "leftTitle": "Criterios anulados",
                            "logicAnd": "Y",
                            "logicOr": "O",
                            "rightTitle": "Criterios de sangría",
                            "title": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "value": "Valor"
                        },
                        "searchPanes": {
                            "clearMessage": "Borrar todo",
                            "collapse": {
                                "0": "Paneles de búsqueda",
                                "_": "Paneles de búsqueda (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Sin paneles de búsqueda",
                            "loadMessage": "Cargando paneles de búsqueda",
                            "title": "Filtros Activos - %d",
                            "showMessage": "Mostrar Todo",
                            "collapseMessage": "Colapsar Todo"
                        },
                        "select": {
                            "cells": {
                                "1": "1 celda seleccionada",
                                "_": "%d celdas seleccionadas"
                            },
                            "columns": {
                                "1": "1 columna seleccionada",
                                "_": "%d columnas seleccionadas"
                            },
                            "rows": {
                                "1": "1 fila seleccionada",
                                "_": "%d filas seleccionadas"
                            }
                        },
                        "thousands": ".",
                        "datetime": {
                            "previous": "Anterior",
                            "hours": "Horas",
                            "minutes": "Minutos",
                            "seconds": "Segundos",
                            "unknown": "-",
                            "amPm": [
                                "AM",
                                "PM"
                            ],
                            "months": {
                                "0": "Enero",
                                "1": "Febrero",
                                "10": "Noviembre",
                                "11": "Diciembre",
                                "2": "Marzo",
                                "3": "Abril",
                                "4": "Mayo",
                                "5": "Junio",
                                "6": "Julio",
                                "7": "Agosto",
                                "8": "Septiembre",
                                "9": "Octubre"
                            },
                            "weekdays": {
                                "0": "Dom",
                                "1": "Lun",
                                "2": "Mar",
                                "4": "Jue",
                                "5": "Vie",
                                "3": "Mié",
                                "6": "Sáb"
                            },
                            "next": "Próximo"
                        },
                        "editor": {
                            "close": "Cerrar",
                            "create": {
                                "button": "Nuevo",
                                "title": "Crear Nuevo Registro",
                                "submit": "Crear"
                            },
                            "edit": {
                                "button": "Editar",
                                "title": "Editar Registro",
                                "submit": "Actualizar"
                            },
                            "remove": {
                                "button": "Eliminar",
                                "title": "Eliminar Registro",
                                "submit": "Eliminar",
                                "confirm": {
                                    "_": "¿Está seguro de que desea eliminar %d filas?",
                                    "1": "¿Está seguro de que desea eliminar 1 fila?"
                                }
                            },
                            "error": {
                                "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                            },
                            "multi": {
                                "title": "Múltiples Valores",
                                "restore": "Deshacer Cambios",
                                "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
                                "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
                            }
                        },
                        "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                        "stateRestore": {
                            "creationModal": {
                                "button": "Crear",
                                "name": "Nombre:",
                                "order": "Clasificación",
                                "paging": "Paginación",
                                "select": "Seleccionar",
                                "columns": {
                                    "search": "Búsqueda de Columna",
                                    "visible": "Visibilidad de Columna"
                                },
                                "title": "Crear Nuevo Estado",
                                "toggleLabel": "Incluir:",
                                "scroller": "Posición de desplazamiento",
                                "search": "Búsqueda",
                                "searchBuilder": "Búsqueda avanzada"
                            },
                            "removeJoiner": "y",
                            "removeSubmit": "Eliminar",
                            "renameButton": "Cambiar Nombre",
                            "duplicateError": "Ya existe un Estado con este nombre.",
                            "emptyStates": "No hay Estados guardados",
                            "removeTitle": "Remover Estado",
                            "renameTitle": "Cambiar Nombre Estado",
                            "emptyError": "El nombre no puede estar vacío.",
                            "removeConfirm": "¿Seguro que quiere eliminar %s?",
                            "removeError": "Error al eliminar el Estado",
                            "renameLabel": "Nuevo nombre para %s:"
                        },
                        "infoThousands": "."
                    }
                });
            });
        </script>
    </body>
</html>