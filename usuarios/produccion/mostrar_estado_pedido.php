<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'produccion'){
            header("Location: inicio_produccion.php");
        }
    }
    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    // Recuperar el id_pedido de la URL
    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    $precio_total = 0;

    date_default_timezone_set('America/Bogota');

    if (isset($_POST['submit_finalizar'])) {
        $id_producto = $_POST['id_producto'];
        $id_pedido = $_POST['id_pedido'];
        date_default_timezone_set('America/Bogota');
        $fecha_actual = date("Y-m-d H:i:s");
        $completado_XS = $_POST['realizar_XS'];
        $completado_S = $_POST['realizar_S'];
        $completado_M = $_POST['realizar_M'];
        $completado_L = $_POST['realizar_L'];
        $completado_XL = $_POST['realizar_XL'];
        $completado_2XL = $_POST['realizar_2XL'];
        $completado_3XL = $_POST['realizar_3XL'];
        $completado_4XL = $_POST['realizar_4XL'];
        $completado_5XL = $_POST['realizar_5XL'];
        $completado_6XL = $_POST['realizar_6XL'];
        $completado_2 = $_POST['realizar_2'];
        $completado_4 = $_POST['realizar_4'];
        $completado_6 = $_POST['realizar_6'];
        $completado_8 = $_POST['realizar_8'];
        $completado_10 = $_POST['realizar_10'];
        $completado_12 = $_POST['realizar_12'];
        $completado_14 = $_POST['realizar_14'];
        $completado_16 = $_POST['realizar_16'];
        $completado_18 = $_POST['realizar_18'];
        $completado_20 = $_POST['realizar_20'];
        $completado_22 = $_POST['realizar_22'];
        $completado_24 = $_POST['realizar_24'];
        $completado_26 = $_POST['realizar_26'];
        $completado_28 = $_POST['realizar_28'];
        $completado_30 = $_POST['realizar_30'];
        $completado_32 = $_POST['realizar_32'];
        $completado_34 = $_POST['realizar_34'];
        $completado_36 = $_POST['realizar_36'];
        $completado_38 = $_POST['realizar_38'];
        $completado_40 = $_POST['realizar_40'];
        $completado_42 = $_POST['realizar_42'];
        $completado_44 = $_POST['realizar_44'];
        $completado_46 = $_POST['realizar_46'];
        $completado_48 = $_POST['realizar_48'];

        $consulta = "UPDATE entregado SET por_entregar = 0, realizar_XS = 0, realizar_S = 0, realizar_M = 0, realizar_L = 0, realizar_XL = 0, realizar_2XL = 0, realizar_3XL = 0, realizar_4XL = 0, realizar_5XL = 0, realizar_6XL = 0, 
            realizar_2 = 0, realizar_4 = 0, realizar_6 = 0, realizar_8 = 0, realizar_10 = 0, realizar_12 = 0, realizar_14 = 0, realizar_16 = 0, realizar_18 = 0, realizar_20 = 0, realizar_22 = 0, realizar_24 = 0,
            realizar_26 = 0, realizar_28 = 0, realizar_30 = 0, realizar_32 = 0, realizar_34 = 0, realizar_36 = 0, realizar_38 = 0, realizar_40 = 0, realizar_42 = 0, realizar_44 = 0, realizar_46 = 0, realizar_48 = 0,
            completado_XS = '$completado_XS', completado_S = '$completado_S', completado_M = '$completado_M', completado_L = '$completado_L', completado_XL = '$completado_XL', completado_2XL = '$completado_2XL', completado_3XL = '$completado_3XL', completado_4XL = '$completado_4XL', completado_5XL = '$completado_5XL', completado_6XL = '$completado_6XL', 
            completado_2 = '$completado_2', completado_4 = '$completado_4', completado_6 = '$completado_6', completado_8 = '$completado_8', completado_10 = '$completado_10', completado_12 = '$completado_12', completado_14 = '$completado_14', completado_16 = '$completado_16', completado_18 = '$completado_18', completado_20 = '$completado_20', completado_22 = '$completado_22', completado_24 = '$completado_24',
            completado_26 = '$completado_26', completado_28 = '$completado_28', completado_30 = '$completado_30', completado_32 = '$completado_32', completado_34 = '$completado_34', completado_36 = '$completado_36', completado_38 = '$completado_38', completado_40 = '$completado_40', completado_42 = '$completado_42', completado_44 = '$completado_44', completado_46 = '$completado_46', completado_48 = '$completado_48'
            WHERE id_producto = '$id_producto'";

        $consulta2 = "UPDATE producto SET fecha_finalizado = '$fecha_actual', estado = 'Completado' WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);

        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: mostrar_pedidos_produccion.php?id_pedido=" . $id_pedido ."&recibido=2");
        exit();
    }

    if (isset($_POST['entrega_parcial'])) {
        $id_producto = $_POST['id_producto'];
        date_default_timezone_set('America/Bogota');
        $fecha_actual = date("Y-m-d H:i:s");
        $id_pedido = $_POST['id_pedido'];
        $por_entregar = 0;
    
        $tamanos = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48'];
    
        $realizar = [];
        $entrega = [];
    
        foreach ($tamanos as $tamano) {
            $realizar[$tamano] = isset($_POST["realizar_$tamano"]) ? (int)$_POST["realizar_$tamano"] : 0;
            $entrega[$tamano] = isset($_POST["entrega_$tamano"]) ? (int)$_POST["entrega_$tamano"] : 0;
        }
    
        // Validar y actualizar tamaños
        foreach ($tamanos as $index => $size) {
            if ($entrega[$size] > $realizar[$size]) {
                header("Location: mostrar_pedidos_produccion.php?id_pedido=$id_pedido&recibido=1");
                exit();
            }
            $realizar[$size] -= $entrega[$size];
        }
    
        // Calcular lo completado
        $completado = [];
        foreach ($tamanos as $size) {
            $completado[$size] = $_POST["realizar_$size"] - $realizar[$size];
        }
    
        // Sumar todas las tallas
        $por_entregar = array_sum($realizar);
    
        // Realizar la consulta de actualización
        if ($por_entregar == 0) {
            $consulta1 = "UPDATE producto SET fecha_finalizado = '$fecha_actual', estado = 'Completado' WHERE id_producto = '$id_producto'";
            $resultado1 = mysqli_query($enlace, $consulta1);
    
            header("Location: mostrar_pedidos_produccion.php?id_pedido=$id_pedido&recibido=0");
            exit();
        } else {
            $consulta2 = "UPDATE producto SET ";
            foreach ($tamanos as $size) {
                $consulta2 .= "realizar_$size = '{$realizar[$size]}', ";
                $consulta2 .= "entrega_$size = '{$entrega[$size]}', ";
                $consulta2 .= "completado_$size = '{$completado[$size]}', ";
            }
            $consulta2 .= "por_entregar = '$por_entregar' WHERE id_producto = '$id_producto'";
    
            $resultado2 = mysqli_query($enlace, $consulta2);
    
            $consulta3 = "UPDATE producto SET fecha_entregado = '$fecha_actual', estado = 'Parcial' WHERE id_producto = '$id_producto'";
            $resultado3 = mysqli_query($enlace, $consulta3);
    
            header("Location: mostrar_pedidos_produccion.php?id_pedido=$id_pedido&recibido=0");
            exit();
        }
    }

    $recibido = $_GET['recibido'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        
        <!-- Estilos personalizados -->
        <link rel="stylesheet" href="css/barra.css">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo_iniciar_sesion.css">
        <style>
            .btn-custom {
                border-radius: 20px;
                max-width: 200px; /* Establece el ancho máximo deseado */
                width: 100%; /* Ocupa el 100% del ancho disponible */
            }
            body {
                overflow-x: hidden;
            }
            .custom-box {
                border: 1px solid #343a40;
                border-radius: 3rem; /* 6px */
                background-color: #f8f9fa;
                padding: 0.75rem; /* 20px */
                display: flex;
                justify-content: space-between;
            }
        </style>
        
        <title>Unidotaciones</title>
    </head>
    <body>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
                </a>
                <a href="inicio_produccion.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <?php
            $consulta = "SELECT 
            producto.id_producto, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.precio_total, 
            entregado.realizar_XS, entregado.realizar_S, entregado.realizar_M, entregado.realizar_L, entregado.realizar_XL, entregado.realizar_2XL, entregado.realizar_3XL, entregado.realizar_4XL, entregado.realizar_5XL, entregado.realizar_6XL, entregado.realizar_2, entregado.realizar_4, entregado.realizar_6, entregado.realizar_8, entregado.realizar_10, entregado.realizar_12, entregado.realizar_14, 
            entregado.realizar_16, entregado.realizar_18, entregado.realizar_20, entregado.realizar_22, entregado.realizar_24, entregado.realizar_26, entregado.realizar_28, entregado.realizar_30, entregado.realizar_32, entregado.realizar_34, entregado.realizar_36, entregado.realizar_38, entregado.realizar_40, entregado.realizar_42, entregado.realizar_44, entregado.realizar_46, entregado.realizar_48,
            entregado.entrega_XS, entregado.entrega_S, entregado.entrega_M, entregado.entrega_L, entregado.entrega_XL, entregado.entrega_2XL, entregado.entrega_3XL, entregado.entrega_4XL, entregado.entrega_5XL, entregado.entrega_6XL, entregado.entrega_2, entregado.entrega_4, entregado.entrega_6, entregado.entrega_8, entregado.entrega_10, entregado.entrega_12, entregado.entrega_14, entregado.entrega_16, 
            entregado.entrega_18, entregado.entrega_20, entregado.entrega_22, entregado.entrega_24, entregado.entrega_26, entregado.entrega_28, entregado.entrega_30, entregado.entrega_32, entregado.entrega_34, entregado.entrega_36, entregado.entrega_38, entregado.entrega_40, entregado.entrega_42, entregado.entrega_44, entregado.entrega_46, entregado.entrega_48,
            entregado.completado_XS, entregado.completado_S, entregado.completado_M, entregado.completado_L, entregado.completado_XL, entregado.completado_2XL, entregado.completado_3XL, entregado.completado_4XL, entregado.completado_5XL, entregado.completado_6XL, entregado.completado_2, entregado.completado_4, entregado.completado_6, entregado.completado_8, entregado.completado_10, entregado.completado_12, entregado.completado_14, 
            entregado.completado_16, entregado.completado_18, entregado.completado_20, entregado.completado_22, entregado.completado_24, entregado.completado_26, entregado.completado_28, entregado.completado_30, entregado.completado_32, entregado.completado_34, entregado.completado_36, entregado.completado_38, entregado.completado_40, entregado.completado_42, entregado.completado_44, entregado.completado_46, entregado.completado_48,
            entregado.id_entregado, entregado.id_producto, entregado.por_entregar, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.color_telauno, producto.color_telados, producto.color_telatres, producto.color_telacuatro, producto.color_combiuno, producto.color_combidos, producto.color_combitres, 
            producto.color_combicuatro, producto.color_forrouno, producto.color_forrodos, producto.color_forrotres, producto.color_forrocuatro, producto.consumo_cuello, producto.cant_boton, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, 
            producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, producto.valor_pretina, producto.valor_broche, 
            producto.valor_cordon, producto.consumo_hilo, producto.precio_obra, producto.costo_total, producto.nombre_producto, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas, producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.nombre_proveedor, producto.precio_compra, producto.valor_agregado, 
            producto.margen_bruto, producto.valor_porcentajeestampilla, producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.precio_cuello, producto.precio_puño, producto.precio_boton, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
            producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_calibre, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, pedido.listado_empleados, pedido.orden_compra, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, 
        
            tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon, muestra.id_muestra, muestra.requiere, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, cinta_reflectiva.id_cinta, 
            cinta_reflectiva.insumo AS insumo_reflectiva, hilo.id_hilo, hilo.prenda, calibre.id_calibre, calibre.calibre, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, 
            hombrera.insumo AS insumo_hombrera, sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera,
            bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, entidad.id_entidad, cliente.nit, cliente.id_entidad, pedido.nit, pedido.total_factura, pedido.prendas_realizar

            FROM producto
            LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño 
            LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN hilo ON producto.id_hilo = hilo.id_hilo LEFT JOIN calibre ON producto.id_calibre = calibre.id_calibre LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
            LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya LEFT JOIN guata ON producto.id_guata = guata.id_guata LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina LEFT JOIN broche ON producto.id_broche = broche.id_broche LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
            LEFT JOIN bolsillo ON producto.id_bolsillo = bolsillo.id_bolsillo LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra LEFT JOIN entregado ON entregado.id_producto = producto.id_producto
            WHERE pedido.id_pedido = $id_pedido AND (producto.estado IS NULL OR producto.estado = 'Parcial')";

            $resultado = mysqli_query($enlace, $consulta);
        ?>
        
        
        <?php
            $fila = mysqli_fetch_assoc($resultado);

            // Verificar si hay resultados
            if ($fila) {
                $totalFactura = number_format($fila['total_factura'], 2, ',', '.');
                $prendasTotales = $fila['prendas_realizar'];
            } else {
                // Si no hay resultados, establecer los valores predeterminados a 0
                $totalFactura = '0,00';
                $prendasTotales = 0;
            }
        ?>

        <div style="display: flex;">
            <div class="container custom-container" style="max-width: 350px; margin-right: 1px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Total Factura:</span>
                    <span>$<?= $totalFactura ?></span>
                </div>
            </div>

            <div class="container custom-container" style="max-width: 350px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Prendas Totales:</span>
                    <span id="totalFactura"><?= $prendasTotales ?></span>
                </div>
            </div>
        </div><br>

        <div class="text-center">
            <!-- Botón Descargar Excel -->
            <?php
                // Verifica si el archivo de listado de empleados existe
                $archivoListado = $fila['listado_empleados'];
                if (!empty($archivoListado) && file_exists("listado_empleados/" . $archivoListado)) {
                    echo '<a href="listado_empleados/' . $archivoListado . '" class="btn btn-success" download>';
                    echo '<i class="bi bi-filetype-xlsx"></i> Descargar Listado de Empleados';
                    echo '</a>';
                } else {
                    echo '<button class="btn btn-secondary" disabled>';
                    echo '<i class="bi bi-filetype-xlsx"></i> No hay archivo disponible';
                    echo '</button>';
                }
            ?>

            <!-- Botón Descargar PDF -->
            <?php
                // Verifica si el archivo de listado de empleados existe
                $archivoListado2 = $fila['orden_compra'];
                if (!empty($archivoListado2) && file_exists("orden_compra/" . $archivoListado2)) {
                    echo '<a href="orden_compra/' . $archivoListado2 . '" class="btn btn-danger" download>';
                    echo '<i class="bi bi-filetype-pdf"></i> Descargar Orden de Compra';
                    echo '</a>';
                } else {
                    echo '<button class="btn btn-secondary" disabled>';
                    echo '<i class="bi bi-filetype-pdf"></i> No hay archivo disponible';
                    echo '</button>';
                }
            ?>
        </div><br>

        <?php
        // Reiniciar el puntero al principio del conjunto de resultados
        mysqli_data_seek($resultado, 0);

        // Mostrar la siguiente información
        $fila = mysqli_fetch_assoc($resultado);
        ?>

        <?php foreach ($_REQUEST as $var => $val) { $$var = $val; }
            if ($recibido == 1) { ?>
                <div class="container">
                    <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert"
                        <i class="bi bi-check-circle-fill"></i><strong>    Error!</strong> No se pudo realizar la accion ya que esta intentando ingresar un valor mayor de entrega de lo que realmente falta por entregar del Producto.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div> 
            <?php } 
            if ($recibido == 2) { ?>
                <div class="container">
                    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i><strong>    Exito!</strong> El Producto a cambiado de estado a entregado<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div> 
            <?php }
        ?>
                
        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                mysqli_data_seek($resultado, 0);
                while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                <div class="col-12 col-md-6 mb-3">
                    <div class="modal-content rounded-4 modal-fullscreen">
                        <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?></h5>
                        </div>
                        <div class="card-body">
                            <!-- Cargar imagen -->
                            <div>
                                <?php
                                    $imagenProducto1 = $fila['imagen'];
                                    $imagenProducto2 = $fila['imagen2'];
                                    $imagenProducto3 = $fila['imagen3'];
                                    $imagenProducto4 = $fila['imagen4'];
                                ?>
                                <?php if (!empty($imagenProducto1) || !empty($imagenProducto2)): ?>
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes suministradas por la empresa</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php if (!empty($imagenProducto1)): ?>
                                                <div class="text-center mx-2">
                                                    <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid rounded shadow-sm img-thumbnail" style="max-width: 130px;" data-toggle="modal" data-target="#modalImagenProducto1_<?= $contador_producto ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($imagenProducto2)): ?>
                                                <div class="text-center mx-2">
                                                    <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid rounded shadow-sm img-thumbnail" style="max-width: 130px;" data-toggle="modal" data-target="#modalImagenProducto2_<?= $contador_producto ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($imagenProducto3) || !empty($imagenProducto3)): ?>
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php if (!empty($imagenProducto3)): ?>
                                                <div class="text-center mx-2">
                                                    <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" class="img-fluid rounded shadow-sm img-thumbnail" style="max-width: 130px;" data-toggle="modal" data-target="#modalImagenProducto3_<?= $contador_producto ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($imagenProducto4)): ?>
                                                <div class="text-center mx-2">
                                                    <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" class="img-fluid rounded shadow-sm img-thumbnail" style="max-width: 130px;" data-toggle="modal" data-target="#modalImagenProducto4_<?= $contador_producto ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Modal Imagen Producto 1 -->
                                <?php if (!empty($imagenProducto1)): ?>
                                    <div class="modal fade" id="modalImagenProducto1_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-3">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                                    <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Imagen Producto 2 -->
                                <?php if (!empty($imagenProducto2)): ?>
                                    <div class="modal fade" id="modalImagenProducto2_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto2" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-3">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                                    <img src="img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Imagen Producto 3 -->
                                <?php if (!empty($imagenProducto3)): ?>
                                    <div class="modal fade" id="modalImagenProducto3_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto3" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-3">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                                    <img src="img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Imagen Producto 4 -->
                                <?php if (!empty($imagenProducto4)): ?>
                                    <div class="modal fade" id="modalImagenProducto4_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto4" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-3">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                                    <img src="img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div>
                                <?php
                                    $logoProducto1 = $fila['logo1'];
                                    $logoProducto2 = $fila['logo2'];
                                    $logoProducto3 = $fila['logo3'];
                                    $logoProducto4 = $fila['logo4'];

                                    if (!function_exists('displayFile')) {
                                        function displayFile($file) {
                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                            $fileName = basename($file);
                                            if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                echo '<a href="logos_empresas/' . $file . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                            } else {
                                                echo '<a href="logos_empresas/' . $file . '" target="_blank" download class="d-block mx-1 mb-2">
                                                        <img src="logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                    </a>';
                                            }
                                        }
                                    }
                                ?>
                                <?php if (!empty($logoProducto1) || !empty($logoProducto2) || !empty($logoProducto3) || !empty($logoProducto4)): ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
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
                                <?php endif; ?>
                            </div>

                            <div class="card-text-container">
                                <div class="mb-2 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos sobre la cotizacion</h6>
                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Costo Total :</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $<?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <?php if (!empty($fila['por_entregar'])): ?>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 20px;">
                                            <span class="font-weight-bold">Prendas por entregar: </span> <?php echo $fila['por_entregar']; ?>
                                        </p>
                                    <?php else: ?>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 20px;">
                                            <span class="font-weight-bold">Prendas por entregar: </span><?php echo $fila['suma_prendas']; ?>
                                        </p>
                                    <?php endif; ?>
                                    <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p></div>
                                    <?php if (!empty($fila['id_entrega'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cuello'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cuello:</span> <?= $fila['insumo_cuello'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_puño'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Puño:</span> <?= $fila['insumo_puño'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_boton'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Boton:</span> <?= $fila['insumo_boton'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_fusionado'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Fusionado:</span> <?= $fila['insumo_fusionado'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_entretela'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Entretela:</span> <?= $fila['insumo_entretela'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cinta'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cinta Reflectiva:</span> <?= $fila['insumo_reflectiva'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cremallera'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cremallera 1:</span> <?= $fila['insumo_cremallera'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cremallera2'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cremallera 2:</span> <?= $fila['insumo_cremallera2'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_velcro'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Velcro:</span> <?= $fila['insumo_velcro'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_resorte'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Resorte 1:</span> <?= $fila['insumo_resorte'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_resorte2'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Resorte 2:</span> <?= $fila['insumo_resorte2'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_hombrera'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Hombrera:</span> <?= $fila['insumo_hombrera'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_sesgo'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Sesgo:</span> <?= $fila['insumo_sesgo'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_trabilla'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Trabilla:</span> <?= $fila['insumo_trabilla'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_vivo'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Vivo:</span> <?= $fila['insumo_vivo'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_faya'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cinta Faya:</span> <?= $fila['insumo_faya'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_guata'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Guata:</span> <?= $fila['insumo_guata'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_broche'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Broche:</span> <?= $fila['insumo_broche'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cordon'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cordon:</span> <?= $fila['insumo_cordon'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_puntera'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Puntera:</span> <?= $fila['insumo_puntera'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_bordado'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Bordado:</span> <?= $fila['tipo_bordado'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_estampado'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Estampado:</span> <?= $fila['tipo_estampado'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_bolsillo'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Bolsillo:</span> <?= $fila['tipo_bolsillo'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php
                                $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48');
                                $mostrarTallas = false;

                                foreach ($tallas as $talla) {
                                    $cantidad = $fila['realizar_' . $talla];
                                    if ($cantidad > 0) {
                                        $mostrarTallas = true;
                                        break;
                                    }
                                }

                                if ($mostrarTallas) :
                                    ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Tallas por entregar de Hombre</h6>
                                        <div class="mb-2 row justify-content-center">
                                            <?php 
                                            $count = 0;
                                            foreach ($tallas as $talla) :
                                                $cantidad = $fila['realizar_' . $talla];
                                                if ($cantidad > 0) : 
                                                    if ($count > 0 && $count % 3 == 0) {
                                                        echo '</div><div class="mb-2 row justify-content-center">';
                                                    }
                                                    ?>
                                                    <div class="col-md-4" style="margin-bottom: 1px;">
                                                        <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                            <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                        </p>
                                                    </div>
                                                    <?php 
                                                    $count++;
                                                endif; 
                                            endforeach; 
                                            ?>
                                        </div>
                                    </div>
                                <?php endif; 
                            ?>
                            <?php
                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26');
                                $mostrarTallas = false;

                                foreach ($tallas as $talla) {
                                    $cantidad = $fila['realizar_' . $talla];
                                    if ($cantidad > 0) {
                                        $mostrarTallas = true;
                                        break;
                                    }
                                }

                                if ($mostrarTallas) :
                                ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Tallas por entregar de Dama</h6>
                                        <div class="mb-2 row justify-content-center">
                                            <?php 
                                            $count = 0;
                                            foreach ($tallas as $talla) :
                                                $cantidad = $fila['realizar_' . $talla];
                                                if ($cantidad > 0) : 
                                                    if ($count > 0 && $count % 3 == 0) {
                                                        echo '</div><div class="mb-1 row justify-content-center">';
                                                    }
                                                        ?>
                                                    <div class="col-md-4" style="margin-bottom: 1px;">
                                                        <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                            <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                        </p>
                                                    </div>
                                                    <?php 
                                                    $count++;
                                                endif; 
                                            endforeach; 
                                            ?>
                                        </div>
                                    </div>
                                <?php endif; 
                            ?>

                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p></div>
                                <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_obra'] ?> por prenda</p></div>
                            </div>

                            <?php if (!empty($fila['precio_estampado']) || !empty($fila['precio_bordado'])): ?>
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de los logos</h6>
                                    <?php if (!empty($fila['precio_estampado'])): ?>
                                        <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Estampado:</span> $<?= $fila['precio_estampado'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['precio_bordado'])): ?>
                                        <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Bordado:</span> $<?= $fila['precio_bordado'] ?></p></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php
                                $campos = ['frentes' => 'Descripción del Frente','espalda' => 'Descripción de la Espalda','mangas' => 'Descripción de las Mangas','cuello' => 'Descripción del Cuello','puño' => 'Descripción del Puño','delanteros' => 'Descripción de los Delanteros','traseros' => 'Descripción de los Traseros',
                                    'pretina' => 'Descripción de la Pretina','ensamble' => 'Descripción del Ensamble','fajon' => 'Descripción del Fajón','forro' => 'Descripción del Forro','otros' => 'Otras Descripciones','observaciones' => 'Observaciones', 'obs_logo' => 'Observaciones sobre los Logos','valor_agregado' => 'Valor Agregado al Producto'
                                ];

                                foreach ($campos as $campo => $titulo):
                                    if (!empty($fila[$campo])): ?>
                                        <div class="mb-1 border rounded p-1">
                                            <h6 class="text-muted text-center font-weight-bold bg-light p-1 rounded"><?= $titulo ?></h6>
                                            <p class="card-text" style="padding: 10px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                <span class="font-weight-bold"></span> <?= $fila[$campo] ?>
                                            </p>
                                        </div>
                                    <?php endif;
                                endforeach;
                            ?>

                            <?php if (!empty($fila['telaa'])): ?>
                                <div class="mb-1 mt-1 text-center border rounded p-1"> 
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                    <div class="mb-3">
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela: </span> <?php echo $fila['tela']; ?></p>
                                    </div>
                                    <div class="mb-2 row">
                                        <?php if(!empty($fila['color_telauno'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 1: </span> <?php echo $fila['color_telauno']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_telados'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 2: </span> <?php echo $fila['color_telados']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_telatres'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 3: </span> <?php echo $fila['color_telatres']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_telacuatro'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 4: </span> <?php echo $fila['color_telacuatro']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($fila['telacombinada'])): ?>
                                <div class="mb-1 mt-1 text-center border rounded p-1"> 
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela combinada</h6>
                                    <div class="mb-3">
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Combinada: </span> <?php echo $fila['tela_combi']; ?></p>
                                    </div>
                                        <div class="mb-2 row">
                                        <?php if(!empty($fila['color_combiuno'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 1: </span> <?php echo $fila['color_combiuno']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_combidos'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 2: </span> <?php echo $fila['color_combidos']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_combitres'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 3: </span> <?php echo $fila['color_combitres']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_combicuatro'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 4: </span> <?php echo $fila['color_combicuatro']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($fila['telaforro'])): ?>
                                <div class="mb-1 mt-1 text-center border rounded p-1"> 
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                    <div class="mb-3">
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Forro: </span> <?php echo $fila['tela_forro']; ?></p>
                                    </div>
                                    <div class="mb-2 row">
                                        <?php if(!empty($fila['color_forrouno'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 1: </span> <?php echo $fila['color_forrouno']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_forrodos'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 2: </span> <?php echo $fila['color_forrodos']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_forrotres'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 3: </span> <?php echo $fila['color_forrotres']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($fila['color_forrocuatro'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Color de la Tela 4: </span> <?php echo $fila['color_forrocuatro']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>                        

                            <div class="text-center align-middle">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#parcial<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-realizar-XS="<?php echo $fila['realizar_XS']; ?>"
                                        data-realizar-S="<?php echo $fila['realizar_S']; ?>"
                                        data-realizar-M="<?php echo $fila['realizar_M']; ?>"
                                        data-realizar-L="<?php echo $fila['realizar_L']; ?>"
                                        data-realizar-XL="<?php echo $fila['realizar_XL']; ?>"
                                        data-realizar-2XL="<?php echo $fila['realizar_2XL']; ?>"
                                        data-realizar-3XL="<?php echo $fila['realizar_3XL']; ?>"
                                        data-realizar-4XL="<?php echo $fila['realizar_4XL']; ?>"
                                        data-realizar-5XL="<?php echo $fila['realizar_5XL']; ?>"
                                        data-realizar-6XL="<?php echo $fila['realizar_6XL']; ?>"
                                        data-realizar-2="<?php echo $fila['realizar_2']; ?>"
                                        data-realizar-4="<?php echo $fila['realizar_4']; ?>"
                                        data-realizar-6="<?php echo $fila['realizar_6']; ?>"
                                        data-realizar-8="<?php echo $fila['realizar_8']; ?>"
                                        data-realizar-10="<?php echo $fila['realizar_10']; ?>"
                                        data-realizar-12="<?php echo $fila['realizar_12']; ?>"
                                        data-realizar-14="<?php echo $fila['realizar_14']; ?>"
                                        data-realizar-16="<?php echo $fila['realizar_16']; ?>"
                                        data-realizar-18="<?php echo $fila['realizar_18']; ?>"
                                        data-realizar-20="<?php echo $fila['realizar_20']; ?>"
                                        data-realizar-22="<?php echo $fila['realizar_22']; ?>"
                                        data-realizar-24="<?php echo $fila['realizar_24']; ?>"
                                        data-realizar-26="<?php echo $fila['realizar_26']; ?>"
                                        data-realizar-28="<?php echo $fila['realizar_28']; ?>"
                                        data-realizar-30="<?php echo $fila['realizar_30']; ?>"
                                        data-realizar-32="<?php echo $fila['realizar_32']; ?>"
                                        data-realizar-34="<?php echo $fila['realizar_34']; ?>"
                                        data-realizar-36="<?php echo $fila['realizar_36']; ?>"
                                        data-realizar-38="<?php echo $fila['realizar_38']; ?>"
                                        data-realizar-40="<?php echo $fila['realizar_40']; ?>"
                                        data-realizar-42="<?php echo $fila['realizar_42']; ?>"
                                        data-realizar-44="<?php echo $fila['realizar_44']; ?>"
                                        data-realizar-46="<?php echo $fila['realizar_46']; ?>"
                                        data-realizar-48="<?php echo $fila['realizar_48']; ?>
                                        data-id-pedido="<?php echo $fila['id_pedido']; ?>">
                                        Entrega Parcial <i class="bi bi-list-task"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-realizar-XS="<?php echo $fila['realizar_XS']; ?>"
                                        data-realizar-S="<?php echo $fila['realizar_S']; ?>"
                                        data-realizar-M="<?php echo $fila['realizar_M']; ?>"
                                        data-realizar-L="<?php echo $fila['realizar_L']; ?>"
                                        data-realizar-XL="<?php echo $fila['realizar_XL']; ?>"
                                        data-realizar-2XL="<?php echo $fila['realizar_2XL']; ?>"
                                        data-realizar-3XL="<?php echo $fila['realizar_3XL']; ?>"
                                        data-realizar-4XL="<?php echo $fila['realizar_4XL']; ?>"
                                        data-realizar-5XL="<?php echo $fila['realizar_5XL']; ?>"
                                        data-realizar-6XL="<?php echo $fila['realizar_6XL']; ?>"
                                        data-realizar-2="<?php echo $fila['realizar_2']; ?>"
                                        data-realizar-4="<?php echo $fila['realizar_4']; ?>"
                                        data-realizar-6="<?php echo $fila['realizar_6']; ?>"
                                        data-realizar-8="<?php echo $fila['realizar_8']; ?>"
                                        data-realizar-10="<?php echo $fila['realizar_10']; ?>"
                                        data-realizar-12="<?php echo $fila['realizar_12']; ?>"
                                        data-realizar-14="<?php echo $fila['realizar_14']; ?>"
                                        data-realizar-16="<?php echo $fila['realizar_16']; ?>"
                                        data-realizar-18="<?php echo $fila['realizar_18']; ?>"
                                        data-realizar-20="<?php echo $fila['realizar_20']; ?>"
                                        data-realizar-22="<?php echo $fila['realizar_22']; ?>"
                                        data-realizar-24="<?php echo $fila['realizar_24']; ?>"
                                        data-realizar-26="<?php echo $fila['realizar_26']; ?>"
                                        data-realizar-28="<?php echo $fila['realizar_28']; ?>"
                                        data-realizar-30="<?php echo $fila['realizar_30']; ?>"
                                        data-realizar-32="<?php echo $fila['realizar_32']; ?>"
                                        data-realizar-34="<?php echo $fila['realizar_34']; ?>"
                                        data-realizar-36="<?php echo $fila['realizar_36']; ?>"
                                        data-realizar-38="<?php echo $fila['realizar_38']; ?>"
                                        data-realizar-40="<?php echo $fila['realizar_40']; ?>"
                                        data-realizar-42="<?php echo $fila['realizar_42']; ?>"
                                        data-realizar-44="<?php echo $fila['realizar_44']; ?>"
                                        data-realizar-46="<?php echo $fila['realizar_46']; ?>"
                                        data-realizar-48="<?php echo $fila['realizar_48']; ?>
                                        data-id-pedido="<?php echo $fila['id_pedido']; ?>">
                                        Completado <i class="bi bi-check-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php
                    $contador_producto++; // Incrementar contador de productos
                }?>
            
                <?php
                    $resultado = mysqli_query($enlace, $consulta);

                    while ($fila = mysqli_fetch_array($resultado)) {
                ?>

                <!-- Modal Entrega Parcial -->
                <div class="modal fade" id="parcial<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Ingrese el numero de prendas entregadas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <?php if(!empty($fila['realizar_XS'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla XS por realizar <?php echo $fila['realizar_XS']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_XS" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_S'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla S por realizar <?php echo $fila['realizar_S']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_S" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_M'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla M por realizar <?php echo $fila['realizar_M']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_M" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_L'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla L por realizar <?php echo $fila['realizar_L']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_L" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_XL'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla XL por realizar <?php echo $fila['realizar_XL']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_XL" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_2XL'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 2XL por realizar <?php echo $fila['realizar_2XL']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_2XL" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_3XL'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 3XL por realizar <?php echo $fila['realizar_3XL']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_3XL" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_4XL'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 4XL por realizar <?php echo $fila['realizar_4XL']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_4XL" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_5XL'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 5XL por realizar <?php echo $fila['realizar_5XL']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_5XL" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_6XL'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 6XL por realizar <?php echo $fila['realizar_6XL']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_6XL" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_2'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 2 por realizar <?php echo $fila['realizar_2']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_2" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_4'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 4 por realizar <?php echo $fila['realizar_4']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_4" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_6'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 6 por realizar <?php echo $fila['realizar_6']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_6" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_8'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 8 por realizar <?php echo $fila['realizar_8']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_8" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_10'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 10 por realizar <?php echo $fila['realizar_10']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_10" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_12'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 12 por realizar <?php echo $fila['realizar_12']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_12" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_14'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 14 por realizar <?php echo $fila['realizar_14']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_14" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_16'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 16 por realizar <?php echo $fila['realizar_16']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_16" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_18'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 18 por realizar <?php echo $fila['realizar_18']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_18" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_20'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 20 por realizar <?php echo $fila['realizar_20']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_20" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_22'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 22 por realizar <?php echo $fila['realizar_22']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_22" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_24'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 24 por realizar <?php echo $fila['realizar_24']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_24" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_26'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 26 por realizar <?php echo $fila['realizar_26']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_26" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_28'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 28 por realizar <?php echo $fila['realizar_28']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_28" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_30'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 30 por realizar <?php echo $fila['realizar_30']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_30" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_32'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 32 por realizar <?php echo $fila['realizar_32']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_32" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_34'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 34 por realizar <?php echo $fila['realizar_34']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_34" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_36'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 36 por realizar <?php echo $fila['realizar_36']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_36" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_38'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 38 por realizar <?php echo $fila['realizar_38']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_38" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_40'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 40 por realizar <?php echo $fila['realizar_40']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_40" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_42'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 42 por realizar <?php echo $fila['realizar_42']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_42" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_44'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 44 por realizar <?php echo $fila['realizar_44']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_44" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_46'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 46 por realizar <?php echo $fila['realizar_46']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_46" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($fila['realizar_48'])): ?>
                                        <div class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Numero de prendas Talla 48 por realizar <?php echo $fila['realizar_48']; ?> y se entregaron:</span>
                                            <input type="number" class="form-control d-inline-block ml-2" name="entrega_48" value="0" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;">
                                        </div>
                                    <?php endif; ?>

                                    <br>
                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                    <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
                                    <input type="hidden" name="realizar_XS" value="<?php echo $fila['realizar_XS']; ?>">
                                    <input type="hidden" name="realizar_S" value="<?php echo $fila['realizar_S']; ?>">
                                    <input type="hidden" name="realizar_M" value="<?php echo $fila['realizar_M']; ?>">
                                    <input type="hidden" name="realizar_L" value="<?php echo $fila['realizar_L']; ?>">
                                    <input type="hidden" name="realizar_XL" value="<?php echo $fila['realizar_XL']; ?>">
                                    <input type="hidden" name="realizar_2XL" value="<?php echo $fila['realizar_2XL']; ?>">
                                    <input type="hidden" name="realizar_3XL" value="<?php echo $fila['realizar_3XL']; ?>">
                                    <input type="hidden" name="realizar_4XL" value="<?php echo $fila['realizar_4XL']; ?>">
                                    <input type="hidden" name="realizar_5XL" value="<?php echo $fila['realizar_5XL']; ?>">
                                    <input type="hidden" name="realizar_6XL" value="<?php echo $fila['realizar_6XL']; ?>">
                                    <input type="hidden" name="realizar_2" value="<?php echo $fila['realizar_2']; ?>">
                                    <input type="hidden" name="realizar_4" value="<?php echo $fila['realizar_4']; ?>">
                                    <input type="hidden" name="realizar_6" value="<?php echo $fila['realizar_6']; ?>">
                                    <input type="hidden" name="realizar_8" value="<?php echo $fila['realizar_8']; ?>">
                                    <input type="hidden" name="realizar_10" value="<?php echo $fila['realizar_10']; ?>">
                                    <input type="hidden" name="realizar_12" value="<?php echo $fila['realizar_12']; ?>">
                                    <input type="hidden" name="realizar_14" value="<?php echo $fila['realizar_14']; ?>">
                                    <input type="hidden" name="realizar_16" value="<?php echo $fila['realizar_16']; ?>">
                                    <input type="hidden" name="realizar_18" value="<?php echo $fila['realizar_18']; ?>">
                                    <input type="hidden" name="realizar_20" value="<?php echo $fila['realizar_20']; ?>">
                                    <input type="hidden" name="realizar_22" value="<?php echo $fila['realizar_22']; ?>">
                                    <input type="hidden" name="realizar_24" value="<?php echo $fila['realizar_24']; ?>">
                                    <input type="hidden" name="realizar_26" value="<?php echo $fila['realizar_26']; ?>">
                                    <input type="hidden" name="realizar_28" value="<?php echo $fila['realizar_28']; ?>">
                                    <input type="hidden" name="realizar_30" value="<?php echo $fila['realizar_30']; ?>">
                                    <input type="hidden" name="realizar_32" value="<?php echo $fila['realizar_32']; ?>">
                                    <input type="hidden" name="realizar_34" value="<?php echo $fila['realizar_34']; ?>">
                                    <input type="hidden" name="realizar_36" value="<?php echo $fila['realizar_36']; ?>">
                                    <input type="hidden" name="realizar_38" value="<?php echo $fila['realizar_38']; ?>">
                                    <input type="hidden" name="realizar_40" value="<?php echo $fila['realizar_40']; ?>">
                                    <input type="hidden" name="realizar_42" value="<?php echo $fila['realizar_42']; ?>">
                                    <input type="hidden" name="realizar_44" value="<?php echo $fila['realizar_44']; ?>">
                                    <input type="hidden" name="realizar_46" value="<?php echo $fila['realizar_46']; ?>">
                                    <input type="hidden" name="realizar_48" value="<?php echo $fila['realizar_48']; ?>">
                                    <button type="submit" name="entrega_parcial" class="btn btn-success">Continuar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal completo -->
                <div class="modal fade" id="modal<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea proceseder con su Operacion?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning" role="alert">Presione Continuar si el Producto se ha Finalizado con Exito.</div>
                            </div>
                            <div class="modal-footer">
                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                    <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
                                    <input type="hidden" name="realizar_XS" value="<?php echo $fila['realizar_XS']; ?>">
                                    <input type="hidden" name="realizar_S" value="<?php echo $fila['realizar_S']; ?>">
                                    <input type="hidden" name="realizar_M" value="<?php echo $fila['realizar_M']; ?>">
                                    <input type="hidden" name="realizar_L" value="<?php echo $fila['realizar_L']; ?>">
                                    <input type="hidden" name="realizar_XL" value="<?php echo $fila['realizar_XL']; ?>">
                                    <input type="hidden" name="realizar_2XL" value="<?php echo $fila['realizar_2XL']; ?>">
                                    <input type="hidden" name="realizar_3XL" value="<?php echo $fila['realizar_3XL']; ?>">
                                    <input type="hidden" name="realizar_4XL" value="<?php echo $fila['realizar_4XL']; ?>">
                                    <input type="hidden" name="realizar_5XL" value="<?php echo $fila['realizar_5XL']; ?>">
                                    <input type="hidden" name="realizar_6XL" value="<?php echo $fila['realizar_6XL']; ?>">
                                    <input type="hidden" name="realizar_2" value="<?php echo $fila['realizar_2']; ?>">
                                    <input type="hidden" name="realizar_4" value="<?php echo $fila['realizar_4']; ?>">
                                    <input type="hidden" name="realizar_6" value="<?php echo $fila['realizar_6']; ?>">
                                    <input type="hidden" name="realizar_8" value="<?php echo $fila['realizar_8']; ?>">
                                    <input type="hidden" name="realizar_10" value="<?php echo $fila['realizar_10']; ?>">
                                    <input type="hidden" name="realizar_12" value="<?php echo $fila['realizar_12']; ?>">
                                    <input type="hidden" name="realizar_14" value="<?php echo $fila['realizar_14']; ?>">
                                    <input type="hidden" name="realizar_16" value="<?php echo $fila['realizar_16']; ?>">
                                    <input type="hidden" name="realizar_18" value="<?php echo $fila['realizar_18']; ?>">
                                    <input type="hidden" name="realizar_20" value="<?php echo $fila['realizar_20']; ?>">
                                    <input type="hidden" name="realizar_22" value="<?php echo $fila['realizar_22']; ?>">
                                    <input type="hidden" name="realizar_24" value="<?php echo $fila['realizar_24']; ?>">
                                    <input type="hidden" name="realizar_26" value="<?php echo $fila['realizar_26']; ?>">
                                    <input type="hidden" name="realizar_28" value="<?php echo $fila['realizar_28']; ?>">
                                    <input type="hidden" name="realizar_30" value="<?php echo $fila['realizar_30']; ?>">
                                    <input type="hidden" name="realizar_32" value="<?php echo $fila['realizar_32']; ?>">
                                    <input type="hidden" name="realizar_34" value="<?php echo $fila['realizar_34']; ?>">
                                    <input type="hidden" name="realizar_36" value="<?php echo $fila['realizar_36']; ?>">
                                    <input type="hidden" name="realizar_38" value="<?php echo $fila['realizar_38']; ?>">
                                    <input type="hidden" name="realizar_40" value="<?php echo $fila['realizar_40']; ?>">
                                    <input type="hidden" name="realizar_42" value="<?php echo $fila['realizar_42']; ?>">
                                    <input type="hidden" name="realizar_44" value="<?php echo $fila['realizar_44']; ?>">
                                    <input type="hidden" name="realizar_46" value="<?php echo $fila['realizar_46']; ?>">
                                    <input type="hidden" name="realizar_48" value="<?php echo $fila['realizar_48']; ?>">
                                    <button type="submit" name="submit_finalizar" class="btn btn-success">Continuar</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>  

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function () {
                document.getElementById('successAlert').style.display = 'none';
            }, 5000);
        </script>
        <script>
            document.querySelectorAll('input[type="number"]').forEach(input => {
                input.addEventListener('focus', function() {
                    if (this.value == 0) {
                        this.value = '';
                    }
                });
                input.addEventListener('blur', function() {
                    if (this.value == '') {
                        this.value = 0;
                    }
                });
            });
        </script>
    </body>
</html>