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

    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    if (isset($_POST['submit_editar'])) {

        $porcentaje_estampilla = 0;
        $valor_estampilla = 0;
        $valor_poliza = 0;

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }
        $id_usuario = obtenerValorPost('id_usuario');
        $id_producto = obtenerValorPost('id_producto');
        $id_entidad = obtenerValorPost('id_entidad');
        $cant_prendas = obtenerValorPost('cant_prendas');
        $mas_prendas = obtenerValorPost('mas_prendas');
        $cant_tallas = obtenerValorPost('cant_tallas');
        $id_tela = obtenerValorPost('id_tela');
        $precio_tela = obtenerValorPost('precio_tela');
        $promedio_consumo = obtenerValorPost('promedio_consumo');
        $id_telacombi = obtenerValorPost('id_telacombi');
        $precio_telacombinada = obtenerValorPost('precio_telacombinada');
        $promedio_telacombi = obtenerValorPost('promedio_telacombi');
        $id_telaforro = obtenerValorPost('id_telaforro');
        $precio_forro = obtenerValorPost('precio_forro');
        $promedio_forro = obtenerValorPost('promedio_forro');
        $id_cuello = obtenerValorPost('id_cuello');
        $precio_cuello = obtenerValorPost('precio_cuello');
        $consumo_cuello = obtenerValorPost('consumo_cuello');
        $id_puño = obtenerValorPost('id_puño');
        $precio_puño = obtenerValorPost('precio_puño');
        $consumo_puño = obtenerValorPost('consumo_puño');
        $id_boton = obtenerValorPost('id_boton');
        $precio_boton = obtenerValorPost('precio_boton');
        $cant_boton = obtenerValorPost('cant_boton');
        $id_boton2 = obtenerValorPost('id_boton2');
        $precio_boton2 = obtenerValorPost('precio_boton2');
        $cant_boton2 = obtenerValorPost('cant_boton2');
        $id_cinta = obtenerValorPost('id_cinta');
        $precio_cinta = obtenerValorPost('precio_cinta');
        $cant_cinta = obtenerValorPost('cant_cinta');
        $id_fusionado = obtenerValorPost('id_fusionado');
        $precio_fusionado = obtenerValorPost('precio_fusionado');
        $consumo_fusionado = obtenerValorPost('consumo_fusionado');
        $id_entretela = obtenerValorPost('id_entretela');
        $precio_entretela = obtenerValorPost('precio_entretela');
        $cant_entretela = obtenerValorPost('cant_entretela');
        $id_entretela2 = obtenerValorPost('id_entretela2');
        $precio_entretela2 = obtenerValorPost('precio_entretela2');
        $cant_entretela2 = obtenerValorPost('cant_entretela2');
        $id_cremallera = obtenerValorPost('id_cremallera');
        $precio_cremallera = obtenerValorPost('precio_cremallera');
        $cant_cremallera = obtenerValorPost('cant_cremallera');
        $id_cremallera2 = obtenerValorPost('id_cremallera2');
        $precio_cremallera2 = obtenerValorPost('precio_cremallera2');
        $cant_cremallera2 = obtenerValorPost('cant_cremallera2');
        $id_velcro = obtenerValorPost('id_velcro');
        $precio_velcro = obtenerValorPost('precio_velcro');
        $cant_velcro = obtenerValorPost('cant_velcro');
        $id_resorte = obtenerValorPost('id_resorte');
        $precio_resorte = obtenerValorPost('precio_resorte');
        $cant_resorte = obtenerValorPost('cant_resorte');
        $id_resorte2 = obtenerValorPost('id_resorte2');
        $precio_resorte2 = obtenerValorPost('precio_resorte2');
        $cant_resorte2 = obtenerValorPost('cant_resorte2');
        $id_hombrera = obtenerValorPost('id_hombrera');
        $precio_hombrera = obtenerValorPost('precio_hombrera');
        $cant_hombrera = obtenerValorPost('cant_hombrera');
        $id_sesgo = obtenerValorPost('id_sesgo');
        $precio_sesgo = obtenerValorPost('precio_sesgo');
        $cant_sesgo = obtenerValorPost('cant_sesgo');
        $id_trabilla = obtenerValorPost('id_trabilla');
        $precio_trabilla = obtenerValorPost('precio_trabilla');
        $cant_trabilla = obtenerValorPost('cant_trabilla');
        $id_vivo = obtenerValorPost('id_vivo');
        $precio_vivo = obtenerValorPost('precio_vivo');
        $cant_vivo = obtenerValorPost('cant_vivo');
        $id_faya = obtenerValorPost('id_faya');
        $precio_faya = obtenerValorPost('precio_faya');
        $cant_faya = obtenerValorPost('cant_faya');
        $id_guata = obtenerValorPost('id_guata');
        $precio_guata = obtenerValorPost('precio_guata');
        $cant_guata = obtenerValorPost('cant_guata');
        $id_pretina = obtenerValorPost('id_pretina');
        $precio_pretina = obtenerValorPost('precio_pretina');
        $cant_pretina = obtenerValorPost('cant_pretina');
        $id_broche = obtenerValorPost('id_broche');
        $precio_broche = obtenerValorPost('precio_broche');
        $cant_broche = obtenerValorPost('cant_broche');
        $id_cordon = obtenerValorPost('id_cordon');
        $precio_cordon = obtenerValorPost('precio_cordon');
        $cant_cordon = obtenerValorPost('cant_cordon');
        $id_puntera = obtenerValorPost('id_puntera');
        $cant_puntera = obtenerValorPost('cant_puntera');
        $precio_puntera = obtenerValorPost('precio_puntera');
        $id_hiladilla = obtenerValorPost('id_hiladilla');
        $precio_hiladilla = obtenerValorPost('precio_hiladilla');
        $cant_hiladilla = obtenerValorPost('cant_hiladilla');
        $id_plumilla = obtenerValorPost('id_plumilla');
        $cant_plumilla = obtenerValorPost('cant_plumilla');
        $precio_plumilla = obtenerValorPost('precio_plumilla');
        $id_vinilo = obtenerValorPost('id_vinilo');
        $cant_vinilo = obtenerValorPost('cant_vinilo');
        $precio_vinilo = obtenerValorPost('precio_vinilo');
        $precio_bordado = obtenerValorPost('precio_bordado');
        $precio_estampado = obtenerValorPost('precio_estampado');
        $valor_flete = obtenerValorPost('valor_flete');
        $id_entrega = obtenerValorPost('id_entrega');
        $precio_entrega = obtenerValorPost('precio_entrega');
        $id_bolsa = obtenerValorPost('id_bolsa');
        $precio_bolsa = obtenerValorPost('precio_bolsa');
        $id_marquilla = obtenerValorPost('id_marquilla');
        $precio_marquilla = obtenerValorPost('precio_marquilla');
        $id_acabado = obtenerValorPost('id_acabado');
        $precio_acabado = obtenerValorPost('precio_acabado');
        $id_encarterada = obtenerValorPost('id_encarterada');
        $precio_encarterada = obtenerValorPost('precio_encarterada');
        $id_diseño = obtenerValorPost('id_diseño');
        $precio_diseño = obtenerValorPost('precio_diseño');
        $id_mano_obra = obtenerValorPost('id_mano_obra');
        $precio_obra = obtenerValorPost('precio_obra');
        $id_corte = obtenerValorPost('id_corte');
        $precio_corte = obtenerValorPost('precio_corte');
        $precio_logistica = obtenerValorPost('precio_logistica');
        $margen_bruto = obtenerValorPost('margen_bruto');
        $valor_porcentajeestampilla = obtenerValorPost('valor_porcentajeestampilla');
        $observaciones_cotizacion = obtenerValorPost('observaciones_cotizacion');
        $observaciones_produccion = obtenerValorPost('observaciones_produccion', null);
        $observaciones_comercial = obtenerValorPost('observaciones_comercial', null);

        // Calcular valores
        $valor_tela = floatval($precio_tela) * floatval($promedio_consumo);
        $valor_telacombi = floatval($precio_telacombinada) * floatval($promedio_telacombi);
        $valor_forro = floatval($precio_forro) * floatval($promedio_forro);
        $valor_boton = floatval($precio_boton) * floatval($cant_boton);
        $valor_boton2 = floatval($precio_boton2) * floatval($cant_boton2);
        $valor_broche = floatval($precio_broche) * floatval($cant_broche);
        $valor_faya = floatval($precio_faya) * floatval($cant_faya);
        $valor_cinta = floatval($precio_cinta) * floatval($cant_cinta);
        $valor_cordon = floatval($precio_cordon) * floatval($cant_cordon);
        $valor_cremallera = floatval($precio_cremallera) * floatval($cant_cremallera);
        $valor_cremallera2 = floatval($precio_cremallera2) * floatval($cant_cremallera2);
        $valor_cuello = floatval($precio_cuello) * floatval($consumo_cuello);
        $valor_entretela = floatval($precio_entretela) * floatval($cant_entretela);
        $valor_entretela2 = floatval($precio_entretela2) * floatval($cant_entretela2);
        $valor_fusionado = floatval($precio_fusionado) * floatval($consumo_fusionado);
        $valor_guata = floatval($precio_guata) * floatval($cant_guata);
        $valor_hiladilla = floatval($precio_hiladilla) * floatval($cant_hiladilla);
        $valor_hombrera = floatval($precio_hombrera) * floatval($cant_hombrera);
        $valor_plumilla = floatval($precio_plumilla) * floatval($cant_plumilla);
        $valor_pretina = floatval($precio_pretina) * floatval($cant_pretina);
        $valor_puntera = floatval($precio_puntera) * floatval($cant_puntera);
        $valor_puño = floatval($precio_puño) * floatval($consumo_puño);
        $valor_resorte = floatval($precio_resorte) * floatval($cant_resorte);
        $valor_resorte2 = floatval($precio_resorte2) * floatval($cant_resorte2);
        $valor_sesgo = floatval($precio_sesgo) * floatval($cant_sesgo);
        $valor_trabilla = floatval($precio_trabilla) * floatval($cant_trabilla);
        $valor_velcro = floatval($precio_velcro) * floatval($cant_velcro);
        $valor_vinilo = floatval($precio_vinilo) * floatval($cant_vinilo);
        $valor_vivo = floatval($precio_vivo) * floatval($cant_vivo);


        $consumo_telas = $promedio_consumo + $promedio_telacombi + $promedio_forro;
        $suma_prendas = $cant_prendas + $mas_prendas;
        $valor_diseño = $precio_diseño / $cant_prendas;
        $valor_corte = $precio_corte;

        // Suma de todos las características
        $costo_total = 
        floatval($valor_tela) + floatval($valor_telacombi) + floatval($valor_forro) + floatval($precio_bolsa) + floatval($valor_boton) + floatval($valor_boton2) + floatval($valor_broche) +
        floatval($valor_faya) + floatval($valor_cinta) + floatval($valor_cordon) + floatval($valor_cremallera) + floatval($valor_cremallera2) + floatval($valor_cuello) + floatval($valor_entretela) + floatval($valor_entretela2) +
        floatval($valor_fusionado) + floatval($valor_guata) + floatval($valor_hiladilla) + floatval($valor_hombrera) + floatval($precio_marquilla) + floatval($valor_plumilla) + floatval($valor_pretina) + 
        floatval($valor_puntera) + floatval($valor_puño) + floatval($valor_resorte) + floatval($valor_resorte2) + floatval($valor_sesgo) + floatval($valor_trabilla) + floatval($valor_velcro) + floatval($valor_vinilo) + floatval($valor_vivo) + 
        floatval($precio_bordado) + floatval($precio_estampado) + floatval($valor_flete) + floatval($precio_entrega) + floatval($precio_acabado) + floatval($precio_encarterada) + floatval($valor_diseño) +
        floatval($precio_obra) + floatval($valor_corte) + floatval($precio_logistica); 

        if ($id_entidad == 1) {
            $precio_venta = $costo_total / $margen_bruto;
            $precio_iva = $precio_venta * 1.19;
            $precio_total = $suma_prendas * $precio_iva;
        } elseif ($id_entidad == 2) {
            $precio_venta = $costo_total / $margen_bruto;
            $valor_poliza = $precio_venta * 1.002;

            if ($valor_porcentajeestampilla == 0) {
                $precio_iva = $valor_poliza * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            } else {
                $porcentaje_estampilla = $valor_porcentajeestampilla / 100;
                $valor_estampilla = $valor_poliza / (1 - $porcentaje_estampilla);
                $precio_iva = $valor_estampilla * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            }
        }

        // Realizar la consulta de inserción
        $consulta = "UPDATE producto SET cant_prendas = '$cant_prendas', mas_prendas = '$mas_prendas', suma_prendas = '$suma_prendas', cant_tallas = '$cant_tallas', id_tela = '$id_tela', precio_tela = '$precio_tela', promedio_consumo = '$promedio_consumo', valor_tela = '$valor_tela',  id_telacombi = '$id_telacombi', precio_telacombinada = '$precio_telacombinada', promedio_telacombi = '$promedio_telacombi',  valor_telacombi = '$valor_telacombi',  id_telaforro = '$id_telaforro', promedio_forro = '$promedio_forro',  precio_forro = '$precio_forro',valor_forro = '$valor_forro', 
                                consumo_telas = '$consumo_telas', id_cuello = '$id_cuello', precio_cuello = '$precio_cuello', consumo_cuello = '$consumo_cuello', valor_cuello = '$valor_cuello', id_puño = '$id_puño', precio_puño = '$precio_puño', consumo_puño = '$consumo_puño', valor_puño = '$valor_puño', id_boton = '$id_boton', precio_boton = '$precio_boton', cant_boton = '$cant_boton', valor_boton = '$valor_boton', id_boton2 = '$id_boton2', precio_boton2 = '$precio_boton2', cant_boton2 = '$cant_boton2', valor_boton2 = '$valor_boton2', id_cinta = '$id_cinta', precio_cinta = '$precio_cinta', cant_cinta = '$cant_cinta', valor_cinta = '$valor_cinta', id_marquilla = '$id_marquilla', id_bolsa = '$id_bolsa',  
                                id_cremallera = '$id_cremallera', precio_cremallera = '$precio_cremallera', cant_cremallera = '$cant_cremallera', valor_cremallera = '$valor_cremallera', id_cremallera2 = '$id_cremallera2', precio_cremallera2 = '$precio_cremallera2', cant_cremallera2 = '$cant_cremallera2', valor_cremallera2 = '$valor_cremallera2', id_entretela = '$id_entretela', precio_entretela = '$precio_entretela', cant_entretela = '$cant_entretela', valor_entretela = '$valor_entretela', id_entretela2 = '$id_entretela2', precio_entretela2 = '$precio_entretela2', cant_entretela2 = '$cant_entretela2', valor_entretela2 = '$valor_entretela2', id_fusionado = '$id_fusionado', precio_fusionado = '$precio_fusionado', consumo_fusionado = '$consumo_fusionado', valor_fusionado = '$valor_fusionado', id_acabado = '$id_acabado', 
                                id_velcro = '$id_velcro', precio_velcro = '$precio_velcro', cant_velcro = '$cant_velcro', valor_velcro = '$valor_velcro', id_resorte = '$id_resorte', precio_resorte = '$precio_resorte', cant_resorte = '$cant_resorte', valor_resorte = '$valor_resorte', id_resorte2 = '$id_resorte2', precio_resorte2 = '$precio_resorte2', cant_resorte2 = '$cant_resorte2', valor_resorte2 = '$valor_resorte2', id_hombrera = '$id_hombrera', precio_hombrera = '$precio_hombrera', cant_hombrera = '$cant_hombrera', valor_hombrera = '$valor_hombrera', id_sesgo = '$id_sesgo', precio_sesgo = '$precio_sesgo', cant_sesgo = '$cant_sesgo', valor_sesgo = '$valor_sesgo', id_trabilla = '$id_trabilla', 
                                precio_trabilla = '$precio_trabilla', cant_trabilla = '$cant_trabilla', valor_trabilla = '$valor_trabilla', id_vivo = '$id_vivo', precio_vivo = '$precio_vivo', cant_vivo = '$cant_vivo', valor_vivo = '$valor_vivo', id_faya = '$id_faya', precio_faya = '$precio_faya', cant_faya = '$cant_faya', valor_faya = '$valor_faya', id_guata = '$id_guata', precio_guata = '$precio_guata', cant_guata = '$cant_guata', valor_guata = '$valor_guata', id_pretina = '$id_pretina', precio_pretina = '$precio_pretina', cant_pretina = '$cant_pretina', valor_pretina = '$valor_pretina', id_broche = '$id_broche', precio_broche = '$precio_broche', cant_broche = '$cant_broche',
                                id_entrega = '$id_entrega', precio_entrega = '$precio_entrega', valor_broche = '$valor_broche', id_cordon = '$id_cordon', precio_cordon = '$precio_cordon', cant_cordon = '$cant_cordon', valor_cordon = '$valor_cordon', id_puntera = '$id_puntera', precio_puntera = '$precio_puntera', cant_puntera = '$cant_puntera', valor_puntera = '$valor_puntera', id_hiladilla = '$id_hiladilla', precio_hiladilla = '$precio_hiladilla', cant_hiladilla = '$cant_hiladilla', valor_hiladilla = '$valor_hiladilla', id_plumilla = '$id_plumilla', precio_plumilla = '$precio_plumilla', cant_plumilla = '$cant_plumilla', valor_plumilla = '$valor_plumilla', id_vinilo = '$id_vinilo', precio_vinilo = '$precio_vinilo', cant_vinilo = '$cant_vinilo', valor_vinilo = '$valor_vinilo', precio_bordado = '$precio_bordado', precio_estampado = '$precio_estampado', id_mano_obra = '$id_mano_obra', 
                                precio_obra = '$precio_obra', id_logistica = '1', precio_logistica = '$precio_logistica', id_diseño = '$id_diseño', valor_diseño = '$valor_diseño', id_corte = '$id_corte', id_consumo = '1', valor_corte = '$valor_corte', valor_flete = '$valor_flete', costo_total = '$costo_total', id_encarterada = '$id_encarterada', precio_encarterada = '$precio_encarterada', margen_bruto = '$margen_bruto', precio_venta = '$precio_venta', valor_poliza = '$valor_poliza', valor_porcentajeestampilla = '$valor_porcentajeestampilla', porcentaje_estampilla = '$porcentaje_estampilla', valor_estampilla = '$valor_estampilla', precio_iva = '$precio_iva', precio_total = '$precio_total', observaciones_cotizacion = '$observaciones_cotizacion', observaciones_produccion = '$observaciones_produccion', observaciones_comercial = '$observaciones_comercial'
                                WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido_para_enviar.php?id_pedido=$id_pedido&id_entrega=$id_entrega&id_usuario=$id_usuario&recibido=1");
        exit();
    }

    if (isset($_POST['editar_externo'])) {

        $id_usuario = $_POST['id_usuario'];
        $id_prenda = 0;
        $porcentaje_estampilla = 0;
        $valor_estampilla = 0;
        $valor_poliza = 0;
        $valor_porcentajeestampilla = 0;

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $precio_compra = obtenerValorPost('precio_compra');
        $precio_bordado = obtenerValorPost('precio_bordado');
        $precio_estampado = obtenerValorPost('precio_estampado');
        $valor_flete = obtenerValorPost('valor_flete');
        $margen_bruto = obtenerValorPost('margen_bruto');
        $valor_porcentajeestampilla = obtenerValorPost('valor_porcentajeestampilla');
        $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : 0;
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : 0;
        $mas_prendas = isset($_POST['mas_prendas']) ? $_POST['mas_prendas'] : 0;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : 0;
        $nombre_producto = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : '';
        $nombre_proveedor = isset($_POST['nombre_proveedor']) ? $_POST['nombre_proveedor'] : '';
        $id_entidad = isset($_POST['id_entidad']) ? $_POST['id_entidad'] : 0;
        $observaciones_cotizacion = obtenerValorPost('observaciones_cotizacion');
        $observaciones_produccion = obtenerValorPost('observaciones_produccion', null);
        $observaciones_comercial = obtenerValorPost('observaciones_comercial', null);

        $suma_prendas = $cant_prendas + $mas_prendas;
        $costo_total = $precio_compra + $precio_bordado + $precio_estampado + $valor_flete;

        if ($id_entidad == 1) {
            $precio_venta = $costo_total / $margen_bruto;
            $precio_iva = $precio_venta * 1.19;
            $precio_total = $suma_prendas * $precio_iva;
        } elseif ($id_entidad == 2) {
            $precio_venta = $costo_total / $margen_bruto;
            $valor_poliza = $precio_venta * 1.002;

            if ($valor_porcentajeestampilla == 0) {
                $precio_iva = $valor_poliza * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            } else {
                $porcentaje_estampilla = $valor_porcentajeestampilla / 100;
                $valor_estampilla = $valor_poliza / (1 - $porcentaje_estampilla);
                $precio_iva = $valor_estampilla * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            }
        }

        // Preparar la consulta SQL de actualización
        $consulta = "UPDATE producto SET id_prenda = '$id_prenda', cant_prendas = '$cant_prendas', mas_prendas = '$mas_prendas', suma_prendas = '$suma_prendas', cant_tallas = '$cant_tallas', nombre_producto = '$nombre_producto', nombre_proveedor = '$nombre_proveedor', precio_compra = '$precio_compra', observaciones_cotizacion = '$observaciones_cotizacion', precio_bordado = $precio_bordado, precio_estampado = $precio_estampado, valor_flete = $valor_flete, 
                                costo_total = '$costo_total', margen_bruto = '$margen_bruto', precio_venta = '$precio_venta', valor_poliza = '$valor_poliza', valor_porcentajeestampilla = '$valor_porcentajeestampilla', porcentaje_estampilla = '$porcentaje_estampilla', valor_estampilla = '$valor_estampilla', precio_iva = '$precio_iva', precio_total = '$precio_total', observaciones_produccion = '$observaciones_produccion', observaciones_comercial = '$observaciones_comercial'
                                WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido_para_enviar.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=1");
        exit();
    }

    if (isset($_POST['cambiar_estado2'])) {
        $consulta = "UPDATE pedido SET estado = 'Activo' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido_confirmado.php?id_pedido=$id_pedido&nit=$nit");
        exit();
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM producto WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido_para_enviar.php?id_pedido=$id_pedido&id_entrega=$id_entrega&recibido=1");
        exit();
    }
