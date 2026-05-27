<?php
    require_once('../../conexion.php');
    session_start();

    $roles_permitidos = ['comercial', 'comercial2', 'comercial3', 'comercial4', 'comercial5', 'comercial6'];

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

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    if (isset($_POST['submit_crear_nuevo'])) {
        $id_usuario = $_POST['id_usuario'];
        $cod_cliente = $_POST['cod_cliente'];
        $id_entidad = $_POST['id_entidad'];
        $cliente = $_POST['cliente'];
        $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
        $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
        $cumple_contacto = isset($_POST['cumple_contacto']) ? $_POST['cumple_contacto'] : '';
        $celular_contacto = isset($_POST['celular_contacto']) ? $_POST['celular_contacto'] : '';
        $correo_contacto = isset($_POST['correo_contacto']) ? $_POST['correo_contacto'] : '';
        $departamento1 = isset($_POST['departamento1']) ? $_POST['departamento1'] : '';
        $ciudad1 = isset($_POST['ciudad1']) ? $_POST['ciudad1'] : '';
        $direccion1 = isset($_POST['direccion1']) ? $_POST['direccion1'] : '';
        $id_tipo_visita = $_POST['id_tipo_visita'];
        $descripcion_visita = isset($_POST['descripcion_visita']) ? $_POST['descripcion_visita'] : '';
        date_default_timezone_set('America/Bogota');
        $fecha_visita = date('Y-m-d H:i:s');

        // Verificar si el NIT ya existe en la tabla cliente
        $consulta_verificar_nit = "SELECT * FROM cliente WHERE cod_cliente = '$cod_cliente'";
        $resultado_verificar_nit = mysqli_query($enlace, $consulta_verificar_nit);

        if ($id_tipo_visita == 0) {
            header("Location: inicio_pedido.php?id_usuario=$id_usuario&recibido=4");
            exit();
        } elseif (mysqli_num_rows($resultado_verificar_nit) > 0) {
            header("Location: inicio_pedido.php?id_usuario=$id_usuario&recibido=1");
            exit();
        } else {
            // Realizar la consulta SQL para insertar el nuevo cliente
            $consulta_cliente = "INSERT INTO cliente (id_usuario, cod_cliente, id_entidad, cliente, contacto, cargo, cumple_contacto, celular_contacto, correo_contacto, departamento1, ciudad1, direccion1) 
                    VALUES ('$id_usuario','$cod_cliente', '$id_entidad', '$cliente','$contacto', '$cargo','$cumple_contacto', '$celular_contacto', '$correo_contacto', '$departamento1', '$ciudad1', '$direccion1')";

            // Ejecutar la consulta
            $resultado_cliente = mysqli_query($enlace, $consulta_cliente);

            // Obtener el último ID insertado
            $nit = mysqli_insert_id($enlace);

            // Realizar la consulta SQL para insertar el pedido
            $consulta_visita = "INSERT INTO visita (nit, id_usuario, fecha_visita, id_tipo_visita, descripcion_visita) 
                    VALUES ('$nit', '$id_usuario', '$fecha_visita', '$id_tipo_visita', '$descripcion_visita')";

            // Ejecutar las consultas
            $resultado_visita = mysqli_query($enlace, $consulta_visita);

            if ($resultado_cliente && $resultado_visita) {
                header("Location: inicio_pedido.php?id_usuario=$id_usuario");
                exit();
            } else {
                header("Location: inicio_pedido.php?id_usuario=$id_usuario&recibido=2");
                exit();
            }
        }
    }

    if (isset($_POST['submit_crear_viejo'])) {

        $nit = $_POST['nit'];
        $id_usuario = $_POST['id_usuario'];
        date_default_timezone_set('America/Bogota');
        $fecha_visita = date('Y-m-d H:i:s');

        $id_tipo_visita = $_POST['id_tipo_visita'];
        $descripcion_visita = isset($_POST['descripcion_visita']) ? $_POST['descripcion_visita'] : '';

        if ($nit == 0) {
            header("Location: inicio_pedido.php?id_usuario=$id_usuario&recibido=3");
            exit();
        } elseif ($id_tipo_visita == 0) {
            header("Location: inicio_pedido.php?id_usuario=$id_usuario&recibido=4");
            exit();
        } else {
            $consulta_visita = "INSERT INTO visita (nit, id_usuario, fecha_visita, id_tipo_visita, descripcion_visita)
                    VALUES ('$nit', '$id_usuario', '$fecha_visita', '$id_tipo_visita', '$descripcion_visita')";
            $resultado_visita = mysqli_query($enlace, $consulta_visita);

            header("Location: inicio_pedido.php?id_usuario=$id_usuario");
            exit();
        }
    }

    if (isset($_POST['submit_editar'])) {
        $consulta = "UPDATE visita SET id_tipo_visita = '$id_tipo_visita', descripcion_visita = '$descripcion_visita' WHERE id_visita = '$id_visita'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_pedido.php?id_usuario=$id_usuario");
        exit();
    }

    $recibido = 0;
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
        
        <title>Comercial | Inicio Comercial</title>
    <head>
        
    <body id="page-top">
        <style>
            /* Ajuste visual de la lista */
            .combobox-list {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                border: 1px solid #dee2e6;
                border-top: none;
                max-height: 200px;
                overflow-y: auto;
                background: #fff;
                z-index: 1050;
                /* sobre formularios */
                display: none;
            }

            .combobox-item {
                padding: 0.5rem 1rem;
                cursor: pointer;
            }

            .combobox-item:hover {
                background: #e9ecef;
            }
        </style>
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

                    <div class="text-center mt-3">
                        <h1 style="font-family: 'Times New Roman'">Registro de Visitas</h1>
                    </div>

                    <?php
                    foreach ($_REQUEST as $var => $val) {
                        $$var = $val;
                    }
                    if ($recibido == 1) { ?>
                        <div class="container">
                            <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon-fill"></i><strong> Error!</strong> No se ha podido crear la solicitud de Visita ya que el cliente ya se encuentra registrado, intente nuevamente utilizando la opción de Cliente Antiguo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    <?php } else if ($recibido == 2) { ?>
                        <div class="container">
                            <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon-fill"></i><strong> Error!</strong> Ocurrió un problema al momento de ingresar los datos.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    <?php } else if ($recibido == 3) { ?>
                        <div class="container">
                            <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon-fill"></i><strong> Error!</strong> No se pudo guardar la visita ya que no se eligio a ningun Cliente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    <?php } else if ($recibido == 4) { ?>
                        <div class="container">
                            <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon-fill"></i><strong> Error!</strong> No se pudo guardar la visita ya que falto elegir el tipo de Visita.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    <?php }
                    ?>

                    <!-- DataTable -->
                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                    <!-- modal crear-->
                                    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Registro de Visita</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="clienteNuevo-tab" data-bs-toggle="tab" data-bs-target="#clienteNuevo" type="button" role="tab" aria-controls="clienteNuevo" aria-selected="true">Cliente Nuevo</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="clienteAntiguo-tab" data-bs-toggle="tab" data-bs-target="#clienteAntiguo" type="button" role="tab" aria-controls="clienteAntiguo" aria-selected="false">Cliente Antiguo</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <!-- cliente Nuevo -->
                                                        <div class="tab-pane fade show active" id="clienteNuevo" role="tabpanel">
                                                            <form method="post" id="formularioClienteNuevo" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">

                                                                <div class="container-fluid">
                                                                    <!-- DATOS CLIENTE -->
                                                                    <h6 class="text-center text-muted fw-bold bg-light p-2 rounded mt-3">Datos del Cliente</h6>

                                                                    <div class="row g-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Nit/Documento</label>
                                                                            <input type="text" class="form-control" name="cod_cliente" placeholder="Ingrese el Nit" required>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Tipo de Entidad</label>
                                                                            <select name="id_entidad" class="form-select" required>
                                                                                <option value="" disabled selected>Seleccione una opción</option>
                                                                                <?php
                                                                                $consulta_mysql = 'select * from entidad';
                                                                                $resultado = mysqli_query($enlace, $consulta_mysql);
                                                                                while ($lista = mysqli_fetch_assoc($resultado)) {
                                                                                    echo "<option value='{$lista["id_entidad"]}'>{$lista["tipo_entidad"]}</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label class="form-label">Nombre del Cliente</label>
                                                                            <input type="text" class="form-control" name="cliente" placeholder="Ingrese el Nombre del Cliente" required>
                                                                        </div>
                                                                    </div>

                                                                    <!-- CONTACTO -->
                                                                    <h6 class="text-center text-muted fw-bold bg-light p-2 rounded mt-4">Datos de Contacto</h6>

                                                                    <div class="row g-3">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Nombre Completo</label>
                                                                            <input type="text" class="form-control" name="contacto" placeholder="Ingrese el Nombre del Contacto">
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Cargo</label>
                                                                            <input type="text" class="form-control" name="cargo" placeholder="Ingrese el Cargo del Contacto">
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Fecha de Nacimiento</label>
                                                                            <input type="date" class="form-control" name="cumple_contacto">
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Celular</label>
                                                                            <input type="text" class="form-control" name="celular_contacto" placeholder="Ingrese el Número de Celular">
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label class="form-label">Correo Electrónico</label>
                                                                            <input type="email" class="form-control" name="correo_contacto" placeholder="Ingrese el Correo Electrónico">
                                                                        </div>
                                                                    </div>

                                                                    <!-- UBICACION -->
                                                                    <h6 class="text-center text-muted fw-bold bg-light p-2 rounded mt-4">Ubicación</h6>

                                                                    <div class="row g-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Departamento</label>
                                                                            <select class="form-select" id="departamento1" name="departamento1"></select>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Ciudad</label>
                                                                            <select class="form-select" id="ciudad1" name="ciudad1" disabled>
                                                                                <option>Elige una Ciudad</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label class="form-label">Dirección</label>
                                                                            <input type="text" class="form-control" name="direccion1" placeholder="Ingrese la Dirección de la Empresa">
                                                                        </div>
                                                                    </div>

                                                                    <!-- VISITA -->
                                                                    <h6 class="text-center text-muted fw-bold bg-light p-2 rounded mt-4">Registro de Visita</h6>

                                                                    <div class="row g-3">
                                                                        <div class="col-12">
                                                                            <label class="form-label">Tipo de Visita</label>
                                                                            <select name="id_tipo_visita" class="form-select" required>
                                                                                <option value="" disabled selected>Seleccione una opción</option>
                                                                                <?php
                                                                                $consulta_mysql = 'select * from tipo_visita where id_tipo_visita > 0 and id_tipo_visita < 8';
                                                                                $resultado = mysqli_query($enlace, $consulta_mysql);
                                                                                while ($lista = mysqli_fetch_assoc($resultado)) {
                                                                                    echo "<option value='{$lista["id_tipo_visita"]}'>{$lista["tipo_visita"]}</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label class="form-label">Descripción</label>
                                                                            <textarea class="form-control" name="descripcion_visita" placeholder="Ingresa una descripción" rows="4" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- FOOTER -->
                                                                <div class="modal-footer mt-3">
                                                                    <button type="submit" name="submit_crear_nuevo" class="btn btn-success">Guardar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- cliente Antiguo -->
                                                        <div class="tab-pane fade" id="clienteAntiguo" role="tabpanel" aria-labelledby="clienteAntiguo-tab">
                                                            <form action="" method="post" id="formularioClienteAntiguo" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">
                                                                <div class="col"><br>
                                                                    <h6 class="text-center text-muted fw-bold bg-light p-2 rounded mt-3">Datos del Cliente</h6>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Elija un Cliente:</label>
                                                                        <div class="position-relative">
                                                                            <!-- Input con estilo Bootstrap -->
                                                                            <input type="text" id="comboCliente" class="form-control" placeholder="Buscar cliente..." autocomplete="off" required>

                                                                            <!-- Lista desplegable -->
                                                                            <div id="comboList" class="combobox-list list-group"></div>

                                                                            <!-- Campo oculto donde guardo el NIT real -->
                                                                            <input type="hidden" name="nit" id="nitReal">
                                                                        </div>
                                                                    </div>
                                                                    <h6 class="text-center text-muted fw-bold bg-light p-2 rounded mt-3">Registro de Visita</h6>
                                                                    <div class="mb-2">
                                                                        <label class="form-label">Elija el tipo de visita:</label>
                                                                        <select name="id_tipo_visita" class="form-select" required>
                                                                            <option value="" disabled selected hidden>Seleccione una opción</option>
                                                                            <?php
                                                                            $consulta_mysql = 'select * from tipo_visita where id_tipo_visita > 0 and id_tipo_visita < 8';
                                                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                                $id = $lista["id_tipo_visita"];
                                                                                $visita = $lista["tipo_visita"];
                                                                                $selected = ($visita == $fila['tipo_visita']) ? 'selected' : '';
                                                                                echo "<option value='$id' $selected>$visita</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Descripcion de la Visita:</label>
                                                                        <textarea class="form-control" name="descripcion_visita" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="6" required></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="submit_crear_viejo" class="btn btn-success">Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Visitada<br>Realizada por</th>
                                                    <th style="text-align: center; vertical-align: middle;">Cliente</th>
                                                    <th style="text-align: center; vertical-align: middle;">Fecha de la Visita</th>
                                                    <th style="text-align: center; vertical-align: middle;">Datos de la Visita</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 13%;">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $consulta = "SELECT cliente.nit, cliente.cliente, cliente.representante_legal, cliente.celular_representante, cliente.correo_representante, cliente.contacto, cliente.celular_contacto, cliente.correo_contacto,
                                            visita.nit, visita.id_visita, visita.id_tipo_visita, visita.fecha_visita, visita.descripcion_visita, tipo_visita.id_tipo_visita, tipo_visita.tipo_visita, usuario.id_usuario, usuario.encargado
                                            FROM cliente LEFT JOIN visita ON visita.nit = cliente.nit LEFT JOIN tipo_visita ON tipo_visita.id_tipo_visita = visita.id_tipo_visita LEFT JOIN usuario ON usuario.id_usuario = visita.id_usuario
                                            ORDER BY visita.fecha_visita DESC";

                                                $resultado = mysqli_query($enlace, $consulta);

                                                while ($fila = mysqli_fetch_array($resultado)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?php echo $fila['encargado']; ?></td>
                                                        <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                        <td class="text-center align-middle">
                                                            <?php
                                                            setlocale(LC_TIME, 'spanish');
                                                            echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila['fecha_visita']));
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <center><strong>Tipo de visita: <?php echo $fila['tipo_visita']; ?></strong></center><br><strong>Descripcion: </strong><?php echo $fila['descripcion_visita']; ?>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div>
                                                                <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id_visita']; ?>">
                                                                    <i class="bi bi-pencil-square"></i> Editar Visita
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

                                        <!-- Modal Editar -->
                                        <div class="modal fade" id="modalEditar<?php echo $fila['id_visita']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content rounded-4">
                                                    <div class="modal-header" style="background-color: #000DD3;">
                                                        <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a Editar</h5>
                                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_visita" value="<?php echo $fila['id_visita']; ?>">
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Elija el tipo de visita:</label>
                                                                <select name="id_tipo_visita" class="form-select">
                                                                    <?php
                                                                    $consulta_mysql = 'select * from tipo_visita where id_tipo_visita > 1 and id_tipo_visita < 8';
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                        $id = $lista["id_tipo_visita"];
                                                                        $visita = $lista["tipo_visita"];
                                                                        $selected = ($visita == $fila['tipo_visita']) ? 'selected' : '';
                                                                        echo "<option value='$id' $selected>$visita</option>";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;">Descripcion de la Visita:</label>
                                                                <textarea class="form-control" name="descripcion_visita" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="6"><?php echo $fila['descripcion_visita']; ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
            
            <script>
                // Opciones cargadas desde PHP
                const clientes = [
                    <?php
                    $consulta_mysql = 'SELECT * FROM cliente ORDER BY cliente ASC';
                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                    $opciones = [];
                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                        $id = $lista["nit"];
                        $cliente = $lista["cliente"];
                        $cod = $lista["cod_cliente"];
                        $opciones[] = "{id: '$id', texto: '" . addslashes($cliente . " - " . $cod) . "'}";
                    }
                    echo implode(",", $opciones);
                    ?>
                ];

                const input = document.getElementById("comboCliente");
                const list = document.getElementById("comboList");
                const hidden = document.getElementById("nitReal");

                // Mostrar coincidencias en vivo
                input.addEventListener("input", function() {
                    const filtro = this.value.toLowerCase();
                    list.innerHTML = "";

                    if (filtro === "") {
                        list.style.display = "none";
                        return;
                    }

                    const resultados = clientes.filter(c => c.texto.toLowerCase().includes(filtro));

                    if (resultados.length === 0) {
                        list.style.display = "none";
                        return;
                    }

                    resultados.forEach(c => {
                        const div = document.createElement("div");
                        div.className = "list-group-item list-group-item-action combobox-item";
                        div.textContent = c.texto;
                        div.dataset.id = c.id;

                        div.addEventListener("click", function() {
                            input.value = c.texto;
                            hidden.value = c.id; // Guardar el NIT real
                            list.style.display = "none";
                        });

                        list.appendChild(div);
                    });

                    list.style.display = "block";
                });

                // Cerrar lista si se hace clic afuera
                document.addEventListener("click", function(e) {
                    if (!e.target.closest(".position-relative")) {
                        list.style.display = "none";
                    }
                });
            </script>
            <script>
                $(document).ready(function() {
                    var table = new DataTable('#mytabla', {
                        "ordering": false, 
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
                // Establecer la fecha mínima automáticamente al día de hoy
                var today = new Date().toISOString().split('T')[0];
                document.getElementById('fecha_cierre').setAttribute('min', today);
            </script>
            <script>
                $(document).ready(function() {
                    $('#ubicacion2').on('shown.bs.collapse', function() {
                        // Acción después de mostrar el contenido
                    });

                    $('#ubicacion2').on('hidden.bs.collapse', function() {
                        // Acción después de ocultar el contenido
                    });
                    $('#ubicacion3').on('shown.bs.collapse', function() {
                        // Acción después de mostrar el contenido
                    });

                    $('#ubicacion3').on('hidden.bs.collapse', function() {
                        // Acción después de ocultar el contenido
                    });

                    $('#contacto2').on('shown.bs.collapse', function() {
                        // Acción después de mostrar el contenido
                    });

                    $('#contacto2').on('hidden.bs.collapse', function() {
                        // Acción después de ocultar el contenido
                    });

                    $('#contacto3').on('shown.bs.collapse', function() {
                        // Acción después de mostrar el contenido
                    });

                    $('#contacto3').on('hidden.bs.collapse', function() {
                        // Acción después de ocultar el contenido
                    });

                    $('#contacto4').on('shown.bs.collapse', function() {
                        // Acción después de mostrar el contenido
                    });

                    $('#contacto4').on('hidden.bs.collapse', function() {
                        // Acción después de ocultar el contenido
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    const URL = "https://www.datos.gov.co/resource/gdxc-w37w.json";

                    function cargarDepartamentos() {
                        fetch(URL)
                            .then(res => res.json())
                            .then(data => {
                                const select = document.getElementById("departamento1");
                                select.innerHTML = "<option value=''>Elige un Departamento</option>";

                                // 🔥 usar dpto
                                let departamentos = [...new Set(data.map(item => item.dpto))];
                                departamentos.sort();

                                departamentos.forEach(dep => {
                                    let option = document.createElement("option");
                                    option.value = dep;
                                    option.text = dep;
                                    select.add(option);
                                });
                            });
                    }

                    function cargarCiudades() {
                        const dep = document.getElementById("departamento1").value;
                        const select = document.getElementById("ciudad1");

                        select.innerHTML = "<option value=''>Elige una Ciudad</option>";

                        fetch(URL)
                            .then(res => res.json())
                            .then(data => {

                                // 🔥 filtrar por dpto
                                let ciudades = data
                                    .filter(item => item.dpto === dep)
                                    .map(item => item.nom_mpio);

                                ciudades = [...new Set(ciudades)];
                                ciudades.sort();

                                ciudades.forEach(ciudad => {
                                    let option = document.createElement("option");
                                    option.value = ciudad;
                                    option.text = ciudad;
                                    select.add(option);
                                });

                                select.disabled = false;
                            });
                    }

                    cargarDepartamentos();

                    document.getElementById("departamento1")
                        .addEventListener("change", cargarCiudades);

                });
            </script>
            <script>
                setTimeout(function() {
                    document.getElementById('successAlert').style.display = 'none';
                }, 5000);
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxes = document.querySelectorAll('input[name="meses_entrega[]"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            const checkedBoxes = document.querySelectorAll('input[name="meses_entrega[]"]:checked');
                            if (checkedBoxes.length > 3) {
                                this.checked = false;
                                alert('Solo puede seleccionar un máximo de 3 meses.');
                            }
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.getElementById("formularioClienteNuevo");

                    // Escucha el evento de envío
                    form.addEventListener("submit", function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault(); // evita enviar
                            form.reportValidity(); // muestra mensajes en cada campo vacío
                        }
                    });

                    // Personalizar mensajes por cada campo
                    const inputs = form.querySelectorAll("[required]");
                    inputs.forEach(input => {
                        input.addEventListener("invalid", function() {
                            if (!input.value) {
                                input.setCustomValidity("Este campo es obligatorio.");
                            } else {
                                input.setCustomValidity("");
                            }
                        });

                        // Reinicia mensaje cuando empieza a escribir
                        input.addEventListener("input", function() {
                            input.setCustomValidity("");
                        });
                    });
                });
            </script>
    </body>
</html>