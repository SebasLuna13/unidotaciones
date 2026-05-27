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

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    // Recuperar el id_pedido de la URL
    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    $precio_total = 0;

    if (isset($_POST['editar_datos'])) {

        $id_producto = $_POST['id_producto'];
        $suma_prendas = $_POST['suma_prendas'];
        $talla_XS = $_POST['talla_XS'];
        $talla_S = $_POST['talla_S'];
        $talla_M = $_POST['talla_M'];
        $talla_L = $_POST['talla_L'];
        $talla_XL = $_POST['talla_XL'];
        $talla_2XL = $_POST['talla_2XL'];
        $talla_3XL = $_POST['talla_3XL'];
        $talla_4XL = $_POST['talla_4XL'];
        $talla_5XL = $_POST['talla_5XL'];
        $talla_6XL = $_POST['talla_6XL'];
        $talla_2 = $_POST['talla_2'];
        $talla_4 = $_POST['talla_4'];
        $talla_6 = $_POST['talla_6'];
        $talla_8 = $_POST['talla_8'];
        $talla_10 = $_POST['talla_10'];
        $talla_12 = $_POST['talla_12'];
        $talla_14 = $_POST['talla_14'];
        $talla_16 = $_POST['talla_16'];
        $talla_18 = $_POST['talla_18'];
        $talla_20 = $_POST['talla_20'];
        $talla_22 = $_POST['talla_22'];
        $talla_24 = $_POST['talla_24'];
        $talla_26 = $_POST['talla_26'];
        $talla_28 = $_POST['talla_28'];
        $talla_30 = $_POST['talla_30'];
        $talla_32 = $_POST['talla_32'];
        $talla_34 = $_POST['talla_34'];
        $talla_36 = $_POST['talla_36'];
        $talla_38 = $_POST['talla_38'];
        $talla_40 = $_POST['talla_40'];
        $talla_42 = $_POST['talla_42'];
        $talla_44 = $_POST['talla_44'];
        $talla_46 = $_POST['talla_46'];
        $talla_48 = $_POST['talla_48'];
        $talla_especial = $_POST['talla_especial'];
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
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
        $valor_agregado = isset($_POST['valor_agregado']) ? $_POST['valor_agregado'] : '';

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? floatval($_POST[$campo]) : $valorPredeterminado;
        }

        $precio_compra = obtenerValorPost('precio_compra');
        $promedio_consumo = obtenerValorPost('promedio_consumo');
        $valor_tela = obtenerValorPost('valor_tela');
        $promedio_telacombi = obtenerValorPost('promedio_telacombi');
        $valor_telacombi = obtenerValorPost('valor_telacombi');
        $promedio_forro = obtenerValorPost('promedio_forro');
        $valor_forro = obtenerValorPost('valor_forro');
        $cant_boton = obtenerValorPost('cant_boton');
        $valor_boton = obtenerValorPost('valor_boton');
        $cant_boton2 = obtenerValorPost('cant_boton2');
        $valor_boton2 = obtenerValorPost('valor_boton2');
        $cant_broche = obtenerValorPost('cant_broche');
        $valor_broche = obtenerValorPost('valor_broche');
        $cant_faya = obtenerValorPost('cant_faya');
        $valor_faya = obtenerValorPost('valor_faya');
        $cant_cinta = obtenerValorPost('cant_cinta');
        $valor_cinta = obtenerValorPost('valor_cinta');
        $cant_cordon = obtenerValorPost('cant_cordon');
        $valor_cordon = obtenerValorPost('valor_cordon');
        $cant_cremallera = obtenerValorPost('cant_cremallera');
        $valor_cremallera = obtenerValorPost('valor_cremallera');
        $cant_cremallera2 = obtenerValorPost('cant_cremallera2');
        $valor_cremallera2 = obtenerValorPost('valor_cremallera2');
        $consumo_cuello = obtenerValorPost('consumo_cuello');
        $valor_cuello = obtenerValorPost('valor_cuello');
        $cant_deslizador = obtenerValorPost('cant_deslizador');
        $valor_deslizador = obtenerValorPost('valor_deslizador');
        $cant_entretela = obtenerValorPost('cant_entretela');
        $valor_entretela = obtenerValorPost('valor_entretela');
        $cant_entretela2 = obtenerValorPost('cant_entretela2');
        $valor_entretela2 = obtenerValorPost('valor_entretela2');
        $cant_fajon_cintura = obtenerValorPost('cant_fajon_cintura');
        $valor_fajon_cintura = obtenerValorPost('valor_fajon_cintura');
        $cant_guata = obtenerValorPost('cant_guata');
        $valor_guata = obtenerValorPost('valor_guata');
        $cant_hiladilla = obtenerValorPost('cant_hiladilla');
        $valor_hiladilla = obtenerValorPost('valor_hiladilla');
        $cant_hombrera = obtenerValorPost('cant_hombrera');
        $valor_hombrera = obtenerValorPost('valor_hombrera');
        $cant_plumilla = obtenerValorPost('cant_plumilla');
        $valor_plumilla = obtenerValorPost('valor_plumilla');
        $cant_pretina = obtenerValorPost('cant_pretina');
        $valor_pretina = obtenerValorPost('valor_pretina');
        $cant_puntera = obtenerValorPost('cant_puntera');
        $valor_puntera = obtenerValorPost('valor_puntera');
        $consumo_puño = obtenerValorPost('consumo_puño');
        $valor_puño = obtenerValorPost('valor_puño');
        $cant_resorte = obtenerValorPost('cant_resorte');
        $valor_resorte = obtenerValorPost('valor_resorte');
        $cant_resorte2 = obtenerValorPost('cant_resorte2');
        $valor_resorte2 = obtenerValorPost('valor_resorte2');
        $cant_sesgo = obtenerValorPost('cant_sesgo');
        $valor_sesgo = obtenerValorPost('valor_sesgo');
        $cant_trabilla = obtenerValorPost('cant_trabilla');
        $valor_trabilla = obtenerValorPost('valor_trabilla');
        $cant_velcro = obtenerValorPost('cant_velcro');
        $valor_velcro = obtenerValorPost('valor_velcro');
        $cant_vinilo = obtenerValorPost('cant_vinilo');
        $valor_vinilo = obtenerValorPost('valor_vinilo');
        $cant_vivo = obtenerValorPost('cant_vivo');
        $valor_vivo = obtenerValorPost('valor_vivo');

        $prendas_comprar = $suma_prendas;
        $precio_prendacompra = $suma_prendas * $precio_compra;
        $consumo_tela = $suma_prendas * $promedio_consumo;
        $precio_telacompra = $suma_prendas * $valor_tela;
        $consumo_telacombi = $suma_prendas * $promedio_telacombi;
        $precio_telacombicompra = $suma_prendas * $valor_telacombi;
        $consumo_telaforro = $suma_prendas * $promedio_forro;
        $precio_telaforrocompra = $suma_prendas * $valor_forro;
        $consumo_totalboton = $suma_prendas * $cant_boton;
        $precio_botoncompra = $suma_prendas * $valor_boton;
        $consumo_totalboton2 = $suma_prendas * $cant_boton2;
        $precio_boton2compra = $suma_prendas * $valor_boton2;
        $consumo_totalbroche = $suma_prendas * $cant_broche;
        $precio_brochecompra = $suma_prendas * $valor_broche;
        $consumo_totalfaya = $suma_prendas * $cant_faya;
        $precio_fayacompra = $suma_prendas * $valor_faya;
        $consumo_totalcinta = $suma_prendas * $cant_cinta;
        $precio_cintacompra = $suma_prendas * $valor_cinta;
        $consumo_totalcordon = $suma_prendas * $cant_cordon;
        $precio_cordoncompra = $suma_prendas * $valor_cordon;
        $consumo_totalcremallera = $suma_prendas * $cant_cremallera;
        $precio_cremalleracompra = $suma_prendas * $valor_cremallera;
        $consumo_totalcremallera2 = $suma_prendas * $cant_cremallera2;
        $precio_cremallera2compra = $suma_prendas * $valor_cremallera2;
        $consumo_totalcuello = $suma_prendas * $consumo_cuello;
        $precio_cuellocompra = $suma_prendas * $valor_cuello;
        $consumo_totaldeslizador = $suma_prendas * $cant_deslizador;
        $precio_deslizadorcompra = $suma_prendas * $valor_deslizador;
        $consumo_totalentretela = $suma_prendas * $cant_entretela;
        $precio_entretelacompra = $suma_prendas * $valor_entretela;
        $consumo_totalentretela2 = $suma_prendas * $cant_entretela2;
        $precio_entretela2compra = $suma_prendas * $valor_entretela2;
        $consumo_totalfajon_cintura = $suma_prendas * $cant_fajon_cintura;
        $precio_fajon_cinturacompra = $suma_prendas * $valor_fajon_cintura;
        $consumo_totalguata = $suma_prendas * $cant_guata;
        $precio_guatacompra = $suma_prendas * $valor_guata;
        $consumo_totalhiladilla = $suma_prendas * $cant_hiladilla;
        $precio_hiladillacompra = $suma_prendas * $valor_hiladilla;
        $consumo_totalhombrera = $suma_prendas * $cant_hombrera;
        $precio_hombreracompra = $suma_prendas * $valor_hombrera;
        $consumo_totalplumilla = $suma_prendas * $cant_plumilla;
        $precio_plumillacompra = $suma_prendas * $valor_plumilla;
        $consumo_totalpretina = $suma_prendas * $cant_pretina;
        $precio_pretinacompra = $suma_prendas * $valor_pretina;
        $consumo_totalpuntera = $suma_prendas * $cant_puntera;
        $precio_punteracompra = $suma_prendas * $valor_puntera;
        $consumo_totalpuño = $suma_prendas * $consumo_puño;
        $precio_puñocompra = $suma_prendas * $valor_puño;
        $consumo_totalresorte = $suma_prendas * $cant_resorte;
        $precio_resortecompra = $suma_prendas * $valor_resorte;
        $consumo_totalresorte2 = $suma_prendas * $cant_resorte2;
        $precio_resorte2compra = $suma_prendas * $valor_resorte2;
        $consumo_totalsesgo = $suma_prendas * $cant_sesgo;
        $precio_sesgocompra = $suma_prendas * $valor_sesgo;
        $consumo_totaltrabilla = $suma_prendas * $cant_trabilla;
        $precio_trabillacompra = $suma_prendas * $valor_trabilla;
        $consumo_totalvelcro = $suma_prendas * $cant_velcro;
        $precio_velcrocompra = $suma_prendas * $valor_velcro;
        $consumo_totalvinilo = $suma_prendas * $cant_vinilo;
        $precio_vinilocompra = $suma_prendas * $valor_vinilo;
        $consumo_totalvivo = $suma_prendas * $cant_vivo;
        $precio_vivocompra = $suma_prendas * $valor_vivo;

        // Sumar todas las tallas
        $suma_tallas = $talla_XS + $talla_S + $talla_M + $talla_L + $talla_XL + $talla_2XL + $talla_3XL + $talla_4XL + $talla_5XL + $talla_6XL +
            $talla_2 + $talla_4 + $talla_6 + $talla_8 + $talla_10 + $talla_12 + $talla_14 + $talla_16 + $talla_18 + $talla_20 + $talla_22 + $talla_24 +
            $talla_26 + $talla_28 + $talla_30 + $talla_32 + $talla_34 + $talla_36 + $talla_38 + $talla_40 + $talla_42 + $talla_44 + $talla_46 + $talla_48 + $talla_especial;

        // Comparar suma de tallas con suma_prendas
        if ($suma_tallas > $suma_prendas) {
            header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=3");
            exit();
        }

        // Realizar la consulta de actualización
        $consulta = "UPDATE producto SET talla_XS = '$talla_XS', talla_S = '$talla_S', talla_M = '$talla_M', talla_L = '$talla_L', talla_XL = '$talla_XL', talla_2XL = '$talla_2XL', talla_3XL = '$talla_3XL', talla_4XL = '$talla_4XL', talla_5XL = '$talla_5XL', talla_6XL = '$talla_6XL', 
                    talla_2 = '$talla_2', talla_4 = '$talla_4', talla_6 = '$talla_6', talla_8 = '$talla_8', talla_10 = '$talla_10', talla_12 = '$talla_12', talla_14 = '$talla_14', talla_16 = '$talla_16', talla_18 = '$talla_18', talla_20 = '$talla_20', talla_22 = '$talla_22', talla_24 = '$talla_24',
                    talla_26 = '$talla_26', talla_28 = '$talla_28', talla_30 = '$talla_30', talla_32 = '$talla_32', talla_34 = '$talla_34', talla_36 = '$talla_36', talla_38 = '$talla_38', talla_40 = '$talla_40', talla_42 = '$talla_42', talla_44 = '$talla_44', talla_46 = '$talla_46', talla_48 = '$talla_48',
                    talla_especial = '$talla_especial', frentes = '$frentes', espalda = '$espalda', mangas = '$mangas', cuello = '$cuello', puño = '$puño', delanteros = '$delanteros', traseros = '$traseros', pretina = '$pretina', ensamble = '$ensamble', fajon = '$fajon', forro = '$forro',
                    otros = '$otros', observaciones = '$observaciones', valor_agregado = '$valor_agregado' WHERE id_producto = $id_producto";

        $resultado = mysqli_query($enlace, $consulta);

        // Verificar si ya existe una orden_compra para ese producto
        $verificar = "SELECT id_ordencompra FROM orden_compra WHERE id_producto = '$id_producto' LIMIT 1";
        $resultado_verificar = mysqli_query($enlace, $verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // YA EXISTE → hacer UPDATE
            $consulta2 = "UPDATE orden_compra SET prendas_comprar = '$prendas_comprar', precio_prendacompra = '$precio_prendacompra', consumo_tela = '$consumo_tela', precio_telacompra = '$precio_telacompra', consumo_telacombi = '$consumo_telacombi', precio_telacombicompra = '$precio_telacombicompra', consumo_telaforro = '$consumo_telaforro', precio_telaforrocompra = '$precio_telaforrocompra', consumo_totalboton = '$consumo_totalboton', precio_botoncompra = '$precio_botoncompra', consumo_totalboton2 = '$consumo_totalboton2', precio_boton2compra = '$precio_boton2compra', consumo_totalbroche = '$consumo_totalbroche', precio_brochecompra = '$precio_brochecompra', consumo_totalfaya = '$consumo_totalfaya',
                                precio_fayacompra = '$precio_fayacompra', consumo_totalcinta = '$consumo_totalcinta', precio_cintacompra = '$precio_cintacompra', consumo_totalcordon = '$consumo_totalcordon', precio_cordoncompra = '$precio_cordoncompra', consumo_totalcremallera = '$consumo_totalcremallera', precio_cremalleracompra = '$precio_cremalleracompra', consumo_totalcremallera2 = '$consumo_totalcremallera2', precio_cremallera2compra = '$precio_cremallera2compra', consumo_totalcuello = '$consumo_totalcuello', precio_cuellocompra = '$precio_cuellocompra', consumo_totaldeslizador = '$consumo_totaldeslizador', precio_deslizadorcompra = '$precio_deslizadorcompra', consumo_totalentretela = '$consumo_totalentretela', precio_entretelacompra = '$precio_entretelacompra', consumo_totalentretela2 = '$consumo_totalentretela2',
                                precio_entretela2compra = '$precio_entretela2compra', consumo_totalfajon_cintura = '$consumo_totalfajon_cintura', precio_fajon_cinturacompra = '$precio_fajon_cinturacompra', consumo_totalguata = '$consumo_totalguata', precio_guatacompra = '$precio_guatacompra', consumo_totalhiladilla = '$consumo_totalhiladilla', precio_hiladillacompra = '$precio_hiladillacompra', consumo_totalhombrera = '$consumo_totalhombrera', precio_hombreracompra = '$precio_hombreracompra', consumo_totalplumilla = '$consumo_totalplumilla', precio_plumillacompra = '$precio_plumillacompra', consumo_totalpretina = '$consumo_totalpretina', precio_pretinacompra = '$precio_pretinacompra', consumo_totalpuntera = '$consumo_totalpuntera', precio_punteracompra = '$precio_punteracompra', consumo_totalpuño = '$consumo_totalpuño',
                                precio_puñocompra = '$precio_puñocompra', consumo_totalresorte = '$consumo_totalresorte', precio_resortecompra = '$precio_resortecompra', consumo_totalresorte2 = '$consumo_totalresorte2', precio_resorte2compra = '$precio_resorte2compra', consumo_totalsesgo = '$consumo_totalsesgo', precio_sesgocompra = '$precio_sesgocompra', consumo_totaltrabilla = '$consumo_totaltrabilla', precio_trabillacompra = '$precio_trabillacompra', consumo_totalvelcro = '$consumo_totalvelcro', precio_velcrocompra = '$precio_velcrocompra', consumo_totalvinilo = '$consumo_totalvinilo', precio_vinilocompra = '$precio_vinilocompra', consumo_totalvivo = '$consumo_totalvivo', precio_vivocompra = '$precio_vivocompra'
                            WHERE id_producto = '$id_producto'";
        } else {
            // NO EXISTE → hacer INSERT
            $consulta2 = "INSERT INTO orden_compra (
                id_producto, prendas_comprar, precio_prendacompra, consumo_tela, precio_telacompra, consumo_telacombi, precio_telacombicompra, consumo_telaforro, precio_telaforrocompra, consumo_totalboton, precio_botoncompra, consumo_totalboton2, precio_boton2compra, consumo_totalbroche, precio_brochecompra, consumo_totalfaya, precio_fayacompra, consumo_totalcinta, precio_cintacompra, 
                consumo_totalcordon, precio_cordoncompra, consumo_totalcremallera, precio_cremalleracompra, consumo_totalcremallera2, precio_cremallera2compra, consumo_totalcuello, precio_cuellocompra, consumo_totaldeslizador, precio_deslizadorcompra, consumo_totalentretela, precio_entretelacompra, consumo_totalentretela2, precio_entretela2compra, consumo_totalfajon_cintura, precio_fajon_cinturacompra, 
                consumo_totalguata, precio_guatacompra, consumo_totalhiladilla, precio_hiladillacompra, consumo_totalhombrera, precio_hombreracompra, consumo_totalplumilla, precio_plumillacompra, consumo_totalpretina, precio_pretinacompra, consumo_totalpuntera, precio_punteracompra, consumo_totalpuño, precio_puñocompra, consumo_totalresorte, precio_resortecompra, consumo_totalresorte2, precio_resorte2compra, 
                consumo_totalsesgo, precio_sesgocompra, consumo_totaltrabilla, precio_trabillacompra, consumo_totalvelcro, precio_velcrocompra, consumo_totalvinilo, precio_vinilocompra, consumo_totalvivo, precio_vivocompra
                ) VALUES (
                    '$id_producto', '$prendas_comprar', '$precio_prendacompra', '$consumo_tela', '$precio_telacompra', '$consumo_telacombi', '$precio_telacombicompra', '$consumo_telaforro', '$precio_telaforrocompra', '$consumo_totalboton', '$precio_botoncompra', '$consumo_totalboton2', '$precio_boton2compra', '$consumo_totalbroche', '$precio_brochecompra', '$consumo_totalfaya', '$precio_fayacompra', '$consumo_totalcinta', '$precio_cintacompra', 
                    '$consumo_totalcordon', '$precio_cordoncompra', '$consumo_totalcremallera', '$precio_cremalleracompra', '$consumo_totalcremallera2', '$precio_cremallera2compra', '$consumo_totalcuello', '$precio_cuellocompra', '$consumo_totaldeslizador', '$precio_deslizadorcompra', '$consumo_totalentretela', '$precio_entretelacompra', '$consumo_totalentretela2', '$precio_entretela2compra', '$consumo_totalfajon_cintura', '$precio_fajon_cinturacompra', 
                    '$consumo_totalguata', '$precio_guatacompra', '$consumo_totalhiladilla', '$precio_hiladillacompra', '$consumo_totalhombrera', '$precio_hombreracompra', '$consumo_totalplumilla', '$precio_plumillacompra', '$consumo_totalpretina', '$precio_pretinacompra', '$consumo_totalpuntera', '$precio_punteracompra', '$consumo_totalpuño', '$precio_puñocompra', '$consumo_totalresorte', '$precio_resortecompra', '$consumo_totalresorte2', '$precio_resorte2compra', 
                    '$consumo_totalsesgo', '$precio_sesgocompra', '$consumo_totaltrabilla', '$precio_trabillacompra', '$consumo_totalvelcro', '$precio_velcrocompra', '$consumo_totalvinilo', '$precio_vinilocompra', '$consumo_totalvivo', '$precio_vivocompra'
                )";
        }

        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=2");
        exit();
    }

    if (isset($_POST['cambiar_estadoProducto'])) {

        date_default_timezone_set('America/Bogota');
        $nit         = $_POST['nit'];
        $id_producto = $_POST['id_producto'];
        $num_ficha   = $_POST['num_ficha'];
        $num_orden_compra = $_POST['num_orden_compra'];
        $id_usuario  = $_POST['id_usuario'];
        $id_pedido   = $_POST['id_pedido'];
        $fecha_fichatecnica = date('Y-m-d H:i:s');
        $fecha_base  = date('Y-m-d');

        // ===============================
        // 📅 FUNCIONES DE FECHAS
        // ===============================
        function calcularPascua($anio)
        {
            $a = $anio % 19;
            $b = intval($anio / 100);
            $c = $anio % 100;
            $d = intval($b / 4);
            $e = $b % 4;
            $f = intval(($b + 8) / 25);
            $g = intval(($b - $f + 1) / 3);
            $h = (19 * $a + $b - $d - $g + 15) % 30;
            $i = intval($c / 4);
            $k = $c % 4;
            $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
            $m = intval(($a + 11 * $h + 22 * $l) / 451);
            $mes = intval(($h + $l - 7 * $m + 114) / 31);
            $dia = (($h + $l - 7 * $m + 114) % 31) + 1;
            return sprintf("%04d-%02d-%02d", $anio, $mes, $dia);
        }

        function obtenerFestivosColombia($anio)
        {
            $pascua = calcularPascua($anio);
            return [
                "$anio-01-01",
                "$anio-05-01",
                "$anio-07-20",
                "$anio-08-07",
                "$anio-12-08",
                "$anio-12-25",
                date("Y-m-d", strtotime("$pascua -3 days")),
                date("Y-m-d", strtotime("$pascua -2 days")),
                date("Y-m-d", strtotime("$pascua +39 days")),
                date("Y-m-d", strtotime("$pascua +60 days")),
                date("Y-m-d", strtotime("$pascua +68 days")),
            ];
        }

        function sumarDiasHabiles($fecha, $dias, $nit)
        {
            $anio = date('Y', strtotime($fecha));
            $festivos = obtenerFestivosColombia($anio);
            while ($dias > 0) {
                $fecha = date('Y-m-d', strtotime($fecha . ' +1 day'));
                $esHabil = (date('N', strtotime($fecha)) < 6 && !in_array($fecha, $festivos));
                if ($nit == 22 || $esHabil) $dias--;
            }
            return $fecha;
        }

        $fecha_entrega = sumarDiasHabiles($fecha_base, 30, $nit);

        // ===============================
        // 🧩 ACTUALIZAR PRODUCTO
        // ===============================
        $sql = "UPDATE producto SET estado='Diseño', num_ficha='$num_ficha', num_orden_compra='$num_orden_compra', fecha_fichatecnica='$fecha_fichatecnica', fecha_entrega='$fecha_entrega' 
                    WHERE id_producto='$id_producto'";

        mysqli_query($enlace, $sql);

        // ===============================
        // ✅ VERIFICAR SI TODOS LOS PRODUCTOS SON DISEÑO
        // ===============================
        $verificar = mysqli_fetch_assoc(mysqli_query($enlace, "SELECT COUNT(*) total, SUM(estado='Diseño') fichas FROM producto WHERE id_pedido='$id_pedido'"));

        // ===============================
        // 🚦 CAMBIAR ESTADO DEL PEDIDO SI CORRESPONDE
        // ===============================
        if ($verificar['total'] > 0 && $verificar['total'] == $verificar['fichas']) {
            mysqli_query($enlace, "UPDATE pedido SET estado='Pedido' WHERE id_pedido='$id_pedido'");

            $datos = mysqli_fetch_assoc(mysqli_query($enlace, "SELECT p.id_usuario, c.nit  FROM pedido p LEFT JOIN cliente c ON p.nit=c.nit 
                                                                    WHERE p.id_pedido='$id_pedido' LIMIT 1"));

            header("Location: pedidos_activos.php?id_usuario={$datos['id_usuario']}");
        } else {
            header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&nit=$nit&recibido=0");
        }
        exit;
    }

    if (isset($_POST['cargar_empleados'])) {

        $id_pedido = $_POST['id_pedido'];

        if (!empty($_FILES['listado_empleados']['tmp_name'])) {
            $listado_nombre = $_FILES['listado_empleados']['name'];
            $listado_temporal = $_FILES['listado_empleados']['tmp_name'];
            move_uploaded_file($listado_temporal, "listado_empleados/" . $listado_nombre);
        } else {
            $listado_nombre = $_POST['listado_actual'];
        }

        $consulta = "UPDATE pedido SET listado_empleados = '$listado_nombre' 
                    WHERE id_pedido = $id_pedido";
        $resultado = mysqli_query($enlace, $consulta);

        header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=0");
        exit();
    }

    $recibido = $_GET['recibido'];
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
            .btn-custom {
                border-radius: 20px;
                max-width: 200px;
                /* Establece el ancho máximo deseado */
                width: 100%;
                /* Ocupa el 100% del ancho disponible */
            }

            .custom-box {
                border: 1px solid #343a40;
                border-radius: 3rem;
                /* 6px */
                background-color: #f8f9fa;
                padding: 0.75rem;
                /* 20px */
                display: flex;
                justify-content: space-between;
            }
        </style>
        
        <title>Comercial | Mostrar Pedidos Activos</title>
    <head>


    <body>
        <?php
        $consulta = "SELECT usuario.id_usuario, pedido.id_usuario, producto.id_producto, producto.num_ficha, producto.estado, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4,producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.precio_total, producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14, 
                                    producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.talla_26, producto.talla_28, producto.talla_30, producto.talla_32, producto.talla_34, producto.talla_36, producto.talla_38, producto.talla_40, producto.talla_42, producto.talla_44, producto.talla_46, producto.talla_48, producto.talla_especial, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.color_tela, producto.color_telacombi, producto.color_telaforro, producto.valor_porcentajeestampilla, pedido.total_factura, 
                                    pedido.prendas_realizar, pedido.orden_compra, tipo_logo.tipo_logo, prenda.nombre_prenda, tipo_prenda.tipo_prenda, tela.tela, pedido.estado, pedido.consecutivo, producto.color_tela, producto.color_tela, producto.color_telacombi, producto.color_telaforro, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, 
                                    producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.mas_prendas, producto.suma_prendas, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.precio_cuello, producto.consumo_cuello, producto.precio_puño, producto.consumo_puño, producto.precio_boton, producto.cant_boton, 
                                    producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, 
                                    producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, producto.id_deslizador, producto.precio_deslizador, producto.cant_deslizador, producto.valor_deslizador,
                                    producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, 
                                    producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_flete, producto.precio_obra, producto.costo_total, producto.telaa, producto.telacombinada, producto.telaforro, producto.cant_entretela2, producto.precio_entretela2, producto.valor_entretela2, producto.cant_hiladilla, producto.precio_hiladilla, producto.valor_hiladilla, producto.cant_fajon_cintura, producto.precio_fajon_cintura, producto.valor_fajon_cintura,
                                    producto.mangas, producto.cuello, producto.puño, producto.pretina, producto.fajon, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.valor_agregado, producto.logo, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, cartera.id_cartera, cartera.tipo_cartera, tablon.id_tablon, tablon.tipo_tablon,
                                    pedido.id_pedido, pedido.total_factura, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
                                    producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_pretina, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_total, cliente.cliente, 
                                    producto.id_logistica, logistica.id_logistica, logistica.precio, producto.precio_logistica, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.valor_diseño, producto.valor_corte, corte.precio_corte, producto.observaciones_cotizacion, producto.observaciones_produccion, producto.observaciones_comercial, deslizador.id_deslizador, deslizador.insumo AS insumo_deslizador, producto.precio_deslizador,
                                    tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.cargo, tela.id_tela, tela.tela AS insumo_tela, tela_combinada.id_telacombi, tela_combinada.tela_combi AS insumo_telacombi, tela_forro.id_telaforro, tela_forro.tela_forro AS insumo_telaforro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, 
                                    boton2.id_boton2, boton2.insumo AS insumo_boton2, producto.precio_boton2, producto.cant_boton2, producto.valor_boton2, plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla, producto.precio_plumilla, producto.cant_plumilla, producto.valor_plumilla, vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo, producto.precio_vinilo, producto.cant_vinilo, producto.valor_vinilo,
                                    cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, marquilla.insumo AS insumo_marquilla, acabado.id_acabado, acabado.insumo AS insumo_acabado, acabado.precio AS precio_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, 
                                    entretela.id_entretela, entretela.insumo AS insumo_entretela, entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, 
                                    sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, hiladilla.id_hiladilla, hiladilla.insumo AS insumo_hiladilla, fajon_cintura.id_fajon_cintura, fajon_cintura.insumo AS insumo_fajon_cintura,
                                    broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, producto.cant_bolsillos, producto.precio_bolsillo, bolsillo_combinado.id_bolsillocombinado, bolsillo_combinado.tipo_bolsillocombinado, producto.cant_bolsilloscombinado, producto.precio_bolsillocombinado, bolsillo_combinado2.id_bolsillocombinado2, bolsillo_combinado2.tipo_bolsillocombinado2, producto.cant_bolsilloscombinado2, producto.precio_bolsillocombinado2,
                                    cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, producto.precio_cremallera2, producto.cant_cremallera2, producto.valor_cremallera2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, producto.precio_resorte2, producto.cant_resorte2, producto.valor_resorte2,
                                    mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, entrega.precio_entrega AS entrega_precio_entrega, producto.precio_entrega AS producto_precio_entrega, producto.id_tipo_producto, entidad.id_entidad, entidad.tipo_entidad, cliente.nit, cliente.id_entidad, pedido.nit, producto.margen_bruto, producto.valor_porcentajeestampilla, encarterada.id_encarterada, encarterada.tipo_encarterada, producto.precio_encarterada, puesta_cinta.id_puesta, puesta_cinta.tipo_puesta, producto.precio_puesta,
                                    tela.ancho AS ancho_tela, tela.peso AS peso_tela, tela.caracteristicas, tela.rendimiento, tela.encogimiento, entrega.precio_entrega, producto.id_prendacomprada, prenda_comprada.id_prendacomprada, prenda_comprada.nombre_producto, 
                                    tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.ancho AS ancho_telacombi, tela_combinada.peso AS peso_telacombi, tela_combinada.caracteristicas AS caract_telacombi, tela_combinada.rendimiento AS rend_telacombi, tela_combinada.encogimiento AS encog_telacombi,
                                    tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.ancho AS ancho_forro, tela_forro.peso AS peso_forro, tela_forro.caracteristicas AS caract_forro, tela_forro.rendimiento AS rend_forro, tela_forro.encogimiento AS encog_forro
                                    FROM producto
                                    LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN deslizador ON producto.id_deslizador = deslizador.id_deslizador LEFT JOIN usuario ON pedido.id_usuario = usuario.id_usuario
                                    LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                                    LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN encarterada ON producto.id_encarterada = encarterada.id_encarterada LEFT JOIN puesta_cinta ON producto.id_puesta = puesta_cinta.id_puesta
                                    LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela  LEFT JOIN entretela2 ON producto.id_entretela2 = entretela2.id_entretela2 LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro  LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte  LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera  LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo  
                                    LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla  LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo  LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya  LEFT JOIN guata ON producto.id_guata = guata.id_guata  LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina  LEFT JOIN broche ON producto.id_broche = broche.id_broche  LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon  
                                    LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo LEFT JOIN bolsillo_combinado ON producto.id_bolsillocombinado  = bolsillo_combinado.id_bolsillocombinado LEFT JOIN bolsillo_combinado2 ON producto.id_bolsillocombinado2  = bolsillo_combinado2.id_bolsillocombinado2 LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra  LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño  LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN hiladilla ON producto.id_hiladilla = hiladilla.id_hiladilla 
                                    LEFT JOIN fajon_cintura ON producto.id_fajon_cintura = fajon_cintura.id_fajon_cintura LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN logistica ON producto.id_logistica = logistica.id_logistica LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
                                    LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada
                                    WHERE producto.estado IS NULL AND pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

        <!-- Productos -->
        <?php
        $fila = mysqli_fetch_assoc($resultado)
        ?>

        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="../../img/Logo.png" alt="Logo" width="70" height="50" class="rounded img-fluid d-inline-block align-text-top">
                </a>
                <a href="pedidos_activos.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>" class="btn active btn-primary">
                    <i class="bi bi-arrow-bar-left"></i> Volver
                </a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <div style="display: flex;">
            <div class="container custom-container" style="max-width: 350px; margin-right: 1px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Total Factura:</span>
                    <span>
                        $<?= number_format($fila['total_factura'] ?? 0, 2, ',', '.') ?>
                    </span>
                </div>
            </div>
            <div class="container custom-container" style="max-width: 350px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Prendas Totales:</span>
                    <?php $prendasTotales = isset($fila['prendas_realizar']) ? $fila['prendas_realizar'] : 0; ?>
                    <span id="totalFactura"><?php echo $prendasTotales; ?></span>
                </div>
            </div>
        </div><br>

        <div class="text-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AdicionarExcel<?php echo $fila['id_pedido']; ?>">
                <i class="bi bi-filetype-xlsx"></i> Subir Listado de empleados
            </button>
        </div>
        <br>

        <?php
        // Reiniciar el puntero al principio del conjunto de resultados
        mysqli_data_seek($resultado, 0);

        // Mostrar la siguiente información
        $fila = mysqli_fetch_assoc($resultado);
        ?>

        <?php foreach ($_REQUEST as $var => $val) {
            $$var = $val;
        }
        if ($recibido == 2) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i><strong> Éxito!</strong> La informacion se ha agregado al productos satisfatoriamente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php } else if ($recibido == 3) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong> Error!</strong> No se ha podido ingresar nueva informacion al producto, ya que se intento ingresar mas prendas de las establecidas en la cotizacion del producto.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        ?>

        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                mysqli_data_seek($resultado, 0);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $consulta_ficha = "SELECT MAX(CAST(num_ficha AS UNSIGNED)) AS ultima_ficha FROM producto WHERE num_ficha REGEXP '^[0-9]+$'";
                    $resultado_ficha = mysqli_query($enlace, $consulta_ficha);
                    $fila_ficha = mysqli_fetch_assoc($resultado_ficha);
                    $ultima_ficha = $fila_ficha['ultima_ficha'] ?? 0;

                    // Calcular el siguiente número
                    $siguiente_ficha = $ultima_ficha + 1;

                    if (($fila['estado'] == "Diseño") || ($fila['estado'] == "Compras")) {
                        continue;
                    }
                ?>
                    <?php if ($fila['id_tipo_producto'] != 8): ?>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="modal-content rounded-4 modal-fullscreen">
                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?></h5>
                                </div>
                                <div class="card-body">
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
                                                            <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos sobre la cotizacion</h6>
                                        <div class="row mb-1">
                                            <div class="col">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; "><span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?></p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                            </div>
                                        </div>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                        <?php if (!empty($fila['id_tela'])): ?>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['insumo_tela'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_telacombi'])): ?>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Combinado:</span> <?= $fila['insumo_telacombi'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_telaforro'])): ?>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Forro:</span> <?= $fila['insumo_telaforro'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Precio Unitario:</span>
                                            <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                                $ <?= $precio_formateado ?>
                                            </span>
                                        </p>
                                    </div>

                                    <?php
                                    $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['talla_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                    ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Cantidad de Tallas a Realizar</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <?php
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['talla_' . $talla];
                                                    if ($cantidad > 0) :
                                                        if ($count > 0 && $count % 4 == 0) {
                                                            echo '</div><div class="mb-2 row justify-content-center">';
                                                        }
                                                ?>
                                                        <div class="col-auto">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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

                                    <div class="mb-2 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Venta</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>

                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-precio-compra="<?php echo $fila['precio_compra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>"
                                                data-precio-iva="<?php echo $fila['precio_iva']; ?>"
                                                data-promedio-consumo="<?php echo $fila['promedio_consumo']; ?>"
                                                data-valor-tela="<?php echo $fila['valor_tela']; ?>"
                                                data-promedio-telacombi="<?php echo $fila['promedio_telacombi']; ?>"
                                                data-valor-telacombi="<?php echo $fila['valor_telacombi']; ?>"
                                                data-promedio-forro="<?php echo $fila['promedio_forro']; ?>"
                                                data-valor-forro="<?php echo $fila['valor_forro']; ?>"
                                                data-cant-boton="<?php echo $fila['cant_boton']; ?>"
                                                data-valor-boton="<?php echo $fila['valor_boton']; ?>"
                                                data-cant-boton2="<?php echo $fila['cant_boton2']; ?>"
                                                data-valor-boton2="<?php echo $fila['valor_boton2']; ?>"
                                                data-cant-broche="<?php echo $fila['cant_broche']; ?>"
                                                data-valor-broche="<?php echo $fila['valor_broche']; ?>"
                                                data-cant-faya="<?php echo $fila['cant_faya']; ?>"
                                                data-valor-faya="<?php echo $fila['valor_faya']; ?>"
                                                data-cant-cinta="<?php echo $fila['cant_cinta']; ?>"
                                                data-valor-cinta="<?php echo $fila['valor_cinta']; ?>"
                                                data-cant-cordon="<?php echo $fila['cant_cordon']; ?>"
                                                data-valor-cordon="<?php echo $fila['valor_cordon']; ?>"
                                                data-cant-cremallera="<?php echo $fila['cant_cremallera']; ?>"
                                                data-valor-cremallera="<?php echo $fila['valor_cremallera']; ?>"
                                                data-cant-cremallera2="<?php echo $fila['cant_cremallera2']; ?>"
                                                data-valor-cremallera2="<?php echo $fila['valor_cremallera2']; ?>"
                                                data-consumo-cuello="<?php echo $fila['consumo_cuello']; ?>"
                                                data-valor-cuello="<?php echo $fila['valor_cuello']; ?>"
                                                data-cant-deslizador="<?php echo $fila['cant_deslizador']; ?>"
                                                data-valor-deslizador="<?php echo $fila['valor_deslizador']; ?>"
                                                data-cant-entretela="<?php echo $fila['cant_entretela']; ?>"
                                                data-valor-entretela="<?php echo $fila['valor_entretela']; ?>"
                                                data-cant-entretela2="<?php echo $fila['cant_entretela2']; ?>"
                                                data-valor-entretela2="<?php echo $fila['valor_entretela2']; ?>"
                                                data-cant_fajon_cintura="<?php echo $fila['cant_fajon_cintura']; ?>"
                                                data-valor_fajon_cintura="<?php echo $fila['valor_fajon_cintura']; ?>"
                                                data-cant-guata="<?php echo $fila['cant_guata']; ?>"
                                                data-valor-guata="<?php echo $fila['valor_guata']; ?>"
                                                data-cant-hiladilla="<?php echo $fila['cant_hiladilla']; ?>"
                                                data-valor-hiladilla="<?php echo $fila['valor_hiladilla']; ?>"
                                                data-cant-hombrera="<?php echo $fila['cant_hombrera']; ?>"
                                                data-valor-hombrera="<?php echo $fila['valor_hombrera']; ?>"
                                                data-cant-plumilla="<?php echo $fila['cant_plumilla']; ?>"
                                                data-valor-plumilla="<?php echo $fila['valor_plumilla']; ?>"
                                                data-cant-pretina="<?php echo $fila['cant_pretina']; ?>"
                                                data-valor-pretina="<?php echo $fila['valor_pretina']; ?>"
                                                data-cant-puntera="<?php echo $fila['cant_puntera']; ?>"
                                                data-valor-puntera="<?php echo $fila['valor_puntera']; ?>"
                                                data-consumo-puño="<?php echo $fila['consumo_puño']; ?>"
                                                data-valor-puño="<?php echo $fila['valor_puño']; ?>"
                                                data-cant-resorte="<?php echo $fila['cant_resorte']; ?>"
                                                data-valor-resorte="<?php echo $fila['valor_resorte']; ?>"
                                                data-cant-resorte2="<?php echo $fila['cant_resorte2']; ?>"
                                                data-valor-resorte2="<?php echo $fila['valor_resorte2']; ?>"
                                                data-cant-sesgo="<?php echo $fila['cant_sesgo']; ?>"
                                                data-valor-sesgo="<?php echo $fila['valor_sesgo']; ?>"
                                                data-cant-trabilla="<?php echo $fila['cant_trabilla']; ?>"
                                                data-valor-trabilla="<?php echo $fila['valor_trabilla']; ?>"
                                                data-cant-velcro="<?php echo $fila['cant_velcro']; ?>"
                                                data-valor-velcro="<?php echo $fila['valor_velcro']; ?>"
                                                data-cant-vinilo="<?php echo $fila['cant_vinilo']; ?>"
                                                data-valor-vinilo="<?php echo $fila['valor_vinilo']; ?>"
                                                data-cant-vivo="<?php echo $fila['cant_vivo']; ?>"
                                                data-valor-vivo="<?php echo $fila['valor_vivo']; ?>">
                                                <i class="bi bi-pencil-square"></i> Agregar Informacion
                                            </button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-info-circle-fill"></i> Mostrar Datos
                                            </button>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#fichatecnica<?= $fila['id_producto']; ?>">
                                                <i class="bi bi-clipboard-check-fill"></i> Pasar a realizar Ficha Tecnica
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($fila['id_tipo_producto'] == 8): ?>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="modal-content rounded-4 modal-fullscreen">
                                <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?></h5>
                                </div>

                                <div class="card-body">
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
                                                            <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos sobre la cotizacion</h6>
                                        <div class="row mb-1">
                                            <div class="col">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; "><span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?></p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                            </div>
                                        </div>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                        <?php if (!empty($fila['id_tela'])): ?>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['insumo_tela'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_telacombi'])): ?>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Combinado:</span> <?= $fila['insumo_telacombi'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_telaforro'])): ?>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Forro:</span> <?= $fila['insumo_telaforro'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                            <span class="font-weight-bold">Precio Unitario:</span>
                                            <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                                $ <?= $precio_formateado ?>
                                            </span>
                                        </p>
                                    </div>

                                    <?php
                                    $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['talla_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                    ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Cantidad de Tallas a Realizar</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <?php
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['talla_' . $talla];
                                                    if ($cantidad > 0) :
                                                        if ($count > 0 && $count % 3 == 0) {
                                                            echo '</div><div class="mb-2 row justify-content-center">';
                                                        }
                                                ?>
                                                        <div class="col-md-3">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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
                                    <div class="mb-2 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Venta</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-precio-compra="<?php echo $fila['precio_compra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>"
                                                data-precio-iva="<?php echo $fila['precio_iva']; ?>"
                                                data-promedio-consumo="<?php echo $fila['promedio_consumo']; ?>"
                                                data-valor-tela="<?php echo $fila['valor_tela']; ?>"
                                                data-promedio-telacombi="<?php echo $fila['promedio_telacombi']; ?>"
                                                data-valor-telacombi="<?php echo $fila['valor_telacombi']; ?>"
                                                data-promedio-forro="<?php echo $fila['promedio_forro']; ?>"
                                                data-valor-forro="<?php echo $fila['valor_forro']; ?>"
                                                data-cant-boton="<?php echo $fila['cant_boton']; ?>"
                                                data-valor-boton="<?php echo $fila['valor_boton']; ?>"
                                                data-cant-boton2="<?php echo $fila['cant_boton2']; ?>"
                                                data-valor-boton2="<?php echo $fila['valor_boton2']; ?>"
                                                data-cant-broche="<?php echo $fila['cant_broche']; ?>"
                                                data-valor-broche="<?php echo $fila['valor_broche']; ?>"
                                                data-cant-faya="<?php echo $fila['cant_faya']; ?>"
                                                data-valor-faya="<?php echo $fila['valor_faya']; ?>"
                                                data-cant-cinta="<?php echo $fila['cant_cinta']; ?>"
                                                data-valor-cinta="<?php echo $fila['valor_cinta']; ?>"
                                                data-cant-cordon="<?php echo $fila['cant_cordon']; ?>"
                                                data-valor-cordon="<?php echo $fila['valor_cordon']; ?>"
                                                data-cant-cremallera="<?php echo $fila['cant_cremallera']; ?>"
                                                data-valor-cremallera="<?php echo $fila['valor_cremallera']; ?>"
                                                data-cant-cremallera2="<?php echo $fila['cant_cremallera2']; ?>"
                                                data-valor-cremallera2="<?php echo $fila['valor_cremallera2']; ?>"
                                                data-consumo-cuello="<?php echo $fila['consumo_cuello']; ?>"
                                                data-valor-cuello="<?php echo $fila['valor_cuello']; ?>"
                                                data-cant-deslizador="<?php echo $fila['cant_deslizador']; ?>"
                                                data-valor-deslizador="<?php echo $fila['valor_deslizador']; ?>"
                                                data-cant-entretela="<?php echo $fila['cant_entretela']; ?>"
                                                data-valor-entretela="<?php echo $fila['valor_entretela']; ?>"
                                                data-cant-entretela2="<?php echo $fila['cant_entretela2']; ?>"
                                                data-valor-entretela2="<?php echo $fila['valor_entretela2']; ?>"
                                                data-cant_fajon_cintura="<?php echo $fila['cant_fajon_cintura']; ?>"
                                                data-valor_fajon_cintura="<?php echo $fila['valor_fajon_cintura']; ?>"
                                                data-cant-guata="<?php echo $fila['cant_guata']; ?>"
                                                data-valor-guata="<?php echo $fila['valor_guata']; ?>"
                                                data-cant-hiladilla="<?php echo $fila['cant_hiladilla']; ?>"
                                                data-valor-hiladilla="<?php echo $fila['valor_hiladilla']; ?>"
                                                data-cant-hombrera="<?php echo $fila['cant_hombrera']; ?>"
                                                data-valor-hombrera="<?php echo $fila['valor_hombrera']; ?>"
                                                data-cant-plumilla="<?php echo $fila['cant_plumilla']; ?>"
                                                data-valor-plumilla="<?php echo $fila['valor_plumilla']; ?>"
                                                data-cant-pretina="<?php echo $fila['cant_pretina']; ?>"
                                                data-valor-pretina="<?php echo $fila['valor_pretina']; ?>"
                                                data-cant-puntera="<?php echo $fila['cant_puntera']; ?>"
                                                data-valor-puntera="<?php echo $fila['valor_puntera']; ?>"
                                                data-consumo-puño="<?php echo $fila['consumo_puño']; ?>"
                                                data-valor-puño="<?php echo $fila['valor_puño']; ?>"
                                                data-cant-resorte="<?php echo $fila['cant_resorte']; ?>"
                                                data-valor-resorte="<?php echo $fila['valor_resorte']; ?>"
                                                data-cant-resorte2="<?php echo $fila['cant_resorte2']; ?>"
                                                data-valor-resorte2="<?php echo $fila['valor_resorte2']; ?>"
                                                data-cant-sesgo="<?php echo $fila['cant_sesgo']; ?>"
                                                data-valor-sesgo="<?php echo $fila['valor_sesgo']; ?>"
                                                data-cant-trabilla="<?php echo $fila['cant_trabilla']; ?>"
                                                data-valor-trabilla="<?php echo $fila['valor_trabilla']; ?>"
                                                data-cant-velcro="<?php echo $fila['cant_velcro']; ?>"
                                                data-valor-velcro="<?php echo $fila['valor_velcro']; ?>"
                                                data-cant-vinilo="<?php echo $fila['cant_vinilo']; ?>"
                                                data-valor-vinilo="<?php echo $fila['valor_vinilo']; ?>"
                                                data-cant-vivo="<?php echo $fila['cant_vivo']; ?>"
                                                data-valor-vivo="<?php echo $fila['valor_vivo']; ?>">
                                                <i class="bi bi-pencil-square"></i> Agregar Informacion
                                            </button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-info-circle-fill"></i> Mostrar Datos
                                            </button>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#fichatecnica<?= $fila['id_producto']; ?>">
                                                <i class="bi bi-clipboard-check-fill"></i> Pasar a realizar Ficha Tecnica
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

        <!-- Modales -->
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
        ?>

            <!-- Modales Editar -->
            <div class="modal fade" id="Editar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los Datos y Tallas de la Prenda: <?php echo $fila['nombre_producto']; ?></h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="precio_compra" value="<?php echo $fila['precio_compra']; ?>">
                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">
                                <input type="hidden" name="precio_iva" value="<?php echo $fila['precio_iva']; ?>">
                                <input type="hidden" name="promedio_consumo" value="<?php echo $fila['promedio_consumo']; ?>">
                                <input type="hidden" name="valor_tela" value="<?php echo $fila['valor_tela']; ?>">
                                <input type="hidden" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>">
                                <input type="hidden" name="valor_telacombi" value="<?php echo $fila['valor_telacombi']; ?>">
                                <input type="hidden" name="promedio_forro" value="<?php echo $fila['promedio_forro']; ?>">
                                <input type="hidden" name="valor_forro" value="<?php echo $fila['valor_forro']; ?>">
                                <input type="hidden" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>">
                                <input type="hidden" name="valor_boton" value="<?php echo $fila['valor_boton']; ?>">
                                <input type="hidden" name="cant_boton2" value="<?php echo $fila['cant_boton2']; ?>">
                                <input type="hidden" name="valor_boton2" value="<?php echo $fila['valor_boton2']; ?>">
                                <input type="hidden" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>">
                                <input type="hidden" name="valor_broche" value="<?php echo $fila['valor_broche']; ?>">
                                <input type="hidden" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>">
                                <input type="hidden" name="valor_faya" value="<?php echo $fila['valor_faya']; ?>">
                                <input type="hidden" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>">
                                <input type="hidden" name="valor_cinta" value="<?php echo $fila['valor_cinta']; ?>">
                                <input type="hidden" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>">
                                <input type="hidden" name="valor_cordon" value="<?php echo $fila['valor_cordon']; ?>">
                                <input type="hidden" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>">
                                <input type="hidden" name="valor_cremallera" value="<?php echo $fila['valor_cremallera']; ?>">
                                <input type="hidden" name="cant_cremallera2" value="<?php echo $fila['cant_cremallera2']; ?>">
                                <input type="hidden" name="valor_cremallera2" value="<?php echo $fila['valor_cremallera2']; ?>">
                                <input type="hidden" name="consumo_cuello" value="<?php echo $fila['consumo_cuello']; ?>">
                                <input type="hidden" name="valor_cuello" value="<?php echo $fila['valor_cuello']; ?>">
                                <input type="hidden" name="cant_deslizador" value="<?php echo $fila['cant_deslizador']; ?>">
                                <input type="hidden" name="valor_deslizador" value="<?php echo $fila['valor_deslizador']; ?>">
                                <input type="hidden" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>">
                                <input type="hidden" name="valor_entretela" value="<?php echo $fila['valor_entretela']; ?>">
                                <input type="hidden" name="cant_entretela2" value="<?php echo $fila['cant_entretela2']; ?>">
                                <input type="hidden" name="valor_entretela2" value="<?php echo $fila['valor_entretela2']; ?>">
                                <input type="hidden" name="cant_fajon_cintura" value="<?php echo $fila['cant_fajon_cintura']; ?>">
                                <input type="hidden" name="valor_fajon_cintura" value="<?php echo $fila['valor_fajon_cintura']; ?>">
                                <input type="hidden" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>">
                                <input type="hidden" name="valor_guata" value="<?php echo $fila['valor_guata']; ?>">
                                <input type="hidden" name="cant_hiladilla" value="<?php echo $fila['cant_hiladilla']; ?>">
                                <input type="hidden" name="valor_hiladilla" value="<?php echo $fila['valor_hiladilla']; ?>">
                                <input type="hidden" name="cant_hombrera" value="<?php echo $fila['cant_hombrera']; ?>">
                                <input type="hidden" name="valor_hombrera" value="<?php echo $fila['valor_hombrera']; ?>">
                                <input type="hidden" name="cant_plumilla" value="<?php echo $fila['cant_plumilla']; ?>">
                                <input type="hidden" name="valor_plumilla" value="<?php echo $fila['valor_plumilla']; ?>">
                                <input type="hidden" name="cant_pretina" value="<?php echo $fila['cant_pretina']; ?>">
                                <input type="hidden" name="valor_pretina" value="<?php echo $fila['valor_pretina']; ?>">
                                <input type="hidden" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>">
                                <input type="hidden" name="valor_puntera" value="<?php echo $fila['valor_puntera']; ?>">
                                <input type="hidden" name="consumo_puño" value="<?php echo $fila['consumo_puño']; ?>">
                                <input type="hidden" name="valor_puño" value="<?php echo $fila['valor_puño']; ?>">
                                <input type="hidden" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>">
                                <input type="hidden" name="valor_resorte" value="<?php echo $fila['valor_resorte']; ?>">
                                <input type="hidden" name="cant_resorte2" value="<?php echo $fila['cant_resorte2']; ?>">
                                <input type="hidden" name="valor_resorte2" value="<?php echo $fila['valor_resorte2']; ?>">
                                <input type="hidden" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>">
                                <input type="hidden" name="valor_sesgo" value="<?php echo $fila['valor_sesgo']; ?>">
                                <input type="hidden" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>">
                                <input type="hidden" name="valor_trabilla" value="<?php echo $fila['valor_trabilla']; ?>">
                                <input type="hidden" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>">
                                <input type="hidden" name="valor_velcro" value="<?php echo $fila['valor_velcro']; ?>">
                                <input type="hidden" name="cant_vinilo" value="<?php echo $fila['cant_vinilo']; ?>">
                                <input type="hidden" name="valor_vinilo" value="<?php echo $fila['valor_vinilo']; ?>">
                                <input type="hidden" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>">
                                <input type="hidden" name="valor_vivo" value="<?php echo $fila['valor_vivo']; ?>">

                                <?php
                                $imagenes = [
                                    $fila['imagen'],
                                    $fila['imagen2'],
                                    $fila['imagen3'],
                                    $fila['imagen4'],
                                ];

                                // Filtrar imágenes no vacías
                                $imagenes_validas = array_filter($imagenes);
                                ?>

                                <?php if (!empty($imagenes_validas)): // Verificar si hay al menos una imagen 
                                ?>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <div class="mb-2 mt-1 text-center border rounded p-2">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guia</h6>
                                            <div class="d-flex justify-content-center mb-2">
                                                <?php foreach ($imagenes_validas as $imagen): ?>
                                                    <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                        <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Superior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 1): ?>

                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 26; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Cuarta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas1 = ['XS', 'S', 'M', 'L', 'XL'];
                                            foreach ($tallas1 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Quinta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas2 = ['2XL', '3XL', '4XL', '5XL', '6XL'];
                                            foreach ($tallas2 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Sexta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $frentes = $fila['frentes'];
                                    $espalda = $fila['espalda'];
                                    $mangas = $fila['mangas'];
                                    $cuello = $fila['cuello'];
                                    $puño = $fila['puño'];
                                    $otros = $fila['otros'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                        <?php if (empty($frentes)): ?>
                                            <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($frentes); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                        <?php if (empty($espalda)): ?>
                                            <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($espalda); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                        <?php if (empty($mangas)): ?>
                                            <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($mangas); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                        <?php if (empty($cuello)): ?>
                                            <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($cuello); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                        <?php if (empty($puño)): ?>
                                            <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($puño); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Otros:</label>
                                        <?php if (empty($otros)): ?>
                                            <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($otros); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($observaciones)): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="4"><?php echo htmlspecialchars($observaciones); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <input type="hidden" name="talla_28" value="0"><input type="hidden" name="talla_30" value="0"><input type="hidden" name="talla_32" value="0"><input type="hidden" name="talla_34" value="0"><input type="hidden" name="talla_36" value="0"><input type="hidden" name="talla_38" value="0">
                                    <input type="hidden" name="talla_40" value="0"><input type="hidden" name="talla_42" value="0"><input type="hidden" name="talla_44" value="0"><input type="hidden" name="talla_46" value="0"><input type="hidden" name="talla_48" value="0">
                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Superior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 2): ?>

                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 26; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                            <?php $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $frentes = $fila['frentes'];
                                    $espalda = $fila['espalda'];
                                    $mangas = $fila['mangas'];
                                    $cuello = $fila['cuello'];
                                    $puño = $fila['puño'];
                                    $otros = $fila['otros'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                        <?php if (empty($frentes)): ?>
                                            <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($frentes); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                        <?php if (empty($espalda)): ?>
                                            <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($espalda); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                        <?php if (empty($mangas)): ?>
                                            <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($mangas); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                        <?php if (empty($cuello)): ?>
                                            <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($cuello); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                        <?php if (empty($puño)): ?>
                                            <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($puño); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Otros:</label>
                                        <?php if (empty($otros)): ?>
                                            <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($otros); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($observaciones)): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="4"><?php echo htmlspecialchars($observaciones); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <input type="hidden" name="talla_XS" value="0"><input type="hidden" name="talla_S" value="0"><input type="hidden" name="talla_M" value="0"><input type="hidden" name="talla_L" value="0"><input type="hidden" name="talla_XL" value="0"><input type="hidden" name="talla_2XL" value="0"><input type="hidden" name="talla_3XL" value="0">
                                    <input type="hidden" name="talla_4XL" value="0"><input type="hidden" name="talla_5XL" value="0"><input type="hidden" name="talla_6XL" value="0"><input type="hidden" name="talla_28" value="0"><input type="hidden" name="talla_30" value="0"><input type="hidden" name="talla_32" value="0"><input type="hidden" name="talla_34" value="0">
                                    <input type="hidden" name="talla_36" value="0"><input type="hidden" name="talla_38" value="0"><input type="hidden" name="talla_40" value="0"><input type="hidden" name="talla_42" value="0"><input type="hidden" name="talla_44" value="0"><input type="hidden" name="talla_46" value="0"><input type="hidden" name="talla_48" value="0">
                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Inferior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 3): ?>

                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 30; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Cuarta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 32; $i <= 40; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Quinta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 42; $i <= 48; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Sexta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas1 = ['XS', 'S', 'M', 'L', 'XL'];
                                            foreach ($tallas1 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Septima Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas2 = ['2XL', '3XL', '4XL', '5XL', '6XL'];
                                            foreach ($tallas2 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Octava Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $delanteros = $fila['delanteros'];
                                    $traseros = $fila['traseros'];
                                    $pretina = $fila['pretina'];
                                    $ensamble = $fila['ensamble'];
                                    $otros = $fila['otros'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                        <?php if (empty($fila['delanteros'])): ?>
                                            <textarea class="form-control" name="delanteros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="delanteros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['delanteros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                        <?php if (empty($fila['traseros'])): ?>
                                            <textarea class="form-control" name="traseros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="traseros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['traseros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Pretina:</label>
                                        <?php if (empty($fila['pretina'])): ?>
                                            <textarea class="form-control" name="pretina" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['pretina']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                        <?php if (empty($fila['ensamble'])): ?>
                                            <textarea class="form-control" name="ensamble" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="ensamble" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['ensamble']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Otros:</label>
                                        <?php if (empty($fila['otros'])): ?>
                                            <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['otros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($fila['observaciones'])): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['observaciones']); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Inferior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 4): ?>

                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 26; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                            <?php $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $delanteros = $fila['delanteros'];
                                    $traseros = $fila['traseros'];
                                    $pretina = $fila['pretina'];
                                    $ensamble = $fila['ensamble'];
                                    $otros = $fila['otros'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                        <?php if (empty($fila['delanteros'])): ?>
                                            <textarea class="form-control" name="delanteros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="delanteros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['delanteros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                        <?php if (empty($fila['traseros'])): ?>
                                            <textarea class="form-control" name="traseros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="traseros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['traseros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Pretina:</label>
                                        <?php if (empty($fila['pretina'])): ?>
                                            <textarea class="form-control" name="pretina" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['pretina']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                        <?php if (empty($fila['ensamble'])): ?>
                                            <textarea class="form-control" name="ensamble" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="ensamble" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['ensamble']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Otros:</label>
                                        <?php if (empty($fila['otros'])): ?>
                                            <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['otros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($fila['observaciones'])): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['observaciones']); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <input type="hidden" name="talla_XS" value="0"><input type="hidden" name="talla_S" value="0"><input type="hidden" name="talla_M" value="0"><input type="hidden" name="talla_L" value="0"><input type="hidden" name="talla_XL" value="0"><input type="hidden" name="talla_2XL" value="0"><input type="hidden" name="talla_3XL" value="0">
                                    <input type="hidden" name="talla_4XL" value="0"><input type="hidden" name="talla_5XL" value="0"><input type="hidden" name="talla_6XL" value="0"><input type="hidden" name="talla_28" value="0"><input type="hidden" name="talla_30" value="0"><input type="hidden" name="talla_32" value="0"><input type="hidden" name="talla_34" value="0">
                                    <input type="hidden" name="talla_36" value="0"><input type="hidden" name="talla_38" value="0"><input type="hidden" name="talla_40" value="0"><input type="hidden" name="talla_42" value="0"><input type="hidden" name="talla_44" value="0"><input type="hidden" name="talla_46" value="0"><input type="hidden" name="talla_48" value="0">
                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Chaqueta -->
                                <?php if ($fila['id_tipo_producto'] == 5): ?>


                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 26; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Cuarta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas1 = ['XS', 'S', 'M', 'L', 'XL'];
                                            foreach ($tallas1 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Quinta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas2 = ['2XL', '3XL', '4XL', '5XL', '6XL'];
                                            foreach ($tallas2 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Sexta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $frentes = $fila['frentes'];
                                    $espalda = $fila['espalda'];
                                    $mangas = $fila['mangas'];
                                    $cuello = $fila['cuello'];
                                    $puño = $fila['puño'];
                                    $fajon = $fila['fajon'];
                                    $forro = $fila['forro'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                        <?php if (empty($frentes)): ?>
                                            <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($frentes); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                        <?php if (empty($espalda)): ?>
                                            <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($espalda); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                        <?php if (empty($mangas)): ?>
                                            <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($mangas); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                        <?php if (empty($cuello)): ?>
                                            <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($cuello); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                        <?php if (empty($puño)): ?>
                                            <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($puño); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Fajon:</label>
                                        <?php if (empty($fajon)): ?>
                                            <textarea class="form-control" name="fajon" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="fajon" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fajon); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Forro:</label>
                                        <?php if (empty($forro)): ?>
                                            <textarea class="form-control" name="forro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="forro" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($forro); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($observaciones)): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="4"><?php echo htmlspecialchars($observaciones); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <input type="hidden" name="talla_28" value="0"><input type="hidden" name="talla_30" value="0"><input type="hidden" name="talla_32" value="0"><input type="hidden" name="talla_34" value="0"><input type="hidden" name="talla_36" value="0"><input type="hidden" name="talla_38" value="0">
                                    <input type="hidden" name="talla_40" value="0"><input type="hidden" name="talla_42" value="0"><input type="hidden" name="talla_44" value="0"><input type="hidden" name="talla_46" value="0"><input type="hidden" name="talla_48" value="0">
                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Overol -->
                                <?php if ($fila['id_tipo_producto'] == 6): ?>


                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 26; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Cuarta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas1 = ['XS', 'S', 'M', 'L', 'XL'];
                                            foreach ($tallas1 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Quinta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas2 = ['2XL', '3XL', '4XL', '5XL', '6XL'];
                                            foreach ($tallas2 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Sexta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $frentes = $fila['frentes'];
                                    $espalda = $fila['espalda'];
                                    $mangas = $fila['mangas'];
                                    $delanteros = $fila['delanteros'];
                                    $traseros = $fila['traseros'];
                                    $ensamble = $fila['ensamble'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                        <?php if (empty($frentes)): ?>
                                            <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($frentes); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                        <?php if (empty($espalda)): ?>
                                            <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($espalda); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                        <?php if (empty($mangas)): ?>
                                            <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($mangas); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                        <?php if (empty($fila['delanteros'])): ?>
                                            <textarea class="form-control" name="delanteros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="delanteros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['delanteros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                        <?php if (empty($fila['traseros'])): ?>
                                            <textarea class="form-control" name="traseros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="traseros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['traseros']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                        <?php if (empty($fila['ensamble'])): ?>
                                            <textarea class="form-control" name="ensamble" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="ensamble" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($fila['ensamble']); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($observaciones)): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="4"><?php echo htmlspecialchars($observaciones); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <input type="hidden" name="talla_28" value="0"><input type="hidden" name="talla_30" value="0"><input type="hidden" name="talla_32" value="0"><input type="hidden" name="talla_34" value="0"><input type="hidden" name="talla_36" value="0"><input type="hidden" name="talla_38" value="0">
                                    <input type="hidden" name="talla_40" value="0"><input type="hidden" name="talla_42" value="0"><input type="hidden" name="talla_44" value="0"><input type="hidden" name="talla_46" value="0"><input type="hidden" name="talla_48" value="0">
                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Otros -->
                                <?php if ($fila['id_tipo_producto'] == 7): ?>


                                    <?php if (
                                        !empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_bolsillo']) || !empty($fila['id_boton']) || !empty($fila['id_boton2']) || !empty($fila['id_broche']) || !empty($fila['id_fajon_cintura']) || !empty($fila['id_faya']) || !empty($fila['id_cinta']) ||
                                        !empty($fila['id_cordon']) || !empty($fila['id_cremallera']) || !empty($fila['id_cremallera2']) || !empty($fila['id_cuello']) || !empty($fila['id_deslizador']) || !empty($fila['id_entretela']) || !empty($fila['id_entretela2']) || !empty($fila['id_estampado']) || !empty($fila['id_fusionado']) || !empty($fila['id_guata']) || !empty($fila['id_hiladilla']) ||
                                        !empty($fila['id_hombrera']) || !empty($fila['id_marquilla']) || !empty($fila['id_plumilla']) || !empty($fila['id_pretina']) || !empty($fila['id_puntera']) || !empty($fila['id_puño']) || !empty($fila['id_resorte']) || !empty($fila['id_resorte2']) || !empty($fila['id_sesgo']) || !empty($fila['id_trabilla']) || !empty($fila['id_velcro']) || !empty($fila['id_vinilo']) || !empty($fila['id_vivo'])
                                    ): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsillo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsillo:</span>
                                                            <?= $fila['tipo_bolsillo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton:</span>
                                                            <?= $fila['insumo_boton'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_boton2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Boton 2:</span>
                                                            <?= $fila['insumo_boton2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_broche'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Broche:</span>
                                                            <?= $fila['insumo_broche'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cinta'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Reflectiva:</span>
                                                            <?= $fila['insumo_reflectiva'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cordon'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cordon:</span>
                                                            <?= $fila['insumo_cordon'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera:</span>
                                                            <?= $fila['insumo_cremallera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cremallera2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cremallera 2:</span>
                                                            <?= $fila['insumo_cremallera2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_cuello'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cuello:</span>
                                                            <?= $fila['insumo_cuello'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_deslizador'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Deslizador:</span>
                                                            <?= $fila['insumo_deslizador'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela:</span>
                                                            <?= $fila['insumo_entretela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_entretela2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Entretela 2:</span>
                                                            <?= $fila['insumo_entretela2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_estampado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Estampado:</span>
                                                            <?= $fila['tipo_estampado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fajon_cintura'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fajon Cintura:</span>
                                                            <?= $fila['insumo_fajon_cintura'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_faya'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Cinta Faya:</span>
                                                            <?= $fila['insumo_faya'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_fusionado'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Fusionado:</span>
                                                            <?= $fila['insumo_fusionado'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_guata'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Guata:</span>
                                                            <?= $fila['insumo_guata'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hiladilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hiladilla:</span>
                                                            <?= $fila['insumo_hiladilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_hombrera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Hombrera:</span>
                                                            <?= $fila['insumo_hombrera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_plumilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Plumilla:</span>
                                                            <?= $fila['insumo_plumilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_pretina'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Pretina:</span>
                                                            <?= $fila['insumo_pretina'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puño'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puño:</span>
                                                            <?= $fila['insumo_puño'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_puntera'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Puntera:</span>
                                                            <?= $fila['insumo_puntera'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte:</span>
                                                            <?= $fila['insumo_resorte'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_resorte2'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Resorte 2:</span>
                                                            <?= $fila['insumo_resorte2'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_sesgo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Sesgo:</span>
                                                            <?= $fila['insumo_sesgo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_trabilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Trabilla:</span>
                                                            <?= $fila['insumo_trabilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_velcro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Velcro:</span>
                                                            <?= $fila['insumo_velcro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vinilo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vinilo:</span>
                                                            <?= $fila['insumo_vinilo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_vivo'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Vivo:</span>
                                                            <?= $fila['insumo_vivo'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 30; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Cuarta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 32; $i <= 40; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Quinta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 42; $i <= 48; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Sexta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas1 = ['XS', 'S', 'M', 'L', 'XL'];
                                            foreach ($tallas1 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Septima Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas2 = ['2XL', '3XL', '4XL', '5XL', '6XL'];
                                            foreach ($tallas2 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Octava Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $otros = $fila['otros'];
                                    $observaciones = $fila['observaciones'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Otros:</label>
                                        <?php if (empty($otros)): ?>
                                            <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo htmlspecialchars($otros); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <?php if (empty($observaciones)): ?>
                                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="4"><?php echo htmlspecialchars($observaciones); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Editar Comprados -->
                                <?php if ($fila['id_tipo_producto'] == 8): ?>


                                    <?php if (!empty($fila['id_tela']) || !empty($fila['id_telacombi']) || !empty($fila['id_telaforro']) || !empty($fila['id_bolsa']) || !empty($fila['id_marquilla'])): ?>

                                        <div class="card-text-container">
                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                    Datos sobre la cotizacion
                                                </h6>

                                                <?php if (!empty($fila['id_tela'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela:</span>
                                                            <?= $fila['insumo_tela'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telacombi'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela Combiada:</span>
                                                            <?= $fila['insumo_telacombi'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_telaforro'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Tela de Forro:</span>
                                                            <?= $fila['insumo_telaforro'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_bolsa'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Bolsa:</span>
                                                            <?= $fila['insumo_bolsa'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($fila['id_marquilla'])): ?>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;">
                                                            <span class="font-weight-bold">Tipo de Marquilla:</span>
                                                            <?= $fila['insumo_marquilla'] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- numero de prendas -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Ingrese el numero de prendas de cada Talla</h6>
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['suma_prendas'] ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                    <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Primera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 2; $i <= 10; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Segunda Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 12; $i <= 20; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Tercera Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 22; $i <= 30; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Cuarta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 32; $i <= 40; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Quinta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php for ($i = 42; $i <= 48; $i += 2) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $i ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $i ?>" value="<?= isset($fila["talla_$i"]) && $fila["talla_$i"] !== '' ? $fila["talla_$i"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <!-- Sexta Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas1 = ['XS', 'S', 'M', 'L', 'XL'];
                                            foreach ($tallas1 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Septima Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas2 = ['2XL', '3XL', '4XL', '5XL', '6XL'];
                                            foreach ($tallas2 as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;"><?= $talla ?>:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Octava Línea -->
                                        <div class="row justify-content-center text-center">
                                            <?php
                                            $tallas = ['especial'];
                                            foreach ($tallas as $talla) : ?>
                                                <div class="col-3 col-sm-2 mb-2">
                                                    <label class="form-label" style="color: #000;">Especial:</label>
                                                    <input type="number" class="form-control" name="talla_<?= $talla ?>" value="<?= isset($fila["talla_$talla"]) && $fila["talla_$talla"] !== '' ? $fila["talla_$talla"] : 0; ?>" min="0" pattern="[0-9]+" style="width: 70px;" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php
                                    $valor_agregado = $fila['valor_agregado'];
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Valor Agregado por la Empresa al Producto:</label>
                                        <?php if (empty($valor_agregado)): ?>
                                            <textarea class="form-control" name="valor_agregado" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control" name="valor_agregado" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="4"><?php echo htmlspecialchars($valor_agregado); ?></textarea>
                                        <?php endif; ?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modales Informacion -->
            <div class="modal fade" id="Info<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <?php if ($fila['id_tipo_producto'] != 8): ?>
                            <div class="modal-header justify-content-center" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); position: relative;">
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
                                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
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
                                                        $filePath = 'logos_empresas/' . $file;

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
                                                    <p class="card-text" style="color: black"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['tela'] ?>
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
                                                    <p class="card-text" style="color: black"><span class="font-weight-bold">Tipo de Tela Combinada:</span> <?= $fila['tela_combi'] ?>
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
                                                    <p class="card-text" style="color: black"><span class="font-weight-bold">Tipo de Tela Forro:</span> <?= $fila['tela_forro'] ?>
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
                                            ['id' => 'boton', 'titulo' => 'Datos del Botón Principal', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'valor' => 'valor_boton'],
                                            ['id' => 'boton2', 'titulo' => 'Datos del Botón Secundario', 'insumo' => 'insumo_boton2', 'consumo' => 'cant_boton2', 'precio' => 'precio_boton2', 'valor' => 'valor_boton2'],
                                            ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'precio' => 'precio_broche', 'valor' => 'valor_broche'],
                                            ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'valor' => 'valor_cinta'],
                                            ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'precio' => 'precio_cordon', 'valor' => 'valor_cordon'],
                                            ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera 1', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'valor' => 'valor_cremallera'],
                                            ['id' => 'cremallera2', 'titulo' => 'Datos de la Cremallera 2', 'insumo' => 'insumo_cremallera2', 'consumo' => 'cant_cremallera2', 'precio' => 'precio_cremallera2', 'valor' => 'valor_cremallera2'],
                                            ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'precio' => 'precio_cuello', 'valor' => 'valor_cuello'],
                                            ['id' => 'deslizador', 'titulo' => 'Datos del Deslizador', 'insumo' => 'insumo_deslizador', 'consumo' => 'cant_deslizador', 'precio' => 'precio_deslizador', 'valor' => 'valor_deslizador'],
                                            ['id' => 'fajon_cintura', 'titulo' => 'Datos del Fajón de Cintura', 'insumo' => 'insumo_fajon_cintura', 'consumo' => 'cant_fajon_cintura', 'precio' => 'precio_fajon_cintura', 'valor' => 'valor_fajon_cintura'],
                                            ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'valor' => 'valor_faya'],
                                            ['id' => 'fusionado', 'titulo' => 'Datos del Fusionado', 'insumo' => 'insumo_fusionado', 'consumo' => 'consumo_fusionado', 'precio' => 'precio_fusionado', 'valor' => 'valor_fusionado'],
                                            ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'precio' => 'precio_guata', 'valor' => 'valor_guata'],
                                            ['id' => 'hiladilla', 'titulo' => 'Datos de la Hiladilla', 'insumo' => 'insumo_hiladilla', 'consumo' => 'cant_hiladilla', 'precio' => 'precio_hiladilla', 'valor' => 'valor_hiladilla'],
                                            ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'precio' => 'precio_hombrera', 'valor' => 'valor_hombrera'],
                                            ['id' => 'plumilla', 'titulo' => 'Datos de la Plumilla', 'insumo' => 'insumo_plumilla', 'consumo' => 'cant_plumilla', 'precio' => 'precio_plumilla', 'valor' => 'valor_plumilla'],
                                            ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'precio' => 'precio_pretina', 'valor' => 'valor_pretina'],
                                            ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'precio' => 'precio_puño', 'valor' => 'valor_puño'],
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
                                                <?php if (!empty($fila['id_encarterada']) && $fila['id_encarterada'] != 1): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Encarterada:</span> <?= $fila['tipo_encarterada'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_encarterada'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_puesta']) && $fila['id_puesta'] != 1): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Tipo de Puesta de Cinta:</span> <?= $fila['tipo_puesta'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_puesta'] ?></p>
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
                            </div>
                        <?php endif; ?>
                        <?php if ($fila['id_tipo_producto'] == 8): ?>
                            <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
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
                                                                <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
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
                                                    $filePath = 'logos_empresas/' . $file;

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

            <!-- Pasar a llenar la Ficha Tecnica -->
            <div class="modal fade" id="fichatecnica<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="nit" value="<?php echo $fila['nit']; ?>">
                                <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                                <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Núm. Ficha Tecnica</span>
                                    <input type="text" class="form-control" name="num_ficha" value="<?= $siguiente_ficha ?>">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Codigo Orden Compra</span>
                                    <input type="text" class="form-control" name="num_orden_compra" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ.@\-_]+" maxlength="100">
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Si oprime continuar el producto pasara a ser visto por Diseño para llenar su Ficha Tecnica.
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="cambiar_estadoProducto" class="btn btn-success">Continuar</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Cargar Listado de empleados -->
            <div class="modal fade" id="AdicionarExcel<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 shadow-lg border-0">
                        <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Carga el listado de los empleados</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                <!-- <input type="hidden" name="listado_actual" value="<?php echo $fila['listado_empleados']; ?>"> -->

                                <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                    <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">Selecciona un Archivo Excel</h6>
                                    <div class="mt-4">
                                        <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                            <input type="file" class="custom-file-input" name="listado_empleados" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx" id="excelInput<?php echo $fila['id_pedido']; ?>" onchange="previewFile(this, 'excelPreview<?php echo $fila['id_pedido']; ?>', 'fileNameExcel_<?php echo $fila['id_pedido']; ?>')">
                                            <label class="custom-file-label text-truncate text-muted" for="excelInput<?php echo $fila['id_pedido']; ?>" style="max-width: 100%;"><i class="bi bi-upload"></i> Seleccionar archivo</label>
                                        </div>
                                        <div class="mt-3">
                                            <center>
                                                <img id="excelPreview<?php echo $fila['id_pedido']; ?>" class="img-thumbnail shadow-sm" style="max-width: 50%; height: auto; border-radius: 12px; display: <?php echo empty($fila['listado_empleados']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['listado_empleados']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['listado_empleados']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['listado_empleados']) ? 'listado_empleados/' . $fila['listado_empleados'] : ''; ?>">
                                                <span id="fileNameExcel_<?php echo $fila['id_pedido']; ?>" class="text-muted" style="display: <?php echo !empty($fila['listado_empleados']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['listado_empleados']) ? 'block' : 'none'; ?>;"><?php echo $fila['listado_empleados']; ?></span>
                                            </center>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer border-0">
                                    <button type="submit" name="cargar_empleados" class="btn btn-success px-4 py-2 rounded-pill">Subir</button>
                                </div>
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
                // Si el campo está vacío, restaurar el valor a 0
                if (input.value === '') {
                    input.value = '0';
                }
            }

            document.querySelectorAll('input[type=number]').forEach(input => {
                input.addEventListener('wheel', function(event) {
                    event.preventDefault();
                });
            });
        </script>
        <script>
            document.querySelectorAll('.imagenInput').forEach(input => {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById(event.target.id.replace('Input', 'Preview'));
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
        <script>
            function previewImage(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    // Validar si el archivo es una imagen
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none'; // Esconde el nombre del archivo si es una imagen
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none'; // Esconde la vista previa de la imagen si no es una imagen
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block'; // Muestra el nombre del archivo si no es una imagen
                    }
                }
            }
        </script>
        <script>
            function previewFile(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    // Validar si el archivo es una imagen
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none'; // Esconde el nombre del archivo si es una imagen
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none'; // Esconde la vista previa de la imagen si no es una imagen
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block'; // Muestra el nombre del archivo si no es una imagen
                    }
                }
            }
        </script>
    </body>
</html>