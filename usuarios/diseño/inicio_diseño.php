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
                                ensamble = '$ensamble', fajon = '$fajon', forro = '$forro', otros = '$otros', fecha_produccion = '$fecha_produccion', estado = 'Compras' WHERE id_producto = '$id_producto'";

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
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%); min-height: 100vh;">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="navbar-brand" href="inicio_produccion.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 80px;">
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
                                            $consulta = "SELECT pedido.id_pedido, producto.id_producto, producto.num_ficha, producto.nombre_producto, prenda.id_prenda, prenda.nombre_prenda, cliente.nit, cliente.cliente, producto.estado, producto.fecha_fichatecnica, producto.id_tipo_producto, producto.fecha_entrega
                                                                    FROM pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda WHERE producto.estado = 'Diseño' ORDER BY producto.fecha_fichatecnica ASC";

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

                                                    $fecha1 = new DateTime($fila['fecha_fichatecnica']);
                                                    $fecha2 = new DateTime($fila['fecha_entrega']);
                                                    ?>

                                                    <td class="text-center align-middle">
                                                        <?= $fecha1->format('d') . ' de ' . $meses[$fecha1->format('n')] . ' del ' . $fecha1->format('Y') . ', a las ' . $fecha1->format('H:i:s'); ?>
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        <?= $fecha2->format('d') . ' de ' . $meses[$fecha2->format('n')] . ' del ' . $fecha2->format('Y'); ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalFichaTecnica<?php echo $fila['id_producto']; ?>">
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
                                    <!-- Modal Activar -->
                                    <div class="modal fade" id="modalFichaTecnica<?php echo $id_producto; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content shadow-lg border-0 rounded-4">

                                                <div class="modal-header text-white justify-content-center position-relative" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <div class="d-flex align-items-center text-center">
                                                        <img src="../../img/Logo.png" alt="Logo" width="70" class="me-3 rounded">
                                                        <div class="text-start">
                                                            <h5 class="mb-0 fw-bold">UNIDOTACIONES DEL EJE</h5>
                                                            <small> -------------- | 3469021 - 3115516823</small>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="text-white text-center py-2 fw-bold" style="background-color:#18a000;">
                                                    FICHA TÉCNICA DE PRODUCCIÓN
                                                </div>

                                                <?php
                                                $consultaFicha = "SELECT pedido.id_pedido, producto.id_producto, producto.num_ficha, prenda.id_prenda, prenda.nombre_prenda, cliente.nit, cliente.cliente, producto.suma_prendas, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4,
                                                                producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.estado, orden_compra.id_ordencompra, orden_compra.prendas_comprar, orden_compra.precio_prendacompra,
                                                                producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14,
                                                                producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.talla_26, producto.talla_28, producto.talla_30, producto.talla_32, producto.talla_34, producto.talla_36, producto.talla_38, producto.talla_40, producto.talla_42, producto.talla_44, producto.talla_46, producto.talla_48, producto.talla_especial, 
                                                                tela.id_tela, producto.id_tela, tela.tela, producto.promedio_consumo, producto.color_tela, orden_compra.consumo_tela, orden_compra.precio_telacompra,
                                                                tela_combinada.id_telacombi, producto.id_telacombi, tela_combinada.tela_combi, producto.promedio_telacombi, producto.color_telacombi, orden_compra.consumo_telacombi, orden_compra.precio_telacombicompra,
                                                                tela_forro.id_telaforro, producto.id_telaforro, tela_forro.tela_forro, producto.promedio_forro, producto.color_telaforro, orden_compra.consumo_telaforro, orden_compra.precio_telaforrocompra,
                                                                entretela.id_entretela, producto.id_entretela, entretela.insumo AS insumo_entretela, entretela.medida AS medida_entretela, producto.cant_entretela, orden_compra.consumo_totalentretela, orden_compra.precio_entretelacompra,
                                                                entretela2.id_entretela2, producto.id_entretela2, entretela2.insumo AS insumo_entretela2, entretela2.medida AS medida_entretela2, producto.cant_entretela2, orden_compra.consumo_totalentretela2, orden_compra.precio_entretela2compra,
                                                                bolsa.id_bolsa, producto.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.medida AS medida_bolsa,
                                                                boton.id_boton, producto.id_boton, boton.insumo AS insumo_boton, boton.medida AS medida_boton, producto.cant_boton, orden_compra.consumo_totalboton, orden_compra.precio_botoncompra,
                                                                boton2.id_boton2, producto.id_boton2, boton2.insumo AS insumo_boton2, boton2.medida AS medida_boton2, producto.cant_boton2, orden_compra.consumo_totalboton2, orden_compra.precio_boton2compra,
                                                                broche.id_broche, producto.id_broche, broche.insumo AS insumo_broche, broche.medida AS medida_broche, producto.cant_broche, orden_compra.consumo_totalbroche, orden_compra.precio_brochecompra,
                                                                cinta_faya.id_faya, producto.id_faya, cinta_faya.insumo AS insumo_faya, cinta_faya.medida AS medida_faya, producto.cant_faya, orden_compra.consumo_totalfaya, orden_compra.precio_fayacompra,
                                                                cinta_reflectiva.id_cinta, producto.id_cinta, cinta_reflectiva.insumo AS insumo_cinta, cinta_reflectiva.medida AS medida_cinta, producto.cant_cinta, orden_compra.consumo_totalcinta, orden_compra.precio_cintacompra,
                                                                cordon.id_cordon, producto.id_cordon, cordon.insumo AS insumo_cordon, cordon.medida AS medida_cordon, producto.cant_cordon, orden_compra.consumo_totalcordon, orden_compra.precio_cordoncompra,
                                                                cremallera.id_cremallera, producto.id_cremallera, cremallera.insumo AS insumo_cremallera, cremallera.medida AS medida_cremallera, producto.cant_cremallera, orden_compra.consumo_totalcremallera, orden_compra.precio_cremalleracompra,
                                                                cremallera2.id_cremallera2, producto.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, cremallera2.medida AS medida_cremallera2, producto.cant_cremallera2, orden_compra.consumo_totalcremallera2, orden_compra.precio_cremallera2compra,
                                                                cuello.id_cuello, producto.id_cuello, cuello.insumo AS insumo_cuello, cuello.medida AS medida_cuello, producto.consumo_cuello, orden_compra.consumo_totalcuello, orden_compra.precio_cuellocompra,
                                                                deslizador.id_deslizador, producto.id_deslizador, deslizador.insumo AS insumo_deslizador, deslizador.medida AS medida_deslizador, producto.cant_deslizador, orden_compra.consumo_totaldeslizador, orden_compra.precio_deslizadorcompra,
                                                                fajon_cintura.id_fajon_cintura, producto.id_fajon_cintura, fajon_cintura.insumo AS insumo_fajon_cintura, fajon_cintura.medida AS medida_fajon_cintura, producto.cant_fajon_cintura, orden_compra.consumo_totalfajon_cintura, orden_compra.precio_fajon_cinturacompra,
                                                                fusionado.id_fusionado, producto.id_fusionado, fusionado.insumo AS insumo_fusionado, fusionado.medida AS medida_fusionado, producto.consumo_fusionado,
                                                                guata.id_guata, producto.id_guata, guata.insumo AS insumo_guata, guata.medida AS medida_guata, producto.cant_guata, orden_compra.consumo_totalguata, orden_compra.precio_guatacompra,
                                                                hiladilla.id_hiladilla, producto.id_hiladilla, hiladilla.insumo AS insumo_hiladilla, hiladilla.medida AS medida_hiladilla, producto.cant_hiladilla, orden_compra.consumo_totalhiladilla, orden_compra.precio_hiladillacompra,
                                                                hombrera.id_hombrera, producto.id_hombrera, hombrera.insumo AS insumo_hombrera, hombrera.medida AS medida_hombrera, producto.cant_hombrera, orden_compra.consumo_totalhombrera, orden_compra.precio_hombreracompra,
                                                                marquilla.id_marquilla, producto.id_marquilla, marquilla.insumo AS insumo_marquilla, marquilla.medida AS medida_marquilla,
                                                                plumilla.id_plumilla, producto.id_plumilla, plumilla.insumo AS insumo_plumilla, plumilla.medida AS medida_plumilla, producto.cant_plumilla, orden_compra.consumo_totalplumilla, orden_compra.precio_plumillacompra,
                                                                pretina.id_pretina, producto.id_pretina, pretina.insumo AS insumo_pretina, pretina.medida AS medida_pretina, producto.cant_pretina, orden_compra.consumo_totalpretina, orden_compra.precio_pretinacompra,
                                                                puntera.id_puntera, producto.id_puntera, puntera.insumo AS insumo_puntera, puntera.medida AS medida_puntera, producto.cant_puntera, orden_compra.consumo_totalpuntera, orden_compra.precio_punteracompra,
                                                                puño.id_puño, producto.id_puño, puño.insumo AS insumo_puño, puño.medida AS medida_puño, producto.consumo_puño, orden_compra.consumo_totalpuño, orden_compra.precio_puñocompra,
                                                                resorte.id_resorte, producto.id_resorte, resorte.insumo AS insumo_resorte, resorte.medida AS medida_resorte, producto.cant_resorte, orden_compra.consumo_totalresorte, orden_compra.precio_resortecompra,
                                                                resorte2.id_resorte2, producto.id_resorte2, resorte2.insumo AS insumo_resorte2, resorte2.medida AS medida_resorte2, producto.cant_resorte2, orden_compra.consumo_totalresorte2, orden_compra.precio_resorte2compra,
                                                                sesgo.id_sesgo, producto.id_sesgo, sesgo.insumo AS insumo_sesgo, sesgo.medida AS medida_sesgo, producto.cant_sesgo, orden_compra.consumo_totalsesgo, orden_compra.precio_sesgocompra,
                                                                trabilla.id_trabilla, producto.id_trabilla, trabilla.insumo AS insumo_trabilla, trabilla.medida AS medida_trabilla, producto.cant_trabilla, orden_compra.consumo_totaltrabilla, orden_compra.precio_trabillacompra,
                                                                velcro.id_velcro, producto.id_velcro, velcro.insumo AS insumo_velcro, velcro.medida AS medida_velcro, producto.cant_velcro, orden_compra.consumo_totalvelcro, orden_compra.precio_velcrocompra,
                                                                vinilo.id_vinilo, producto.id_vinilo, vinilo.insumo AS insumo_vinilo, vinilo.medida AS medida_vinilo, producto.cant_vinilo, orden_compra.consumo_totalvinilo, orden_compra.precio_vinilocompra,
                                                                vivo.id_vivo, producto.id_vivo, vivo.insumo AS insumo_vivo, vivo.medida AS medida_vivo, producto.cant_vivo, orden_compra.consumo_totalvivo, orden_compra.precio_vivocompra
                                                                FROM pedido 
                                                                LEFT JOIN cliente ON pedido.nit = cliente.nit 
                                                                LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido 
                                                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                                LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
                                                                LEFT JOIN tela ON producto.id_tela = tela.id_tela 
                                                                LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi 
                                                                LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro
                                                                LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa
                                                                LEFT JOIN boton ON producto.id_boton = boton.id_boton
                                                                LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2
                                                                LEFT JOIN broche ON producto.id_broche = broche.id_broche
                                                                LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya
                                                                LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta
                                                                LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon
                                                                LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera
                                                                LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2
                                                                LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello
                                                                LEFT JOIN deslizador ON producto.id_deslizador = deslizador.id_deslizador
                                                                LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela
                                                                LEFT JOIN entretela2 ON producto.id_entretela2 = entretela2.id_entretela2
                                                                LEFT JOIN fajon_cintura ON producto.id_fajon_cintura = fajon_cintura.id_fajon_cintura
                                                                LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado
                                                                LEFT JOIN guata ON producto.id_guata = guata.id_guata
                                                                LEFT JOIN hiladilla ON producto.id_hiladilla = hiladilla.id_hiladilla
                                                                LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera
                                                                LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla
                                                                LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla
                                                                LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina
                                                                LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera
                                                                LEFT JOIN puño ON producto.id_puño = puño.id_puño
                                                                LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte
                                                                LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
                                                                LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo
                                                                LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla
                                                                LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro
                                                                LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                                                                LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo
                                                                WHERE producto.estado = 'Diseño' AND producto.id_producto = '$id_producto'";

                                                $resultadoFicha = mysqli_query($enlace, $consultaFicha);

                                                $filaFicha = mysqli_fetch_array($resultadoFicha);
                                                ?>

                                                <!-- BODY -->
                                                <div class="modal-body p-4 bg-light">
                                                    <form method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_producto" value="<?php echo $filaFicha['id_producto']; ?>">

                                                        <!-- INFORMACIÓN GENERAL -->
                                                        <div class="card shadow-sm border-0 mb-4">
                                                            <div class="card-header text-white text-center fw-bold" style="background-color:#000DD3;"> INFORMACIÓN DEL PRODUCTO </div>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered align-middle text-center mb-0">
                                                                    <thead style="background-color:#18a000; color:white;">
                                                                        <tr class="table-primary">
                                                                            <th style="text-align: center; vertical-align: middle; width: 40%;">Tipo de Producto</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Cant. Prendas</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">No. Ficha</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 30%;">Cliente</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><?php echo htmlspecialchars($filaFicha['nombre_prenda']); ?></td>
                                                                            <td><?php echo htmlspecialchars($filaFicha['suma_prendas']); ?></td>
                                                                            <td><?php echo htmlspecialchars($filaFicha['num_ficha']); ?></td>
                                                                            <td><?php echo htmlspecialchars($filaFicha['cliente']); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="5" class="text-center fw-bold table-primary"> REPRESENTACIÓN GRÁFICA</th>
                                                                        </tr>
                                                                        <?php
                                                                        $imagenProducto1 = $filaFicha['imagen'];
                                                                        $imagenProducto2 = $filaFicha['imagen2'];
                                                                        $imagenProducto3 = $filaFicha['imagen3'];
                                                                        $imagenProducto4 = $filaFicha['imagen4'];
                                                                        ?>
                                                                        <?php if (!empty($imagenProducto1) || !empty($imagenProducto2) || !empty($imagenProducto3) || !empty($imagenProducto4)): ?>
                                                                            <tr>
                                                                                <td colspan="5">
                                                                                    <div>
                                                                                        <div class="d-flex justify-content-center flex-wrap gap-2">
                                                                                            <?php if (!empty($imagenProducto1)): ?>
                                                                                                <div class="text-center">
                                                                                                    <a href="img/pedidos/<?= $imagenProducto1 ?>" download>
                                                                                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            <?php if (!empty($imagenProducto2)): ?>
                                                                                                <div class="text-center">
                                                                                                    <a href="img/pedidos/<?= $imagenProducto2 ?>" download>
                                                                                                        <img src="img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            <?php if (!empty($imagenProducto3)): ?>
                                                                                                <div class="text-center">
                                                                                                    <a href="img/pedidos/<?= $imagenProducto3 ?>" download>
                                                                                                        <img src="img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            <?php if (!empty($imagenProducto4)): ?>
                                                                                                <div class="text-center">
                                                                                                    <a href="img/pedidos/<?= $imagenProducto4 ?>" download>
                                                                                                        <img src="img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>

                                                                        <!-- Mostrar Logos -->
                                                                        <?php
                                                                        $logoProducto1 = $filaFicha['logo1'];
                                                                        $logoProducto2 = $filaFicha['logo2'];
                                                                        $logoProducto3 = $filaFicha['logo3'];
                                                                        $logoProducto4 = $filaFicha['logo4'];

                                                                        if (!function_exists('displayFile')) {
                                                                            function displayFile($file)
                                                                            {
                                                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                                                $fileName = basename($file);
                                                                                if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                                                    echo '<a href="logos_empresas/' . $file . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                                                                } else {
                                                                                    echo '<a href="logos_empresas/' . $file . '" target="_blank" download class="d-block mx-1 mb-2"><img src="logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;"></a>';
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <?php if (!empty($logoProducto1) || !empty($logoProducto2) || !empty($logoProducto3) || !empty($logoProducto4)): ?>
                                                                            <tr>
                                                                                <th colspan="5" class="text-center fw-bold table-primary"> LOGOS</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="5">
                                                                                    <div>
                                                                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                                                                            <?php if (!empty($logoProducto1)): ?>
                                                                                                <div class="text-center p-1">
                                                                                                    <?php displayFile($logoProducto1); ?>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            <?php if (!empty($logoProducto2)): ?>
                                                                                                <div class="text-center p-1">
                                                                                                    <?php displayFile($logoProducto2); ?>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            <?php if (!empty($logoProducto3)): ?>
                                                                                                <div class="text-center p-1">
                                                                                                    <?php displayFile($logoProducto3); ?>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            <?php if (!empty($logoProducto4)): ?>
                                                                                                <div class="text-center p-1">
                                                                                                    <?php displayFile($logoProducto4); ?>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <!-- INFORMACIÓN DE TRAZO -->
                                                        <div class="card shadow-sm border-0 mb-4">
                                                            <div class="card-header text-white text-center fw-bold" style="background-color:#18a000;">INFORMACIÓN DE TRAZO Y CORTE</div>
                                                            <?php
                                                                $id_tela = $filaFicha['id_tela'];
                                                                $color_tela = $filaFicha['color_tela'];

                                                                $consulta_1 = "SELECT producto.id_tela, tela.id_tela, tela.caracteristicas AS caracteristicas_tela, tela.ancho AS ancho_tela, tela.rendimiento AS rendimiento_tela, tela.id_proveedor, proveedor_tela.nombre AS nombre_tela                                                            
                                                                    FROM producto
                                                                    LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.id_tela = '$id_tela'";

                                                                $resultado_1 = mysqli_query($enlace, $consulta_1);

                                                                $fila1 = mysqli_fetch_array($resultado_1)
                                                            ?>

                                                            <div class="card-body">
                                                                <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                    <h6 class="modal-title w-100" style="color: white;">Información de Tela Principal</h6>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table id="mytabla" class="table table-bordered text-center">
                                                                        <thead style="background-color:#18a000; color:white;">
                                                                            <tr class="table-primary">
                                                                                <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion Tela</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <?php
                                                                                    $texto = $filaFicha['tela'];
                                                                                    if (!empty($fila1['ancho_tela'])) {
                                                                                        $texto .= " ancho " . $fila1['ancho_tela'];
                                                                                    }
                                                                                    if (!empty($fila1['rendimiento_tela'])) {
                                                                                        $texto .= " rendimiento " . $fila1['rendimiento_tela'];
                                                                                    }
                                                                                    echo htmlspecialchars($texto);
                                                                                    ?>
                                                                                </td>

                                                                                <td><?php echo htmlspecialchars($fila1['caracteristicas_tela']); ?></td>
                                                                                <td><?php echo htmlspecialchars($filaFicha['promedio_consumo']); ?> Mts</td>
                                                                                <td><?php echo htmlspecialchars($filaFicha['consumo_tela']); ?> Mts</td>
                                                                                <td><?php echo htmlspecialchars($filaFicha['color_tela']); ?></td>
                                                                                <td><?php echo htmlspecialchars($fila1['nombre_tela']); ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <?php if (!empty($filaFicha['id_telacombi'])): ?>
                                                                    <?php
                                                                        $id_telacombi = $filaFicha['id_telacombi'];
                                                                        $color_telacombi = $filaFicha['color_telacombi'];

                                                                        $consulta_2 = "SELECT producto.id_telacombi, tela_combinada.id_telacombi, tela_combinada.caracteristicas AS caracteristicas_combinado, tela_combinada.ancho AS ancho_combinado, tela_combinada.rendimiento AS rendimiento_combinado, tela_combinada.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                                                                                                FROM producto
                                                                                                                LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.id_telacombi = '$id_telacombi'";

                                                                        $resultado_2 = mysqli_query($enlace, $consulta_2);

                                                                        $fila2 = mysqli_fetch_array($resultado_2)
                                                                    ?>

                                                                    <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                        <h6 class="modal-title w-100" style="color: white;">Información de la Tela Combinada</h6>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table id="mytabla" class="table table-bordered text-center">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="text-center align-middle">
                                                                                        <?php $texto = $filaFicha['tela_combi'];
                                                                                        if (!empty($fila2['ancho_combinado'])) {
                                                                                            $texto .= " ancho " . $fila2['ancho_combinado'];
                                                                                        }
                                                                                        if (!empty($fila2['rendimiento_combinado'])) {
                                                                                            $texto .= " rendimiento " . $fila2['rendimiento_combinado'];
                                                                                        }
                                                                                        echo htmlspecialchars($texto);
                                                                                        ?>
                                                                                    </td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['caracteristicas_combinado']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['promedio_telacombi']); ?> Mts</td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_telacombi']); ?> Mts</td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['color_telacombi']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['nombre_combinado']); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if (!empty($filaFicha['id_telaforro'])): ?>

                                                                    <?php
                                                                    $id_telaforro = $filaFicha['id_telaforro'];
                                                                    $color_telaforro = $filaFicha['color_telaforro'];

                                                                    $consulta_3 = "SELECT producto.id_telaforro, tela_forro.id_telaforro, tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.ancho as ancho_forro, tela_forro.rendimiento as rendimiento_forro, tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                                                                                            FROM producto 
                                                                                                            LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.id_telaforro = '$id_telaforro'";

                                                                    $resultado_3 = mysqli_query($enlace, $consulta_3);

                                                                    $fila3 = mysqli_fetch_array($resultado_3)
                                                                    ?>

                                                                    <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                        <h6 class="modal-title w-100" style="color: white;">Información de la Tela Forro</h6>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table id="mytabla" class="table table-bordered text-center">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="text-center align-middle">
                                                                                        <?php $texto = $filaFicha['tela_forro'];
                                                                                        if (!empty($fila3['ancho_forro'])) {
                                                                                            $texto .= " ancho " . $fila3['ancho_forro'];
                                                                                        }
                                                                                        if (!empty($fila3['rendimiento_forro'])) {
                                                                                            $texto .= " rendimiento " . $fila3['rendimiento_forro'];
                                                                                        }
                                                                                        echo htmlspecialchars($texto);
                                                                                        ?>
                                                                                    </td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['caracteristicas_forro']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['promedio_forro']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_telaforro']); ?> Mts</td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['color_telaforro']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['nombre_forro']); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if (!empty($filaFicha['id_entretela'])): ?>

                                                                    <?php
                                                                    $id_entretela = $filaFicha['id_entretela'];

                                                                    $consulta_4 = "SELECT producto.id_entretela, entretela.id_entretela, entretela.insumo AS insumo_entretela, producto.cant_entretela, entretela.id_proveedor, proveedor.nombre AS nombre_entretela 
                                                                                    FROM producto LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela 
                                                                                    LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor WHERE entretela.id_entretela = '$id_entretela'";

                                                                    $resultado_4 = mysqli_query($enlace, $consulta_4);

                                                                    $fila4 = mysqli_fetch_array($resultado_4)
                                                                    ?>

                                                                    <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                        <h6 class="modal-title w-100" style="color: white;">Información de la Entretela</h6>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table id="mytabla" class="table table-bordered text-center">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['insumo_entretela']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['cant_entretela']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_totalentretela']); ?></td>
                                                                                    <td class="text-center align-middle"><input type="text" name="color_entretela" class="form-control text-center"></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['nombre_entretela']); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if (!empty($filaFicha['id_entretela2'])): ?>

                                                                    <?php
                                                                    $id_entretela2 = $filaFicha['id_entretela2'];

                                                                    $consulta_5 = "SELECT producto.id_entretela2, entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2, producto.cant_entretela2, entretela2.id_proveedor, proveedor.nombre AS nombre_entretela2 
                                                                                    FROM producto LEFT JOIN entretela2 ON producto.id_entretela2 = entretela2.id_entretela2 
                                                                                    LEFT JOIN proveedor ON entretela2.id_proveedor = proveedor.id_proveedor WHERE entretela2.id_entretela2 = '$id_entretela2'";

                                                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                                                    $fila5 = mysqli_fetch_array($resultado_5)
                                                                    ?>

                                                                    <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                        <h6 class="modal-title w-100" style="color: white;">Información de la Entretela 2</h6>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table id="mytabla" class="table table-bordered text-center">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['insumo_entretela2']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['cant_entretela2']); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_totalentretela2']); ?></td>
                                                                                    <td class="text-center align-middle"><input type="text" name="color_entretela2" class="form-control text-center"></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_entretela2']); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <!-- CURVA DE TALLAS -->
                                                        <div class="card shadow-sm border-0 mb-4">
                                                            <div class="card-header text-white text-center fw-bold" style="background-color:#000DD3;">CURVA DE TALLAS PEDIDO</div>

                                                            <div class="card-body">
                                                                <!-- TALLAS 1 -->
                                                                <div class="table-responsive mb-3">
                                                                    <table class="table table-hover text-center align-middle">
                                                                        <thead style="background-color:#0F7A00; color:white;">
                                                                            <tr class="table-primary">
                                                                                <?php foreach (['2','4','6','8','10','12','14','16','18','20','22','24'] as $t): ?>
                                                                                    <th><?= $t ?></th>
                                                                                <?php endforeach; ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <?php
                                                                                foreach (['2','4','6','8','10','12','14','16','18','20','22','24'] as $talla) {
                                                                                    $valor = htmlspecialchars($filaFicha["talla_$talla"]);
                                                                                    $disabled = $valor == 0 ? 'disabled' : '';
                                                                                    echo "<td> <input type='text' class='form-control form-control-sm text-center' value='$valor' $disabled></td>";
                                                                                }
                                                                                ?>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <!-- TALLAS 2 -->
                                                                <div class="table-responsive mb-3">
                                                                    <table class="table table-hover text-center align-middle">
                                                                        <thead style="background-color:#0F7A00; color:white;">
                                                                            <tr class="table-primary">
                                                                                <?php foreach (['26','28','30','32','34','36','38','40','42','44','46','48'] as $t): ?>
                                                                                    <th><?= $t ?></th>
                                                                                <?php endforeach; ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <?php
                                                                                foreach (['26','28','30','32','34','36','38','40','42','44','46','48'] as $talla) {
                                                                                    $valor = htmlspecialchars($filaFicha["talla_$talla"]);
                                                                                    $disabled = $valor == 0 ? 'disabled' : '';
                                                                                    echo "<td> <input type='text' class='form-control form-control-sm text-center' value='$valor' $disabled></td>";
                                                                                }
                                                                                ?>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <!-- TALLAS 3 -->
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover text-center align-middle">
                                                                        <thead style="background-color:#0F7A00; color:white;">
                                                                            <tr class="table-primary">
                                                                                <?php foreach (['XS','S','M','L','XL','2XL','3XL','4XL','5XL','6XL','ESPECIAL','TOTAL'] as $t): ?>
                                                                                    <th><?= $t ?></th>
                                                                                <?php endforeach; ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <?php
                                                                                foreach (['XS','S','M','L','XL','2XL','3XL','4XL','5XL','6XL','especial'] as $talla) {
                                                                                    $valor = htmlspecialchars($filaFicha["talla_$talla"]);
                                                                                    $disabled = $valor == 0 ? 'disabled' : '';
                                                                                    echo "<td> <input type='text' class='form-control form-control-sm text-center' value='$valor' $disabled></td>";
                                                                                }
                                                                                ?>
                                                                                <td>
                                                                                    <input type="text" class="form-control form-control-sm text-center fw-bold" value="<?php echo htmlspecialchars($filaFicha['suma_prendas']); ?>" readonly>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php if (
                                                            (!empty($filaFicha['id_bolsa']) && $filaFicha['id_bolsa'] != '0') ||
                                                            (!empty($filaFicha['id_boton']) && $filaFicha['id_boton'] != '0') ||
                                                            (!empty($filaFicha['id_boton2']) && $filaFicha['id_boton2'] != '0') ||
                                                            (!empty($filaFicha['id_broche']) && $filaFicha['id_broche'] != '0') ||
                                                            (!empty($filaFicha['id_faya']) && $filaFicha['id_faya'] != '0') ||
                                                            (!empty($filaFicha['id_cinta']) && $filaFicha['id_cinta'] != '0') ||
                                                            (!empty($filaFicha['id_cordon']) && $filaFicha['id_cordon'] != '0') ||
                                                            (!empty($filaFicha['id_cremallera']) && $filaFicha['id_cremallera'] != '0') ||
                                                            (!empty($filaFicha['id_cremallera2']) && $filaFicha['id_cremallera2'] != '0') ||
                                                            (!empty($filaFicha['id_cuello']) && $filaFicha['id_cuello'] != '0') ||
                                                            (!empty($filaFicha['id_deslizador']) && $filaFicha['id_deslizador'] != '0') ||
                                                            (!empty($filaFicha['id_fajon_cintura']) && $filaFicha['id_fajon_cintura'] != '0') ||
                                                            (!empty($filaFicha['id_fusionado']) && $filaFicha['id_fusionado'] != '0') ||
                                                            (!empty($filaFicha['id_guata']) && $filaFicha['id_guata'] != '0') ||
                                                            (!empty($filaFicha['id_hiladilla']) && $filaFicha['id_hiladilla'] != '0') ||
                                                            (!empty($filaFicha['id_hombrera']) && $filaFicha['id_hombrera'] != '0') ||
                                                            (!empty($filaFicha['id_marquilla']) && $filaFicha['id_marquilla'] != '0') ||
                                                            (!empty($filaFicha['id_plumilla']) && $filaFicha['id_plumilla'] != '0') ||
                                                            (!empty($filaFicha['id_pretina']) && $filaFicha['id_pretina'] != '0') ||
                                                            (!empty($filaFicha['id_puntera']) && $filaFicha['id_puntera'] != '0') ||
                                                            (!empty($filaFicha['id_puño']) && $filaFicha['id_puño'] != '0') ||
                                                            (!empty($filaFicha['id_resorte']) && $filaFicha['id_resorte'] != '0') ||
                                                            (!empty($filaFicha['id_resorte2']) && $filaFicha['id_resorte2'] != '0') ||
                                                            (!empty($filaFicha['id_sesgo']) && $filaFicha['id_sesgo'] != '0') ||
                                                            (!empty($filaFicha['id_trabilla']) && $filaFicha['id_trabilla'] != '0') ||
                                                            (!empty($filaFicha['id_velcro']) && $filaFicha['id_velcro'] != '0') ||
                                                            (!empty($filaFicha['id_vinilo']) && $filaFicha['id_vinilo'] != '0') ||
                                                            (!empty($filaFicha['id_vivo']) && $filaFicha['id_vivo'] != '0')
                                                        ): ?>

                                                            <!-- LISTA DE INSUMOS -->
                                                            <div class="card shadow-sm border-0 mb-4">

                                                                <!-- HEADER -->
                                                                <div class="card-header text-white text-center fw-bold" style="background-color:#18a000;">
                                                                    LISTA DE INSUMOS
                                                                </div>

                                                                <!-- TABLA -->
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover align-middle text-center mb-0">

                                                                        <thead style="background-color:#0A1F8F; color:white;">
                                                                            <tr class="table-primary">
                                                                                <th style="text-align: center; vertical-align: middle; width: 50%;">Insumo</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 16%;">Medida</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Consumo <br> Unitario</th>
                                                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Consumo Total <br> X Prenda</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <!-- BLOQUE 1 -->
                                                                            <?php foreach (['cuello', 'puño', 'fusionado'] as $insumo): ?>
                                                                                <?php if (!empty($filaFicha['id_' . $insumo]) && $filaFicha['id_' . $insumo] != '0'): ?>
                                                                                    <tr>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['insumo_' . $insumo]); ?></td>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['medida_' . $insumo]); ?></td>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['consumo_' . $insumo]); ?></td>
                                                                                        <td class="fw-bold"><?php echo htmlspecialchars($filaFicha['consumo_total' . $insumo]); ?></td>
                                                                                    </tr>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>

                                                                            <!-- BLOQUE 2 -->
                                                                            <?php foreach (['boton','boton2','broche','faya','cinta','cordon','cremallera','cremallera2','deslizador','fajon_cintura','guata',
                                                                            'hiladilla','hombrera','plumilla','pretina','puntera','resorte','resorte2','sesgo','trabilla','velcro','vinilo','vivo'] as $insumo): ?>

                                                                                <?php if (!empty($filaFicha['id_' . $insumo]) && $filaFicha['id_' . $insumo] != '0'): ?>
                                                                                    <tr>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['insumo_' . $insumo]); ?></td>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['medida_' . $insumo]); ?></td>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['cant_' . $insumo]); ?></td>
                                                                                        <td class="fw-bold"><?php echo htmlspecialchars($filaFicha['consumo_total' . $insumo]); ?></td>
                                                                                    </tr>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>

                                                                            <!-- FIJOS -->
                                                                            <?php if (!empty($filaFicha['id_marquilla']) && $filaFicha['id_marquilla'] != '0'): ?>
                                                                                <tr>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['insumo_marquilla']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['medida_marquilla']); ?></td>
                                                                                    <td>1</td>
                                                                                    <td class="fw-bold">1</td>
                                                                                </tr>
                                                                            <?php endif; ?>

                                                                            <?php if (!empty($filaFicha['id_bolsa']) && $filaFicha['id_bolsa'] != '0'): ?>
                                                                                <tr>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['insumo_bolsa']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['medida_bolsa']); ?></td>
                                                                                    <td>1</td>
                                                                                    <td class="fw-bold">1</td>
                                                                                </tr>
                                                                            <?php endif; ?>

                                                                        </tbody>

                                                                    </table>
                                                                </div>

                                                            </div>
                                                        <?php endif; ?>

                                                        <?php
                                                            $campos = ['frentes', 'espalda', 'mangas', 'cuello', 'puño', 'delanteros', 'traseros', 'pretina', 'esamble', 'fajon', 'forro', 'otros', 'observaciones'];

                                                            $tieneContenido = false;
                                                            foreach ($campos as $campo) {
                                                                if (!empty($filaFicha[$campo])) {
                                                                    $tieneContenido = true;
                                                                    break;
                                                                }
                                                            }

                                                            if ($tieneContenido): ?>

                                                            <!-- INFORMACIÓN DE CONFECCIÓN -->
                                                            <div class="card shadow-sm border-0 mb-4">
                                                                <!-- HEADER -->
                                                                <div class="card-header text-white text-center fw-bold" style="background-color:#18a000;">
                                                                    INFORMACIÓN DE CONFECCIÓN
                                                                </div>

                                                                <!-- BODY -->
                                                                <div class="card-body">

                                                                    <div class="row g-3">

                                                                        <?php foreach ($campos as $campo): ?>
                                                                            <?php if (!empty($filaFicha[$campo])): ?>

                                                                                <div class="col-md-6">
                                                                                    <label class="form-label fw-semibold text-dark">
                                                                                        <?php echo ucfirst($campo); ?>
                                                                                    </label>

                                                                                    <textarea class="form-control form-control-sm shadow-sm" rows="3" name="<?php echo $campo; ?>" style="resize:none;"><?php echo htmlspecialchars($filaFicha[$campo]); ?></textarea>
                                                                                </div>

                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php endif; ?>

                                                        <!-- CARD -->
                                                        <div class="card border-0 shadow">
                                                            <div class="card-header text-white text-center fw-bold" style="background-color:#18a000;">
                                                                Cargar Ficha Técnica
                                                            </div>

                                                            <div class="card-body text-center">

                                                                <!-- INPUT -->
                                                                <input type="file" class="form-control d-none" name="ficha_tecnica" id="ficha_tecnica<?php echo $id_producto; ?>" accept=".xls,.xlsx,.csv,.pdf,.doc,.docx,.png,.jpg,.jpeg">

                                                                <!-- BOTÓN -->
                                                                <label for="ficha_tecnica<?php echo $id_producto; ?>" class="btn text-white px-4" style="background-color:#000DD3;"> <i class="bi bi-upload"></i> Seleccionar archivo</label>

                                                                <!-- NOMBRE -->
                                                                <p id="file-name-ficha<?php echo $id_producto; ?>" class="mt-3 text-muted small">
                                                                    Ningún archivo seleccionado
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <!-- ALERTA -->
                                                        <div id="alertFicha<?php echo $id_producto; ?>" class="alert text-center mt-4" style="background-color:#fff3cd; border-left:5px solid #ffc107;"> <i class="bi bi-exclamation-triangle-fill"></i> El botón <strong>Continuar</strong> se habilitará cuando cargues la ficha técnica.
                                                        </div>

                                                        <!-- FOOTER -->
                                                        <div class="text-center mt-3">
                                                            <button type="submit" name="submit_finalizar" id="btnContinuar<?php echo $id_producto; ?>" class="btn text-white px-4" style="background-color:#18a000;" disabled> Continuar</button>
                                                        </div>
                                                    </form>
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
        <script>
            document.querySelectorAll('.custom-file-input').forEach(function(inputElement) {
                inputElement.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const idProducto = this.id.replace('imagenInput', '').replace('2', '').replace('3', '').replace('4', '');
                        const preview = document.getElementById('imagenPreview' + this.id.replace('imagenInput', ''));
                        const trElement = this.closest('tr'); // Encuentra el <tr> más cercano

                        preview.src = URL.createObjectURL(file);
                        preview.style.visibility = 'visible';
                        preview.style.maxHeight = '200px';

                        // Ajustar la altura del tr automáticamente
                        setTimeout(() => {
                            trElement.style.height = preview.offsetHeight + 80 + 'px'; // Añade algo de espacio extra
                        }, 100);
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll("input[type='file']").forEach(inputFile => {
                    const idSuffix = inputFile.id.replace("ficha_tecnica", "");
                    const fileNameLabel = document.getElementById("file-name-ficha" + idSuffix);
                    const btnContinuar = document.getElementById("btnContinuar" + idSuffix);
                    const alertBox = document.getElementById("alertFicha" + idSuffix);

                    inputFile.addEventListener("change", function() {
                        if (inputFile.files.length > 0) {
                            fileNameLabel.textContent = inputFile.files[0].name;
                            btnContinuar.disabled = false; // ✅ Habilita el botón
                            if (alertBox) alertBox.style.display = "none"; // ✅ Oculta el aviso
                        } else {
                            fileNameLabel.textContent = "Ningún archivo seleccionado";
                            btnContinuar.disabled = true; // ❌ Deshabilita el botón
                            if (alertBox) alertBox.style.display = "block"; // 🔁 Muestra el aviso nuevamente
                        }
                    });
                });
            });
        </script>
    </body>
</html>