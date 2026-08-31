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

    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    function obtenerValorPost($campo, $valorPredeterminado = 0)
    {
        return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
    }

    // Formatea un precio: si son centavos en cero (",00") no los muestra,
    // si tiene centavos reales sí los muestra con 2 decimales.
    function formatoPrecio($valor)
    {
        $valor = (float) $valor;
        if (round($valor, 2) == round($valor)) {
            return number_format($valor, 0, ',', '.');
        }
        return number_format($valor, 2, ',', '.');
    }

    if (isset($_POST['consumo_precio'])) {

        $id_producto    = (int) $_POST['id_producto'];
        $id_ordencompra = (int) $_POST['id_ordencompra'];
        $id_talla       = (int) $_POST['id_talla'];
        $color_index    = (int) $_POST['color_index']; // 1 a 6
        $precio_tela    = (float) $_POST['precio_tela'];

        // Whitelist fija de tallas (nunca viene del usuario): cada una con su propia
        // columna prom{talla}_{g} (ya NO se combinan hombre/dama en un solo tier)
        $tallas_hombre = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL'];
        $tallas_dama   = ['4', '6', '8', '10', '12', '14', '16', '18', '20', '22'];
        $todas_las_tallas = array_merge($tallas_hombre, $tallas_dama, ['Especial']);

        // Whitelist: nunca interpolar el índice directo en el nombre de columna
        $columnas_consumo = [
            1 => 'consumo_tela',
            2 => 'consumo_tela2',
            3 => 'consumo_tela3',
            4 => 'consumo_tela4',
            5 => 'consumo_tela5',
            6 => 'consumo_tela6',
        ];
        $columnas_precio = [
            1 => 'precio_telacompra',
            2 => 'precio_telacompra2',
            3 => 'precio_telacompra3',
            4 => 'precio_telacompra4',
            5 => 'precio_telacompra5',
            6 => 'precio_telacompra6',
        ];

        if ($id_producto > 0 && $id_talla > 0 && isset($columnas_consumo[$color_index])) {

            // 1) Recorrer los promedios de este color (uno por talla especifica) y sumar
            $suma_consumo = 0;
            $sets_tallas = [];
            foreach ($todas_las_tallas as $talla) {
                $campo_post = 'prom' . $talla . '_' . $color_index;
                if (isset($_POST[$campo_post]) && $_POST[$campo_post] !== '') {
                    $valor = (float) str_replace(',', '.', $_POST[$campo_post]);
                    $suma_consumo += $valor;
                    $sets_tallas[] = "`prom{$talla}_{$color_index}` = " . $valor;
                } else {
                    $sets_tallas[] = "`prom{$talla}_{$color_index}` = NULL";
                }
            }

            // Los promedios se guardan en `tallas`, vinculados por id_talla
            $sql_tallas = "UPDATE tallas SET " . implode(', ', $sets_tallas) . " WHERE id_talla = $id_talla";
            mysqli_query($enlace, $sql_tallas);

            // 2) Con la suma real, calcular consumo_tela{g} y precio_telacompra{g} (siguen en orden_compra)
            $col_consumo = $columnas_consumo[$color_index];
            $col_precio  = $columnas_precio[$color_index];
            $precio_telacompra = round($precio_tela * $suma_consumo, 2);

            $sql_oc = "UPDATE orden_compra SET `$col_consumo` = $suma_consumo, `$col_precio` = $precio_telacompra
                        WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
            mysqli_query($enlace, $sql_oc);

            $_SESSION['mensaje'] = "Consumo y precio de compra guardados (color $color_index).";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "Índice de color o talla inválido.";
            $_SESSION['tipo_mensaje'] = "danger";
        }

        header("Location: orden_compra_cargar.php?id_producto=" . $id_producto);
        exit;
    }

    if (isset($_POST['guardar_observacion_telas'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $observacion    = mysqli_real_escape_string($enlace, obtenerValorPost('observaciones_telas', ''));

        $consulta = "UPDATE orden_compra SET observaciones_telas = '$observacion'
                        WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['guardar_observacion_generales'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $observacion    = mysqli_real_escape_string($enlace, obtenerValorPost('observaciones_generales', ''));

        $consulta = "UPDATE orden_compra SET observaciones_generales = '$observacion'
                        WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // operaciones de Teas e insumos homologados (producto2) y sus diferencias de compra

    if (isset($_POST['homologar_tela'])) {

        $id_producto     = (int) obtenerValorPost('id_producto');
        $id_producto2    = obtenerValorPost('id_producto2'); // vacío si aún no existe registro en producto2
        $id_ordencompra  = (int) obtenerValorPost('id_ordencompra');
        $id_tela         = (int) obtenerValorPost('id_tela');
        $precio_tela_nuevo = (float) str_replace(',', '.', obtenerValorPost('precio_tela'));
        $consumo_tela    = (float) str_replace(',', '.', obtenerValorPost('consumo_tela'));
        $color_index     = (int) obtenerValorPost('color_index'); // 1 a 6: SOLO este color se homologa
        $color_tela_nuevo  = mysqli_real_escape_string($enlace, obtenerValorPost('color_tela_nuevo', ''));
        $codigo_tela_nuevo = mysqli_real_escape_string($enlace, obtenerValorPost('codigo_tela_nuevo', ''));

        // Whitelist: nunca interpolar el índice directo en el nombre de columna
        $columnas_idtela2 = [
            1 => 'id_tela21',
            2 => 'id_tela22',
            3 => 'id_tela23',
            4 => 'id_tela24',
            5 => 'id_tela25',
            6 => 'id_tela26',
        ];
        $columnas_precio2 = [
            1 => 'precio_tela21',
            2 => 'precio_tela22',
            3 => 'precio_tela23',
            4 => 'precio_tela24',
            5 => 'precio_tela25',
            6 => 'precio_tela26',
        ];
        $columnas_color2 = [
            1 => 'color_tela',
            2 => 'color_tela2',
            3 => 'color_tela3',
            4 => 'color_tela4',
            5 => 'color_tela5',
            6 => 'color_tela6',
        ];
        $columnas_codigo2 = [
            1 => 'codigo_tela',
            2 => 'codigo_tela2',
            3 => 'codigo_tela3',
            4 => 'codigo_tela4',
            5 => 'codigo_tela5',
            6 => 'codigo_tela6',
        ];
        $columnas_precio_oc = [
            1 => 'precio_telacompra',
            2 => 'precio_telacompra2',
            3 => 'precio_telacompra3',
            4 => 'precio_telacompra4',
            5 => 'precio_telacompra5',
            6 => 'precio_telacompra6',
        ];

        if ($id_producto > 0 && isset($columnas_precio2[$color_index])) {

            $col_idtela2 = $columnas_idtela2[$color_index];
            $col_precio2 = $columnas_precio2[$color_index];
            $col_color2  = $columnas_color2[$color_index];
            $col_codigo2 = $columnas_codigo2[$color_index];
            $col_precio_oc = $columnas_precio_oc[$color_index];

            // 1) Guardar SOLO la tela/precio/color/código nuevos de ESTE color en producto2 (sin operar nada aquí)
            $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
            $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

            if ($id_producto2 !== '' && mysqli_num_rows($resultado_verificar) > 0) {
                // Ya existe el registro del producto (de otro color homologado antes): solo se actualizan las columnas de ESTE color
                $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra',
                                `$col_idtela2` = '$id_tela', `$col_precio2` = '$precio_tela_nuevo', `$col_color2` = '$color_tela_nuevo', `$col_codigo2` = '$codigo_tela_nuevo'
                                WHERE id_producto2 = '$id_producto2'";
            } else {
                // No existe ningún registro todavía para este producto: se crea
                $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, `$col_idtela2`, `$col_precio2`, `$col_color2`, `$col_codigo2`)
                                VALUES ('$id_producto', '$id_ordencompra', '$id_tela', '$precio_tela_nuevo', '$color_tela_nuevo', '$codigo_tela_nuevo')";
            }
            mysqli_query($enlace, $consulta);

            // 2) La OPERACIÓN (precio_telacompra = precio homologado x consumo de ese color) se calcula y guarda en orden_compra
            $precio_telacompra_calc = round($precio_tela_nuevo * $consumo_tela, 2);
            $consulta2 = "UPDATE orden_compra SET `$col_precio_oc` = '$precio_telacompra_calc'
                            WHERE id_ordencompra = '$id_ordencompra' AND id_producto = '$id_producto'";
            mysqli_query($enlace, $consulta2);

            $_SESSION['mensaje'] = "Tela homologada para el color $color_index.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "Índice de color inválido para homologar.";
            $_SESSION['tipo_mensaje'] = "danger";
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telacom'])) {

        $id_producto     = (int) obtenerValorPost('id_producto');
        $id_ordencompra  = (int) obtenerValorPost('id_ordencompra');
        $color_index     = (int) obtenerValorPost('color_index'); // 1 a 6: SOLO este color se actualiza
        $total_telacompra  = (float) str_replace(',', '.', obtenerValorPost('total_telacompra'));
        $consumo_realtotal = (float) str_replace(',', '.', obtenerValorPost('consumo_realtotal'));

        // Whitelist: nunca interpolar el índice directo en el nombre de columna
        $columnas_consumo_oc = [
            1 => 'consumo_tela',
            2 => 'consumo_tela2',
            3 => 'consumo_tela3',
            4 => 'consumo_tela4',
            5 => 'consumo_tela5',
            6 => 'consumo_tela6',
        ];
        $columnas_precio_oc = [
            1 => 'precio_telacompra',
            2 => 'precio_telacompra2',
            3 => 'precio_telacompra3',
            4 => 'precio_telacompra4',
            5 => 'precio_telacompra5',
            6 => 'precio_telacompra6',
        ];
        $columnas_total_compra = [
            1 => 'total_telacompra',
            2 => 'total_telacompra2',
            3 => 'total_telacompra3',
            4 => 'total_telacompra4',
            5 => 'total_telacompra5',
            6 => 'total_telacompra6',
        ];
        $columnas_dif_total = [
            1 => 'dif_total_tela',
            2 => 'dif_total_tela2',
            3 => 'dif_total_tela3',
            4 => 'dif_total_tela4',
            5 => 'dif_total_tela5',
            6 => 'dif_total_tela6',
        ];
        $columnas_consumo_real = [
            1 => 'consumo_realtotal',
            2 => 'consumo_realtotal2',
            3 => 'consumo_realtotal3',
            4 => 'consumo_realtotal4',
            5 => 'consumo_realtotal5',
            6 => 'consumo_realtotal6',
        ];
        $columnas_dif_consumo = [
            1 => 'dif_consumo_total',
            2 => 'dif_consumo_total2',
            3 => 'dif_consumo_total3',
            4 => 'dif_consumo_total4',
            5 => 'dif_consumo_total5',
            6 => 'dif_consumo_total6',
        ];

        if ($id_producto > 0 && isset($columnas_consumo_oc[$color_index])) {

            $col_consumo_oc  = $columnas_consumo_oc[$color_index];
            $col_precio_oc   = $columnas_precio_oc[$color_index];
            $col_total_compra = $columnas_total_compra[$color_index];
            $col_dif_total   = $columnas_dif_total[$color_index];
            $col_consumo_real = $columnas_consumo_real[$color_index];
            $col_dif_consumo = $columnas_dif_consumo[$color_index];

            // Traer los valores reales YA guardados de este color (consumo_tela{g}/precio_telacompra{g}),
            // en vez de confiar en lo que venga del formulario, para calcular las diferencias correctamente
            $consulta_actual = "SELECT `$col_consumo_oc` AS consumo_actual, `$col_precio_oc` AS precio_actual
                                    FROM orden_compra WHERE id_ordencompra = '$id_ordencompra' AND id_producto = '$id_producto'";
            $resultado_actual = mysqli_query($enlace, $consulta_actual);
            $fila_actual = mysqli_fetch_assoc($resultado_actual);

            $consumo_tela_g = (float) ($fila_actual['consumo_actual'] ?? 0);
            $precio_telacompra_g = (float) ($fila_actual['precio_actual'] ?? 0);

            $dif_total_tela = $precio_telacompra_g - $total_telacompra;
            $dif_consumo_total = $consumo_realtotal - $consumo_tela_g;

            $consulta = "UPDATE orden_compra SET
                            `$col_total_compra` = '$total_telacompra',
                            `$col_consumo_real` = '$consumo_realtotal',
                            `$col_dif_total` = '$dif_total_tela',
                            `$col_dif_consumo` = '$dif_consumo_total'
                            WHERE id_ordencompra = '$id_ordencompra' AND id_producto = '$id_producto'";

            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compratela'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $color_index    = (int) obtenerValorPost('color_index'); // 1 a 6: SOLO ese color guarda su archivo

        // Whitelist: nunca interpolar el índice directo en el nombre de columna
        $columnas_archivo = [
            1 => 'orden_compratela',
            2 => 'orden_compratela2',
            3 => 'orden_compratela3',
            4 => 'orden_compratela4',
            5 => 'orden_compratela5',
            6 => 'orden_compratela6',
        ];
        $columnas_fecha_recibido = [
            1 => 'fecha_recibido_tela',
            2 => 'fecha_recibido_tela2',
            3 => 'fecha_recibido_tela3',
            4 => 'fecha_recibido_tela4',
            5 => 'fecha_recibido_tela5',
            6 => 'fecha_recibido_tela6',
        ];

        if (isset($columnas_archivo[$color_index]) && !empty($_FILES['orden_compratela']['tmp_name'])) {

            $col_archivo = $columnas_archivo[$color_index];
            $col_fecha_recibido = $columnas_fecha_recibido[$color_index];

            $carpeta_destino = __DIR__ . "/orden_compra/";
            if (!is_dir($carpeta_destino)) {
                mkdir($carpeta_destino, 0775, true);
            }

            $nombre_original = $_FILES['orden_compratela']['name'];
            $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
            $nombre_base = preg_replace('/[^A-Za-z0-9_-]/', '_', pathinfo($nombre_original, PATHINFO_FILENAME));

            // Nombre único por producto/color, para no pisar archivos de otras tablas ni de otros productos
            $orden_nombre = "op{$id_producto}_c{$color_index}_" . time() . "_{$nombre_base}.{$extension}";
            $orden_temporal = $_FILES['orden_compratela']['tmp_name'];

            if (move_uploaded_file($orden_temporal, $carpeta_destino . $orden_nombre)) {
                // La fecha de recibido se registra automáticamente el día que se sube la orden
                $hoy = date('Y-m-d');
                $consulta = "UPDATE orden_compra SET `$col_archivo` = '$orden_nombre', `$col_fecha_recibido` = '$hoy'
                                WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
                mysqli_query($enlace, $consulta);
            } else {
                $_SESSION['mensaje'] = "No se pudo guardar el archivo. Verifica permisos de la carpeta orden_compra/.";
                $_SESSION['tipo_mensaje'] = "danger";
            }
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_telacombi'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $id_telacombi = obtenerValorPost('id_telacombi');
        $precio_telacombinada = obtenerValorPost('precio_telacombinada');

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_telacombi2 = '$id_telacombi', precio_telacombi2 = '$precio_telacombinada'
                        WHERE id_producto2 = '$id_producto2'";
        } else {
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_telacombi2, precio_telacombi2)
                        VALUES ('$id_producto', '$id_ordencompra', '$id_telacombi', '$precio_telacombinada')";
        }

        mysqli_query($enlace, $consulta);

        // La OPERACIÓN (Valor Cotizado = precio homologado x Metros Pedidos ya guardados) se
        // recalcula y guarda en orden_compra, igual que hace tela al homologar.
        $consulta_consumo = "SELECT consumo_telacombi FROM orden_compra WHERE id_producto = '$id_producto' AND id_ordencompra = '$id_ordencompra'";
        $resultado_consumo = mysqli_query($enlace, $consulta_consumo);
        $fila_consumo = mysqli_fetch_assoc($resultado_consumo);
        $consumo_telacombi_actual = (float) ($fila_consumo['consumo_telacombi'] ?? 0);

        $precio_telacombicompra_calc = round((float) $precio_telacombinada * $consumo_telacombi_actual, 2);
        $consulta2 = "UPDATE orden_compra SET precio_telacombicompra = '$precio_telacombicompra_calc'
                    WHERE id_ordencompra = '$id_ordencompra' AND id_producto = '$id_producto'";
        mysqli_query($enlace, $consulta2);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_telaforro'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $id_telaforro = obtenerValorPost('id_telaforro');
        $precio_forro = obtenerValorPost('precio_forro');

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_telaforro2 = '$id_telaforro', precio_forro2 = '$precio_forro'
                        WHERE id_producto2 = '$id_producto2'";
        } else {
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_telaforro2, precio_forro2)
                        VALUES ('$id_producto', '$id_ordencompra', '$id_telaforro', '$precio_forro')";
        }

        mysqli_query($enlace, $consulta);

        // La OPERACIÓN (Valor Cotizado = precio homologado x Metros Pedidos ya guardados) se
        // recalcula y guarda en orden_compra, igual que hace tela al homologar.
        $consulta_consumo = "SELECT consumo_telaforro FROM orden_compra WHERE id_producto = '$id_producto' AND id_ordencompra = '$id_ordencompra'";
        $resultado_consumo = mysqli_query($enlace, $consulta_consumo);
        $fila_consumo = mysqli_fetch_assoc($resultado_consumo);
        $consumo_telaforro_actual = (float) ($fila_consumo['consumo_telaforro'] ?? 0);

        $precio_telaforrocompra_calc = round((float) $precio_forro * $consumo_telaforro_actual, 2);
        $consulta2 = "UPDATE orden_compra SET precio_telaforrocompra = '$precio_telaforrocompra_calc'
                    WHERE id_ordencompra = '$id_ordencompra' AND id_producto = '$id_producto'";
        mysqli_query($enlace, $consulta2);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // Guardar Metros Pedidos (consumo manual, no viene de promedios) y calcular Valor Cotizado,
    // igual que el botón "Guardar" de tela pero sin la grilla de promedios.
    if (isset($_POST['guardar_consumo_telacombi'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $consumo_telacombi = (float) str_replace(',', '.', obtenerValorPost('consumo_telacombi'));
        $precio_efectivo   = (float) str_replace(',', '.', obtenerValorPost('precio_efectivo'));

        $precio_telacombicompra = round($precio_efectivo * $consumo_telacombi, 2);

        $consulta = "UPDATE orden_compra SET consumo_telacombi = $consumo_telacombi, precio_telacombicompra = $precio_telacombicompra
                    WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['guardar_consumo_telaforro'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $consumo_telaforro = (float) str_replace(',', '.', obtenerValorPost('consumo_telaforro'));
        $precio_efectivo   = (float) str_replace(',', '.', obtenerValorPost('precio_efectivo'));

        $precio_telaforrocompra = round($precio_efectivo * $consumo_telaforro, 2);

        $consulta = "UPDATE orden_compra SET consumo_telaforro = $consumo_telaforro, precio_telaforrocompra = $precio_telaforrocompra
                    WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // "Comprado" de tela combinada: un solo diff de dinero y uno de metros, igual que tela.
    // Sirve tanto para la tela cotizada como para la homologada (mismo botón, mismos campos).
    if (isset($_POST['dif_telacombicom'])) {

        $id_producto      = (int) obtenerValorPost('id_producto');
        $id_ordencompra   = (int) obtenerValorPost('id_ordencompra');
        $precio_telacombicompra = (float) str_replace(',', '.', obtenerValorPost('precio_telacombicompra'));
        $consumo_telacombi      = (float) str_replace(',', '.', obtenerValorPost('consumo_telacombi'));
        $total_telacombicompra  = (float) str_replace(',', '.', obtenerValorPost('total_telacombicompra'));
        $consumo_combinadatotal = obtenerValorPost('consumo_combinadatotal', '');

        $dif_total_telacombi = $precio_telacombicompra - $total_telacombicompra;
        $dif_consumocombi_total = null;
        if ($consumo_combinadatotal !== '') {
            $dif_consumocombi_total = (float) str_replace(',', '.', $consumo_combinadatotal) - $consumo_telacombi;
        }

        $sets = [];
        $sets[] = "total_telacombicompra = $total_telacombicompra";
        $sets[] = "dif_total_telacombi = $dif_total_telacombi";
        $sets[] = "consumo_combinadatotal = " . ($consumo_combinadatotal !== '' ? (float) str_replace(',', '.', $consumo_combinadatotal) : 'NULL');
        $sets[] = "dif_consumocombi_total = " . ($dif_consumocombi_total !== null ? $dif_consumocombi_total : 'NULL');

        $consulta = "UPDATE orden_compra SET " . implode(', ', $sets) . " WHERE id_ordencompra = $id_ordencompra AND id_producto = $id_producto";
        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compratelacombi'])) {

        $id_producto = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');

        if (!empty($_FILES['orden_compratelacombi']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compratelacombi']['name'];
            $orden_temporal = $_FILES['orden_compratelacombi']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            // La fecha de recibido se registra automáticamente el día que se sube la orden
            $hoy = date('Y-m-d');
            $consulta = "UPDATE orden_compra SET orden_compratelacombi = '$orden_nombre', fecha_recibido_telacombi = '$hoy' WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // "Comprado" de tela forro: mismo patrón que tela combinada
    if (isset($_POST['dif_telaforrocom'])) {

        $id_producto      = (int) obtenerValorPost('id_producto');
        $id_ordencompra   = (int) obtenerValorPost('id_ordencompra');
        $precio_telaforrocompra = (float) str_replace(',', '.', obtenerValorPost('precio_telaforrocompra'));
        $consumo_telaforro      = (float) str_replace(',', '.', obtenerValorPost('consumo_telaforro'));
        $total_telaforrocompra  = (float) str_replace(',', '.', obtenerValorPost('total_telaforrocompra'));
        $consumo_forrototal     = obtenerValorPost('consumo_forrototal', '');

        $dif_total_telaforro = $precio_telaforrocompra - $total_telaforrocompra;
        $dif_consumoforro_total = null;
        if ($consumo_forrototal !== '') {
            $dif_consumoforro_total = (float) str_replace(',', '.', $consumo_forrototal) - $consumo_telaforro;
        }

        $sets = [];
        $sets[] = "total_telaforrocompra = $total_telaforrocompra";
        $sets[] = "dif_total_telaforro = $dif_total_telaforro";
        $sets[] = "consumo_forrototal = " . ($consumo_forrototal !== '' ? (float) str_replace(',', '.', $consumo_forrototal) : 'NULL');
        $sets[] = "dif_consumoforro_total = " . ($dif_consumoforro_total !== null ? $dif_consumoforro_total : 'NULL');

        $consulta = "UPDATE orden_compra SET " . implode(', ', $sets) . " WHERE id_ordencompra = $id_ordencompra AND id_producto = $id_producto";
        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compratelaforro'])) {

        $id_producto = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');

        if (!empty($_FILES['orden_compratelaforro']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compratelaforro']['name'];
            $orden_temporal = $_FILES['orden_compratelaforro']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            // La fecha de recibido se registra automáticamente el día que se sube la orden
            $hoy = date('Y-m-d');
            $consulta = "UPDATE orden_compra SET orden_compratelaforro = '$orden_nombre', fecha_recibido_telaforro = '$hoy' WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // Prenda Comprada (producto tipo 8): mismo patrón de "un solo dif" que insumos,
    // pero por color (1 a 6), como tela. No se homologa (no aplica, como marquilla/bolsa).
    if (isset($_POST['dif_prendacom'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $color_index    = (int) obtenerValorPost('color_index'); // 1 a 6

        $precio_prendacompra_g = (float) str_replace(',', '.', obtenerValorPost('precio_prendacompra_actual'));
        $prendas_comprar_g     = (float) str_replace(',', '.', obtenerValorPost('prendas_comprar_actual'));
        $total_prendacompra    = (float) str_replace(',', '.', obtenerValorPost('total_prendacompra'));
        $unidades_recibidas    = obtenerValorPost('unidades_recibidas_prenda', '');

        // Whitelist: nunca interpolar el índice directo en el nombre de columna
        $columnas_total_compra = [
            1 => 'total_prendacompra',  2 => 'total_prendacompra2', 3 => 'total_prendacompra3',
            4 => 'total_prendacompra4', 5 => 'total_prendacompra5', 6 => 'total_prendacompra6',
        ];
        $columnas_dif_total = [
            1 => 'dif_total_prenda',  2 => 'dif_total_prenda2', 3 => 'dif_total_prenda3',
            4 => 'dif_total_prenda4', 5 => 'dif_total_prenda5', 6 => 'dif_total_prenda6',
        ];
        $columnas_unidades_recibidas = [
            1 => 'unidades_recibidas_prenda',  2 => 'unidades_recibidas_prenda2', 3 => 'unidades_recibidas_prenda3',
            4 => 'unidades_recibidas_prenda4', 5 => 'unidades_recibidas_prenda5', 6 => 'unidades_recibidas_prenda6',
        ];
        $columnas_dif_unidades = [
            1 => 'dif_unidades_prenda',  2 => 'dif_unidades_prenda2', 3 => 'dif_unidades_prenda3',
            4 => 'dif_unidades_prenda4', 5 => 'dif_unidades_prenda5', 6 => 'dif_unidades_prenda6',
        ];

        if ($id_producto > 0 && isset($columnas_total_compra[$color_index])) {
            $col_total_compra = $columnas_total_compra[$color_index];
            $col_dif_total = $columnas_dif_total[$color_index];
            $col_unidades_recibidas = $columnas_unidades_recibidas[$color_index];
            $col_dif_unidades = $columnas_dif_unidades[$color_index];

            $dif_total = $precio_prendacompra_g - $total_prendacompra;

            $dif_unidades = null;
            if ($unidades_recibidas !== '') {
                $dif_unidades = (float) str_replace(',', '.', $unidades_recibidas) - $prendas_comprar_g;
            }

            $sets = [];
            $sets[] = "`$col_total_compra` = $total_prendacompra";
            $sets[] = "`$col_dif_total` = $dif_total";
            $sets[] = "`$col_unidades_recibidas` = " . ($unidades_recibidas !== '' ? (float) str_replace(',', '.', $unidades_recibidas) : 'NULL');
            $sets[] = "`$col_dif_unidades` = " . ($dif_unidades !== null ? $dif_unidades : 'NULL');

            $consulta = "UPDATE orden_compra SET " . implode(', ', $sets) . " WHERE id_ordencompra = $id_ordencompra AND id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraprenda'])) {

        $id_producto    = (int) obtenerValorPost('id_producto');
        $id_ordencompra = (int) obtenerValorPost('id_ordencompra');
        $color_index    = (int) obtenerValorPost('color_index');

        $columnas_archivo = [
            1 => 'orden_compraprenda',  2 => 'orden_compraprenda2', 3 => 'orden_compraprenda3',
            4 => 'orden_compraprenda4', 5 => 'orden_compraprenda5', 6 => 'orden_compraprenda6',
        ];
        $columnas_fecha_recibido = [
            1 => 'fecha_recibido_prenda',  2 => 'fecha_recibido_prenda2', 3 => 'fecha_recibido_prenda3',
            4 => 'fecha_recibido_prenda4', 5 => 'fecha_recibido_prenda5', 6 => 'fecha_recibido_prenda6',
        ];

        if (isset($columnas_archivo[$color_index]) && !empty($_FILES['orden_compraprenda']['tmp_name'])) {
            $col_archivo = $columnas_archivo[$color_index];
            $col_fecha_recibido = $columnas_fecha_recibido[$color_index];

            $orden_nombre   = $_FILES['orden_compraprenda']['name'];
            $orden_temporal = $_FILES['orden_compraprenda']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            // La fecha de recibido se registra automáticamente el día que se sube la orden
            $hoy = date('Y-m-d');
            $consulta = "UPDATE orden_compra SET `$col_archivo` = '$orden_nombre', `$col_fecha_recibido` = '$hoy' WHERE id_producto = $id_producto AND id_ordencompra = $id_ordencompra";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_insumos'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');

        // Consultar si ya existe en producto2
        $consulta_existente = "SELECT * FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_existente = mysqli_query($enlace, $consulta_existente);
        $datos_actuales = ($resultado_existente && mysqli_num_rows($resultado_existente) > 0)
            ? mysqli_fetch_assoc($resultado_existente)
            : [];

        // Lista de insumos homologables (marquilla/bolsa NO entran aquí: no se pueden homologar)
        $insumos = [
            'cuello',
            'puño',
            'velcro',
            'hombrera',
            'sesgo',
            'trabilla',
            'vivo',
            'guata',
            'pretina',
            'broche',
            'cordon',
            'puntera',
            'plumilla',
            'vinilo',
            'deslizador',
            'fajon_cintura',
            'hiladilla',
            'boton',
            'boton2',
            'cremallera',
            'cremallera2',
            'resorte',
            'resorte2',
            'cinta',
            'faya',
            'entretela',
            'entretela2'
        ];

        // Sufijo de columna en producto2: por defecto "{insumo}2", salvo estos casos
        // especiales donde ese nombre ya lo usa el insumo "base" (colisión), así que
        // se usan los sufijos "22"/"222" que ya existen en la tabla.
        $sufijo_producto2 = [
            'boton' => 'boton22',
            'boton2' => 'boton222',
            'cremallera' => 'cremallera22',
            'cremallera2' => 'cremallera222',
            'resorte' => 'resorte22',
            'resorte2' => 'resorte222',
            'entretela' => 'entretela22',
            'entretela2' => 'entretela222',
        ];

        $campos_sql = [];

        foreach ($insumos as $insumo) {
            $id_key = "id_$insumo";
            $precio_key = "precio_$insumo";
            $sufijo = $sufijo_producto2[$insumo] ?? "{$insumo}2";

            if (isset($_POST[$id_key])) {
                $id = obtenerValorPost($id_key, $datos_actuales["id_{$sufijo}"] ?? null);
                $precio = obtenerValorPost($precio_key, $datos_actuales["precio_{$sufijo}"] ?? 0);

                // Solo se guarda id + precio (el resto de cálculos vive en orden_compra)
                $campos_sql[] = "id_{$sufijo} = '$id'";
                $campos_sql[] = "precio_{$sufijo} = '$precio'";

                break; // Solo se procesa un insumo por vez
            }
        }

        if (empty($campos_sql)) {
            die("No se detectó ningún insumo válido en el formulario.");
        }

        if (!empty($datos_actuales)) {
            // UPDATE
            $campos_sql[] = "id_ordencompra = '$id_ordencompra'";
            $consulta = "UPDATE producto2 SET " . implode(", ", $campos_sql) . " WHERE id_producto2 = '$id_producto2'";
        } else {
            // INSERT
            $columnas = implode(", ", array_merge(['id_producto', 'id_ordencompra'], array_map(fn($c) => trim(explode("=", $c)[0]), $campos_sql)));
            $valores = implode(", ", array_merge(["'$id_producto'", "'$id_ordencompra'"], array_map(fn($c) => trim(explode("=", $c)[1]), $campos_sql)));
            $consulta = "INSERT INTO producto2 ($columnas) VALUES ($valores)";
        }

        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // 🔹 Listado de insumos manejados (incluye los que antes tenían handlers duplicados)
    $insumos = [
        'cuello', 'puño', 'velcro', 'hombrera', 'sesgo', 'trabilla', 'vivo', 'guata', 'pretina', 'broche', 'cordon', 'puntera', 'plumilla', 'vinilo', 'deslizador', 
        'fajon_cintura', 'hiladilla', 'boton', 'boton2', 'cremallera', 'cremallera2', 'resorte', 'resorte2', 'cinta', 'faya', 'entretela', 'entretela2', 'marquilla', 'bolsa'
    ];

    foreach ($insumos as $insumo) {

        // "Comprado" (tela cotizada, sin homologar) y "Comprado" (homologada) comparten
        // la misma lógica simplificada: UN solo diff de dinero (dif_total_{insumo}) y
        // el nuevo seguimiento de unidades recibidas / diferencia de unidades / fecha.
        if (isset($_POST["dif_{$insumo}com"]) || isset($_POST["dif_{$insumo}com2"])) {

            $id_producto      = (int) obtenerValorPost('id_producto');
            $id_ordencompra   = (int) obtenerValorPost('id_ordencompra');
            $consumo_total    = (float) str_replace(',', '.', obtenerValorPost("consumo_total{$insumo}"));
            $total_cotizado   = (float) str_replace(',', '.', obtenerValorPost("total_{$insumo}cotizado"));
            $total_compra     = (float) str_replace(',', '.', obtenerValorPost("total_{$insumo}compra"));
            $unidades_recibidas = obtenerValorPost("unidades_recibidas_{$insumo}", '');
            $fecha_recibido     = obtenerValorPost("fecha_recibido_{$insumo}", '');

            // Diferencia de dinero (único diff de dinero, ya no se maneja dif_und)
            $dif_total = $total_cotizado - $total_compra;

            // Diferencia de unidades: si lo recibido es mayor, es ganancia (positivo);
            // si es menor, es pérdida (negativo)
            $dif_unidades = null;
            if ($unidades_recibidas !== '') {
                $unidades_recibidas_num = (float) str_replace(',', '.', $unidades_recibidas);
                $dif_unidades = $unidades_recibidas_num - $consumo_total;
            }

            $sets = [];
            $sets[] = "total_{$insumo}cotizado = " . $total_cotizado;
            $sets[] = "total_{$insumo}compra = " . $total_compra;
            $sets[] = "dif_total_{$insumo} = " . $dif_total;
            $sets[] = "unidades_recibidas_{$insumo} = " . ($unidades_recibidas !== '' ? (float) str_replace(',', '.', $unidades_recibidas) : 'NULL');
            $sets[] = "dif_unidades_{$insumo} = " . ($dif_unidades !== null ? $dif_unidades : 'NULL');
            $sets[] = "fecha_recibido_{$insumo} = " . ($fecha_recibido !== '' ? "'" . mysqli_real_escape_string($enlace, $fecha_recibido) . "'" : 'NULL');

            $consulta = "UPDATE orden_compra SET " . implode(', ', $sets) . " WHERE id_ordencompra = $id_ordencompra AND id_producto = $id_producto";
            mysqli_query($enlace, $consulta);

            header("Location: orden_compra_cargar.php?id_producto=$id_producto");
            exit();
        }

        if (isset($_POST["cargar_orden_compra{$insumo}"])) {

            $id_producto = $_POST['id_producto'];

            if (!empty($_FILES["orden_compra{$insumo}"]['tmp_name'])) {
                $orden_nombre   = $_FILES["orden_compra{$insumo}"]['name'];
                $orden_temporal = $_FILES["orden_compra{$insumo}"]['tmp_name'];

                move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

                // La fecha de recibido se registra automáticamente el día que se sube la orden
                $hoy = date('Y-m-d');
                $consulta = "UPDATE orden_compra SET orden_compra{$insumo} = '$orden_nombre', fecha_recibido_{$insumo} = '$hoy' WHERE id_producto = $id_producto";
                mysqli_query($enlace, $consulta);
            }

            header("Location: orden_compra_cargar.php?id_producto=$id_producto");
            exit();
        }
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
        <link rel="icon" type="image/png" href="../../img/Logo.png">

        <style>
            /* Botones un poco más redondeados en general (no solo en tela) */
            .btn {
                border-radius: 0.5rem;
            }

            /* Centrar los botones de las tablas, tanto a lo ancho como a lo alto de la celda */
            .table td {
                vertical-align: middle !important;
            }
            .table td form {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 4px;
                height: 100%;
            }
            .table td .btn,
            .table td > a.btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-left: auto;
                margin-right: auto;
            }
        </style>

        <title>Compras | Ordenes de Compra</title>

    <head>

    <body>
        <?php
        $consulta = "SELECT 
            producto.id_producto, producto2.id_producto2, ficha_tecnica.num_ficha, ficha_tecnica.id_producto, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, ficha_tecnica.id_producto, orden_compra.id_producto, orden_compra.id_ordencompra, ficha_tecnica.num_ficha, prenda.id_prenda, prenda.nombre_prenda, 
            producto.suma_prendas, producto.nombre_proveedor, producto.precio_compra,
            tela.id_tela, tela.tela, producto.precio_tela, producto.color_tela, producto.promedio_consumo, producto.valor_tela,
            orden_compra.orden_compratela, orden_compra.orden_compratela2, orden_compra.orden_compratela3, orden_compra.orden_compratela4, orden_compra.orden_compratela5, orden_compra.orden_compratela6, orden_compra.observaciones_telas,
            producto2.id_tela21, producto2.id_tela22, producto2.id_tela23, producto2.id_tela24, producto2.id_tela25, producto2.id_tela26,
            producto2.precio_tela21, producto2.precio_tela22, producto2.precio_tela23, producto2.precio_tela24, producto2.precio_tela25, producto2.precio_tela26,
            producto2.color_tela AS p2_color_tela, producto2.color_tela2 AS p2_color_tela2, producto2.color_tela3 AS p2_color_tela3, producto2.color_tela4 AS p2_color_tela4, producto2.color_tela5 AS p2_color_tela5, producto2.color_tela6 AS p2_color_tela6,
            producto2.codigo_tela AS p2_codigo_tela, producto2.codigo_tela2 AS p2_codigo_tela2, producto2.codigo_tela3 AS p2_codigo_tela3, producto2.codigo_tela4 AS p2_codigo_tela4, producto2.codigo_tela5 AS p2_codigo_tela5, producto2.codigo_tela6 AS p2_codigo_tela6,
            orden_compra.consumo_tela, orden_compra.consumo_tela2, orden_compra.consumo_tela3, orden_compra.consumo_tela4, orden_compra.consumo_tela5, orden_compra.consumo_tela6,
            orden_compra.precio_telacompra, orden_compra.precio_telacompra2, orden_compra.precio_telacompra3, orden_compra.precio_telacompra4, orden_compra.precio_telacompra5, orden_compra.precio_telacompra6,
            orden_compra.total_telacompra, orden_compra.dif_total_tela, orden_compra.consumo_realtotal, orden_compra.dif_consumo_total, orden_compra.fecha_recibido_tela,
            orden_compra.total_telacompra2, orden_compra.dif_total_tela2, orden_compra.consumo_realtotal2, orden_compra.dif_consumo_total2, orden_compra.fecha_recibido_tela2,
            orden_compra.total_telacompra3, orden_compra.dif_total_tela3, orden_compra.consumo_realtotal3, orden_compra.dif_consumo_total3, orden_compra.fecha_recibido_tela3,
            orden_compra.total_telacompra4, orden_compra.dif_total_tela4, orden_compra.consumo_realtotal4, orden_compra.dif_consumo_total4, orden_compra.fecha_recibido_tela4,
            orden_compra.total_telacompra5, orden_compra.dif_total_tela5, orden_compra.consumo_realtotal5, orden_compra.dif_consumo_total5, orden_compra.fecha_recibido_tela5,
            orden_compra.total_telacompra6, orden_compra.dif_total_tela6, orden_compra.consumo_realtotal6, orden_compra.dif_consumo_total6, orden_compra.fecha_recibido_tela6,
            proveedor_tela.id_proveedor, proveedor_tela.nombre,
            tallas.id_talla,
            tallas.promXS_1, tallas.promS_1, tallas.promM_1, tallas.promL_1, tallas.promXL_1, tallas.prom2XL_1, tallas.prom3XL_1, tallas.prom4XL_1, tallas.prom5XL_1, tallas.prom6XL_1,
            tallas.prom4_1, tallas.prom6_1, tallas.prom8_1, tallas.prom10_1, tallas.prom12_1, tallas.prom14_1, tallas.prom16_1, tallas.prom18_1, tallas.prom20_1, tallas.prom22_1, tallas.promEspecial_1,
            tallas.promXS_2, tallas.promS_2, tallas.promM_2, tallas.promL_2, tallas.promXL_2, tallas.prom2XL_2, tallas.prom3XL_2, tallas.prom4XL_2, tallas.prom5XL_2, tallas.prom6XL_2,
            tallas.prom4_2, tallas.prom6_2, tallas.prom8_2, tallas.prom10_2, tallas.prom12_2, tallas.prom14_2, tallas.prom16_2, tallas.prom18_2, tallas.prom20_2, tallas.prom22_2, tallas.promEspecial_2,
            tallas.promXS_3, tallas.promS_3, tallas.promM_3, tallas.promL_3, tallas.promXL_3, tallas.prom2XL_3, tallas.prom3XL_3, tallas.prom4XL_3, tallas.prom5XL_3, tallas.prom6XL_3,
            tallas.prom4_3, tallas.prom6_3, tallas.prom8_3, tallas.prom10_3, tallas.prom12_3, tallas.prom14_3, tallas.prom16_3, tallas.prom18_3, tallas.prom20_3, tallas.prom22_3, tallas.promEspecial_3,
            tallas.promXS_4, tallas.promS_4, tallas.promM_4, tallas.promL_4, tallas.promXL_4, tallas.prom2XL_4, tallas.prom3XL_4, tallas.prom4XL_4, tallas.prom5XL_4, tallas.prom6XL_4,
            tallas.prom4_4, tallas.prom6_4, tallas.prom8_4, tallas.prom10_4, tallas.prom12_4, tallas.prom14_4, tallas.prom16_4, tallas.prom18_4, tallas.prom20_4, tallas.prom22_4, tallas.promEspecial_4,
            tallas.promXS_5, tallas.promS_5, tallas.promM_5, tallas.promL_5, tallas.promXL_5, tallas.prom2XL_5, tallas.prom3XL_5, tallas.prom4XL_5, tallas.prom5XL_5, tallas.prom6XL_5,
            tallas.prom4_5, tallas.prom6_5, tallas.prom8_5, tallas.prom10_5, tallas.prom12_5, tallas.prom14_5, tallas.prom16_5, tallas.prom18_5, tallas.prom20_5, tallas.prom22_5, tallas.promEspecial_5,
            tallas.promXS_6, tallas.promS_6, tallas.promM_6, tallas.promL_6, tallas.promXL_6, tallas.prom2XL_6, tallas.prom3XL_6, tallas.prom4XL_6, tallas.prom5XL_6, tallas.prom6XL_6,
            tallas.prom4_6, tallas.prom6_6, tallas.prom8_6, tallas.prom10_6, tallas.prom12_6, tallas.prom14_6, tallas.prom16_6, tallas.prom18_6, tallas.prom20_6, tallas.prom22_6, tallas.promEspecial_6,
            tela_combinada.id_telacombi, tela_combinada.tela_combi, producto.precio_telacombinada, producto.color_telacombi, producto2.id_telacombi2, producto2.precio_telacombi2, orden_compra.consumo_combinadatotal, orden_compra.consumo_telacombi, orden_compra.precio_telacombicompra, orden_compra.dif_total_telacombi, orden_compra.dif_consumocombi_total, orden_compra.total_telacombicompra, orden_compra.fecha_recibido_telacombi, orden_compra.orden_compratelacombi,
            tela_forro.id_telaforro, tela_forro.tela_forro, producto.precio_forro, producto.color_telaforro, producto2.id_telaforro2, producto2.precio_forro2, orden_compra.consumo_forrototal, orden_compra.consumo_telaforro, orden_compra.precio_telaforrocompra, orden_compra.dif_total_telaforro, orden_compra.dif_consumoforro_total, orden_compra.total_telaforrocompra, orden_compra.fecha_recibido_telaforro, orden_compra.orden_compratelaforro,
            entretela.id_entretela, entretela.insumo AS insumo_entretela, producto.cant_entretela, producto.precio_entretela, producto.valor_entretela, producto2.id_entretela22,
            entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2, producto.cant_entretela2, producto.precio_entretela2, producto.valor_entretela2, producto2.id_entretela222,
            bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa,
            boton.id_boton, boton.insumo AS insumo_boton, producto.cant_boton, producto.precio_boton, producto.valor_boton, producto2.id_boton22,
            boton2.id_boton2, boton2.insumo AS insumo_boton2, producto.cant_boton2, producto.precio_boton2, producto.valor_boton2, producto2.id_boton222,
            broche.id_broche, broche.insumo AS insumo_broche, producto.cant_broche, producto.precio_broche, producto.valor_broche, producto2.id_broche2,
            cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, producto.cant_faya, producto.precio_faya, producto.valor_faya, producto2.id_faya2,
            cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_cinta, producto.cant_cinta, producto.precio_cinta, producto.valor_cinta, producto2.id_cinta2,
            cordon.id_cordon, cordon.insumo AS insumo_cordon, producto.cant_cordon, producto.precio_cordon, producto.valor_cordon, producto2.id_cordon2,
            cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, producto.cant_cremallera, producto.precio_cremallera, producto.valor_cremallera, producto2.id_cremallera22,
            cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, producto.cant_cremallera2, producto.precio_cremallera2, producto.valor_cremallera2, producto2.id_cremallera222,
            cuello.id_cuello, cuello.insumo AS insumo_cuello, producto.consumo_cuello, producto.consumo_cuello, producto.precio_cuello, producto.valor_cuello, producto2.id_cuello2,
            deslizador.id_deslizador, deslizador.insumo AS insumo_deslizador, producto.cant_deslizador, producto.precio_deslizador, producto.valor_deslizador, producto2.id_deslizador2,
            fajon_cintura.id_fajon_cintura, fajon_cintura.insumo AS insumo_fajon_cintura, producto.cant_fajon_cintura, producto.precio_fajon_cintura, producto.valor_fajon_cintura, producto2.id_fajon_cintura2,
            guata.id_guata, guata.insumo AS insumo_guata, producto.cant_guata, producto.precio_guata, producto.valor_guata, producto2.id_guata2,
            hiladilla.id_hiladilla, hiladilla.insumo AS insumo_hiladilla, producto.cant_hiladilla, producto.precio_hiladilla, producto.valor_hiladilla, producto2.id_hiladilla2,
            hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, producto.cant_hombrera, producto.precio_hombrera, producto.valor_hombrera, producto2.id_hombrera2,
            marquilla.id_marquilla, marquilla.insumo AS insumo_marquilla, marquilla.precio AS precio_marquilla,
            plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla, producto.cant_plumilla, producto.precio_plumilla, producto.valor_plumilla, producto2.id_plumilla2,
            pretina.id_pretina, pretina.insumo AS insumo_pretina, producto.cant_pretina, producto.precio_pretina, producto.valor_pretina, producto2.id_pretina2,
            puntera.id_puntera, puntera.insumo AS insumo_puntera, producto.cant_puntera, producto.precio_puntera, producto.valor_puntera, producto2.id_puntera2,
            puño.id_puño, puño.insumo AS insumo_puño, producto.consumo_puño, producto.consumo_puño, producto.precio_puño, producto.valor_puño, producto2.id_puño2,
            resorte.id_resorte, resorte.insumo AS insumo_resorte, producto.cant_resorte, producto.precio_resorte, producto.valor_resorte, producto2.id_resorte22,
            resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, producto.cant_resorte2, producto.precio_resorte2,producto.valor_resorte2, producto2.id_resorte222,
            sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo,producto.cant_sesgo,producto.precio_sesgo,producto.valor_sesgo, producto2.id_sesgo2,
            trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla,producto.cant_trabilla,producto.precio_trabilla,producto.valor_trabilla, producto2.id_trabilla2,
            velcro.id_velcro, velcro.insumo AS insumo_velcro, producto.cant_velcro, producto.precio_velcro, producto.valor_velcro, producto2.id_velcro2,
            vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo, producto.cant_vinilo, producto.precio_vinilo, producto.valor_vinilo, producto2.id_vinilo2,
            vivo.id_vivo, vivo.insumo AS insumo_vivo, producto.cant_vivo, producto.precio_vivo, producto.valor_vivo, producto2.id_vivo2,
            orden_compra.consumo_totalentretela, orden_compra.total_entretelacotizado, orden_compra.total_entretelacompra, orden_compra.dif_total_entretela, orden_compra.unidades_recibidas_entretela, orden_compra.dif_unidades_entretela, orden_compra.fecha_recibido_entretela, orden_compra.orden_compraentretela,
            orden_compra.consumo_totalentretela2, orden_compra.total_entretela2cotizado, orden_compra.total_entretela2compra, orden_compra.dif_total_entretela2, orden_compra.unidades_recibidas_entretela2, orden_compra.dif_unidades_entretela2, orden_compra.fecha_recibido_entretela2, orden_compra.orden_compraentretela2,
            orden_compra.total_bolsacotizado, orden_compra.total_bolsacompra, orden_compra.dif_total_bolsa, orden_compra.unidades_recibidas_bolsa, orden_compra.dif_unidades_bolsa, orden_compra.fecha_recibido_bolsa, orden_compra.orden_comprabolsa,
            orden_compra.consumo_totalboton, orden_compra.total_botoncotizado, orden_compra.total_botoncompra, orden_compra.dif_total_boton, orden_compra.unidades_recibidas_boton, orden_compra.dif_unidades_boton, orden_compra.fecha_recibido_boton, orden_compra.orden_compraboton,
            orden_compra.consumo_totalboton2, orden_compra.total_boton2cotizado, orden_compra.total_boton2compra, orden_compra.dif_total_boton2, orden_compra.unidades_recibidas_boton2, orden_compra.dif_unidades_boton2, orden_compra.fecha_recibido_boton2, orden_compra.orden_compraboton2,
            orden_compra.consumo_totalbroche, orden_compra.total_brochecotizado, orden_compra.total_brochecompra, orden_compra.dif_total_broche, orden_compra.unidades_recibidas_broche, orden_compra.dif_unidades_broche, orden_compra.fecha_recibido_broche, orden_compra.orden_comprabroche,
            orden_compra.consumo_totalfaya, orden_compra.total_fayacotizado, orden_compra.total_fayacompra, orden_compra.dif_total_faya, orden_compra.unidades_recibidas_faya, orden_compra.dif_unidades_faya, orden_compra.fecha_recibido_faya, orden_compra.orden_comprafaya,
            orden_compra.consumo_totalcinta, orden_compra.total_cintacotizado, orden_compra.total_cintacompra, orden_compra.dif_total_cinta, orden_compra.unidades_recibidas_cinta, orden_compra.dif_unidades_cinta, orden_compra.fecha_recibido_cinta, orden_compra.orden_compracinta,
            orden_compra.consumo_totalcordon, orden_compra.total_cordoncotizado, orden_compra.total_cordoncompra, orden_compra.dif_total_cordon, orden_compra.unidades_recibidas_cordon, orden_compra.dif_unidades_cordon, orden_compra.fecha_recibido_cordon, orden_compra.orden_compracordon,
            orden_compra.consumo_totalcremallera, orden_compra.total_cremalleracotizado, orden_compra.total_cremalleracompra, orden_compra.dif_total_cremallera, orden_compra.unidades_recibidas_cremallera, orden_compra.dif_unidades_cremallera, orden_compra.fecha_recibido_cremallera, orden_compra.orden_compracremallera,
            orden_compra.consumo_totalcremallera2, orden_compra.total_cremallera2cotizado, orden_compra.total_cremallera2compra, orden_compra.dif_total_cremallera2, orden_compra.unidades_recibidas_cremallera2, orden_compra.dif_unidades_cremallera2, orden_compra.fecha_recibido_cremallera2, orden_compra.orden_compracremallera2,
            orden_compra.consumo_totalcuello, orden_compra.total_cuellocotizado, orden_compra.total_cuellocompra, orden_compra.dif_total_cuello, orden_compra.unidades_recibidas_cuello, orden_compra.dif_unidades_cuello, orden_compra.fecha_recibido_cuello, orden_compra.orden_compracuello,
            orden_compra.consumo_totaldeslizador, orden_compra.total_deslizadorcotizado, orden_compra.total_deslizadorcompra, orden_compra.dif_total_deslizador, orden_compra.unidades_recibidas_deslizador, orden_compra.dif_unidades_deslizador, orden_compra.fecha_recibido_deslizador, orden_compra.orden_compradeslizador,
            orden_compra.consumo_totalfajon_cintura, orden_compra.total_fajon_cinturacotizado, orden_compra.total_fajon_cinturacompra, orden_compra.dif_total_fajon_cintura, orden_compra.unidades_recibidas_fajon_cintura, orden_compra.dif_unidades_fajon_cintura, orden_compra.fecha_recibido_fajon_cintura, orden_compra.orden_comprafajon_cintura,
            orden_compra.consumo_totalguata, orden_compra.total_guatacotizado, orden_compra.total_guatacompra, orden_compra.dif_total_guata, orden_compra.unidades_recibidas_guata, orden_compra.dif_unidades_guata, orden_compra.fecha_recibido_guata, orden_compra.orden_compraguata,
            orden_compra.consumo_totalhiladilla, orden_compra.total_hiladillacotizado, orden_compra.total_hiladillacompra, orden_compra.dif_total_hiladilla, orden_compra.unidades_recibidas_hiladilla, orden_compra.dif_unidades_hiladilla, orden_compra.fecha_recibido_hiladilla, orden_compra.orden_comprahiladilla,
            orden_compra.consumo_totalhombrera, orden_compra.total_hombreracotizado, orden_compra.total_hombreracompra, orden_compra.dif_total_hombrera, orden_compra.unidades_recibidas_hombrera, orden_compra.dif_unidades_hombrera, orden_compra.fecha_recibido_hombrera, orden_compra.orden_comprahombrera,
            orden_compra.total_marquillacotizado, orden_compra.total_marquillacompra, orden_compra.dif_total_marquilla, orden_compra.unidades_recibidas_marquilla, orden_compra.dif_unidades_marquilla, orden_compra.fecha_recibido_marquilla, orden_compra.orden_compramarquilla,
            orden_compra.consumo_totalplumilla, orden_compra.total_plumillacotizado, orden_compra.total_plumillacompra, orden_compra.dif_total_plumilla, orden_compra.unidades_recibidas_plumilla, orden_compra.dif_unidades_plumilla, orden_compra.fecha_recibido_plumilla, orden_compra.orden_compraplumilla,
            orden_compra.consumo_totalpretina, orden_compra.total_pretinacotizado, orden_compra.total_pretinacompra, orden_compra.dif_total_pretina, orden_compra.unidades_recibidas_pretina, orden_compra.dif_unidades_pretina, orden_compra.fecha_recibido_pretina, orden_compra.orden_comprapretina,
            orden_compra.consumo_totalpuntera, orden_compra.total_punteracotizado, orden_compra.total_punteracompra, orden_compra.dif_total_puntera, orden_compra.unidades_recibidas_puntera, orden_compra.dif_unidades_puntera, orden_compra.fecha_recibido_puntera, orden_compra.orden_comprapuntera,
            orden_compra.consumo_totalpuño, orden_compra.total_puñocotizado, orden_compra.total_puñocompra, orden_compra.dif_total_puño, orden_compra.unidades_recibidas_puño, orden_compra.dif_unidades_puño, orden_compra.fecha_recibido_puño, orden_compra.orden_comprapuño,
            orden_compra.consumo_totalresorte, orden_compra.total_resortecotizado, orden_compra.total_resortecompra, orden_compra.dif_total_resorte, orden_compra.unidades_recibidas_resorte, orden_compra.dif_unidades_resorte, orden_compra.fecha_recibido_resorte, orden_compra.orden_compraresorte,
            orden_compra.consumo_totalresorte2, orden_compra.total_resorte2cotizado, orden_compra.total_resorte2compra, orden_compra.dif_total_resorte2, orden_compra.unidades_recibidas_resorte2, orden_compra.dif_unidades_resorte2, orden_compra.fecha_recibido_resorte2, orden_compra.orden_compraresorte2,
            orden_compra.consumo_totalsesgo, orden_compra.total_sesgocotizado, orden_compra.total_sesgocompra, orden_compra.dif_total_sesgo, orden_compra.unidades_recibidas_sesgo, orden_compra.dif_unidades_sesgo, orden_compra.fecha_recibido_sesgo, orden_compra.orden_comprasesgo,
            orden_compra.consumo_totaltrabilla, orden_compra.total_trabillacotizado, orden_compra.total_trabillacompra, orden_compra.dif_total_trabilla, orden_compra.unidades_recibidas_trabilla, orden_compra.dif_unidades_trabilla, orden_compra.fecha_recibido_trabilla, orden_compra.orden_compratrabilla,
            orden_compra.consumo_totalvelcro, orden_compra.total_velcrocotizado, orden_compra.total_velcrocompra, orden_compra.dif_total_velcro, orden_compra.unidades_recibidas_velcro, orden_compra.dif_unidades_velcro, orden_compra.fecha_recibido_velcro, orden_compra.orden_compravelcro,
            orden_compra.consumo_totalvinilo, orden_compra.total_vinilocotizado, orden_compra.total_vinilocompra, orden_compra.dif_total_vinilo, orden_compra.unidades_recibidas_vinilo, orden_compra.dif_unidades_vinilo, orden_compra.fecha_recibido_vinilo, orden_compra.orden_compravinilo,
            orden_compra.consumo_totalvivo, orden_compra.total_vivocotizado, orden_compra.total_vivocompra, orden_compra.dif_total_vivo, orden_compra.unidades_recibidas_vivo, orden_compra.dif_unidades_vivo, orden_compra.fecha_recibido_vivo, orden_compra.orden_compravivo,
            producto.id_prendacomprada, prenda_comprada.nombre_producto, prenda_comprada.precio_compra AS precio_prenda_unitario, prenda_comprada.id_proveedor, proveedor_prenda.nombre AS nombre_proveedor_prenda,
            orden_compra.prendas_comprar, orden_compra.precio_prendacompra, orden_compra.total_prendacompra, orden_compra.dif_total_prenda, orden_compra.unidades_recibidas_prenda, orden_compra.dif_unidades_prenda, orden_compra.fecha_recibido_prenda, orden_compra.orden_compraprenda,
            orden_compra.prendas_comprar2, orden_compra.precio_prendacompra2, orden_compra.total_prendacompra2, orden_compra.dif_total_prenda2, orden_compra.unidades_recibidas_prenda2, orden_compra.dif_unidades_prenda2, orden_compra.fecha_recibido_prenda2, orden_compra.orden_compraprenda2,
            orden_compra.prendas_comprar3, orden_compra.precio_prendacompra3, orden_compra.total_prendacompra3, orden_compra.dif_total_prenda3, orden_compra.unidades_recibidas_prenda3, orden_compra.dif_unidades_prenda3, orden_compra.fecha_recibido_prenda3, orden_compra.orden_compraprenda3,
            orden_compra.prendas_comprar4, orden_compra.precio_prendacompra4, orden_compra.total_prendacompra4, orden_compra.dif_total_prenda4, orden_compra.unidades_recibidas_prenda4, orden_compra.dif_unidades_prenda4, orden_compra.fecha_recibido_prenda4, orden_compra.orden_compraprenda4,
            orden_compra.prendas_comprar5, orden_compra.precio_prendacompra5, orden_compra.total_prendacompra5, orden_compra.dif_total_prenda5, orden_compra.unidades_recibidas_prenda5, orden_compra.dif_unidades_prenda5, orden_compra.fecha_recibido_prenda5, orden_compra.orden_compraprenda5,
            orden_compra.prendas_comprar6, orden_compra.precio_prendacompra6, orden_compra.total_prendacompra6, orden_compra.dif_total_prenda6, orden_compra.unidades_recibidas_prenda6, orden_compra.dif_unidades_prenda6, orden_compra.fecha_recibido_prenda6, orden_compra.orden_compraprenda6,
            
            ficha_tecnica.genero, ficha_tecnica.num_ficha,
            ficha_tecnica.codigo_tela, ficha_tecnica.codigo_tela2, ficha_tecnica.codigo_tela3, ficha_tecnica.codigo_tela4, ficha_tecnica.codigo_tela5, ficha_tecnica.codigo_tela6,
            producto.color_tela, producto.color_tela2, producto.color_tela3, producto.color_tela4, producto.color_tela5, producto.color_tela6,
            producto.color_telacombi, producto.color_telacombi2, producto.color_telacombi3, producto.color_telacombi4, producto.color_telacombi5, producto.color_telacombi6,
            producto.color_telaforro, producto.color_telaforro2, producto.color_telaforro3, producto.color_telaforro4, producto.color_telaforro5, producto.color_telaforro6,
                                                                
            tallas.unidades_XS, tallas.unidades_S, tallas.unidades_M, tallas.unidades_L, tallas.unidades_XL, tallas.unidades_2XL, tallas.unidades_3XL, tallas.unidades_4XL, tallas.unidades_5XL, tallas.unidades_6XL,
            tallas.unidades_4, tallas.unidades_6, tallas.unidades_8, tallas.unidades_10, tallas.unidades_12, tallas.unidades_14, tallas.unidades_16, tallas.unidades_18, tallas.unidades_20, tallas.unidades_22,
            tallas.unidades2_XS, tallas.unidades2_S, tallas.unidades2_M, tallas.unidades2_L, tallas.unidades2_XL, tallas.unidades2_2XL, tallas.unidades2_3XL, tallas.unidades2_4XL, tallas.unidades2_5XL, tallas.unidades2_6XL,
            tallas.unidades2_4, tallas.unidades2_6, tallas.unidades2_8, tallas.unidades2_10, tallas.unidades2_12, tallas.unidades2_14, tallas.unidades2_16, tallas.unidades2_18, tallas.unidades2_20, tallas.unidades2_22,
            tallas.unidades3_XS, tallas.unidades3_S, tallas.unidades3_M, tallas.unidades3_L, tallas.unidades3_XL, tallas.unidades3_2XL, tallas.unidades3_3XL, tallas.unidades3_4XL, tallas.unidades3_5XL, tallas.unidades3_6XL,
            tallas.unidades3_4, tallas.unidades3_6, tallas.unidades3_8, tallas.unidades3_10, tallas.unidades3_12, tallas.unidades3_14, tallas.unidades3_16, tallas.unidades3_18, tallas.unidades3_20, tallas.unidades3_22,
            tallas.unidades4_XS, tallas.unidades4_S, tallas.unidades4_M, tallas.unidades4_L, tallas.unidades4_XL, tallas.unidades4_2XL, tallas.unidades4_3XL, tallas.unidades4_4XL, tallas.unidades4_5XL, tallas.unidades4_6XL,
            tallas.unidades4_4, tallas.unidades4_6, tallas.unidades4_8, tallas.unidades4_10, tallas.unidades4_12, tallas.unidades4_14, tallas.unidades4_16, tallas.unidades4_18, tallas.unidades4_20, tallas.unidades4_22,
            tallas.unidades5_XS, tallas.unidades5_S, tallas.unidades5_M, tallas.unidades5_L, tallas.unidades5_XL, tallas.unidades5_2XL, tallas.unidades5_3XL, tallas.unidades5_4XL, tallas.unidades5_5XL, tallas.unidades5_6XL,
            tallas.unidades5_4, tallas.unidades5_6, tallas.unidades5_8, tallas.unidades5_10, tallas.unidades5_12, tallas.unidades5_14, tallas.unidades5_16, tallas.unidades5_18, tallas.unidades5_20, tallas.unidades5_22,
            tallas.unidades6_XS, tallas.unidades6_S, tallas.unidades6_M, tallas.unidades6_L, tallas.unidades6_XL, tallas.unidades6_2XL, tallas.unidades6_3XL, tallas.unidades6_4XL, tallas.unidades6_5XL, tallas.unidades6_6XL,
            tallas.unidades6_4, tallas.unidades6_6, tallas.unidades6_8, tallas.unidades6_10, tallas.unidades6_12, tallas.unidades6_14, tallas.unidades6_16, tallas.unidades6_18, tallas.unidades6_20, tallas.unidades6_22,
            tallas.unidades_especial, tallas.unidades2_especial, tallas.unidades3_especial, tallas.unidades4_especial, tallas.unidades5_especial, tallas.unidades6_especial,
            tallas.unidades_totales,

            ficha_tecnica.fecha_comercial, ficha_tecnica.fecha_pedido, ficha_tecnica.fecha_entrega,
            pedido.nit, cliente.cliente
            FROM producto 
            LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto
            LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto
            LEFT JOIN tallas ON tallas.id_talla = ficha_tecnica.id_talla
            LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
            LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
            LEFT JOIN cliente ON pedido.nit = cliente.nit
            LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda
            LEFT JOIN producto2 ON producto2.id_producto = producto.id_producto
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
            LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor
            LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada
            LEFT JOIN proveedor AS proveedor_prenda ON prenda_comprada.id_proveedor = proveedor_prenda.id_proveedor
            WHERE producto.id_producto = $id_producto";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

        <?php
        // Almacenar la primera fila en una variable
        $fila = mysqli_fetch_assoc($resultado);
        ?>

        <!--<br>
        <div class="d-flex justify-content-center gap-2">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalenviar<?php echo $fila['id_producto']; ?>">
                <i class="bi bi-arrow-bar-right"></i> Enviar a Diseño
            </button>
        </div>
        <br>-->


        <!-- ===== Cálculo de Curva de Tallas (se reutiliza en FICHA DE COMPRA y CURVA INICIAL) ===== -->
        <?php
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

        $colores_curva = [];
        for ($i = 1; $i <= 6; $i++) {
            $clave = ($i == 1) ? 'color_tela' : 'color_tela' . $i;
            if (!empty($fila[$clave])) {
                $colores_curva[] = $fila[$clave];
            }
        }
        if (empty($colores_curva)) $colores_curva = [''];

        $totales_columna = array_fill_keys($tallas, 0);
        foreach ($colores_curva as $index => $color) {
            $g = $index + 1;
            $prefijo = ($g === 1) ? 'unidades_' : 'unidades' . $g . '_';
            foreach ($tallas as $t) {
                $key = ($t === 'Especial') ? 'especial' : $t;
                $val = $fila[$prefijo . $key] ?? '';
                $val = ($val === null) ? '' : $val;
                $totales_columna[$t] += (int) $val;
            }
        }
        ?>

        <!-- FICHA DE COMPRA -->
        <div class="container-fluid px-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="modal-header text-white justify-content-center position-relative" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                    <div class="d-flex align-items-center text-center">
                        <img src="../../img/unidotaciones.png" alt="Logo" style="height:40px; width:auto; object-fit:contain;" class="rounded">
                    </div>
                    <a href="inicio_compras.php" class="btn active btn-primary position-absolute top-50 end-0 translate-middle-y me-3 d-inline-flex align-items-center" style="height:40px;">
                        <i class="bi bi-arrow-bar-left me-1"></i> Volver
                    </a>
                </div>
                <div class="text-white text-center py-2 fw-bold" style="background-color:#18a000;">
                    FICHA DE COMPRAS
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle text-center mb-0">
                        <colgroup>
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.11%;">
                            <col style="width:11.12%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="fw-bold" style="background:#d9e3f0;">Cliente</td>
                                <td colspan="6"><?php echo $fila ? htmlspecialchars($fila['cliente'] ?? '') : 'N/A'; ?></td>
                                <td class="fw-bold" style="background:#d9e3f0;">Ficha</td>
                                <td class="fw-bold" style="background:#ffff00; color:red;"><?php echo $fila ? htmlspecialchars($fila['num_ficha'] ?? '') : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="align-top">
                                    <div class="fw-bold" style="background:#d9e3f0; white-space:nowrap;">Fecha Reunión de Producto</div>
                                    <input type="date" class="form-control form-control-sm mt-1" name="fecha_comercial">
                                </td>
                                <td colspan="3" class="align-top">
                                    <div class="fw-bold" style="background:#d9e3f0; white-space:nowrap;">Fecha Pedido de Cliente</div>
                                    <div class="mt-1"><?php echo ($fila && !empty($fila['fecha_pedido'])) ? date('d/m/Y', strtotime($fila['fecha_pedido'])) : 'N/A'; ?></div>
                                </td>
                                <td colspan="3" class="align-top">
                                    <div class="fw-bold" style="background:#d9e3f0; white-space:nowrap;">Fecha Entrega al Cliente</div>
                                    <div class="mt-1"><?php echo ($fila && !empty($fila['fecha_entrega'])) ? date('d/m/Y', strtotime($fila['fecha_entrega'])) : 'N/A'; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="background:#a8d18d;">Producto</td>
                                <td colspan="2"><?php
                                    if (!$fila) {
                                        echo 'N/A';
                                    } elseif (($fila['id_tipo_producto'] ?? null) == 8) {
                                        echo htmlspecialchars($fila['nombre_producto'] ?? '');
                                    } else {
                                        echo htmlspecialchars($fila['nombre_prenda'] ?? '');
                                    }
                                ?></td>
                                <td class="fw-bold" style="background:#d9e3f0;">Tipo Prenda</td>
                                <td colspan="2"><?php echo $fila ? htmlspecialchars($fila['tipo_producto'] ?? '') : 'N/A'; ?></td>
                                <td class="fw-bold" style="background:#d9e3f0;">Cantidades</td>
                                <td colspan="2"><?= $fila['unidades_totales'] ?? 0 ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if (($fila['id_tipo_producto'] ?? null) != 8): ?>

        <!-- CURVA INICIAL -->
        <div class="container-fluid px-3">
            <?php if (!empty($tallas) && !empty($colores_curva)): ?>

                <?php foreach ($colores_curva as $index => $color):
                    $g = $index + 1;
                    $prefijo = ($g === 1) ? 'unidades_' : 'unidades' . $g . '_';
                    $total_fila = 0;
                    $cantidades = []; // <-- guardamos aquí la cantidad de cada talla
                ?>
                    <?php
                    $col_unidades_tela = ($g === 1) ? 'unidades_tela' : 'unidades_tela' . $g;
                    $unidades_tela_g = $fila[$col_unidades_tela] ?? null;
                    ?>
                    <form action="" method="post" class="form-consumo-color">
                        <div class="card shadow-sm border-0 mb-3" data-color-index="<?= $g ?>">
                            <?php
                            $campoCodigo = ($g == 1) ? 'codigo_tela' : 'codigo_tela' . $g;
                            $campoColorP2 = ($g == 1) ? 'p2_color_tela' : 'p2_color_tela' . $g;
                            $campoCodigoP2 = ($g == 1) ? 'p2_codigo_tela' : 'p2_codigo_tela' . $g;
                            $color_mostrado = !empty($fila[$campoColorP2]) ? $fila[$campoColorP2] : $color;
                            $codigo_mostrado = !empty($fila[$campoCodigoP2]) ? $fila[$campoCodigoP2] : ($fila[$campoCodigo] ?? '');
                            ?>
                            <div class="card-header bg-primary text-white fw-bold py-1 text-center">
                                Tela Color <?= htmlspecialchars($color_mostrado) ?> - Codigo <?= htmlspecialchars($codigo_mostrado) ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle text-center mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="table-success fw-bold" style="width:10%;">TALLAS</td>
                                            <?php foreach ($tallas as $t): ?>
                                                <td style="width:6%;"><?= htmlspecialchars($t) ?></td>
                                            <?php endforeach; ?>
                                            <td class="table-success fw-bold" style="width:20%;">
                                                CANT PRENDAS Y SUMA PROMEDIOS
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table-success fw-bold">UNIDADES</td>
                                            <?php foreach ($tallas as $t):
                                                $key = ($t === 'Especial') ? 'especial' : $t;
                                                $val = $fila[$prefijo . $key] ?? '';
                                                $val = ($val === null) ? '' : $val;
                                                $cantidades[$key] = (int) $val; // <-- guardamos la cantidad de esta talla (pedido + stock)
                                                $total_fila += (int) $val;
                                            ?>
                                                <td><?= htmlspecialchars((string) $val) ?></td>
                                            <?php endforeach; ?>
                                            <td class="table-success fw-bold total-prendas">
                                                <?= ($unidades_tela_g !== null && $unidades_tela_g !== '') ? (int) $unidades_tela_g : (int) $total_fila ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table-success fw-bold">PROM</td>
                                            <?php
                                            $suma_calculada = 0;
                                            foreach ($tallas as $t):
                                                $key = ($t === 'Especial') ? 'especial' : $t;
                                                $talla_col_suffix = ($t === 'Especial') ? 'Especial' : $t;
                                                $col_prom = 'prom' . $talla_col_suffix . '_' . $g;
                                                $input_name = $col_prom;
                                                $tiene_cantidad = $cantidades[$key] > 0;
                                                $valor_guardado = $fila[$col_prom] ?? '';
                                                if ($tiene_cantidad && $valor_guardado !== '' && $valor_guardado !== null) {
                                                    $suma_calculada += (float) $valor_guardado;
                                                }
                                            ?>
                                                <td class="p-1">
                                                    <input type="number" step="0.01" min="0"
                                                        name="<?= $input_name ?>"
                                                        class="form-control form-control-sm text-center input-promedio"
                                                        value="<?= ($tiene_cantidad && $valor_guardado !== '' && $valor_guardado !== null) ? htmlspecialchars($valor_guardado) : '' ?>"
                                                        <?= $tiene_cantidad ? '' : 'disabled placeholder=""' ?>>
                                                </td>
                                            <?php endforeach; ?>
                                            <?php
                                            // Una vez guardado, el valor mostrado es consumo_tela{g} (= suma de los promedios
                                            // guardados). Si todavía no se ha guardado nada para este color, se muestra
                                            // la suma calculada en vivo a partir de los promedios (que arranca en 0.00).
                                            $col_consumo_tela_g = ($g === 1) ? 'consumo_tela' : 'consumo_tela' . $g;
                                            $consumo_tela_guardado = $fila[$col_consumo_tela_g] ?? null;
                                            $suma_guardada = ($consumo_tela_guardado !== null && $consumo_tela_guardado !== '')
                                                ? (float) $consumo_tela_guardado
                                                : $suma_calculada;
                                            ?>
                                            <td class="table-success fw-bold position-relative">
                                                <?php
                                                $campoPrecio2 = 'precio_tela2' . $g;
                                                $precio_tela_efectivo_g = !empty($fila[$campoPrecio2]) ? $fila[$campoPrecio2] : $fila['precio_tela'];
                                                ?>
                                                <input type="hidden" name="consumo_calc" class="input-consumo-calc" value="<?= number_format($suma_guardada, 2, '.', '') ?>">
                                                <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra'] ?>">
                                                <input type="hidden" name="id_talla" value="<?= $fila['id_talla'] ?? '' ?>">
                                                <input type="hidden" name="color_index" value="<?= $g ?>">
                                                <input type="hidden" name="precio_tela" value="<?= $precio_tela_efectivo_g ?>">
                                                <div class="suma-promedios-color"><?= number_format($suma_guardada, 2, '.', '') ?></div>
                                                <button type="submit" name="consumo_precio" class="btn btn-sm btn-success position-absolute" style="right:6px; top:50%; transform:translateY(-50%);">
                                                    <i class="bi bi-save"></i> Guardar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="table-responsive">
                            <table id="mytabla" class="table table-bordered text-center">
                                <thead>
                                    <tr class="table-primary">
                                        <th style="text-align:center; vertical-align:middle; width:20%;">Tela</th>
                                        <th style="text-align:center; vertical-align:middle; width:8%;">Textilera</th>
                                        <th style="text-align:center; vertical-align:middle; width:6%;">Precio<br>Metro</th>
                                        <th style="text-align:center; vertical-align:middle; width:6%;">Metros<br>Pedidos</th>
                                        <th style="text-align:center; vertical-align:middle; width:9%;">Valor<br>Cotizado</th>
                                        <th style="text-align:center; vertical-align:middle; width:9%;">Valor de<br>Compra</th>
                                        <th style="text-align:center; vertical-align:middle; width:9%;">Diferencia<br>de Compra</th>
                                        <th style="text-align:center; vertical-align:middle; width:6%;">Metros<br>Recibidos</th>
                                        <th style="text-align:center; vertical-align:middle; width:6%;">Diferencia<br>de Metros</th>
                                        <th style="text-align:center; vertical-align:middle; width:7%;">Fecha<br>Recibido</th>
                                        <th style="text-align:center; vertical-align:middle; width:14%;">Opciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!-- Tela -->
                                    <?php if (!empty($fila['id_tela'])): ?>
                                        <?php
                                        // Variables iniciales
                                        $id_tela = $fila['id_tela'];
                                        $color_tela = $fila['color_tela'];

                                        // Columnas de consumo/precio de compra que corresponden a ESTE color (g)
                                        $col_consumo_actual = ($g == 1) ? 'consumo_tela' : 'consumo_tela' . $g;
                                        $col_precio_actual  = ($g == 1) ? 'precio_telacompra' : 'precio_telacompra' . $g;
                                        $consumo_actual = $fila[$col_consumo_actual] ?? null;
                                        $precio_telacompra_actual = $fila[$col_precio_actual] ?? null;

                                        // Columnas del resultado de "Comprado" para ESTE color
                                        $col_total_compra_actual  = ($g == 1) ? 'total_telacompra' : 'total_telacompra' . $g;
                                        $col_dif_total_actual     = ($g == 1) ? 'dif_total_tela' : 'dif_total_tela' . $g;
                                        $col_consumo_real_actual  = ($g == 1) ? 'consumo_realtotal' : 'consumo_realtotal' . $g;
                                        $col_dif_consumo_actual   = ($g == 1) ? 'dif_consumo_total' : 'dif_consumo_total' . $g;
                                        $col_fecha_recibido_actual = ($g == 1) ? 'fecha_recibido_tela' : 'fecha_recibido_tela' . $g;
                                        $total_telacompra_g  = $fila[$col_total_compra_actual] ?? null;
                                        $dif_total_tela_g     = $fila[$col_dif_total_actual] ?? null;
                                        $consumo_realtotal_g  = $fila[$col_consumo_real_actual] ?? null;
                                        $dif_consumo_total_g  = $fila[$col_dif_consumo_actual] ?? null;
                                        $fecha_recibido_tela_g = $fila[$col_fecha_recibido_actual] ?? null;
                                        // "Ya comprado" = ya se guardó un total_telacompra para este color.
                                        // OJO: no usar empty($dif_total_tela_g) para esto, porque la diferencia puede dar exactamente 0.
                                        $ya_comprado_g = ($total_telacompra_g !== null && $total_telacompra_g !== '');

                                        // Tela e info homologada de ESTE color específico (id_tela21..26 / precio_tela21..26)
                                        $col_idtela2_actual = 'id_tela2' . $g;
                                        $col_precio2_actual = 'precio_tela2' . $g;
                                        $id_tela2 = $fila[$col_idtela2_actual] ?? null;
                                        $precio_homolog_actual = $fila[$col_precio2_actual] ?? null;
                                        $tiene_homolog_actual = !empty($id_tela2) && !empty($precio_homolog_actual);

                                        // Nombre/proveedor de la tela homologada de ESTE color
                                        $filatela2 = null;
                                        if ($tiene_homolog_actual) {
                                            $consulta_tela2 = "SELECT tela.id_tela, tela.tela AS tela_2, tela.id_proveedor, proveedor_tela.nombre AS nombre_2
                                            FROM tela
                                            LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor
                                            WHERE tela.id_tela = '$id_tela2'";

                                            $resultado_tela2 = mysqli_query($enlace, $consulta_tela2);
                                            $filatela2 = mysqli_fetch_array($resultado_tela2);
                                        }

                                        // Archivo de orden de compra de ESTE color específico
                                        $col_archivo_actual = ($g == 1) ? 'orden_compratela' : 'orden_compratela' . $g;
                                        $orden_compratela_g = $fila[$col_archivo_actual] ?? null;
                                        ?>
                                        <?php if (!$tiene_homolog_actual && empty($consumo_actual) && empty($precio_telacompra_actual)): ?>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                    <input type="hidden" name="color_index" value="<?= $g ?>">

                                                    <td class="text-center align-middle">
                                                        <?php echo htmlspecialchars($fila['tela']); ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                                    <td class="text-center align-middle"><input type="hidden" name="precio_tela" value="<?php echo $fila['precio_tela']; ?>"><?php $precio_formateado = formatoPrecio($fila['precio_tela']); ?> $<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                </form>
                                            </tr>
                                        <?php elseif (!$tiene_homolog_actual && !empty($consumo_actual) && !empty($precio_telacompra_actual) && !$ya_comprado_g): ?>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                    <input type="hidden" name="precio_tela" value="<?php echo $fila['precio_tela']; ?>">
                                                    <input type="hidden" name="color_index" value="<?= $g ?>">

                                                    <td class="text-center align-middle">
                                                        <?php echo htmlspecialchars($fila['tela']); ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                                    <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($fila['precio_tela']); ?> $<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($consumo_actual); ?> Mts</td>
                                                    <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($precio_telacompra_actual); ?> $<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" inputmode="decimal" class="form-control form-control-sm text-center input-miles-visible"

                                                            value="<?= ($total_telacompra_g !== null && $total_telacompra_g !== '') ? number_format((float)$total_telacompra_g, 0, ',', '.') : '' ?>">
                                                        <input type="hidden" name="total_telacompra" class="input-miles-hidden"
                                                            value="<?= ($total_telacompra_g !== null && $total_telacompra_g !== '') ? $total_telacompra_g : '' ?>">
                                                    </td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center"
                                                            name="consumo_realtotal"
                                                            value="<?= ($consumo_realtotal_g !== null && $consumo_realtotal_g !== '') ? $consumo_realtotal_g : '' ?>">
                                                    </td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td>
                                                        <button type="submit" name="dif_telacom" class="btn btn-sm btn-danger mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#homologarTela<?php echo $fila['id_producto']; ?>_<?= $g ?>"
                                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                            data-id-tela="<?php echo $fila['id_tela']; ?>"
                                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                            <i class="bi bi-pencil-square"></i> Homologar
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php elseif ($tiene_homolog_actual && !empty($consumo_actual) && !empty($precio_telacompra_actual) && !$ya_comprado_g): ?>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                                    <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                                    <input type="hidden" name="color_index" value="<?= $g ?>">

                                                    <td class="text-center align-middle">
                                                        <?php echo htmlspecialchars($fila['tela']); ?>
                                                        <hr class="my-2">
                                                        <strong>Homologación: </strong><?php echo htmlspecialchars($filatela2['tela_2'] ?? ''); ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <?= htmlspecialchars($fila['nombre']); ?>
                                                        <hr class="my-3">
                                                        <?= htmlspecialchars($filatela2['nombre_2'] ?? ''); ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <?php $precio_formateado = formatoPrecio($fila['precio_tela']); ?>$<?= $precio_formateado ?>
                                                        <hr class="my-3">
                                                        <?php $precio_formateado = formatoPrecio($precio_homolog_actual); ?>$<?= $precio_formateado ?>
                                                    </td>

                                                    <td class="text-center align-middle"><?= htmlspecialchars($consumo_actual); ?> Mts</td>
                                                    <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($precio_telacompra_actual); ?>$<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle">
                                                        <input type="text" inputmode="decimal" class="form-control form-control-sm text-center input-miles-visible"

                                                            value="<?= ($total_telacompra_g !== null && $total_telacompra_g !== '') ? number_format((float)$total_telacompra_g, 0, ',', '.') : '' ?>">
                                                        <input type="hidden" name="total_telacompra" class="input-miles-hidden"
                                                            value="<?= ($total_telacompra_g !== null && $total_telacompra_g !== '') ? $total_telacompra_g : '' ?>">
                                                    </td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle">
                                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center"
                                                            name="consumo_realtotal"
                                                            value="<?= ($consumo_realtotal_g !== null && $consumo_realtotal_g !== '') ? $consumo_realtotal_g : '' ?>">
                                                    </td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>

                                                    <td class="text-center align-middle">
                                                        <button type="submit" name="dif_telacom" class="btn btn-sm btn-danger mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php elseif ($ya_comprado_g && empty($orden_compratela_g)): ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?php echo htmlspecialchars($fila['tela']); ?>
                                                    <?php if ($tiene_homolog_actual): ?>
                                                        <hr class="my-2">
                                                        <strong>Homologación: </strong><?php echo htmlspecialchars($filatela2['tela_2'] ?? ''); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= htmlspecialchars($fila['nombre']); ?>
                                                    <?php if ($tiene_homolog_actual): ?>
                                                        <hr class="my-3">
                                                        <?= htmlspecialchars($filatela2['nombre_2'] ?? ''); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php $precio_formateado = formatoPrecio($fila['precio_tela']); ?>$<?= $precio_formateado ?>
                                                    <?php if ($tiene_homolog_actual): ?>
                                                        <hr class="my-3">
                                                        <?php $precio_formateado = formatoPrecio($precio_homolog_actual); ?>$<?= $precio_formateado ?>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_actual); ?> Mts</td>
                                                <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($precio_telacompra_actual); ?>$<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($total_telacompra_g); ?>$<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle <?php echo ($dif_total_tela_g < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = formatoPrecio($dif_total_tela_g); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php echo htmlspecialchars($consumo_realtotal_g); ?> Mts</td>
                                                <td class="text-center align-middle <?= ($dif_consumo_total_g >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($dif_consumo_total_g); ?> Mts</td>
                                                <td class="text-center align-middle"><?= !empty($fecha_recibido_tela_g) ? date('d/m/Y', strtotime($fecha_recibido_tela_g)) : '' ?></td>

                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra<?php echo $fila['id_producto']; ?>_<?= $g ?>">
                                                        <i class="bi bi-upload me-1"></i> Cargar Orden
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php elseif ($ya_comprado_g || !empty($orden_compratela_g)): ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?php echo htmlspecialchars($fila['tela']); ?>
                                                    <?php if ($tiene_homolog_actual): ?>
                                                        <hr class="my-2">
                                                        <strong>Homologación: </strong><?php echo htmlspecialchars($filatela2['tela_2'] ?? ''); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= htmlspecialchars($fila['nombre']); ?>
                                                    <?php if ($tiene_homolog_actual): ?>
                                                        <hr class="my-3">
                                                        <?= htmlspecialchars($filatela2['nombre_2'] ?? ''); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php $precio_formateado = formatoPrecio($fila['precio_tela']); ?>$<?= $precio_formateado ?>
                                                    <?php if ($tiene_homolog_actual): ?>
                                                        <hr class="my-3">
                                                        <?php $precio_formateado = formatoPrecio($precio_homolog_actual); ?>$<?= $precio_formateado ?>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_actual); ?> Mts</td>
                                                <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($precio_telacompra_actual); ?>$<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php $precio_formateado = formatoPrecio($total_telacompra_g); ?>$<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle <?php echo ($dif_total_tela_g < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = formatoPrecio($dif_total_tela_g); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php echo htmlspecialchars($consumo_realtotal_g); ?> Mts</td>
                                                <td class="text-center align-middle <?= ($dif_consumo_total_g >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($dif_consumo_total_g); ?> Mts</td>
                                                <td class="text-center align-middle"><?= !empty($fecha_recibido_tela_g) ? date('d/m/Y', strtotime($fecha_recibido_tela_g)) : '' ?></td>

                                                <td class="text-center align-middle">
                                                    <a href="orden_compra/<?php echo urlencode($orden_compratela_g); ?>" class="btn btn-sm btn-success" download> Descargar Orden <i class="bi bi-download"></i></a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <div class="modal fade" id="orden_compra<?php echo $fila['id_producto']; ?>_<?= $g ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4 shadow-lg border-0">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra — Color <?= htmlspecialchars($color_mostrado ?? $color) ?></h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="" method="post" id="formulario<?= $g ?>" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                        <input type="hidden" name="color_index" value="<?= $g ?>">

                                                        <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                            <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">
                                                                Selecciona un Archivo
                                                            </h6>
                                                            <div class="mt-4">
                                                                <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                                    <input
                                                                        type="file"
                                                                        class="custom-file-input"
                                                                        name="orden_compratela"
                                                                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                        id="excelInput<?php echo $fila['id_producto']; ?>_<?= $g ?>"
                                                                        onchange="previewFile(this, 'excelPreview<?php echo $fila['id_producto']; ?>_<?= $g ?>', 'fileNameExcel_<?php echo $fila['id_producto']; ?>_<?= $g ?>')">
                                                                    <label class="custom-file-label text-truncate text-muted" for="excelInput<?php echo $fila['id_producto']; ?>_<?= $g ?>" style="max-width: 100%;">
                                                                        <i class="bi bi-upload"></i> Seleccionar archivo
                                                                    </label>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <center>
                                                                        <img
                                                                            id="excelPreview<?php echo $fila['id_producto']; ?>_<?= $g ?>"
                                                                            class="img-thumbnail shadow-sm"
                                                                            style="max-width: 50%; height: auto; border-radius: 12px; display: <?php echo empty($orden_compratela_g) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $orden_compratela_g) ? 'none' : 'block'; ?>;"
                                                                            src="<?php echo !empty($orden_compratela_g) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $orden_compratela_g) ? 'orden_compra/' . $orden_compratela_g : ''; ?>">

                                                                        <span
                                                                            id="fileNameExcel_<?php echo $fila['id_producto']; ?>_<?= $g ?>"
                                                                            class="text-muted"
                                                                            style="display: <?php echo !empty($orden_compratela_g) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $orden_compratela_g) ? 'block' : 'none'; ?>;">
                                                                            <?php echo htmlspecialchars($orden_compratela_g ?? ''); ?>
                                                                        </span>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" name="cargar_orden_compratela" class="btn btn-success">Subir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    // Valores ya guardados para ESTE color (si ya se había homologado antes)
                                    $campoPrecio2Modal = 'precio_tela2' . $g;
                                    $campoColor2Modal  = ($g == 1) ? 'p2_color_tela' : 'p2_color_tela' . $g;
                                    $campoCodigo2Modal = ($g == 1) ? 'p2_codigo_tela' : 'p2_codigo_tela' . $g;
                                    $campoCodigoOrigModal = ($g == 1) ? 'codigo_tela' : 'codigo_tela' . $g;

                                    $precio_modal_valor  = !empty($fila[$campoPrecio2Modal]) ? $fila[$campoPrecio2Modal] : $fila['precio_tela'];
                                    $color_modal_valor   = !empty($fila[$campoColor2Modal]) ? $fila[$campoColor2Modal] : $color;
                                    $codigo_modal_valor  = !empty($fila[$campoCodigo2Modal]) ? $fila[$campoCodigo2Modal] : ($fila[$campoCodigoOrigModal] ?? '');
                                    $consumo_modal_valor = $fila[$col_consumo_actual] ?? 0;
                                    ?>
                                    <div class="modal fade" id="homologarTela<?php echo $fila['id_producto']; ?>_<?= $g ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">

                                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                    <h5 class="modal-title">Homologar Tela — Color <?= htmlspecialchars($color_modal_valor) ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                        <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                        <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">
                                                        <input type="hidden" name="color_index" value="<?= $g ?>">
                                                        <input type="hidden" name="consumo_tela" value="<?= $consumo_modal_valor ?>">

                                                        <div class="mb-3">
                                                            <label class="form-label">Elija el tipo de Tela:</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control comboTelaModal" placeholder="Buscar tela..." autocomplete="off">
                                                                <div class="combobox-list list-group comboTelaListModal" style="display:none;"></div>

                                                                <select name="id_tela" class="form-select d-none selectTelaModal">
                                                                    <option value="0">Sin seleccionar</option>

                                                                    <?php
                                                                    setlocale(LC_TIME, 'spanish');

                                                                    $consulta_mysql = "SELECT tela.id_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas,
                                                                    tela.rendimiento, tela.encogimiento, tela.precio, proveedor_tela.nombre
                                                                    FROM tela
                                                                    LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor";

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
                                                                        $id_tela_actual_modal = !empty($id_tela2) ? $id_tela2 : $fila['id_tela'];
                                                                        $selected = ($id == $id_tela_actual_modal) ? 'selected' : '';

                                                                        echo "<option value='$id' data-precio='{$lista['precio']}' $selected>$nombre - $proveedor</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="position-relative mb-3">
                                                            <label class="form-label">Ingrese Precio:</label>
                                                            <input type="number" step="any" class="form-control" name="precio_tela" value="<?= $precio_modal_valor ?>">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label class="form-label">Color de la tela:</label>
                                                                <input type="text" class="form-control" name="color_tela_nuevo" value="<?= htmlspecialchars($color_modal_valor) ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label">Código de la tela:</label>
                                                                <input type="text" class="form-control" name="codigo_tela_nuevo" value="<?= htmlspecialchars($codigo_modal_valor) ?>">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" name="homologar_tela" class="btn btn-success">Continuar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!----->
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- OBSERVACIÓN DE TELAS: aparece una sola vez, fuera del ciclo de colores -->
                <div class="row mb-4">
                    <div class="col-12">
                        <form action="" method="post" class="d-flex align-items-stretch border border-primary rounded overflow-hidden" style="min-height: 60px;">
                            <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                            <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra'] ?>">
                            <div class="text-white d-flex align-items-center justify-content-center text-center fw-bold px-3"
                                style="background-color:#18a000; min-width: 220px;">
                                OBSERVACIÓN DE TELAS<br>(COMBINADAS Y FORRO)
                            </div>
                            <textarea name="observaciones_telas" rows="2"
                                class="form-control border-0 rounded-0 flex-grow-1"
                                placeholder="Escribe aquí la observación..."
                                style="resize: vertical;"><?= htmlspecialchars($fila['observaciones_telas'] ?? '') ?></textarea>
                            <button type="submit" name="guardar_observacion_telas" class="btn btn-primary rounded-0 px-4">
                                <i class="bi bi-save"></i> Guardar
                            </button>
                        </form>
                    </div>
                </div>

                <?php if (!empty($fila['id_telacombi'])): ?>
                <table id="mytablacombi" class="table table-bordered text-center">
                <thead>
                    <tr class="table-primary">
                        <th style="text-align:center; vertical-align:middle; width:18%;">Tela Combinada</th>
                        <th style="text-align:center; vertical-align:middle; width:8%;">Textilera</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Precio por<br>Metro</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Metros<br>Pedidos</th>
                        <th style="text-align:center; vertical-align:middle; width:9%;">Valor<br>Cotizado</th>
                        <th style="text-align:center; vertical-align:middle; width:9%;">Valor de<br>Compra</th>
                        <th style="text-align:center; vertical-align:middle; width:9%;">Diferencia<br>de Compra</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Metros<br>Recibidos</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Diferencia<br>de Metros</th>
                        <th style="text-align:center; vertical-align:middle; width:7%;">Fecha<br>Recibido</th>
                        <th style="text-align:center; vertical-align:middle; width:16%;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Tela Combinada -->
                    <?php
                        $id_telacombi = $fila['id_telacombi'];
                        $id_telacombi2 = !empty($fila['id_telacombi2']) ? $fila['id_telacombi2'] : null;

                        $consulta_2 = "SELECT tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                        FROM tela_combinada
                                        LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor
                                        WHERE tela_combinada.id_telacombi = '$id_telacombi'";
                        $resultado_2 = mysqli_query($enlace, $consulta_2);
                        $fila2 = mysqli_fetch_array($resultado_2);

                        $tiene_homolog_combi = !empty($id_telacombi2) && !empty($fila['precio_telacombi2']);
                        $filatelacombi2 = null;
                        if ($tiene_homolog_combi) {
                            $consulta_telacombi2 = "SELECT tela_combinada.id_telacombi, tela_combinada.tela_combi AS tela_combi2, proveedor_tela.nombre AS nombre_combinado2
                                        FROM tela_combinada
                                        LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor
                                        WHERE tela_combinada.id_telacombi = '$id_telacombi2'";
                            $resultado_telacombi2 = mysqli_query($enlace, $consulta_telacombi2);
                            $filatelacombi2 = mysqli_fetch_array($resultado_telacombi2);
                        }

                        $precio_efectivo_combi = ($tiene_homolog_combi && !empty($fila['precio_telacombi2'])) ? $fila['precio_telacombi2'] : $fila['precio_telacombinada'];
                        $consumo_telacombi_g = $fila['consumo_telacombi'] ?? null;
                        $precio_telacombicompra_g = $fila['precio_telacombicompra'] ?? null;
                        $total_telacombicompra_g = $fila['total_telacombicompra'] ?? null;
                        $dif_total_telacombi_g = $fila['dif_total_telacombi'] ?? null;
                        $consumo_combinadatotal_g = $fila['consumo_combinadatotal'] ?? null;
                        $dif_consumocombi_total_g = $fila['dif_consumocombi_total'] ?? null;
                        $fecha_recibido_telacombi_g = $fila['fecha_recibido_telacombi'] ?? null;
                        $ya_comprado_combi = ($total_telacombicompra_g !== null && $total_telacombicompra_g !== '');
                        $tiene_archivo_combi = (isset($fila['orden_compratelacombi']) && strlen($fila['orden_compratelacombi']) > 0);
                        $tiene_consumo_combi = ($consumo_telacombi_g !== null && $consumo_telacombi_g !== '');

                        $nombre_combi_html = htmlspecialchars($fila2['tela_combi'] ?? '');
                        $proveedor_combi_html = htmlspecialchars($fila2['nombre_combinado'] ?? '');
                        $precio_combi_html = '$' . formatoPrecio((float) $fila['precio_telacombinada']);
                        if ($tiene_homolog_combi) {
                            $nombre_combi_html .= '<hr class="my-2"><strong>Homologación:</strong> ' . htmlspecialchars($filatelacombi2['tela_combi2'] ?? '');
                            $proveedor_combi_html .= '<hr class="my-2">' . htmlspecialchars($filatelacombi2['nombre_combinado2'] ?? '');
                            $precio_combi_html .= '<hr class="my-2">$' . formatoPrecio((float) $fila['precio_telacombi2']);
                        }
                        ?>

                        <?php if (!$tiene_consumo_combi): ?>
                            <tr>
                                <form action="" method="post">
                                    <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                    <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                    <input type="hidden" name="precio_efectivo" value="<?= $precio_efectivo_combi ?>">

                                    <td class="text-center align-middle"><?= $nombre_combi_html ?></td>
                                    <td class="text-center align-middle"><?= $proveedor_combi_html ?></td>
                                    <td class="text-center align-middle"><?= $precio_combi_html ?></td>
                                    <td class="text-center align-middle">
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm text-center" name="consumo_telacombi" placeholder="Mts">
                                    </td>
                                    <td class="text-center align-middle" colspan="6"></td>
                                    <td class="text-center align-middle">
                                        <button type="submit" name="guardar_consumo_telacombi" class="btn btn-sm btn-success"><i class="bi bi-save"></i> Guardar</button>
                                    </td>
                                </form>
                            </tr>
                        <?php elseif (!$ya_comprado_combi && !$tiene_archivo_combi): ?>
                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                    <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                    <input type="hidden" name="precio_telacombicompra" value="<?= $precio_telacombicompra_g ?>">
                                    <input type="hidden" name="consumo_telacombi" value="<?= $consumo_telacombi_g ?>">

                                    <td class="text-center align-middle"><?= $nombre_combi_html ?></td>
                                    <td class="text-center align-middle"><?= $proveedor_combi_html ?></td>
                                    <td class="text-center align-middle"><?= $precio_combi_html ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($consumo_telacombi_g) ?> Mts</td>
                                    <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_telacombicompra_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle">
                                        <input type="text" inputmode="decimal" class="form-control form-control-sm text-center input-miles-visible">
                                        <input type="hidden" name="total_telacombicompra" class="input-miles-hidden">
                                    </td>
                                    <td class="text-center align-middle"></td>
                                    <td class="text-center align-middle">
                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center" name="consumo_combinadatotal">
                                    </td>
                                    <td class="text-center align-middle"></td>
                                    <td class="text-center align-middle"></td>
                                    <td>
                                        <button type="submit" name="dif_telacombicom" class="btn btn-sm btn-danger mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                </form>
                                <?php if (!$tiene_homolog_combi): ?>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#homologarTelacombi<?= $fila['id_producto']; ?>"
                                        data-id-producto="<?= $fila['id_producto']; ?>"
                                        data-id-producto2="<?= $fila['id_producto2']; ?>"
                                        data-id-telacombi="<?= $fila['id_telacombi']; ?>"
                                        data-id-ordencompra="<?= $fila['id_ordencompra']; ?>">
                                        <i class="bi bi-pencil-square"></i> Homologar
                                    </button>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php elseif ($ya_comprado_combi && !$tiene_archivo_combi): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $nombre_combi_html ?></td>
                                <td class="text-center align-middle"><?= $proveedor_combi_html ?></td>
                                <td class="text-center align-middle"><?= $precio_combi_html ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_telacombi_g) ?> Mts</td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_telacombicompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $total_telacombicompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle <?= ($dif_total_telacombi_g < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio((float) $dif_total_telacombi_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_combinadatotal_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle <?= ($dif_consumocombi_total_g >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_consumocombi_total_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle"><?= !empty($fecha_recibido_telacombi_g) ? date('d/m/Y', strtotime($fecha_recibido_telacombi_g)) : '' ?></td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra2<?= $fila['id_producto']; ?>">
                                        <i class="bi bi-upload me-1"></i> Cargar Orden
                                    </button>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td class="text-center align-middle"><?= $nombre_combi_html ?></td>
                                <td class="text-center align-middle"><?= $proveedor_combi_html ?></td>
                                <td class="text-center align-middle"><?= $precio_combi_html ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_telacombi_g) ?> Mts</td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_telacombicompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $total_telacombicompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle <?= ($dif_total_telacombi_g < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio((float) $dif_total_telacombi_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_combinadatotal_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle <?= ($dif_consumocombi_total_g >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_consumocombi_total_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle"><?= !empty($fecha_recibido_telacombi_g) ? date('d/m/Y', strtotime($fecha_recibido_telacombi_g)) : '' ?></td>
                                <td class="text-center align-middle">
                                    <a href="orden_compra/<?= $fila['orden_compratelacombi'] ?? '' ?>" class="btn btn-sm btn-success" download> Descargar Orden <i class="bi bi-download"></i></a>
                                </td>
                            </tr>
                        <?php endif; ?>

                </tbody>
            </table>

                    <div class="modal fade" id="orden_compra2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content rounded-4 shadow-lg border-0">
                                <div class="modal-header" style="background-color: #000DD3;">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">

                                        <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                            <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">
                                                Selecciona un Archivo
                                            </h6>
                                            <div class="mt-4">
                                                <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                    <input
                                                        type="file"
                                                        class="custom-file-input"
                                                        name="orden_compratelacombi"
                                                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                        id="excelInput2<?php echo $fila['id_producto']; ?>"
                                                        onchange="previewFileGeneric(this, 'excelPreview2<?php echo $fila['id_producto']; ?>', 'fileNameExcel2_<?php echo $fila['id_producto']; ?>')">

                                                    <label class="custom-file-label text-truncate text-muted" for="excelInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">
                                                        <i class="bi bi-upload"></i> Seleccionar archivo
                                                    </label>
                                                </div>
                                                <div class="mt-3">
                                                    <center>
                                                        <img
                                                            id="excelPreview2<?php echo $fila['id_producto']; ?>"
                                                            class="img-thumbnail shadow-sm"
                                                            style="max-width: 50%; height: auto; border-radius: 12px; display: <?php echo empty($fila['orden_compratelacombi']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelacombi']) ? 'none' : 'block'; ?>;"
                                                            src="<?php echo !empty($fila['orden_compratelacombi']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelacombi']) ? 'orden_compra/' . $fila['orden_compratelacombi'] : ''; ?>">

                                                        <span
                                                            id="fileNameExcel2_<?php echo $fila['id_producto']; ?>"
                                                            class="text-muted"
                                                            style="display: <?php echo !empty($fila['orden_compratelacombi']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelacombi']) ? 'block' : 'none'; ?>;">
                                                            <?php echo $fila['orden_compratelacombi']; ?>
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" name="cargar_orden_compratelacombi" class="btn btn-success">Subir</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="homologarTelacombi<?php echo $fila['id_producto']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">

                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                    <h5 class="modal-title">Desea Homologar el Tipo de Tela Cotizado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                        <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Elija el tipo de Tela:</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control comboTelaCombiModal" placeholder="Buscar tela..." autocomplete="off">
                                                <div class="combobox-list list-group comboTelaCombiListModal" style="display:none;"></div>

                                                <select name="id_telacombi" class="form-select d-none selectTelaCombiModal">
                                                    <option value="0">Sin seleccionar</option>

                                                    <?php
                                                    $consulta_mysql = "SELECT tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas,
                                                            tela_combinada.rendimiento, tela_combinada.encogimiento, tela_combinada.precio, proveedor_tela.nombre
                                                            FROM tela_combinada
                                                            LEFT JOIN proveedor_tela
                                                            ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor";

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

                                                        echo "<option value='$id' data-precio='{$lista['precio']}' $selected>$nombre - $proveedor</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" name="homologar_telacombi" class="btn btn-success">Continuar</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----->
                <?php endif; ?>


                <?php if (!empty($fila['id_telaforro'])): ?>
                <table id="mytablaforro" class="table table-bordered text-center">
                <thead>
                    <tr class="table-primary">
                        <th style="text-align:center; vertical-align:middle; width:18%;">Tela Forro</th>
                        <th style="text-align:center; vertical-align:middle; width:8%;">Textilera</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Precio por<br>Metro</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Metros<br>Pedidos</th>
                        <th style="text-align:center; vertical-align:middle; width:9%;">Valor<br>Cotizado</th>
                        <th style="text-align:center; vertical-align:middle; width:9%;">Valor de<br>Compra</th>
                        <th style="text-align:center; vertical-align:middle; width:9%;">Diferencia<br>de Compra</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Metros<br>Recibidos</th>
                        <th style="text-align:center; vertical-align:middle; width:6%;">Diferencia<br>de Metros</th>
                        <th style="text-align:center; vertical-align:middle; width:7%;">Fecha<br>Recibido</th>
                        <th style="text-align:center; vertical-align:middle; width:16%;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Tela Forro -->
                    <?php
                        $id_telaforro = $fila['id_telaforro'];
                        $id_telaforro2 = !empty($fila['id_telaforro2']) ? $fila['id_telaforro2'] : null;

                        $consulta_2 = "SELECT tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                        FROM tela_forro
                                        LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor
                                        WHERE tela_forro.id_telaforro = '$id_telaforro'";
                        $resultado_2 = mysqli_query($enlace, $consulta_2);
                        $fila2 = mysqli_fetch_array($resultado_2);

                        $tiene_homolog_forro = !empty($id_telaforro2) && !empty($fila['precio_forro2']);
                        $filatelaforro2 = null;
                        if ($tiene_homolog_forro) {
                            $consulta_telacombi2 = "SELECT tela_forro.id_telaforro, tela_forro.tela_forro AS tela_forro2, proveedor_tela.nombre AS nombre_forro2
                                        FROM tela_forro
                                        LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor
                                        WHERE tela_forro.id_telaforro = '$id_telaforro2'";
                            $resultado_telacombi2 = mysqli_query($enlace, $consulta_telacombi2);
                            $filatelaforro2 = mysqli_fetch_array($resultado_telacombi2);
                        }

                        $precio_efectivo_forro = ($tiene_homolog_forro && !empty($fila['precio_forro2'])) ? $fila['precio_forro2'] : $fila['precio_forro'];
                        $consumo_telaforro_g = $fila['consumo_telaforro'] ?? null;
                        $precio_telaforrocompra_g = $fila['precio_telaforrocompra'] ?? null;
                        $total_telaforrocompra_g = $fila['total_telaforrocompra'] ?? null;
                        $dif_total_telaforro_g = $fila['dif_total_telaforro'] ?? null;
                        $consumo_forrototal_g = $fila['consumo_forrototal'] ?? null;
                        $dif_consumoforro_total_g = $fila['dif_consumoforro_total'] ?? null;
                        $fecha_recibido_telaforro_g = $fila['fecha_recibido_telaforro'] ?? null;
                        $ya_comprado_forro = ($total_telaforrocompra_g !== null && $total_telaforrocompra_g !== '');
                        $tiene_archivo_forro = (isset($fila['orden_compratelaforro']) && strlen($fila['orden_compratelaforro']) > 0);
                        $tiene_consumo_forro = ($consumo_telaforro_g !== null && $consumo_telaforro_g !== '');

                        $nombre_forro_html = htmlspecialchars($fila2['tela_forro'] ?? '');
                        $proveedor_forro_html = htmlspecialchars($fila2['nombre_forro'] ?? '');
                        $precio_forro_html = '$' . formatoPrecio((float) $fila['precio_forro']);
                        if ($tiene_homolog_forro) {
                            $nombre_forro_html .= '<hr class="my-2"><strong>Homologación:</strong> ' . htmlspecialchars($filatelaforro2['tela_forro2'] ?? '');
                            $proveedor_forro_html .= '<hr class="my-2">' . htmlspecialchars($filatelaforro2['nombre_forro2'] ?? '');
                            $precio_forro_html .= '<hr class="my-2">$' . formatoPrecio((float) $fila['precio_forro2']);
                        }
                        ?>

                        <?php if (!$tiene_consumo_forro): ?>
                            <tr>
                                <form action="" method="post">
                                    <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                    <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                    <input type="hidden" name="precio_efectivo" value="<?= $precio_efectivo_forro ?>">

                                    <td class="text-center align-middle"><?= $nombre_forro_html ?></td>
                                    <td class="text-center align-middle"><?= $proveedor_forro_html ?></td>
                                    <td class="text-center align-middle"><?= $precio_forro_html ?></td>
                                    <td class="text-center align-middle">
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm text-center" name="consumo_telaforro" placeholder="Mts">
                                    </td>
                                    <td class="text-center align-middle" colspan="6"></td>
                                    <td class="text-center align-middle">
                                        <button type="submit" name="guardar_consumo_telaforro" class="btn btn-sm btn-success"><i class="bi bi-save"></i> Guardar</button>
                                    </td>
                                </form>
                            </tr>
                        <?php elseif (!$ya_comprado_forro && !$tiene_archivo_forro): ?>
                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                    <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                    <input type="hidden" name="precio_telaforrocompra" value="<?= $precio_telaforrocompra_g ?>">
                                    <input type="hidden" name="consumo_telaforro" value="<?= $consumo_telaforro_g ?>">

                                    <td class="text-center align-middle"><?= $nombre_forro_html ?></td>
                                    <td class="text-center align-middle"><?= $proveedor_forro_html ?></td>
                                    <td class="text-center align-middle"><?= $precio_forro_html ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($consumo_telaforro_g) ?> Mts</td>
                                    <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_telaforrocompra_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle">
                                        <input type="text" inputmode="decimal" class="form-control form-control-sm text-center input-miles-visible">
                                        <input type="hidden" name="total_telaforrocompra" class="input-miles-hidden">
                                    </td>
                                    <td class="text-center align-middle"></td>
                                    <td class="text-center align-middle">
                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center" name="consumo_forrototal">
                                    </td>
                                    <td class="text-center align-middle"></td>
                                    <td class="text-center align-middle"></td>
                                    <td>
                                        <button type="submit" name="dif_telaforrocom" class="btn btn-sm btn-danger mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                </form>
                                <?php if (!$tiene_homolog_forro): ?>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#homologarTelaforro<?= $fila['id_producto']; ?>"
                                        data-id-producto="<?= $fila['id_producto']; ?>"
                                        data-id-producto2="<?= $fila['id_producto2']; ?>"
                                        data-id-telacombi="<?= $fila['id_telaforro']; ?>"
                                        data-id-ordencompra="<?= $fila['id_ordencompra']; ?>">
                                        <i class="bi bi-pencil-square"></i> Homologar
                                    </button>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php elseif ($ya_comprado_forro && !$tiene_archivo_forro): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $nombre_forro_html ?></td>
                                <td class="text-center align-middle"><?= $proveedor_forro_html ?></td>
                                <td class="text-center align-middle"><?= $precio_forro_html ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_telaforro_g) ?> Mts</td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_telaforrocompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $total_telaforrocompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle <?= ($dif_total_telaforro_g < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio((float) $dif_total_telaforro_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_forrototal_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle <?= ($dif_consumoforro_total_g >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_consumoforro_total_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle"><?= !empty($fecha_recibido_telaforro_g) ? date('d/m/Y', strtotime($fecha_recibido_telaforro_g)) : '' ?></td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra3<?= $fila['id_producto']; ?>">
                                        <i class="bi bi-upload me-1"></i> Cargar Orden
                                    </button>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td class="text-center align-middle"><?= $nombre_forro_html ?></td>
                                <td class="text-center align-middle"><?= $proveedor_forro_html ?></td>
                                <td class="text-center align-middle"><?= $precio_forro_html ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_telaforro_g) ?> Mts</td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_telaforrocompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $total_telaforrocompra_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle <?= ($dif_total_telaforro_g < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio((float) $dif_total_telaforro_g); ?>$<?= $pf ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_forrototal_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle <?= ($dif_consumoforro_total_g >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_consumoforro_total_g ?? '') ?> Mts</td>
                                <td class="text-center align-middle"><?= !empty($fecha_recibido_telaforro_g) ? date('d/m/Y', strtotime($fecha_recibido_telaforro_g)) : '' ?></td>
                                <td class="text-center align-middle">
                                    <a href="orden_compra/<?= $fila['orden_compratelaforro'] ?? '' ?>" class="btn btn-sm btn-success" download> Descargar Orden <i class="bi bi-download"></i></a>
                                </td>
                            </tr>
                        <?php endif; ?>

                </tbody>
            </table>

                    <div class="modal fade" id="orden_compra3<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content rounded-4 shadow-lg border-0">
                                <div class="modal-header" style="background-color: #000DD3;">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">

                                        <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                            <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">
                                                Selecciona un Archivo
                                            </h6>
                                            <div class="mt-4">
                                                <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                    <input
                                                        type="file"
                                                        class="custom-file-input"
                                                        name="orden_compratelaforro"
                                                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                        id="excelInput3<?php echo $fila['id_producto']; ?>"
                                                        onchange="previewFileGeneric(this, 'excelPreview3<?php echo $fila['id_producto']; ?>', 'fileNameExcel3_<?php echo $fila['id_producto']; ?>')">

                                                    <label class="custom-file-label text-truncate text-muted" for="excelInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">
                                                        <i class="bi bi-upload"></i> Seleccionar archivo
                                                    </label>
                                                </div>
                                                <div class="mt-3">
                                                    <center>
                                                        <img
                                                            id="excelPreview3<?php echo $fila['id_producto']; ?>"
                                                            class="img-thumbnail shadow-sm"
                                                            style="max-width: 50%; height: auto; border-radius: 12px; display: <?php echo empty($fila['orden_compratelaforro']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelaforro']) ? 'none' : 'block'; ?>;"
                                                            src="<?php echo !empty($fila['orden_compratelaforro']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelaforro']) ? 'orden_compra/' . $fila['orden_compratelaforro'] : ''; ?>">

                                                        <span
                                                            id="fileNameExcel3_<?php echo $fila['id_producto']; ?>"
                                                            class="text-muted"
                                                            style="display: <?php echo !empty($fila['orden_compratelaforro']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelaforro']) ? 'block' : 'none'; ?>;">
                                                            <?php echo $fila['orden_compratelaforro']; ?>
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" name="cargar_orden_compratelaforro" class="btn btn-success">Subir</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="homologarTelaforro<?php echo $fila['id_producto']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">

                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                    <h5 class="modal-title">Desea Homologar el Tipo de Tela Cotizado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                        <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Elija el tipo de Tela:</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control comboTelaForroModal" placeholder="Buscar tela..." autocomplete="off">
                                                <div class="combobox-list list-group comboTelaForroListModal" style="display:none;"></div>

                                                <select name="id_telaforro" class="form-select d-none selectTelaForroModal">
                                                    <option value="0">Sin seleccionar</option>

                                                    <?php
                                                    $consulta_mysql = "SELECT tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas,
                                                            tela_forro.rendimiento, tela_forro.encogimiento, tela_forro.precio, proveedor_tela.nombre
                                                            FROM tela_forro
                                                            LEFT JOIN proveedor_tela
                                                            ON tela_forro.id_proveedor = proveedor_tela.id_proveedor";

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

                                                        echo "<option value='$id' data-precio='{$lista['precio']}' $selected>$nombre - $proveedor</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_forro" value="<?php echo isset($fila['precio_forro']) && $fila['precio_forro'] !== '' ? $fila['precio_forro'] : 0; ?>">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" name="homologar_telaforro" class="btn btn-success">Continuar</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----->
                <?php endif; ?>

                <!-- Separador visual: distingue la tabla de tela(s) de la tabla de insumos -->
                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1" style="border: none; border-top: 2px dashed #9aa5b1; opacity: 0.6;">
                    <span class="mx-3 px-3 py-1 fw-bold text-white" style="background-color:#495057; border-radius: 999px; font-size: 0.85rem; letter-spacing: 0.5px;">
                        <i class="bi bi-tools me-1"></i> INSUMOS
                    </span>
                    <hr class="flex-grow-1" style="border: none; border-top: 2px dashed #9aa5b1; opacity: 0.6;">
                </div>

                <table id="mytabla3" class="table table-bordered text-center">
                    <thead>
                        <tr class="table-primary">
                            <th style="text-align: center; vertical-align: middle; width: 20%;">Insumo</th>
                            <th style="text-align: center; vertical-align: middle; width: 9%;">Proveedor</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Precio <br> Unitario</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Unidades Pedido</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Precio Cotizado<br> Total</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Precio <br> Compra Total</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Diferencia <br> Compra Total</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Unidades <br> Recibidas</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Diferencia <br> Compra Unitario</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Fecha <br> Recibido</th>
                            <th style="text-align: center; vertical-align: middle; width: 12%;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isumos Juntos -->
                        <?php if (
                            (!empty($fila['id_broche'])   && $fila['id_broche'] != '0') ||
                            (!empty($fila['id_cordon'])   && $fila['id_cordon'] != '0') ||
                            (!empty($fila['id_cuello'])   && $fila['id_cuello'] != '0') ||
                            (!empty($fila['id_deslizador'])   && $fila['id_deslizador'] != '0') ||
                            (!empty($fila['id_fajon_cintura'])   && $fila['id_fajon_cintura'] != '0') ||
                            (!empty($fila['id_guata'])    && $fila['id_guata'] != '0') ||
                            (!empty($fila['id_hiladilla'])   && $fila['id_hiladilla'] != '0') ||
                            (!empty($fila['id_hombrera']) && $fila['id_hombrera'] != '0') ||
                            (!empty($fila['id_plumilla']) && $fila['id_plumilla'] != '0') ||
                            (!empty($fila['id_pretina'])  && $fila['id_pretina'] != '0') ||
                            (!empty($fila['id_puntera'])  && $fila['id_puntera'] != '0') ||
                            (!empty($fila['id_puño'])     && $fila['id_puño'] != '0') ||
                            (!empty($fila['id_sesgo'])    && $fila['id_sesgo'] != '0') ||
                            (!empty($fila['id_trabilla']) && $fila['id_trabilla'] != '0') ||
                            (!empty($fila['id_velcro'])   && $fila['id_velcro'] != '0') ||
                            (!empty($fila['id_vinilo'])   && $fila['id_vinilo'] != '0') ||
                            (!empty($fila['id_vivo'])     && $fila['id_vivo'] != '0') ||
                            (!empty($fila['id_boton'])    && $fila['id_boton'] != '0') ||
                            (!empty($fila['id_boton2'])   && $fila['id_boton2'] != '0') ||
                            (!empty($fila['id_cremallera'])  && $fila['id_cremallera'] != '0') ||
                            (!empty($fila['id_cremallera2']) && $fila['id_cremallera2'] != '0') ||
                            (!empty($fila['id_resorte'])  && $fila['id_resorte'] != '0') ||
                            (!empty($fila['id_resorte2']) && $fila['id_resorte2'] != '0') ||
                            (!empty($fila['id_cinta'])    && $fila['id_cinta'] != '0') ||
                            (!empty($fila['id_faya'])     && $fila['id_faya'] != '0') ||
                            (!empty($fila['id_entretela'])  && $fila['id_entretela'] != '0') ||
                            (!empty($fila['id_entretela2']) && $fila['id_entretela2'] != '0') ||
                            (!empty($fila['id_marquilla']) && $fila['id_marquilla'] != '0') ||
                            (!empty($fila['id_bolsa'])     && $fila['id_bolsa'] != '0')
                        ):
                        ?>

                            <?php
                            $insumos = [
                                'broche',
                                'cordon',
                                'cuello',
                                'deslizador',
                                'fajon_cintura',
                                'guata',
                                'hiladilla',
                                'hombrera',
                                'plumilla',
                                'pretina',
                                'puntera',
                                'puño',
                                'sesgo',
                                'trabilla',
                                'velcro',
                                'vinilo',
                                'vivo',
                                'boton',
                                'boton2',
                                'cremallera',
                                'cremallera2',
                                'resorte',
                                'resorte2',
                                'cinta',
                                'faya',
                                'entretela',
                                'entretela2',
                                'marquilla',
                                'bolsa'
                            ];

                            // Algunas tablas reales no coinciden con el nombre del insumo
                            $tabla_real_map = ['cinta' => 'cinta_reflectiva', 'faya' => 'cinta_faya'];

                            foreach ($insumos as $insumo) {
                                $id_campo = 'id_' . $insumo;
                                $id_valor = $fila[$id_campo] ?? null;
                                $tabla_real = $tabla_real_map[$insumo] ?? $insumo;

                                if (!empty($id_valor)) {
                                    $consulta = "SELECT $tabla_real.$id_campo, proveedor.id_proveedor, proveedor.nombre AS proveedor_$insumo FROM $tabla_real LEFT JOIN proveedor ON $tabla_real.id_proveedor = proveedor.id_proveedor WHERE $tabla_real.$id_campo = '$id_valor'";

                                    $resultado = mysqli_query($enlace, $consulta);
                                    $proveedores[$insumo] = mysqli_fetch_array($resultado);
                                } else {
                                    $proveedores[$insumo] = null;
                                }
                            }
                            ?>

                            <?php
                            // Grupo1 = usan "consumo_X" en producto. Grupo2 = usan "cant_X".
                            // Grupo3 = marquilla/bolsa: no se homologan y su consumo es fijo (1 Und).
                            $insumos_grupo1 = ['cuello', 'puño'];
                            $insumos_grupo2 = [
                                'broche',
                                'cordon',
                                'deslizador',
                                'fajon_cintura',
                                'guata',
                                'hiladilla',
                                'hombrera',
                                'plumilla',
                                'pretina',
                                'puntera',
                                'sesgo',
                                'trabilla',
                                'velcro',
                                'vinilo',
                                'vivo',
                                'boton',
                                'boton2',
                                'cremallera',
                                'cremallera2',
                                'resorte',
                                'resorte2',
                                'cinta',
                                'faya',
                                'entretela',
                                'entretela2'
                            ];
                            $insumos_grupo3 = ['marquilla', 'bolsa'];

                            $insumos_totales = array_merge($insumos_grupo1, $insumos_grupo2, $insumos_grupo3);

                            foreach ($insumos_totales as $insumo):
                                $esGrupo1 = in_array($insumo, $insumos_grupo1);
                                $sinHomologar = in_array($insumo, $insumos_grupo3); // marquilla/bolsa: no se homologan
                            ?>
                                <?php if (!empty($fila['id_' . $insumo])): ?>
                                    <?php
                                    // Sufijo de homologación en producto2 (mismo mapa que en el handler PHP)
                                    $sufijo_producto2_map = [
                                        'boton' => 'boton22',
                                        'boton2' => 'boton222',
                                        'cremallera' => 'cremallera22',
                                        'cremallera2' => 'cremallera222',
                                        'resorte' => 'resorte22',
                                        'resorte2' => 'resorte222',
                                        'entretela' => 'entretela22',
                                        'entretela2' => 'entretela222',
                                    ];
                                    $sufijo = $sinHomologar ? null : ($sufijo_producto2_map[$insumo] ?? "{$insumo}2");
                                    $tabla_real = $tabla_real_map[$insumo] ?? $insumo;
                                    $campo_id_tabla = "id_$insumo";

                                    $filainsumo2 = null;
                                    $tiene_homolog = false;
                                    if (!$sinHomologar) {
                                        $columna_id_producto2 = "id_{$sufijo}";
                                        $id_insumo2 = $fila[$columna_id_producto2] ?? 0;
                                        $tiene_homolog = !empty($id_insumo2);

                                        if ($tiene_homolog) {
                                            $consulta = "SELECT $tabla_real.$campo_id_tabla, $tabla_real.insumo AS insumo_$insumo, producto2.precio_{$sufijo}, proveedor.id_proveedor, proveedor.nombre AS nombre_$insumo
                                                    FROM producto2
                                                    LEFT JOIN $tabla_real ON producto2.$columna_id_producto2 = $tabla_real.$campo_id_tabla
                                                    LEFT JOIN proveedor ON $tabla_real.id_proveedor = proveedor.id_proveedor
                                                    WHERE $tabla_real.$campo_id_tabla = '$id_insumo2'";
                                            $resultado = mysqli_query($enlace, $consulta);
                                            $filainsumo2 = mysqli_fetch_array($resultado);
                                        }
                                    }

                                    // Consumo unitario: marquilla/bolsa siempre 1 Und; el resto según su columna en producto
                                    $consumo_unitario = $sinHomologar ? 1 : ($esGrupo1 ? ($fila['consumo_' . $insumo] ?? 0) : ($fila['cant_' . $insumo] ?? 0));

                                    // Precio unitario efectivo (homologado si existe, si no el original) y con eso el
                                    // Precio Cotizado Total: igual que en tela, se calcula aquí (consumo_total x precio),
                                    // no se pide escrito porque ese dato ya se trae desde antes.
                                    $precio_unitario_efectivo = ($tiene_homolog && !empty($filainsumo2['precio_' . $sufijo]))
                                        ? $filainsumo2['precio_' . $sufijo]
                                        : ($fila['precio_' . $insumo] ?? 0);

                                    $col_consumo_total       = "consumo_total{$insumo}";
                                    $col_total_cotizado      = "total_{$insumo}cotizado";
                                    $col_total_compra        = "total_{$insumo}compra";
                                    $col_dif_total           = "dif_total_{$insumo}";
                                    $col_unidades_recibidas  = "unidades_recibidas_{$insumo}";
                                    $col_dif_unidades        = "dif_unidades_{$insumo}";
                                    $col_fecha_recibido      = "fecha_recibido_{$insumo}";

                                    // marquilla/bolsa no tienen columna consumo_total{insumo} en la BD (su cantidad
                                    // siempre es fija en 1 por prenda), así que se usa el consumo unitario directamente.
                                    $consumo_total_valor      = $sinHomologar ? $consumo_unitario : ($fila[$col_consumo_total] ?? null);
                                    $total_compra_valor       = $fila[$col_total_compra] ?? null;
                                    $dif_total_valor          = $fila[$col_dif_total] ?? null;
                                    $unidades_recibidas_valor = $fila[$col_unidades_recibidas] ?? null;
                                    $dif_unidades_valor       = $fila[$col_dif_unidades] ?? null;
                                    $fecha_recibido_valor     = $fila[$col_fecha_recibido] ?? null;

                                    // Precio Cotizado Total: usa lo ya guardado si existe; si no, lo calcula
                                    // (consumo_total x precio unitario efectivo) igual que tela.
                                    $total_cotizado_guardado = $fila[$col_total_cotizado] ?? null;
                                    $total_cotizado_valor = ($total_cotizado_guardado !== null && $total_cotizado_guardado !== '')
                                        ? $total_cotizado_guardado
                                        : ((float) ($consumo_total_valor ?? 0) * (float) $precio_unitario_efectivo);

                                    // Unidad de medida: entretela/entretela2 se miden en metros, el resto en unidades
                                    $unidad_medida = in_array($insumo, ['entretela', 'entretela2']) ? 'Mts' : 'Und';

                                    // "Ya comprado" = ya se guardó un total_{insumo}compra (0 es un valor válido, por eso no usar empty())
                                    $ya_comprado_insumo = ($total_compra_valor !== null && $total_compra_valor !== '');
                                    $tiene_archivo_insumo = (isset($fila['orden_compra' . $insumo]) && strlen($fila['orden_compra' . $insumo]) > 0);

                                    $nombre_insumo_mostrado = htmlspecialchars($fila['insumo_' . $insumo] ?? '');
                                    $precio_original = $fila['precio_' . $insumo] ?? 0;
                                    $precio_homologado = $tiene_homolog ? ($filainsumo2['precio_' . $sufijo] ?? 0) : null;

                                    // Insumo / Proveedor / Precio Unitario: si hay homologación, se muestran los dos valores
                                    // (cotizado y homologado) uno debajo del otro, con la MISMA letra y tamaño; solo la
                                    // etiqueta "Homologación:" va en negrilla para diferenciar, sin achicar ni opacar el texto.
                                    $insumo_html = $nombre_insumo_mostrado;
                                    $proveedor_html = htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? '');
                                    $precio_unitario_html = '$' . formatoPrecio((float) $precio_original);

                                    if ($tiene_homolog) {
                                        $insumo_html .= '<hr class="my-2"><strong>Homologación:</strong> ' . htmlspecialchars($filainsumo2['insumo_' . $insumo] ?? '');
                                        $proveedor_html .= '<hr class="my-2">' . htmlspecialchars($filainsumo2['nombre_' . $insumo] ?? '');
                                        $precio_unitario_html .= '<hr class="my-2">$' . formatoPrecio((float) $precio_homologado);
                                    }
                                    ?>

                                    <?php if (!$ya_comprado_insumo && !$tiene_archivo_insumo): ?>
                                        <tr>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra'] ?>">
                                                <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                                                <input type="hidden" name="consumo_total<?= $insumo ?>" value="<?= htmlspecialchars($consumo_total_valor ?? '') ?>">
                                                <input type="hidden" name="total_<?= $insumo ?>cotizado" value="<?= htmlspecialchars($total_cotizado_valor) ?>">

                                                <td class="text-center align-middle"><?= $insumo_html ?></td>
                                                <td class="text-center align-middle"><?= $proveedor_html ?></td>
                                                <td class="text-center align-middle"><?= $precio_unitario_html ?></td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($consumo_total_valor ?? '') ?> <?= $unidad_medida ?></td>
                                                <td class="text-center align-middle"><?php $pf = formatoPrecio($total_cotizado_valor); ?>$<?= $pf ?></td>
                                                <td class="text-center align-middle">
                                                    <input type="text" inputmode="decimal" class="form-control form-control-sm text-center input-miles-visible">
                                                    <input type="hidden" name="total_<?= $insumo ?>compra" class="input-miles-hidden">
                                                </td>
                                                <td class="text-center align-middle"></td>
                                                <td class="text-center align-middle">
                                                    <input type="number" step="any" min="0" class="form-control form-control-sm text-center" name="unidades_recibidas_<?= $insumo ?>">
                                                </td>
                                                <td class="text-center align-middle"></td>
                                                <td class="text-center align-middle"></td>
                                                <td class="text-center align-middle">
                                                    <!-- "En Inventario" se mantiene funcional pero oculto a pedido -->
                                                    <button type="submit" name="dif_<?= $insumo ?>inv" class="btn btn-sm btn-success mb-2" style="display:none;"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_<?= $insumo ?>com" class="btn btn-sm btn-danger mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                            </form>
                                            <?php if (!$sinHomologar): ?>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#homologar1<?= $insumo . $fila['id_producto']; ?>"
                                                    data-id-producto="<?= $fila['id_producto']; ?>"
                                                    data-id-producto2="<?= $fila['id_producto2']; ?>"
                                                    data-id-insumo="<?= $fila['id_' . $insumo]; ?>"
                                                    data-id-ordencompra="<?= $fila['id_ordencompra']; ?>">
                                                    <i class="bi bi-pencil-square"></i> Homologar
                                                </button>
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php elseif ($ya_comprado_insumo && !$tiene_archivo_insumo): ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $insumo_html ?></td>
                                            <td class="text-center align-middle"><?= $proveedor_html ?></td>
                                            <td class="text-center align-middle"><?= $precio_unitario_html ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($consumo_total_valor ?? '') ?> <?= $unidad_medida ?></td>
                                            <td class="text-center align-middle"><?php $pf = formatoPrecio($total_cotizado_valor ?? 0); ?>$<?= $pf ?></td>
                                            <td class="text-center align-middle"><?php $pf = formatoPrecio($total_compra_valor ?? 0); ?>$<?= $pf ?></td>
                                            <td class="text-center align-middle <?= ($dif_total_valor < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio($dif_total_valor ?? 0); ?>$<?= $pf ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($unidades_recibidas_valor ?? '') ?> <?= $unidad_medida ?></td>
                                            <td class="text-center align-middle <?= ($dif_unidades_valor >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_unidades_valor ?? '') ?> <?= $unidad_medida ?></td>
                                            <td class="text-center align-middle"><?= !empty($fecha_recibido_valor) ? date('d/m/Y', strtotime($fecha_recibido_valor)) : '' ?></td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra<?= $insumo . $fila['id_producto']; ?>">
                                                    <i class="bi bi-upload me-1"></i> Cargar Orden
                                                </button>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $insumo_html ?></td>
                                            <td class="text-center align-middle"><?= $proveedor_html ?></td>
                                            <td class="text-center align-middle"><?= $precio_unitario_html ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($consumo_total_valor ?? '') ?> <?= $unidad_medida ?></td>
                                            <td class="text-center align-middle"><?php $pf = formatoPrecio($total_cotizado_valor ?? 0); ?>$<?= $pf ?></td>
                                            <td class="text-center align-middle"><?php $pf = formatoPrecio($total_compra_valor ?? 0); ?>$<?= $pf ?></td>
                                            <td class="text-center align-middle <?= ($dif_total_valor < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio($dif_total_valor ?? 0); ?>$<?= $pf ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($unidades_recibidas_valor ?? '') ?> <?= $unidad_medida ?></td>
                                            <td class="text-center align-middle <?= ($dif_unidades_valor >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_unidades_valor ?? '') ?> <?= $unidad_medida ?></td>
                                            <td class="text-center align-middle"><?= !empty($fecha_recibido_valor) ? date('d/m/Y', strtotime($fecha_recibido_valor)) : '' ?></td>
                                            <td class="text-center align-middle">
                                                <a href="orden_compra/<?= $fila['orden_compra' . $insumo] ?? '' ?>" class="btn btn-sm btn-success" download> Descargar Orden <i class="bi bi-download"></i></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="modal fade" id="orden_compra<?= $insumo . $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $insumo . $fila['id_producto']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4 shadow-lg border-0">
                                            <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title text-white" id="modalLabel<?= $insumo . $fila['id_producto']; ?>">Cargar Orden de Compra (<?= ucfirst($insumo) ?>)</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">

                                                    <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                        <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">
                                                            Selecciona un Archivo
                                                        </h6>
                                                        <div class="mt-4">
                                                            <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                                <input
                                                                    type="file"
                                                                    class="custom-file-input"
                                                                    name="orden_compra<?= $insumo; ?>"
                                                                    accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                    id="inputFile<?= $insumo . $fila['id_producto']; ?>"
                                                                    onchange="previewFileGeneric(this, 'preview<?= $insumo . $fila['id_producto']; ?>', 'fileName<?= $insumo . $fila['id_producto']; ?>')">

                                                                <label class="custom-file-label text-truncate text-muted" for="inputFile<?= $insumo . $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                    <i class="bi bi-upload"></i> Seleccionar archivo
                                                                </label>
                                                            </div>

                                                            <div class="mt-3">
                                                                <center>
                                                                    <img
                                                                        id="preview<?= $insumo . $fila['id_producto']; ?>"
                                                                        class="img-thumbnail shadow-sm"
                                                                        style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila["orden_compra{$insumo}"]) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila["orden_compra{$insumo}"]) ? 'none' : 'block'; ?>;"
                                                                        src="<?= !empty($fila["orden_compra{$insumo}"]) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila["orden_compra{$insumo}"]) ? 'orden_compra/' . $fila["orden_compra{$insumo}"] : ''; ?>">

                                                                    <span
                                                                        id="fileName<?= $insumo . $fila['id_producto']; ?>"
                                                                        class="text-muted"
                                                                        style="display: <?= !empty($fila["orden_compra{$insumo}"]) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila["orden_compra{$insumo}"]) ? 'block' : 'none'; ?>;">
                                                                        <?= $fila["orden_compra{$insumo}"] ?? ''; ?>
                                                                    </span>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" name="cargar_orden_compra<?= $insumo; ?>" class="btn btn-success">Subir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!$sinHomologar): ?>
                                    <div class="modal fade" id="homologar1<?php echo $insumo . $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                    <h5 class="modal-title">Desea Homologar el Tipo de Insumo Cotizado</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario_<?php echo $insumo; ?>" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                        <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                        <input type="hidden" name="id_insumo" value="<?php echo $fila['id_' . $insumo]; ?>">
                                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                        <?php if ($insumo === 'cuello'): ?>
                                                            <div>
                                                                <select name="id_cuello" class="form-select" onchange="togglePrecioCuello(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_cuello, insumo, precio FROM cuello";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cuello'] == $fila['id_cuello']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cuello']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cuello" value="<?php echo $fila['precio_cuello'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="consumo_cuello" value="<?php echo $fila['consumo_cuello'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'puño'): ?>
                                                            <div>
                                                                <select name="id_puño" class="form-select" onchange="togglePrecioPuño(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_puño, insumo, precio FROM puño";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_puño'] == $fila['id_puño']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_puño']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_puño" value="<?php echo $fila['precio_puño'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="consumo_puño" value="<?php echo $fila['consumo_puño'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'velcro'): ?>
                                                            <div>
                                                                <select name="id_velcro" class="form-select" onchange="togglePrecioVelcro(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_velcro, insumo, precio FROM velcro";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_velcro'] == $fila['id_velcro']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_velcro']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_velcro" value="<?php echo $fila['precio_velcro'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_velcro" value="<?php echo $fila['cant_velcro'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'hombrera'): ?>
                                                            <div>
                                                                <select name="id_hombrera" class="form-select" onchange="togglePrecioHombrera(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_hombrera, insumo, precio FROM hombrera";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_hombrera'] == $fila['id_hombrera']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_hombrera']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_hombrera" value="<?php echo $fila['precio_hombrera'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_hombrera" value="<?php echo $fila['cant_hombrera'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'sesgo'): ?>
                                                            <div>
                                                                <select name="id_sesgo" class="form-select" onchange="togglePrecioSesgo(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_sesgo, insumo, precio FROM sesgo";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_sesgo'] == $fila['id_sesgo']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_sesgo']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_sesgo" value="<?php echo $fila['precio_sesgo'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_sesgo" value="<?php echo $fila['cant_sesgo'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'trabilla'): ?>
                                                            <div>
                                                                <select name="id_trabilla" class="form-select" onchange="togglePrecioTrabilla(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_trabilla, insumo, precio FROM trabilla";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_trabilla'] == $fila['id_trabilla']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_trabilla']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_trabilla" value="<?php echo $fila['precio_trabilla'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_trabilla" value="<?php echo $fila['cant_trabilla'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'vivo'): ?>
                                                            <div>
                                                                <select name="id_vivo" class="form-select" onchange="togglePrecioVivo(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_vivo, insumo, precio FROM vivo";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_vivo'] == $fila['id_vivo']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_vivo']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_vivo" value="<?php echo $fila['precio_vivo'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_vivo" value="<?php echo $fila['cant_vivo'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'guata'): ?>
                                                            <div>
                                                                <select name="id_guata" class="form-select" onchange="togglePrecioGuata(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_guata, insumo, precio FROM guata";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_guata'] == $fila['id_guata']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_guata']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_guata" value="<?php echo $fila['precio_guata'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_guata" value="<?php echo $fila['cant_guata'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'pretina'): ?>
                                                            <div>
                                                                <select name="id_pretina" class="form-select" onchange="togglePrecioPretina(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_pretina, insumo, precio FROM pretina";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_pretina'] == $fila['id_pretina']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_pretina']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_pretina" value="<?php echo $fila['precio_pretina'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_pretina" value="<?php echo $fila['cant_pretina'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'broche'): ?>
                                                            <div>
                                                                <select name="id_broche" class="form-select" onchange="togglePrecioBroche(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_broche, insumo, precio FROM broche";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_broche'] == $fila['id_broche']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_broche']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_broche" value="<?php echo $fila['precio_broche'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_broche" value="<?php echo $fila['cant_broche'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'cordon'): ?>
                                                            <div>
                                                                <select name="id_cordon" class="form-select" onchange="togglePrecioCordon(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_cordon, insumo, precio FROM cordon";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cordon'] == $fila['id_cordon']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cordon']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cordon" value="<?php echo $fila['precio_cordon'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_cordon" value="<?php echo $fila['cant_cordon'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'puntera'): ?>
                                                            <div>
                                                                <select name="id_puntera" class="form-select" onchange="togglePrecioPuntera(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_puntera, insumo, precio FROM puntera";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_puntera'] == $fila['id_puntera']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_puntera']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_puntera" value="<?php echo $fila['precio_puntera'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_puntera" value="<?php echo $fila['cant_puntera'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'plumilla'): ?>
                                                            <div>
                                                                <select name="id_plumilla" class="form-select" onchange="togglePrecioPlumilla(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_plumilla, insumo, precio FROM plumilla";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_plumilla'] == $fila['id_plumilla']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_plumilla']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_plumilla" value="<?php echo $fila['precio_plumilla'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_plumilla" value="<?php echo $fila['cant_plumilla'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'vinilo'): ?>
                                                            <div>
                                                                <select name="id_vinilo" class="form-select" onchange="togglePrecioVinilo(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_vinilo, insumo, precio FROM vinilo";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_vinilo'] == $fila['id_vinilo']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_vinilo']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_vinilo" value="<?php echo $fila['precio_vinilo'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_vinilo" value="<?php echo $fila['cant_vinilo'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'deslizador'): ?>
                                                            <div>
                                                                <select name="id_deslizador" class="form-select" onchange="togglePrecioDeslizador(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_deslizador, insumo, precio FROM deslizador";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_deslizador'] == $fila['id_deslizador']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_deslizador']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_deslizador" value="<?php echo $fila['precio_deslizador'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_deslizador" value="<?php echo $fila['cant_deslizador'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'fajon_cintura'): ?>
                                                            <div>
                                                                <select name="id_fajon_cintura" class="form-select" onchange="togglePrecioFajon(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_fajon_cintura, insumo, precio FROM fajon_cintura";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_fajon_cintura'] == $fila['id_fajon_cintura']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_fajon_cintura']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_fajon_cintura" value="<?php echo $fila['precio_fajon_cintura'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_fajon_cintura" value="<?php echo $fila['cant_fajon_cintura'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'hiladilla'): ?>
                                                            <div>
                                                                <select name="id_hiladilla" class="form-select" onchange="togglePrecioHiladilla(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_hiladilla, insumo, precio FROM hiladilla";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_hiladilla'] == $fila['id_hiladilla']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_hiladilla']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_hiladilla" value="<?php echo $fila['precio_hiladilla'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_hiladilla" value="<?php echo $fila['cant_hiladilla'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'boton'): ?>
                                                            <div>
                                                                <select name="id_boton" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_boton, insumo, precio FROM boton";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_boton'] == $fila['id_boton']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_boton']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_boton" value="<?php echo $fila['precio_boton'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_boton" value="<?php echo $fila['cant_boton'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'boton2'): ?>
                                                            <div>
                                                                <select name="id_boton2" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_boton2, insumo, precio FROM boton2";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_boton2'] == $fila['id_boton2']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_boton2']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_boton2" value="<?php echo $fila['precio_boton2'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_boton2" value="<?php echo $fila['cant_boton2'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'cremallera'): ?>
                                                            <div>
                                                                <select name="id_cremallera" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_cremallera, insumo, precio FROM cremallera";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cremallera'] == $fila['id_cremallera']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cremallera']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cremallera" value="<?php echo $fila['precio_cremallera'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_cremallera" value="<?php echo $fila['cant_cremallera'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'cremallera2'): ?>
                                                            <div>
                                                                <select name="id_cremallera2" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_cremallera2, insumo, precio FROM cremallera2";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cremallera2'] == $fila['id_cremallera2']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cremallera2']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cremallera2" value="<?php echo $fila['precio_cremallera2'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_cremallera2" value="<?php echo $fila['cant_cremallera2'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'resorte'): ?>
                                                            <div>
                                                                <select name="id_resorte" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_resorte, insumo, precio FROM resorte";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_resorte'] == $fila['id_resorte']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_resorte']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_resorte" value="<?php echo $fila['precio_resorte'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_resorte" value="<?php echo $fila['cant_resorte'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'resorte2'): ?>
                                                            <div>
                                                                <select name="id_resorte2" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_resorte2, insumo, precio FROM resorte2";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_resorte2'] == $fila['id_resorte2']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_resorte2']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_resorte2" value="<?php echo $fila['precio_resorte2'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_resorte2" value="<?php echo $fila['cant_resorte2'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'cinta'): ?>
                                                            <div>
                                                                <select name="id_cinta" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_cinta, insumo, precio FROM cinta_reflectiva";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cinta'] == $fila['id_cinta']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cinta']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cinta" value="<?php echo $fila['precio_cinta'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_cinta" value="<?php echo $fila['cant_cinta'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'faya'): ?>
                                                            <div>
                                                                <select name="id_faya" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_faya, insumo, precio FROM cinta_faya";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_faya'] == $fila['id_faya']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_faya']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_faya" value="<?php echo $fila['precio_faya'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_faya" value="<?php echo $fila['cant_faya'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'entretela'): ?>
                                                            <div>
                                                                <select name="id_entretela" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_entretela, insumo, precio FROM entretela";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_entretela'] == $fila['id_entretela']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_entretela']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_entretela" value="<?php echo $fila['precio_entretela'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_entretela" value="<?php echo $fila['cant_entretela'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'entretela2'): ?>
                                                            <div>
                                                                <select name="id_entretela2" class="form-select">
                                                                    <?php
                                                                    $consulta = "SELECT id_entretela2, insumo, precio FROM entretela2";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_entretela2'] == $fila['id_entretela2']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_entretela2']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_entretela2" value="<?php echo $fila['precio_entretela2'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" readonly name="cant_entretela2" value="<?php echo $fila['cant_entretela2'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <!---->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="homologar_insumos" class="btn btn-success">Continuar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!----->

                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <?php else: ?>

        <!-- PRENDA COMPRADA (producto tipo 8: no usa tela ni insumos) -->
        <div class="container-fluid px-3">
            <?php if (!empty($colores_curva)): ?>
                <table id="mytablaprenda" class="table table-bordered text-center">
                    <thead>
                        <tr class="table-primary">
                            <th style="text-align: center; vertical-align: middle; width: 19%;">Prenda</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Proveedor</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Precio <br> Unitario</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Unidades a <br> Comprar</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Precio Cotizado<br> Total</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Precio <br> Compra Total</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Diferencia <br> Compra Total</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Unidades <br> Recibidas</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Diferencia <br> Compra Unitario</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Fecha <br> Recibido</th>
                            <th style="text-align: center; vertical-align: middle; width: 13%;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($fila['id_prendacomprada'])): foreach ($colores_curva as $index => $color): $g = $index + 1; ?>
                            <?php
                            $suf = ($g == 1) ? '' : $g;
                            $prendas_comprar_g = $fila['prendas_comprar' . $suf] ?? null;
                            $precio_prendacompra_g = $fila['precio_prendacompra' . $suf] ?? null;
                            $total_prendacompra_g = $fila['total_prendacompra' . $suf] ?? null;
                            $dif_total_prenda_g = $fila['dif_total_prenda' . $suf] ?? null;
                            $unidades_recibidas_prenda_g = $fila['unidades_recibidas_prenda' . $suf] ?? null;
                            $dif_unidades_prenda_g = $fila['dif_unidades_prenda' . $suf] ?? null;
                            $fecha_recibido_prenda_g = $fila['fecha_recibido_prenda' . $suf] ?? null;
                            $orden_compraprenda_g = $fila['orden_compraprenda' . $suf] ?? null;

                            $ya_comprado_prenda = ($total_prendacompra_g !== null && $total_prendacompra_g !== '');
                            $tiene_archivo_prenda = (!empty($orden_compraprenda_g));

                            $nombre_prenda_html = htmlspecialchars($fila['nombre_producto'] ?? '') . ' - Color ' . htmlspecialchars($color);
                            $proveedor_prenda_html = htmlspecialchars($fila['nombre_proveedor_prenda'] ?? '');
                            $precio_unitario_html = '$' . formatoPrecio((float) ($fila['precio_prenda_unitario'] ?? 0));
                            ?>

                            <?php if (!$ya_comprado_prenda && !$tiene_archivo_prenda): ?>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                                        <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra'] ?>">
                                        <input type="hidden" name="color_index" value="<?= $g ?>">
                                        <input type="hidden" name="precio_prendacompra_actual" value="<?= $precio_prendacompra_g ?>">
                                        <input type="hidden" name="prendas_comprar_actual" value="<?= $prendas_comprar_g ?>">

                                        <td class="text-center align-middle"><?= $nombre_prenda_html ?></td>
                                        <td class="text-center align-middle"><?= $proveedor_prenda_html ?></td>
                                        <td class="text-center align-middle"><?= $precio_unitario_html ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($prendas_comprar_g ?? '') ?> Und</td>
                                        <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_prendacompra_g); ?>$<?= $pf ?></td>
                                        <td class="text-center align-middle">
                                            <input type="text" inputmode="decimal" class="form-control form-control-sm text-center input-miles-visible">
                                            <input type="hidden" name="total_prendacompra" class="input-miles-hidden">
                                        </td>
                                        <td class="text-center align-middle"></td>
                                        <td class="text-center align-middle">
                                            <input type="number" step="any" min="0" class="form-control form-control-sm text-center" name="unidades_recibidas_prenda">
                                        </td>
                                        <td class="text-center align-middle"></td>
                                        <td class="text-center align-middle"></td>
                                        <td class="text-center align-middle">
                                            <button type="submit" name="dif_prendacom" class="btn btn-sm btn-danger"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php elseif ($ya_comprado_prenda && !$tiene_archivo_prenda): ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $nombre_prenda_html ?></td>
                                    <td class="text-center align-middle"><?= $proveedor_prenda_html ?></td>
                                    <td class="text-center align-middle"><?= $precio_unitario_html ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($prendas_comprar_g ?? '') ?> Und</td>
                                    <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_prendacompra_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $total_prendacompra_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle <?= ($dif_total_prenda_g < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio((float) $dif_total_prenda_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($unidades_recibidas_prenda_g ?? '') ?> Und</td>
                                    <td class="text-center align-middle <?= ($dif_unidades_prenda_g >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_unidades_prenda_g ?? '') ?> Und</td>
                                    <td class="text-center align-middle"><?= !empty($fecha_recibido_prenda_g) ? date('d/m/Y', strtotime($fecha_recibido_prenda_g)) : '' ?></td>
                                    <td class="text-center align-middle">
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orden_compraprenda<?= $g . $fila['id_producto']; ?>">
                                            <i class="bi bi-upload me-1"></i> Cargar Orden
                                        </button>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $nombre_prenda_html ?></td>
                                    <td class="text-center align-middle"><?= $proveedor_prenda_html ?></td>
                                    <td class="text-center align-middle"><?= $precio_unitario_html ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($prendas_comprar_g ?? '') ?> Und</td>
                                    <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $precio_prendacompra_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle"><?php $pf = formatoPrecio((float) $total_prendacompra_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle <?= ($dif_total_prenda_g < 0) ? 'text-danger' : 'text-success' ?>"><?php $pf = formatoPrecio((float) $dif_total_prenda_g); ?>$<?= $pf ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($unidades_recibidas_prenda_g ?? '') ?> Und</td>
                                    <td class="text-center align-middle <?= ($dif_unidades_prenda_g >= 0) ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($dif_unidades_prenda_g ?? '') ?> Und</td>
                                    <td class="text-center align-middle"><?= !empty($fecha_recibido_prenda_g) ? date('d/m/Y', strtotime($fecha_recibido_prenda_g)) : '' ?></td>
                                    <td class="text-center align-middle">
                                        <a href="orden_compra/<?= $orden_compraprenda_g ?? '' ?>" class="btn btn-sm btn-success" download> Descargar Orden <i class="bi bi-download"></i></a>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compraprenda<?= $g . $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white">Cargar Orden de Compra — Color <?= htmlspecialchars($color) ?></h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra'] ?>">
                                                <input type="hidden" name="color_index" value="<?= $g ?>">

                                                <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                    <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">
                                                        Selecciona un Archivo
                                                    </h6>
                                                    <div class="mt-4">
                                                        <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                            <input type="file" class="custom-file-input" name="orden_compraprenda"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="inputPrenda<?= $g . $fila['id_producto']; ?>"
                                                                onchange="previewFileGeneric(this, 'previewPrenda<?= $g . $fila['id_producto']; ?>', 'fileNamePrenda<?= $g . $fila['id_producto']; ?>')">
                                                            <label class="custom-file-label text-truncate text-muted" for="inputPrenda<?= $g . $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <center>
                                                                <img id="previewPrenda<?= $g . $fila['id_producto']; ?>" class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($orden_compraprenda_g) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $orden_compraprenda_g) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($orden_compraprenda_g) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $orden_compraprenda_g) ? 'orden_compra/' . $orden_compraprenda_g : ''; ?>">
                                                                <span id="fileNamePrenda<?= $g . $fila['id_producto']; ?>" class="text-muted"
                                                                    style="display: <?= !empty($orden_compraprenda_g) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $orden_compraprenda_g) ? 'block' : 'none'; ?>;">
                                                                    <?= htmlspecialchars($orden_compraprenda_g ?? '') ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraprenda" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <?php endif; ?>

        <!-- OBSERVACIONES GENERALES: aparece una sola vez, sin importar el tipo de producto -->
        <div class="container-fluid px-3">
            <div>
                <div class="col-12">
                    <form action="" method="post" class="d-flex align-items-stretch border border-primary rounded overflow-hidden" style="min-height: 60px;">
                        <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                        <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra'] ?>">
                        <div class="text-white d-flex align-items-center justify-content-center text-center fw-bold px-3"
                            style="background-color:#6c757d; min-width: 220px;">
                            OBSERVACIONES GENERALES
                        </div>
                        <textarea name="observaciones_generales" rows="2"
                            class="form-control border-0 rounded-0 flex-grow-1"
                            placeholder="Escribe aquí la observación..."
                            style="resize: vertical;"><?= htmlspecialchars($fila['observaciones_generales'] ?? '') ?></textarea>
                        <button type="submit" name="guardar_observacion_generales" class="btn btn-primary rounded-0 px-4">
                            <i class="bi bi-save"></i> Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <br><br>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        <script>
            function actualizarSumaColor(card) {
                var inputs = card.querySelectorAll('.input-promedio:not([disabled])');
                var suma = 0;
                inputs.forEach(function(inp) {
                    var v = parseFloat(inp.value);
                    if (!isNaN(v)) suma += v;
                });
                var celda = card.querySelector('.suma-promedios-color');
                if (celda) celda.textContent = suma.toFixed(2);

                var hidden = card.querySelector('.input-consumo-calc'); // <-- nuevo
                if (hidden) hidden.value = suma.toFixed(2); // <-- nuevo

                return suma;
            }

            function actualizarSumaGlobal() {
                var totalGlobal = 0;
                document.querySelectorAll('.card[data-color-index]').forEach(function(card) {
                    totalGlobal += actualizarSumaColor(card);
                });
                document.getElementById('suma_promedios_global').textContent = totalGlobal.toFixed(2);
            }

            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-promedio')) {
                    actualizarSumaGlobal();
                }
            });

            document.addEventListener('DOMContentLoaded', actualizarSumaGlobal);

            // Formato de miles en vivo para "Valor de Compra" (ej: 100000 -> 100.000)
            // El input visible (texto) se formatea; el input oculto guarda el número real que se envía al servidor.
            document.addEventListener('input', function(e) {
                if (!e.target.classList.contains('input-miles-visible')) return;

                var input = e.target;
                var hidden = input.parentElement.querySelector('.input-miles-hidden');

                // Deja solo dígitos y una coma para decimales
                var raw = input.value.replace(/[^\d,]/g, '');
                var partes = raw.split(',');
                var parteEntera = (partes[0] || '').replace(/\D/g, '');
                var parteDecimal = partes.length > 1 ? partes[1].replace(/\D/g, '').slice(0, 2) : null;

                // Formatea la parte entera con puntos de miles
                var enteraFormateada = parteEntera.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                input.value = (parteDecimal !== null) ? (enteraFormateada + ',' + parteDecimal) : enteraFormateada;

                // Valor real (con punto decimal) para el campo oculto que se envía al servidor
                if (hidden) {
                    var enteroReal = parteEntera || '0';
                    hidden.value = (parteDecimal !== null && parteDecimal !== '') ? (enteroReal + '.' + parteDecimal) : enteroReal;
                }
            });

            // Muestra el nombre del archivo elegido (y una miniatura si es imagen) en el modal "Cargar Orden de Compra"
            function previewFile(input, imgId, nameId) {
                var img = document.getElementById(imgId);
                var nameSpan = document.getElementById(nameId);
                var label = input.closest('.custom-file') ? input.closest('.custom-file').querySelector('.custom-file-label') : null;

                if (!input.files || !input.files[0]) return;
                var archivo = input.files[0];

                if (label) {
                    label.innerHTML = '<i class="bi bi-upload"></i> ' + archivo.name;
                }

                var esImagen = /\.(jpg|jpeg|png|gif|webp|avif)$/i.test(archivo.name);

                if (esImagen) {
                    var lector = new FileReader();
                    lector.onload = function(e) {
                        if (img) {
                            img.src = e.target.result;
                            img.style.display = 'block';
                        }
                        if (nameSpan) nameSpan.style.display = 'none';
                    };
                    lector.readAsDataURL(archivo);
                } else {
                    if (img) img.style.display = 'none';
                    if (nameSpan) {
                        nameSpan.textContent = archivo.name;
                        nameSpan.style.display = 'block';
                    }
                }
            }

            // Igual que previewFile, usada por los modales de "Cargar Orden" de cada insumo
            // (faltaba en el archivo original: el modal la llamaba pero nunca estaba definida).
            function previewFileGeneric(input, imgId, nameId) {
                previewFile(input, imgId, nameId);
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.querySelectorAll(".comboTelaModal").forEach(function(input) {

                    const container = input.closest(".position-relative");
                    const list = container.querySelector(".comboTelaListModal");
                    const select = container.querySelector(".selectTelaModal");

                    const modal = input.closest(".modal");
                    const precioInput = modal.querySelector('input[name="precio_tela"]');

                    // ===== OPCIONES =====
                    const opciones = Array.from(select.options)
                        .filter(opt => opt.value !== "0")
                        .map(opt => ({
                            id: opt.value,
                            texto: opt.textContent,
                            precio: opt.dataset.precio
                        }));

                    // ===== BUSCADOR =====
                    input.addEventListener("input", function() {
                        const filtro = this.value.toLowerCase();
                        list.innerHTML = "";

                        if (filtro === "") {
                            select.value = "0";
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
                            div.className = "list-group-item list-group-item-action";
                            div.textContent = o.texto;

                            div.addEventListener("click", function() {
                                input.value = o.texto;
                                select.value = o.id;

                                // actualizar precio
                                if (precioInput) {
                                    precioInput.value = o.precio;
                                }

                                list.style.display = "none";
                            });

                            list.appendChild(div);
                        });

                        list.style.display = "block";
                    });

                    // ===== INICIALIZACIÓN =====
                    const selectedOpt = select.options[select.selectedIndex];

                    if (selectedOpt && selectedOpt.value !== "0") {
                        input.value = selectedOpt.textContent;

                        if (precioInput) {
                            precioInput.value = selectedOpt.dataset.precio;
                        }
                    }

                    // ===== CERRAR LISTA =====
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

                document.querySelectorAll(".comboTelaCombiModal").forEach(function(input) {

                    const container = input.closest(".position-relative");
                    const list = container.querySelector(".comboTelaCombiListModal");
                    const select = container.querySelector(".selectTelaCombiModal");

                    const modal = input.closest(".modal");
                    const precioInput = modal.querySelector('input[name="precio_telacombinada"]');

                    // ===== OPCIONES =====
                    const opciones = Array.from(select.options)
                        .filter(opt => opt.value !== "0")
                        .map(opt => ({
                            id: opt.value,
                            texto: opt.textContent,
                            precio: opt.dataset.precio
                        }));

                    // ===== BUSCADOR =====
                    input.addEventListener("input", function() {
                        const filtro = this.value.toLowerCase();
                        list.innerHTML = "";

                        if (filtro === "") {
                            select.value = "0";
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
                            div.className = "list-group-item list-group-item-action";
                            div.textContent = o.texto;

                            div.addEventListener("click", function() {
                                input.value = o.texto;
                                select.value = o.id;

                                // actualizar precio
                                if (precioInput) {
                                    precioInput.value = o.precio;
                                }

                                list.style.display = "none";
                            });

                            list.appendChild(div);
                        });

                        list.style.display = "block";
                    });

                    // ===== INICIALIZACIÓN =====
                    const selectedOpt = select.options[select.selectedIndex];

                    if (selectedOpt && selectedOpt.value !== "0") {
                        input.value = selectedOpt.textContent;

                        if (precioInput) {
                            precioInput.value = selectedOpt.dataset.precio;
                        }
                    }

                    // ===== CERRAR LISTA =====
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

                document.querySelectorAll(".comboTelaForroModal").forEach(function(input) {

                    const container = input.closest(".position-relative");
                    const list = container.querySelector(".comboTelaForroListModal");
                    const select = container.querySelector(".selectTelaForroModal");

                    const modal = input.closest(".modal");
                    const precioInput = modal.querySelector('input[name="precio_forro"]');

                    // ===== OPCIONES =====
                    const opciones = Array.from(select.options)
                        .filter(opt => opt.value !== "0")
                        .map(opt => ({
                            id: opt.value,
                            texto: opt.textContent,
                            precio: opt.dataset.precio
                        }));

                    // ===== BUSCADOR =====
                    input.addEventListener("input", function() {
                        const filtro = this.value.toLowerCase();
                        list.innerHTML = "";

                        if (filtro === "") {
                            select.value = "0";
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
                            div.className = "list-group-item list-group-item-action";
                            div.textContent = o.texto;

                            div.addEventListener("click", function() {
                                input.value = o.texto;
                                select.value = o.id;

                                if (precioInput) {
                                    precioInput.value = o.precio;
                                }

                                list.style.display = "none";
                            });

                            list.appendChild(div);
                        });

                        list.style.display = "block";
                    });

                    // ===== INICIAL =====
                    const selectedOpt = select.options[select.selectedIndex];

                    if (selectedOpt && selectedOpt.value !== "0") {
                        input.value = selectedOpt.textContent;

                        if (precioInput) {
                            precioInput.value = selectedOpt.dataset.precio;
                        }
                    }

                    // ===== CERRAR =====
                    document.addEventListener("click", function(e) {
                        if (!container.contains(e.target)) {
                            list.style.display = "none";
                        }
                    });

                });

            });
        </script>

        <script>
            // Script para el Entretela
            document.querySelectorAll('select[name="id_entretela"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_entretela"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para Entretela2
            document.querySelectorAll('select[name="id_entretela2"]').forEach(function(select) {

                select.addEventListener('change', function() {

                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual
                    var modal = this.closest('.modal');

                    // Buscar el input correspondiente dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_entretela2"]');

                    // Actualizar el precio
                    precioInput.value = precio;
                });

            });
            //
            // Script para el Cuello
            document.querySelectorAll('select[name="id_cuello"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cuello"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para Deslizador
            document.querySelectorAll('select[name="id_deslizador"]').forEach(function(select) {
                select.addEventListener('change', function() {

                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener modal actual
                    var modal = this.closest('.modal');

                    // Input del precio
                    var precioInput = modal.querySelector('input[name="precio_deslizador"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para Fajon Cintura
            document.querySelectorAll('select[name="id_fajon_cintura"]').forEach(function(select) {
                select.addEventListener('change', function() {

                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener modal actual
                    var modal = this.closest('.modal');

                    // Input del precio
                    var precioInput = modal.querySelector('input[name="precio_fajon_cintura"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para Hiladilla
            document.querySelectorAll('select[name="id_hiladilla"]').forEach(function(select) {
                select.addEventListener('change', function() {

                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener modal actual
                    var modal = this.closest('.modal');

                    // Input del precio
                    var precioInput = modal.querySelector('input[name="precio_hiladilla"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Puño
            document.querySelectorAll('select[name="id_puño"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_puño"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Scripts para Insumos
            const insumos = ['velcro', 'hombrera', 'sesgo', 'trabilla', 'vivo', 'guata', 'pretina', 'broche', 'cordon', 'puntera', 'plumilla', 'vinilo'];

            insumos.forEach(function(insumo) {
                document.querySelectorAll('select[name="id_' + insumo + '"]').forEach(function(select) {
                    select.addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var precio = selectedOption.getAttribute('data-precio');

                        // Obtener el modal actual en el que está el select
                        var modal = this.closest('.modal');

                        // Encontrar el input correspondiente dentro del modal
                        var precioInput = modal.querySelector('input[name="precio_' + insumo + '"]');

                        // Actualizar precio
                        if (precioInput) {
                            precioInput.value = precio;
                        }
                    });
                });
            });
            //
            // Script para el Boton
            document.querySelectorAll('select[name="id_boton"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_boton"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Boton2
            document.querySelectorAll('select[name="id_boton2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_boton2"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cremallera
            document.querySelectorAll('select[name="id_cremallera"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cremallera"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cremallera2
            document.querySelectorAll('select[name="id_cremallera2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cremallera2"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Resorte
            document.querySelectorAll('select[name="id_resorte"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_resorte"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Resorte2
            document.querySelectorAll('select[name="id_resorte2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_resorte2"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cinta
            document.querySelectorAll('select[name="id_cinta"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cinta"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Faya
            document.querySelectorAll('select[name="id_faya"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_faya"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
        </script>

        <script>
            // Recordar la posición del scroll: al enviar cualquier formulario de la página
            // se guarda dónde estabas, y al recargar se vuelve a ese mismo punto en vez de
            // saltar arriba del todo.
            document.addEventListener('submit', function(e) {
                sessionStorage.setItem('scrollPos_' + window.location.pathname, window.scrollY);
            }, true);

            window.addEventListener('load', function() {
                var key = 'scrollPos_' + window.location.pathname;
                var pos = sessionStorage.getItem(key);
                if (pos !== null) {
                    setTimeout(function() {
                        window.scrollTo(0, parseInt(pos, 10));
                        sessionStorage.removeItem(key);
                    }, 50);
                }
            });
        </script>
    </body>
</html>