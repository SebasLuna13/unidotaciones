<?php
require_once('../../conexion.php');
session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: index.php");
} else {
    if ($_SESSION['rol'] != 'compras') {
        header("Location: inicio_compras.php");
    }
}

foreach ($_REQUEST as $var => $val) {
    $$var = $val;
}

if (isset($_POST['submit_crear'])) {
    $nit = isset($_POST['nit']) ? $_POST['nit'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $razon_social = isset($_POST['razon_social']) ? $_POST['razon_social'] : '';
    $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    $repre_comercial = isset($_POST['repre_comercial']) ? $_POST['repre_comercial'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $banco = isset($_POST['banco']) ? $_POST['banco'] : '';
    $tipo_cuenta = isset($_POST['tipo_cuenta']) ? $_POST['tipo_cuenta'] : '';
    $num_cuenta = isset($_POST['num_cuenta']) ? $_POST['num_cuenta'] : '';
    $autorizacion = isset($_POST['autorizacion']) ? $_POST['autorizacion'] : '';
    $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    // Manejo del archivo
    $certificado_bancario = isset($_POST['certificado_bancario']) ? $_POST['certificado_bancario'] : '';
    $certificado_bancario_nombre = $_FILES['certificado_bancario']['name'];
    $certificado_bancario_temp = $_FILES['certificado_bancario']['tmp_name'];
    $certificado_bancario_destino = 'documentos/certificados/' . $certificado_bancario_nombre; // Ruta donde se guardará el archivo

    // Mueve el archivo del directorio temporal al destino final
    move_uploaded_file($certificado_bancario_temp, $certificado_bancario_destino);

    $consulta_verificar_nit = "SELECT * FROM proveedor WHERE nit = '$nit'";
    $resultado_verificar_nit = mysqli_query($enlace, $consulta_verificar_nit);

    if (mysqli_num_rows($resultado_verificar_nit) > 0) {
        header("Location: proveedor.php?recibido=1");
        exit();
    } else {
        $consulta = "INSERT INTO proveedor (nit, nombre, razon_social, celular, repre_comercial, email, banco, tipo_cuenta, num_cuenta, certificado_bancario, autorizacion, departamento, ciudad, direccion, descripcion) 
                    VALUES ('$nit', '$nombre', '$razon_social', '$celular', '$repre_comercial', '$email', '$banco', '$tipo_cuenta', '$num_cuenta', '$certificado_bancario_destino', '$autorizacion', '$departamento', '$ciudad', '$direccion', '$descripcion')";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: proveedor.php?recibido=2");
        exit();
    }
}

if (isset($_POST['submit_editar'])) {
    $consulta = "UPDATE proveedor SET nombre = '$nombre', razon_social = '$razon_social', celular = '$celular', repre_comercial = '$repre_comercial', email = '$email', banco = '$banco', tipo_cuenta = '$tipo_cuenta', num_cuenta = '$num_cuenta', autorizacion = '$autorizacion', departamento = '$departamento', ciudad = '$ciudad', direccion = '$direccion', descripcion = '$descripcion' 
                WHERE id_proveedor = '$id_proveedor'";

    $resultado = mysqli_query($enlace, $consulta);
    header("Location: proveedor.php");
    exit();
}

if (isset($_POST['submit_eliminar'])) {
    $consulta = "DELETE FROM proveedor WHERE id_proveedor = '$id_proveedor'";
    $resultado = mysqli_query($enlace, $consulta);
    header("Location: proveedor.php");
    exit();
}

date_default_timezone_set('America/Bogota');

if (isset($_POST['submit_calificar'])) {

    $id_proveedor = $_POST['id_proveedor'];
    $id_calificacion = $_POST['id_calificacion'];
    $fecha = date("Y-m-d H:i:s");
    $observaciones = $_POST['observaciones'];

    $consulta = "INSERT INTO califi_proveedor (id_proveedor, id_calificacion, fecha, observaciones) VALUES ('$id_proveedor', '$id_calificacion', '$fecha', '$observaciones')";
    $resultado = mysqli_query($enlace, $consulta);
    header("Location: proveedor.php");
    exit();
}

$recibido = 0
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

        <title>Compras | Proveedores de Insumos</title>
    <head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%);">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="navbar-brand text-center" href="inicio_compras.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 60px;"
                        >
                    </a>
                </div>
                <hr class="sidebar-divider my-0 bg-white opacity-50">
                <div class="px-2 mt-3">
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="inicio_compras.php">
                            <i class="bi bi-bag-fill"></i><span>Ordenes de Compra</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="proveedor.php">
                            <i class="bi bi-file-person-fill"></i><span>Proveedores</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="proveedor_tela.php">
                            <i class="bi bi-person-badge-fill"></i><span>Proveedores de Telas</span>
                        </a>
                    </li>
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
                        <h1 style="font-family: 'Times New Roman'">Lista de Proveedores</h1>
                    </div>
                    <?php
                    foreach ($_REQUEST as $var => $val) {
                        $$var = $val;
                    }
                    if ($recibido == 1) { ?>
                        <div class="container">
                            <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon-fill"></i><strong> Error!</strong> No se ha podido crear el Proveedor ya que este ya se encuentra en la base de datos.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    <?php } else if ($recibido == 2) { ?>
                        <div class="container">
                            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill"></i><strong> Éxito!</strong> El proveedor se creo y guardo exitosamente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <!-- DataTable -->
                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                    <!-- Modal Crear -->
                                    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos del Proveedor</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Nit o Documento:</label>
                                                                <input type="text" class="form-control" name="nit" placeholder="Ingrese Nit o Documento" pattern="[0-9]+" maxlength="30" required>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Nombre del Proveedor:</label>
                                                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el Nombre" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Razon Social:</label>
                                                            <input type="text" class="form-control" name="razon_social" placeholder="Ingresa la razon social del Proveedor" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100" required>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Celular del proveedor:</label>
                                                                <input type="text" class="form-control" name="celular" placeholder="Ingrese el numero de celular" pattern="[0-9]+" minlength="10" maxlength="10">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Representante Comercial:</label>
                                                                <input type="text" class="form-control" name="repre_comercial" placeholder="Ingrese el nombre" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Correo electrónico del proveedor:</label>
                                                            <input type="email" id="email" class="form-control" name="email" placeholder="Ingresa el Correo electrónico a registrar" minlength="10" maxlength="50">
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Elija el banco:</label>
                                                                <select name="banco" class="form-select">
                                                                    <?php
                                                                    $consulta_mysql = "SHOW COLUMNS FROM proveedor WHERE Field = 'banco'";
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    $row = mysqli_fetch_array($resultado_consulta_mysql);
                                                                    $enum_list = explode("','", substr($row['Type'], 6, -2));

                                                                    // Iterar sobre los valores del enum y crear las opciones del select
                                                                    foreach ($enum_list as $valor) {
                                                                        $selected = ($valor == $fila['banco']) ? 'selected' : '';
                                                                        echo "<option value='$valor' $selected>$valor</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Elija el banco:</label>
                                                                <select name="tipo_cuenta" class="form-select">
                                                                    <?php
                                                                    // Consulta para obtener los valores del enum banco
                                                                    $consulta_mysql = "SHOW COLUMNS FROM proveedor WHERE Field = 'tipo_cuenta'";
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    $row = mysqli_fetch_array($resultado_consulta_mysql);
                                                                    $enum_list = explode("','", substr($row['Type'], 6, -2));

                                                                    // Iterar sobre los valores del enum y crear las opciones del select
                                                                    foreach ($enum_list as $valor) {
                                                                        $selected = ($valor == $fila['tipo_cuenta']) ? 'selected' : '';
                                                                        echo "<option value='$valor' $selected>$valor</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Numero de cuenta:</label>
                                                                <input type="text" class="form-control" name="num_cuenta" placeholder="---- ---- ---- ----" pattern="[0-9]+" minlength="16" maxlength="16">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Cargar Certificado Bancario:</label>
                                                                <input type="file" class="form-control" name="certificado_bancario" accept=".pdf,.doc,.docx">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000; flex: 1;">Dueño de la cuenta:</label>
                                                            <input type="text" class="form-control" name="autorizacion" placeholder="Ingrese nombre del dueño de la cuenta" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                <select class="form-select departamento" name="departamento">
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                <select class="form-select ciudad" name="ciudad" disabled>
                                                                    <option value="">Elige una Ciudad</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                            <input type="text" class="form-control direccion" name="direccion" placeholder="Ingrese la Direccion" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Realice una descripcion detallada sobre el proveedor (Nombre contacto, Productos que venden, cantidades de venta)::</label>
                                                            <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Ingresa una descripción del proveedor" pattern="[A-Za-z-Zñóéí0-9 ,\-]+" maxlength="1000" rows="5"></textarea>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
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
                                                <th style="text-align: center; vertical-align: middle; width: 22%;">
                                                    <center>Datos del Proveedor</center>
                                                </th>
                                                <th style="text-align: center; vertical-align: middle; width: 31%;">
                                                    <center>Descripcion del Proveedor</center>
                                                </th>
                                                <th style="text-align: center; vertical-align: middle; width: 31%;">
                                                    <center>Calificacion Proveedor</center>
                                                </th>
                                                <th style="text-align: center; vertical-align: middle; width: 16%;">
                                                    <center>Opciones</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "SELECT proveedor.id_proveedor, proveedor.nit, proveedor.nombre, proveedor.razon_social, proveedor.celular, proveedor.email, proveedor.banco, proveedor.tipo_cuenta, proveedor.num_cuenta, proveedor.certificado_bancario, proveedor.repre_comercial, 
                                                proveedor.autorizacion, proveedor.departamento, proveedor.ciudad, proveedor.direccion, proveedor.descripcion, califi_proveedor.id_registro, califi_proveedor.fecha, califi_proveedor.observaciones, calificacion.id_calificacion, calificacion.calificacion
                                                FROM proveedor
                                                LEFT JOIN (SELECT id_proveedor, MAX(fecha) AS max_fecha FROM califi_proveedor GROUP BY id_proveedor) AS ultima_calificacion ON proveedor.id_proveedor = ultima_calificacion.id_proveedor
                                                LEFT JOIN califi_proveedor ON proveedor.id_proveedor = califi_proveedor.id_proveedor AND califi_proveedor.fecha = ultima_calificacion.max_fecha
                                                LEFT JOIN calificacion ON calificacion.id_calificacion  = califi_proveedor.id_calificacion 
                                                GROUP BY proveedor.id_proveedor";

                                            $resultado = mysqli_query($enlace, $consulta);

                                            while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                                <tr>
                                                    <td class="text-center align-middle"><strong><?php echo $fila['nombre']; ?></strong><br><br>
                                                        <?php if (!empty($fila['razon_social'])): ?>
                                                            <strong>Razón Social: </strong><?php echo $fila['razon_social']; ?><br>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['celular'])): ?>
                                                            <strong>Celular: </strong><?php echo $fila['celular']; ?><br>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['email'])): ?>
                                                            <strong>Email:</strong> <?php echo $fila['email']; ?><br>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?php echo $fila['descripcion']; ?></td>
                                                    <td class="align-middle">
                                                        <?php if (!empty($fila['fecha'])): ?>
                                                            <strong>Fecha: </strong><?php echo $fila['fecha']; ?><br>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['calificacion'])): ?>
                                                            <strong>Tipo de Calificacion: </strong><?php echo $fila['calificacion']; ?><br>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['observaciones'])): ?>
                                                            <strong>Observaciones: </strong><?php echo $fila['observaciones']; ?><br>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div>
                                                            <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalCalificar<?php echo $fila['id_proveedor']; ?>">
                                                                <i class="bi bi-star-fill"> Calificar</i>
                                                            </button>
                                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalRegistros<?php echo $fila['id_proveedor']; ?>">
                                                                <i class="bi bi-journal-text"></i> Calificaciones</i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id_proveedor']; ?>">
                                                                <i class="bi bi-pencil-square"> Editar Datos</i>
                                                            </button>
                                                            <button type="button" class="btn btn-secondary btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalMostrar<?php echo $fila['id_proveedor']; ?>">
                                                                <i class="bi bi-bank"> Datos Bancarios</i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } // Fin del bucle while 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                ?>
                                    <!-- Modal Calificar -->
                                    <div class="modal fade" id="modalCalificar<?php echo $fila['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Asigne la calificación de <?php echo $fila['nombre']; ?> según su fiabilidad</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" style="color: #000000;">¿Qué calificación le desea asignar al proveedor?</label>
                                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_proveedor" value="<?php echo $fila['id_proveedor']; ?>">
                                                            <select name="id_calificacion" class="form-select" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <?php
                                                                $consulta_mysql = 'select * from calificacion WHERE id_calificacion > 0'; // Filtrar las calificaciones con id_calificacion mayor que 0
                                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                    echo "<option value='" . $lista["id_calificacion"] . "'>";
                                                                    echo $lista["calificacion"];
                                                                    echo "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" style="color: #000000;">Realice Observaciones de la calificacion al proveedor:</label>
                                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí0-9 ,\-]+" maxlength="1000" rows="5"><?php echo $fila['observaciones'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_proveedor" value="<?php echo $fila['id_proveedor']; ?>">
                                                        <button type="submit" name="submit_calificar" class="btn btn-success">Aceptar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modales Informacion -->
                                    <div class="modal fade" id="modalMostrar<?php echo $fila['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Información Bancaria</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Bancarios</h6>
                                                            <?php if (!empty($fila['banco'])): ?>
                                                                <div>
                                                                    <p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Banco: </span> <?= $fila['banco'] ?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['tipo_cuenta'])): ?>
                                                                <div>
                                                                    <p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cuenta: </span> <?= $fila['tipo_cuenta'] ?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['num_cuenta'])): ?>
                                                                <div>
                                                                    <p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Número de Cuenta: </span> <?= $fila['num_cuenta'] ?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['autorizacion'])): ?>
                                                                <div>
                                                                    <p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Dueño de la Cuenta: </span> <?= $fila['autorizacion'] ?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <br>
                                                            <div>
                                                                <?php if (!empty($fila['certificado_bancario'])): ?>
                                                                    <center><a href="<?php echo $fila['certificado_bancario']; ?>" class="btn btn-primary" download>
                                                                            <i class="bi bi-download"></i> Descargar Certificado
                                                                        </a></center>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modales Registros de calificacion -->
                                    <div class="modal fade" id="modalRegistros<?php echo $fila['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Calificaciones realizadas al proveedor</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $id_proveedor = $fila['id_proveedor']; // Obtener el id_proveedor del array $fila
                                                    $consulta2 = "SELECT califi_proveedor.id_registro, califi_proveedor.fecha, califi_proveedor.observaciones, calificacion.id_calificacion, calificacion.calificacion, proveedor.id_proveedor
                                                                    FROM proveedor
                                                                    LEFT JOIN califi_proveedor ON proveedor.id_proveedor = califi_proveedor.id_proveedor 
                                                                    LEFT JOIN calificacion ON calificacion.id_calificacion  = califi_proveedor.id_calificacion 
                                                                    WHERE proveedor.id_proveedor = $id_proveedor";

                                                    $resultado2 = mysqli_query($enlace, $consulta2);

                                                    while ($fila2 = mysqli_fetch_array($resultado2)) {
                                                        if (!empty($fila2['fecha']) && !empty($fila2['calificacion']) && !empty($fila2['observaciones'])) {
                                                            echo '<div class="mb-2 mt-1 text-center border rounded p-1">';
                                                            echo '<h6 class="text-muted font-weight-bold bg-light p-1 rounded">Calificación realizada el: ' . $fila2['fecha'] . '</h6>';
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Tipo de Calificación: </span> ' . $fila2['calificacion'] . '</p>';
                                                            echo '<p class="card-text mb-1" style="font-family: sans-serif; color: black; font-size: 15px;"><span class="font-weight-bold">Observaciones: </span> ' . $fila2['observaciones'] . '</p>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Editar -->
                                    <div class="modal fade" id="modalEditar<?php echo $fila['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a editar del Proveedor</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" id="id_proveedor" name="id_proveedor" value="<?php echo $fila['id_proveedor']; ?>">
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Nit o Documento:</label>
                                                                <input type="text" class="form-control" name="nit" value="<?php echo $fila['nit'] ?>" pattern="[0-9]+" maxlength="30" required>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Nombre del Proveedor:</label>
                                                                <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Razon Social:</label>
                                                            <input type="text" class="form-control" name="razon_social" value="<?php echo $fila['razon_social'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100" required>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Celular del proveedor:</label>
                                                                <input type="text" class="form-control" name="celular" value="<?php echo $fila['celular'] ?>" pattern="[0-9]+" minlength="10" maxlength="10">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Representante Comercial:</label>
                                                                <input type="text" class="form-control" name="repre_comercial" value="<?php echo $fila['repre_comercial'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="10">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Correo electrónico del proveedor:</label>
                                                            <input type="email" id="email" class="form-control" name="email" value="<?php echo $fila['email'] ?>" minlength="10" maxlength="30">
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Elija el banco:</label>
                                                                <select name="banco" class="form-select">
                                                                    <?php
                                                                    $consulta_mysql = "SHOW COLUMNS FROM proveedor WHERE Field = 'banco'";
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    $row = mysqli_fetch_array($resultado_consulta_mysql);
                                                                    $enum_list = explode("','", substr($row['Type'], 6, -2));

                                                                    // Iterar sobre los valores del enum y crear las opciones del select
                                                                    foreach ($enum_list as $valor) {
                                                                        $selected = ($valor == $fila['banco']) ? 'selected' : '';
                                                                        echo "<option value='$valor' $selected>$valor</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Elija el banco:</label>
                                                                <select name="tipo_cuenta" class="form-select">
                                                                    <?php
                                                                    // Consulta para obtener los valores del enum banco
                                                                    $consulta_mysql = "SHOW COLUMNS FROM proveedor WHERE Field = 'tipo_cuenta'";
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    $row = mysqli_fetch_array($resultado_consulta_mysql);
                                                                    $enum_list = explode("','", substr($row['Type'], 6, -2));

                                                                    // Iterar sobre los valores del enum y crear las opciones del select
                                                                    foreach ($enum_list as $valor) {
                                                                        $selected = ($valor == $fila['tipo_cuenta']) ? 'selected' : '';
                                                                        echo "<option value='$valor' $selected>$valor</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000;">Numero de cuenta:</label>
                                                            <input type="text" class="form-control" name="num_cuenta" value="<?php echo $fila['num_cuenta'] ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000; flex: 1;">Dueño de la cuenta:</label>
                                                            <input type="text" class="form-control" name="autorizacion" value="<?php echo $fila['autorizacion'] ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                <select class="form-select" id="departamento" name="departamento">
                                                                    <?php if (empty($fila['departamento'])): ?>
                                                                        <option value="" selected>Selecciona un Departamento</option>
                                                                    <?php else: ?>
                                                                        <option value="<?php echo $fila['departamento']; ?>" selected><?php echo $fila['departamento']; ?></option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                <select class="form-select" id="ciudad1" name="ciudad" <?php echo ($fila['departamento']) ? "" : "disabled"; ?>>
                                                                    <?php if ($fila['departamento']): ?>
                                                                        <option value="<?php echo $fila['ciudad']; ?>" selected><?php echo $fila['ciudad']; ?></option>
                                                                    <?php else: ?>
                                                                        <option value="">Elige una Ciudad</option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                            <input type="text" class="form-control direccion" name="direccion" value="<?php echo $fila['direccion'] ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Realice una descripcion detallada sobre el proveedor (Nombre contacto, Productos que venden, cantidades de venta)::</label>
                                                            <textarea id="descripcion" class="form-control" name="descripcion" pattern="[A-Za-z-Zñóéí0-9 ,\-]+" maxlength="1000" rows="5"><?php echo $fila['descripcion'] ?></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Eliminar -->
                                    <div class="modal fade" id="modalEliminar<?php echo $fila['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar al Proveedor: <?php echo $fila['nombre']; ?>?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">
                                                        Si continúa, el proveedor sera eliminado de la base de datos.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_proveedor" value="<?php echo $fila['id_proveedor']; ?>">
                                                        <button type="submit" name="submit_eliminar" class="btn btn-danger">Eliminar</button>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
            <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.8/af-2.7.1/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cr-2.1.2/cc-1.2.1/date-1.6.3/fc-5.0.5/fh-4.0.6/kt-2.12.2/r-3.0.8/rg-1.6.0/rr-1.5.1/sc-2.4.3/sb-1.8.4/sp-2.3.5/sl-3.1.3/sr-1.4.3/datatables.min.js" integrity="sha384-XCTQyNrbAXZ28p4As7vVXvKGdi4hZcqfqw3LOoZdYriqxbs4EHeHmxLwlsz9DW4l" crossorigin="anonymous"></script>

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
            <script>
                function cargarDepartamentos(selectDepartamento) {
                    fetch('https://www.datos.gov.co/resource/xdk5-pm3f.json?$query=SELECT%20%60departamento%60%2C%20%60municipio%60')
                        .then(response => response.json())
                        .then(data => {
                            selectDepartamento.innerHTML = "<option value=''>Elige un Departamento</option>";

                            // Extraer departamentos únicos
                            var departamentosUnicos = [...new Set(data.map(item => item.departamento))];
                            // Ordenar alfabéticamente
                            departamentosUnicos.sort();

                            // Agregar opciones al select
                            departamentosUnicos.forEach(departamento => {
                                var option = document.createElement("option");
                                option.text = departamento;
                                option.value = departamento;
                                selectDepartamento.add(option);
                            });
                        })
                        .catch(error => console.error('Error cargando departamentos:', error));
                }

                function cargarCiudades(selectCiudad, departamentoSeleccionado) {
                    selectCiudad.innerHTML = "<option value=''>Elige una Ciudad</option>";

                    fetch('https://www.datos.gov.co/resource/95qx-tzs7.json?departamento=' + departamentoSeleccionado)
                        .then(response => response.json())
                        .then(data => {
                            // Extraer ciudades únicas
                            var ciudadesUnicas = [...new Set(data.map(ciudad => ciudad.municipio))];
                            // Ordenar alfabéticamente
                            ciudadesUnicas.sort();

                            // Agregar opciones al select
                            ciudadesUnicas.forEach(ciudad => {
                                var option = document.createElement("option");
                                option.text = ciudad;
                                option.value = ciudad;
                                selectCiudad.add(option);
                            });

                            selectCiudad.disabled = false;
                        })
                        .catch(error => console.error('Error cargando ciudades:', error));
                }

                document.addEventListener("DOMContentLoaded", function() {
                    var departamentos = document.querySelectorAll('.departamento');
                    departamentos.forEach(function(selectDepartamento) {
                        cargarDepartamentos(selectDepartamento);
                        selectDepartamento.addEventListener("change", function() {
                            var ciudad = this.parentNode.nextElementSibling.querySelector('.ciudad');
                            cargarCiudades(ciudad, this.value);
                        });
                    });
                });
            </script>
            <script>
                setTimeout(function() {
                    document.getElementById('successAlert').style.display = 'none';
                }, 4000);
            </script>
    </body>
</html>