?>

<!DOCTYPE html>
<html>
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
        <link rel="stylesheet" href="../../css/estilo_base.css">
        <link rel="icon" type="image/png" href="../../img/Logo.png">
        <style>
            .img-modal-preview {
                max-width: 100%;
                max-height: 420px;
                /* 👈 tamaño mediano fijo */
                object-fit: contain;
                border-radius: 12px;
            }

            .img-hover {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .img-hover:hover {
                transform: scale(1.05);
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            }
        </style>
        <style>
            .form-control {
            border-color: #ccc;
            background-color: #f8f8f8;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            color: #333;
            border-radius: 10px;
            }

            .form-select {
                border-radius: 10px;
            }
        </style>
        
        <title>Costeo | En espera por Confirmar</title>
    <head>

    <body>
        <?php
        $consulta = "SELECT pedido.estado, pedido.id_usuario, pedido.consecutivo, producto.color_tela, producto.color_tela, producto.color_telacombi, producto.color_telaforro, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, 
                                producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.mas_prendas, producto.suma_prendas, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.precio_cuello, producto.consumo_cuello, producto.precio_puño, producto.consumo_puño, producto.precio_boton, producto.cant_boton, 
                                producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, 
                                producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, producto.id_deslizador, producto.precio_deslizador, producto.cant_deslizador, producto.valor_deslizador,
                                producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, 
                                producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_flete, producto.precio_obra, producto.costo_total, producto.telaa, producto.telacombinada, producto.telaforro, producto.cant_entretela2, producto.precio_entretela2, producto.valor_entretela2, producto.cant_hiladilla, producto.precio_hiladilla, producto.valor_hiladilla, producto.cant_fajon_cintura, producto.precio_fajon_cintura, producto.valor_fajon_cintura,
                                producto.mangas, producto.cuello, producto.puño, producto.pretina, producto.fajon, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.valor_agregado, producto.logo, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, cartera.id_cartera, cartera.tipo_cartera, tablon.id_tablon, tablon.tipo_tablon,
                                pedido.id_pedido, pedido.total_factura, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
                                producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_pretina, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_total, cliente.cliente, 
                                producto.id_logistica, logistica.id_logistica, logistica.precio, producto.precio_logistica, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.valor_diseño, producto.valor_corte, corte.precio_corte, producto.observaciones_cotizacion, producto.observaciones_produccion, producto.observaciones_comercial, deslizador.id_deslizador, deslizador.insumo AS insumo_deslizador, producto.precio_deslizador,
                                tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, 
                                boton2.id_boton2, boton2.insumo AS insumo_boton2, producto.precio_boton2, producto.cant_boton2, producto.valor_boton2, plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla, producto.precio_plumilla, producto.cant_plumilla, producto.valor_plumilla, vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo, producto.precio_vinilo, producto.cant_vinilo, producto.valor_vinilo,
                                cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, acabado.id_acabado, acabado.insumo AS insumo_acabado, acabado.precio AS precio_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, 
                                entretela.id_entretela, entretela.insumo AS insumo_entretela, entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, 
                                sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, hiladilla.id_hiladilla, hiladilla.insumo AS insumo_hiladilla, fajon_cintura.id_fajon_cintura, fajon_cintura.insumo AS insumo_fajon_cintura,
                                broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, producto.cant_bolsillos, producto.precio_bolsillo, bolsillo_combinado.id_bolsillocombinado, bolsillo_combinado.tipo_bolsillocombinado, producto.cant_bolsilloscombinado, producto.precio_bolsillocombinado, bolsillo_combinado2.id_bolsillocombinado2, bolsillo_combinado2.tipo_bolsillocombinado2, producto.cant_bolsilloscombinado2, producto.precio_bolsillocombinado2,
                                cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, producto.precio_cremallera2, producto.cant_cremallera2, producto.valor_cremallera2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, producto.precio_resorte2, producto.cant_resorte2, producto.valor_resorte2,
                                mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, entrega.precio_entrega AS entrega_precio_entrega, producto.precio_entrega AS producto_precio_entrega, producto.id_tipo_producto, entidad.id_entidad, entidad.tipo_entidad, cliente.nit, cliente.id_entidad, pedido.nit, producto.margen_bruto, producto.valor_porcentajeestampilla, encarterada.id_encarterada, encarterada.tipo_encarterada, producto.precio_encarterada, puesta_cinta.id_puesta, puesta_cinta.tipo_puesta, producto.precio_puesta,
                                tela.ancho AS ancho_tela, tela.peso AS peso_tela, tela.caracteristicas, tela.rendimiento, tela.encogimiento, entrega.precio_entrega, producto.id_prendacomprada, prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto, 
                                tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.ancho AS ancho_telacombi, tela_combinada.peso AS peso_telacombi, tela_combinada.caracteristicas AS caract_telacombi, tela_combinada.rendimiento AS rend_telacombi, tela_combinada.encogimiento AS encog_telacombi,
                                tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.ancho AS ancho_forro, tela_forro.peso AS peso_forro, tela_forro.caracteristicas AS caract_forro, tela_forro.rendimiento AS rend_forro, tela_forro.encogimiento AS encog_forro
                                FROM producto
                                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN deslizador ON producto.id_deslizador = deslizador.id_deslizador
                                LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                                LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN encarterada ON producto.id_encarterada = encarterada.id_encarterada LEFT JOIN puesta_cinta ON producto.id_puesta = puesta_cinta.id_puesta
                                LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela  LEFT JOIN entretela2 ON producto.id_entretela2 = entretela2.id_entretela2 LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro  LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte  LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera  LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo  
                                LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla  LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo  LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya  LEFT JOIN guata ON producto.id_guata = guata.id_guata  LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina  LEFT JOIN broche ON producto.id_broche = broche.id_broche  LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon  
                                LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo LEFT JOIN bolsillo_combinado ON producto.id_bolsillocombinado  = bolsillo_combinado.id_bolsillocombinado LEFT JOIN bolsillo_combinado2 ON producto.id_bolsillocombinado2  = bolsillo_combinado2.id_bolsillocombinado2 LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra  LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño  LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN hiladilla ON producto.id_hiladilla = hiladilla.id_hiladilla 
                                LEFT JOIN fajon_cintura ON producto.id_fajon_cintura = fajon_cintura.id_fajon_cintura LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN logistica ON producto.id_logistica = logistica.id_logistica LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
                                LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada
                                WHERE pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

        <?php
        // Almacenar la primera fila en una variable
        $fila_estado = mysqli_fetch_assoc($resultado);
        ?>

        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="../../img/Logo.png" alt="Logo" width="70" height="50" class="rounded img-fluid d-inline-block align-text-top">
                </a>
                <a href="pedido_confirmado.php" class="btn active btn-primary">
                    <i class="bi bi-arrow-bar-left"></i> Volver
                </a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Lista de Prendas</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <div class="text-center">
            <button id="downloadExcel" class="btn btn-warning">1. Descarga la Cotizacion <i class="bi bi-filetype-xlsx"></i></button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cambiarEstado2<?php echo $fila_estado['id_pedido']; ?>">2. Pasar cargar Documentos <i class="bi bi-upload"></i></button>
        </div>
        <br>

        <!-- Reiniciar el puntero de resultados -->
        <?php mysqli_data_seek($resultado, 0); ?>

        <!-- Productos -->
        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                    <?php if ($fila['id_tipo_producto'] != 8): ?>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="modal-content rounded-4 modal-fullscreen">
                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?></h5>
                                </div>

                                <div class="card-body">
                                    <?php
                                    // Array de imágenes
                                    $imagenes = [
                                        1 => $fila['imagen'] ?? null,
                                        2 => $fila['imagen2'] ?? null,
                                        3 => $fila['imagen3'] ?? null,
                                        4 => $fila['imagen4'] ?? null
                                    ];
                                    
                                    // Filtrar imágenes existentes
                                    $imagenesDisponibles = array_filter($imagenes);
                                    ?>
                                    
                                    <?php if (!empty($imagenesDisponibles)): ?>
                                        <div class="d-flex justify-content-center flex-wrap gap-2">
                                            <?php foreach ($imagenesDisponibles as $num => $img): ?>
                                                <?php
                                                $ruta = "../../img/pedidos/$img";
                                                $version = file_exists($ruta) ? filemtime($ruta) : time();
                                                $idModal = "modalImagenProducto{$num}_" . md5($img);
                                                ?>
                                        
                                                <div class="text-center">
                                                    <img src="<?= $ruta ?>?v=<?= $version ?>" class="img-thumbnail shadow-sm img-hover" style="width:110px;height:110px;object-fit:cover;cursor:pointer" data-bs-toggle="modal" data-bs-target="#<?= $idModal ?>">
                                                </div>
                                        
                                                <!-- Modal de imagen -->
                                                <div class="modal fade" id="<?= $idModal ?>" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                                        <div class="modal-content shadow-lg rounded-4 border-0">
                                                            <div class="modal-header py-2 border-0">
                                                                <span class="fw-semibold text-muted small">Vista previa</span>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body d-flex justify-content-center align-items-center p-3">
                                                                <img src="<?= $ruta ?>?v=<?= $version ?>" class="img-modal-preview">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <br>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>

                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div>
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['logo'])): ?>
                                        <div>
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion y Descripcion del Logo:</span> <?= $fila['logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_bolsillo'])): ?>
                                        <div>
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                <?= $fila['tipo_bolsillo'] ?>

                                                <?php if ($fila['id_bolsillo'] != 0): ?>
                                                    Cantidad <?= $fila['cant_bolsillos'] ?>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Costo de Producción:</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Precio de Venta:</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <?php if (!empty($fila['observaciones_produccion'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Produccion</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_produccion'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['observaciones_comercial'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Comercial</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_comercial'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-prenda="<?php echo $fila['id_prenda']; ?>"
                                                data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                                data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>"
                                                data-id-entidad="<?php echo $fila['id_entidad']; ?>"
                                                data-id-usuario="<?php echo $fila['id_usuario']; ?>"
                                                data-id-entrega="<?php echo $fila['id_entrega']; ?>">
                                                <i class="bi bi-pencil-square"></i> Editar Datos a la Cotizacion
                                            </button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-info-circle-fill"></i> Informacion de la Cotizacion
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Eliminar<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-trash-fill"></i> Eliminar la Prenda
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($fila['id_tipo_producto'] == 8): ?>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="modal-content rounded-4 modal-fullscreen">
                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?></h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Array de imágenes
                                    $imagenes = [
                                        1 => $fila['imagen'] ?? null,
                                        2 => $fila['imagen2'] ?? null,
                                        3 => $fila['imagen3'] ?? null,
                                        4 => $fila['imagen4'] ?? null
                                    ];
                                    
                                    // Filtrar imágenes existentes
                                    $imagenesDisponibles = array_filter($imagenes);
                                    ?>
                                    
                                    <?php if (!empty($imagenesDisponibles)): ?>
                                        <div class="d-flex justify-content-center flex-wrap gap-2">
                                            <?php foreach ($imagenesDisponibles as $num => $img): ?>
                                                <?php
                                                $ruta = "../../img/pedidos/$img";
                                                $version = file_exists($ruta) ? filemtime($ruta) : time();
                                                $idModal = "modalImagenProducto{$num}_" . md5($img);
                                                ?>
                                        
                                                <div class="text-center">
                                                    <img src="<?= $ruta ?>?v=<?= $version ?>" class="img-thumbnail shadow-sm img-hover" style="width:110px;height:110px;object-fit:cover;cursor:pointer" data-bs-toggle="modal" data-bs-target="#<?= $idModal ?>">
                                                </div>
                                        
                                                <!-- Modal de imagen -->
                                                <div class="modal fade" id="<?= $idModal ?>" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                                        <div class="modal-content shadow-lg rounded-4 border-0">
                                                            <div class="modal-header py-2 border-0">
                                                                <span class="fw-semibold text-muted small">Vista previa</span>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body d-flex justify-content-center align-items-center p-3">
                                                                <img src="<?= $ruta ?>?v=<?= $version ?>" class="img-modal-preview">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <br>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor del Producto:</span> <?= $fila['nombre_proveedor'] ?></p>
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div>
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['logo'])): ?>
                                        <div>
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion y Descripcion del Logo:</span> <?= $fila['logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Precio de Compra:</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Precio de Venta:</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </p>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <?php if (!empty($fila['observaciones_produccion'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Produccion</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_produccion'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['observaciones_comercial'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Comercial</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_comercial'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-prenda="<?php echo $fila['id_prenda']; ?>"
                                                data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                                data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>"
                                                data-id-usuario="<?php echo $fila['id_usuario']; ?>"
                                                data-id-entidad="<?php echo $fila['id_entidad']; ?>">
                                                <i class="bi bi-pencil-square"></i> Editar Datos a la Cotizacion
                                            </button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-info-circle-fill"></i> Informacion de la Cotizacion
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Eliminar<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-trash-fill"></i> Eliminar la Prenda
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php
                    $contador_producto++; // Incrementar contador de productos
                } ?>
            </div>
        </div>

        <!-- Modales eliminar y editar-->
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
            include('modales_crear_productos.php');
        ?>

            <!-- Cambiar estado 2 -->
            <div class="modal fade" id="cambiarEstado2<?php echo $fila_estado['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                En caso de que el pedido haya sido Aceptado por el cliente presione continuar, con esto el pedido pasara a ser visualizado por el usuario Comercial para cargar la Orden de compra y Listado de empleados.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_pedido" value="<?php echo $fila_estado['id_pedido']; ?>">
                                <button type="submit" name="cambiar_estado2" class="btn btn-success">continuar</button>
                            </form>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modales Informacion -->
            <div class="modal fade" id="Info<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <?php if ($fila['id_tipo_producto'] != 8): ?>
                            <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                <h5 class="modal-title text-white fw-bold text-center w-100" id="exampleModalLabel">Información producto:<br><?= $fila['nombre_prenda'] ?></h5>
                                <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="contenidoPDF<?= $fila['id_producto']; ?>">
                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                        <!-- Datos de la solicitud -->
                                        <div class="card-text-container">
                                            <?php
                                                // Array de imágenes
                                                $imagenes = [
                                                    $fila['imagen'],
                                                    $fila['imagen2'],
                                                    $fila['imagen3'],
                                                    $fila['imagen4'],
                                                ];

                                                // Filtrar imágenes no vacías
                                                $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                                            ?>

                                            <?php if (!empty($imagenesValidas)): ?>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                                        <div class="d-flex justify-content-center mb-2">
                                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                                    <img src="../../img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div>
                                                <?php
                                                // Array de logos
                                                $logos = [
                                                    $fila['logo1'],
                                                    $fila['logo2'],
                                                    $fila['logo3'],
                                                    $fila['logo4']
                                                ];

                                                // Definimos la función si no existe
                                                if (!function_exists('displayFile')) {
                                                    function displayFile($file)
                                                    {
                                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                        $fileName = basename($file);
                                                        $filePath = '../../logos_empresas/' . $file;

                                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                                        } else {
                                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                                        </a>';
                                                        }
                                                    }
                                                }
                                                ?>

                                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                                ?>
                                                    <div class="mb-1 text-center border rounded p-1">
                                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                                            <?php foreach ($logos as $logo): ?>
                                                                <?php if (!empty($logo)): ?>
                                                                    <div class="text-center p-1">
                                                                        <?php displayFile($logo); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!---->

                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <div class="mb-2 row">
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (!empty($fila['id_tela'])): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Tela</h6>
                                                <div>                                             
                                                    <p class="card-text"  style="color: black"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['tela'] ?>
                                                        <?= !empty($fila['ancho_tela']) ? " Ancho " . $fila['ancho_tela'] : "" ?>
                                                        <?= !empty($fila['peso_tela']) ? " Peso " . $fila['peso_tela'] : "" ?>
                                                        <?= !empty($fila['caracteristicas']) ? "," . $fila['caracteristicas'] : "" ?>
                                                        <?= !empty($fila['rendimiento']) ? " Rendimiento " . $fila['rendimiento'] : "" ?>
                                                        <?= !empty($fila['encogimiento']) ? " Encogimiento " . $fila['encogimiento'] : "" ?>
                                                        <?= !empty($fila['color_tela']) ? " Color " . $fila['color_tela'] : "" ?>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo:</span> <?= htmlspecialchars($fila['promedio_consumo']) ?> Mts</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio unitario:</span> $<?= htmlspecialchars($fila['precio_tela']) ?></p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Total Tela:</span> <?= htmlspecialchars($fila['valor_tela']) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($fila['id_telacombi'])): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Tela Combinada</h6>
                                                <div>                                             
                                                    <p class="card-text"  style="color: black"><span class="font-weight-bold">Tipo de Tela Combinada:</span> <?= $fila['tela_combi'] ?>
                                                        <?= !empty($fila['ancho_telacombi']) ? " Ancho " . $fila['ancho_telacombi'] : "" ?>
                                                        <?= !empty($fila['peso_telacombi']) ? " Peso " . $fila['peso_telacombi'] : "" ?>
                                                        <?= !empty($fila['caract_telacombi']) ? "," . $fila['caract_telacombi'] : "" ?>
                                                        <?= !empty($fila['rend_telacombi']) ? " Rendimiento " . $fila['rend_telacombi'] : "" ?>
                                                        <?= !empty($fila['encog_telacombi']) ? " Encogimiento " . $fila['encog_telacombi'] : "" ?>
                                                        <?= !empty($fila['color_telacombi']) ? " Color " . $fila['color_telacombi'] : "" ?>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo:</span> <?= htmlspecialchars($fila['promedio_telacombi']) ?> Mts</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio unitario:</span> $<?= htmlspecialchars($fila['precio_telacombinada']) ?></p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Tela:</span> <?= htmlspecialchars($fila['valor_telacombi']) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($fila['id_telaforro'])): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Tela Forro</h6>
                                                <div>                                             
                                                    <p class="card-text"  style="color: black"><span class="font-weight-bold">Tipo de Tela Forro:</span> <?= $fila['tela_forro'] ?>
                                                        <?= !empty($fila['ancho_forro']) ? " Ancho " . $fila['ancho_forro'] : "" ?>
                                                        <?= !empty($fila['peso_forro']) ? " Peso " . $fila['peso_forro'] : "" ?>
                                                        <?= !empty($fila['caract_forro']) ? "," . $fila['caract_forro'] : "" ?>
                                                        <?= !empty($fila['rend_forro']) ? " Rendimiento " . $fila['rend_forro'] : "" ?>
                                                        <?= !empty($fila['encog_forro']) ? " Encogimiento " . $fila['encog_forro'] : "" ?>
                                                        <?= !empty($fila['color_telaforro']) ? " Color " . $fila['color_telaforro'] : "" ?>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo:</span> <?= htmlspecialchars($fila['promedio_forro']) ?> Mts</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio unitario:</span> $<?= htmlspecialchars($fila['precio_forro']) ?></p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Tela:</span> <?= htmlspecialchars($fila['valor_forro']) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php
                                        $secciones = [
                                            ['id' => 'entretela', 'titulo' => 'Datos de la Entrela', 'insumo' => 'insumo_entretela', 'consumo' => 'cant_entretela', 'precio' => 'precio_entretela', 'valor' => 'valor_entretela'],
                                            ['id' => 'entretela2', 'titulo' => 'Datos de la Entrela 2', 'insumo' => 'insumo_entretela2', 'consumo' => 'cant_entretela2', 'precio' => 'precio_entretela2', 'valor' => 'valor_entretela2'],
                                            ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'precio' => 'precio_cuello', 'valor' => 'valor_cuello'],
                                            ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'precio' => 'precio_puño', 'valor' => 'valor_puño'],
                                            ['id' => 'boton', 'titulo' => 'Datos del Botón Principal', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'valor' => 'valor_boton'],
                                            ['id' => 'boton2', 'titulo' => 'Datos del Botón Secundario', 'insumo' => 'insumo_boton2', 'consumo' => 'cant_boton2', 'precio' => 'precio_boton2', 'valor' => 'valor_boton2'],
                                            ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'precio' => 'precio_pretina', 'valor' => 'valor_pretina'],
                                            ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera 1', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'valor' => 'valor_cremallera'],
                                            ['id' => 'cremallera2', 'titulo' => 'Datos de la Cremallera 2', 'insumo' => 'insumo_cremallera2', 'consumo' => 'cant_cremallera2', 'precio' => 'precio_cremallera2', 'valor' => 'valor_cremallera2'],
                                            ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'precio' => 'precio_broche', 'valor' => 'valor_broche'],
                                            ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'valor' => 'valor_cinta'],
                                            ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'valor' => 'valor_faya'],
                                            ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'precio' => 'precio_cordon', 'valor' => 'valor_cordon'],
                                            ['id' => 'deslizador', 'titulo' => 'Datos del Deslizador', 'insumo' => 'insumo_deslizador', 'consumo' => 'cant_deslizador', 'precio' => 'precio_deslizador', 'valor' => 'valor_deslizador'],
                                            ['id' => 'fajon_cintura', 'titulo' => 'Datos del Fajón de Cintura', 'insumo' => 'insumo_fajon_cintura', 'consumo' => 'cant_fajon_cintura', 'precio' => 'precio_fajon_cintura', 'valor' => 'valor_fajon_cintura'],
                                            ['id' => 'fusionado', 'titulo' => 'Datos del Fusionado', 'insumo' => 'insumo_fusionado', 'consumo' => 'consumo_fusionado', 'precio' => 'precio_fusionado', 'valor' => 'valor_fusionado'],
                                            ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'precio' => 'precio_guata', 'valor' => 'valor_guata'],
                                            ['id' => 'hiladilla', 'titulo' => 'Datos de la Hiladilla', 'insumo' => 'insumo_hiladilla', 'consumo' => 'cant_hiladilla', 'precio' => 'precio_hiladilla', 'valor' => 'valor_hiladilla'],
                                            ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'precio' => 'precio_hombrera', 'valor' => 'valor_hombrera'],
                                            ['id' => 'plumilla', 'titulo' => 'Datos de la Plumilla', 'insumo' => 'insumo_plumilla', 'consumo' => 'cant_plumilla', 'precio' => 'precio_plumilla', 'valor' => 'valor_plumilla'],
                                            ['id' => 'puntera', 'titulo' => 'Datos de la Puntera', 'insumo' => 'insumo_puntera', 'consumo' => 'cant_puntera', 'precio' => 'precio_puntera', 'valor' => 'valor_puntera'],
                                            ['id' => 'resorte', 'titulo' => 'Datos del Resorte 1', 'insumo' => 'insumo_resorte2', 'consumo' => 'cant_resorte2', 'precio' => 'precio_resorte2', 'valor' => 'valor_resorte2'],
                                            ['id' => 'resorte2', 'titulo' => 'Datos del Resorte 2', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'precio' => 'precio_resorte', 'valor' => 'valor_resorte'],
                                            ['id' => 'sesgo', 'titulo' => 'Datos del Sesgo', 'insumo' => 'insumo_sesgo', 'consumo' => 'cant_sesgo', 'precio' => 'precio_sesgo', 'valor' => 'valor_sesgo'],
                                            ['id' => 'trabilla', 'titulo' => 'Datos de la Trabilla', 'insumo' => 'insumo_trabilla', 'consumo' => 'cant_trabilla', 'precio' => 'precio_trabilla', 'valor' => 'valor_trabilla'],
                                            ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'precio' => 'precio_velcro', 'valor' => 'valor_velcro'],
                                            ['id' => 'vinilo', 'titulo' => 'Datos del Vinilo', 'insumo' => 'insumo_vinilo', 'consumo' => 'cant_vinilo', 'precio' => 'precio_vinilo', 'valor' => 'valor_vinilo'],
                                            ['id' => 'vivo', 'titulo' => 'Datos del Vivo', 'insumo' => 'insumo_vivo', 'consumo' => 'cant_vivo', 'precio' => 'precio_vivo', 'valor' => 'valor_vivo'],
                                        ];

                                        foreach ($secciones as $seccion):
                                            if ($fila["id_{$seccion['id']}"] > 0): ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                    <p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Insumo:</span> <?= $fila[$seccion['insumo']] ?></p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo o Cantidad:</span> <?= $fila[$seccion['consumo']] ?></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Unitario:</span> $<?= $fila[$seccion['precio']] ?></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila[$seccion['valor']] ?></p>
                                                    </div>
                                                </div>
                                        <?php endif;
                                        endforeach;
                                        ?>

                                        <?php if (!empty($fila['producto'])): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                                <div>
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p>
                                                </div>
                                                <div>
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_obra'] ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                            <div class="row">
                                                <?php
                                                $tieneBordado = !empty($fila['precio_bordado']);
                                                $tieneEstampado = !empty($fila['precio_estampado']);

                                                $claseCol = ($tieneBordado && $tieneEstampado) ? 'col-md-6' : 'col-md-12 text-center';
                                                ?>

                                                <?php if ($tieneBordado): ?>
                                                    <div class="<?= $claseCol ?>">
                                                        <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio Bordado:</span> $<?= $fila['precio_bordado'] ?></p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($tieneEstampado): ?>
                                                    <div class="<?= $claseCol ?>">
                                                        <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio Estampado:</span> $<?= $fila['precio_estampado'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php
                                                $tieneFlete = !empty($fila['valor_flete']);
                                                $tieneLogistica = !empty($fila['precio_logistica']);

                                                $claseCol = ($tieneFlete && $tieneLogistica) ? 'col-md-6' : 'col-md-12 text-center';
                                                ?>

                                                <?php if ($tieneFlete): ?>
                                                    <div class="<?= $claseCol ?>">
                                                        <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio del Flete:</span> $<?= $fila['valor_flete'] ?></p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($tieneLogistica): ?>
                                                    <div class="<?= $claseCol ?>">
                                                        <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio Logística:</span> $<?= $fila['precio_logistica'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['tipo_entrega'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de Entrega:</span> $<?= $fila['precio_entrega'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de la Bolsa:</span> $<?= $fila['precio_bolsa'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de Marquilla:</span> $<?= $fila['precio_marquilla'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_acabado'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Acabado:</span> <?= $fila['insumo_acabado'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio del Acabado:</span> $<?= $fila['precio_acabado'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_encarterada'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Encarterada:</span> <?= $fila['tipo_encarterada'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de Encarterada:</span> $<?= $fila['precio_encarterada'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_diseño'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Diseño:</span> <?= $fila['opcion_diseño'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Diseño:</span> $<?= $fila['valor_diseño'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_corte'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Cant. Corte:</span> <?= $fila['cant_corte'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Corte:</span> $<?= $fila['precio_corte'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php
                                                $tieneMargen = !empty($fila['margen_bruto']);
                                                $tieneEstampilla = !empty($fila['valor_porcentajeestampilla']);

                                                $claseCol = ($tieneMargen && $tieneEstampilla) ? 'col-md-6' : 'col-md-12 text-center';
                                                ?>

                                                <?php if ($tieneMargen): ?>
                                                    <div class="<?= $claseCol ?>">
                                                        <p class="card-text" style="color: black;"> <span class="font-weight-bold">% Margen Bruto:</span> $<?= $fila['margen_bruto'] ?></p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($tieneEstampilla): ?>
                                                    <div class="<?= $claseCol ?>">
                                                        <p class="card-text" style="color: black;"> <span class="font-weight-bold">% Estampilla:</span> $<?= $fila['valor_porcentajeestampilla'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                                <!--<button class="btn btn-danger" onclick="imprimirProducto()">
                                    Descargar PDF
                                </button>-->

                            </div>
                        <?php endif; ?>
                        <?php if ($fila['id_tipo_producto'] == 8): ?>
                            <div class="modal-header" style="background-color: #000DD3;">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Informacion producto: <?= $fila['nombre_producto'] ?></h5>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                    <!-- Datos de la solicitud -->
                                    <div class="card-text-container">
                                        <?php
                                            // Array de imágenes
                                            $imagenes = [
                                                $fila['imagen'],
                                                $fila['imagen2'],
                                                $fila['imagen3'],
                                                $fila['imagen4'],
                                            ];

                                            // Filtrar imágenes no vacías
                                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                                        ?>

                                        <?php if (!empty($imagenesValidas)): ?>
                                            <div class="d-flex flex-wrap justify-content-center">
                                                <div class="mb-2 mt-1 text-center border rounded p-2">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                                    <div class="d-flex justify-content-center mb-2">
                                                        <?php foreach ($imagenesValidas as $imagen): ?>
                                                            <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                                <img src="../../img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div>
                                            <?php
                                            // Array de logos
                                            $logos = [
                                                $fila['logo1'],
                                                $fila['logo2'],
                                                $fila['logo3'],
                                                $fila['logo4']
                                            ];

                                            // Definimos la función si no existe
                                            if (!function_exists('displayFile')) {
                                                function displayFile($file)
                                                {
                                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileName = basename($file);
                                                    $filePath = '../../logos_empresas/' . $file;

                                                    if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                        echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                                    } else {
                                                        echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                                        <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                                    </a>';
                                                    }
                                                }
                                            }
                                            ?>

                                            <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                            ?>
                                                <div class="mb-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                                    <div class="card-body d-flex justify-content-center flex-wrap">
                                                        <?php foreach ($logos as $logo): ?>
                                                            <?php if (!empty($logo)): ?>
                                                                <div class="text-center p-1">
                                                                    <?php displayFile($logo); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!---->

                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($fila['nombre_proveedor'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">proveedor</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div>
                                                    <p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila['nombre_proveedor'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion Producto</h6>
                                        <div class="mb-2 row justify-content-center">
                                            <?php
                                            if (!empty($fila['observaciones'])): ?>
                                                <div>
                                                    <p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                                </div>
                                            <?php endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                        <div class="row">
                                            <?php
                                            $tieneBordado = !empty($fila['precio_bordado']);
                                            $tieneEstampado = !empty($fila['precio_estampado']);

                                            $claseCol = ($tieneBordado && $tieneEstampado) ? 'col-md-6' : 'col-md-12 text-center';
                                            ?>

                                            <?php if ($tieneBordado): ?>
                                                <div class="<?= $claseCol ?>">
                                                    <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio Bordado:</span> $<?= $fila['precio_bordado'] ?></p>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($tieneEstampado): ?>
                                                <div class="<?= $claseCol ?>">
                                                    <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio Estampado:</span> $<?= $fila['precio_estampado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php
                                            $tieneFlete = !empty($fila['valor_flete']);
                                            $tieneLogistica = !empty($fila['precio_logistica']);

                                            $claseCol = ($tieneFlete && $tieneLogistica) ? 'col-md-6' : 'col-md-12 text-center';
                                            ?>

                                            <?php if ($tieneFlete): ?>
                                                <div class="<?= $claseCol ?>">
                                                    <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio del Flete:</span> $<?= $fila['valor_flete'] ?></p>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($tieneLogistica): ?>
                                                <div class="<?= $claseCol ?>">
                                                    <p class="card-text" style="color: black;"> <span class="font-weight-bold">Precio Logística:</span> $<?= $fila['precio_logistica'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['tipo_entrega'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de Entrega:</span> $<?= $fila['precio_entrega'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_bolsa'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de la Bolsa:</span> $<?= $fila['precio_bolsa'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_marquilla'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de Marquilla:</span> $<?= $fila['precio_marquilla'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_acabado'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Acabado:</span> <?= $fila['insumo_acabado'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio del Acabado:</span> $<?= $fila['precio_acabado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_encarterada'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Encarterada:</span> <?= $fila['tipo_encarterada'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de Encarterada:</span> $<?= $fila['precio_encarterada'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_diseño'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Diseño:</span> <?= $fila['opcion_diseño'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Diseño:</span> $<?= $fila['valor_diseño'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_corte'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Cant. Corte:</span> <?= $fila['cant_corte'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Corte:</span> $<?= $fila['precio_corte'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php
                                            $tieneMargen = !empty($fila['margen_bruto']);
                                            $tieneEstampilla = !empty($fila['valor_porcentajeestampilla']);

                                            $claseCol = ($tieneMargen && $tieneEstampilla) ? 'col-md-6' : 'col-md-12 text-center';
                                            ?>

                                            <?php if ($tieneMargen): ?>
                                                <div class="<?= $claseCol ?>">
                                                    <p class="card-text" style="color: black;"> <span class="font-weight-bold">% Margen Bruto:</span> $<?= $fila['margen_bruto'] ?></p>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($tieneEstampilla): ?>
                                                <div class="<?= $claseCol ?>">
                                                    <p class="card-text" style="color: black;"> <span class="font-weight-bold">% Estampilla:</span> $<?= $fila['valor_porcentajeestampilla'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Modal Eliminar -->
            <div class="modal fade" id="Eliminar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar el siguiente Producto: <?php echo !empty($fila['nombre_prenda']) ? $fila['nombre_prenda'] : $fila['nombre_producto']; ?>?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                Si continúa, el producto sera eliminado de la solicitud actual.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        
        <script>
            function imprimirProducto() {
                window.print();
            }
        </script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function() {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
        <script>
            // Variable global para almacenar el último valor
            let ultimoValor = 0;

            function borrarCero(input) {
                // Guardar el último valor antes de cambiarlo
                ultimoValor = input.value;
                // Si el valor es 0, establecer el valor del campo a una cadena vacía
                if (input.value === '0') {
                    input.value = '';
                }
            }

            function guardarUltimoValor(input) {
                // Guardar el último valor válido del input
                ultimoValor = input.value;
            }

            function deshabilitarScroll(event) {
                event.preventDefault();
            }

            function restaurarValorSiVacio(input) {
                // Si el campo está vacío, restaurar el último valor conocido
                if (input.value === '') {
                    input.value = ultimoValor;
                }
            }

            document.querySelectorAll('input[type=number]').forEach(input => {
                input.addEventListener('wheel', function(event) {
                    event.preventDefault();
                });
            });
        </script>
        <script>
            document.getElementById('id_costo').addEventListener('change', function() {
                var otroCostoDiv = document.getElementById('otroCosto');
                var select = this;

                if (select.value === 'otro') {
                    otroCostoDiv.style.display = 'block';
                } else {
                    otroCostoDiv.style.display = 'none';
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".comboTela").forEach(function(input) {
                    const container = input.closest(".position-relative");
                    const list = container.querySelector(".comboTelaList");
                    const select = container.querySelector(".selectTela");

                    // Construir arreglo de opciones desde el select
                    const opciones = Array.from(select.options).map(opt => ({
                        id: opt.value,
                        texto: opt.textContent,
                        precio: opt.dataset.precio,
                        fecha: opt.dataset.fecha
                    }));

                    // Buscar coincidencias
                    input.addEventListener("input", function() {
                        const filtro = this.value.toLowerCase();
                        list.innerHTML = "";

                        if (filtro === "") {
                            list.style.display = "none";
                            return;
                        }

                        const resultados = opciones.filter(o => o.texto.toLowerCase().includes(filtro));
                        if (resultados.length === 0) {
                            list.style.display = "none";
                            return;
                        }

                        resultados.forEach(o => {
                            const div = document.createElement("div");
                            div.className = "list-group-item list-group-item-action combobox-item";
                            div.textContent = o.texto;
                            div.dataset.id = o.id;

                            div.addEventListener("click", function() {
                                input.value = o.texto;
                                select.value = o.id;
                                select.dispatchEvent(new Event("change"));
                                list.style.display = "none";
                            });

                            list.appendChild(div);
                        });

                        list.style.display = "block";
                    });

                    // Inicializar con la opción seleccionada
                    const selectedOpt = select.options[select.selectedIndex];
                    if (selectedOpt && selectedOpt.value !== "0") {
                        input.value = selectedOpt.textContent;
                    }

                    // Cerrar lista al hacer clic fuera
                    document.addEventListener("click", function(e) {
                        if (!container.contains(e.target)) {
                            list.style.display = "none";
                        }
                    });

                    function actualizarTela(forzarPrecio = false) {
                        const selectedOption = select.options[select.selectedIndex];
                        const precio = selectedOption.getAttribute("data-precio");
                        let fecha = selectedOption.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_tela"]');
                        const fechaContainer = form.querySelector("#fechaTelaContainer");
                        const fechaSpan = fechaContainer.querySelector(".fecha-actualizacion-tela-container");

                        if (precioInput && (forzarPrecio || precioInput.value === "" || parseFloat(precioInput.value) === 0)) {
                            precioInput.value = precio || 0;
                        }

                        // Fecha
                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaSpan) fechaSpan.textContent = fecha;

                        // Mostrar u ocultar fecha
                        if (select.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                            fechaContainer.style.display = "block";
                        } else {
                            fechaContainer.style.display = "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarTela(true);
                    });

                    actualizarTela(false);
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.querySelectorAll(".comboTelaCombi").forEach(function(input) {

                    const container = input.closest(".position-relative");
                    const list = container.querySelector(".comboTelaCombiList");
                    const select = container.querySelector(".selectTelaCombi");

                    const form = input.closest("form");
                    const precioInput = form.querySelector('input[name="precio_telacombinada"]');
                    const consumoInput = form.querySelector('input[name="promedio_telacombi"]');
                    const fechaContainer = form.querySelector(".fecha-actualizacion-container");
                    const precioContainer = form.querySelector(".precioTelaCombiContainer");

                    // ========= BUSCADOR (NO SE TOCA) =========
                    const opciones = Array.from(select.options).map(opt => ({
                        id: opt.value,
                        texto: opt.textContent,
                        precio: opt.dataset.precio,
                        fecha: opt.dataset.fecha
                    }));

                    input.addEventListener("input", function() {
                        const filtro = this.value.toLowerCase();
                        list.innerHTML = "";

                        if (!filtro) {
                            list.style.display = "none";
                            return;
                        }

                        opciones.filter(o => o.texto.toLowerCase().includes(filtro))
                            .forEach(o => {
                                const div = document.createElement("div");
                                div.className = "list-group-item list-group-item-action";
                                div.textContent = o.texto;

                                div.addEventListener("click", function() {
                                    input.value = o.texto;
                                    select.value = o.id;
                                    select.dispatchEvent(new Event("change"));
                                    list.style.display = "none";
                                });

                                list.appendChild(div);
                            });

                        list.style.display = "block";
                    });

                    document.addEventListener("click", e => {
                        if (!container.contains(e.target)) list.style.display = "none";
                    });

                    // ========= LÓGICA CORRECTA =========
                    function actualizarTela(forzarPrecio = false) {
                        const selected = select.options[select.selectedIndex];
                        const haySeleccion = select.value && select.value !== "0";

                        if (!selected) return;

                        const precio = selected.dataset.precio || 0;
                        let fecha = selected.dataset.fecha || "No Aplica";

                        if (precioInput && (forzarPrecio || precioInput.value === "" || parseFloat(precioInput.value) === 0)) {
                            precioInput.value = precio || 0;
                        }

                        if (fechaContainer) fechaContainer.textContent = fecha;

                        precioContainer.style.display = haySeleccion ? "block" : "none";

                        if (!haySeleccion && consumoInput) {
                            consumoInput.value = 0;
                        }
                    }


                    // Cambio REAL del usuario
                    select.addEventListener("change", function() {
                        actualizarTela(true);
                    });

                    // Carga inicial (NO pisa precio guardado)
                    const selectedOpt = select.options[select.selectedIndex];
                    if (selectedOpt && selectedOpt.value !== "0") {
                        input.value = selectedOpt.textContent;
                    }

                    actualizarTela(false);

                });

            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.querySelectorAll(".comboTelaForro").forEach(function(input) {

                    const container = input.closest(".position-relative");
                    const list = container.querySelector(".comboTelaForroList");
                    const select = container.querySelector(".selectTelaForro");

                    const form = input.closest("form");
                    const precioInput = form.querySelector('input[name="precio_forro"]');
                    const consumoInput = form.querySelector('input[name="promedio_forro"]');
                    const fechaContainer = form.querySelector(".fecha-actualizacion-forro-container");
                    const precioContainer = form.querySelector(".precioTelaForroContainer");

                    if (!list || !select) return;

                    // ========= BUSCADOR (NO SE TOCA) =========
                    const opciones = Array.from(select.options).map(opt => ({
                        id: opt.value,
                        texto: opt.textContent,
                        precio: opt.dataset.precio,
                        fecha: opt.dataset.fecha
                    }));

                    input.addEventListener("input", function() {
                        const filtro = this.value.toLowerCase();
                        list.innerHTML = "";

                        if (!filtro) {
                            list.style.display = "none";
                            return;
                        }

                        opciones
                            .filter(o => o.texto.toLowerCase().includes(filtro))
                            .forEach(o => {
                                const div = document.createElement("div");
                                div.className = "list-group-item list-group-item-action";
                                div.textContent = o.texto;

                                div.addEventListener("click", function() {
                                    input.value = o.texto;
                                    select.value = o.id;
                                    select.dispatchEvent(new Event("change"));
                                    list.style.display = "none";
                                });

                                list.appendChild(div);
                            });

                        list.style.display = "block";
                    });

                    document.addEventListener("click", e => {
                        if (!container.contains(e.target)) list.style.display = "none";
                    });

                    // ========= LÓGICA CORRECTA =========
                    function actualizarForro(forzarPrecio = false) {
                        const selected = select.options[select.selectedIndex];
                        const haySeleccion = select.value && select.value !== "0";

                        if (!selected) return;

                        const precio = selected.dataset.precio || 0;
                        const fecha = selected.dataset.fecha || "No Aplica";

                        if (precioInput && (forzarPrecio || precioInput.value === "" || parseFloat(precioInput.value) === 0)) {
                            precioInput.value = precio || 0;
                        }

                        if (fechaContainer) fechaContainer.textContent = fecha;

                        precioContainer.style.display = haySeleccion ? "block" : "none";

                        if (!haySeleccion && consumoInput) {
                            consumoInput.value = 0;
                        }
                    }

                    // Cambio REAL del usuario
                    select.addEventListener("change", function() {
                        actualizarForro(true);
                    });

                    // Carga inicial (NO pisa precio guardado)
                    const selectedOpt = select.options[select.selectedIndex];
                    if (selectedOpt && selectedOpt.value !== "0") {
                        input.value = selectedOpt.textContent;
                    }

                    actualizarForro(false);
                });

            });
        </script>
        <script>
            // Script para el Cuello
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_cuello"]').forEach(function(select) {

                    const form = select.closest("form");
                    const precioInput = form.querySelector('input[name="precio_cuello"]');
                    const fechaContainer = form.querySelector(".fecha-actualizacion-cuello-container");
                    const contenedor = form.querySelector(".precio-cuello-container");

                    // ✅ Valor por defecto INDIVIDUAL por producto
                    const defaultValue = select.dataset.default ?? "0";
                    select.value = defaultValue;

                    function actualizarCuello(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected?.getAttribute("data-precio") ?? 0;
                        let fecha = selected?.getAttribute("data-fecha");

                        // ✅ Cargar precio correctamente
                        if (precioInput && (forzarPrecio || precioInput.value == 0)) {
                            precioInput.value = precio;
                        }

                        // Fecha
                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        // Mostrar / ocultar
                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    // Cambio manual
                    select.addEventListener("change", function() {
                        actualizarCuello(true);
                    });

                    // ✅ Inicializar correctamente ESTE producto
                    actualizarCuello(false);
                });

            });
            //

            // Script para el Puño
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_puño"]').forEach(function(select) {

                    const form = select.closest("form");
                    const precioInput = form.querySelector('input[name="precio_puño"]');
                    const fechaContainer = form.querySelector(".fecha-actualizacion-puño-container");
                    const contenedor = form.querySelector(".precioPuñoContainer");

                    // ✅ Valor por defecto INDIVIDUAL
                    const defaultValue = select.dataset.default ?? "0";
                    select.value = defaultValue;

                    function actualizarPuño(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected?.getAttribute("data-precio") ?? 0;
                        let fecha = selected?.getAttribute("data-fecha");

                        // Precio
                        if (precioInput && (forzarPrecio || precioInput.value == 0)) {
                            precioInput.value = precio;
                        }

                        // Fecha
                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        // Mostrar / ocultar
                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarPuño(true);
                    });

                    actualizarPuño(false);
                });
            });
            //

            // Script para el Pretina
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_pretina"]').forEach(function(select) {

                    function actualizarPretina(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_pretina"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-pretina-container");
                        const contenedor = form.querySelector("#precioPretinaContainer");

                        // 🔑 Lógica correcta:
                        // - No sobrescribe precio guardado al cargar
                        // - Sí sobrescribe cuando el usuario cambia el select
                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    // Cambio real del usuario → forzar precio
                    select.addEventListener("change", function() {
                        actualizarPretina(true);
                    });

                    // Carga inicial → NO forzar precio
                    actualizarPretina(false);
                });

            });
            //

            // Script para el Boton
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_boton"]').forEach(function(select) {

                    const form = select.closest("form");
                    const precioInput = form.querySelector('input[name="precio_boton"]');
                    const fechaContainer = form.querySelector(".fecha-actualizacion-boton-container");
                    const contenedor = form.querySelector(".precioBotonContainer");

                    const defaultValue = select.dataset.default ?? "0";
                    select.value = defaultValue;

                    function actualizarBoton(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected?.getAttribute("data-precio") ?? 0;
                        let fecha = selected?.getAttribute("data-fecha");

                        if (precioInput && (forzarPrecio || precioInput.value == 0)) {
                            precioInput.value = precio;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarBoton(true);
                    });

                    actualizarBoton(false);
                });
            });
            //

            // Script para el Boton 2
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_boton2"]').forEach(function(select) {

                    function actualizarBoton2(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_boton2"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-boton2-container");
                        const contenedor = form.querySelector("#precioBoton2Container");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarBoton2(true);
                    });

                    actualizarBoton2(false);
                });

            });
            //

            // Script para el Entretela
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_entretela"]').forEach(function(select) {

                    const form = select.closest("form");
                    const precioInput = form.querySelector('input[name="precio_entretela"]');
                    const fechaContainer = form.querySelector(".fecha-actualizacion-entretela-container");
                    const contenedor = form.querySelector(".precioEntretelaContainer");

                    const defaultValue = select.dataset.default ?? "0";
                    select.value = defaultValue;

                    function actualizarEntretela(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected?.getAttribute("data-precio") ?? 0;
                        let fecha = selected?.getAttribute("data-fecha");

                        if (precioInput && (forzarPrecio || precioInput.value == 0)) {
                            precioInput.value = precio;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarEntretela(true);
                    });

                    actualizarEntretela(false);
                });
            });
            //

            // Script para el Entretela 2
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_entretela2"]').forEach(function(select) {

                    function actualizarEntretela2(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_entretela2"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-entretela2-container");
                        const contenedor = form.querySelector(".precioEntretela2Container");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") {
                            fecha = "No Aplica";
                        }

                        if (fechaContainer) {
                            fechaContainer.textContent = fecha;
                        }

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarEntretela2(true);
                    });

                    // Ejecuta al cargar la página
                    actualizarEntretela2(false);
                });
            });
            //

            // Script para el Fusionado
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_fusionado"]').forEach(function(select) {

                    function actualizarFusionado(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_fusionado"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-fusionado-container");
                        const contenedor = form.querySelector("#precioFusionadoContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarFusionado(true);
                    });

                    actualizarFusionado(false);
                });

            });
            //

            // Script para el Cremallera 1
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_cremallera"]').forEach(function(select) {

                    function actualizarCremallera(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_cremallera"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-cremallera-container");
                        const contenedor = form.querySelector("#precioCremalleraContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarCremallera(true);
                    });

                    actualizarCremallera(false);
                });

            });
            //

            // Script para el Cremallera 2
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_cremallera2"]').forEach(function(select) {

                    function actualizarCremallera2(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_cremallera2"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-cremallera2-container");
                        const contenedor = form.querySelector("#precioCremallera2Container");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarCremallera2(true);
                    });

                    actualizarCremallera2(false);
                });

            });
            //

            // Script para el Velcro
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_velcro"]').forEach(function(select) {

                    function actualizarVelcro(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_velcro"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-velcro-container");
                        const contenedor = form.querySelector("#precioVelcroContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarVelcro(true);
                    });

                    actualizarVelcro(false);
                });

            });
            //

            // Script para el Resorte 1
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_resorte"]').forEach(function(select) {

                    let inicializado = false;

                    function actualizarResorte(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precioBD = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_resorte"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-resorte-container");
                        const contenedor = form.querySelector("#precioResorteContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precioBD || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    // Evento real del usuario
                    select.addEventListener("change", function() {
                        actualizarResorte(true); // 🔥 aquí SÍ forzamos precio
                    });

                    // Carga inicial (NO forzar)
                    actualizarResorte(false);
                });
            });
            //

            // Script para el Resorte 2
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_resorte2"]').forEach(function(select) {

                    function actualizarResorte2(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_resorte2"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-resorte2-container");
                        const contenedor = form.querySelector("#precioResorte2Container");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarResorte2(true);
                    });

                    actualizarResorte2(false);
                });

            });
            //

            // Script para el Hombrera
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_hombrera"]').forEach(function(select) {

                    function actualizarHombrera(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_hombrera"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-hombrera-container");
                        const contenedor = form.querySelector("#precioHombreraContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarHombrera(true);
                    });

                    actualizarHombrera(false);
                });

            });
            //

            // Script para el Sesgo
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_sesgo"]').forEach(function(select) {

                    function actualizarSesgo(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_sesgo"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-sesgo-container");
                        const contenedor = form.querySelector("#precioSesgoContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarSesgo(true);
                    });

                    actualizarSesgo(false);
                });

            });
            //

            // Script para la Trabilla
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_trabilla"]').forEach(function(select) {

                    function actualizarTrabilla(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_trabilla"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-trabilla-container");
                        const contenedor = form.querySelector("#precioTrabillaContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarTrabilla(true);
                    });

                    actualizarTrabilla(false);
                });

            });
            //

            // Script para la Vivo
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_vivo"]').forEach(function(select) {

                    function actualizarVivo(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_vivo"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-vivo-container");
                        const contenedor = form.querySelector("#precioVivoContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarVivo(true);
                    });

                    actualizarVivo(false);
                });

            });
            //

            // Script para la Cinta Reflectiva
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_cinta"]').forEach(function(select) {

                    function actualizarCinta(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_cinta"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-cinta-container");
                        const contenedor = form.querySelector("#precioCintaContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarCinta(true);
                    });

                    actualizarCinta(false);
                });

            });
            //

            // Script para la Cinta Faya
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_faya"]').forEach(function(select) {

                    function actualizarFaya(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_faya"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-faya-container");
                        const contenedor = form.querySelector("#precioFayaContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarFaya(true);
                    });

                    actualizarFaya(false);
                });

            });
            //

            // Script para la Guata
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_guata"]').forEach(function(select) {

                    function actualizarGuata(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_guata"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-guata-container");
                        const contenedor = form.querySelector("#precioGuataContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarGuata(true);
                    });

                    actualizarGuata(false);
                });

            });
            //

            // Script para el Broche 
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_broche"]').forEach(function(select) {

                    function actualizarBroche(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_broche"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-broche-container");
                        const contenedor = form.querySelector("#precioBrocheContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarBroche(true);
                    });

                    actualizarBroche(false);
                });

            });
            //

            // Script para el Cordon
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_cordon"]').forEach(function(select) {

                    function actualizarCordon(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_cordon"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-cordon-container");
                        const contenedor = form.querySelector("#precioCordonContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarCordon(true);
                    });

                    actualizarCordon(false);
                });

            });
            //

            // Script para la Puntera 
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_puntera"]').forEach(function(select) {

                    function actualizarPuntera(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_puntera"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-puntera-container");
                        const contenedor = form.querySelector("#precioPunteraContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarPuntera(true);
                    });

                    actualizarPuntera(false);
                });

            });
            //

            // Script para la Hiladilla 
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_hiladilla"]').forEach(function(select) {

                    function actualizarHiladilla(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_hiladilla"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-hiladilla-container");
                        const contenedor = form.querySelector("#precioHiladillaContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") {
                            fecha = "No Aplica";
                        }

                        if (fechaContainer) {
                            fechaContainer.textContent = fecha;
                        }

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarHiladilla(true);
                    });

                    // Ejecutar al cargar la página
                    actualizarHiladilla(false);
                });
            });
            //

            // Script para la plumilla 
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_plumilla"]').forEach(function(select) {

                    function actualizarPlumilla(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_plumilla"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-plumilla-container");
                        const contenedor = form.querySelector("#precioPlumillaContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarPlumilla(true);
                    });

                    actualizarPlumilla(false);
                });

            });
            //

            // Script para la vinilo 
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('select[name="id_vinilo"]').forEach(function(select) {

                    function actualizarVinilo(forzarPrecio = false) {

                        const selected = select.options[select.selectedIndex];
                        const precio = selected.getAttribute("data-precio");
                        let fecha = selected.getAttribute("data-fecha");

                        const form = select.closest("form");
                        const precioInput = form.querySelector('input[name="precio_vinilo"]');
                        const fechaContainer = form.querySelector(".fecha-actualizacion-vinilo-container");
                        const contenedor = form.querySelector("#precioViniloContainer");

                        if (precioInput && (forzarPrecio || precioInput.value === "")) {
                            precioInput.value = precio || 0;
                        }

                        if (!fecha || fecha === "0000-00-00") fecha = "No Aplica";
                        if (fechaContainer) fechaContainer.textContent = fecha;

                        if (contenedor) {
                            contenedor.style.display = select.value != "0" ? "block" : "none";
                        }
                    }

                    select.addEventListener("change", function() {
                        actualizarVinilo(true);
                    });

                    actualizarVinilo(false);
                });

            });
            //

            // Script para el Bordado
            document.querySelectorAll('select[name="id_bordado"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_bordado"]');
                    precioInput.value = precio;
                    togglePrecioBordado(this);
                });
            });

            function togglePrecioBordado(selectElement) {
                var precioBordadoContainer = selectElement.closest('form').querySelector('#precioBordadoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_bordado"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioBordadoContainer.style.display = "block";
                } else {
                    precioBordadoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_bordado"]').forEach(function(select) {
                    togglePrecioBordado(select);
                });
            });
            //

            // Script para el Estampado 
            document.querySelectorAll('select[name="id_estampado"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_estampado"]');
                    precioInput.value = precio;
                    togglePrecioEstampado(this);
                });
            });

            function togglePrecioEstampado(selectElement) {
                var precioEstampadoContainer = selectElement.closest('form').querySelector('#precioEstampadoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_estampado"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioEstampadoContainer.style.display = "block";
                } else {
                    precioEstampadoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_estampado"]').forEach(function(select) {
                    togglePrecioEstampado(select);
                });
            });
            //

            // Script para la bolsa
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_bolsa"]').forEach(function(select) {
                    const precioInput = select.closest('form')?.querySelector('input[name="precio_bolsa"]');

                    // Cargar precio inicial (id_bolsa = 2) si el input está vacío o en 0
                    if (precioInput && (!precioInput.value || parseFloat(precioInput.value) === 0)) {
                        const selectedOption = select.options[select.selectedIndex];
                        const precio_bolsa = selectedOption.getAttribute('data-precio_bolsa');
                        if (precio_bolsa) {
                            precioInput.value = precio_bolsa;
                        }
                    }

                    // Actualizar precio al cambiar bolsa
                    select.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const precio_bolsa = selectedOption.getAttribute('data-precio_bolsa');
                        if (precio_bolsa) {
                            precioInput.value = precio_bolsa;
                        }
                    });
                });
            });
            // 

            //Script para la marquilla
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_marquilla"]').forEach(function(select) {
                    const precioInput = select.closest('.row')?.querySelector('input[name="precio_marquilla"]');

                    if (!precioInput) return;

                    // Cargar precio inicial según la opción seleccionada
                    const selectedOption = select.options[select.selectedIndex];
                    const precio_marquilla = selectedOption.getAttribute('data-precio_marquilla');

                    if (precio_marquilla && (!precioInput.value || parseFloat(precioInput.value) === 0)) {
                        precioInput.value = precio_marquilla;
                    }

                    // Actualizar precio al cambiar la marquilla
                    select.addEventListener('change', function() {
                        const option = this.options[this.selectedIndex];
                        const precio = option.getAttribute('data-precio_marquilla');
                        if (precio) {
                            precioInput.value = precio;
                        }
                    });
                });
            });
            //

            // Script para el encarterada
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_encarterada"]').forEach(function(select) {
                    const precioInput = select.closest('form')?.querySelector('input[name="precio_encarterada"]');

                    // Cargar precio inicial si el input está vacío o en 0
                    if (precioInput && (!precioInput.value || parseFloat(precioInput.value) === 0)) {
                        const selectedOption = select.options[select.selectedIndex];
                        const precio_encarterada = selectedOption.getAttribute('data-precio_encarterada');
                        if (precio_encarterada) {
                            precioInput.value = precio_encarterada;
                        }
                    }

                    // Cambiar precio cuando cambia el select
                    select.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const precio_encarterada = selectedOption.getAttribute('data-precio_encarterada');
                        if (precio_encarterada) {
                            precioInput.value = precio_encarterada;
                        }
                    });
                });
            });
            //

            // Script para Diseño
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_diseño"]').forEach(function(select) {
                    const precioInput = select.closest('form')?.querySelector('input[name="precio_diseño"]');

                    // Cargar precio inicial si está vacío o en 0
                    if (precioInput && (!precioInput.value || parseFloat(precioInput.value) === 0)) {
                        const selectedOption = select.options[select.selectedIndex];
                        const precio_diseño = selectedOption.getAttribute('data-precio_diseño');
                        if (precio_diseño) {
                            precioInput.value = precio_diseño;
                        }
                    }

                    // Cambiar precio al cambiar la opción
                    select.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const precio_diseño = selectedOption.getAttribute('data-precio_diseño');
                        if (precio_diseño) {
                            precioInput.value = precio_diseño;
                        }
                    });
                });
            });
            //

            // Script para Acabado y Corte
            document.addEventListener('DOMContentLoaded', function() {
                function manejarPrecio(selectName, inputName, dataAttr) {
                    document.querySelectorAll(`select[name="${selectName}"]`).forEach(function(select) {
                        const precioInput = select.closest('form')?.querySelector(`input[name="${inputName}"]`);

                        if (!precioInput) return;

                        function actualizarPrecio() {
                            const selectedOption = select.options[select.selectedIndex];

                            // 👉 Si está en "Seleccione una opción"
                            if (select.value === "0") {
                                precioInput.value = 0;
                                return;
                            }

                            // 👉 Si hay opción válida
                            const precio = selectedOption.getAttribute(dataAttr);
                            precioInput.value = precio ? precio : 0;
                        }

                        // Carga inicial
                        actualizarPrecio();

                        // Cambio manual
                        select.addEventListener('change', actualizarPrecio);
                    });
                }

                // 🔹 Llamadas para cada módulo
                manejarPrecio('id_acabado', 'precio_acabado', 'data-precio_acabado');
                manejarPrecio('id_corte', 'precio_corte', 'data-precio_corte');
            });
            //

            // Script para Mano de obra
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.id_mano_obra').forEach(function (select) {

                    const form = select.closest('form');
                    if (!form) return;

                    const precioInput = form.querySelector('.precio_obra');
                    if (!precioInput) return;

                    select.addEventListener('change', function () {

                        if (this.value === "0") {
                            precioInput.value = 0;
                            return;
                        }

                        const option = this.options[this.selectedIndex];
                        const precio = option.getAttribute('data-precio_confeccion');

                        if (precio !== null) {
                            precioInput.value = precio;
                        }
                    });

                });

            });
            //

            // Script para Entrega
            document.querySelectorAll('select[name="id_entrega"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio_entrega = selectedOption.getAttribute('data-precio_entrega');
                    var precioInput = this.closest('form').querySelector('input[name="precio_entrega"]');
                    precioInput.value = precio_entrega;
                });
            });
            //
        </script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx-style@0.8.13/dist/xlsx-style.min.js"></script>
        <script>
            document.getElementById('downloadExcel').addEventListener('click', function() {
                // Obtener datos desde PHP
                <?php
                    $consulta = "SELECT pedido.id_pedido, producto.id_producto, prenda.id_prenda, cliente.nit, cliente.cliente, producto.nombre_producto, prenda.nombre_prenda, producto.suma_prendas, 
                    producto.id_mano_obra, producto.precio_obra, producto.margen_bruto, producto.precio_venta, producto.precio_iva, producto.precio_total, pedido.total_factura, tipo_producto.id_tipo_producto, producto.id_tipo_producto,
                    producto.id_tela, tela.id_tela, tela.tela, 
                    producto.id_telacombi, tela_combinada.id_telacombi, tela_combinada.tela_combi, 
                    producto.id_telaforro, tela_forro.id_telaforro, tela_forro.tela_forro,
                    producto.id_entretela, entretela.id_entretela, entretela.insumo AS insumo_entretela, 
                    producto.id_entretela2, entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2,
                    producto.id_bolsa , bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa,
                    producto.id_boton, boton.id_boton, boton.insumo AS insumo_boton,
                    producto.id_boton2, boton2.id_boton2, boton2.insumo AS insumo_boton2,
                    producto.id_broche, broche.id_broche, broche.insumo AS insumo_broche,
                    producto.id_faya, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya,
                    producto.id_cinta, cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_cinta,
                    producto.id_cordon, cordon.id_cordon, cordon.insumo AS insumo_cordon,
                    producto.id_cremallera, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera,
                    producto.id_cremallera2, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2,
                    producto.id_cuello, cuello.id_cuello, cuello.insumo AS insumo_cuello,
                    producto.id_deslizador, deslizador.id_deslizador, deslizador.insumo AS insumo_deslizador,
                    producto.id_fajon_cintura, fajon_cintura.id_fajon_cintura, fajon_cintura.insumo AS insumo_fajon,
                    producto.id_guata, guata.id_guata, guata.insumo AS insumo_guata,
                    producto.id_hiladilla, hiladilla.id_hiladilla, hiladilla.insumo AS insumo_hiladilla,
                    producto.id_hombrera, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera,
                    producto.id_marquilla, marquilla.id_marquilla, marquilla.insumo AS insumo_marquilla,
                    producto.id_plumilla, plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla,
                    producto.id_pretina, pretina.id_pretina, pretina.insumo AS insumo_pretina,
                    producto.id_puntera, puntera.id_puntera, puntera.insumo AS insumo_puntera,
                    producto.id_puño, puño.id_puño, puño.insumo AS insumo_puño,
                    producto.id_resorte, resorte.id_resorte, resorte.insumo AS insumo_resorte,
                    producto.id_resorte2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2,
                    producto.id_sesgo, sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo,
                    producto.id_trabilla, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla,
                    producto.id_velcro, velcro.id_velcro, velcro.insumo AS insumo_velcro,
                    producto.id_vinilo, vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo,
                    producto.id_vivo, vivo.id_vivo, vivo.insumo AS insumo_vivo
                    FROM producto
                    JOIN pedido ON producto.id_pedido = pedido.id_pedido
                    LEFT JOIN cliente ON pedido.nit = cliente.nit
                    LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto
                    LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda
                    LEFT JOIN tela ON producto.id_tela = tela.id_tela
                    LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi
                    LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro
                    LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela
                    LEFT JOIN entretela2 ON producto.id_entretela2 = entretela2.id_entretela2
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
                    LEFT JOIN fajon_cintura ON producto.id_fajon_cintura = fajon_cintura.id_fajon_cintura
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
                    WHERE pedido.id_pedido = $id_pedido";

                    $resultado = mysqli_query($enlace, $consulta);

                    $productos = [];
                    $clienteNombre = '';
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $productos[] = $fila;
                        $clienteNombre = $fila['cliente'];
                    }
                ?>

                const data = <?php echo json_encode($productos); ?>;
                const totalFactura = data.length > 0 ? data[0].total_factura : 0;
                const clienteNombre = "<?php echo $clienteNombre; ?>";

                // ==========================================
                // CREAR DATOS
                // ==========================================

                const fechaActual = new Date().toLocaleDateString('es-CO');

                const ws_data = [];

                // TITULO
                ws_data.push([`COTIZACIÓN GENERAL`]);
                ws_data.push([`Cliente: ${clienteNombre}`]);
                ws_data.push([`Fecha: ${fechaActual}`]);
                ws_data.push([]);

                // ENCABEZADOS
                ws_data.push([
                    'PRODUCTO',
                    'DESCRIPCIÓN',
                    'UNIDADES',
                    'MANO OBRA',
                    '% MARGEN',
                    'PRECIO UNITARIO',
                    'PRECIO + IVA',
                    'TOTAL'
                ]);

                // PRODUCTOS
                data.forEach(item => {

                    const descripcion = [
                        item.id_tela != 0 ? `• Tela: ${item.tela}` : null,
                        item.id_telacombi != 0 ? `• Tela Combinada: ${item.tela_combi}` : null,
                        item.id_telaforro != 0 ? `• Tela Forro: ${item.tela_forro}` : null,
                        item.id_entretela != 0 ? `• Entretela: ${item.insumo_entretela}` : null,
                        item.id_entretela2 != 0 ? `• Entretela 2: ${item.insumo_entretela2}` : null,
                        item.id_bolsa != 0 ? `• Bolsa: ${item.insumo_bolsa}` : null,
                        item.id_boton != 0 ? `• Botón: ${item.insumo_boton}` : null,
                        item.id_boton2 != 0 ? `• Botón 2: ${item.insumo_boton2}` : null,
                        item.id_broche != 0 ? `• Broche: ${item.insumo_broche}` : null,
                        item.id_faya != 0 ? `• Cinta Faya: ${item.insumo_faya}` : null,
                        item.id_cinta != 0 ? `• Cinta Reflectiva: ${item.insumo_cinta}` : null,
                        item.id_cordon != 0 ? `• Cordón: ${item.insumo_cordon}` : null,
                        item.id_cremallera != 0 ? `• Cremallera: ${item.insumo_cremallera}` : null,
                        item.id_cremallera2 != 0 ? `• Cremallera 2: ${item.insumo_cremallera2}` : null,
                        item.id_cuello != 0 ? `• Cuello: ${item.insumo_cuello}` : null,
                        item.id_deslizador != 0 ? `• Deslizador: ${item.insumo_deslizador}` : null,
                        item.id_fajon_cintura != 0 ? `• Fajón Cintura: ${item.insumo_fajon}` : null,
                        item.id_guata != 0 ? `• Guata: ${item.insumo_guata}` : null,
                        item.id_hiladilla != 0 ? `• Hiladilla: ${item.insumo_hiladilla}` : null,
                        item.id_hombrera != 0 ? `• Hombrera: ${item.insumo_hombrera}` : null,
                        item.id_marquilla != 0 ? `• Marquilla: ${item.insumo_marquilla}` : null,
                        item.id_plumilla != 0 ? `• Plumilla: ${item.insumo_plumilla}` : null,
                        item.id_pretina != 0 ? `• Pretina: ${item.insumo_pretina}` : null,
                        item.id_puntera != 0 ? `• Puntera: ${item.insumo_puntera}` : null,
                        item.id_puño != 0 ? `• Puño: ${item.insumo_puño}` : null,
                        item.id_resorte != 0 ? `• Resorte: ${item.insumo_resorte}` : null,
                        item.id_resorte2 != 0 ? `• Resorte 2: ${item.insumo_resorte2}` : null,
                        item.id_sesgo != 0 ? `• Sesgo: ${item.insumo_sesgo}` : null,
                        item.id_trabilla != 0 ? `• Trabilla: ${item.insumo_trabilla}` : null,
                        item.id_velcro != 0 ? `• Velcro: ${item.insumo_velcro}` : null,
                        item.id_vinilo != 0 ? `• Vinilo: ${item.insumo_vinilo}` : null,
                        item.id_vivo != 0 ? `• Vivo: ${item.insumo_vivo}` : null,
                    ].filter(Boolean).join('\n');

                    const producto =
                        parseInt(item.id_tipo_producto) == 8
                            ? item.nombre_producto
                            : item.nombre_prenda;

                    ws_data.push([
                        producto,
                        descripcion,
                        item.suma_prendas,
                        parseFloat(item.precio_obra),
                        parseFloat(item.margen_bruto),
                        parseFloat(item.precio_venta),
                        parseFloat(item.precio_iva),
                        parseFloat(item.precio_total)
                    ]);
                });

                // FILA VACÍA
                ws_data.push([]);

                // TOTAL
                ws_data.push([
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    'TOTAL FACTURA',
                    parseFloat(totalFactura)
                ]);

                // ==========================================
                // CREAR LIBRO
                // ==========================================

                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(ws_data);

                // ==========================================
                // COMBINAR CELDAS
                // ==========================================

                ws['!merges'] = [
                    { s: { r: 0, c: 0 }, e: { r: 0, c: 7 } },
                    { s: { r: 1, c: 0 }, e: { r: 1, c: 7 } },
                    { s: { r: 2, c: 0 }, e: { r: 2, c: 7 } }
                ];

                // ==========================================
                // ANCHO COLUMNAS
                // ==========================================

                ws['!cols'] = [
                    { wch: 30 },
                    { wch: 55 },
                    { wch: 12 },
                    { wch: 18 },
                    { wch: 14 },
                    { wch: 20 },
                    { wch: 20 },
                    { wch: 20 }
                ];

                // ==========================================
                // ALTURA FILAS
                // ==========================================

                ws['!rows'] = ws_data.map((row, i) => {

                    if (i === 0) return { hpt: 35 };

                    if (i >= 5 && i < ws_data.length - 2) {

                        const descripcion = row[1] || '';
                        const lineas = descripcion.split('\n').length;

                        return {
                            hpt: Math.max(30, lineas * 18)
                        };
                    }

                    return { hpt: 25 };
                });

                // ==========================================
                // ESTILOS
                // ==========================================

                const blue = "0B5ED7";
                const darkBlue = "084298";
                const lightGray = "F8F9FA";
                const borderColor = "D9D9D9";
                const green = "198754";

                const range = XLSX.utils.decode_range(ws['!ref']);

                // ==========================================
                // COLORES
                // ==========================================

                const primaryBlue = "1F4E78";
                const secondaryBlue = "D9EAF7";
                const headerBlue = "0B5ED7";
                const grayRow = "F4F6F9";
                const totalGreen = "198754";

                const thinBorder = {
                    style: "thin",
                    color: { rgb: "BFBFBF" }
                };

                const mediumBorder = {
                    style: "medium",
                    color: { rgb: "7F7F7F" }
                };

                for (let R = range.s.r; R <= range.e.r; ++R) {

                    for (let C = range.s.c; C <= range.e.c; ++C) {

                        const cellRef = XLSX.utils.encode_cell({ r: R, c: C });

                        if (!ws[cellRef]) continue;

                        // ==========================================
                        // ESTILO BASE
                        // ==========================================

                        ws[cellRef].s = {
                            font: {
                                name: "Calibri",
                                sz: 11,
                                color: { rgb: "000000" }
                            },

                            alignment: {
                                vertical: "center",
                                horizontal: "center",
                                wrapText: true
                            },

                            border: {
                                top: thinBorder,
                                bottom: thinBorder,
                                left: thinBorder,
                                right: thinBorder
                            }
                        };

                        // ==========================================
                        // TITULO PRINCIPAL
                        // ==========================================

                        if (R === 0) {

                            ws[cellRef].s = {
                                font: {
                                    bold: true,
                                    sz: 24,
                                    color: { rgb: "FFFFFF" },
                                    name: "Calibri"
                                },

                                fill: {
                                    fgColor: { rgb: primaryBlue }
                                },

                                alignment: {
                                    vertical: "center",
                                    horizontal: "center",
                                    wrapText: true
                                },

                                border: {
                                    top: mediumBorder,
                                    bottom: mediumBorder,
                                    left: mediumBorder,
                                    right: mediumBorder
                                }
                            };
                        }

                        // ==========================================
                        // CLIENTE Y FECHA
                        // ==========================================

                        if (R === 1 || R === 2) {

                            ws[cellRef].s = {
                                font: {
                                    bold: true,
                                    sz: 12,
                                    color: { rgb: primaryBlue }
                                },

                                fill: {
                                    fgColor: { rgb: secondaryBlue }
                                },

                                alignment: {
                                    vertical: "center",
                                    horizontal: "center",
                                    wrapText: true
                                },

                                border: {
                                    top: thinBorder,
                                    bottom: thinBorder,
                                    left: thinBorder,
                                    right: thinBorder
                                }
                            };
                        }

                        // ==========================================
                        // ENCABEZADOS TABLA
                        // ==========================================

                        if (R === 4) {

                            ws[cellRef].s = {
                                font: {
                                    bold: true,
                                    sz: 12,
                                    color: { rgb: "FFFFFF" }
                                },

                                fill: {
                                    fgColor: { rgb: headerBlue }
                                },

                                alignment: {
                                    vertical: "center",
                                    horizontal: "center",
                                    wrapText: true
                                },

                                border: {
                                    top: mediumBorder,
                                    bottom: mediumBorder,
                                    left: mediumBorder,
                                    right: mediumBorder
                                }
                            };
                        }

                        // ==========================================
                        // FILAS TABLA
                        // ==========================================

                        if (R > 4 && R < ws_data.length - 1) {

                            const even = R % 2 === 0;

                            ws[cellRef].s.fill = {
                                fgColor: {
                                    rgb: even ? "FFFFFF" : grayRow
                                }
                            };

                            ws[cellRef].s.border = {
                                top: thinBorder,
                                bottom: thinBorder,
                                left: thinBorder,
                                right: thinBorder
                            };
                        }

                        // ==========================================
                        // COLUMNAS CENTRADAS
                        // ==========================================

                        if ([2,3,4,5,6,7].includes(C) && R >= 4) {

                            ws[cellRef].s.alignment.horizontal = "center";
                        }

                        if (C === 1 && R > 4 && R < ws_data.length - 2) {
                            ws[cellRef].s.alignment.horizontal = "left";
                            ws[cellRef].s.alignment.vertical = "center";
                            ws[cellRef].s.alignment.wrapText = true;
                        }

                        // ==========================================
                        // FORMATO MONEDA
                        // ==========================================

                        if ([3,5,6,7].includes(C) && R > 4) {

                            ws[cellRef].z = '$ #,##0';
                        }

                        // ==========================================
                        // TOTAL FINAL
                        // ==========================================

                        if (R === ws_data.length - 1) {

                            ws[cellRef].s = {
                                font: {
                                    bold: true,
                                    sz: 13,
                                    color: { rgb: "FFFFFF" }
                                },

                                fill: {
                                    fgColor: { rgb: totalGreen }
                                },

                                alignment: {
                                    horizontal: "center",
                                    vertical: "center",
                                    wrapText: true
                                },

                                border: {
                                    top: mediumBorder,
                                    bottom: mediumBorder,
                                    left: mediumBorder,
                                    right: mediumBorder
                                }
                            };

                            ws[cellRef].z = '$ #,##0';
                        }
                    }
                }

                // ==========================================
                // FILTROS
                // ==========================================

                ws['!autofilter'] = {
                    ref: `A5:H${ws_data.length - 2}`
                };

                // ==========================================
                // AGREGAR HOJA
                // ==========================================

                XLSX.utils.book_append_sheet(wb, ws, "Cotización");

                // ==========================================
                // DESCARGAR
                // ==========================================

                const fileName = `Cotizacion_${clienteNombre}.xlsx`;

                XLSX.writeFile(wb, fileName);
            });
        </script>
    </body>
</html>