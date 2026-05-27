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

    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    function generarNombreUnico($nombreOriginal) {
        $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
        return date('YmdHis') . '_' . uniqid() . '.' . $extension;
    }
    
    if (isset($_POST['submit_crear'])) {

        $id_entrega = $_POST['id_entrega'];
        $consumo_telas = 0;
        $margen_bruto = 0;
        $valor_porcentajeestampilla = 0;
        $id_tipo_producto = isset($_POST['id_tipo_producto']) ? $_POST['id_tipo_producto'] : null;
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : null;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : null;
        $id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
        $id_prenda = isset($_POST['id_prenda']) ? $_POST['id_prenda'] : null;
        $id_prendacomprada = isset($_POST['id_prendacomprada']) ? $_POST['id_prendacomprada'] : null;
        $id_tela = isset($_POST['id_tela']) ? $_POST['id_tela'] : null;
        $id_telacombi = isset($_POST['id_telacombi']) ? $_POST['id_telacombi'] : null;
        $id_telaforro = isset($_POST['id_telaforro']) ? $_POST['id_telaforro'] : null;
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : null;
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : null;
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : null;
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : null;
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : null;
        $puño = isset($_POST['puño']) ? $_POST['puño'] : null;
        $pretina = isset($_POST['pretina']) ? $_POST['pretina'] : null;
        $fajon = isset($_POST['fajon']) ? $_POST['fajon'] : null;
        $boton = isset($_POST['boton']) ? $_POST['boton'] : null;
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : null;
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : null;
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : null;
        $logo = isset($_POST['logo']) ? $_POST['logo'] : null;
        $id_tipo_logo = isset($_POST['id_tipo_logo']) ? $_POST['id_tipo_logo'] : null;
        $id_bolsillo = isset($_POST['id_bolsillo']) ? $_POST['id_bolsillo'] : null;
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : null;
        $id_bolsillocombinado = isset($_POST['id_bolsillocombinado']) ? $_POST['id_bolsillocombinado'] : null;
        $cant_bolsilloscombinado = isset($_POST['cant_bolsilloscombinado']) ? $_POST['cant_bolsilloscombinado'] : null;
        $id_bolsillocombinado2 = isset($_POST['id_bolsillocombinado2']) ? $_POST['id_bolsillocombinado2'] : null;
        $cant_bolsilloscombinado2 = isset($_POST['cant_bolsilloscombinado2']) ? $_POST['cant_bolsilloscombinado2'] : null;
        $id_tablon = isset($_POST['id_tablon']) ? $_POST['id_tablon'] : null;
        $id_cartera = isset($_POST['id_cartera']) ? $_POST['id_cartera'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $valor_agregado = isset($_POST['valor_agregado']) ? $_POST['valor_agregado'] : null;

        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;
        $imagen_nombre = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
        $imagen_temporal = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;
        $imagen2 = isset($_POST['imagen2']) ? $_POST['imagen2'] : null;
        $imagen_nombre2 = isset($_FILES['imagen2']['name']) ? $_FILES['imagen2']['name'] : null;
        $imagen_temporal2 = isset($_FILES['imagen2']['tmp_name']) ? $_FILES['imagen2']['tmp_name'] : null;
        $imagen3 = isset($_POST['imagen3']) ? $_POST['imagen3'] : null;
        $imagen_nombre3 = isset($_FILES['imagen3']['name']) ? $_FILES['imagen3']['name'] : null;
        $imagen_temporal3 = isset($_FILES['imagen3']['tmp_name']) ? $_FILES['imagen3']['tmp_name'] : null;
        $imagen4 = isset($_POST['imagen4']) ? $_POST['imagen4'] : null;
        $imagen_nombre4 = isset($_FILES['imagen4']['name']) ? $_FILES['imagen4']['name'] : null;
        $imagen_temporal4 = isset($_FILES['imagen4']['tmp_name']) ? $_FILES['imagen4']['tmp_name'] : null;
        $carpeta_destino = "../../img/pedidos/";

        $logo1 = isset($_POST['logo1']) ? $_POST['logo1'] : null;
        $logo_nombre1 = isset($_FILES['logo1']['name']) ? $_FILES['logo1']['name'] : null;
        $logo_temporal1 = isset($_FILES['logo1']['tmp_name']) ? $_FILES['logo1']['tmp_name'] : null;
        $logo2 = isset($_POST['logo2']) ? $_POST['logo2'] : null;
        $logo_nombre2 = isset($_FILES['logo2']['name']) ? $_FILES['logo2']['name'] : null;
        $logo_temporal2 = isset($_FILES['logo2']['tmp_name']) ? $_FILES['logo2']['tmp_name'] : null;
        $logo3 = isset($_POST['logo3']) ? $_POST['logo3'] : null;
        $logo_nombre3 = isset($_FILES['logo3']['name']) ? $_FILES['logo3']['name'] : null;
        $logo_temporal3 = isset($_FILES['logo3']['tmp_name']) ? $_FILES['logo3']['tmp_name'] : null;
        $logo4 = isset($_POST['logo4']) ? $_POST['logo4'] : null;
        $logo_nombre4 = isset($_FILES['logo4']['name']) ? $_FILES['logo4']['name'] : null;
        $logo_temporal4 = isset($_FILES['logo4']['tmp_name']) ? $_FILES['logo4']['tmp_name'] : null;
        $carpeta_guardado = "../../logos_empresas/";

        if (!empty($imagen_temporal)) {
            $imagen_nombre = generarNombreUnico($_FILES['imagen']['name']);
            move_uploaded_file($imagen_temporal, $carpeta_destino . $imagen_nombre);
        }

        if (!empty($imagen_temporal2)) {
            $imagen_nombre2 = generarNombreUnico($_FILES['imagen2']['name']);
            move_uploaded_file($imagen_temporal2, $carpeta_destino . $imagen_nombre2);
        }

        if (!empty($imagen_temporal3)) {
            $imagen_nombre3 = generarNombreUnico($_FILES['imagen3']['name']);
            move_uploaded_file($imagen_temporal3, $carpeta_destino . $imagen_nombre3);
        }

        if (!empty($imagen_temporal4)) {
            $imagen_nombre4 = generarNombreUnico($_FILES['imagen4']['name']);
            move_uploaded_file($imagen_temporal4, $carpeta_destino . $imagen_nombre4);
        }
        if (!empty($logo_temporal1)) {
            $logo_nombre1 = generarNombreUnico($_FILES['logo1']['name']);
            move_uploaded_file($logo_temporal1, $carpeta_guardado . $logo_nombre1);
        }

        if (!empty($logo_temporal2)) {
            $logo_nombre2 = generarNombreUnico($_FILES['logo2']['name']);
            move_uploaded_file($logo_temporal2, $carpeta_guardado . $logo_nombre2);
        }

        if (!empty($logo_temporal3)) {
            $logo_nombre3 = generarNombreUnico($_FILES['logo3']['name']);
            move_uploaded_file($logo_temporal3, $carpeta_guardado . $logo_nombre3);
        }

        if (!empty($logo_temporal4)) {
            $logo_nombre4 = generarNombreUnico($_FILES['logo4']['name']);
            move_uploaded_file($logo_temporal4, $carpeta_guardado . $logo_nombre4);
        }

        // Realizar la consulta de inserción
        $consulta = "INSERT INTO producto(id_pedido, id_tipo_producto, cant_prendas, cant_tallas, id_cargo, id_prenda, id_prendacomprada, id_tela, id_telacombi, id_telaforro, color_tela, color_telacombi, color_telaforro, 
                mangas, cuello, puño, pretina, fajon, boton, cremallera, ubica_combi, ubica_reflectivos, logo, id_tipo_logo, id_bolsillo, cant_bolsillos, id_bolsillocombinado, cant_bolsilloscombinado, id_bolsillocombinado2, cant_bolsilloscombinado2, id_tablon, id_cartera, observaciones, imagen, imagen2, imagen3, imagen4, logo1, logo2, logo3, logo4, consumo_telas, margen_bruto, valor_agregado, valor_porcentajeestampilla, id_entrega)
                VALUES ('$id_pedido', '$id_tipo_producto', '$cant_prendas', '$cant_tallas', '$id_cargo', '$id_prenda', '$id_prendacomprada', '$id_tela', '$id_telacombi', '$id_telaforro', '$color_tela', '$color_telacombi', '$color_telaforro', 
                '$mangas', '$cuello', '$puño', '$pretina', '$fajon', '$boton', '$cremallera', '$ubica_combi', '$ubica_reflectivos', '$logo', '$id_tipo_logo','$id_bolsillo','$cant_bolsillos','$id_bolsillocombinado','$cant_bolsilloscombinado','$id_bolsillocombinado2','$cant_bolsilloscombinado2','$id_tablon','$id_cartera','$observaciones','$imagen_nombre','$imagen_nombre2','$imagen_nombre3','$imagen_nombre4',
                '$logo_nombre1','$logo_nombre2','$logo_nombre3','$logo_nombre4','$consumo_telas','$margen_bruto','$valor_agregado','$valor_porcentajeestampilla','$id_entrega')";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['duplicar_prenda'])) {

        $id_producto = $_POST['id_producto'];
        $id_tipo_producto = $_POST['id_tipo_producto'];
        $id_entrega = $_POST['id_entrega'];
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : null;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : null;
        $id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
        $id_prenda = isset($_POST['id_prenda']) ? $_POST['id_prenda'] : null;
        $id_prendacomprada = isset($_POST['id_prendacomprada']) ? $_POST['id_prendacomprada'] : null;
        $id_tela = isset($_POST['id_tela']) ? $_POST['id_tela'] : null;
        $id_telacombi = isset($_POST['id_telacombi']) ? $_POST['id_telacombi'] : null;
        $id_telaforro = isset($_POST['id_telaforro']) ? $_POST['id_telaforro'] : null;
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : null;
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : null;
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : null;
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : null;
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : null;
        $puño = isset($_POST['puño']) ? $_POST['puño'] : null;
        $pretina = isset($_POST['pretina']) ? $_POST['pretina'] : null;
        $fajon = isset($_POST['fajon']) ? $_POST['fajon'] : null;
        $boton = isset($_POST['boton']) ? $_POST['boton'] : null;
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : null;
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : null;
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : null;
        $logo = isset($_POST['logo']) ? $_POST['logo'] : null;
        $id_tipo_logo = isset($_POST['id_tipo_logo']) ? $_POST['id_tipo_logo'] : null;
        $id_bolsillo = isset($_POST['id_bolsillo']) ? $_POST['id_bolsillo'] : null;
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : null;
        $id_bolsillocombinado = isset($_POST['id_bolsillocombinado']) ? $_POST['id_bolsillocombinado'] : null;
        $cant_bolsilloscombinado = isset($_POST['cant_bolsilloscombinado']) ? $_POST['cant_bolsilloscombinado'] : null;
        $id_bolsillocombinado2 = isset($_POST['id_bolsillocombinado2']) ? $_POST['id_bolsillocombinado2'] : null;
        $cant_bolsilloscombinado2 = isset($_POST['cant_bolsilloscombinado2']) ? $_POST['cant_bolsilloscombinado2'] : null;
        $id_tablon = isset($_POST['id_tablon']) ? $_POST['id_tablon'] : null;
        $id_cartera = isset($_POST['id_cartera']) ? $_POST['id_cartera'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $valor_agregado = isset($_POST['valor_agregado']) ? $_POST['valor_agregado'] : null;

        // Imagenes
        if ($_POST['eliminar_imagen'] == '1') {
            $imagen_nombre = NULL;
        } elseif (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen_nombre = generarNombreUnico($_FILES['imagen']['name']);
            move_uploaded_file($_FILES['imagen']['tmp_name'], "../../img/pedidos/" . $imagen_nombre);
        } else {
            $imagen_nombre = $_POST['imagen_actual'];
        }

        if ($_POST['eliminar_imagen2'] == '1') {
            $imagen_nombre2 = NULL;
        } elseif (!empty($_FILES['imagen2']['tmp_name'])) {
            $imagen_nombre2 = generarNombreUnico($_FILES['imagen2']['name']);
            move_uploaded_file($_FILES['imagen2']['tmp_name'], "../../img/pedidos/" . $imagen_nombre2);
        } else {
            $imagen_nombre2 = $_POST['imagen_actual2'];
        }

        if ($_POST['eliminar_imagen3'] == '1') {
            $imagen_nombre3 = NULL;
        } elseif (!empty($_FILES['imagen3']['tmp_name'])) {
            $imagen_nombre3 = generarNombreUnico($_FILES['imagen3']['name']);
            move_uploaded_file($_FILES['imagen3']['tmp_name'], "../../img/pedidos/" . $imagen_nombre3);
        } else {
            $imagen_nombre3 = $_POST['imagen_actual3'];
        }

        if ($_POST['eliminar_imagen4'] == '1') {
            $imagen_nombre4 = NULL;
        } elseif (!empty($_FILES['imagen4']['tmp_name'])) {
            $imagen_nombre4 = generarNombreUnico($_FILES['imagen4']['name']);
            move_uploaded_file($_FILES['imagen4']['tmp_name'], "../../img/pedidos/" . $imagen_nombre4);
        } else {
            $imagen_nombre4 = $_POST['imagen_actual4'];
        }

        // Logos
        if ($_POST['eliminar_logo1'] == '1') {
            if (!empty($_POST['logo_actual1']) && file_exists("../../logos_empresas/" . $_POST['logo_actual1'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual1']);
            }
            $logo_nombre1 = NULL;
        } elseif (!empty($_FILES['logo1']['tmp_name'])) {
            $logo_nombre1 = generarNombreUnico($_FILES['logo1']['name']);
            move_uploaded_file($_FILES['logo1']['tmp_name'], "../../logos_empresas/" . $logo_nombre1);
        } else {
            $logo_nombre1 = $_POST['logo_actual1'];
        }

        if ($_POST['eliminar_logo2'] == '1') {
            if (!empty($_POST['logo_actual2']) && file_exists("../../logos_empresas/" . $_POST['logo_actual2'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual2']);
            }
            $logo_nombre2 = NULL;
        } elseif (!empty($_FILES['logo2']['tmp_name'])) {
            $logo_nombre2 = generarNombreUnico($_FILES['logo2']['name']);
            move_uploaded_file($_FILES['logo2']['tmp_name'], "../../logos_empresas/" . $logo_nombre2);
        } else {
            $logo_nombre2 = $_POST['logo_actual2'];
        }

        if ($_POST['eliminar_logo3'] == '1') {
            if (!empty($_POST['logo_actual3']) && file_exists("../../logos_empresas/" . $_POST['logo_actual3'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual3']);
            }
            $logo_nombre3 = NULL;
        } elseif (!empty($_FILES['logo3']['tmp_name'])) {
            $logo_nombre3 = generarNombreUnico($_FILES['logo3']['name']);
            move_uploaded_file($_FILES['logo3']['tmp_name'], "../../logos_empresas/" . $logo_nombre3);
        } else {
            $logo_nombre3 = $_POST['logo_actual3'];
        }

        if ($_POST['eliminar_logo4'] == '1') {
            if (!empty($_POST['logo_actual4']) && file_exists("../../logos_empresas/" . $_POST['logo_actual4'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual4']);
            }
            $logo_nombre4 = NULL;
        } elseif (!empty($_FILES['logo4']['tmp_name'])) {
            $logo_nombre4 = generarNombreUnico($_FILES['logo4']['name']);
            move_uploaded_file($_FILES['logo4']['tmp_name'], "../../logos_empresas/" . $logo_nombre4);
        } else {
            $logo_nombre4 = $_POST['logo_actual4'];
        }

        // Realizar la consulta de inserción
        $consulta = "INSERT INTO producto(id_pedido, id_tipo_producto, cant_prendas, cant_tallas, id_cargo, id_prenda, id_prendacomprada, id_tela, id_telacombi, id_telaforro, color_tela, color_telacombi, color_telaforro, 
                mangas, cuello, puño, pretina, fajon, boton, cremallera, ubica_combi, ubica_reflectivos, logo, id_tipo_logo, id_bolsillo, cant_bolsillos, id_bolsillocombinado, cant_bolsilloscombinado, id_bolsillocombinado2, cant_bolsilloscombinado2, id_tablon, id_cartera, observaciones, imagen, imagen2, imagen3, imagen4, logo1, logo2, logo3, logo4, consumo_telas, margen_bruto, valor_agregado, valor_porcentajeestampilla, id_entrega)
                VALUES ('$id_pedido', '$id_tipo_producto', '$cant_prendas', '$cant_tallas', '$id_cargo', '$id_prenda', '$id_prendacomprada', '$id_tela', '$id_telacombi', '$id_telaforro', '$color_tela', '$color_telacombi', '$color_telaforro', 
                '$mangas', '$cuello', '$puño', '$pretina', '$fajon', '$boton', '$cremallera', '$ubica_combi', '$ubica_reflectivos', '$logo', '$id_tipo_logo','$id_bolsillo','$cant_bolsillos','$id_bolsillocombinado','$cant_bolsilloscombinado','$id_bolsillocombinado2','$cant_bolsilloscombinado2','$id_tablon','$id_cartera','$observaciones','$imagen_nombre','$imagen_nombre2','$imagen_nombre3','$imagen_nombre4',
                '$logo_nombre1','$logo_nombre2','$logo_nombre3','$logo_nombre4','$consumo_telas','$margen_bruto','$valor_agregado','$valor_porcentajeestampilla','$id_entrega')";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['submit_editar'])) {

        $id_producto = $_POST['id_producto'];
        $id_tipo_producto = $_POST['id_tipo_producto'];
        $id_entrega = $_POST['id_entrega'];
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : null;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : null;
        $id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
        $id_prenda = isset($_POST['id_prenda']) ? $_POST['id_prenda'] : null;
        $id_prendacomprada = isset($_POST['id_prendacomprada']) ? $_POST['id_prendacomprada'] : null;
        $id_tela = isset($_POST['id_tela']) ? $_POST['id_tela'] : null;
        $id_telacombi = isset($_POST['id_telacombi']) ? $_POST['id_telacombi'] : null;
        $id_telaforro = isset($_POST['id_telaforro']) ? $_POST['id_telaforro'] : null;
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : null;
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : null;
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : null;
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : null;
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : null;
        $puño = isset($_POST['puño']) ? $_POST['puño'] : null;
        $pretina = isset($_POST['pretina']) ? $_POST['pretina'] : null;
        $fajon = isset($_POST['fajon']) ? $_POST['fajon'] : null;
        $boton = isset($_POST['boton']) ? $_POST['boton'] : null;
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : null;
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : null;
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : null;
        $logo = isset($_POST['logo']) ? $_POST['logo'] : null;
        $id_tipo_logo = isset($_POST['id_tipo_logo']) ? $_POST['id_tipo_logo'] : null;
        $id_bolsillo = isset($_POST['id_bolsillo']) ? $_POST['id_bolsillo'] : null;
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : null;
        $id_bolsillocombinado = isset($_POST['id_bolsillocombinado']) ? $_POST['id_bolsillocombinado'] : null;
        $cant_bolsilloscombinado = isset($_POST['cant_bolsilloscombinado']) ? $_POST['cant_bolsilloscombinado'] : null;
        $id_bolsillocombinado2 = isset($_POST['id_bolsillocombinado2']) ? $_POST['id_bolsillocombinado2'] : null;
        $cant_bolsilloscombinado2 = isset($_POST['cant_bolsilloscombinado2']) ? $_POST['cant_bolsilloscombinado2'] : null;
        $id_tablon = isset($_POST['id_tablon']) ? $_POST['id_tablon'] : null;
        $id_cartera = isset($_POST['id_cartera']) ? $_POST['id_cartera'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $valor_agregado = isset($_POST['valor_agregado']) ? $_POST['valor_agregado'] : null;

        // Imagenes
        if ($_POST['eliminar_imagen'] == '1') {
            $imagen_nombre = NULL;
        } elseif (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen_nombre = generarNombreUnico($_FILES['imagen']['name']);
            move_uploaded_file($_FILES['imagen']['tmp_name'], "../../img/pedidos/" . $imagen_nombre);
        } else {
            $imagen_nombre = $_POST['imagen_actual'];
        }

        if ($_POST['eliminar_imagen2'] == '1') {
            $imagen_nombre2 = NULL;
        } elseif (!empty($_FILES['imagen2']['tmp_name'])) {
            $imagen_nombre2 = generarNombreUnico($_FILES['imagen2']['name']);
            move_uploaded_file($_FILES['imagen2']['tmp_name'], "../../img/pedidos/" . $imagen_nombre2);
        } else {
            $imagen_nombre2 = $_POST['imagen_actual2'];
        }

        if ($_POST['eliminar_imagen3'] == '1') {
            $imagen_nombre3 = NULL;
        } elseif (!empty($_FILES['imagen3']['tmp_name'])) {
            $imagen_nombre3 = generarNombreUnico($_FILES['imagen3']['name']);
            move_uploaded_file($_FILES['imagen3']['tmp_name'], "../../img/pedidos/" . $imagen_nombre3);
        } else {
            $imagen_nombre3 = $_POST['imagen_actual3'];
        }

        if ($_POST['eliminar_imagen4'] == '1') {
            $imagen_nombre4 = NULL;
        } elseif (!empty($_FILES['imagen4']['tmp_name'])) {
            $imagen_nombre4 = generarNombreUnico($_FILES['imagen4']['name']);
            move_uploaded_file($_FILES['imagen4']['tmp_name'], "../../img/pedidos/" . $imagen_nombre4);
        } else {
            $imagen_nombre4 = $_POST['imagen_actual4'];
        }

        // Logos
        if ($_POST['eliminar_logo1'] == '1') {
            if (!empty($_POST['logo_actual1']) && file_exists("../../logos_empresas/" . $_POST['logo_actual1'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual1']);
            }
            $logo_nombre1 = NULL;
        } elseif (!empty($_FILES['logo1']['tmp_name'])) {
            $logo_nombre1 = generarNombreUnico($_FILES['logo1']['name']);
            move_uploaded_file($_FILES['logo1']['tmp_name'], "../../logos_empresas/" . $logo_nombre1);
        } else {
            $logo_nombre1 = $_POST['logo_actual1'];
        }

        if ($_POST['eliminar_logo2'] == '1') {
            if (!empty($_POST['logo_actual2']) && file_exists("../../logos_empresas/" . $_POST['logo_actual2'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual2']);
            }
            $logo_nombre2 = NULL;
        } elseif (!empty($_FILES['logo2']['tmp_name'])) {
            $logo_nombre2 = generarNombreUnico($_FILES['logo2']['name']);
            move_uploaded_file($_FILES['logo2']['tmp_name'], "../../logos_empresas/" . $logo_nombre2);
        } else {
            $logo_nombre2 = $_POST['logo_actual2'];
        }

        if ($_POST['eliminar_logo3'] == '1') {
            if (!empty($_POST['logo_actual3']) && file_exists("../../logos_empresas/" . $_POST['logo_actual3'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual3']);
            }
            $logo_nombre3 = NULL;
        } elseif (!empty($_FILES['logo3']['tmp_name'])) {
            $logo_nombre3 = generarNombreUnico($_FILES['logo3']['name']);
            move_uploaded_file($_FILES['logo3']['tmp_name'], "../../logos_empresas/" . $logo_nombre3);
        } else {
            $logo_nombre3 = $_POST['logo_actual3'];
        }

        if ($_POST['eliminar_logo4'] == '1') {
            if (!empty($_POST['logo_actual4']) && file_exists("../../logos_empresas/" . $_POST['logo_actual4'])) {
                unlink("../../logos_empresas/" . $_POST['logo_actual4']);
            }
            $logo_nombre4 = NULL;
        } elseif (!empty($_FILES['logo4']['tmp_name'])) {
            $logo_nombre4 = generarNombreUnico($_FILES['logo4']['name']);
            move_uploaded_file($_FILES['logo4']['tmp_name'], "../../logos_empresas/" . $logo_nombre4);
        } else {
            $logo_nombre4 = $_POST['logo_actual4'];
        }

        // Realizar la consulta pa aeditar
        $consulta = "UPDATE producto SET id_pedido='$id_pedido', id_tipo_producto='$id_tipo_producto', cant_prendas='$cant_prendas', cant_tallas='$cant_tallas', id_cargo='$id_cargo', id_prenda='$id_prenda', id_prendacomprada='$id_prendacomprada', 
                    id_tela='$id_tela', id_telacombi='$id_telacombi', id_telaforro='$id_telaforro', color_tela='$color_tela', color_telacombi='$color_telacombi', color_telaforro='$color_telaforro', 
                    mangas='$mangas', cuello='$cuello', puño='$puño', pretina='$pretina', fajon='$fajon', boton='$boton', cremallera='$cremallera', ubica_combi='$ubica_combi', ubica_reflectivos='$ubica_reflectivos', 
                    logo='$logo', id_tipo_logo='$id_tipo_logo', id_bolsillo='$id_bolsillo', cant_bolsillos='$cant_bolsillos', id_bolsillocombinado='$id_bolsillocombinado', cant_bolsilloscombinado='$cant_bolsilloscombinado', id_bolsillocombinado2='$id_bolsillocombinado2', cant_bolsilloscombinado2='$cant_bolsilloscombinado2', id_tablon='$id_tablon', id_cartera='$id_cartera', observaciones='$observaciones', valor_agregado='$valor_agregado',
                    imagen='$imagen_nombre', imagen2='$imagen_nombre2', imagen3='$imagen_nombre3', imagen4='$imagen_nombre4', logo1='$logo_nombre1', logo2='$logo_nombre2', logo3='$logo_nombre3', logo4='$logo_nombre4', id_entrega='$id_entrega' WHERE id_producto='$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM producto WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['submit_activar'])) {
        $consulta = "UPDATE pedido SET estado = 'Espera' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitudes.php?id_pedido=$id_pedido&nit=$nit");
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

        <!-- Para los estilos -->
        <link rel="stylesheet" href="../../css/barra.css">
        <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/estilo_base.css">
        <link rel="icon" type="image/png" href="../../img/Logo.png">
        <style>
            /* Estilo general */
            .btn-lg {
                font-size: 0.9rem;
                padding: 10px 15px;
            }

            .btn {
                border-radius: 15px;
                font-weight: 500;
                letter-spacing: 0.3px;
                transition: all 0.3s ease;
                box-shadow: 0 6px 15px rgba(0,0,0,0.12);
            }

            .btn:hover {
                color: #ffffff !important;
                text-shadow: 0 1px 4px rgba(0,0,0,0.7);
            }

            /* Colores principales */
            .btn-yellow {
                background: linear-gradient(135deg, #faa700, #fce38a);
                color: #fff;
            }

            .btn-blue {
                background: linear-gradient(135deg, #006ac1, #6ab8f8);
                color: #fff;
            }

            .btn-red {
                background: linear-gradient(135deg, #f60400, #fa7171);
                color: #fff;
            }

            /* Nuevos colores modernos */
            .btn-teal {
                background: linear-gradient(135deg, #018578, #4db6ac);
                color: #fff;
            }

            .btn-purple {
                background: linear-gradient(135deg, #6e4bac, #b39ddb);
                color: #fff;
            }

            .btn-orange {
                background: linear-gradient(135deg, #fb8c00, #ffc369);
                color: #fff;
            }

            /* Reemplazo del gris opaco */
            .btn-cyan {
                background: linear-gradient(135deg, #00acc1, #69e5f6);
                color: #fff;
            }

            /* Reemplazo del negro opaco */
            .btn-dark-modern {
                background: linear-gradient(135deg, #202a2f, #5a737f);
                color: #fff;
            }

            /* Móvil: botones bien proporcionados */
            @media (max-width: 576px) {
                .btn-lg {
                    font-size: 0.9rem;
                    padding: 10px 15px;
                }
            }
        </style>
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
        <title>Comercial | Solicitud de Pedido</title>
    <head>
    
    <body style="display: flex; flex-direction: column; min-height: 100vh;">
        <?php
        $consulta = "SELECT id_usuario FROM usuario ";
        ?>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="../../img/Logo.png" alt="Logo" width="70" height="50" class="rounded img-fluid d-inline-block align-text-top">
                </a>
                <a href="solicitudes.php?id_usuario=<?php echo $id_usuario; ?>" class="btn active btn-primary" style="margin-left: 10px;">
                    <i class="bi bi-arrow-bar-left"></i> Volver
                </a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Elija una prenda para agregar</h1>
            <br>
            <?php
            $consulta_entrega = "SELECT id_entrega FROM pedido ";
            ?>
            <div class="row justify-content-center g-3">
                <div class="col-6 col-md-auto">
                    <button class="btn btn-yellow w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalSupHombre">
                        Superiores Hombre
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-blue w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalSupMujer">
                        Superiores Mujer
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-red w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalInfHombre">
                        Inferiores Hombre
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-teal w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalInfMujer">
                        Inferiores Mujer
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-purple w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalChaqueta">
                        Chaquetas
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-orange w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalOverol">
                        Overoles
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-cyan w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalOtros">
                        Otras Prendas
                    </button>
                </div>

                <div class="col-6 col-md-auto">
                    <button class="btn btn-dark-modern w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalComprados">
                        Compradas a Externos
                    </button>
                </div>
            </div>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <?php
        $consulta_estado = "SELECT pedido.id_pedido FROM pedido";
        $resultado_estado = mysqli_query($enlace, $consulta_estado);
        $fila_estado = mysqli_fetch_array($resultado_estado);
        ?>
        <div class="text-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalActivar<?php echo $fila_estado['id_pedido']; ?>">
                <i class="bi bi-check-lg"></i> Enviar a Cotizar
            </button>
        </div>
        <br>

        <?php
        $consulta = "SELECT pedido.id_pedido, producto.id_producto, producto.cant_tallas, producto.cant_prendas, cargo.id_cargo, cargo.cargo, prenda.id_prenda, prenda.nombre_prenda, prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto, 
                        bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, producto.cant_bolsillos, bolsillo_combinado.id_bolsillocombinado, bolsillo_combinado.tipo_bolsillocombinado, producto.cant_bolsilloscombinado, bolsillo_combinado2.id_bolsillocombinado2, bolsillo_combinado2.tipo_bolsillocombinado2, producto.cant_bolsilloscombinado2,
                        tela.id_tela, tela.tela, tela.ancho AS ancho_tela, tela.peso AS peso_tela, tela.caracteristicas, tela.rendimiento, tela.encogimiento, producto.color_tela, producto.valor_agregado,
                        tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.ancho AS ancho_telacombi, tela_combinada.peso AS peso_telacombi, tela_combinada.caracteristicas AS caract_telacombi, tela_combinada.rendimiento AS rend_telacombi, tela_combinada.encogimiento AS encog_telacombi, producto.color_telacombi,
                        tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.ancho AS ancho_forro, tela_forro.peso AS peso_forro, tela_forro.caracteristicas AS caract_forro, tela_forro.rendimiento AS rend_forro, tela_forro.encogimiento AS encog_forro, producto.color_telaforro,
                        producto.mangas, producto.cuello, producto.puño, producto.pretina, producto.fajon, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.logo, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon, cartera.id_cartera, cartera.tipo_cartera, producto.observaciones,
                        producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, entrega.id_entrega, entrega.tipo_entrega, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda 
                        
                        FROM producto
                        LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                        LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda
                        LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada
                        LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                        LEFT JOIN entrega ON pedido.id_entrega = entrega.id_entrega
                        LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto
                        LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo 
                        LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon
                        LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera
                        LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo
                        LEFT JOIN bolsillo ON producto.id_bolsillo = bolsillo.id_bolsillo
                        LEFT JOIN bolsillo_combinado ON producto.id_bolsillocombinado = bolsillo_combinado.id_bolsillocombinado
                        LEFT JOIN bolsillo_combinado2 ON producto.id_bolsillocombinado2 = bolsillo_combinado2.id_bolsillocombinado2
                        LEFT JOIN tela ON producto.id_tela = tela.id_tela
                        LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi
                        LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro
                        WHERE pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        include('modales_solicitar_pedido.php');
        ?>

        <!-- Productos -->
        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="modal-content rounded-4 modal-fullscreen">
                            <?php if ($fila['id_prenda'] != 0): ?>
                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">
                                        Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?>
                                    </h5>
                                </div>
                            <?php else: ?>
                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">
                                        Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?>
                                    </h5>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <!-- Mostrar imagenes -->
                                <div>
                                    <?php
                                    $imagenes = [
                                        1 => $fila['imagen'],
                                        2 => $fila['imagen2'],
                                        3 => $fila['imagen3'],
                                        4 => $fila['imagen4']
                                    ];

                                    $hayImagenes = array_filter($imagenes);
                                    ?>

                                    <?php if (!empty($hayImagenes)): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-2">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes de Guía</h6>
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <?php foreach ($imagenes as $num => $img): ?>
                                                    <?php if (!empty($img)): ?>
                                                        <?php $idModal = "modalImagenProducto{$num}_" . md5($img); ?>
                                                        <div class="text-center">
                                                            <img src="../../img/pedidos/<?= $img ?>"
                                                                class="img-thumbnail shadow-sm img-hover"
                                                                style="width:110px;height:110px;object-fit:cover;cursor:pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#<?= $idModal ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <!-- Modales -->
                                    <?php foreach ($imagenes as $num => $img): ?>
                                        <?php if (!empty($img)): ?>
                                            <?php $idModal = "modalImagenProducto{$num}_" . md5($img); ?>
                                            <div class="modal fade" id="<?= $idModal ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content shadow-lg rounded-4 border-0">
                                                        <div class="modal-header py-2 border-0">
                                                            <span class="fw-semibold text-muted small">Vista previa</span>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center p-3">
                                                            <img src="../../img/pedidos/<?= $img ?>" class="img-modal-preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Mostrar logos -->
                                <div>
                                    <?php
                                    $logoProducto1 = $fila['logo1'];
                                    $logoProducto2 = $fila['logo2'];
                                    $logoProducto3 = $fila['logo3'];
                                    $logoProducto4 = $fila['logo4'];

                                    if (!function_exists('displayFile')) {
                                        function displayFile($file)
                                        {
                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                            $fileName = basename($file);
                                            if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                echo '<a href="../../logos_empresas/' . $file . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                            } else {
                                                echo '<a href="../../logos_empresas/' . $file . '" target="_blank" download class="d-block mx-1 mb-2">
                                                                                <img src="../../logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
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
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
                                        <div class="row mb-1">
                                            <?php if (!empty($fila['cant_prendas'])): ?>
                                                <div class="col">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['cant_prendas'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['cant_tallas'])): ?>
                                                <div class="col">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_producto'] ?></p>
                                        </div>
                                        <div>
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                        </div>
                                        <?php if (!empty($fila['id_cargo'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_tela'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['tela'] ?>
                                                    <?= !empty($fila['ancho_tela']) ? " Ancho " . $fila['ancho_tela'] : "" ?>
                                                    <?= !empty($fila['peso_tela']) ? " Peso " . $fila['peso_tela'] : "" ?>
                                                    <?= !empty($fila['caracteristicas']) ? "," . $fila['caracteristicas'] : "" ?>
                                                    <?= !empty($fila['rendimiento']) ? " Rendimiento " . $fila['rendimiento'] : "" ?>
                                                    <?= !empty($fila['encogimiento']) ? " Encogimiento " . $fila['encogimiento'] : "" ?>
                                                    <?= !empty($fila['color_tela']) ? " Color " . $fila['color_tela'] : "" ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_telacombi'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Tela Combinada:</span> <?= $fila['tela_combi'] ?>
                                                    <?= !empty($fila['ancho_telacombi']) ? " Ancho " . $fila['ancho_telacombi'] : "" ?>
                                                    <?= !empty($fila['peso_telacombi']) ? " Peso " . $fila['peso_telacombi'] : "" ?>
                                                    <?= !empty($fila['caract_telacombi']) ? "," . $fila['caract_telacombi'] : "" ?>
                                                    <?= !empty($fila['rend_telacombi']) ? " Rendimiento " . $fila['rend_telacombi'] : "" ?>
                                                    <?= !empty($fila['encog_telacombi']) ? " Encogimiento " . $fila['encog_telacombi'] : "" ?>
                                                    <?= !empty($fila['color_telacombi']) ? " Color " . $fila['color_telacombi'] : "" ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_telaforro'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Tela Forro:</span> <?= $fila['tela_forro'] ?>
                                                    <?= !empty($fila['ancho_forro']) ? " Ancho " . $fila['ancho_forro'] : "" ?>
                                                    <?= !empty($fila['peso_forro']) ? " Peso " . $fila['peso_forro'] : "" ?>
                                                    <?= !empty($fila['caract_forro']) ? "," . $fila['caract_forro'] : "" ?>
                                                    <?= !empty($fila['rend_forro']) ? " Rendimiento " . $fila['rend_forro'] : "" ?>
                                                    <?= !empty($fila['encog_forro']) ? " Encogimiento " . $fila['encog_forro'] : "" ?>
                                                    <?= !empty($fila['color_telaforro']) ? " Color " . $fila['color_telaforro'] : "" ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['mangas'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Mangas:</span> <?= $fila['mangas'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cuello'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cuello:</span> <?= $fila['cuello'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['puño'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Puño:</span> <?= $fila['puño'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['pretina'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Pretina:</span> <?= $fila['pretina'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['fajon'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Fajon:</span> <?= $fila['fajon'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['boton'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Boton:</span> <?= $fila['boton'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cremallera'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cremallera:</span> <?= $fila['cremallera'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_combi'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Combinados:</span> <?= $fila['ubica_combi'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_reflectivos'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Reflectivos:</span> <?= $fila['ubica_reflectivos'] ?></p>
                                            </div>
                                        <?php endif; ?>
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
                                        <?php if (isset($fila['id_bolsillo'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                    <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                    <?= $fila['tipo_bolsillo'] ?>
                                                    
                                                    <?php if ($fila['id_bolsillo'] != 0): ?>
                                                        - Cantidad <?= $fila['cant_bolsillos'] ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($fila['id_bolsillocombinado'] != 0): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                    <span class="font-weight-bold">Tipo de Bolsillo Combinado: </span><?= $fila['tipo_bolsillocombinado'] ?> - Cantidad <?= $fila['cant_bolsilloscombinado'] ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($fila['id_bolsillocombinado2'] != 0): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                    <span class="font-weight-bold">Tipo de Bolsillo Combinado dos: </span><?= $fila['tipo_bolsillocombinado2'] ?> - Cantidad <?= $fila['cant_bolsilloscombinado2'] ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['valor_agregado'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Valor Agregado al Producto:</span> <?= $fila['valor_agregado'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_tablon'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_cartera'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($fila['observaciones'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="text-center align-middle">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>">
                                            <i class="bi bi-pencil-square"></i> Editar Datos de la Prenda
                                        </button>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Duplicar<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>">
                                            <i class="bi bi-front"></i> Duplicar Prenda
                                        </button>
                                        <?php if ($fila['id_prenda'] != 0): ?>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Eliminar<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-trash-fill"></i> Eliminar la Prenda
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarEx<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-trash-fill"></i> Eliminar la Prenda
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $contador_producto++; // Incrementar contador de productos
                } ?>
            </div>
        </div>

        <!-- Modales eliminar y editar-->
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
        ?>

            <!-- Pasar a cotizar -->
            <div class="modal fade" id="modalActivar<?php echo $fila_estado['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                Si oprime continuar el pedido pasara a ser Costeado.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_pedido" value="<?php echo $fila_estado['id_pedido']; ?>">
                                <button type="submit" name="submit_activar" class="btn btn-success">continuar</button>
                            </form>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Eliminar -->
            <div class="modal fade" id="Eliminar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar el siguiente Producto: <?php echo $fila['nombre_prenda']; ?>?</h5>
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

            <!-- Modal Eliminar Externos -->
            <div class="modal fade" id="EliminarEx<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar el siguiente Producto: <?php echo $fila['nombre_producto']; ?>?</h5>
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

            <!-- Modales Editar -->
            <div class="modal fade" id="Editar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a editar</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="id_tipo_producto" value="<?php echo $fila['id_tipo_producto']; ?>">
                                <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                                <input type="hidden" name="imagen_actual" value="<?php echo $fila['imagen']; ?>">
                                <input type="hidden" name="imagen_actual2" value="<?php echo $fila['imagen2']; ?>">
                                <input type="hidden" name="imagen_actual3" value="<?php echo $fila['imagen3']; ?>">
                                <input type="hidden" name="imagen_actual4" value="<?php echo $fila['imagen4']; ?>">
                                <input type="hidden" name="logo_actual1" value="<?php echo $fila['logo1']; ?>">
                                <input type="hidden" name="logo_actual2" value="<?php echo $fila['logo2']; ?>">
                                <input type="hidden" name="logo_actual3" value="<?php echo $fila['logo3']; ?>">
                                <input type="hidden" name="logo_actual4" value="<?php echo $fila['logo4']; ?>">

                                <!-- Modal Editar Superior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 1): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 1 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Superior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 2): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 2 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Inferior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 3): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 3';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo Boton y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Inferior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 4): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 4';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo Boton y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Chaqueta -->
                                <?php if ($fila['id_tipo_producto'] == 5): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 5';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el fajon:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="fajon" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['fajon']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                   
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Overol -->
                                <?php if ($fila['id_tipo_producto'] == 6): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 6';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Otros -->
                                <?php if ($fila['id_tipo_producto'] == 7): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 7';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el fajon:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="fajon" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['fajon']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Compra Externa -->
                                <?php if ($fila['id_tipo_producto'] == 8): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prendacomprada" class="form-select" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto FROM prenda_comprada ORDER BY prenda_comprada.nombre_producto ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);

                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prendacomprada"];
                                                $nombre = $lista["nombre_producto"];
                                                $selected = ($nombre == $fila['nombre_producto']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label" style="color: #000000;">Valor agregado a la Prenda:</label>
                                            <textarea class="form-control" name="valor_agregado" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['valor_agregado']; ?></textarea>
                                        </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modales Duplicar -->
            <div class="modal fade" id="Duplicar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Modal para duplicar Prenda</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="id_tipo_producto" value="<?php echo $fila['id_tipo_producto']; ?>">
                                <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                                <input type="hidden" name="imagen_actual" value="<?php echo $fila['imagen']; ?>">
                                <input type="hidden" name="imagen_actual2" value="<?php echo $fila['imagen2']; ?>">
                                <input type="hidden" name="imagen_actual3" value="<?php echo $fila['imagen3']; ?>">
                                <input type="hidden" name="imagen_actual4" value="<?php echo $fila['imagen4']; ?>">
                                <input type="hidden" name="logo_actual1" value="<?php echo $fila['logo1']; ?>">
                                <input type="hidden" name="logo_actual2" value="<?php echo $fila['logo2']; ?>">
                                <input type="hidden" name="logo_actual3" value="<?php echo $fila['logo3']; ?>">
                                <input type="hidden" name="logo_actual4" value="<?php echo $fila['logo4']; ?>">

                                <!-- Modal Editar Superior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 1): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 1 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Superior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 2): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 2 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Inferior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 3): ?>
                                    <input type="hidden" name="id_tablon" value="0">
                                    <input type="hidden" name="id_cartera" value="0">

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 3';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo Boton y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Inferior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 4): ?>
                                    <input type="hidden" name="id_tablon" value="0">
                                    <input type="hidden" name="id_cartera" value="0">

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 4';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo Boton y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Chaqueta -->
                                <?php if ($fila['id_tipo_producto'] == 5): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 5';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el fajon:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="fajon" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['fajon']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción"name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Overol -->
                                <?php if ($fila['id_tipo_producto'] == 6): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 6';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                   
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Otros -->
                                <?php if ($fila['id_tipo_producto'] == 7): ?>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                                FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                                WHERE prenda.id_tipo_prenda = 7';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tela -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                            <!-- Combobox visible -->
                                            <input type="text" class="form-control comboTela" placeholder="Buscar tela..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_tela" class="form-select d-none selectTela">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, tela.precio, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                        FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.precio > 0 OR tela.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tela"];
                                                    $nombre = $lista["tela"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela combinada -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Combinada:</label>

                                            <!-- Combobox input visible -->
                                            <input type="text" class="form-control comboTelaCombi" placeholder="Buscar tela combinada..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaCombiList"></div>

                                            <!-- Select original oculto -->
                                            <select name="id_telacombi" class="form-select d-none selectTelaCombi">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.precio > 0 OR tela_combinada.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telacombi"];
                                                    $nombre = $lista["tela_combi"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <!-- Tela Forro -->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 position-relative">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Tela Forro:</label>

                                            <!-- Input de búsqueda -->
                                            <input type="text" class="form-control comboTelaForro" placeholder="Buscar tela forro..." autocomplete="off">
                                            <div class="combobox-list list-group comboTelaForroList"></div>

                                            <!-- Select oculto -->
                                            <select name="id_telaforro" class="form-select d-none selectTelaForro">
                                                <option value="0" selected>Sin seleccionar</option>
                                                <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.precio > 0 OR tela_forro.id_tipo_tela = 0';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_telaforro"];
                                                    $nombre = $lista["tela_forro"];
                                                    if (!empty($lista["ancho"])) $nombre .= " Ancho " . $lista["ancho"];
                                                    if (!empty($lista["peso"])) $nombre .= " Peso " . $lista["peso"];
                                                    if (!empty($lista["rendimiento"])) $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                    if (!empty($lista["encogimiento"])) $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                    if (!empty($lista["caracteristicas"])) $nombre .= " , " . $lista["caracteristicas"];
                                                    $proveedor = $lista["nombre"];
                                                    $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre - $proveedor</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" placeholder="Ingresa una descripción"name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <!---->

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre las Mangas:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Cuello:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Puño:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre la Pretina:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el fajon:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="fajon" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['fajon']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Botón y Color:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones sobre el Tipo de Cremallera:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de los Insumos Combinados:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion de reflectivos:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                            <select name="id_bolsillo" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillo"];
                                                    $nombre = $lista["tipo_bolsillo"];
                                                    $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsillos" value="<?php echo isset($fila['cant_bolsillos']) && $fila['cant_bolsillos'] !== '' ? $fila['cant_bolsillos'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado:</label>
                                            <select name="id_bolsillocombinado" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado"];
                                                    $nombre = $lista["tipo_bolsillocombinado"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado" value="<?php echo isset($fila['cant_bolsilloscombinado']) && $fila['cant_bolsilloscombinado'] !== '' ? $fila['cant_bolsilloscombinado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo Combinado Dos:</label>
                                            <select name="id_bolsillocombinado2" class="form-select">
                                                <?php $consulta_mysql = 'SELECT * from bolsillo_combinado2';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_bolsillocombinado2"];
                                                    $nombre = $lista["tipo_bolsillocombinado2"];
                                                    $selected = ($nombre == $fila['tipo_bolsillocombinado2']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Bolsillos Combinados Dos:</label>
                                            <input type="number" step="any" class="form-control" name="cant_bolsilloscombinado2" value="<?php echo isset($fila['cant_bolsilloscombinado2']) && $fila['cant_bolsilloscombinado2'] !== '' ? $fila['cant_bolsilloscombinado2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                            <select name="id_tablon" class="form-select">
                                                <?php
                                                $consulta_mysql = 'SELECT * FROM tablon';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_tablon"];
                                                    $nombre = $lista["tipo_tablon"];
                                                    $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                            <select name="id_cartera" class="form-select">
                                                <?php
                                                $consulta_mysql = 'select * from cartera';
                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                    $id = $lista["id_cartera"];
                                                    $nombre = $lista["tipo_cartera"];
                                                    $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                   
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="3000" rows="5"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Compra Externa -->
                                <?php if ($fila['id_tipo_producto'] == 8): ?>
                                    <input type="hidden" name="id_tela" value="0">
                                    <input type="hidden" name="id_telacombi" value="0">
                                    <input type="hidden" name="id_telaforro" value="0">
                                    <input type="hidden" name="id_cartera" value="0">
                                    <input type="hidden" name="id_tablon" value="0">

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                            <div class="col-mb-6">
                                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                        <select name="id_cargo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'select * from cargo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_cargo"];
                                                $nombre = $lista["cargo"];
                                                $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prendacomprada" class="form-select" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto FROM prenda_comprada ORDER BY prenda_comprada.nombre_producto ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);

                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prendacomprada"];
                                                $nombre = $lista["nombre_producto"];
                                                $selected = ($nombre == $fila['nombre_producto']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label" style="color: #000000;">Valor agregado a la Prenda:</label>
                                            <textarea class="form-control" name="valor_agregado" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['valor_agregado']; ?></textarea>
                                        </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones y Ubicacion para el Logo:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                        <select name="id_tipo_logo" class="form-select">
                                            <?php
                                            $consulta_mysql = 'select * from tipo_logo';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_tipo_logo"];
                                                $nombre = $lista["tipo_logo"];
                                                $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" placeholder="Ingresa una descripción" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Editar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? '../../img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput2<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen2" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? '../../img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput3<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen3" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? '../../img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.avif" id="imagenInput4<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="eliminar_imagen4" value="0">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? '../../img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger d-none btn-remove-image"> Quitar imagen </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo1" value="0">
                                                    <input type="hidden" name="logo_actual1" value="<?= $fila['logo1'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? '../../logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo2" value="0">
                                                    <input type="hidden" name="logo_actual2" value="<?= $fila['logo2'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? '../../logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo3" value="0">
                                                    <input type="hidden" name="logo_actual3" value="<?= $fila['logo3'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? '../../logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <input type="hidden" name="eliminar_logo4" value="0">
                                                    <input type="hidden" name="logo_actual4" value="<?= $fila['logo4'] ?>">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? '../../logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btn-remove-file d-none"> Eliminar archivo o imagen</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Duplicar Producto</button>
                                    </div>
                                <?php endif; ?>
                            </form>
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
            setTimeout(function() {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
        <script>
            function borrarCero(input) {
                // Si el valor es 0, establecer el valor del campo a una cadena vacía
                if (input.value === '0') {
                    input.value = '';
                }
            }
        </script>
        <script>
            let ultimoValor = 0;

            function validarNumero(input) {
                if (input.value < 0) {
                    input.value = 0;
                }
                ultimoValor = input.value;
            }

            function deshabilitarScroll(event) {
                event.preventDefault();
                const input = event.target;
                input.value = ultimoValor;
            }
        </script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.col-md-6').forEach(container => {

                    const input = container.querySelector('input[type="file"]');
                    const preview = container.querySelector('img');
                    const removeBtn = container.querySelector('.btn-remove-image');
                    const label = container.querySelector('.custom-file-label');
                    const hiddenDelete = container.querySelector('input[type="hidden"]');

                    if (!input || !preview || !removeBtn) return;

                    /* ===============================
                    MOSTRAR BOTÓN SI YA HAY IMAGEN (EDITAR)
                    ================================*/
                    if (preview.src && preview.src !== '' && preview.style.display !== 'none') {
                        removeBtn.classList.remove('d-none');
                    }

                    /* ===============================
                    CAMBIO DE ARCHIVO
                    ================================*/
                    input.addEventListener('change', function () {

                        const file = this.files[0];
                        if (!file) return;

                        // SOLO validar si ES IMAGEN
                        if (!file.type.startsWith('image/')) {
                            alert('Solo se permiten imágenes');
                            this.value = '';
                            return;
                        }

                        preview.src = URL.createObjectURL(file);
                        preview.style.display = 'block';
                        removeBtn.classList.remove('d-none');

                        if (label) label.textContent = file.name;
                        if (hiddenDelete) hiddenDelete.value = '0';
                    });

                    /* ===============================
                    QUITAR IMAGEN
                    ================================*/
                    removeBtn.addEventListener('click', () => {

                        input.value = '';
                        preview.src = '';
                        preview.style.display = 'none';
                        removeBtn.classList.add('d-none');

                        if (label) label.textContent = 'Seleccionar archivo';
                        if (hiddenDelete) hiddenDelete.value = '1';
                    });

                });

            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('.col-md-6').forEach(col => {

                    const input = col.querySelector('input[type="file"]');
                    if (!input) return;

                    const label = col.querySelector('.custom-file-label');
                    const previewImg = col.querySelector('img');
                    const previewName = col.querySelector('span');
                    const removeBtn = col.querySelector('.btn-remove-file');
                    const container = col.querySelector('[id$="Container"]'); // SOLO CREAR
                    const hiddenDelete = col.querySelector('input[type="hidden"][name^="eliminar_"]');

                    /* ===============================
                    MOSTRAR BOTÓN SI YA HAY ARCHIVO (EDITAR)
                    ================================*/
                    const hasImage = previewImg && previewImg.src && previewImg.style.display !== 'none';
                    const hasFileName = previewName && previewName.textContent.trim() !== '';

                    if (hasImage || hasFileName) {
                        removeBtn?.classList.remove('d-none');
                        if (container) container.style.display = 'block';
                    }

                    /* ===============================
                    CAMBIO DE ARCHIVO
                    ================================*/
                    input.addEventListener('change', () => {
                        const file = input.files[0];
                        if (!file) return;

                        label.textContent = file.name;
                        removeBtn?.classList.remove('d-none');
                        if (container) container.style.display = 'block';
                        if (hiddenDelete) hiddenDelete.value = '0';

                        if (file.type.startsWith('image/')) {
                            previewImg.src = URL.createObjectURL(file);
                            previewImg.style.display = 'block';
                            if (previewName) previewName.style.display = 'none';
                        } else {
                            if (previewImg) previewImg.style.display = 'none';
                            previewName.textContent = file.name;
                            previewName.style.display = 'block';
                        }
                    });

                    /* ===============================
                    ELIMINAR ARCHIVO
                    ================================*/
                    removeBtn?.addEventListener('click', () => {
                        input.value = '';
                        label.textContent = 'Seleccionar archivo';

                        if (previewImg) {
                            previewImg.src = '';
                            previewImg.style.display = 'none';
                        }

                        if (previewName) {
                            previewName.textContent = '';
                            previewName.style.display = 'none';
                        }

                        if (container) container.style.display = 'none';
                        removeBtn.classList.add('d-none');

                        if (hiddenDelete) hiddenDelete.value = '1';
                    });

                });

            });
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".comboTela").forEach(function(input) {

                const container = input.closest(".position-relative");
                const list = container.querySelector(".comboTelaList");
                const select = container.querySelector(".selectTela");

                const form = input.closest("form");
                const precioTexto = form.querySelector('.precio-tela-valor');
                const fechaContainer = form.querySelector(".fecha-tela-container");
                const precioContainer = form.querySelector(".precioTelaContainer");

                // ========= BUSCADOR (RESPETADO) =========
                const opciones = Array.from(select.options)
                    .filter(opt => opt.value !== "0")
                    .map(opt => ({
                        id: opt.value,
                        texto: opt.textContent,
                        precio: opt.dataset.precio,
                        fecha: opt.dataset.fecha
                    }));

                input.addEventListener("input", function() {
                    const filtro = this.value.toLowerCase();
                    list.innerHTML = "";

                    if (filtro === "") {
                        select.value = "0"; // 👈 mantiene tu lógica
                        actualizarTela(true);
                        list.style.display = "none";
                        return;
                    }

                    const resultados = opciones.filter(o =>
                        o.texto.toLowerCase().includes(filtro)
                    );

                    if (resultados.length === 0) {
                        list.style.display = "none";
                        return;
                    }

                    resultados.forEach(o => {
                        const div = document.createElement("div");
                        div.className = "list-group-item list-group-item-action combobox-item";
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

                // ========= LÓGICA PRECIO + FECHA =========
                function actualizarTela(forzarPrecio = false) {

                    const selected = select.options[select.selectedIndex];
                    const haySeleccion = select.value && select.value !== "0";

                    if (!selected) return;

                    const precio = selected.dataset.precio || 0;
                    const fecha = selected.dataset.fecha || "No Aplica";

                    if (precioTexto) {
                        precioTexto.textContent = Number(precio).toLocaleString('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        });
                    }

                    if (fechaContainer) {
                        fechaContainer.textContent = fecha;
                    }

                    if (precioContainer) {
                        precioContainer.style.display = haySeleccion ? "block" : "none";
                    }
                }

                // ========= INICIALIZACIÓN =========
                const selectedOpt = select.options[select.selectedIndex];

                if (selectedOpt && selectedOpt.value !== "0") {
                    input.value = selectedOpt.textContent;
                } else {
                    select.value = "0";
                }

                actualizarTela(false);

                // ========= EVENTOS =========
                select.addEventListener("change", function() {
                    actualizarTela(true);
                });

                document.addEventListener("click", function(e) {
                    if (!container.contains(e.target)) {
                        list.style.display = "none";
                    }
                });

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
                const precioTexto = form.querySelector('.precio-tela-combi');
                const fechaContainer = form.querySelector(".fecha-actualizacion-container");
                const precioContainer = form.querySelector(".precioTelaCombiContainer");

                // ========= BUSCADOR =========
                const opciones = Array.from(select.options)
                    .filter(opt => opt.value !== "0")
                    .map(opt => ({
                        id: opt.value,
                        texto: opt.textContent,
                        precio: opt.dataset.precio,
                        fecha: opt.dataset.fecha
                    }));

                input.addEventListener("input", function() {
                    const filtro = this.value.toLowerCase();
                    list.innerHTML = "";

                    if (filtro === "") {
                        select.value = "0";
                        actualizarTelaCombi(true);
                        list.style.display = "none";
                        return;
                    }

                    const resultados = opciones.filter(o =>
                        o.texto.toLowerCase().includes(filtro)
                    );

                    if (resultados.length === 0) {
                        list.style.display = "none";
                        return;
                    }

                    resultados.forEach(o => {
                        const div = document.createElement("div");
                        div.className = "list-group-item list-group-item-action combobox-item";
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

                // ========= LÓGICA PRECIO + FECHA =========
                function actualizarTelaCombi() {

                    const selected = select.options[select.selectedIndex];
                    const haySeleccion = select.value && select.value !== "0";

                    if (!selected) return;

                    const precio = selected.dataset.precio || 0;
                    const fecha = selected.dataset.fecha || "No Aplica";

                    if (precioTexto) {
                        precioTexto.textContent = Number(precio).toLocaleString('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        });
                    }

                    if (fechaContainer) {
                        fechaContainer.textContent = fecha;
                    }

                    if (precioContainer) {
                        precioContainer.style.display = haySeleccion ? "block" : "none";
                    }
                }

                // ========= INICIALIZACIÓN =========
                const selectedOpt = select.options[select.selectedIndex];

                if (selectedOpt && selectedOpt.value !== "0") {
                    input.value = selectedOpt.textContent;
                } else {
                    select.value = "0";
                }

                actualizarTelaCombi();

                // ========= EVENTOS =========
                select.addEventListener("change", function() {
                    actualizarTelaCombi();
                });

                document.addEventListener("click", function(e) {
                    if (!container.contains(e.target)) {
                        list.style.display = "none";
                    }
                });

            });

        });
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".comboTelaForro").forEach(function(input) {

                const container = input.closest(".position-relative");
                if (!container) return;

                const list = container.querySelector(".comboTelaForroList");
                const select = container.querySelector(".selectTelaForro");

                const form = input.closest("form");
                const precioTexto = form.querySelector('.precio-tela-forro');
                const fechaContainer = form.querySelector(".fecha-actualizacion-forro-container");
                const precioContainer = form.querySelector(".precioTelaForroContainer");

                // ========= BUSCADOR =========
                const opciones = Array.from(select.options)
                    .filter(opt => opt.value !== "0")
                    .map(opt => ({
                        id: opt.value,
                        texto: opt.textContent.trim(),
                        precio: opt.dataset.precio,
                        fecha: opt.dataset.fecha
                    }));

                input.addEventListener("input", function() {
                    const filtro = this.value.toLowerCase();
                    list.innerHTML = "";

                    if (filtro === "") {
                        select.value = "0";
                        actualizarForro();
                        list.style.display = "none";
                        return;
                    }

                    const resultados = opciones.filter(o =>
                        o.texto.toLowerCase().includes(filtro)
                    );

                    if (resultados.length === 0) {
                        list.style.display = "none";
                        return;
                    }

                    resultados.forEach(o => {
                        const div = document.createElement("div");
                        div.className = "list-group-item list-group-item-action combobox-item";
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

                // ========= LÓGICA PRECIO + FECHA =========
                function actualizarForro() {

                    const selected = select.options[select.selectedIndex];
                    const haySeleccion = select.value && select.value !== "0";

                    if (!selected) return;

                    const precio = selected.dataset.precio || 0;
                    const fecha = selected.dataset.fecha || "No Aplica";

                    if (precioTexto) {
                        precioTexto.textContent = Number(precio).toLocaleString('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        });
                    }

                    if (fechaContainer) {
                        fechaContainer.textContent = fecha;
                    }

                    if (precioContainer) {
                        precioContainer.style.display = haySeleccion ? "block" : "none";
                    }
                }

                // ========= INICIALIZACIÓN =========
                const selectedOpt = select.options[select.selectedIndex];

                if (selectedOpt && selectedOpt.value !== "0") {
                    input.value = selectedOpt.textContent.trim();
                } else {
                    select.value = "0";
                    input.value = "";
                }

                actualizarForro();

                // ========= EVENTOS =========
                select.addEventListener("change", function() {
                    actualizarForro();
                });

                document.addEventListener("click", function(e) {
                    if (!container.contains(e.target)) {
                        list.style.display = "none";
                    }
                });

            });

        });
        </script>
    </body>
</html>