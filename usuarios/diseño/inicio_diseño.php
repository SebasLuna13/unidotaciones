<?php
    require_once('../../conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'diseño') {
            header("Location: inicio_diseño.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_POST['submit_finalizar'])) {

        // Conexión a la base de datos (Asegúrate de que $enlace está definido)
        $id_producto = $_POST['id_producto'];
        $frentes = isset($_POST['frentes']) ? $_POST['frentes'] : '';
        $espalda = isset($_POST['espalda']) ? $_POST['espalda'] : '';
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : '';
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : '';
        $puño = isset($_POST['puño']) ? $_POST['puño'] : '';
        $delanteros = isset($_POST['delanteros']) ? $_POST['delanteros'] : '';
        $traseros = isset($_POST['traseros']) ? $_POST['traseros'] : '';
        $pretina = isset($_POST['pretina']) ? $_POST['pretina'] : '';
        $ensamble = isset($_POST['ensamble']) ? $_POST['ensamble'] : '';
        $fajon = isset($_POST['fajon']) ? $_POST['fajon'] : '';
        $forro = isset($_POST['forro']) ? $_POST['forro'] : '';
        $otros = isset($_POST['otros']) ? $_POST['otros'] : '';
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : '';
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : '';
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : '';
        $color_entretela = isset($_POST['color_entretela']) ? $_POST['color_entretela'] : '';
        date_default_timezone_set('America/Bogota');
        $fecha_subida = date('Y-m-d H:i:s');
        $fecha_produccion = date('Y-m-d H:i:s');
        $ficha_tecnica = isset($_POST['ficha_tecnica']) ? $_POST['ficha_tecnica'] : null;
        $ficha_nombre = isset($_FILES['ficha_tecnica']['name']) ? $_FILES['ficha_tecnica']['name'] : null;
        $ficha_temporal = isset($_FILES['ficha_tecnica']['tmp_name']) ? $_FILES['ficha_tecnica']['tmp_name'] : null;
        move_uploaded_file($ficha_temporal, "../../fichas_tecnicas/" . $ficha_nombre);

        // Primera consulta: insertar en ficha_tecnica
        $consulta = "INSERT INTO ficha_tecnica (id_producto, ficha_tecnica, color_entretela, fecha_subida) VALUES ('$id_producto', '$ficha_nombre', '$color_entretela', '$fecha_subida')";
        $resultado = mysqli_query($enlace, $consulta);

        // Segunda consulta: actualizar producto
        $consulta2 = "UPDATE producto SET color_tela = '$color_tela', color_telacombi = '$color_telacombi', color_telaforro = '$color_telaforro', frentes = '$frentes', 
                                        espalda = '$espalda', mangas = '$mangas', cuello = '$cuello', puño = '$puño', delanteros = '$delanteros', traseros = '$traseros', pretina = '$pretina', 
                                        ensamble = '$ensamble', fajon = '$fajon', forro = '$forro', otros = '$otros', fecha_produccion = '$fecha_produccion', estado = 'AceptadoD' WHERE id_producto = '$id_producto'";

        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: inicio_diseño.php");
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

        <title>Diseño | Inicio Diseño</title>

    <head>
    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%);">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="navbar-brand text-center" href="inicio_diseño.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 60px;">
                    </a>
                </div>
                <hr class="sidebar-divider my-0 bg-white opacity-50">

                <div class="px-2 mt-3">
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="inicio_diseño.php">
                            <i class="bi bi-card-checklist"></i>
                            <span>Fichas Tecnicas</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link sidebar-link" href="fichas_subidas_diseño.php">
                            <i class="bi bi-clipboard-check-fill"></i>
                            <span>Fichas Tecnicas Subidas</span>
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
                        <h1 style="font-family: 'Times New Roman'">Fichas Técnicas</h1>
                    </div>

                    <!-- DataTable -->
                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row">
                                <br><br>
                                <div class="table-responsive">
                                    <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle; width: 10%;">Nro. Ficha</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Tipo de Producto</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Cliente</th>
                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Fecha Llegada<br>a Diseño</th>
                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Fecha Entrega<br>Producto</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "SELECT pedido.id_pedido, producto.id_producto, ficha_tecnica.num_ficha, ficha_tecnica.id_producto AS id_producto_ficha, prenda.id_prenda, 
                                                                prenda.nombre_prenda, prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto, 
                                                                cliente.nit, cliente.cliente, producto.estado, producto.id_tipo_producto, ficha_tecnica.fecha_pedido, ficha_tecnica.fecha_entrega
                                                                    FROM pedido 
                                                                    LEFT JOIN cliente ON pedido.nit = cliente.nit 
                                                                    LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido 
                                                                    LEFT JOIN ficha_tecnica ON producto.id_producto = ficha_tecnica.id_producto
                                                                    LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                    LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada
                                                                    WHERE producto.estado = 'Diseño' ORDER BY ficha_tecnica.fecha_pedido ASC";

                                            $resultado = mysqli_query($enlace, $consulta);

                                            while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                                <tr>
                                                    <td class="text-center align-middle"><?php echo $fila['num_ficha']; ?></td>
                                                    <?php if ($fila['id_tipo_producto'] == 8): ?>
                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                                    <?php else: ?>
                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_prenda']); ?></td>
                                                    <?php endif; ?>
                                                    <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>

                                                    <?php
                                                    $meses = [1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'];

                                                    $fecha1 = new DateTime($fila['fecha_pedido']);
                                                    $fecha2 = new DateTime($fila['fecha_entrega']);
                                                    ?>

                                                    <td class="text-center align-middle">
                                                        <?= $fecha1->format('d') . ' de ' . $meses[$fecha1->format('n')] . ' del ' . $fecha1->format('Y') . ', a las ' . $fecha1->format('H:i:s'); ?>
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        <?= $fecha2->format('d') . ' de ' . $meses[$fecha2->format('n')] . ' del ' . $fecha2->format('Y'); ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalFichaTecnica<?= $fila['id_producto'] ?>"
                                                            data-id-producto="<?= $fila['id_producto'] ?>">
                                                            <i class="bi bi-search"></i> Datos del Producto
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                    $id_producto = $fila['id_producto'];
                                ?>

                                    <!-- Modal Ficha Tecnica -->
                                    <div class="modal fade" id="modalFichaTecnica<?php echo $fila['id_producto']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered mw-100 w-100 px-5">
                                            <div class="modal-content shadow-lg border-0 rounded-4">
                                                <?php
                                                $consulta = "SELECT usuario.id_usuario, pedido.id_pedido, pedido.id_usuario, producto.id_producto, ficha_tecnica.num_ficha, ficha_tecnica.id_producto AS id_producto_ficha, producto.estado, pedido.total_factura, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.id_cargo, cargo.cargo,
                                                                producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4, 
                                                                producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.precio_iva, producto.precio_total, 
                                                                
                                                                producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.valor_agregado, 
                                                                producto.boton, producto.logo, producto.cremallera, 

                                                                prenda.id_prenda, prenda.nombre_prenda, prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto,tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, pedido.prendas_realizar,
                                                                pedido.nit, cliente.nit, cliente.cod_cliente, cliente.cliente, cliente.direccion1,
                                                                producto.precio_compra,producto.costo_total, mano_obra.id_mano_obra, mano_obra.producto, 
                                                                entrega.id_entrega,

                                                                tela.id_tela, tela.tela, tela.ancho AS ancho_tela, tela.peso AS peso_tela, tela.caracteristicas AS caracteristicas_tela, tela.rendimiento, tela.encogimiento, producto.promedio_consumo, producto.precio_tela, producto.valor_tela, 
                                                                tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.ancho AS ancho_telacombi, tela_combinada.peso AS peso_telacombi, tela_combinada.caracteristicas AS caracteristicas_combi, tela_combinada.rendimiento AS rend_telacombi, tela_combinada.encogimiento AS encog_telacombi, producto.promedio_telacombi, producto.precio_telacombinada, producto.valor_telacombi,
                                                                tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.ancho AS ancho_forro, tela_forro.peso AS peso_forro, tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.rendimiento AS rend_forro, tela_forro.encogimiento AS encog_forro, producto.promedio_forro, producto.precio_forro, producto.valor_forro,
                                                                producto.color_tela, producto.color_tela2, producto.color_tela3, producto.color_tela4, producto.color_tela5, producto.color_tela6,
                                                                producto.color_telacombi, producto.color_telacombi2, producto.color_telacombi3, producto.color_telacombi4, producto.color_telacombi5, producto.color_telacombi6,
                                                                producto.color_telaforro, producto.color_telaforro2, producto.color_telaforro3, producto.color_telaforro4, producto.color_telaforro5, producto.color_telaforro6,
                                                                
                                                                ficha_tecnica.fecha_comercial, ficha_tecnica.fecha_ficha_tecnica, ficha_tecnica.fecha_pedido, ficha_tecnica.fecha_entrega, ficha_tecnica.forma_pago,
                                                                ficha_tecnica.manga, ficha_tecnica.genero, ficha_tecnica.bolsillo, ficha_tecnica.lavado, ficha_tecnica.bordado, ficha_tecnica.muestra, ficha_tecnica.cuello_option, ficha_tecnica.empaque,
                                                                ficha_tecnica.codigo_tela, ficha_tecnica.codigo_tela2, ficha_tecnica.codigo_tela3, ficha_tecnica.codigo_tela4, ficha_tecnica.codigo_tela5, ficha_tecnica.codigo_tela6,
                                                                ficha_tecnica.area_tela, ficha_tecnica.area_tela2, ficha_tecnica.area_tela3, ficha_tecnica.area_tela4, ficha_tecnica.area_tela5, ficha_tecnica.area_tela6,
                                                                ficha_tecnica.composicion, ficha_tecnica.composicion2, ficha_tecnica.composicion3, ficha_tecnica.composicion4, ficha_tecnica.composicion5, ficha_tecnica.composicion6,
                                                                ficha_tecnica.ubicacion_combinado, ficha_tecnica.codigo_telacombi, ficha_tecnica.codigo_telacombi2, ficha_tecnica.codigo_telacombi3, ficha_tecnica.codigo_telacombi4, ficha_tecnica.codigo_telacombi5, ficha_tecnica.codigo_telacombi6,
                                                                ficha_tecnica.ubicacion_forro, ficha_tecnica.codigo_telaforro, ficha_tecnica.codigo_telaforro2, ficha_tecnica.codigo_telaforro3, ficha_tecnica.codigo_telaforro4, ficha_tecnica.codigo_telaforro5, ficha_tecnica.codigo_telaforro6,
                                                                ficha_tecnica.codigo_molde, ficha_tecnica.tipo_opcion, ficha_tecnica.opcion_escrito, ficha_tecnica.ojales, ficha_tecnica.coser, ficha_tecnica.ref_sugerida, ficha_tecnica.observacion_tallas,
                                                                ficha_tecnica.talla_XS, ficha_tecnica.talla_S, ficha_tecnica.talla_M, ficha_tecnica.talla_L, ficha_tecnica.talla_XL, ficha_tecnica.talla_2XL, ficha_tecnica.talla_3XL, ficha_tecnica.talla_4XL, ficha_tecnica.talla_5XL, ficha_tecnica.talla_6XL,
                                                                ficha_tecnica.talla_4, ficha_tecnica.talla_6, ficha_tecnica.talla_8, ficha_tecnica.talla_10, ficha_tecnica.talla_12, ficha_tecnica.talla_14, ficha_tecnica.talla_16, ficha_tecnica.talla_18, ficha_tecnica.talla_20, ficha_tecnica.talla_22,
                                                                ficha_tecnica.talla2_XS, ficha_tecnica.talla2_S, ficha_tecnica.talla2_M, ficha_tecnica.talla2_L, ficha_tecnica.talla2_XL, ficha_tecnica.talla2_2XL, ficha_tecnica.talla2_3XL, ficha_tecnica.talla2_4XL, ficha_tecnica.talla2_5XL, ficha_tecnica.talla2_6XL,
                                                                ficha_tecnica.talla2_4, ficha_tecnica.talla2_6, ficha_tecnica.talla2_8, ficha_tecnica.talla2_10, ficha_tecnica.talla2_12, ficha_tecnica.talla2_14, ficha_tecnica.talla2_16, ficha_tecnica.talla2_18, ficha_tecnica.talla2_20, ficha_tecnica.talla2_22,
                                                                ficha_tecnica.talla3_XS, ficha_tecnica.talla3_S, ficha_tecnica.talla3_M, ficha_tecnica.talla3_L, ficha_tecnica.talla3_XL, ficha_tecnica.talla3_2XL, ficha_tecnica.talla3_3XL, ficha_tecnica.talla3_4XL, ficha_tecnica.talla3_5XL, ficha_tecnica.talla3_6XL,
                                                                ficha_tecnica.talla3_4, ficha_tecnica.talla3_6, ficha_tecnica.talla3_8, ficha_tecnica.talla3_10, ficha_tecnica.talla3_12, ficha_tecnica.talla3_14, ficha_tecnica.talla3_16, ficha_tecnica.talla3_18, ficha_tecnica.talla3_20, ficha_tecnica.talla3_22,
                                                                ficha_tecnica.talla4_XS, ficha_tecnica.talla4_S, ficha_tecnica.talla4_M, ficha_tecnica.talla4_L, ficha_tecnica.talla4_XL, ficha_tecnica.talla4_2XL, ficha_tecnica.talla4_3XL, ficha_tecnica.talla4_4XL, ficha_tecnica.talla4_5XL, ficha_tecnica.talla4_6XL,
                                                                ficha_tecnica.talla4_4, ficha_tecnica.talla4_6, ficha_tecnica.talla4_8, ficha_tecnica.talla4_10, ficha_tecnica.talla4_12, ficha_tecnica.talla4_14, ficha_tecnica.talla4_16, ficha_tecnica.talla4_18, ficha_tecnica.talla4_20, ficha_tecnica.talla4_22,
                                                                ficha_tecnica.talla5_XS, ficha_tecnica.talla5_S, ficha_tecnica.talla5_M, ficha_tecnica.talla5_L, ficha_tecnica.talla5_XL, ficha_tecnica.talla5_2XL, ficha_tecnica.talla5_3XL, ficha_tecnica.talla5_4XL, ficha_tecnica.talla5_5XL, ficha_tecnica.talla5_6XL,
                                                                ficha_tecnica.talla5_4, ficha_tecnica.talla5_6, ficha_tecnica.talla5_8, ficha_tecnica.talla5_10, ficha_tecnica.talla5_12, ficha_tecnica.talla5_14, ficha_tecnica.talla5_16, ficha_tecnica.talla5_18, ficha_tecnica.talla5_20, ficha_tecnica.talla5_22,
                                                                ficha_tecnica.talla6_XS, ficha_tecnica.talla6_S, ficha_tecnica.talla6_M, ficha_tecnica.talla6_L, ficha_tecnica.talla6_XL, ficha_tecnica.talla6_2XL, ficha_tecnica.talla6_3XL, ficha_tecnica.talla6_4XL, ficha_tecnica.talla6_5XL, ficha_tecnica.talla6_6XL,
                                                                ficha_tecnica.talla6_4, ficha_tecnica.talla6_6, ficha_tecnica.talla6_8, ficha_tecnica.talla6_10, ficha_tecnica.talla6_12, ficha_tecnica.talla6_14, ficha_tecnica.talla6_16, ficha_tecnica.talla6_18, ficha_tecnica.talla6_20, ficha_tecnica.talla6_22,
                                                                ficha_tecnica.talla_especial, ficha_tecnica.talla2_especial, ficha_tecnica.talla3_especial, ficha_tecnica.talla4_especial, ficha_tecnica.talla5_especial, ficha_tecnica.talla6_especial
                                                                FROM pedido
                                                                LEFT JOIN usuario ON pedido.id_usuario = usuario.id_usuario
                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit
                                                                LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido
                                                                LEFT JOIN ficha_tecnica ON producto.id_producto = ficha_tecnica.id_producto
                                                                LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto
                                                                LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo
                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda
                                                                LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada
                                                                LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda
                                                                LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra
                                                                LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega
                                                                LEFT JOIN tela ON producto.id_tela = tela.id_tela
                                                                LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi
                                                                LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro 
                                                                WHERE producto.estado = 'Diseño' AND producto.id_producto = '$id_producto'";

                                                $resultado = mysqli_query($enlace, $consulta);

                                                $fila = mysqli_fetch_array($resultado);
                                                ?>

                                                <div class="modal-body">
                                                    <ul class="nav nav-tabs" id="myTab<?php echo $id_producto; ?>" role="tablist">

                                                        <li class="nav-item">
                                                            <button class="nav-link active" id="dotaciones-tab<?php echo $id_producto; ?>" data-bs-toggle="tab"
                                                                data-bs-target="#dotaciones<?php echo $id_producto; ?>" type="button"> Dotaciones
                                                            </button>
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" id="ilustracion-tab<?php echo $id_producto; ?>" data-bs-toggle="tab"
                                                                data-bs-target="#ilustracion<?php echo $id_producto; ?>" type="button"> Ilustración
                                                            </button>
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" id="descripcion-tab<?php echo $id_producto; ?>" data-bs-toggle="tab"
                                                                data-bs-target="#descripcion<?php echo $id_producto; ?>" type="button"> Descripción
                                                            </button>
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" id="insumos-tab<?php echo $id_producto; ?>" data-bs-toggle="tab"
                                                                data-bs-target="#insumos<?php echo $id_producto; ?>" type="button"> Insumos
                                                            </button>
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" id="bordado-tab<?php echo $id_producto; ?>" data-bs-toggle="tab"
                                                                data-bs-target="#bordado<?php echo $id_producto; ?>" type="button"> Bordado - Estampado
                                                            </button>
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" id="novedad-tab<?php echo $id_producto; ?>" data-bs-toggle="tab"
                                                                data-bs-target="#novedad<?php echo $id_producto; ?>" type="button"> Novedad
                                                            </button>
                                                        </li>

                                                    </ul>

                                                    <div class="tab-content mt-3">
                                                        <!-- DOTACIONES -->
                                                        <div class="tab-pane fade show active" id="dotaciones<?php echo $id_producto; ?>" role="tabpanel">
                                                            <form method="post" id="formularioDotaciones<?php echo $id_producto; ?>">
                                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

                                                                <div class="modal-header text-white justify-content-center position-relative" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                                    <div class="d-flex align-items-center text-center">
                                                                        <img src="../../img/unidotaciones.png" alt="Logo" width="150" class="me-3 rounded">
                                                                    </div>
                                                                </div>
                                                                <div class="text-white text-center py-2 fw-bold" style="background-color:#18a000;">
                                                                    FICHA TÉCNICA DE PRODUCCIÓN
                                                                </div>

                                                                <!-- FECHAS -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 17%;">Fecha Comercial</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 17%;">Fecha Ficha Tecnica</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 17%;">Fecha Trazo</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 17%;">Fecha Corte</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 16%;">Fecha Numeracion</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 16%;">Personalizado</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <?= date('d/m/Y', strtotime($fila['fecha_comercial'])); ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?= date('d/m/Y'); ?>
                                                                                        <input type="hidden" name="fecha_ficha_tecnica" value="<?= date('Y-m-d'); ?>">
                                                                                    </td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td>
                                                                                        <?php echo ($fila['id_entrega'] == 2) ? 'Sí' : 'No'; ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- ENCABEZADO FICHA -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <!-- BLOQUE IZQUIERDO 40% -->
                                                                                    <td class="fw-bold text-end" style="width:12%;">Fecha Pedido:</td>
                                                                                    <td class="text-center" style="width:28%;">
                                                                                        <?php
                                                                                        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain');
                                                                                        $fecha = new DateTime($fila['fecha_pedido']);

                                                                                        $dias = [
                                                                                            'Sunday'    => 'Domingo',
                                                                                            'Monday'    => 'Lunes',
                                                                                            'Tuesday'   => 'Martes',
                                                                                            'Wednesday' => 'Miércoles',
                                                                                            'Thursday'  => 'Jueves',
                                                                                            'Friday'    => 'Viernes',
                                                                                            'Saturday'  => 'Sábado'
                                                                                        ];

                                                                                        $meses = [
                                                                                            'January'   => 'enero',
                                                                                            'February'  => 'febrero',
                                                                                            'March'     => 'marzo',
                                                                                            'April'     => 'abril',
                                                                                            'May'       => 'mayo',
                                                                                            'June'      => 'junio',
                                                                                            'July'      => 'julio',
                                                                                            'August'    => 'agosto',
                                                                                            'September' => 'septiembre',
                                                                                            'October'   => 'octubre',
                                                                                            'November'  => 'noviembre',
                                                                                            'December'  => 'diciembre'
                                                                                        ];

                                                                                        echo $dias[$fecha->format('l')] . ', ' . $fecha->format('d') . ' de ' . $meses[$fecha->format('F')] . ' del ' . $fecha->format('Y');
                                                                                        ?>
                                                                                    </td>

                                                                                    <!-- BLOQUE DERECHO 60% -->
                                                                                    <td class="fw-bold text-center" style="width:11%;">Fecha de Entrega:</td>
                                                                                    <td class="text-center" style="width:20%;">
                                                                                        <?= date('d/m/Y', strtotime($fila['fecha_entrega'])); ?>
                                                                                    </td>

                                                                                    <td class="fw-bold text-center" style="width:17%;">Número de Ficha</td>
                                                                                    <td class="text-center fw-bold" style="width:12%; background:#ffff00;">
                                                                                        <span style="background:#ffff00;"><?php echo htmlspecialchars($fila['num_ficha']); ?></span>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="fw-bold text-end">Ciudad:</td>
                                                                                    <td class="text-center">PEREIRA</td>

                                                                                    <td class="fw-bold text-center">Cliente:</td>
                                                                                    <td class="text-center fw-bold" colspan="3" style="color:red;">
                                                                                        <?php echo htmlspecialchars($fila['cliente']); ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="fw-bold text-end">Destino:</td>
                                                                                    <td class="text-center">UNIDOTACIONES DEL EJE S.A.S</td>

                                                                                    <td class="fw-bold text-center">NIT:</td>
                                                                                    <td class="text-center">
                                                                                        <?php echo htmlspecialchars($fila['cod_cliente']); ?>
                                                                                    </td>

                                                                                    <td class="fw-bold text-center">Forma de Pago:</td>
                                                                                    <td class="text-center fw-bold">
                                                                                        <span style="color: red;"><?php echo htmlspecialchars($fila['forma_pago']); ?></span>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="fw-bold text-end">Cuenta:</td>
                                                                                    <td class="text-center">9.011.918.976</td>

                                                                                    <td class="fw-bold text-center">Dirección:</td>
                                                                                    <td class="text-center" colspan="3">
                                                                                        <?php echo htmlspecialchars($fila['direccion1']); ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- FIRMAS -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 34%;">Revisado y Aprobado Por:</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 33%;">Cortado Por:</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 33%;">Numerado Por:</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>ALEJANDRA GARCIA</td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- PRENDA -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 20%;">Prenda</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 9%;">Manga</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Genero</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 7%;">Marca</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 7%;">Bolsillo</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 7%;">Lavado</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 7%;">Bordado</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 9%;">Muestra F</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Cuello</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 12%;">Tipo de Empaque</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo htmlspecialchars($fila['producto']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($fila['manga']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($fila['genero']); ?></td>
                                                                                    <td>UDE</td>
                                                                                    <td style="background:#ffff00;"><span style="background:#ffff00;"><?php echo htmlspecialchars($fila['bolsillo']); ?></span></td>
                                                                                    <td><?php echo htmlspecialchars($fila['lavado']); ?></td>
                                                                                    <td style="background:#ffff00;"><span style="background:#ffff00;"><?php echo htmlspecialchars($fila['bordado']); ?></span></td>
                                                                                    <td><?php echo htmlspecialchars($fila['muestra']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($fila['cuello_option']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($fila['empaque']); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- TELA -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <?php
                                                                    $colores = [];
                                                                    for ($i = 1; $i <= 6; $i++) {
                                                                        $clave = ($i == 1) ? 'color_tela' : 'color_tela' . $i;
                                                                        if (!empty($fila[$clave])) {
                                                                            $colores[] = [
                                                                                'sufijo' => ($i == 1) ? '' : $i,
                                                                                'valor'  => $fila[$clave]
                                                                            ];
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 10%;">Codigo</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 12%;">Color</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 35%;">Nombre de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 20%;">Composicion</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 13%;">AREA</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php foreach ($colores as $c): ?>

                                                                                    <?php
                                                                                    $sufijo = $c['sufijo'];

                                                                                    $campoCodigo = 'codigo_tela' . $sufijo;
                                                                                    $campoColor  = 'color_tela' . $sufijo;
                                                                                    $campoArea   = 'area_tela' . $sufijo;
                                                                                    ?>

                                                                                    <tr>
                                                                                        <td><?= htmlspecialchars($fila[$campoCodigo]); ?></td>
                                                                                        <td><?= htmlspecialchars($fila[$campoColor]); ?></td>
                                                                                        <td><?= htmlspecialchars($fila['tela']); ?></td>
                                                                                        <td><?= htmlspecialchars($fila['caracteristicas_tela']); ?></td>
                                                                                        <td><?= htmlspecialchars($fila['ancho_tela']); ?></td>
                                                                                        <td style="background:#ffff00;">
                                                                                            <?= htmlspecialchars($fila[$campoArea]); ?>
                                                                                        </td>
                                                                                    </tr>

                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- TELA COMBINADA -->
                                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                                    <div class="card shadow-sm border-0 mb-3">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm align-middle mb-0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="table-primary fw-bold text-center" style="width:10%;">Combinado</td>
                                                                                        <td class="table-primary" style="width:90%; text-align:center;">
                                                                                            <?= htmlspecialchars($fila['ubicacion_combinado']); ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                    $colores_combi = [];
                                                                    for ($i = 1; $i <= 6; $i++) {
                                                                        $clave = ($i == 1) ? 'color_telacombi' : 'color_telacombi' . $i;
                                                                        if (!empty($fila[$clave])) {
                                                                            $colores_combi[] = [
                                                                                'sufijo' => ($i == 1) ? '' : $i,
                                                                                'valor'  => $fila[$clave]
                                                                            ];
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <div class="card shadow-sm border-0 mb-3">
                                                                        <div class="table-responsive">
                                                                            <table id="mytabla" class="table table-bordered table-sm text-center mb-0">
                                                                                <thead>
                                                                                    <tr class="table-primary">
                                                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Codigo</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 12%;">Color</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 35%;">Nombre de la Tela Combinada</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 20%;">Composicion</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($colores_combi as $c): ?>

                                                                                        <?php
                                                                                        $sufijo = $c['sufijo'];

                                                                                        $campoCodigo = 'codigo_telacombi' . $sufijo;
                                                                                        $campoColor  = 'color_telacombi' . $sufijo;
                                                                                        ?>

                                                                                        <tr>
                                                                                            <td><?= htmlspecialchars($fila[$campoCodigo]); ?></td>
                                                                                            <td><?= htmlspecialchars($fila[$campoColor]); ?></td>
                                                                                            <td><?= htmlspecialchars($fila['tela_combi']); ?></td>
                                                                                            <td><?= htmlspecialchars($fila['caracteristicas_combi']); ?></td>
                                                                                            <td><?= htmlspecialchars($fila['ancho_telacombi']); ?></td>

                                                                                        </tr>

                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <!-- TELA FORRO -->
                                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                                    <div class="card shadow-sm border-0 mb-3">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm align-middle mb-0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fw-bold text-center" style="width:10%;">Forro</td>
                                                                                        <td style="width:90%; text-align:center;">
                                                                                            <?= htmlspecialchars($fila['ubicacion_forro']); ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                    $colores_forro = [];
                                                                    for ($i = 1; $i <= 6; $i++) {
                                                                        $clave = ($i == 1) ? 'color_telaforro' : 'color_telaforro' . $i;
                                                                        if (!empty($fila[$clave])) {
                                                                            $colores_forro[] = [
                                                                                'sufijo' => ($i == 1) ? '' : $i,
                                                                                'valor'  => $fila[$clave]
                                                                            ];
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <div class="card shadow-sm border-0 mb-3">
                                                                        <div class="table-responsive">
                                                                            <table id="mytabla" class="table table-bordered table-sm text-center mb-0">
                                                                                <thead>
                                                                                    <tr class="table-primary">
                                                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Codigo</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 12%;">Color</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 35%;">Nombre de la Tela Forro</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 20%;">Composicion</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($colores_forro as $c): ?>

                                                                                        <?php
                                                                                        $sufijo = $c['sufijo'];

                                                                                        $campoCodigo = 'codigo_telaforro' . $sufijo;
                                                                                        $campoColor  = 'color_telaforro' . $sufijo;
                                                                                        ?>

                                                                                        <tr>
                                                                                            <td><?= htmlspecialchars($fila[$campoCodigo]); ?></td>
                                                                                            <td><?= htmlspecialchars($fila[$campoColor]); ?></td>
                                                                                            <td><?= htmlspecialchars($fila['tela_forro']); ?></td>
                                                                                            <td><?= htmlspecialchars($fila['caracteristicas_forro']); ?></td>
                                                                                            <td><?= htmlspecialchars($fila['ancho_forro']); ?></td>
                                                                                        </tr>

                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                <?php endif; ?>

                                                                <!-- CODIGOS DE MOLDE -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center;">Codigos del Molde</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="4">
                                                                                        <input type="text" class="form-control form-control-sm text-center" name="codigo_molde" value="<?= htmlspecialchars($fila['codigo_molde'] ?? '') ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="500">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- DESCRIPCIONES -->
                                                                <div class="card shadow-sm mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0" style="table-layout:fixed;width:100%;">
                                                                            <tbody>
                                                                                <!-- TIPO OPCION -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        <?php echo htmlspecialchars($fila['tipo_opcion']); ?>
                                                                                    </td>
                                                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                                                        <span style="background:#ffff00; color:red;"><?php echo htmlspecialchars($fila['opcion_escrito']); ?></span>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- OJALES -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        Ojales
                                                                                    </td>
                                                                                    <td colspan="4">
                                                                                        <textarea class="form-control" name="ojales" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ojales']; ?></textarea>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- BOTONES -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        Botones
                                                                                    </td>
                                                                                    <td colspan="4">
                                                                                        <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- COSER -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        Coser
                                                                                    </td>
                                                                                    <td colspan="4">
                                                                                        <textarea class="form-control" name="coser" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['coser']; ?></textarea>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- REF SUGERIDA -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        Ref sugerida
                                                                                    </td>
                                                                                    <td colspan="4">
                                                                                        <?php echo htmlspecialchars($fila['ref_sugerida']); ?>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- OBSERVACIÓN DE TALLAS-->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        Observaciónes de las Tallas
                                                                                    </td>
                                                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                                                        <span style="background:#ffff00; color:red;"><?php echo htmlspecialchars($fila['observacion_tallas']); ?></span>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- OBSERVACIÓN DE DISEÑO-->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                        Observaciónes de Diseño
                                                                                    </td>
                                                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                                                        <textarea style="background:#ffff00; color:red;" class="form-control" name="" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- CURVA INICIAL -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <?php
                                                                    // Mismos arreglos de tallas que en el modal editable
                                                                    $tallas_hombre = ["XS", "S", "M", "L", "XL", "2XL", "3XL", "4XL", "5XL", "6XL", "Especial"];
                                                                    $tallas_dama   = ["4", "6", "8", "10", "12", "14", "16", "18", "20", "22", "Especial"];

                                                                    $genero_fila = trim($fila['genero'] ?? '');
                                                                    if ($genero_fila === 'Hombre') {
                                                                        $tallas = $tallas_hombre;
                                                                    } elseif ($genero_fila === 'Dama' || $genero_fila === 'Junior') {
                                                                        $tallas = $tallas_dama;
                                                                    } else {
                                                                        $tallas = [];
                                                                    }

                                                                    // Mismo criterio de colores que usas en la tarjeta de TELA
                                                                    $colores_curva = [];
                                                                    for ($i = 1; $i <= 6; $i++) {
                                                                        $clave = ($i == 1) ? 'color_tela' : 'color_tela' . $i;
                                                                        if (!empty($fila[$clave])) {
                                                                            $colores_curva[] = $fila[$clave];
                                                                        }
                                                                    }
                                                                    if (empty($colores_curva)) $colores_curva = [''];
                                                                    ?>

                                                                    <?php if (!empty($tallas)): ?>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td colspan="<?= count($tallas) + 3 ?>" class="fw-bold" style="background:#ffff00; color:red;">CURVA INICIAL</td>
                                                                                    </tr>
                                                                                    <tr class="table-primary">
                                                                                        <th style="width:5%;"></th>
                                                                                        <th style="width:23%;">Color / Talla</th>
                                                                                        <?php foreach ($tallas as $t): ?>
                                                                                            <th style="width:5%;"><?= htmlspecialchars($t) ?></th>
                                                                                        <?php endforeach; ?>
                                                                                        <th style="width:7%;">Total Und</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $totales_columna = array_fill_keys($tallas, 0);
                                                                                    $total_general = 0;

                                                                                    foreach ($colores_curva as $index => $color):
                                                                                        $g = $index + 1;
                                                                                        $prefijo = ($g === 1) ? 'talla_' : 'talla' . $g . '_';
                                                                                        $total_fila = 0;
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><b><?= $g ?></b></td>
                                                                                            <td><?= htmlspecialchars($color) ?></td>
                                                                                            <?php foreach ($tallas as $t):
                                                                                                $key = ($t === 'Especial') ? 'especial' : $t;
                                                                                                $val = $fila[$prefijo . $key] ?? '';
                                                                                                $val = ($val === null) ? '' : $val;
                                                                                                $total_fila += (int) $val;
                                                                                                $totales_columna[$t] += (int) $val;
                                                                                            ?>
                                                                                                <td><?= htmlspecialchars((string) $val) ?></td>
                                                                                            <?php endforeach; ?>
                                                                                            <td><b><?= $total_fila ?></b></td>
                                                                                        </tr>
                                                                                        <?php $total_general += $total_fila; ?>
                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr class="table-secondary fw-bold">
                                                                                        <td colspan="2">Total por Talla</td>
                                                                                        <?php foreach ($tallas as $t): ?>
                                                                                            <td><?= $totales_columna[$t] ?></td>
                                                                                        <?php endforeach; ?>
                                                                                        <td><?= $total_general ?></td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="text-center text-muted py-2">No se ha definido género para mostrar la curva de tallas.</div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <!-- CURVA PARCIAL -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <?php
                                                                    // Mismos arreglos de tallas que en el modal editable
                                                                    $tallas_hombre = ["XS", "S", "M", "L", "XL", "2XL", "3XL", "4XL", "5XL", "6XL", "Especial"];
                                                                    $tallas_dama   = ["4", "6", "8", "10", "12", "14", "16", "18", "20", "22", "Especial"];

                                                                    $genero_fila = trim($fila['genero'] ?? '');
                                                                    if ($genero_fila === 'Hombre') {
                                                                        $tallas = $tallas_hombre;
                                                                    } elseif ($genero_fila === 'Dama' || $genero_fila === 'Junior') {
                                                                        $tallas = $tallas_dama;
                                                                    } else {
                                                                        $tallas = [];
                                                                    }

                                                                    // Mismo criterio de colores que usas en la tarjeta de TELA
                                                                    $colores_curva = [];
                                                                    for ($i = 1; $i <= 6; $i++) {
                                                                        $clave = ($i == 1) ? 'color_tela' : 'color_tela' . $i;
                                                                        if (!empty($fila[$clave])) {
                                                                            $colores_curva[] = $fila[$clave];
                                                                        }
                                                                    }
                                                                    if (empty($colores_curva)) $colores_curva = [''];
                                                                    ?>

                                                                    <?php if (!empty($tallas)): ?>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td colspan="<?= count($tallas) + 3 ?>" class="fw-bold" style="background:#ffff00; color:red;">CURVA PARCIAL</td>
                                                                                    </tr>
                                                                                    <tr class="table-primary">
                                                                                        <th style="width:5%;"></th>
                                                                                        <th style="width:23%;">Color / Talla</th>
                                                                                        <?php foreach ($tallas as $t): ?>
                                                                                            <th style="width:5%;"><?= htmlspecialchars($t) ?></th>
                                                                                        <?php endforeach; ?>
                                                                                        <th style="width:7%;">Total Und</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $totales_columna = array_fill_keys($tallas, 0);
                                                                                    $total_general = 0;

                                                                                    foreach ($colores_curva as $index => $color):
                                                                                        $g = $index + 1;
                                                                                        $prefijo = ($g === 1) ? 'talla_' : 'talla' . $g . '_';
                                                                                        $total_fila = 0;
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><b><?= $g ?></b></td>
                                                                                            <td><?= htmlspecialchars($color) ?></td>
                                                                                            <?php foreach ($tallas as $t):
                                                                                                $key = ($t === 'Especial') ? 'especial' : $t;
                                                                                                $val = $fila[$prefijo . $key] ?? '';
                                                                                                $val = ($val === null) ? '' : $val;
                                                                                                $total_fila += (int) $val;
                                                                                                $totales_columna[$t] += (int) $val;
                                                                                            ?>
                                                                                                <td><?= htmlspecialchars((string) $val) ?></td>
                                                                                            <?php endforeach; ?>
                                                                                            <td><b><?= $total_fila ?></b></td>
                                                                                        </tr>
                                                                                        <?php $total_general += $total_fila; ?>
                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr class="table-secondary fw-bold">
                                                                                        <td colspan="2">Total por Talla</td>
                                                                                        <?php foreach ($tallas as $t): ?>
                                                                                            <td><?= $totales_columna[$t] ?></td>
                                                                                        <?php endforeach; ?>
                                                                                        <td><?= $total_general ?></td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="text-center text-muted py-2">No se ha definido género para mostrar la curva de tallas.</div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <!--  FIRMAS y CORTE -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th colspan="5" class="text-center" style="background:#d9e3f0;">OBSERVACION CORTE</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="5" style="height: 100px; vertical-align: top;">
                                                                                        
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                            <colgroup>
                                                                                <col style="width: 30%;">
                                                                            </colgroup>
                                                                            <tbody>
                                                                                <tr style="height:15px;">
                                                                                    <td class="fw-bold text-center align-middle py-2" style="background:#ffff00; color:red;">TELA REPOSADA</td>
                                                                                    <td class="text-center align-middle py-2">
                                                                                        SI <input type="radio" name="tela_reposada" value="SI">
                                                                                    </td>
                                                                                    <td class="text-center align-middle py-2">
                                                                                        NO <input type="radio" name="tela_reposada" value="NO">
                                                                                    </td>
                                                                                    <td class="fw-bold text-center align-middle py-2" style="background:#ffff00; color:red;">HORAS DE REPOSO</td>
                                                                                    <td colspan="2" class="align-middle py-2">
                                                                                        <input type="text" class="form-control form-control-sm text-center" name="horas_reposo">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height:15px;">
                                                                                    <td class="fw-bold text-center align-middle py-2" style="background:#ffff00;">FIRMA RESPONSABLE</td>
                                                                                    <td colspan="5" class="align-middle py-2">

                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height:15px;">
                                                                                    <td class="fw-bold text-center align-middle py-2" style="background:#ffff00;">CORTE COMPLETO</td>
                                                                                    <td colspan="5" class="align-middle py-2">

                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height:15px;">
                                                                                    <td class="fw-bold text-center align-middle py-2" style="background:#ffff00;">CORTE INCOMPLETO</td>
                                                                                    <td colspan="5" class="align-middle py-2">

                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height:15px;">
                                                                                    <td class="fw-bold text-center align-middle py-2" style="background:#d9e3f0;">FIRMA DE RECIBIDO DE CORTE A PRODUCCION</td>
                                                                                    <td colspan="5" class="align-middle py-2">

                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- BUTTON -->
                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="submit" name="crear_ficha_tecnica" class="btn btn-success">
                                                                        <i class="bi bi-save"></i> Guardar Ficha Técnica
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary" onclick="imprimirSeccion('dotaciones<?php echo $id_producto; ?>')">
                                                                        <i class="bi bi-printer"></i>Imprimir
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- ILUSTRACION -->
                                                        <div class="tab-pane fade" id="ilustracion<?php echo $id_producto; ?>" role="tabpanel">
                                                            <form method="post" id="formularioIlustracion<?php echo $id_producto; ?>">

                                                                <!-- ENTRETELAS -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th colspan="5" class="fw-bold">ENTRETELAS</th>
                                                                                </tr>
                                                                                <tr class="table-primary">
                                                                                    <th>Pieza</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Entretela</th>
                                                                                    <th>Ancho</th>
                                                                                    <th>Acción</th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody id="tablaEntretelas<?php echo $id_producto; ?>">
                                                                                <tr>
                                                                                    <td><input type="text" name="pieza[]" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" name="modelo[]" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" name="entretela[]" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" name="ancho[]" class="form-control form-control-sm"></td>
                                                                                    <td>
                                                                                        <button type="button" class="btn btn-success btn-sm">
                                                                                            <i class="bi bi-check-lg"></i>
                                                                                        </button>

                                                                                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                                                                                            <i class="bi bi-trash"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="text-center mt-2">
                                                                        <button type="button"
                                                                            class="btn btn-success"
                                                                            onclick="agregarFilaEntretela('<?php echo $id_producto; ?>')">
                                                                            Agregar fila
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <!-- DIBUJO CARGAR -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="card-header fw-bold text-center">Dibujo Técnico</div>
                                                                    <div class="card-body text-center">

                                                                        <input type="file"
                                                                            id="imagenCargar<?php echo $id_producto; ?>"
                                                                            accept="image/*"
                                                                            class="form-control mb-3">

                                                                        <div id="contenedorImagen<?php echo $id_producto; ?>"></div>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- DESCRIPCION -->
                                                        <div class="tab-pane fade" id="descripcion<?php echo $id_producto; ?>" role="tabpanel">
                                                                <div class="card shadow-sm mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0" style="table-layout:fixed;width:100%;">
                                                                            <?php
                                                                            // Todos los labels
                                                                            $labels = [
                                                                                'mangas'          => 'Descripción de las Mangas',
                                                                                'cuello'          => 'Descripción del Cuello',
                                                                                'puño'            => 'Descripción de los Puños',
                                                                                'pretina'         => 'Descripción de la Pretina',
                                                                                'fajon'           => 'Descripción del Fajón',
                                                                                'boton'           => 'Descripción de los Botones',
                                                                                'cremallera'      => 'Descripción de las Cremalleras',
                                                                            ];

                                                                            // Campos por tipo de producto
                                                                            $tiposProducto = [
                                                                                1 => ['mangas', 'cuello', 'puño', 'boton', 'cremallera'],
                                                                                2 => ['mangas', 'cuello', 'puño', 'boton', 'cremallera'],
                                                                                3 => ['pretina', 'boton', 'cremallera'],
                                                                                4 => ['pretina', 'boton', 'cremallera'],
                                                                                5 => ['mangas', 'cuello', 'puño', 'fajon', 'boton', 'cremallera'],
                                                                                6 => ['mangas', 'cuello', 'puño', 'pretina', 'boton', 'cremallera'],
                                                                                7 => ['mangas', 'cuello', 'puño', 'pretina', 'fajon', 'boton', 'cremallera'],
                                                                            ];

                                                                            $idTipo = $fila['id_tipo_producto'];

                                                                            if (isset($tiposProducto[$idTipo])) :
                                                                            ?>
                                                                                <tbody>
                                                                                    <?php foreach ($tiposProducto[$idTipo] as $campo): ?>
                                                                                        <tr>
                                                                                            <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                                                                <?= $labels[$campo] ?>
                                                                                            </td>
                                                                                            <td colspan="4">
                                                                                                <?php echo htmlspecialchars($fila[$campo]); ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                            <?php endif; ?>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                        <!-- INSUMOS -->
                                                        <div class="tab-pane fade"
                                                            id="insumos<?php echo $id_producto; ?>"
                                                            role="tabpanel">

                                                            Contenido Insumos

                                                        </div>

                                                        <!-- BORDADO -->
                                                        <div class="tab-pane fade"
                                                            id="bordado<?php echo $id_producto; ?>"
                                                            role="tabpanel">

                                                            Contenido Bordado - Estampado

                                                        </div>

                                                        <!-- NOVEDAD -->
                                                        <div class="tab-pane fade"
                                                            id="novedad<?php echo $id_producto; ?>"
                                                            role="tabpanel">

                                                            Contenido Novedad

                                                        </div>
                                                    </div>
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
        </div>


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        <!-- Datatables -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/moment-2.29.4/jszip-3.10.1/dt-2.3.8/af-2.7.1/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cr-2.1.2/cc-1.2.1/date-1.6.3/fc-5.0.5/fh-4.0.6/kt-2.12.2/r-3.0.8/rg-1.6.0/rr-1.5.1/sc-2.4.3/sb-1.8.4/sp-2.3.5/sl-3.1.3/sr-1.4.3/datatables.min.js" integrity="sha384-XCTQyNrbAXZ28p4As7vVXvKGdi4hZcqfqw3LOoZdYriqxbs4EHeHmxLwlsz9DW4l" crossorigin="anonymous"></script>

        <!-- Configuración de DataTable -->
        <script>
            $(document).ready(function() {
                var table = new DataTable('#mytabla', {
                    "order": [
                        [4, "desc"]
                    ],
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

        <!-- Scripts Dotaciones -->
        <script>
            // Estilos de impresión: se inyectan UNA sola vez en el <head> de la propia página.
            // Imprimir en la misma página (en vez de una ventana emergente) evita que se rompan
            // rutas relativas de CSS/imágenes y garantiza que los colores sean idénticos a los de pantalla.
            (function inicializarEstilosImpresion() {
                if (document.getElementById('estilosImpresionFicha')) return;

                const estilo = document.createElement('style');
                estilo.id = 'estilosImpresionFicha';
                estilo.innerHTML = `
                    @media print {

                        /* Forzar impresión de colores de fondo (tablas amarillas, azules, verdes, etc.) */
                        *{
                            -webkit-print-color-adjust: exact !important;
                            print-color-adjust: exact !important;
                            color-adjust: exact !important;
                        }

                        @page{
                            size: letter portrait;
                            margin: 8mm;
                        }

                        /* Oculta TODA la página excepto el área de impresión */
                        body.modo-impresion-activo > *{
                            display:none !important;
                        }

                        body.modo-impresion-activo #areaImpresionFicha{
                            display:block !important;
                            position:absolute;
                            top:0; left:0;
                            width:100%;
                            margin:0;
                        }

                        /* Diseño compacto para que la ficha quepa en una sola hoja */
                        #areaImpresionFicha .btn,
                        #areaImpresionFicha .modal-footer{
                            display:none !important;
                        }

                        #areaImpresionFicha .card{
                            box-shadow:none !important;
                            border:none !important;
                            margin-bottom:3px !important;
                        }

                        #areaImpresionFicha .table-responsive{
                            overflow:visible !important;
                        }

                        #areaImpresionFicha table{
                            font-size:8.5px !important;
                            margin-bottom:0 !important;
                        }

                        #areaImpresionFicha th,
                        #areaImpresionFicha td{
                            padding:2px 3px !important;
                            line-height:1.15 !important;
                        }

                        #areaImpresionFicha .modal-header{
                            padding:4px !important;
                        }

                        #areaImpresionFicha .modal-header img{
                            max-width:90px !important;
                            width:90px !important;
                        }

                        #areaImpresionFicha textarea{
                            min-height:0 !important;
                            height:24px !important;
                            font-size:8.5px !important;
                        }

                        #areaImpresionFicha input.form-control{
                            font-size:8.5px !important;
                            padding:0 2px !important;
                        }
                    }

                    /* En pantalla, el área de impresión permanece oculta */
                    #areaImpresionFicha{
                        display:none;
                    }
                `;
                document.head.appendChild(estilo);
            })();

            function imprimirSeccion(id) {

                const contenido = document.getElementById(id);

                let area = document.getElementById('areaImpresionFicha');
                if (!area) {
                    area = document.createElement('div');
                    area.id = 'areaImpresionFicha';
                    document.body.appendChild(area);
                }
                area.innerHTML = contenido.outerHTML;

                document.body.classList.add('modo-impresion-activo');
                window.print();
            }

            window.addEventListener('afterprint', () => {
                document.body.classList.remove('modo-impresion-activo');
            });
        </script>

        <!-- Scripts Ilustraciones -->
        <script>
            function agregarFilaEntretela(idProducto) {

                let tabla = document.getElementById('tablaEntretelas' + idProducto);

                let nuevaFila = document.createElement('tr');

                nuevaFila.innerHTML = `
                    <td><input type="text" name="pieza[]" class="form-control form-control-sm"></td>
                    <td><input type="text" name="modelo[]" class="form-control form-control-sm"></td>
                    <td><input type="text" name="entretela[]" class="form-control form-control-sm"></td>
                    <td><input type="text" name="ancho[]" class="form-control form-control-sm"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="bi bi-check-lg"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;

                tabla.appendChild(nuevaFila);
            }

            function eliminarFila(boton) {
                let fila = boton.closest('tr');
                let tbody = fila.closest('tbody');

                if (tbody.rows.length <= 1) {
                    alert('Debe existir al menos una fila.');
                    return;
                }

                fila.remove();
            }
        </script>
        <script>
            document.addEventListener('change', function(e) {

                if (e.target.type !== 'file') {
                    return;
                }

                if (!e.target.id.startsWith('imagenCargar')) {
                    return;
                }

                let idProducto = e.target.id.replace('imagenCargar', '');

                let archivo = e.target.files[0];

                if (!archivo) {
                    return;
                }

                let url = URL.createObjectURL(archivo);

                let contenedor = document.getElementById('contenedorImagen' + idProducto);

                contenedor.innerHTML = `
                    <img src="${url}"
                        class="img-fluid border rounded mt-3"
                        style="max-height:1000px;">
                `;

            });
        </script>

        <!-- Scripts Descripcion -->

    </body>
</html>