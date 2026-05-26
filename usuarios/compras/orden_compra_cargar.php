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

    if (isset($_POST['submit_enviar'])) {
        $id_producto = obtenerValorPost('id_producto');
        date_default_timezone_set('America/Bogota');
        $fecha_produccion = date('Y-m-d H:i:s');

        $consulta = "UPDATE producto SET fecha_produccion = '$fecha_produccion', estado = 'Produccion' WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: orden_compra.php");
        exit();
    }

    if (isset($_POST['homologar_tela'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_tela = obtenerValorPost('id_tela');
        $precio_tela = obtenerValorPost('precio_tela');
        $promedio_consumo = obtenerValorPost('promedio_consumo');

        $valor_tela2 = floatval($precio_tela) * floatval($promedio_consumo);
        $consumo_tela2 = $suma_prendas * $promedio_consumo;
        $precio_telacompra2 = $suma_prendas * $valor_tela2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_tela2 = '$id_tela', precio_tela2 = '$precio_tela', promedio_consumo2 = '$promedio_consumo', valor_tela2 = '$valor_tela2', consumo_tela2 = '$consumo_tela2', precio_telacompra2 = '$precio_telacompra2' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_tela2, precio_tela2, promedio_consumo2, valor_tela2, consumo_tela2, precio_telacompra2)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_tela', '$precio_tela', '$promedio_consumo', '$valor_tela2', '$consumo_tela2', '$precio_telacompra2')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_telacombi'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_telacombi = obtenerValorPost('id_telacombi');
        $precio_telacombinada = obtenerValorPost('precio_telacombinada');
        $promedio_telacombi = obtenerValorPost('promedio_telacombi');

        $valor_telacombi2 = floatval($precio_telacombinada) * floatval($promedio_telacombi);
        $consumo_totaltelacombi2 = $suma_prendas * $promedio_telacombi;
        $precio_telacombi2compra = $suma_prendas * $valor_telacombi2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_telacombi2 = '$id_telacombi', precio_telacombi2 = '$precio_telacombinada', promedio_telacombi2 = '$promedio_telacombi', valor_telacombi2 = '$valor_telacombi2', consumo_totaltelacombi2 = '$consumo_totaltelacombi2', precio_telacombi2compra = '$precio_telacombi2compra' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_telacombi2, precio_telacombi2, promedio_telacombi2, valor_telacombi2, consumo_totaltelacombi2, precio_telacombi2compra)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_telacombi', '$precio_telacombinada', '$promedio_telacombi', '$valor_telacombi2', '$consumo_totaltelacombi2', '$precio_telacombi2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_telaforro'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_telaforro = obtenerValorPost('id_telaforro');
        $precio_forro = obtenerValorPost('precio_forro');
        $promedio_forro = obtenerValorPost('promedio_forro');

        $valor_telaforro2 = floatval($precio_forro) * floatval($promedio_forro);
        $consumo_totaltelaforro2 = $suma_prendas * $promedio_forro;
        $precio_telaforro2compra = $suma_prendas * $valor_telaforro2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_telaforro2 = '$id_telaforro', precio_telaforro2 = '$precio_forro', promedio_forro2 = '$promedio_forro', valor_telaforro2 = '$valor_telaforro2', consumo_totaltelaforro2 = '$consumo_totaltelaforro2', precio_telaforro2compra = '$precio_telaforro2compra' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_telaforro2, precio_telaforro2, promedio_forro2, valor_telaforro2, consumo_totaltelaforro2, precio_telaforro2compra)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_telaforro', '$precio_forro', '$promedio_forro', '$valor_telaforro2', '$consumo_totaltelaforro2', '$precio_telaforro2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_entretela'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_entretela = obtenerValorPost('id_entretela');
        $precio_entretela = obtenerValorPost('precio_entretela');
        $cant_entretela = obtenerValorPost('cant_entretela');

        $valor_entretela22 = floatval($precio_entretela) * floatval($cant_entretela);
        $consumo_totalentretela22 = $suma_prendas * $cant_entretela;
        $precio_entretela22compra = $suma_prendas * $valor_entretela22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_entretela22 = '$id_entretela', precio_entretela22 = '$precio_entretela', 
            cant_entretela22 = '$cant_entretela', valor_entretela22 = '$valor_entretela22', consumo_totalentretela22 = '$consumo_totalentretela22', precio_entretela22compra = '$precio_entretela22compra'
        WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_entretela22, precio_entretela22, cant_entretela22, valor_entretela22, consumo_totalentretela22, precio_entretela22compra)
        VALUES ('$id_producto', '$id_ordencompra', '$id_entretela', '$precio_entretela', '$cant_entretela', '$valor_entretela22', '$consumo_totalentretela22', '$precio_entretela22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_entretela2'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_entretela2 = obtenerValorPost('id_entretela2');
        $precio_entretela2 = obtenerValorPost('precio_entretela2');
        $cant_entretela2 = obtenerValorPost('cant_entretela2');

        $valor_entretela222 = floatval($precio_entretela2) * floatval($cant_entretela2);
        $consumo_totalentretela222 = $suma_prendas * $cant_entretela2;
        $precio_entretela222compra = $suma_prendas * $valor_entretela222;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_entretela222 = '$id_entretela2', precio_entretela222 = '$precio_entretela2', 
            cant_entretela222 = '$cant_entretela2', valor_entretela222 = '$valor_entretela222', consumo_totalentretela222 = '$consumo_totalentretela222', precio_entretela222compra = '$precio_entretela222compra'
        WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_entretela222, precio_entretela222, cant_entretela222, valor_entretela222, consumo_totalentretela222, precio_entretela222compra)
        VALUES ('$id_producto', '$id_ordencompra', '$id_entretela2', '$precio_entretela2', '$cant_entretela2', '$valor_entretela222', '$consumo_totalentretela222', '$precio_entretela222compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_insumos'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');

        // Consultar si ya existe en producto2
        $consulta_existente = "SELECT * FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_existente = mysqli_query($enlace, $consulta_existente);
        $datos_actuales = ($resultado_existente && mysqli_num_rows($resultado_existente) > 0)
            ? mysqli_fetch_assoc($resultado_existente)
            : [];

        // Lista de insumos y si usan 'consumo' (true) o 'cant' (false)
        $insumos = [
            'cuello' => true,
            'puño' => true,
            'velcro' => false,
            'hombrera' => false,
            'sesgo' => false,
            'trabilla' => false,
            'vivo' => false,
            'guata' => false,
            'pretina' => false,
            'broche' => false,
            'cordon' => false,
            'puntera' => false,
            'plumilla' => false,
            'vinilo' => false,
            'deslizador' => false,
            'fajon_cintura' => false,
            'hiladilla' => false
        ];

        $campos_sql = [];

        foreach ($insumos as $insumo => $usaConsumo) {
            $id_key = "id_$insumo";
            $precio_key = "precio_$insumo";
            $consumo_key = $usaConsumo ? "consumo_$insumo" : "cant_$insumo";

            if (isset($_POST[$id_key])) {
                // Obtener valores
                $id = obtenerValorPost($id_key, $datos_actuales["{$id_key}2"] ?? null);
                $precio = obtenerValorPost($precio_key, $datos_actuales["{$precio_key}2"] ?? 0);
                $consumo = obtenerValorPost($consumo_key, $datos_actuales["{$consumo_key}2"] ?? 0);

                $valor = $precio * $consumo;
                $consumo_total = $suma_prendas * $consumo;
                $precio_compra = $suma_prendas * $valor;

                // Armar columnas SQL dinámicamente
                $campos_sql[] = "id_{$insumo}2 = '$id'";
                $campos_sql[] = "{$precio_key}2 = '$precio'";
                $campos_sql[] = "{$consumo_key}2 = '$consumo'";
                $campos_sql[] = "valor_{$insumo}2 = '$valor'";
                $campos_sql[] = "consumo_total{$insumo}2 = '$consumo_total'";
                $campos_sql[] = "precio_{$insumo}2compra = '$precio_compra'";

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

    if (isset($_POST['homologar_boton'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_boton = obtenerValorPost('id_boton');
        $precio_boton = obtenerValorPost('precio_boton');
        $cant_boton = obtenerValorPost('cant_boton');

        $valor_boton22 = floatval($precio_boton) * floatval($cant_boton);
        $consumo_totalboton22 = $suma_prendas * $cant_boton;
        $precio_boton22compra = $suma_prendas * $valor_boton22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_boton22 = '$id_boton', precio_boton22 = '$precio_boton', cant_boton22 = '$cant_boton', valor_boton22 = '$valor_boton22', consumo_totalboton22 = '$consumo_totalboton22', precio_boton22compra = '$precio_boton22compra' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_boton22, precio_boton22, cant_boton22, valor_boton22, consumo_totalboton22, precio_boton22compra)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_boton', '$precio_boton', '$cant_boton', '$valor_boton22', '$consumo_totalboton22', '$precio_boton22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_boton2'])) {


        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_boton2 = obtenerValorPost('id_boton2');
        $precio_boton2 = obtenerValorPost('precio_boton2');
        $cant_boton2 = obtenerValorPost('cant_boton2');

        $valor_boton222 = floatval($precio_boton2) * floatval($cant_boton2);
        $consumo_totalboton222 = $suma_prendas * $cant_boton2;
        $precio_boton222compra = $suma_prendas * $valor_boton222;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_boton222 = '$id_boton2', precio_boton222 = '$precio_boton2', cant_boton222 = '$cant_boton2', valor_boton222 = '$valor_boton222', consumo_totalboton222 = '$consumo_totalboton222', precio_boton222compra = '$precio_boton222compra'
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_boton222, precio_boton222, cant_boton222, valor_boton222, consumo_totalboton222, precio_boton222compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_boton2', '$precio_boton2', '$cant_boton2', '$valor_boton222', '$consumo_totalboton222', '$precio_boton222compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_cremallera'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_cremallera = obtenerValorPost('id_cremallera');
        $precio_cremallera = obtenerValorPost('precio_cremallera');
        $cant_cremallera = obtenerValorPost('cant_cremallera');

        $valor_cremallera22 = floatval($precio_cremallera) * floatval($cant_cremallera);
        $consumo_totalcremallera22 = $suma_prendas * $cant_cremallera;
        $precio_cremallera22compra = $suma_prendas * $valor_cremallera22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_cremallera22 = '$id_cremallera', precio_cremallera22 = '$precio_cremallera', cant_cremallera22 = '$cant_cremallera', valor_cremallera22 = '$valor_cremallera22', consumo_totalcremallera22 = '$consumo_totalcremallera22', precio_cremallera22compra = '$precio_cremallera22compra' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_cremallera22, precio_cremallera22, cant_cremallera22, valor_cremallera22, consumo_totalcremallera22, precio_cremallera22compra)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_cremallera', '$precio_cremallera', '$cant_cremallera', '$valor_cremallera22', '$consumo_totalcremallera22', '$precio_cremallera22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_cremallera2'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_cremallera2 = obtenerValorPost('id_cremallera2');
        $precio_cremallera2 = obtenerValorPost('precio_cremallera2');
        $cant_cremallera2 = obtenerValorPost('cant_cremallera2');

        $valor_cremallera222 = floatval($precio_cremallera2) * floatval($cant_cremallera2);
        $consumo_totalcremallera222 = $suma_prendas * $cant_cremallera2;
        $precio_cremallera222compra = $suma_prendas * $valor_cremallera222;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_cremallera222 = '$id_cremallera2', precio_cremallera222 = '$precio_cremallera2', cant_cremallera222 = '$cant_cremallera2', valor_cremallera222 = '$valor_cremallera222', consumo_totalcremallera222 = '$consumo_totalcremallera222', precio_cremallera222compra = '$precio_cremallera222compra'
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_cremallera222, precio_cremallera222, cant_cremallera222, valor_cremallera222, consumo_totalcremallera222, precio_cremallera222compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_cremallera2', '$precio_cremallera2', '$cant_cremallera2', '$valor_cremallera222', '$consumo_totalcremallera222', '$precio_cremallera222compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }
    
    if (isset($_POST['homologar_resorte'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_resorte = obtenerValorPost('id_resorte');
        $precio_resorte = obtenerValorPost('precio_resorte');
        $cant_resorte = obtenerValorPost('cant_resorte');

        $valor_resorte22 = floatval($precio_resorte) * floatval($cant_resorte);
        $consumo_totalresorte22 = $suma_prendas * $cant_resorte;
        $precio_resorte22compra = $suma_prendas * $valor_resorte22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_resorte22 = '$id_resorte', precio_resorte22 = '$precio_resorte', cant_resorte22 = '$cant_resorte', valor_resorte22 = '$valor_resorte22', consumo_totalresorte22 = '$consumo_totalresorte22', 
                                    precio_resorte22compra = '$precio_resorte22compra' 
                                WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_resorte22, precio_resorte22, cant_resorte22, valor_resorte22, consumo_totalresorte22, precio_resorte22compra)
                                VALUES ('$id_producto', '$id_ordencompra', '$id_resorte', '$precio_resorte', '$cant_resorte', '$valor_resorte22', '$consumo_totalresorte22', '$precio_resorte22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_resorte2'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_resorte2 = obtenerValorPost('id_resorte2');
        $precio_resorte2 = obtenerValorPost('precio_resorte2');
        $cant_resorte2 = obtenerValorPost('cant_resorte2');

        $valor_resorte222 = floatval($precio_resorte2) * floatval($cant_resorte2);
        $consumo_totalresorte222 = $suma_prendas * $cant_resorte2;
        $precio_resorte222compra = $suma_prendas * $valor_resorte222;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_resorte222 = '$id_resorte2', precio_resorte222 = '$precio_resorte2', cant_resorte222 = '$cant_resorte2', valor_resorte222 = '$valor_resorte222', consumo_totalresorte222 = '$consumo_totalresorte222', precio_resorte222compra = '$precio_resorte222compra'
                                WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_resorte222, precio_resorte222, cant_resorte222, valor_resorte222, consumo_totalresorte222, precio_resorte222compra)
                                VALUES ('$id_producto', '$id_ordencompra', '$id_resorte2', '$precio_resorte2', '$cant_resorte2', '$valor_resorte222', '$consumo_totalresorte222', '$precio_resorte222compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_cinta'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_cinta = obtenerValorPost('id_cinta');
        $precio_cinta = obtenerValorPost('precio_cinta');
        $cant_cinta = obtenerValorPost('cant_cinta');

        $valor_cinta2 = floatval($precio_cinta) * floatval($cant_cinta);
        $consumo_totalcinta2 = $suma_prendas * $cant_cinta;
        $precio_cinta2compra = $suma_prendas * $valor_cinta2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_cinta2 = '$id_cinta', precio_cinta2 = '$precio_cinta', cant_cinta2 = '$cant_cinta', valor_cinta2 = '$valor_cinta2', consumo_totalcinta2 = '$consumo_totalcinta2', precio_cinta2compra = '$precio_cinta2compra' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_cinta2, precio_cinta2, cant_cinta2, valor_cinta2, consumo_totalcinta2, precio_cinta2compra)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_cinta', '$precio_cinta', '$cant_cinta', '$valor_cinta2', '$consumo_totalcinta2', '$precio_cinta2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_faya'])) {

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_faya = obtenerValorPost('id_faya');
        $precio_faya = obtenerValorPost('precio_faya');
        $cant_faya = obtenerValorPost('cant_faya');

        $valor_faya2 = floatval($precio_faya) * floatval($cant_faya);
        $consumo_totalfaya2 = $suma_prendas * $cant_faya;
        $precio_faya2compra = $suma_prendas * $valor_faya2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_faya2 = '$id_faya', precio_faya2 = '$precio_faya', cant_faya2 = '$cant_faya', valor_faya2 = '$valor_faya2', consumo_totalfaya2 = '$consumo_totalfaya2', precio_faya2compra = '$precio_faya2compra' 
                                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_faya2, precio_faya2, cant_faya2, valor_faya2, consumo_totalfaya2, precio_faya2compra)
                                            VALUES ('$id_producto', '$id_ordencompra', '$id_faya', '$precio_faya', '$cant_faya', '$valor_faya2', '$consumo_totalfaya2', '$precio_faya2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cambiar_estado'])) {
        $consecutivo = $_POST['consecutivo'];
        $consulta = "UPDATE pedido SET consecutivo = '$consecutivo', estado = 'Confirmado' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_gerente.php?id_usuario=$id_usuario");
        exit();
    }

    if (isset($_POST['dif_telacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_tela = obtenerValorPost('valor_tela');
        $precio_telacompra = obtenerValorPost('precio_telacompra');
        $total_telacotizado = obtenerValorPost('total_telacotizado');
        $total_telacompra = obtenerValorPost('total_telacompra');
        $promedio_consumo = obtenerValorPost('promedio_consumo');
        $consumo_tela = obtenerValorPost('consumo_tela');
        $consumo_realund = obtenerValorPost('consumo_realund');
        $consumo_realtotal = obtenerValorPost('consumo_realtotal');

        $dif_und_tela = floatval($valor_tela) - floatval($total_telacotizado);
        $dif_total_tela = floatval($precio_telacompra) - floatval($total_telacompra);
        $dif_consumo_und = floatval($promedio_consumo) - floatval($consumo_realund);
        $dif_consumo_total = floatval($consumo_tela) - floatval($consumo_realtotal);

        $consulta = "UPDATE orden_compra SET total_telacotizado = '$total_telacotizado', total_telacompra = '$total_telacompra', consumo_realund = '$consumo_realund', consumo_realtotal = '$consumo_realtotal', 
                dif_und_tela = '$dif_und_tela', dif_total_tela = '$dif_total_tela', dif_consumo_und = '$dif_consumo_und', dif_consumo_total = '$dif_consumo_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telacom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_tela2 = obtenerValorPost('valor_tela2');
        $precio_telacompra2 = obtenerValorPost('precio_telacompra2');
        $total_telacotizado = obtenerValorPost('total_telacotizado');
        $total_telacompra = obtenerValorPost('total_telacompra');
        $promedio_consumo2 = obtenerValorPost('promedio_consumo2');
        $consumo_tela2 = obtenerValorPost('consumo_tela2');
        $consumo_realund = obtenerValorPost('consumo_realund');
        $consumo_realtotal = obtenerValorPost('consumo_realtotal');

        $dif_und_tela = floatval($valor_tela2) - floatval($total_telacotizado);
        $dif_total_tela = floatval($precio_telacompra2) - floatval($total_telacompra);
        $dif_consumo_und = floatval($promedio_consumo2) - floatval($consumo_realund);
        $dif_consumo_total = floatval($consumo_tela2) - floatval($consumo_realtotal);

        $consulta = "UPDATE orden_compra SET total_telacotizado = '$total_telacotizado', total_telacompra = '$total_telacompra', consumo_realund = '$consumo_realund', consumo_realtotal = '$consumo_realtotal',
                dif_und_tela = '$dif_und_tela', dif_total_tela = '$dif_total_tela', dif_consumo_und = '$dif_consumo_und', dif_consumo_total = '$dif_consumo_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    } 

    if (isset($_POST['cargar_orden_compratela'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compratela']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compratela']['name'];
            $orden_temporal = $_FILES['orden_compratela']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compratela = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telacombicom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_telacombi = obtenerValorPost('valor_telacombi');
        $precio_telacombicompra = obtenerValorPost('precio_telacombicompra');
        $total_telacombicotizado = obtenerValorPost('total_telacombicotizado');
        $total_telacombicompra = obtenerValorPost('total_telacombicompra');
        $promedio_telacombi = obtenerValorPost('promedio_telacombi');
        $consumo_telacombi = obtenerValorPost('consumo_telacombi');
        $consumo_combinadaund = obtenerValorPost('consumo_combinadaund');
        $consumo_combinadatotal = obtenerValorPost('consumo_combinadatotal');

        $dif_und_telacombi = floatval($valor_telacombi) - floatval($total_telacombicotizado);
        $dif_total_telacombi = floatval($precio_telacombicompra) - floatval($total_telacombicompra);
        $dif_consumocombi_und = floatval($promedio_telacombi) - floatval($consumo_combinadaund);
        $dif_consumocombi_total = floatval($consumo_telacombi) - floatval($consumo_combinadatotal);

        $consulta = "UPDATE orden_compra SET total_telacombicotizado = '$total_telacombicotizado', total_telacombicompra = '$total_telacombicompra', consumo_combinadaund = '$consumo_combinadaund', consumo_combinadatotal = '$consumo_combinadatotal',
                dif_und_telacombi = '$dif_und_telacombi', dif_total_telacombi = '$dif_total_telacombi', dif_consumocombi_und = '$dif_consumocombi_und', dif_consumocombi_total = '$dif_consumocombi_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telacombicom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_telacombi2 = obtenerValorPost('valor_telacombi2');
        $precio_telacombi2compra = obtenerValorPost('precio_telacombi2compra');
        $total_telacombicotizado = obtenerValorPost('total_telacombicotizado');
        $total_telacombicompra = obtenerValorPost('total_telacombicompra');
        $promedio_telacombi2 = obtenerValorPost('promedio_telacombi2');
        $consumo_totaltelacombi2 = obtenerValorPost('consumo_totaltelacombi2');
        $consumo_combinadaund = obtenerValorPost('consumo_combinadaund');
        $consumo_combinadatotal = obtenerValorPost('consumo_combinadatotal');

        $dif_und_telacombi = floatval($valor_telacombi2) - floatval($total_telacombicotizado);
        $dif_total_telacombi = floatval($precio_telacombi2compra) - floatval($total_telacombicompra);
        $dif_consumocombi_und = floatval($promedio_telacombi2) - floatval($consumo_combinadaund);
        $dif_consumocombi_total = floatval($consumo_totaltelacombi2) - floatval($consumo_combinadatotal);

        $consulta = "UPDATE orden_compra SET total_telacombicotizado = '$total_telacombicotizado', total_telacombicompra = '$total_telacombicompra', consumo_combinadaund = '$consumo_combinadaund', consumo_combinadatotal = '$consumo_combinadatotal',
                dif_und_telacombi = '$dif_und_telacombi', dif_total_telacombi = '$dif_total_telacombi', dif_consumocombi_und = '$dif_consumocombi_und', dif_consumocombi_total = '$dif_consumocombi_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compratelacombi'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compratelacombi']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compratelacombi']['name'];
            $orden_temporal = $_FILES['orden_compratelacombi']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compratelacombi = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telaforrocom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_telaforro = obtenerValorPost('valor_telaforro');
        $precio_telaforrocompra = obtenerValorPost('precio_telaforrocompra');
        $total_telaforrocotizado = obtenerValorPost('total_telaforrocotizado');
        $total_telaforrocompra = obtenerValorPost('total_telaforrocompra');
        $promedio_forro = obtenerValorPost('promedio_forro');
        $consumo_telaforro = obtenerValorPost('consumo_telaforro');
        $consumo_forround = obtenerValorPost('consumo_forround');
        $consumo_forrototal = obtenerValorPost('consumo_forrototal');

        $dif_und_telaforro = floatval($valor_telaforro) - floatval($total_telaforrocotizado);
        $dif_total_telaforro = floatval($precio_telaforrocompra) - floatval($total_telaforrocompra);
        $dif_consumoforro_und = floatval($promedio_forro) - floatval($consumo_forround);
        $dif_consumoforro_total = floatval($consumo_telaforro) - floatval($consumo_forrototal);

        $consulta = "UPDATE orden_compra SET total_telaforrocotizado = '$total_telaforrocotizado', total_telaforrocompra = '$total_telaforrocompra', consumo_forround = '$consumo_forround', consumo_forrototal = '$consumo_forrototal',
                dif_und_telaforro = '$dif_und_telaforro', dif_total_telaforro = '$dif_total_telaforro', dif_consumoforro_und = '$dif_consumoforro_und', dif_consumoforro_total = '$dif_consumoforro_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telaforrocom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_telaforro2 = obtenerValorPost('valor_telaforro2');
        $precio_telaforrocompra2 = obtenerValorPost('precio_telaforrocompra2');
        $total_telaforrocotizado = obtenerValorPost('total_telaforrocotizado');
        $total_telaforrocompra = obtenerValorPost('total_telaforrocompra');
        $promedio_telaforro2 = obtenerValorPost('promedio_telaforro2');
        $consumo_totaltelaforro2 = obtenerValorPost('consumo_totaltelaforro2');
        $consumo_forround = obtenerValorPost('consumo_forround');
        $consumo_forrototal = obtenerValorPost('consumo_forrototal');

        $dif_und_telaforro = floatval($valor_telaforro2) - floatval($total_telaforrocotizado);
        $dif_total_telaforro = floatval($precio_telaforrocompra2) - floatval($total_telaforrocompra);
        $dif_consumoforro_und = floatval($promedio_telaforro2) - floatval($consumo_forround);
        $dif_consumoforro_total = floatval($consumo_totaltelaforro2) - floatval($consumo_forrototal);

        $consulta = "UPDATE orden_compra SET total_telaforrocotizado = '$total_telaforrocotizado', total_telaforrocompra = '$total_telaforrocompra', consumo_forround = '$consumo_forround', consumo_forrototal = '$consumo_forrototal',
                dif_und_telaforro = '$dif_und_telaforro', dif_total_telaforro = '$dif_total_telaforro', dif_consumoforro_und = '$dif_consumoforro_und', dif_consumoforro_total = '$dif_consumoforro_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compratelaforro'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compratelaforro']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compratelaforro']['name'];
            $orden_temporal = $_FILES['orden_compratelaforro']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compratelaforro = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_entretelacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_entretela = obtenerValorPost('valor_entretela');
        $precio_entretelacompra = obtenerValorPost('precio_entretelacompra');
        $total_entretelacotizado = obtenerValorPost('total_entretelacotizado');
        $total_entretelacompra = obtenerValorPost('total_entretelacompra');
        $cant_entretela = obtenerValorPost('cant_entretela');
        $consumo_totalentretela = obtenerValorPost('consumo_totalentretela');
        $consumo_entretelaund = obtenerValorPost('consumo_entretelaund');
        $consumo_entretelatotal = obtenerValorPost('consumo_entretelatotal');

        $dif_und_entretela = floatval($valor_entretela) - floatval($total_entretelacotizado);
        $dif_total_entretela = floatval($precio_entretelacompra) - floatval($total_entretelacompra);
        $dif_consentretela_und = floatval($cant_entretela) - floatval($consumo_entretelaund);
        $dif_consentretela_total = floatval($consumo_totalentretela) - floatval($consumo_entretelatotal);

        $consulta = "UPDATE orden_compra SET total_entretelacotizado = '$total_entretelacotizado', total_entretelacompra = '$total_entretelacompra', consumo_entretelaund = '$consumo_entretelaund', consumo_entretelatotal = '$consumo_entretelatotal',
                dif_und_entretela = '$dif_und_entretela', dif_total_entretela = '$dif_total_entretela', dif_consentretela_und = '$dif_consentretela_und', dif_consentretela_total = '$dif_consentretela_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_entretelacom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_entretela22 = obtenerValorPost('valor_entretela22');
        $precio_entretela22compra = obtenerValorPost('precio_entretela22compra');
        $total_entretelacotizado = obtenerValorPost('total_entretelacotizado');
        $total_entretelacompra = obtenerValorPost('total_entretelacompra');
        $cant_entretela22 = obtenerValorPost('cant_entretela22');
        $consumo_totalentretela22 = obtenerValorPost('consumo_totalentretela22');
        $consumo_entretelaund = obtenerValorPost('consumo_entretelaund');
        $consumo_entretelatotal = obtenerValorPost('consumo_entretelatotal');

        $dif_und_entretela = floatval($valor_entretela22) - floatval($total_entretelacotizado);
        $dif_total_entretela = floatval($precio_entretela22compra) - floatval($total_entretelacompra);
        $dif_consentretela_und = floatval($cant_entretela22) - floatval($consumo_entretelaund);
        $dif_consentretela_total = floatval($consumo_totalentretela22) - floatval($consumo_entretelatotal);

        $consulta = "UPDATE orden_compra SET total_entretelacotizado = '$total_entretelacotizado', total_entretelacompra = '$total_entretelacompra', consumo_entretelaund = '$consumo_entretelaund', consumo_entretelatotal = '$consumo_entretelatotal',
                dif_und_entretela = '$dif_und_entretela', dif_total_entretela = '$dif_total_entretela', dif_consentretela_und = '$dif_consentretela_und', dif_consentretela_total = '$dif_consentretela_total' 
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraentretela'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraentretela']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compraentretela']['name'];
            $orden_temporal = $_FILES['orden_compraentretela']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraentretela = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_entretelacom22'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_entretela2 = obtenerValorPost('valor_entretela2');
        $precio_entretela2compra = obtenerValorPost('precio_entretela2compra');
        $total_entretela2cotizado = obtenerValorPost('total_entretela2cotizado');
        $total_entretela2compra = obtenerValorPost('total_entretela2compra');
        $cant_entretela2 = obtenerValorPost('cant_entretela2');
        $consumo_totalentretela2 = obtenerValorPost('consumo_totalentretela2');
        $consumo_entretela2und = obtenerValorPost('consumo_entretela2und');
        $consumo_entretela2total = obtenerValorPost('consumo_entretela2total');

        $dif_und_entretela2 = floatval($valor_entretela2) - floatval($total_entretela2cotizado);
        $dif_total_entretela2 = floatval($precio_entretela2compra) - floatval($total_entretela2compra);
        $dif_consentretela2_und = floatval($cant_entretela2) - floatval($consumo_entretela2und);
        $dif_consentretela2_total = floatval($consumo_totalentretela2) - floatval($consumo_entretela2total);

        $consulta = "UPDATE orden_compra SET total_entretela2cotizado = '$total_entretela2cotizado', total_entretela2compra = '$total_entretela2compra', consumo_entretela2und = '$consumo_entretela2und', consumo_entretela2total = '$consumo_entretela2total',
                dif_und_entretela2 = '$dif_und_entretela2', dif_total_entretela2 = '$dif_total_entretela2', dif_consentretela2_und = '$dif_consentretela2_und', dif_consentretela2_total = '$dif_consentretela2_total'
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_entretelacom222'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_entretela222 = obtenerValorPost('valor_entretela222');
        $precio_entretela222compra = obtenerValorPost('precio_entretela222compra');
        $total_entretela2cotizado = obtenerValorPost('total_entretela2cotizado');
        $total_entretela2compra = obtenerValorPost('total_entretela2compra');
        $cant_entretela222 = obtenerValorPost('cant_entretela222');
        $consumo_totalentretela222 = obtenerValorPost('consumo_totalentretela222');
        $consumo_entretela2und = obtenerValorPost('consumo_entretela2und');
        $consumo_entretela2total = obtenerValorPost('consumo_entretela2total');

        $dif_und_entretela2 = floatval($valor_entretela222) - floatval($total_entretela2cotizado);
        $dif_total_entretela2 = floatval($precio_entretela222compra) - floatval($total_entretela2compra);
        $dif_consentretela2_und = floatval($cant_entretela222) - floatval($consumo_entretela2und);
        $dif_consentretela2_total = floatval($consumo_totalentretela222) - floatval($consumo_entretela2total);

        $consulta = "UPDATE orden_compra SET total_entretela2cotizado = '$total_entretela2cotizado', total_entretela2compra = '$total_entretela2compra', consumo_entretela2und = '$consumo_entretela2und', consumo_entretela2total = '$consumo_entretela2total',
                dif_und_entretela2 = '$dif_und_entretela2', dif_total_entretela2 = '$dif_total_entretela2', dif_consentretela2_und = '$dif_consentretela2_und', dif_consentretela2_total = '$dif_consentretela2_total' 
                WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraentretela2'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraentretela2']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compraentretela2']['name'];
            $orden_temporal = $_FILES['orden_compraentretela2']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraentretela2 = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_botoncom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_boton = obtenerValorPost('precio_boton');
        $precio_botoncompra = obtenerValorPost('precio_botoncompra');
        $total_botoncotizado = obtenerValorPost('total_botoncotizado');
        $total_botoncompra = obtenerValorPost('total_botoncompra');

        $dif_und_boton = floatval($precio_boton) - floatval($total_botoncotizado);
        $dif_total_boton = floatval($precio_botoncompra) - floatval($total_botoncompra);

        $consulta = "UPDATE orden_compra SET total_botoncotizado = '$total_botoncotizado', total_botoncompra = '$total_botoncompra', 
                dif_und_boton = '$dif_und_boton', dif_total_boton = '$dif_total_boton' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_botoncom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_boton22 = obtenerValorPost('precio_boton22');
        $precio_boton22compra = obtenerValorPost('precio_boton22compra');
        $total_botoncotizado = obtenerValorPost('total_botoncotizado');
        $total_botoncompra = obtenerValorPost('total_botoncompra');

        // Cálculos
        $dif_und_boton = floatval($precio_boton22) - floatval($total_botoncotizado);
        $dif_total_boton = floatval($precio_boton22compra) - floatval($total_botoncompra);

        // Actualización SQL
        $consulta = "UPDATE orden_compra SET total_botoncotizado = '$total_botoncotizado', total_botoncompra = '$total_botoncompra', dif_und_boton = '$dif_und_boton', dif_total_boton = '$dif_total_boton' 
                            WHERE id_ordencompra = '$id_ordencompra'";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraboton'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraboton']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compraboton']['name'];
            $orden_temporal = $_FILES['orden_compraboton']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraboton = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_botoncom22'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_boton2 = obtenerValorPost('precio_boton2');
        $precio_boton2compra = obtenerValorPost('precio_boton2compra');
        $total_boton2cotizado = obtenerValorPost('total_boton2cotizado');
        $total_boton2compra = obtenerValorPost('total_boton2compra');

        $dif_und_boton2 = floatval($precio_boton2) - floatval($total_boton2cotizado);
        $dif_total_boton2 = floatval($precio_boton2compra) - floatval($total_boton2compra);

        $consulta = "UPDATE orden_compra SET total_boton2cotizado = '$total_boton2cotizado', total_boton2compra = '$total_boton2compra', 
                        dif_und_boton2 = '$dif_und_boton2', dif_total_boton2 = '$dif_total_boton2' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_botoncom222'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_boton222 = obtenerValorPost('precio_boton222');
        $precio_boton222compra = obtenerValorPost('precio_boton222compra');
        $total_boton2cotizado = obtenerValorPost('total_boton2cotizado');
        $total_boton2compra = obtenerValorPost('total_boton2compra');

        $dif_und_boton2 = floatval($precio_boton222) - floatval($total_boton2cotizado);
        $dif_total_boton2 = floatval($precio_boton222compra) - floatval($total_boton2compra);

        $consulta = "UPDATE orden_compra SET total_boton2cotizado = '$total_boton2cotizado', total_boton2compra = '$total_boton2compra', 
                        dif_und_boton2 = '$dif_und_boton2', dif_total_boton2 = '$dif_total_boton2' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraboton2'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraboton2']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compraboton2']['name'];
            $orden_temporal = $_FILES['orden_compraboton2']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraboton2 = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_cremalleracom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_cremallera = obtenerValorPost('precio_cremallera');
        $precio_cremalleracompra = obtenerValorPost('precio_cremalleracompra');
        $total_cremalleracotizado = obtenerValorPost('total_cremalleracotizado');
        $total_cremalleracompra = obtenerValorPost('total_cremalleracompra');

        $dif_und_cremallera = floatval($precio_cremallera) - floatval($total_cremalleracotizado);
        $dif_total_cremallera = floatval($precio_cremalleracompra) - floatval($total_cremalleracompra);

        $consulta = "UPDATE orden_compra SET total_cremalleracotizado = '$total_cremalleracotizado', total_cremalleracompra = '$total_cremalleracompra', 
                dif_und_cremallera = '$dif_und_cremallera', dif_total_cremallera = '$dif_total_cremallera' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_cremalleracom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_cremallera22 = obtenerValorPost('precio_cremallera22');
        $precio_cremallera22compra = obtenerValorPost('precio_cremallera22compra');
        $total_cremalleracotizado = obtenerValorPost('total_cremalleracotizado');
        $total_cremalleracompra = obtenerValorPost('total_cremalleracompra');

        // Cálculos
        $dif_und_cremallera = floatval($precio_cremallera22) - floatval($total_cremalleracotizado);
        $dif_total_cremallera = floatval($precio_cremallera22compra) - floatval($total_cremalleracompra);

        // Actualización SQL
        $consulta = "UPDATE orden_compra SET total_cremalleracotizado = '$total_cremalleracotizado', total_cremalleracompra = '$total_cremalleracompra', dif_und_cremallera = '$dif_und_cremallera', dif_total_cremallera = '$dif_total_cremallera' 
                            WHERE id_ordencompra = '$id_ordencompra'";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compracremallera'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compracremallera']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compracremallera']['name'];
            $orden_temporal = $_FILES['orden_compracremallera']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compracremallera = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_cremalleracom22'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_cremallera2 = obtenerValorPost('precio_cremallera2');
        $precio_cremallera2compra = obtenerValorPost('precio_cremallera2compra');
        $total_cremallera2cotizado = obtenerValorPost('total_cremallera2cotizado');
        $total_cremallera2compra = obtenerValorPost('total_cremallera2compra');

        $dif_und_cremallera2 = floatval($precio_cremallera2) - floatval($total_cremallera2cotizado);
        $dif_total_cremallera2 = floatval($precio_cremallera2compra) - floatval($total_cremallera2compra);

        $consulta = "UPDATE orden_compra SET total_cremallera2cotizado = '$total_cremallera2cotizado', total_cremallera2compra = '$total_cremallera2compra', 
                        dif_und_cremallera2 = '$dif_und_cremallera2', dif_total_cremallera2 = '$dif_total_cremallera2' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_cremalleracom222'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_cremallera222 = obtenerValorPost('precio_cremallera222');
        $precio_cremallera222compra = obtenerValorPost('precio_cremallera222compra');
        $total_cremallera2cotizado = obtenerValorPost('total_cremallera2cotizado');
        $total_cremallera2compra = obtenerValorPost('total_cremallera2compra');

        $dif_und_cremallera2 = floatval($precio_cremallera222) - floatval($total_cremallera2cotizado);
        $dif_total_cremallera2 = floatval($precio_cremallera222compra) - floatval($total_cremallera2compra);

        $consulta = "UPDATE orden_compra SET total_cremallera2cotizado = '$total_cremallera2cotizado', total_cremallera2compra = '$total_cremallera2compra', 
                        dif_und_cremallera2 = '$dif_und_cremallera2', dif_total_cremallera2 = '$dif_total_cremallera2' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compracremallera2'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compracremallera2']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compracremallera2']['name'];
            $orden_temporal = $_FILES['orden_compracremallera2']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compracremallera2 = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_resortecom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_resorte = obtenerValorPost('precio_resorte');
        $precio_resortecompra = obtenerValorPost('precio_resortecompra');
        $total_resortecotizado = obtenerValorPost('total_resortecotizado');
        $total_resortecompra = obtenerValorPost('total_resortecompra');

        $dif_und_resorte = floatval($precio_resorte) - floatval($total_resortecotizado);
        $dif_total_resorte = floatval($precio_resortecompra) - floatval($total_resortecompra);

        $consulta = "UPDATE orden_compra 
                            SET total_resortecotizado = '$total_resortecotizado', 
                                total_resortecompra = '$total_resortecompra', 
                                dif_und_resorte = '$dif_und_resorte', 
                                dif_total_resorte = '$dif_total_resorte' 
                            WHERE id_ordencompra = '$id_ordencompra'";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_resortecom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_resorte22 = obtenerValorPost('precio_resorte22');
        $precio_resorte22compra = obtenerValorPost('precio_resorte22compra');
        $total_resortecotizado = obtenerValorPost('total_resortecotizado');
        $total_resortecompra = obtenerValorPost('total_resortecompra');

        // Cálculos
        $dif_und_resorte = floatval($precio_resorte22) - floatval($total_resortecotizado);
        $dif_total_resorte = floatval($precio_resorte22compra) - floatval($total_resortecompra);

        // Actualización SQL
        $consulta = "UPDATE orden_compra 
                            SET total_resortecotizado = '$total_resortecotizado', 
                                total_resortecompra = '$total_resortecompra', 
                                dif_und_resorte = '$dif_und_resorte', 
                                dif_total_resorte = '$dif_total_resorte' 
                            WHERE id_ordencompra = '$id_ordencompra'";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraresorte'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraresorte']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compraresorte']['name'];
            $orden_temporal = $_FILES['orden_compraresorte']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraresorte = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_resortecom22'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_resorte2 = obtenerValorPost('precio_resorte2');
        $precio_resorte2compra = obtenerValorPost('precio_resorte2compra');
        $total_resorte2cotizado = obtenerValorPost('total_resorte2cotizado');
        $total_resorte2compra = obtenerValorPost('total_resorte2compra');

        $dif_und_resorte2 = floatval($precio_resorte2) - floatval($total_resorte2cotizado);
        $dif_total_resorte2 = floatval($precio_resorte2compra) - floatval($total_resorte2compra);

        $consulta = "UPDATE orden_compra 
                            SET total_resorte2cotizado = '$total_resorte2cotizado', 
                                total_resorte2compra = '$total_resorte2compra', 
                                dif_und_resorte2 = '$dif_und_resorte2', 
                                dif_total_resorte2 = '$dif_total_resorte2' 
                            WHERE id_ordencompra = '$id_ordencompra'";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_resortecom222'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_resorte222 = obtenerValorPost('precio_resorte222');
        $precio_resorte222compra = obtenerValorPost('precio_resorte222compra');
        $total_resorte2cotizado = obtenerValorPost('total_resorte2cotizado');
        $total_resorte2compra = obtenerValorPost('total_resorte2compra');

        $dif_und_resorte2 = floatval($precio_resorte222) - floatval($total_resorte2cotizado);
        $dif_total_resorte2 = floatval($precio_resorte222compra) - floatval($total_resorte2compra);

        $consulta = "UPDATE orden_compra 
                            SET total_resorte2cotizado = '$total_resorte2cotizado', 
                                total_resorte2compra = '$total_resorte2compra', 
                                dif_und_resorte2 = '$dif_und_resorte2', 
                                dif_total_resorte2 = '$dif_total_resorte2' 
                            WHERE id_ordencompra = '$id_ordencompra'";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraresorte2'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraresorte2']['tmp_name'])) {
            $orden_nombre   = $_FILES['orden_compraresorte2']['name'];
            $orden_temporal = $_FILES['orden_compraresorte2']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraresorte2 = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_cintacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_cinta = obtenerValorPost('precio_cinta');
        $precio_cintacompra = obtenerValorPost('precio_cintacompra');
        $total_cintacotizado = obtenerValorPost('total_cintacotizado');
        $total_cintacompra = obtenerValorPost('total_cintacompra');

        $dif_und_cinta = floatval($precio_cinta) - floatval($total_cintacotizado);
        $dif_total_cinta = floatval($precio_cintacompra) - floatval($total_cintacompra);

        $consulta = "UPDATE orden_compra SET total_cintacotizado = '$total_cintacotizado', total_cintacompra = '$total_cintacompra', 
                dif_und_cinta = '$dif_und_cinta', dif_total_cinta = '$dif_total_cinta' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_cintacom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_cinta2 = obtenerValorPost('precio_cinta2');
        $precio_cinta2compra = obtenerValorPost('precio_cinta2compra');
        $total_cintacotizado = obtenerValorPost('total_cintacotizado');
        $total_cintacompra = obtenerValorPost('total_cintacompra');

        $dif_und_cinta = floatval($precio_cinta2) - floatval($total_cintacotizado);
        $dif_total_cinta = floatval($precio_cinta2compra) - floatval($total_cintacompra);

        $consulta = "UPDATE orden_compra SET total_cintacotizado = '$total_cintacotizado', total_cintacompra = '$total_cintacompra', 
                dif_und_cinta = '$dif_und_cinta', dif_total_cinta = '$dif_total_cinta' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compracinta'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compracinta']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compracinta']['name'];
            $orden_temporal = $_FILES['orden_compracinta']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compracinta = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_fayacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_faya = obtenerValorPost('precio_faya');
        $precio_fayacompra = obtenerValorPost('precio_fayacompra');
        $total_fayacotizado = obtenerValorPost('total_fayacotizado');
        $total_fayacompra = obtenerValorPost('total_fayacompra');

        $dif_und_faya = floatval($precio_faya) - floatval($total_fayacotizado);
        $dif_total_faya = floatval($precio_fayacompra) - floatval($total_fayacompra);

        $consulta = "UPDATE orden_compra SET total_fayacotizado = '$total_fayacotizado', total_fayacompra = '$total_fayacompra', 
                dif_und_faya = '$dif_und_faya', dif_total_faya = '$dif_total_faya' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_fayacom2'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_faya2 = obtenerValorPost('precio_faya2');
        $precio_faya2compra = obtenerValorPost('precio_faya2compra');
        $total_fayacotizado = obtenerValorPost('total_fayacotizado');
        $total_fayacompra = obtenerValorPost('total_fayacompra');

        $dif_und_faya = floatval($precio_faya2) - floatval($total_fayacotizado);
        $dif_total_faya = floatval($precio_faya2compra) - floatval($total_fayacompra);

        $consulta = "UPDATE orden_compra SET total_fayacotizado = '$total_fayacotizado', total_fayacompra = '$total_fayacompra', 
                dif_und_faya = '$dif_und_faya', dif_total_faya = '$dif_total_faya' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_comprafaya'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_comprafaya']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_comprafaya']['name'];
            $orden_temporal = $_FILES['orden_comprafaya']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_comprafaya = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_marquillacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_marquilla = obtenerValorPost('precio_marquilla');
        $precio_marquillacompra = obtenerValorPost('precio_marquillacompra');
        $total_marquillacotizado = obtenerValorPost('total_marquillacotizado');
        $total_marquillacompra = obtenerValorPost('total_marquillacompra');

        $dif_und_marquilla = floatval($precio_marquilla) - floatval($total_marquillacotizado);
        $dif_total_marquilla = floatval($precio_marquillacompra) - floatval($total_marquillacompra);

        $consulta = "UPDATE orden_compra SET total_marquillacotizado = '$total_marquillacotizado', total_marquillacompra = '$total_marquillacompra', 
                dif_und_marquilla = '$dif_und_marquilla', dif_total_marquilla = '$dif_total_marquilla' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compramarquilla'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compramarquilla']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compramarquilla']['name'];
            $orden_temporal = $_FILES['orden_compramarquilla']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compramarquilla = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_bolsacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_bolsa = obtenerValorPost('precio_bolsa');
        $precio_bolsacompra = obtenerValorPost('precio_bolsacompra');
        $total_bolsacotizado = obtenerValorPost('total_bolsacotizado');
        $total_bolsacompra = obtenerValorPost('total_bolsacompra');

        $dif_und_bolsa = floatval($precio_bolsa) - floatval($total_bolsacotizado);
        $dif_total_bolsa = floatval($precio_bolsacompra) - floatval($total_bolsacompra);

        $consulta = "UPDATE orden_compra SET total_bolsacotizado = '$total_bolsacotizado', total_bolsacompra = '$total_bolsacompra', 
                dif_und_bolsa = '$dif_und_bolsa', dif_total_bolsa = '$dif_total_bolsa' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_comprabolsa'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_comprabolsa']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_comprabolsa']['name'];
            $orden_temporal = $_FILES['orden_comprabolsa']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_comprabolsa = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_prendacom'])) {

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $precio_compra = obtenerValorPost('precio_compra');
        $precio_prendacompra = obtenerValorPost('precio_prendacompra');
        $total_prendacotizado = obtenerValorPost('total_prendacotizado');
        $total_prendacompra = obtenerValorPost('total_prendacompra');

        $dif_und_prenda = floatval($precio_compra) - floatval($total_prendacotizado);
        $dif_total_prenda = floatval($precio_prendacompra) - floatval($total_prendacompra);

        $consulta = "UPDATE orden_compra SET total_prendacotizado = '$total_prendacotizado', total_prendacompra = '$total_prendacompra', 
                dif_und_prenda = '$dif_und_prenda', dif_total_prenda = '$dif_total_prenda' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cargar_orden_compraprenda'])) {

        $id_producto = $_POST['id_producto'];

        if (!empty($_FILES['orden_compraprenda']['tmp_name'])) {
            $orden_nombre = $_FILES['orden_compraprenda']['name'];
            $orden_temporal = $_FILES['orden_compraprenda']['tmp_name'];

            move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);

            $consulta = "UPDATE orden_compra SET orden_compraprenda = '$orden_nombre' WHERE id_producto = $id_producto";
            mysqli_query($enlace, $consulta);
        }

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    // 🔹 Listado de insumos manejados
    $insumos = ['cuello', 'puño', 'velcro', 'hombrera', 'sesgo', 'trabilla', 'vivo', 'guata', 'pretina', 'broche', 'cordon', 'puntera', 'plumilla', 'vinilo', 'deslizador', 'fajon_cintura', 'hiladilla'];

    foreach ($insumos as $insumo) {

        if (isset($_POST["dif_{$insumo}com"])) {

            $id_ordencompra = obtenerValorPost('id_ordencompra');
            $precio         = obtenerValorPost("precio_{$insumo}");
            $precio_compra  = obtenerValorPost("precio_{$insumo}compra");
            $total_cotizado = obtenerValorPost("total_{$insumo}cotizado");
            $total_compra   = obtenerValorPost("total_{$insumo}compra");

            // Calcular diferencias
            $dif_und   = floatval($precio) - floatval($total_cotizado);
            $dif_total = floatval($precio_compra) - floatval($total_compra);

            // Armar y ejecutar SQL
            $consulta = "
                UPDATE orden_compra SET
                    total_{$insumo}cotizado = '$total_cotizado',
                    total_{$insumo}compra   = '$total_compra',
                    dif_und_{$insumo}       = '$dif_und',
                    dif_total_{$insumo}     = '$dif_total'
                WHERE id_ordencompra = '$id_ordencompra'
            ";

            mysqli_query($enlace, $consulta);

            header("Location: orden_compra_cargar.php?id_producto=$id_producto");
            exit();
        }

        if (isset($_POST["dif_{$insumo}com2"])) {

            $id_ordencompra = obtenerValorPost('id_ordencompra');
            $precio2         = obtenerValorPost("precio_{$insumo}2");
            $precio2_compra  = obtenerValorPost("precio_{$insumo}2compra");
            $total_cotizado  = obtenerValorPost("total_{$insumo}cotizado");
            $total_compra    = obtenerValorPost("total_{$insumo}compra");

            // Calcular diferencias
            $dif_und   = floatval($precio2) - floatval($total_cotizado);
            $dif_total = floatval($precio2_compra) - floatval($total_compra);

            // Armar y ejecutar SQL
            $consulta = "
                UPDATE orden_compra SET
                    total_{$insumo}cotizado = '$total_cotizado',
                    total_{$insumo}compra   = '$total_compra',
                    dif_und_{$insumo}       = '$dif_und',
                    dif_total_{$insumo}     = '$dif_total'
                WHERE id_ordencompra = '$id_ordencompra'
            ";

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

                $consulta = "UPDATE orden_compra SET orden_compra{$insumo} = '$orden_nombre' WHERE id_producto = $id_producto";
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
        
        <title>Compras | Ordenes de Compra</title>
    <head>

    <body>
        <?php
            $consulta = "SELECT 
            producto.id_producto, producto2.id_producto2, ficha_tecnica.id_producto, orden_compra.id_producto, orden_compra.id_ordencompra, ficha_tecnica.id_fichatecnica, ficha_tecnica.ficha_tecnica, prenda.id_prenda, prenda.nombre_prenda, 
            producto.nombre_producto, producto.suma_prendas, producto.nombre_proveedor, producto.num_ficha, producto.precio_compra,
            tela.id_tela, tela.tela, producto.precio_tela, producto.color_tela, producto.promedio_consumo, producto.valor_tela, producto2.id_tela2, orden_compra.consumo_realund, orden_compra.consumo_realtotal, orden_compra.consumo_tela, orden_compra.precio_telacompra, proveedor_tela.id_proveedor, proveedor_tela.nombre, orden_compra.dif_und_tela, orden_compra.dif_total_tela, orden_compra.dif_consumo_und, orden_compra.dif_consumo_total, orden_compra.total_telacotizado, orden_compra.total_telacompra,
            tela_combinada.id_telacombi, tela_combinada.tela_combi, producto.precio_telacombinada, producto.color_telacombi, producto.promedio_telacombi, producto.valor_telacombi, producto2.id_telacombi2, orden_compra.consumo_combinadaund, orden_compra.consumo_combinadatotal, orden_compra.consumo_telacombi, orden_compra.precio_telacombicompra, orden_compra.dif_und_telacombi, orden_compra.dif_total_telacombi, orden_compra.dif_consumocombi_und, orden_compra.dif_consumocombi_total, orden_compra.total_telacombicotizado, orden_compra.total_telacombicompra,
            tela_forro.id_telaforro, tela_forro.tela_forro, producto.precio_forro, producto.color_telaforro, producto.promedio_forro, producto.valor_forro, producto2.id_telaforro2, orden_compra.consumo_forround, orden_compra.consumo_forrototal, orden_compra.consumo_telaforro, orden_compra.precio_telaforrocompra, orden_compra.dif_und_telaforro, orden_compra.dif_total_telaforro, orden_compra.dif_consumoforro_und, orden_compra.dif_consumoforro_total, orden_compra.total_telaforrocotizado, orden_compra.total_telaforrocompra,
            entretela.id_entretela, entretela.insumo AS insumo_entretela, ficha_tecnica.color_entretela, producto.cant_entretela, producto.precio_entretela, producto.valor_entretela, producto2.id_entretela22,
            entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2, ficha_tecnica.color_entretela2, producto.cant_entretela2, producto.precio_entretela2, producto.valor_entretela2, producto2.id_entretela222,
            bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa,
            boton.id_boton, boton.insumo AS insumo_boton, producto.cant_boton, producto.precio_boton, producto.valor_boton, producto2.id_boton22,
            boton2.id_boton2, boton2.insumo AS insumo_boton2, producto.cant_boton2, producto.precio_boton2, producto.valor_boton2, producto2.id_boton222,
            broche.id_broche, broche.insumo AS insumo_broche, producto.cant_broche, producto.precio_broche, producto.valor_broche, producto2.id_broche2,
            cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, producto.cant_faya, producto.precio_faya, producto.valor_faya, producto2.id_faya2,
            cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, producto.cant_cinta, producto.precio_cinta, producto.valor_cinta, producto2.id_cinta2,
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
            orden_compra.consumo_totalentretela, orden_compra.precio_entretelacompra, orden_compra.total_entretelacotizado, orden_compra.total_entretelacompra, orden_compra.dif_und_entretela, orden_compra.dif_total_entretela, orden_compra.orden_compraentretela, orden_compra.consumo_entretelaund, orden_compra.consumo_entretelatotal, orden_compra.dif_consentretela_und, orden_compra.dif_consentretela_total,
            orden_compra.consumo_totalentretela2, orden_compra.precio_entretela2compra, orden_compra.total_entretela2cotizado, orden_compra.total_entretela2compra, orden_compra.dif_und_entretela2, orden_compra.dif_total_entretela2, orden_compra.orden_compraentretela2, orden_compra.consumo_entretela2und, orden_compra.consumo_entretela2total, orden_compra.dif_consentretela2_und, orden_compra.dif_consentretela2_total,
            orden_compra.total_bolsacotizado, orden_compra.total_bolsacompra, orden_compra.dif_und_bolsa, orden_compra.dif_total_bolsa, orden_compra.orden_comprabolsa,
            orden_compra.consumo_totalboton, orden_compra.precio_botoncompra, orden_compra.total_botoncotizado, orden_compra.total_botoncompra, orden_compra.dif_und_boton, orden_compra.dif_total_boton, orden_compra.orden_compraboton,
            orden_compra.consumo_totalboton2, orden_compra.precio_boton2compra, orden_compra.total_boton2cotizado, orden_compra.total_boton2compra, orden_compra.dif_und_boton2, orden_compra.dif_total_boton2, orden_compra.orden_compraboton2,
            orden_compra.consumo_totalbroche, orden_compra.precio_brochecompra, orden_compra.total_brochecotizado, orden_compra.total_brochecompra, orden_compra.dif_und_broche, orden_compra.dif_total_broche, orden_compra.orden_comprabroche,
            orden_compra.consumo_totalfaya, orden_compra.precio_fayacompra, orden_compra.total_fayacotizado, orden_compra.total_fayacompra, orden_compra.dif_und_faya, orden_compra.dif_total_faya, orden_compra.orden_comprafaya,
            orden_compra.consumo_totalcinta, orden_compra.precio_cintacompra, orden_compra.total_cintacotizado, orden_compra.total_cintacompra, orden_compra.dif_und_cinta, orden_compra.dif_total_cinta, orden_compra.orden_compracinta,
            orden_compra.consumo_totalcordon, orden_compra.precio_cordoncompra, orden_compra.total_cordoncotizado, orden_compra.total_cordoncompra, orden_compra.dif_und_cordon, orden_compra.dif_total_cordon, orden_compra.orden_compracordon,
            orden_compra.consumo_totalcremallera, orden_compra.precio_cremalleracompra, orden_compra.total_cremalleracotizado, orden_compra.total_cremalleracompra, orden_compra.dif_und_cremallera, orden_compra.dif_total_cremallera, orden_compra.orden_compracremallera,
            orden_compra.consumo_totalcremallera2, orden_compra.precio_cremallera2compra, orden_compra.total_cremallera2cotizado, orden_compra.total_cremallera2compra, orden_compra.dif_und_cremallera2, orden_compra.dif_total_cremallera2, orden_compra.orden_compracremallera2,
            orden_compra.consumo_totalcuello, orden_compra.precio_cuellocompra, orden_compra.total_cuellocotizado, orden_compra.total_cuellocompra, orden_compra.dif_und_cuello, orden_compra.dif_total_cuello, orden_compra.orden_compracuello,
            orden_compra.consumo_totaldeslizador, orden_compra.precio_deslizadorcompra, orden_compra.total_deslizadorcotizado, orden_compra.total_deslizadorcompra, orden_compra.dif_und_deslizador, orden_compra.dif_total_deslizador, orden_compra.orden_compradeslizador,
            orden_compra.consumo_totalfajon_cintura, orden_compra.precio_fajon_cinturacompra, orden_compra.total_fajon_cinturacotizado, orden_compra.total_fajon_cinturacompra, orden_compra.dif_und_fajon_cintura, orden_compra.dif_total_fajon_cintura, orden_compra.orden_comprafajon_cintura,
            orden_compra.consumo_totalguata, orden_compra.precio_guatacompra, orden_compra.total_guatacotizado, orden_compra.total_guatacompra, orden_compra.dif_und_guata, orden_compra.dif_total_guata, orden_compra.orden_compraguata,
            orden_compra.consumo_totalhiladilla, orden_compra.precio_hiladillacompra, orden_compra.total_hiladillacotizado, orden_compra.total_hiladillacompra, orden_compra.dif_und_hiladilla, orden_compra.dif_total_hiladilla, orden_compra.orden_comprahiladilla,
            orden_compra.consumo_totalhombrera, orden_compra.precio_hombreracompra, orden_compra.total_hombreracotizado, orden_compra.total_hombreracompra, orden_compra.dif_und_hombrera, orden_compra.dif_total_hombrera, orden_compra.orden_comprahombrera,
            orden_compra.total_marquillacotizado, orden_compra.total_marquillacompra, orden_compra.dif_und_marquilla, orden_compra.dif_total_marquilla, orden_compra.orden_compramarquilla,
            orden_compra.consumo_totalplumilla, orden_compra.precio_plumillacompra, orden_compra.total_plumillacotizado, orden_compra.total_plumillacompra, orden_compra.dif_und_plumilla, orden_compra.dif_total_plumilla, orden_compra.orden_compraplumilla,
            orden_compra.consumo_totalpretina, orden_compra.precio_pretinacompra, orden_compra.total_pretinacotizado, orden_compra.total_pretinacompra, orden_compra.dif_und_pretina, orden_compra.dif_total_pretina, orden_compra.orden_comprapretina,
            orden_compra.consumo_totalpuntera, orden_compra.precio_punteracompra, orden_compra.total_punteracotizado, orden_compra.total_punteracompra, orden_compra.dif_und_puntera, orden_compra.dif_total_puntera, orden_compra.orden_comprapuntera,
            orden_compra.consumo_totalpuño, orden_compra.precio_puñocompra, orden_compra.total_puñocotizado, orden_compra.total_puñocompra, orden_compra.dif_und_puño, orden_compra.dif_total_puño, orden_compra.orden_comprapuño,
            orden_compra.consumo_totalresorte, orden_compra.precio_resortecompra, orden_compra.total_resortecotizado, orden_compra.total_resortecompra, orden_compra.dif_und_resorte, orden_compra.dif_total_resorte, orden_compra.orden_compraresorte,
            orden_compra.consumo_totalresorte2, orden_compra.precio_resorte2compra, orden_compra.total_resorte2cotizado, orden_compra.total_resorte2compra, orden_compra.dif_und_resorte2, orden_compra.dif_total_resorte2, orden_compra.orden_compraresorte2,
            orden_compra.consumo_totalsesgo, orden_compra.precio_sesgocompra, orden_compra.total_sesgocotizado, orden_compra.total_sesgocompra, orden_compra.dif_und_sesgo, orden_compra.dif_total_sesgo, orden_compra.orden_comprasesgo,
            orden_compra.consumo_totaltrabilla, orden_compra.precio_trabillacompra, orden_compra.total_trabillacotizado, orden_compra.total_trabillacompra, orden_compra.dif_und_trabilla, orden_compra.dif_total_trabilla, orden_compra.orden_compratrabilla,
            orden_compra.consumo_totalvelcro, orden_compra.precio_velcrocompra, orden_compra.total_velcrocotizado, orden_compra.total_velcrocompra, orden_compra.dif_und_velcro, orden_compra.dif_total_velcro, orden_compra.orden_compravelcro,
            orden_compra.consumo_totalvinilo, orden_compra.precio_vinilocompra, orden_compra.total_vinilocotizado, orden_compra.total_vinilocompra, orden_compra.dif_und_vinilo, orden_compra.dif_total_vinilo, orden_compra.orden_compravinilo,
            orden_compra.consumo_totalvivo, orden_compra.precio_vivocompra, orden_compra.total_vivocotizado, orden_compra.total_vivocompra, orden_compra.dif_und_vivo, orden_compra.dif_total_vivo, orden_compra.orden_compravivo,
            orden_compra.prendas_comprar, orden_compra.precio_prendacompra, orden_compra.total_prendacotizado, orden_compra.total_prendacompra, orden_compra.dif_und_prenda, orden_compra.dif_total_prenda, orden_compra.orden_compraprenda
            FROM producto 
            LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto
            LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
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
            WHERE producto.id_producto = $id_producto";

            $resultado = mysqli_query($enlace, $consulta);
        ?>

        <?php
        // Almacenar la primera fila en una variable
        $fila = mysqli_fetch_assoc($resultado);
        ?>

        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="../../img/Logo.png" alt="Logo" width="70" height="50" class="rounded img-fluid d-inline-block align-text-top">
                </a>
                <a href="inicio_compras.php" class="btn active btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Insumos a Comprar del Producto <?php echo $fila ? $fila['nombre_prenda'] : 'N/A'; ?></h1>
            <h1 style="font-family: 'Times New Roman'">Con Ficha Tecnica: <?php echo $fila ? $fila['num_ficha'] : 'N/A'; ?></h1>
            <h1 style="font-family: 'Times New Roman'">Cantidad de Prendas a Realizar <?php echo $fila ? $fila['suma_prendas'] : 'N/A'; ?></h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <div class="d-flex justify-content-center gap-2">
            <?php
            $archivoListado = $fila['ficha_tecnica'];
            if (!empty($archivoListado) && file_exists("fichas_tecnicas/" . $archivoListado)) {
                echo '<a href="fichas_tecnicas/' . $archivoListado . '" class="btn btn-success" download>';
                echo 'Descargar Ficha Tecnica <i class="bi bi-download"></i>';
                echo '</a>';
            } else {
                echo '<button class="btn btn-secondary" disabled>';
                echo '<i class="bi bi-filetype-xlsx"></i> No hay archivo disponible';
                echo '</button>';
            }
            ?>

            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalenviar<?php echo $fila['id_producto']; ?>">
                <i class="bi bi-arrow-bar-right"></i> Enviar a Producción
            </button>
        </div>
        <br>

        <!-- Reiniciar el puntero de resultados -->
        <?php mysqli_data_seek($resultado, 0); ?>

        <!-- Productos -->
        <div class="container-fluid px-3">
            <div class="row">
                <div class="table-responsive">

                    <table id="mytabla" class="table table-bordered text-center">
                        <thead>
                            <tr class="table-primary">
                                <th style="text-align:center; vertical-align:middle; width:10%;">Insumo</th>
                                <th style="text-align:center; vertical-align:middle; width:8%;">Proveedor</th>
                                <th style="text-align:center; vertical-align:middle; width:5%;">Consumo<br>Unitario</th>
                                <th style="text-align:center; vertical-align:middle; width:7%;">Precio Cotizado<br>Unitario</th>
                                <th style="text-align:center; vertical-align:middle; width:5%;">Consumo<br>Total</th>
                                <th style="text-align:center; vertical-align:middle; width:7%;">Precio Cotizado<br>Total</th>
                                <th style="text-align:center; vertical-align:middle; width:10%;">Precio Compra<br>Unitario</th>
                                <th style="text-align:center; vertical-align:middle; width:10%;">Precio Compra<br>Total</th>
                                <th style="text-align:center; vertical-align:middle; width:7%;">Dif Compra<br>Und</th>
                                <th style="text-align:center; vertical-align:middle; width:7%;">Dif Compra<br>Total</th>
                                <th style="text-align:center; vertical-align:middle; width:5%;">Consumo Real<br>Unitario</th>
                                <th style="text-align:center; vertical-align:middle; width:5%;">Consumo Real<br>Total</th>
                                <th style="text-align:center; vertical-align:middle; width:5%;">Dif Cons<br>Und</th>
                                <th style="text-align:center; vertical-align:middle; width:5%;">Dif Cons<br>Total</th>
                                <th style="text-align:center; vertical-align:middle; width:4%;">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Tela -->
                            <?php if (!empty($fila['id_tela'])): ?>
                                <?php
                                    // Variables iniciales
                                    $id_tela = $fila['id_tela'];
                                    $id_tela2 = !empty($fila['id_tela2']) ? $fila['id_tela2'] : null;
                                    $color_tela = $fila['color_tela'];

                                    // Si existe homologación (id_tela2), traemos sus datos
                                    $filatela2 = null;
                                    if (!empty($id_tela2)) {
                                        $consulta_tela2 = "SELECT producto2.id_producto2, producto2.id_tela2, tela.id_tela, tela.tela AS tela_2, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_2, producto2.precio_tela2, producto2.promedio_consumo2, producto2.valor_tela2, producto2.consumo_tela2, producto2.precio_telacompra2
                                                                        FROM producto2 
                                                                        LEFT JOIN tela ON producto2.id_tela2 = tela.id_tela 
                                                                        LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor 
                                                                        WHERE tela.id_tela = '$id_tela2'";

                                        $resultado_tela2 = mysqli_query($enlace, $consulta_tela2);
                                        $filatela2 = mysqli_fetch_array($resultado_tela2);
                                    }
                                ?>
                                <?php if (empty($fila['id_tela2']) && empty($fila['dif_und_tela']) && empty($fila['dif_total_tela']) && !(isset($fila['orden_compratela']) && strlen($fila['orden_compratela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">Tela <?php $texto = $fila['tela'];
                                                                                    if (!empty($fila['color_tela'])) {
                                                                                        $texto .= " Color " . $fila['color_tela'];
                                                                                    }
                                                                                    echo htmlspecialchars($texto); ?></td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_tela" value="<?php echo $fila['valor_tela']; ?>">
                                            <input type="hidden" name="precio_telacompra" value="<?php echo $fila['precio_telacompra']; ?>">
                                            <input type="hidden" name="promedio_consumo" value="<?php echo $fila['promedio_consumo']; ?>">
                                            <input type="hidden" name="consumo_tela" value="<?php echo $fila['consumo_tela']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['promedio_consumo']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_tela']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacotizado" id="total_telacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacompra" id="total_telacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_realund" value="<?php echo $fila['consumo_realund']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_realtotal" value="<?php echo $fila['consumo_realtotal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_telainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_telacom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarTela<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-tela="<?php echo $fila['id_tela']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_tela2']) && empty($fila['dif_und_tela']) && empty($fila['dif_total_tela']) && !(isset($fila['orden_compratela']) && strlen($fila['orden_compratela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Cotizada:</strong>
                                            <?php $texto = $fila['tela'];
                                            if (!empty($fila['color_tela'])) $texto .= " - Color " . $fila['color_tela'];
                                            echo htmlspecialchars($texto); ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php $texto2 = $filatela2['tela_2'];
                                            if (!empty($filatela2['color_tela'])) $texto2 .= " - Color " . $filatela2['color_tela'];
                                            echo htmlspecialchars($texto2); ?>
                                        </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                            <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_tela2" value="<?= $filatela2['valor_tela2']; ?>">
                                            <input type="hidden" name="precio_telacompra2" value="<?= $filatela2['precio_telacompra2']; ?>">
                                            <input type="hidden" name="promedio_consumo2" value="<?= $filatela2['promedio_consumo2']; ?>">
                                            <input type="hidden" name="consumo_tela2" value="<?= $filatela2['consumo_tela2']; ?>">

                                            <td class="text-center align-middle"><?= htmlspecialchars($fila['nombre']); ?>
                                                <hr class="my-3"><?= htmlspecialchars($filatela2['nombre_2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila['promedio_consumo']); ?> Mts
                                                <hr class="my-3"><?= htmlspecialchars($filatela2['promedio_consumo2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatela2['valor_tela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_tela']); ?> Mts
                                                <hr class="my-3"><?= htmlspecialchars($filatela2['consumo_tela2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatela2['precio_telacompra2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacotizado_visible_<?= $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacotizado" id="total_telacotizado_<?= $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacompra_visible_<?= $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacompra" id="total_telacompra_<?= $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_realund" value="<?php echo $fila['consumo_realund']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_realtotal" value="<?php echo $fila['consumo_realtotal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_telainv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_telacom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_tela']) || !empty($fila['dif_total_tela'])) && !(isset($fila['orden_compratela']) && strlen($fila['orden_compratela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Cotizada:</strong>
                                            <?php $texto = $fila['tela'];
                                            if (!empty($fila['color_tela'])) $texto .= " - Color " . $fila['color_tela'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filatela2['tela_2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filatela2['tela_2'];
                                                if (!empty($filatela2['color_tela2'])) $texto2 .= " - Color " . $filatela2['color_tela2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['nombre']); ?><?php if (!empty($filatela2['nombre_2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatela2['nombre_2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['promedio_consumo']); ?> Mts<?php if (!empty($filatela2['promedio_consumo2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatela2['promedio_consumo2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatela2['valor_tela2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatela2['valor_tela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_tela']); ?> Mts<?php if (!empty($filatela2['consumo_tela2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatela2['consumo_tela2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatela2['precio_telacompra2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatela2['precio_telacompra2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_tela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_tela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_realund']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_realtotal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumo_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumo_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumo_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumo_total']); ?> Mts</td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_tela']) || !empty($fila['dif_total_tela'])) || (isset($fila['orden_compratela']) && strlen($fila['orden_compratela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Cotizada:</strong>
                                            <?php $texto = $fila['tela'];
                                            if (!empty($fila['color_tela'])) $texto .= " - Color " . $fila['color_tela'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filatela2['tela_2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filatela2['tela_2'];
                                                if (!empty($filatela2['color_tela2'])) $texto2 .= " - Color " . $filatela2['color_tela2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['nombre']); ?><?php if (!empty($filatela2['nombre_2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatela2['nombre_2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['promedio_consumo']); ?> Mts<?php if (!empty($filatela2['promedio_consumo2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatela2['promedio_consumo2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatela2['valor_tela2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatela2['valor_tela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_tela']); ?> Mts<?php if (!empty($filatela2['consumo_tela2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatela2['consumo_tela2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatela2['precio_telacompra2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatela2['precio_telacompra2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_tela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_tela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_realund']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_realtotal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumo_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumo_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumo_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumo_total']); ?> Mts</td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compratela']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>

                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

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
                                                                id="excelInput<?php echo $fila['id_producto']; ?>"
                                                                onchange="previewFile(this, 'excelPreview<?php echo $fila['id_producto']; ?>', 'fileNameExcel_<?php echo $fila['id_producto']; ?>')">
                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <center>
                                                                <img
                                                                    id="excelPreview<?php echo $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?php echo empty($fila['orden_compratela']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratela']) ? 'none' : 'block'; ?>;"
                                                                    src="<?php echo !empty($fila['orden_compratela']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratela']) ? 'orden_compratela/' . $fila['orden_compratela'] : ''; ?>">

                                                                <span
                                                                    id="fileNameExcel_<?php echo $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?php echo !empty($fila['orden_compratela']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratela']) ? 'block' : 'none'; ?>;">
                                                                    <?php echo $fila['orden_compratela']; ?>
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

                            <div class="modal fade" id="homologarTela<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

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
                                                                $selected = ($id == $fila['id_tela']) ? 'selected' : '';

                                                                echo "<option value='$id' data-precio='{$lista['precio']}' $selected>$nombre - $proveedor</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Ingrese Precio:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_tela"
                                                            value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Consumo promedio:</label>
                                                        <input type="number" step="0.01" class="form-control" name="promedio_consumo"
                                                            value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>">
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

                            <!-- Tela Combinada -->
                            <?php if (!empty($fila['id_telacombi'])): ?>
                                <?php
                                    // Definimos variables
                                    $id_telacombi = $fila['id_telacombi'];
                                    $id_telacombi2 = !empty($fila['id_telacombi2']) ? $fila['id_telacombi2'] : null;
                                    $color_telacombi = $fila['color_telacombi'];

                                    // Consulta de tela combinada principal
                                    $consulta_2 = "SELECT producto.id_telacombi, producto.promedio_telacombi, producto.precio_telacombinada, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.caracteristicas AS caracteristicas_combinado, tela_combinada.ancho as ancho_combinado, tela_combinada.rendimiento as rendimiento_combinado, tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                                                                        FROM producto 
                                                                                        LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi 
                                                                                        LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor 
                                                                                        WHERE tela_combinada.id_telacombi = '$id_telacombi'";

                                    $resultado_2 = mysqli_query($enlace, $consulta_2);
                                    $fila2 = mysqli_fetch_array($resultado_2);

                                    // Consulta de homologación SOLO si existe id_telacombi2
                                    $filatelacombi2 = null;
                                    if (!empty($id_telacombi2)) {
                                        $consulta_telacombi2 = "SELECT producto2.id_producto2, producto2.id_telacombi2, tela_combinada.id_telacombi, tela_combinada.tela_combi AS tela_combi2, tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_combinado2, producto2.precio_telacombi2, producto2.promedio_telacombi2, producto2.valor_telacombi2, producto2.consumo_totaltelacombi2, producto2.precio_telacombi2compra 
                                                                                                    FROM producto2 
                                                                                                    LEFT JOIN tela_combinada ON producto2.id_telacombi2 = tela_combinada.id_telacombi 
                                                                                                    LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor 
                                                                                                    WHERE tela_combinada.id_telacombi = '$id_telacombi2'";

                                        $resultado_telacombi2 = mysqli_query($enlace, $consulta_telacombi2);
                                        $filatelacombi2 = mysqli_fetch_array($resultado_telacombi2);
                                    }
                                ?>
                                <?php if (empty($fila['id_telacombi2']) && empty($fila['dif_und_telacombi']) && empty($fila['dif_total_telacombi']) && !(isset($fila['orden_compratelacombi']) && strlen($fila['orden_compratelacombi']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"> Tela Combinada <?php $texto = $fila['tela_combi'];
                                                                                    if (!empty($fila['color_telacombi'])) {
                                                                                        $texto .= " Color " . $fila['color_telacombi'];
                                                                                    }
                                                                                    echo htmlspecialchars($texto); ?> </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_telacombi" value="<?php echo $fila['valor_telacombi']; ?>">
                                            <input type="hidden" name="precio_telacombicompra" value="<?php echo $fila['precio_telacombicompra']; ?>">
                                            <input type="hidden" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>">
                                            <input type="hidden" name="consumo_telacombi" value="<?php echo $fila['consumo_telacombi']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['nombre_combinado']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['promedio_telacombi']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_telacombi']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacombicotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacombicotizado" id="total_telacombicotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacombicompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacombicompra" id="total_telacombicompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_combinadaund" value="<?php echo $fila['consumo_combinadaund']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_combinadatotal" value="<?php echo $fila['consumo_combinadatotal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_telacombiinv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_telacombicom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarTelacombi<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-telacombi="<?php echo $fila['id_telacombi']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_telacombi2']) && empty($fila['dif_und_telacombi']) && empty($fila['dif_total_telacombi']) && !(isset($fila['orden_compratelacombi']) && strlen($fila['orden_compratelacombi']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Combinada Cotizada:</strong>
                                            <?php $texto = $fila['tela_combi'];
                                            if (!empty($fila['color_telacombi'])) $texto .= " Color " . $fila['color_telacombi'];
                                            echo htmlspecialchars($texto); ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php $texto2 = $filatelacombi2['tela_combi2'];
                                            if (!empty($fila['color_telacombi'])) $texto2 .= " - Color " . $fila['color_telacombi'];
                                            echo htmlspecialchars($texto2); ?>
                                        </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                            <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_telacombi2" value="<?= $filatelacombi2['valor_telacombi2']; ?>">
                                            <input type="hidden" name="precio_telacombi2compra" value="<?= $filatelacombi2['precio_telacombi2compra']; ?>">
                                            <input type="hidden" name="promedio_telacombi2" value="<?= $filatelacombi2['promedio_telacombi2']; ?>">
                                            <input type="hidden" name="consumo_totaltelacombi2" value="<?= $filatelacombi2['consumo_totaltelacombi2']; ?>">

                                            <td class="text-center align-middle"><?= htmlspecialchars($fila2['nombre_combinado']); ?>
                                                <hr class="my-3"><?= htmlspecialchars($filatelacombi2['nombre_combinado2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila2['promedio_telacombi']); ?> Mts
                                                <hr class="my-3"><?= htmlspecialchars($filatelacombi2['promedio_telacombi2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['valor_telacombi2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telacombi']); ?> Mts
                                                <hr class="my-3"><?= htmlspecialchars($filatelacombi2['consumo_totaltelacombi2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['precio_telacombi2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacombicotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacombicotizado" id="total_telacombicotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telacombicompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telacombicompra" id="total_telacombicompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_combinadaund" value="<?php echo $fila['consumo_combinadaund']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_combinadatotal" value="<?php echo $fila['consumo_combinadatotal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_telacombiinv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_telacombicom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_telacombi']) || !empty($fila['dif_total_telacombi'])) && !(isset($fila['orden_compratelacombi']) && strlen($fila['orden_compratelacombi']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Combinada Cotizada:</strong>
                                            <?php $texto = $fila['tela_combi'];
                                            if (!empty($fila['color_telacombi'])) $texto .= " - Color " . $fila['color_telacombi'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filatelacombi2['tela_combi2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filatelacombi2['tela_combi2'];
                                                if (!empty($filatelacombi2['color_telacombi2'])) $texto2 .= " - Color " . $filatelacombi2['color_telacombi2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center align-middle"><?= htmlspecialchars($fila2['nombre_combinado']); ?><?php if (!empty($filatelacombi2['nombre_combinado2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelacombi2['nombre_combinado2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila2['promedio_telacombi']); ?> Mts<?php if (!empty($filatelacombi2['promedio_telacombi2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelacombi2['promedio_telacombi2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelacombi2['valor_telacombi2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['valor_telacombi2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telacombi']); ?> Mts<?php if (!empty($filatelacombi2['consumo_totaltelacombi2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelacombi2['consumo_totaltelacombi2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelacombi2['precio_telacombi2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['precio_telacombi2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacombicotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacombicompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_telacombi'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_telacombi'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_combinadaund']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_combinadatotal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumocombi_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumocombi_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumocombi_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumocombi_total']); ?> Mts</td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra2<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_telacombi']) || !empty($fila['dif_total_telacombi'])) || (isset($fila['orden_compratelacombi']) && strlen($fila['orden_compratelacombi']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Combinada Cotizada:</strong>
                                            <?php $texto = $fila['tela_combi'];
                                            if (!empty($fila['color_telacombi'])) $texto .= " - Color " . $fila['color_telacombi'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filatelacombi2['tela_combi2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filatelacombi2['tela_combi2'];
                                                if (!empty($filatelacombi2['color_telacombi2'])) $texto2 .= " - Color " . $filatelacombi2['color_telacombi2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila2['nombre_combinado']); ?><?php if (!empty($filatelacombi2['nombre_combinado2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelacombi2['nombre_combinado2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila2['promedio_telacombi']); ?> Mts<?php if (!empty($filatelacombi2['promedio_telacombi2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelacombi2['promedio_telacombi2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelacombi2['valor_telacombi2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['valor_telacombi2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telacombi']); ?> Mts<?php if (!empty($filatelacombi2['consumo_totaltelacombi2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelacombi2['consumo_totaltelacombi2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelacombi2['precio_telacombi2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['precio_telacombi2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacombicotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacombicompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_telacombi'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_telacombi'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_combinadaund']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_combinadatotal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumocombi_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumocombi_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumocombi_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumocombi_total']); ?> Mts</td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compratelacombi']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

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
                                                                onchange="previewFile2(this, 'excelPreview2<?php echo $fila['id_producto']; ?>', 'fileNameExcel2_<?php echo $fila['id_producto']; ?>')">

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
                                                                    src="<?php echo !empty($fila['orden_compratelacombi']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelacombi']) ? 'orden_compratelacombi/' . $fila['orden_compratelacombi'] : ''; ?>">

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
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_telacombi" value="<?php echo $fila['id_telacombi']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div class="mb-3">
                                                    <label class="form-label">Elija el tipo de Tela:</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control comboTelaCombiModal" placeholder="Buscar tela..." autocomplete="off">
                                                        <div class="combobox-list list-group comboTelaCombiListModal" style="display:none;"></div>

                                                        <select name="id_telacombi" class="form-select d-none selectTelaCombiModal">
                                                            <option value="0">Sin seleccionar</option>

                                                            <?php
                                                            setlocale(LC_TIME, 'spanish');

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

                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Precio de la Tela:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>">
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label class="form-label">Consumo de la Tela:</label>
                                                        <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>">
                                                    </div>
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

                            <!-- Tela Forro -->
                            <?php if (!empty($fila['id_telaforro'])): ?>
                                <?php
                                    // Definimos variables
                                    $id_telaforro = $fila['id_telaforro'];
                                    $id_telaforro2 = !empty($fila['id_telaforro2']) ? $fila['id_telaforro2'] : null;
                                    $color_telaforro = $fila['color_telaforro'];

                                    // Consulta de tela forro principal
                                    $consulta_3 = "SELECT producto.id_telaforro, producto.promedio_forro, producto.precio_forro, tela_forro.id_telaforro, tela_forro.tela_forro, 
                                    tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.ancho as ancho_forro, tela_forro.rendimiento as rendimiento_forro, tela_forro.id_proveedor, 
                                    proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                                    FROM producto 
                                                    LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro 
                                                    LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor 
                                                    WHERE tela_forro.id_telaforro = '$id_telaforro'";

                                    $resultado_3 = mysqli_query($enlace, $consulta_3);
                                    $fila3 = mysqli_fetch_array($resultado_3);

                                    // Consulta de homologación SOLO si existe id_telaforro2
                                    $filatelaforro2 = null;
                                    if (!empty($id_telaforro2)) {
                                        $consulta_telaforro2 = "SELECT producto2.id_producto2, producto2.id_telaforro2, tela_forro.id_telaforro, tela_forro.tela_forro AS tela_forro2, 
                                        tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro2, producto2.precio_telaforro2, producto2.promedio_telaforro2, 
                                        producto2.valor_telaforro2, producto2.consumo_totaltelaforro2, producto2.precio_telaforro2compra 
                                                    FROM producto2 
                                                    LEFT JOIN tela_forro ON producto2.id_telaforro2 = tela_forro.id_telaforro 
                                                    LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor 
                                                    WHERE tela_forro.id_telaforro = '$id_telaforro2'";

                                        $resultado_telaforro2 = mysqli_query($enlace, $consulta_telaforro2);
                                        $filatelaforro2 = mysqli_fetch_array($resultado_telaforro2);
                                    }
                                ?>
                                <?php if (empty($fila['id_telaforro2']) && empty($fila['dif_und_telaforro']) && empty($fila['dif_total_telaforro']) && !(isset($fila['orden_compratelaforro']) && strlen($fila['orden_compratelaforro']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Tela Forro <?php $texto = $fila['tela_forro'];
                                                    if (!empty($fila['color_telaforro'])) $texto .= " Color " . $fila['color_telaforro'];
                                                    echo htmlspecialchars($texto); ?>
                                        </td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                            <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_telaforro" value="<?= $fila['valor_forro']; ?>">
                                            <input type="hidden" name="precio_telaforrocompra" value="<?= $fila['precio_telaforrocompra']; ?>">
                                            <input type="hidden" name="promedio_forro" value="<?= $fila['promedio_forro']; ?>">
                                            <input type="hidden" name="consumo_telaforro" value="<?= $fila['consumo_telaforro']; ?>">

                                            <td class="text-center align-middle"><?= htmlspecialchars($fila3['nombre_forro']); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila3['promedio_forro']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telaforro']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telaforro_visible_<?= $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telaforrocotizado" id="total_telaforrocotizado_<?= $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telaforrocompra_visible_<?= $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telaforrocompra" id="total_telaforrocompra_<?= $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_forround" value="<?php echo $fila['consumo_forround']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_forrototal" value="<?php echo $fila['consumo_forrototal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_telaforroinv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_telaforrocom" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning w-100 mb-2" data-bs-toggle="modal" data-bs-target="#homologarTelaforro<?= $fila['id_producto']; ?>"
                                            data-id-producto="<?= $fila['id_producto']; ?>"
                                            data-id-producto2="<?= $fila['id_producto2']; ?>"
                                            data-id-telaforro="<?= $fila['id_telaforro']; ?>"
                                            data-id-ordencompra="<?= $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?= $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar Insumo
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_telaforro2']) && empty($fila['dif_und_telaforro']) && empty($fila['dif_total_telaforro']) && !(isset($fila['orden_compratelaforro']) && strlen($fila['orden_compratelaforro']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Forro Cotizada:</strong>
                                            <?php $texto = $fila['tela_forro'];
                                            if (!empty($fila['color_telaforro'])) $texto .= " Color " . $fila['color_telaforro'];
                                            echo htmlspecialchars($texto); ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php $texto2 = $filatelaforro2['tela_forro2'];
                                            if (!empty($fila['color_telaforro'])) $texto2 .= " - Color " . $fila['color_telaforro'];
                                            echo htmlspecialchars($texto2); ?>
                                        </td>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                            <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_telaforro2" value="<?= $filatelaforro2['valor_telaforro2']; ?>">
                                            <input type="hidden" name="precio_telaforro2compra" value="<?= $filatelaforro2['precio_telaforro2compra']; ?>">
                                            <input type="hidden" name="promedio_telaforro2" value="<?= $filatelaforro2['promedio_telaforro2']; ?>">
                                            <input type="hidden" name="consumo_totaltelaforro2" value="<?= $filatelaforro2['consumo_totaltelaforro2']; ?>">

                                            <td class="text-center align-middle"><?= htmlspecialchars($fila3['nombre_forro']); ?>
                                                <hr class="my-3"><?= htmlspecialchars($filatelaforro2['nombre_forro2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila3['promedio_forro']); ?> Mts
                                                <hr class="my-3"><?= htmlspecialchars($filatelaforro2['promedio_telaforro2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['valor_telaforro2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telaforro']); ?> Mts
                                                <hr class="my-3"><?= htmlspecialchars($filatelaforro2['consumo_totaltelaforro2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['precio_telaforro2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_telaforrocotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telaforrocotizado" id="total_telaforrocotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_telaforrocompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_telaforrocompra" id="total_telaforrocompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_forround" value="<?php echo $fila['consumo_forround']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_forrototal" value="<?php echo $fila['consumo_forrototal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_telaforroinv2" class="btn btn-success w-100 mb-2">
                                                        <i class="bi bi-list-check"></i> En Inventario
                                                    </button>
                                                    <button type="submit" name="dif_telaforrocom2" class="btn btn-danger w-100 mb-2">
                                                        <i class="bi bi-check2-all"></i> Comprado
                                                    </button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_telaforro']) || !empty($fila['dif_total_telaforro'])) && !(isset($fila['orden_compratelaforro']) && strlen($fila['orden_compratelaforro']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Forro Cotizada:</strong>
                                            <?php $texto = $fila['tela_forro'];
                                            if (!empty($fila['color_telaforro'])) $texto .= " - Color " . $fila['color_telaforro'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filatelaforro2['tela_forro2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filatelaforro2['tela_forro2'];
                                                if (!empty($filatelaforro2['color_telaforro2'])) $texto2 .= " - Color " . $filatelaforro2['color_telaforro2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila3['nombre_forro']); ?><?php if (!empty($filatelaforro2['nombre_forro2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelaforro2['nombre_forro2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila3['promedio_forro']); ?> Mts<?php if (!empty($filatelaforro2['promedio_telaforro2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelaforro2['promedio_telaforro2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelaforro2['valor_telaforro2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['valor_telaforro2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telaforro']); ?> Mts<?php if (!empty($filatelaforro2['consumo_totaltelaforro2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelaforro2['consumo_totaltelaforro2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelaforro2['precio_telaforro2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['precio_telaforro2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telaforrocotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telaforrocompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_telaforro'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_telaforro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_telaforro'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_telaforro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_forround']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_forrototal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumoforro_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumoforro_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumoforro_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumoforro_total']); ?> Mts</td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra3<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_telaforro']) || !empty($fila['dif_total_telaforro'])) || (isset($fila['orden_compratelaforro']) && strlen($fila['orden_compratelaforro']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Forro Cotizada:</strong>
                                            <?php $texto = $fila['tela_forro'];
                                            if (!empty($fila['color_telaforro'])) $texto .= " - Color " . $fila['color_telaforro'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filatelaforro2['tela_forro2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filatelaforro2['tela_forro2'];
                                                if (!empty($filatelaforro2['color_telaforro2'])) $texto2 .= " - Color " . $filatelaforro2['color_telaforro2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila3['nombre_forro']); ?><?php if (!empty($filatelaforro2['nombre_forro2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelaforro2['nombre_forro2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila3['promedio_forro']); ?> Mts<?php if (!empty($filatelaforro2['promedio_telaforro2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelaforro2['promedio_telaforro2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelaforro2['valor_telaforro2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['valor_telaforro2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_telaforro']); ?> Mts<?php if (!empty($filatelaforro2['consumo_totaltelaforro2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filatelaforro2['consumo_totaltelaforro2']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filatelaforro2['precio_telaforro2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['precio_telaforro2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telaforrocotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telaforrocompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_telaforro'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_telaforro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_telaforro'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_telaforro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_forround']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_forrototal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumoforro_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumoforro_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consumoforro_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consumoforro_total']); ?> Mts</td
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compratelaforro']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra3<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

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
                                                                onchange="previewFile3(this, 'excelPreview3<?php echo $fila['id_producto']; ?>', 'fileNameExcel3_<?php echo $fila['id_producto']; ?>')">

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
                                                                    src="<?php echo !empty($fila['orden_compratelaforro']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compratelaforro']) ? 'orden_compratelaforro/' . $fila['orden_compratelaforro'] : ''; ?>">

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
                                                    <button type="submit" name="cargar_orden_compratelacombi" class="btn btn-success">Subir</button>
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
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_telaforro" value="<?php echo $fila['id_telaforro']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div class="mb-3">
                                                    <label class="form-label">Elija el tipo de Tela:</label>
                                                    <div class="position-relative">

                                                        <input type="text" class="form-control comboTelaForroModal" placeholder="Buscar tela..." autocomplete="off">
                                                        <div class="combobox-list list-group comboTelaForroListModal" style="display:none;"></div>

                                                        <select name="id_telaforro" class="form-select d-none selectTelaForroModal">
                                                            <option value="0">Sin seleccionar</option>

                                                            <?php
                                                            setlocale(LC_TIME, 'spanish');

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

                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Precio de la Tela:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_forro" value="<?php echo isset($fila['precio_forro']) && $fila['precio_forro'] !== '' ? $fila['precio_forro'] : 0; ?>">
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label class="form-label">Consumo de la Tela:</label>
                                                        <input type="number" step="0.01" class="form-control" name="promedio_forro" value="<?php echo isset($fila['promedio_forro']) && $fila['promedio_forro'] !== '' ? $fila['promedio_forro'] : 0; ?>">
                                                    </div>
                                                </div>

                                                <!-- ===== BOTONES ===== -->
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

                            <!-- Entretela -->
                            <?php if (!empty($fila['id_entretela'])): ?>
                                <?php
                                // Definimos variables
                                $id_entretela = $fila['id_entretela'];
                                $id_entretela22 = !empty($fila['id_entretela22']) ? $fila['id_entretela22'] : null;

                                // Consulta de entretela principal
                                $consulta_4 = "SELECT producto.id_entretela, producto.cant_entretela, producto.precio_entretela, entretela.id_entretela, entretela.insumo AS insumo_entretela, 
                                entretela.id_proveedor, proveedor.nombre AS nombre_entretela, ficha_tecnica.id_fichatecnica, ficha_tecnica.id_producto, ficha_tecnica.color_entretela
                                                    FROM producto 
                                                    LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela 
                                                    LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor 
                                                    LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto 
                                                    WHERE entretela.id_entretela = '$id_entretela'";

                                $resultado_4 = mysqli_query($enlace, $consulta_4);
                                $fila4 = mysqli_fetch_array($resultado_4);

                                // Consulta de homologación SOLO si existe id_entretela2
                                $filaentretela22 = null;
                                if (!empty($id_entretela22)) {
                                    $consulta_entretela2 = "SELECT producto2.id_producto2, producto2.id_entretela22, producto2.precio_entretela22, producto2.cant_entretela22, producto2.valor_entretela22, 
                                    producto2.consumo_totalentretela22, producto2.precio_entretela22compra, entretela.id_entretela, entretela.insumo AS insumo_entretela2, entretela.id_proveedor, proveedor.nombre AS nombre_entretela2
                                                    FROM producto2 
                                                    LEFT JOIN entretela ON producto2.id_entretela22 = entretela.id_entretela 
                                                    LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor 
                                                    WHERE entretela.id_entretela = '$id_entretela22'";

                                    $resultado_entretela2 = mysqli_query($enlace, $consulta_entretela2);
                                    $filaentretela2 = mysqli_fetch_array($resultado_entretela2);
                                }
                                ?>

                                <?php if (empty($fila['id_entretela22']) && empty($fila['dif_und_entretela']) && empty($fila['dif_total_entretela']) && !(isset($fila['orden_compraentretela']) && strlen($fila['orden_compraentretela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"> <?php $texto = $fila4['insumo_entretela']; if (!empty($fila['color_entretela'])) { $texto .= " Color " . $fila['color_entretela'];} echo htmlspecialchars($texto); ?></td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_entretela" value="<?php echo $fila['valor_entretela']; ?>">
                                            <input type="hidden" name="precio_entretelacompra" value="<?php echo $fila['precio_entretelacompra']; ?>">
                                            <input type="hidden" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>">
                                            <input type="hidden" name="consumo_totalentretela" value="<?php echo $fila['consumo_totalentretela']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['nombre_entretela']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalentretela']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretelacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretelacotizado" id="total_entretelacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretelacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretelacompra" id="total_entretelacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretelaund" value="<?php echo $fila['consumo_entretelaund']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretelatotal" value="<?php echo $fila['consumo_entretelatotal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_entretelainv" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_entretelacom" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarEntretela<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-entretela="<?php echo $fila['id_entretela']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>

                                <?php elseif (!empty($fila['id_entretela22']) && empty($fila['dif_und_entretela']) && empty($fila['dif_total_entretela']) && !(isset($fila['orden_compraentretela']) && strlen($fila['orden_compraentretela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Entretela Cotizada:</strong>
                                            <?php $texto = $fila['insumo_entretela'];
                                            if (!empty($fila['color_entretela'])) {
                                                $texto .= " Color " . $fila['color_entretela'];
                                            }
                                            echo htmlspecialchars($texto); ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php $texto2 = $filaentretela2['insumo_entretela2'];
                                            if (!empty($fila['color_entretela'])) {
                                                $texto2 .= " - Color " . $fila['color_entretela'];
                                            }
                                            echo htmlspecialchars($texto2); ?>
                                        </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_entretela22" value="<?php echo $filaentretela2['valor_entretela22']; ?>">
                                            <input type="hidden" name="precio_entretela22compra" value="<?php echo $filaentretela2['precio_entretela22compra']; ?>">
                                            <input type="hidden" name="cant_entretela22" value="<?php echo $filaentretela2['cant_entretela22']; ?>">
                                            <input type="hidden" name="consumo_totalentretela22" value="<?php echo $filaentretela2['consumo_totalentretela22']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['nombre_entretela']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filaentretela2['nombre_entretela2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela']); ?> Mts
                                                <hr class="my-3"><?php echo htmlspecialchars($filaentretela2['cant_entretela22']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['valor_entretela22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalentretela']); ?> Mts
                                                <hr class="my-3"><?php echo htmlspecialchars($filaentretela2['consumo_totalentretela22']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['precio_entretela22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretelacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretelacotizado" id="total_entretelacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretelacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretelacompra" id="total_entretelacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretelaund" value="<?php echo $fila['consumo_entretelaund']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretelatotal" value="<?php echo $fila['consumo_entretelatotal']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_entretelainv2" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_entretelacom2" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_entretela']) || !empty($fila['dif_total_entretela'])) && !(isset($fila['orden_compraentretela']) && strlen($fila['orden_compraentretela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Entretela Cotizada:</strong>
                                            <?php $texto = $fila['insumo_entretela'];
                                            if (!empty($fila['color_entretela'])) $texto .= " - Color " . $fila['color_entretela'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filaentretela2['insumo_entretela2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filaentretela2['insumo_entretela2'];
                                                if (!empty($filaentretela2['color_entretela2'])) $texto2 .= " - Color " . $filaentretela2['color_entretela2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila4['nombre_entretela']); ?><?php if (!empty($filaentretela2['nombre_entretela2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaentretela2['nombre_entretela2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_entretela']); ?> Mts<?php if (!empty($filaentretela2['cant_entretela22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaentretela2['cant_entretela22']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaentretela2['valor_entretela22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['valor_entretela22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalentretela']); ?> Mts<?php if (!empty($filaentretela2['consumo_totalentretela22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaentretela2['consumo_totalentretela22']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaentretela2['precio_entretela22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['precio_entretela22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_entretelacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_entretelacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_entretela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_entretela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_entretelaund']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_entretelatotal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consentretela_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consentretela_total']); ?> Mts</td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra4<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_entretela']) || !empty($fila['dif_total_entretela'])) || (isset($fila['orden_compraentretela']) && strlen($fila['orden_compraentretela']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Entretela Cotizada:</strong>
                                            <?php $texto = $fila['insumo_entretela'];
                                            if (!empty($fila['color_entretela'])) $texto .= " - Color " . $fila['color_entretela'];
                                            echo htmlspecialchars($texto); ?>
                                            <?php if (!empty($filaentretela2['insumo_entretela2'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php $texto2 = $filaentretela2['insumo_entretela2'];
                                                if (!empty($filaentretela2['color_entretela2'])) $texto2 .= " - Color " . $filaentretela2['color_entretela2'];
                                                echo htmlspecialchars($texto2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila4['nombre_entretela']); ?><?php if (!empty($filaentretela2['nombre_entretela2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaentretela2['nombre_entretela2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_entretela']); ?> Mts<?php if (!empty($filaentretela2['cant_entretela22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaentretela2['cant_entretela22']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaentretela2['valor_entretela22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['valor_entretela22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalentretela']); ?> Mts<?php if (!empty($filaentretela2['consumo_totalentretela22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaentretela2['consumo_totalentretela22']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaentretela2['precio_entretela22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['precio_entretela22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_entretelacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_entretelacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_entretela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_entretela'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_entretelaund']); ?> Mts</td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_entretelatotal']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela_und'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consentretela_und']); ?> Mts</td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela_total'] >= 0) ? 'text-success' : 'text-danger'; ?>"><?= htmlspecialchars($fila['dif_consentretela_total']); ?> Mts</td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraentretela']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra4<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
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
                                                                name="orden_compraentretela"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput4<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile4(this, 'excelPreview4<?= $fila['id_producto']; ?>', 'fileNameExcel4_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput4<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <center>
                                                                <img
                                                                    id="excelPreview4<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraentretela']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraentretela']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraentretela']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraentretela']) ? 'orden_compraentretela/' . $fila['orden_compraentretela'] : ''; ?>">

                                                                <span
                                                                    id="fileNameExcel4_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraentretela']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraentretela']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraentretela']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraentretela" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarEntretela<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Tela Cotizado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_entretela" value="<?php echo $fila['id_entretela']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_entretela_actual = $fila['id_entretela']; ?>
                                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_entretela"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_entretela_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_entretela" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Entretela 2 -->
                            <?php if (!empty($fila['id_entretela2'])): ?>
                                <?php
                                $id_entretela2   = $fila['id_entretela2'];
                                $id_entretela222 = !empty($fila['id_entretela222']) ? $fila['id_entretela222'] : null;

                                $consulta_41 = "SELECT producto.id_entretela2, producto.cant_entretela2, producto.precio_entretela2, entretela2.id_entretela2, entretela2.insumo AS insumo_entretela2, entretela2.id_proveedor, proveedor.nombre AS nombre_entretela2,
                                                ficha_tecnica.id_fichatecnica, ficha_tecnica.id_producto, ficha_tecnica.color_entretela2
                                                FROM producto
                                                LEFT JOIN entretela2 ON producto.id_entretela2 = entretela2.id_entretela2
                                                LEFT JOIN proveedor ON entretela2.id_proveedor = proveedor.id_proveedor
                                                LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto
                                                WHERE entretela2.id_entretela2 = '$id_entretela2'";

                                $resultado_41 = mysqli_query($enlace, $consulta_41);
                                $fila41 = mysqli_fetch_array($resultado_41);

                                $filaentretela222 = null;
                                if (!empty($id_entretela222)) {

                                    $consulta_entretela222 = "SELECT producto2.id_producto2, producto2.id_entretela222, producto2.precio_entretela222, producto2.cant_entretela222, producto2.valor_entretela222, producto2.consumo_totalentretela222,
                                                            producto2.precio_entretela222compra, entretela2.id_entretela2, entretela2.insumo AS insumo_entretela222, entretela2.id_proveedor, proveedor.nombre AS nombre_entretela222
                                                            FROM producto2
                                                            LEFT JOIN entretela2 ON producto2.id_entretela222 = entretela2.id_entretela2
                                                            LEFT JOIN proveedor ON entretela2.id_proveedor = proveedor.id_proveedor
                                                            WHERE entretela2.id_entretela2 = '$id_entretela222'";

                                    $resultado_entretela222 = mysqli_query($enlace, $consulta_entretela222);

                                    $filaentretela222 = mysqli_fetch_array($resultado_entretela222);
                                }
                                ?>

                                <?php if (empty($fila['id_entretela222']) && empty($fila['dif_und_entretela2']) && empty($fila['dif_total_entretela2']) && !(isset($fila['orden_compraentretela2']) && strlen($fila['orden_compraentretela2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"> <?php $texto = $fila41['insumo_entretela2']; if (!empty($fila['color_entretela2'])) { $texto .= " Color " . $fila['color_entretela2'];} echo htmlspecialchars($texto); ?></td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_entretela2" value="<?php echo $fila['valor_entretela2']; ?>">
                                            <input type="hidden" name="precio_entretela2compra" value="<?php echo $fila['precio_entretela2compra']; ?>">
                                            <input type="hidden" name="cant_entretela2" value="<?php echo $fila['cant_entretela2']; ?>">
                                            <input type="hidden" name="consumo_totalentretela2" value="<?php echo $fila['consumo_totalentretela2']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila41['nombre_entretela2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela2']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalentretela2']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretela2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretela2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretela2cotizado" id="total_entretela2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretela2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretela2compra" id="total_entretela2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretela2und" value="<?php echo $fila['consumo_entretela2und']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretela2total" value="<?php echo $fila['consumo_entretela2total']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_entretelainv22" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_entretelacom22" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarEntretela2<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-entretela2="<?php echo $fila['id_entretela2']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>

                                <?php elseif (!empty($fila['id_entretela222']) && empty($fila['dif_und_entretela2']) && empty($fila['dif_total_entretela2']) && !(isset($fila['orden_compraentretela2']) && strlen($fila['orden_compraentretela2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Entretela 2 Cotizada:</strong>
                                            <?php $texto = $fila['insumo_entretela2'];
                                            if (!empty($fila['color_entretela2'])) {
                                                $texto .= " Color " . $fila['color_entretela2'];
                                            }
                                            echo htmlspecialchars($texto); ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php $texto2 = $filaentretela222['insumo_entretela222'];
                                            if (!empty($fila['color_entretela2'])) {
                                                $texto2 .= " - Color " . $fila['color_entretela2'];
                                            }
                                            echo htmlspecialchars($texto2); ?>
                                        </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_entretela222" value="<?php echo $filaentretela222['valor_entretela222']; ?>">
                                            <input type="hidden" name="precio_entretela222compra" value="<?php echo $filaentretela222['precio_entretela222compra']; ?>">
                                            <input type="hidden" name="cant_entretela222" value="<?php echo $filaentretela222['cant_entretela222']; ?>">
                                            <input type="hidden" name="consumo_totalentretela222" value="<?php echo $filaentretela222['consumo_totalentretela222']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila41['nombre_entretela2']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filaentretela222['nombre_entretela222']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela2']); ?> Mts
                                                <hr class="my-3"><?php echo htmlspecialchars($filaentretela222['cant_entretela222']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela222['valor_entretela222'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalentretela2']); ?> Mts
                                                <hr class="my-3"><?php echo htmlspecialchars($filaentretela222['consumo_totalentretela222']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretela2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela222['precio_entretela222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretela2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretela2cotizado" id="total_entretela2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_entretela2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_entretela2compra" id="total_entretela2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretela2und" value="<?php echo $fila['consumo_entretela2und']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" class="form-control text-center" name="consumo_entretela2total" value="<?php echo $fila['consumo_entretela2total']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_entretelainv222" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_entretelacom222" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((empty($fila['dif_und_entretela2']) || !empty($fila['dif_total_entretela2'])) && !(isset($fila['orden_compraentretela2']) && strlen($fila['orden_compraentretela2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Entretela 2 Cotizada:</strong>
                                            <?php
                                            $texto = $fila['insumo_entretela2'];
                                            if (!empty($fila['color_entretela2'])) {
                                                $texto .= " - Color " . $fila['color_entretela2'];
                                            }
                                            echo htmlspecialchars($texto);
                                            ?>

                                            <?php if (!empty($filaentretela222['insumo_entretela222'])): ?>
                                                <hr class="my-2">
                                                <strong>Homologación:</strong>
                                                <?php
                                                $texto2 = $filaentretela222['insumo_entretela222'];

                                                if (!empty($fila['color_entretela2'])) {
                                                    $texto2 .= " - Color " . $fila['color_entretela2'];
                                                }

                                                echo htmlspecialchars($texto2);
                                                ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila41['nombre_entretela2']); ?><?php if (!empty($filaentretela222['nombre_entretela222'])): ?> 
                                                <hr class="my-3"> <?= htmlspecialchars($filaentretela222['nombre_entretela222']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['cant_entretela2']); ?> Mts <?php if (!empty($filaentretela222['cant_entretela222'])): ?>
                                                <hr class="my-3"> <?= htmlspecialchars($filaentretela222['cant_entretela222']); ?> Mts <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['valor_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php if (!empty($filaentretela222['valor_entretela222'])): ?>
                                                <hr class="my-3"> <?php $precio_formateado = number_format($filaentretela222['valor_entretela222'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['consumo_totalentretela2']); ?> Mts
                                            <?php if (!empty($filaentretela222['consumo_totalentretela222'])): ?>
                                                <hr class="my-3"><?= htmlspecialchars($filaentretela222['consumo_totalentretela222']); ?> Mts
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['precio_entretela2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php if (!empty($filaentretela222['precio_entretela222compra'])): ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela222['precio_entretela222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['total_entretela2cotizado'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['total_entretela2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_und_entretela2'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                            <?php $precio_formateado = number_format($fila['dif_und_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_total_entretela2'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                            <?php $precio_formateado = number_format($fila['dif_total_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['consumo_entretela2und']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['consumo_entretela2total']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela2_und'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?= htmlspecialchars($fila['dif_consentretela2_und']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela2_total'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?= htmlspecialchars($fila['dif_consentretela2_total']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra42<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_entretela2']) || !empty($fila['dif_total_entretela2'])) || (isset($fila['orden_compraentretela2']) && strlen($fila['orden_compraentretela2']) > 0)): ?>
                                    <tr>

                                        <td class="text-center align-middle">
                                            <strong>Entretela 2 Cotizada:</strong>

                                            <?php
                                            $texto = $fila['insumo_entretela2'];

                                            if (!empty($fila['color_entretela2'])) {
                                                $texto .= " - Color " . $fila['color_entretela2'];
                                            }

                                            echo htmlspecialchars($texto);
                                            ?>

                                            <?php if (!empty($filaentretela222['insumo_entretela222'])): ?>
                                                <hr class="my-2">

                                                <strong>Homologación:</strong>

                                                <?php
                                                $texto2 = $filaentretela222['insumo_entretela222'];

                                                if (!empty($fila['color_entretela2'])) {
                                                    $texto2 .= " - Color " . $fila['color_entretela2'];
                                                }

                                                echo htmlspecialchars($texto2);
                                                ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila41['nombre_entretela2']); ?> <?php if (!empty($filaentretela222['nombre_entretela222'])): ?>
                                                <hr class="my-3"><?= htmlspecialchars($filaentretela222['nombre_entretela222']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['cant_entretela2']); ?> Mts <?php if (!empty($filaentretela222['cant_entretela222'])): ?>
                                                <hr class="my-3"><?= htmlspecialchars($filaentretela222['cant_entretela222']); ?> Mts<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['valor_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php if (!empty($filaentretela222['valor_entretela222'])): ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela222['valor_entretela222'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['consumo_totalentretela2']); ?> Mts
                                            <?php if (!empty($filaentretela222['consumo_totalentretela222'])): ?>
                                                <hr class="my-3"><?= htmlspecialchars($filaentretela222['consumo_totalentretela222']); ?> Mts <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['precio_entretela2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php if (!empty($filaentretela222['precio_entretela222compra'])): ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaentretela222['precio_entretela222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['total_entretela2cotizado'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['total_entretela2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_und_entretela2'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                            <?php $precio_formateado = number_format($fila['dif_und_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_total_entretela2'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                            <?php $precio_formateado = number_format($fila['dif_total_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['consumo_entretela2und']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= htmlspecialchars($fila['consumo_entretela2total']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela2_und'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?= htmlspecialchars($fila['dif_consentretela2_und']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle <?= ($fila['dif_consentretela2_total'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?= htmlspecialchars($fila['dif_consentretela2_total']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraentretela2']); ?>" class="btn btn-success" download>
                                                Descargar Orden de Compra <i class="bi bi-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra4<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
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
                                                                name="orden_compraentretela"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput4<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile4(this, 'excelPreview4<?= $fila['id_producto']; ?>', 'fileNameExcel4_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput4<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <center>
                                                                <img
                                                                    id="excelPreview4<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraentretela']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraentretela']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraentretela']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraentretela']) ? 'orden_compraentretela/' . $fila['orden_compraentretela'] : ''; ?>">

                                                                <span
                                                                    id="fileNameExcel4_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraentretela']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraentretela']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraentretela']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraentretela" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarEntretela2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Tela Cotizado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_entretela2" value="<?php echo $fila['id_entretela2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_entretela2_actual = $fila['id_entretela2']; ?>
                                                    <select name="id_entretela2" class="form-select" id="id_entretela2" onchange="togglePrecioEntretela2(this)">
                                                        <?php $consulta_mysql = 'select id_entretela2, insumo, precio from entretela2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_entretela2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_entretela2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_entretela2" id="precio_entretela2" value="<?php echo isset($fila['precio_entretela2']) && $fila['precio_entretela2'] !== '' ? $fila['precio_entretela2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_entretela2" value="<?php echo isset($fila['cant_entretela2']) && $fila['cant_entretela2'] !== '' ? $fila['cant_entretela2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_entretela2" class="btn btn-success">Continuar</button>
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

                    <table id="mytabla2" class="table table-bordered text-center">
                        <thead>
                            <tr class="table-primary">
                                <th style="text-align: center; vertical-align: middle; width: 15%;">Insumo</th>
                                <th style="text-align: center; vertical-align: middle; width: 7%;">Proveedor</th>
                                <th style="text-align: center; vertical-align: middle; width: 6%;">Consumo <br> Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio Cotizado <br> Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 6%;">Consumo <br> Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio Cotizado<br> Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio <br> Compra Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio <br> Compra Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Diferencia <br> Compra Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Diferencia <br> Compra Total</th>
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
                                (!empty($fila['id_vivo'])     && $fila['id_vivo'] != '0')
                            ):
                            ?>

                                <?php
                                $insumos = ['broche', 'cordon', 'cuello', 'deslizador', 'fajon_cintura', 'guata', 'hiladilla', 'hombrera', 'plumilla', 'pretina', 'puntera', 'puño', 'sesgo', 'trabilla', 'velcro', 'vinilo', 'vivo'];

                                foreach ($insumos as $insumo) {
                                    $id_campo = 'id_' . $insumo;
                                    $id_valor = $fila[$id_campo] ?? null;

                                    if (!empty($id_valor)) {
                                        $consulta = "SELECT $insumo.$id_campo, proveedor.id_proveedor, proveedor.nombre AS proveedor_$insumo FROM $insumo LEFT JOIN proveedor ON $insumo.id_proveedor = proveedor.id_proveedor WHERE $insumo.$id_campo = '$id_valor'";

                                        $resultado = mysqli_query($enlace, $consulta);
                                        $proveedores[$insumo] = mysqli_fetch_array($resultado);
                                    } else {
                                        $proveedores[$insumo] = null;
                                    }
                                }
                                ?>

                                <?php
                                $insumos_grupo1 = ['cuello', 'puño'];
                                $insumos_grupo2 = ['broche', 'cordon', 'deslizador', 'fajon_cintura', 'guata', 'hiladilla', 'hombrera', 'plumilla', 'pretina', 'puntera', 'sesgo', 'trabilla', 'velcro', 'vinilo', 'vivo'];

                                $insumos_totales = array_merge($insumos_grupo1, $insumos_grupo2);

                                foreach ($insumos_totales as $insumo): $esGrupo1 = in_array($insumo, $insumos_grupo1); ?>
                                    <?php if (!empty($fila['id_' . $insumo])): ?>
                                        <?php
                                        $columna_id_producto2 = "id_{$insumo}2";
                                        $id_insumo2 = $fila[$columna_id_producto2] ?? 0;
                                        $campo_id_tabla = "id_$insumo";

                                        $campo_cantidad = $esGrupo1
                                            ? "producto2.consumo_{$insumo}2"
                                            : "producto2.cant_{$insumo}2";

                                        $consulta = "SELECT $insumo.$campo_id_tabla, $insumo.insumo AS insumo_$insumo, 
                                                                                                        producto2.$columna_id_producto2, $campo_cantidad,
                                                                                                        producto2.precio_{$insumo}2, producto2.consumo_total{$insumo}2, 
                                                                                                        producto2.precio_{$insumo}2compra,
                                                                                                        proveedor.id_proveedor, proveedor.nombre AS nombre_$insumo
                                                                                                FROM producto2 
                                                                                                LEFT JOIN $insumo ON producto2.$columna_id_producto2 = $insumo.$campo_id_tabla 
                                                                                                LEFT JOIN proveedor ON $insumo.id_proveedor = proveedor.id_proveedor
                                                                                                WHERE $insumo.$campo_id_tabla = '$id_insumo2'";

                                        $resultado = mysqli_query($enlace, $consulta);
                                        $filainsumo2 = mysqli_fetch_array($resultado);
                                        ?>

                                        <?php if (empty($fila['id_' . $insumo . '2']) && empty($fila['dif_und_' . $insumo]) && empty($fila['dif_total_' . $insumo]) && !(isset($fila['orden_compra' . $insumo]) && strlen($fila['orden_compra' . $insumo]) > 0)): ?>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="precio_<?= $insumo ?>" value="<?= htmlspecialchars($fila['precio_' . $insumo]) ?>">
                                                    <input type="hidden" name="precio_<?= $insumo ?>compra" value="<?= htmlspecialchars($fila['precio_' . $insumo . 'compra']) ?>">

                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_' . $insumo] ?? ''); ?></td>
                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? ''); ?></td>
                                                    <td class="text-center align-middle"><?php echo htmlspecialchars(($esGrupo1 ? ($fila['consumo_' . $insumo] ?? '') : ($fila['cant_' . $insumo] ?? ''))); ?> Und </td>
                                                    <td class="text-center align-middle"><?php $precio = $fila['precio_' . $insumo] ?? 0;
                                                                                            $precio_formateado = number_format($precio, 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_total' . $insumo] ?? ''); ?> Und </td>
                                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo . 'compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle"><input type="text" id="total_<?= $insumo ?>cotizado_visible_<?= $fila['id_producto'] ?>" class="form-control text-center"><input type="hidden" name="total_<?= $insumo ?>cotizado" id="total_<?= $insumo ?>cotizado_<?= $fila['id_producto'] ?>"></td>
                                                    <td class="text-center align-middle"><input type="text" id="total_<?= $insumo ?>compra_visible_<?= $fila['id_producto'] ?>" class="form-control text-center"><input type="hidden" name="total_<?= $insumo ?>compra" id="total_<?= $insumo ?>compra_<?= $fila['id_producto'] ?>"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td>
                                                        <button type="submit" name="dif_<?= $insumo ?>inv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                        <button type="submit" name="dif_<?= $insumo ?>com" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </form>
                                                <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologar1<?= $insumo . $fila['id_producto']; ?>"
                                                    data-id-producto="<?= $fila['id_producto']; ?>"
                                                    data-id-producto2="<?= $fila['id_producto2']; ?>"
                                                    data-id-insumo="<?= $fila['id_' . $insumo]; ?>"
                                                    data-id-ordencompra="<?= $fila['id_ordencompra']; ?>"
                                                    data-suma-prendas="<?= $fila['suma_prendas']; ?>">
                                                    <i class="bi bi-pencil-square"></i> Homologar
                                                </button>
                                                </td>
                                            </tr>
                                        <?php elseif (!empty($fila['id_' . $insumo . '2']) && empty($fila['dif_und_' . $insumo]) && empty($fila['dif_total_' . $insumo]) && !(isset($fila['orden_compra' . $insumo]) && strlen($fila['orden_compra' . $insumo]) > 0)): ?>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                    <input type="hidden" name="precio_<?= $insumo ?>2" value="<?= htmlspecialchars($filainsumo2['precio_' . $insumo . '2']) ?>">
                                                    <input type="hidden" name="precio_<?= $insumo ?>2compra" value="<?= htmlspecialchars($filainsumo2['precio_' . $insumo . '2compra']) ?>">

                                                    <td class="text-center align-middle">
                                                        <strong>Cotizado:</strong> <?= htmlspecialchars($fila['insumo_' . $insumo] ?? '') ?>
                                                        <hr class="my-3">
                                                        <strong>Homologado:</strong> <?= htmlspecialchars($filainsumo2['insumo_' . $insumo] ?? '') ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?= htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? '') ?>
                                                        <hr class="my-3"><?= htmlspecialchars($filainsumo2['nombre_' . $insumo] ?? '') ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?= htmlspecialchars($fila[$esGrupo1 ? 'consumo_' . $insumo : 'cant_' . $insumo] ?? '') ?> Und
                                                        <hr class="my-3"><?= htmlspecialchars($filainsumo2[$esGrupo1 ? 'consumo_' . $insumo . '2' : 'cant_' . $insumo . '2'] ?? '') ?> Und
                                                    </td>
                                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                        <hr class="my-3"><?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_total' . $insumo] ?? '') ?> Und
                                                        <hr class="my-3"><?= htmlspecialchars($filainsumo2['consumo_total' . $insumo . '2'] ?? '') ?> Und
                                                    </td>
                                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo . 'compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                        <hr class="my-3"><?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                    </td>
                                                    <td class="text-center align-middle"><input type="text" id="total_<?= $insumo ?>cotizado_visible_<?= $fila['id_producto'] ?>" class="form-control text-center"><input type="hidden" name="total_<?= $insumo ?>cotizado" id="total_<?= $insumo ?>cotizado_<?= $fila['id_producto'] ?>"></td>
                                                    <td class="text-center align-middle"><input type="text" id="total_<?= $insumo ?>compra_visible_<?= $fila['id_producto'] ?>" class="form-control text-center"><input type="hidden" name="total_<?= $insumo ?>compra" id="total_<?= $insumo ?>compra_<?= $fila['id_producto'] ?>"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td class="text-center align-middle"></td>
                                                    <td>
                                                        <button type="submit" name="dif_<?= $insumo ?>inv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                        <button type="submit" name="dif_<?= $insumo ?>com2" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php elseif ((!empty($fila['dif_und_' . $insumo]) || !empty($fila['dif_total_' . $insumo])) && !(isset($fila['orden_compra' . $insumo]) && strlen($fila['orden_compra' . $insumo]) > 0)): ?>
                                            <tr>
                                                <td class="text-center align-middle"><strong>Insumo Cotizado:</strong> <?= htmlspecialchars($fila['insumo_' . $insumo] ?? '') ?><?php if (!empty($filainsumo2['insumo_' . $insumo])): ?>
                                                    <hr class="my-2"><strong>Insumo Homologado:</strong> <?= htmlspecialchars($filainsumo2['insumo_' . $insumo]) ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? '') ?><?php if (!empty($filainsumo2['nombre_' . $insumo])): ?>
                                                    <hr class="my-3"><?= htmlspecialchars($filainsumo2['nombre_' . $insumo]) ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($fila[$esGrupo1 ? 'consumo_' . $insumo : 'cant_' . $insumo] ?? '') ?> Und<?php if (!empty($filainsumo2[$esGrupo1 ? 'consumo_' . $insumo . '2' : 'cant_' . $insumo . '2'])): ?>
                                                    <hr class="my-3"><?= htmlspecialchars($filainsumo2[$esGrupo1 ? 'consumo_' . $insumo . '2' : 'cant_' . $insumo . '2']) ?> Und<?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filainsumo2['precio_' . $insumo . '2'])): ?>
                                                    <hr class="my-3"><?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_total' . $insumo] ?? '') ?> Und<?php if (!empty($filainsumo2['consumo_total' . $insumo . '2'])): ?>
                                                    <hr class="my-3"><?= htmlspecialchars($filainsumo2['consumo_total' . $insumo . '2']) ?> Und<?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo . 'compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filainsumo2['precio_' . $insumo . '2compra'])): ?>
                                                    <hr class="my-3"><?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_' . $insumo . 'cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_' . $insumo . 'compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle <?php echo ($fila['dif_und_' . $insumo] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_' . $insumo], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle <?php echo ($fila['dif_total_' . $insumo] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_' . $insumo], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra<?= $insumo . $fila['id_producto']; ?>">
                                                        <i class="bi bi-upload me-1"></i> Cargar Orden
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php elseif ((!empty($fila['dif_und_' . $insumo]) || !empty($fila['dif_total_' . $insumo])) || (isset($fila['orden_compra' . $insumo]) && strlen($fila['orden_compra' . $insumo]) > 0)): ?>
                                            <tr>
                                                <td class="text-center align-middle"><strong>Insumo Cotizado:</strong> <?= htmlspecialchars($fila['insumo_' . $insumo] ?? '') ?><?php if (!empty($filainsumo2['insumo_' . $insumo])): ?>
                                                    <hr class="my-2"><strong>Insumo Homologado:</strong> <?= htmlspecialchars($filainsumo2['insumo_' . $insumo]) ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? '') ?><?php if (!empty($filainsumo2['nombre_' . $insumo])): ?>
                                                    <hr class="my-3"><?= htmlspecialchars($filainsumo2['nombre_' . $insumo]) ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($fila[$esGrupo1 ? 'consumo_' . $insumo : 'cant_' . $insumo] ?? '') ?> Und<?php if (!empty($filainsumo2[$esGrupo1 ? 'consumo_' . $insumo . '2' : 'cant_' . $insumo . '2'])): ?>
                                                    <hr class="my-3"><?= htmlspecialchars($filainsumo2[$esGrupo1 ? 'consumo_' . $insumo . '2' : 'cant_' . $insumo . '2']) ?> Und<?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filainsumo2['precio_' . $insumo . '2'])): ?>
                                                    <hr class="my-3"><?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_total' . $insumo] ?? '') ?> Und<?php if (!empty($filainsumo2['consumo_total' . $insumo . '2'])): ?>
                                                    <hr class="my-3"><?= htmlspecialchars($filainsumo2['consumo_total' . $insumo . '2']) ?> Und<?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo . 'compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filainsumo2['precio_' . $insumo . '2compra'])): ?>
                                                    <hr class="my-3"><?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_' . $insumo . 'cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_' . $insumo . 'compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle <?php echo ($fila['dif_und_' . $insumo] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_' . $insumo], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle <?php echo ($fila['dif_total_' . $insumo] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_' . $insumo], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="orden_compra/<?php echo ($fila['orden_compra' . $insumo]); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
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
                                                        <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                        <!-- SELECT Y CAMPOS DE CUELLO -->
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
                                                                    <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo $fila['cant_hombrera'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_pretina" value="<?php echo $fila['cant_pretina'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_plumilla" value="<?php echo $fila['cant_plumilla'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_vinilo" value="<?php echo $fila['cant_vinilo'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_deslizador" value="<?php echo $fila['cant_deslizador'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_fajon_cintura" value="<?php echo $fila['cant_fajon_cintura'] ?? 0; ?>">
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
                                                                    <input type="number" step="any" class="form-control" name="cant_hiladilla" value="<?php echo $fila['cant_hiladilla'] ?? 0; ?>">
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
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!----->

                            <!-- Boton 1 -->
                            <?php if (!empty($fila['id_boton'])): ?>
                                <?php
                                $id_boton = $fila['id_boton'];
                                $id_boton22 = !empty($fila['id_boton22']) ? $fila['id_boton22'] : null;

                                $consulta_5 = "SELECT producto.id_boton, producto.cant_boton, producto.precio_boton, boton.id_boton, boton.insumo AS insumo_boton, boton.id_proveedor, 
                                                            proveedor.nombre AS nombre_boton FROM producto 
                                                            LEFT JOIN boton ON producto.id_boton = boton.id_boton 
                                                            LEFT JOIN proveedor ON boton.id_proveedor = proveedor.id_proveedor 
                                                            WHERE boton.id_boton = '$id_boton'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_boton22
                                $filaboton22 = null;
                                if (!empty($id_boton22)) {
                                    $consulta_boton2 = "SELECT producto2.id_producto2, producto2.id_boton22, producto2.precio_boton22, producto2.cant_boton22, producto2.valor_boton22, producto2.consumo_totalboton22, 
                                                                    producto2.precio_boton22compra, boton.id_boton, boton.insumo AS insumo_boton2, boton.id_proveedor, proveedor.nombre AS nombre_boton2 FROM producto2 
                                                                    LEFT JOIN boton ON producto2.id_boton22 = boton.id_boton
                                                                    LEFT JOIN proveedor ON boton.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE boton.id_boton = '$id_boton22'";

                                    $resultado_boton2 = mysqli_query($enlace, $consulta_boton2);
                                    $filaboton2 = mysqli_fetch_array($resultado_boton2);
                                }
                                ?>

                                <?php if (empty($fila['id_boton22']) && empty($fila['dif_und_boton']) && empty($fila['dif_total_boton']) && !(isset($fila['orden_compraboton']) && strlen($fila['orden_compraboton']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_boton" value="<?php echo $fila['precio_boton']; ?>">
                                            <input type="hidden" name="precio_botoncompra" value="<?php echo $fila['precio_botoncompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_boton']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_boton']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_botoncompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_botoncotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_botoncotizado" id="total_botoncotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_botoncompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_botoncompra" id="total_botoncompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_botoninv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_botoncom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarBoton<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-boton="<?php echo $fila['id_boton']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_boton22']) && empty($fila['dif_und_boton']) && empty($fila['dif_total_boton']) && !(isset($fila['orden_compraboton']) && strlen($fila['orden_compraboton']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_boton22" value="<?php echo $filaboton2['precio_boton22']; ?>">
                                            <input type="hidden" name="precio_boton22compra" value="<?php echo $filaboton2['precio_boton22compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Boton Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_boton']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filaboton2['insumo_boton2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_boton']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filaboton2['nombre_boton2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaboton2['cant_boton22']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaboton2['consumo_totalboton22']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_botoncompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_botoncotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_botoncotizado" id="total_botoncotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_botoncompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_botoncompra" id="total_botoncompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_botoninv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_botoncom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_boton']) || !empty($fila['dif_total_boton'])) && !(isset($fila['orden_compraboton']) && strlen($fila['orden_compraboton']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Botón Cotizada:</strong> <?= htmlspecialchars($fila['insumo_boton']); ?><?php if (!empty($filaboton2['insumo_boton2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaboton2['insumo_boton2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_boton']); ?><?php if (!empty($filaboton2['nombre_boton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['nombre_boton22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_boton']); ?> Und<?php if (!empty($filaboton2['cant_boton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['cant_boton22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalboton']); ?> Und<?php if (!empty($filaboton2['consumo_totalboton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['consumo_totalboton22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_botoncompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_botoncotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_botoncompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_boton'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_boton'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_boton'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_boton'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra5<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_boton']) || !empty($fila['dif_total_boton'])) || (isset($fila['orden_compraboton']) && strlen($fila['orden_compraboton']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Botón Cotizada:</strong> <?= htmlspecialchars($fila['insumo_boton']); ?><?php if (!empty($filaboton2['insumo_boton2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaboton2['insumo_boton2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_boton']); ?><?php if (!empty($filaboton2['nombre_boton2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['nombre_boton2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_boton']); ?> Und<?php if (!empty($filaboton2['cant_boton2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['cant_boton2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalboton']); ?> Und<?php if (!empty($filaboton2['consumo_totalboton2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['consumo_totalboton2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_botoncompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_botoncotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_botoncompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_boton'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_boton'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_boton'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_boton'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraboton']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra5<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra - Botón</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_boton" enctype="multipart/form-data">
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
                                                                name="orden_compraboton"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput5<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile5(this, 'excelPreview5<?= $fila['id_producto']; ?>', 'fileNameExcel5_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput5<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview5<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraboton']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraboton']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraboton']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraboton']) ? 'orden_compraboton/' . $fila['orden_compraboton'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel5_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraboton']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraboton']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraboton']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraboton" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarBoton<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_boton" value="<?php echo $fila['id_boton']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_boton_actual = $fila['id_boton']; ?>
                                                    <select name="id_boton" class="form-select" id="id_boton" onchange="togglePrecioBoton(this)">
                                                        <?php $consulta_mysql = 'select id_boton, insumo, precio from boton';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_boton"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_boton_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_boton" value="<?php echo isset($fila['cant_boton']) && $fila['cant_boton'] !== '' ? $fila['cant_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_boton" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Boton 2 -->
                            <?php if (!empty($fila['id_boton2'])): ?>
                                <?php
                                $id_boton2 = $fila['id_boton2'];
                                $id_boton222 = !empty($fila['id_boton222']) ? $fila['id_boton222'] : null;

                                $consulta_5 = "SELECT producto.id_boton2,producto.cant_boton2,producto.precio_boton2,boton2.id_boton2,boton2.insumo AS insumo_boton2, boton2.id_proveedor,proveedor.nombre AS nombre_boton2
                                            FROM producto
                                            LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2
                                            LEFT JOIN proveedor ON boton2.id_proveedor = proveedor.id_proveedor
                                            WHERE boton2.id_boton2 = '$id_boton2'
                                        ";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                $filaboton222 = null;
                                if (!empty($id_boton222)) {
                                    $consulta_boton2 = "SELECT producto2.id_producto2,producto2.id_boton222,producto2.precio_boton222,producto2.cant_boton222,producto2.valor_boton222,producto2.consumo_totalboton222,producto2.precio_boton222compra,
                                                boton2.id_boton2,boton2.insumo AS insumo_boton22,boton2.id_proveedor, proveedor.nombre AS nombre_boton22
                                                FROM producto2
                                                LEFT JOIN boton2 ON producto2.id_boton222 = boton2.id_boton2
                                                LEFT JOIN proveedor ON boton2.id_proveedor = proveedor.id_proveedor
                                                WHERE boton2.id_boton2 = '$id_boton222'
                                            ";

                                    $resultado_boton2_homologacion = mysqli_query($enlace, $consulta_boton2);
                                    $filaboton2 = mysqli_fetch_array($resultado_boton2_homologacion);
                                }
                                ?>

                                <?php if (empty($fila['id_boton222']) && empty($fila['dif_und_boton2']) && empty($fila['dif_total_boton2']) && !(isset($fila['orden_compraboton2']) && strlen($fila['orden_compraboton2']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_boton2" value="<?php echo $fila['precio_boton2']; ?>">
                                            <input type="hidden" name="precio_boton2compra" value="<?php echo $fila['precio_boton2compra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_boton2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_boton2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton2']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton2']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_boton2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_boton2cotizado" id="total_boton2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_boton2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_boton2compra" id="total_boton2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_botoninv22" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_botoncom22" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarBoton2<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-boton2="<?php echo $fila['id_boton2']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_boton222']) && empty($fila['dif_und_boton2']) && empty($fila['dif_total_boton2']) && !(isset($fila['orden_compraboton2']) && strlen($fila['orden_compraboton2']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_boton222" value="<?php echo $filaboton2['precio_boton222']; ?>">
                                            <input type="hidden" name="precio_boton222compra" value="<?php echo $filaboton2['precio_boton222compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Boton Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_boton2']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filaboton2['insumo_boton22']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_boton2']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filaboton2['nombre_boton22']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton2']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaboton2['cant_boton222']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton222'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton2']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaboton2['consumo_totalboton222']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_boton2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_boton2cotizado" id="total_boton2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_boton2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_boton2compra" id="total_boton2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_botoninv222" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_botoncom222" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_boton2']) || !empty($fila['dif_total_boton2'])) && !(isset($fila['orden_compraboton2']) && strlen($fila['orden_compraboton2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Botón Cotizada:</strong> <?= htmlspecialchars($fila['insumo_boton2']); ?><?php if (!empty($filaboton2['insumo_boton22'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaboton2['insumo_boton22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_boton2']); ?><?php if (!empty($filaboton2['nombre_boton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['nombre_boton22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_boton2']); ?> Und<?php if (!empty($filaboton2['cant_boton222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['cant_boton222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton222'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton222'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalboton2']); ?> Und<?php if (!empty($filaboton2['consumo_totalboton222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['consumo_totalboton222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton222compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_boton2cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_boton2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_boton2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_boton2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_boton2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_boton2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra6<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_boton2']) || !empty($fila['dif_total_boton2'])) || (isset($fila['orden_compraboton2']) && strlen($fila['orden_compraboton2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Botón Cotizada:</strong> <?= htmlspecialchars($fila['insumo_boton2']); ?><?php if (!empty($filaboton2['insumo_boton22'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaboton2['insumo_boton22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_boton2']); ?><?php if (!empty($filaboton2['nombre_boton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['nombre_boton22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_boton2']); ?> Und<?php if (!empty($filaboton2['cant_boton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['cant_boton2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalboton2']); ?> Und<?php if (!empty($filaboton2['consumo_totalboton22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaboton2['consumo_totalboton22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaboton2['precio_boton22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_boton2cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_boton2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_boton2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_boton2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_boton2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_boton2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraboton2']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra6<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra - Botón 2</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_boton2" enctype="multipart/form-data">
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
                                                                name="orden_compraboton2"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput6<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile6(this, 'excelPreview6<?= $fila['id_producto']; ?>', 'fileNameExcel6_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput6<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview6<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraboton2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraboton2']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraboton2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraboton2']) ? 'orden_compraboton2/' . $fila['orden_compraboton2'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel6_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraboton2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraboton2']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraboton2']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraboton2" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarBoton2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_boton2" value="<?php echo $fila['id_boton2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_boton2_actual = $fila['id_boton2']; ?>
                                                    <select name="id_boton2" class="form-select" id="id_boton2" onchange="togglePrecioBoton2(this)">
                                                        <?php $consulta_mysql = 'select id_boton2, insumo, precio from boton2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_boton2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_boton2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_boton2" id="precio_boton2" value="<?php echo isset($fila['precio_boton2']) && $fila['precio_boton2'] !== '' ? $fila['precio_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_boton2" value="<?php echo isset($fila['cant_boton2']) && $fila['cant_boton2'] !== '' ? $fila['cant_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_boton2" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Cremarella 1 -->
                            <?php if (!empty($fila['id_cremallera'])): ?>
                                <?php
                                $id_cremallera = $fila['id_cremallera'];
                                $id_cremallera22 = !empty($fila['id_cremallera22']) ? $fila['id_cremallera22'] : null;

                                $consulta_5 = "SELECT producto.id_cremallera, producto.cant_cremallera, producto.precio_cremallera, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, cremallera.id_proveedor, 
                                                            proveedor.nombre AS nombre_cremallera FROM producto 
                                                            LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera 
                                                            LEFT JOIN proveedor ON cremallera.id_proveedor = proveedor.id_proveedor 
                                                            WHERE cremallera.id_cremallera = '$id_cremallera'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_cremallera22
                                $filacremallera2 = null;
                                if (!empty($id_cremallera22)) {
                                    $consulta_cremallera2 = "SELECT producto2.id_producto2, producto2.id_cremallera22, producto2.precio_cremallera22, producto2.cant_cremallera22, producto2.valor_cremallera22, producto2.consumo_totalcremallera22, 
                                                                        producto2.precio_cremallera22compra, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera2, cremallera.id_proveedor, proveedor.nombre AS nombre_cremallera2 FROM producto2 
                                                                        LEFT JOIN cremallera ON producto2.id_cremallera22 = cremallera.id_cremallera
                                                                        LEFT JOIN proveedor ON cremallera.id_proveedor = proveedor.id_proveedor 
                                                                        WHERE cremallera.id_cremallera = '$id_cremallera22'";

                                    $resultado_cremallera2 = mysqli_query($enlace, $consulta_cremallera2);
                                    $filacremallera2 = mysqli_fetch_array($resultado_cremallera2);
                                }
                                ?>

                                <?php if (empty($fila['id_cremallera22']) && empty($fila['dif_und_cremallera']) && empty($fila['dif_total_cremallera']) && !(isset($fila['orden_compracremallera']) && strlen($fila['orden_compracremallera']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_cremallera" value="<?php echo $fila['precio_cremallera']; ?>">
                                            <input type="hidden" name="precio_cremalleracompra" value="<?php echo $fila['precio_cremalleracompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_cremallera']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_cremallera']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremalleracompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremalleracotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremalleracotizado" id="total_cremalleracotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremalleracompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremalleracompra" id="total_cremalleracompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_cremallerainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_cremalleracom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarCremallera<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-cremallera="<?php echo $fila['id_cremallera']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_cremallera22']) && empty($fila['dif_und_cremallera']) && empty($fila['dif_total_cremallera']) && !(isset($fila['orden_compracremallera']) && strlen($fila['orden_compracremallera']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_cremallera22" value="<?php echo $filacremallera2['precio_cremallera22']; ?>">
                                            <input type="hidden" name="precio_cremallera22compra" value="<?php echo $filacremallera2['precio_cremallera22compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Cremallera Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_cremallera']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filacremallera2['insumo_cremallera2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_cremallera']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['nombre_cremallera2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['cant_cremallera22']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['consumo_totalcremallera22']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremalleracompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremalleracotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremalleracotizado" id="total_cremalleracotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremalleracompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremalleracompra" id="total_cremalleracompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_cremallerainv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_cremalleracom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_cremallera']) || !empty($fila['dif_total_cremallera'])) && !(isset($fila['orden_compracremallera']) && strlen($fila['orden_compracremallera']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cremallera Cotizada:</strong> <?= htmlspecialchars($fila['insumo_cremallera']); ?><?php if (!empty($filacremallera2['insumo_cremallera2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filacremallera2['insumo_cremallera2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_cremallera']); ?><?php if (!empty($filacremallera2['nombre_cremallera2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera2['nombre_cremallera2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_cremallera']); ?> Und<?php if (!empty($filacremallera2['cant_cremallera22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera2['cant_cremallera22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera2['precio_cremallera22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalcremallera']); ?> Und<?php if (!empty($filacremallera2['consumo_totalcremallera22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera2['consumo_totalcremallera22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremalleracompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera2['precio_cremallera22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremalleracotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremalleracompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_cremallera'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_cremallera'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_cremallera'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_cremallera'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra7<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_cremallera']) || !empty($fila['dif_total_cremallera'])) || (isset($fila['orden_compracremallera']) && strlen($fila['orden_compracremallera']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cremallera Cotizada:</strong> <?= htmlspecialchars($fila['insumo_cremallera']); ?><?php if (!empty($filacremallera2['insumo_cremallera2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filacremallera2['insumo_cremallera2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_cremallera']); ?><?php if (!empty($filacremallera2['nombre_cremallera2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera2['nombre_cremallera2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_cremallera']); ?> Und<?php if (!empty($filacremallera2['cant_cremallera22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera2['cant_cremallera22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera2['precio_cremallera22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalcremallera']); ?> Und<?php if (!empty($filacremallera2['consumo_totalcremallera22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera2['consumo_totalcremallera22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremalleracompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera2['precio_cremallera22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremalleracotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremalleracompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_cremallera'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_cremallera'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_cremallera'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_cremallera'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compracremallera']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra7<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra - Cremallera</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_cremallera" enctype="multipart/form-data">
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
                                                                name="orden_compracremallera"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput7<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile7(this, 'excelPreview7<?= $fila['id_producto']; ?>', 'fileNameExcel7_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput7<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview7<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compracremallera']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracremallera']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compracremallera']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracremallera']) ? 'orden_compracremallera/' . $fila['orden_compracremallera'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel7_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compracremallera']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracremallera']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compracremallera']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compracremallera" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarCremallera<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_cremallera" value="<?php echo $fila['id_cremallera']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_cremallera_actual = $fila['id_cremallera']; ?>
                                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_cremallera"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_cremallera_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_cremallera" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Cremarella 2 -->
                            <?php if (!empty($fila['id_cremallera2'])): ?>
                                <?php
                                $id_cremallera2 = $fila['id_cremallera2'];
                                $id_cremallera222 = !empty($fila['id_cremallera222']) ? $fila['id_cremallera222'] : null;

                                $consulta_5 = "SELECT producto.id_cremallera2, producto.cant_cremallera2, producto.precio_cremallera2, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, cremallera2.id_proveedor, 
                                                            proveedor.nombre AS nombre_cremallera2 FROM producto 
                                                            LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 
                                                            LEFT JOIN proveedor ON cremallera2.id_proveedor = proveedor.id_proveedor 
                                                            WHERE cremallera2.id_cremallera2 = '$id_cremallera2'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_cremallera222
                                $filacremallera22 = null;
                                if (!empty($id_cremallera222)) {
                                    $consulta_cremallera22 = "SELECT producto2.id_producto2, producto2.id_cremallera222, producto2.precio_cremallera222, producto2.cant_cremallera222, producto2.valor_cremallera222, producto2.consumo_totalcremallera222, 
                                                                        producto2.precio_cremallera222compra, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera22, cremallera2.id_proveedor, proveedor.nombre AS nombre_cremallera22 FROM producto2 
                                                                        LEFT JOIN cremallera2 ON producto2.id_cremallera222 = cremallera2.id_cremallera2
                                                                        LEFT JOIN proveedor ON cremallera2.id_proveedor = proveedor.id_proveedor 
                                                                        WHERE cremallera2.id_cremallera2 = '$id_cremallera222'";

                                    $resultado_cremallera22 = mysqli_query($enlace, $consulta_cremallera22);
                                    $filacremallera22 = mysqli_fetch_array($resultado_cremallera22);
                                }
                                ?>

                                <?php if (empty($fila['id_cremallera222']) && empty($fila['dif_und_cremallera2']) && empty($fila['dif_total_cremallera2']) && !(isset($fila['orden_compracremallera2']) && strlen($fila['orden_compracremallera2']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_cremallera2" value="<?php echo $fila['precio_cremallera2']; ?>">
                                            <input type="hidden" name="precio_cremallera2compra" value="<?php echo $fila['precio_cremallera2compra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_cremallera2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_cremallera2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera2']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera2']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremallera2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremallera2cotizado" id="total_cremallera2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremallera2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremallera2compra" id="total_cremallera2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_cremallerainv22" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_cremalleracom22" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarCremallera2<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-cremallera2="<?php echo $fila['id_cremallera2']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_cremallera222']) && empty($fila['dif_und_cremallera2']) && empty($fila['dif_total_cremallera2']) && !(isset($fila['orden_compracremallera2']) && strlen($fila['orden_compracremallera2']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_cremallera222" value="<?php echo $filacremallera22['precio_cremallera222']; ?>">
                                            <input type="hidden" name="precio_cremallera222compra" value="<?php echo $filacremallera22['precio_cremallera222compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Cremallera2 Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_cremallera2']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filacremallera22['insumo_cremallera22']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_cremallera2']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filacremallera22['nombre_cremallera22']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera2']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filacremallera22['cant_cremallera222']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filacremallera22['precio_cremallera222'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera2']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filacremallera22['consumo_totalcremallera222']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filacremallera22['precio_cremallera222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremallera2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremallera2cotizado" id="total_cremallera2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cremallera2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cremallera2compra" id="total_cremallera2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_cremallerainv222" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_cremalleracom222" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_cremallera2']) || !empty($fila['dif_total_cremallera2'])) && !(isset($fila['orden_compracremallera2']) && strlen($fila['orden_compracremallera2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cremallera2 Cotizada:</strong> <?= htmlspecialchars($fila['insumo_cremallera2']); ?><?php if (!empty($filacremallera22['insumo_cremallera22'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filacremallera22['insumo_cremallera22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_cremallera2']); ?><?php if (!empty($filacremallera22['nombre_cremallera22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera22['nombre_cremallera22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_cremallera2']); ?> Und<?php if (!empty($filacremallera22['cant_cremallera222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera22['cant_cremallera222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera22['precio_cremallera222'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera22['precio_cremallera222'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalcremallera2']); ?> Und<?php if (!empty($filacremallera22['consumo_totalcremallera222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera22['consumo_totalcremallera222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera22['precio_cremallera222compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera22['precio_cremallera222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremallera2cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremallera2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_cremallera2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_cremallera2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_cremallera2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_cremallera2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra8<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_cremallera2']) || !empty($fila['dif_total_cremallera2'])) || (isset($fila['orden_compracremallera2']) && strlen($fila['orden_compracremallera2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cremallera2 Cotizada:</strong> <?= htmlspecialchars($fila['insumo_cremallera2']); ?><?php if (!empty($filacremallera22['insumo_cremallera22'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filacremallera22['insumo_cremallera22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_cremallera2']); ?><?php if (!empty($filacremallera22['nombre_cremallera22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera22['nombre_cremallera22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_cremallera2']); ?> Und<?php if (!empty($filacremallera22['cant_cremallera222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera22['cant_cremallera222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera22['precio_cremallera222'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera22['precio_cremallera222'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalcremallera2']); ?> Und<?php if (!empty($filacremallera22['consumo_totalcremallera222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacremallera22['consumo_totalcremallera222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacremallera22['precio_cremallera222compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera22['precio_cremallera222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremallera2cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cremallera2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_cremallera2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_cremallera2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_cremallera2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_cremallera2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compracremallera2']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra8<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra - Cremallera 2</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_cremallera2" enctype="multipart/form-data">
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
                                                                name="orden_compracremallera2"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput8<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile8(this, 'excelPreview8<?= $fila['id_producto']; ?>', 'fileNameExcel8_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput8<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview8<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compracremallera2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracremallera2']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compracremallera2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracremallera2']) ? 'orden_compracremallera2/' . $fila['orden_compracremallera2'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel8_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compracremallera2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracremallera2']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compracremallera2']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compracremallera2" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarCremallera2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera 2</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_cremallera2" value="<?php echo $fila['id_cremallera2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_cremallera2_actual = $fila['id_cremallera2']; ?>
                                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera(this)">
                                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_cremallera2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_cremallera2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_cremallera2" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Resorte 1 -->
                            <?php if (!empty($fila['id_resorte'])): ?>
                                <?php
                                $id_resorte = $fila['id_resorte'];
                                $id_resorte22 = !empty($fila['id_resorte22']) ? $fila['id_resorte22'] : null;

                                $consulta_5 = "SELECT producto.id_resorte, producto.cant_resorte, producto.precio_resorte, resorte.id_resorte, resorte.insumo AS insumo_resorte, resorte.id_proveedor, 
                                                            proveedor.nombre AS nombre_resorte FROM producto 
                                                            LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
                                                            LEFT JOIN proveedor ON resorte.id_proveedor = proveedor.id_proveedor 
                                                            WHERE resorte.id_resorte = '$id_resorte'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_resorte22
                                $filaresorte2 = null;
                                if (!empty($id_resorte22)) {
                                    $consulta_resorte2 = "SELECT producto2.id_producto2, producto2.id_resorte22, producto2.precio_resorte22, producto2.cant_resorte22, producto2.valor_resorte22, producto2.consumo_totalresorte22, 
                                                                    producto2.precio_resorte22compra, resorte.id_resorte, resorte.insumo AS insumo_resorte2, resorte.id_proveedor, proveedor.nombre AS nombre_resorte2 FROM producto2 
                                                                    LEFT JOIN resorte ON producto2.id_resorte22 = resorte.id_resorte
                                                                    LEFT JOIN proveedor ON resorte.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE resorte.id_resorte = '$id_resorte22'";

                                    $resultado_resorte2 = mysqli_query($enlace, $consulta_resorte2);
                                    $filaresorte2 = mysqli_fetch_array($resultado_resorte2);
                                }
                                ?>

                                <?php if (empty($fila['id_resorte22']) && empty($fila['dif_und_resorte']) && empty($fila['dif_total_resorte']) && !(isset($fila['orden_compraresorte']) && strlen($fila['orden_compraresorte']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_resorte" value="<?php echo $fila['precio_resorte']; ?>">
                                            <input type="hidden" name="precio_resortecompra" value="<?php echo $fila['precio_resortecompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_resorte']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_resorte']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resortecompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_resortecotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resortecotizado" id="total_resortecotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_resortecompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resortecompra" id="total_resortecompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_resorteinv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_resortecom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarResorte<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-resorte="<?php echo $fila['id_resorte']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_resorte22']) && empty($fila['dif_und_resorte']) && empty($fila['dif_total_resorte']) && !(isset($fila['orden_compraresorte']) && strlen($fila['orden_compraresorte']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_resorte22" value="<?php echo $filaresorte2['precio_resorte22']; ?>">
                                            <input type="hidden" name="precio_resorte22compra" value="<?php echo $filaresorte2['precio_resorte22compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Resorte Cotizado: </strong><?php echo htmlspecialchars($fila['insumo_resorte']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filaresorte2['insumo_resorte2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_resorte']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['nombre_resorte2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['cant_resorte22']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['consumo_totalresorte22']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resortecompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_resortecotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resortecotizado" id="total_resortecotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_resortecompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resortecompra" id="total_resortecompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_resorteinv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_resortecom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_resorte']) || !empty($fila['dif_total_resorte'])) && !(isset($fila['orden_compraresorte']) && strlen($fila['orden_compraresorte']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Resorte Cotizado:</strong> <?= htmlspecialchars($fila['insumo_resorte']); ?><?php if (!empty($filaresorte2['insumo_resorte2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaresorte2['insumo_resorte2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_resorte']); ?><?php if (!empty($filaresorte2['nombre_resorte2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte2['nombre_resorte2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_resorte']); ?> Und<?php if (!empty($filaresorte2['cant_resorte22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte2['cant_resorte22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte2['precio_resorte22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalresorte']); ?> Und<?php if (!empty($filaresorte2['consumo_totalresorte22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte2['consumo_totalresorte22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resortecompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte2['precio_resorte22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resortecotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resortecompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_resorte'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_resorte'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_resorte'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_resorte'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra9<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_resorte']) || !empty($fila['dif_total_resorte'])) || (isset($fila['orden_compraresorte']) && strlen($fila['orden_compraresorte']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Resorte Cotizado:</strong> <?= htmlspecialchars($fila['insumo_resorte']); ?><?php if (!empty($filaresorte2['insumo_resorte2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaresorte2['insumo_resorte2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_resorte']); ?><?php if (!empty($filaresorte2['nombre_resorte2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte2['nombre_resorte2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_resorte']); ?> Und<?php if (!empty($filaresorte2['cant_resorte22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte2['cant_resorte22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte2['precio_resorte22'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalresorte']); ?> Und<?php if (!empty($filaresorte2['consumo_totalresorte22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte2['consumo_totalresorte22']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resortecompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte2['precio_resorte22compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resortecotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resortecompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_resorte'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_resorte'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_resorte'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_resorte'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraresorte']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra9<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra - Resorte</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_resorte" enctype="multipart/form-data">
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
                                                                name="orden_compraresorte"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput9<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile9(this, 'excelPreview9<?= $fila['id_producto']; ?>', 'fileNameExcel9_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput9<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview9<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraresorte']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraresorte']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraresorte']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraresorte']) ? 'orden_compraresorte/' . $fila['orden_compraresorte'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel9_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraresorte']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraresorte']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraresorte']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraresorte" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarResorte<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Resorte</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_resorte" value="<?php echo $fila['id_resorte']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                                    <?php $id_resorte_actual = $fila['id_resorte']; ?>
                                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_resorte, insumo, precio FROM resorte';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_resorte"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_resorte_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_resorte" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Resorte 2 -->
                            <?php if (!empty($fila['id_resorte2'])): ?>
                                <?php
                                $id_resorte2 = $fila['id_resorte2'];
                                $id_resorte222 = !empty($fila['id_resorte222']) ? $fila['id_resorte222'] : null;

                                $consulta_5 = "SELECT producto.id_resorte2, producto.cant_resorte2, producto.precio_resorte2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, resorte2.id_proveedor, 
                                                            proveedor.nombre AS nombre_resorte2 FROM producto 
                                                            LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2 
                                                            LEFT JOIN proveedor ON resorte2.id_proveedor = proveedor.id_proveedor 
                                                            WHERE resorte2.id_resorte2 = '$id_resorte2'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_resorte222
                                $filaresorte22 = null;
                                if (!empty($id_resorte222)) {
                                    $consulta_resorte22 = "SELECT producto2.id_producto2, producto2.id_resorte222, producto2.precio_resorte222, producto2.cant_resorte222, producto2.valor_resorte222, producto2.consumo_totalresorte222, 
                                                                    producto2.precio_resorte222compra, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte22, resorte2.id_proveedor, proveedor.nombre AS nombre_resorte22 FROM producto2 
                                                                    LEFT JOIN resorte2 ON producto2.id_resorte222 = resorte2.id_resorte2
                                                                    LEFT JOIN proveedor ON resorte2.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE resorte2.id_resorte2 = '$id_resorte222'";

                                    $resultado_resorte22 = mysqli_query($enlace, $consulta_resorte22);
                                    $filaresorte22 = mysqli_fetch_array($resultado_resorte22);
                                }
                                ?>

                                <?php if (empty($fila['id_resorte222']) && empty($fila['dif_und_resorte2']) && empty($fila['dif_total_resorte2']) && !(isset($fila['orden_compraresorte2']) && strlen($fila['orden_compraresorte2']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_resorte2" value="<?php echo $fila['precio_resorte2']; ?>">
                                            <input type="hidden" name="precio_resorte2compra" value="<?php echo $fila['precio_resorte2compra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_resorte2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_resorte2']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte2']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte2']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_resorte2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resorte2cotizado" id="total_resorte2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_resorte2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resorte2compra" id="total_resorte2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_resorteinv22" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_resortecom22" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarResorte2<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-resorte2="<?php echo $fila['id_resorte2']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_resorte222']) && empty($fila['dif_und_resorte2']) && empty($fila['dif_total_resorte2']) && !(isset($fila['orden_compraresorte2']) && strlen($fila['orden_compraresorte2']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_resorte222" value="<?php echo $filaresorte22['precio_resorte222']; ?>">
                                            <input type="hidden" name="precio_resorte222compra" value="<?php echo $filaresorte22['precio_resorte222compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Resorte2 Cotizado: </strong><?php echo htmlspecialchars($fila['insumo_resorte2']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filaresorte22['insumo_resorte22']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_resorte2']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filaresorte22['nombre_resorte22']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte2']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaresorte22['cant_resorte222']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaresorte22['precio_resorte222'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte2']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filaresorte22['consumo_totalresorte222']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filaresorte22['precio_resorte222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_resorte2cotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resorte2cotizado" id="total_resorte2cotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_resorte2compra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_resorte2compra" id="total_resorte2compra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_resorteinv222" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_resortecom222" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_resorte2']) || !empty($fila['dif_total_resorte2'])) && !(isset($fila['orden_compraresorte2']) && strlen($fila['orden_compraresorte2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Resorte2 Cotizado:</strong> <?= htmlspecialchars($fila['insumo_resorte2']); ?><?php if (!empty($filaresorte22['insumo_resorte22'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaresorte22['insumo_resorte22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_resorte2']); ?><?php if (!empty($filaresorte22['nombre_resorte22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte22['nombre_resorte22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_resorte2']); ?> Und<?php if (!empty($filaresorte22['cant_resorte222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte22['cant_resorte222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte22['precio_resorte222'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte22['precio_resorte222'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalresorte2']); ?> Und<?php if (!empty($filaresorte22['consumo_totalresorte222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte22['consumo_totalresorte222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte22['precio_resorte222compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte22['precio_resorte222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resorte2cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resorte2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_resorte2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_resorte2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_resorte2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_resorte2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra10<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_resorte2']) || !empty($fila['dif_total_resorte2'])) || (isset($fila['orden_compraresorte2']) && strlen($fila['orden_compraresorte2']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Resorte2 Cotizado:</strong> <?= htmlspecialchars($fila['insumo_resorte2']); ?><?php if (!empty($filaresorte22['insumo_resorte22'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filaresorte22['insumo_resorte22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_resorte2']); ?><?php if (!empty($filaresorte22['nombre_resorte22'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte22['nombre_resorte22']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_resorte2']); ?> Und<?php if (!empty($filaresorte22['cant_resorte222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte22['cant_resorte222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte22['precio_resorte222'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte22['precio_resorte222'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalresorte2']); ?> Und<?php if (!empty($filaresorte22['consumo_totalresorte222'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filaresorte22['consumo_totalresorte222']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filaresorte22['precio_resorte222compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte22['precio_resorte222compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resorte2cotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_resorte2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_resorte2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_resorte2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_resorte2'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_resorte2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraresorte2']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra10<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra - Resorte 2</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_resorte2" enctype="multipart/form-data">
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
                                                                name="orden_compraresorte2"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput10<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile10(this, 'excelPreview10<?= $fila['id_producto']; ?>', 'fileNameExcel10_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput10<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview10<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraresorte2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraresorte2']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraresorte2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraresorte2']) ? 'orden_compraresorte2/' . $fila['orden_compraresorte2'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel10_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraresorte2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraresorte2']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraresorte2']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compraresorte2" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarResorte2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Resorte</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_resorte2" value="<?php echo $fila['id_resorte2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                                    <?php $id_resorte2_actual = $fila['id_resorte2']; ?>
                                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_resorte2, insumo, precio FROM resorte2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_resorte2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_resorte2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_resorte2" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Cinta -->
                            <?php if (!empty($fila['id_cinta'])): ?>
                                <?php
                                $id_cinta = $fila['id_cinta'];
                                $id_cinta2 = !empty($fila['id_cinta2']) ? $fila['id_cinta2'] : null;

                                $consulta_5 = "SELECT producto.id_cinta, producto.cant_cinta, producto.precio_cinta, cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_cinta, cinta_reflectiva.id_proveedor, proveedor.nombre AS nombre_cinta 
                                                        FROM producto 
                                                        LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta 
                                                        LEFT JOIN proveedor ON cinta_reflectiva.id_proveedor = proveedor.id_proveedor 
                                                        WHERE cinta_reflectiva.id_cinta = '$id_cinta'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_cinta2
                                $filacinta2 = null;
                                if (!empty($id_cinta2)) {
                                    $consulta_cinta2 = "SELECT producto2.id_producto2, producto2.id_cinta2, producto2.precio_cinta2, producto2.cant_cinta2, producto2.valor_cinta2, producto2.consumo_totalcinta2, 
                                                                    producto2.precio_cinta2compra, cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_cinta2, cinta_reflectiva.id_proveedor, proveedor.nombre AS nombre_cinta2 FROM producto2 
                                                                    LEFT JOIN cinta_reflectiva ON producto2.id_cinta2 = cinta_reflectiva.id_cinta
                                                                    LEFT JOIN proveedor ON cinta_reflectiva.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE cinta_reflectiva.id_cinta = '$id_cinta2'";

                                    $resultado_cinta2 = mysqli_query($enlace, $consulta_cinta2);
                                    $filacinta2 = mysqli_fetch_array($resultado_cinta2);
                                }
                                ?>

                                <?php if (empty($fila['id_cinta2']) && empty($fila['dif_und_cinta']) && empty($fila['dif_total_cinta']) && !(isset($fila['orden_compracinta']) && strlen($fila['orden_compracinta']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_cinta" value="<?php echo $fila['precio_cinta']; ?>">
                                            <input type="hidden" name="precio_cintacompra" value="<?php echo $fila['precio_cintacompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['insumo_cinta']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_cinta']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cinta']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcinta']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cintacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cintacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cintacotizado" id="total_cintacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cintacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cintacompra" id="total_cintacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_cintainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_cintacom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarCinta<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-cinta="<?php echo $fila['id_cinta']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_cinta2']) && empty($fila['dif_und_cinta']) && empty($fila['dif_total_cinta']) && !(isset($fila['orden_compracinta']) && strlen($fila['orden_compracinta']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_cinta2" value="<?php echo $filacinta2['precio_cinta2']; ?>">
                                            <input type="hidden" name="precio_cinta2compra" value="<?php echo $filacinta2['precio_cinta2compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Cinta Cotizada: </strong><?php echo htmlspecialchars($fila5['insumo_cinta']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filacinta2['insumo_cinta2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_cinta']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filacinta2['nombre_cinta2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cinta']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filacinta2['cant_cinta2']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcinta']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filacinta2['consumo_totalcinta2']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cintacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_cintacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cintacotizado" id="total_cintacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_cintacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_cintacompra" id="total_cintacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_cintainv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_cintacom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_cinta']) || !empty($fila['dif_total_cinta'])) && !(isset($fila['orden_compracinta']) && strlen($fila['orden_compracinta']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cinta Cotizada:</strong> <?= htmlspecialchars($fila5['insumo_cinta']); ?><?php if (!empty($filacinta2['insumo_cinta2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filacinta2['insumo_cinta2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_cinta']); ?><?php if (!empty($filacinta2['nombre_cinta2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacinta2['nombre_cinta2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_cinta']); ?> Und<?php if (!empty($filacinta2['cant_cinta2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacinta2['cant_cinta2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacinta2['precio_cinta2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalcinta']); ?> Und<?php if (!empty($filacinta2['consumo_totalcinta2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacinta2['consumo_totalcinta2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cintacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacinta2['precio_cinta2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cintacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cintacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_cinta'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_cinta'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_cinta'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_cinta'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra11<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_cinta']) || !empty($fila['dif_total_cinta'])) || (isset($fila['orden_compracinta']) && strlen($fila['orden_compracinta']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cinta Cotizada:</strong> <?= htmlspecialchars($fila5['insumo_cinta']); ?><?php if (!empty($filacinta2['insumo_cinta2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filacinta2['insumo_cinta2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_cinta']); ?><?php if (!empty($filacinta2['nombre_cinta2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacinta2['nombre_cinta2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_cinta']); ?> Und<?php if (!empty($filacinta2['cant_cinta2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacinta2['cant_cinta2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacinta2['precio_cinta2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalcinta']); ?> Und<?php if (!empty($filacinta2['consumo_totalcinta2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filacinta2['consumo_totalcinta2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cintacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filacinta2['precio_cinta2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cintacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_cintacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_cinta'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_cinta'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_cinta'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_cinta'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compracinta']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra11<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalCintaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="modalCintaLabel">Cargar Orden de Compra - Cinta</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_cinta" enctype="multipart/form-data">
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
                                                                name="orden_compracinta"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput11<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile11(this, 'excelPreview11<?= $fila['id_producto']; ?>', 'fileNameExcel11_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput11<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview11<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compracinta']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracinta']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compracinta']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracinta']) ? 'orden_compracinta/' . $fila['orden_compracinta'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel11_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compracinta']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compracinta']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compracinta']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compracinta" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarCinta<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cinta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_cinta" value="<?php echo $fila['id_cinta']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta:</label>
                                                    <?php $id_cinta_actual = $fila['id_cinta']; ?>
                                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_cinta, insumo, precio FROM cinta_reflectiva';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_cinta"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_cinta_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_cinta" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Faya -->
                            <?php if (!empty($fila['id_faya'])): ?>
                                <?php
                                $id_faya = $fila['id_faya'];
                                $id_faya2 = !empty($fila['id_faya2']) ? $fila['id_faya2'] : null;

                                $consulta_5 = "SELECT producto.id_faya, producto.cant_faya, producto.precio_faya, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, cinta_faya.id_proveedor, proveedor.nombre AS nombre_faya 
                                                        FROM producto 
                                                        LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya 
                                                        LEFT JOIN proveedor ON cinta_faya.id_proveedor = proveedor.id_proveedor 
                                                        WHERE cinta_faya.id_faya = '$id_faya'";

                                $resultado_5 = mysqli_query($enlace, $consulta_5);
                                $fila5 = mysqli_fetch_array($resultado_5);

                                // Consulta de homologación SOLO si existe id_faya2
                                $filafaya2 = null;
                                if (!empty($id_faya2)) {
                                    $consulta_faya2 = "SELECT producto2.id_producto2, producto2.id_faya2, producto2.precio_faya2, producto2.cant_faya2, producto2.valor_faya2, producto2.consumo_totalfaya2, 
                                                                    producto2.precio_faya2compra, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya2, cinta_faya.id_proveedor, proveedor.nombre AS nombre_faya2 
                                                            FROM producto2 
                                                            LEFT JOIN cinta_faya ON producto2.id_faya2 = cinta_faya.id_faya
                                                            LEFT JOIN proveedor ON cinta_faya.id_proveedor = proveedor.id_proveedor 
                                                            WHERE cinta_faya.id_faya = '$id_faya2'";

                                    $resultado_faya2 = mysqli_query($enlace, $consulta_faya2);
                                    $filafaya2 = mysqli_fetch_array($resultado_faya2);
                                }
                                ?>

                                <?php if (empty($fila['id_faya2']) && empty($fila['dif_und_faya']) && empty($fila['dif_total_faya']) && !(isset($fila['orden_comprafaya']) && strlen($fila['orden_comprafaya']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_faya" value="<?php echo $fila['precio_faya']; ?>">
                                            <input type="hidden" name="precio_fayacompra" value="<?php echo $fila['precio_fayacompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['insumo_faya']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_faya']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_faya']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalfaya']); ?> Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_fayacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_fayacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_fayacotizado" id="total_fayacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_fayacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_fayacompra" id="total_fayacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_fayainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_fayacom" class="btn btn-danger btn-block mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                        </form>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarFaya<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-faya="<?php echo $fila['id_faya']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar
                                        </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_faya2']) && empty($fila['dif_und_faya']) && empty($fila['dif_total_faya']) && !(isset($fila['orden_comprafaya']) && strlen($fila['orden_comprafaya']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_faya2" value="<?php echo $filafaya2['precio_faya2']; ?>">
                                            <input type="hidden" name="precio_faya2compra" value="<?php echo $filafaya2['precio_faya2compra']; ?>">

                                            <td class="text-center align-middle">
                                                <strong>Faya Cotizada: </strong><?php echo htmlspecialchars($fila5['insumo_faya']); ?>
                                                <hr class="my-2">
                                                <strong>Homologación: </strong><?php echo htmlspecialchars($filafaya2['insumo_faya2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre_faya']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filafaya2['nombre_faya2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_faya']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filafaya2['cant_faya2']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalfaya']); ?> Und
                                                <hr class="my-3"><?php echo htmlspecialchars($filafaya2['consumo_totalfaya2']); ?> Und
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_fayacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><input type="text" id="total_fayacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_fayacotizado" id="total_fayacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_fayacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_fayacompra" id="total_fayacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_fayainv2" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_fayacom2" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_faya']) || !empty($fila['dif_total_faya'])) && !(isset($fila['orden_comprafaya']) && strlen($fila['orden_comprafaya']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Faya Cotizada:</strong> <?= htmlspecialchars($fila5['insumo_faya']); ?><?php if (!empty($filafaya2['insumo_faya2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filafaya2['insumo_faya2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_faya']); ?><?php if (!empty($filafaya2['nombre_faya2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filafaya2['nombre_faya2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_faya']); ?> Und<?php if (!empty($filafaya2['cant_faya2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filafaya2['cant_faya2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filafaya2['precio_faya2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalfaya']); ?> Und<?php if (!empty($filafaya2['consumo_totalfaya2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filafaya2['consumo_totalfaya2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_fayacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filafaya2['precio_faya2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_fayacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_fayacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_faya'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_faya'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_faya'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_faya'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra12<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_faya']) || !empty($fila['dif_total_faya'])) || (isset($fila['orden_comprafaya']) && strlen($fila['orden_comprafaya']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Faya Cotizada:</strong> <?= htmlspecialchars($fila5['insumo_faya']); ?><?php if (!empty($filafaya2['insumo_faya2'])): ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong> <?= htmlspecialchars($filafaya2['insumo_faya2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila5['nombre_faya']); ?><?php if (!empty($filafaya2['nombre_faya2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filafaya2['nombre_faya2']); ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['cant_faya']); ?> Und<?php if (!empty($filafaya2['cant_faya2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filafaya2['cant_faya2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filafaya2['precio_faya2'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= htmlspecialchars($fila['consumo_totalfaya']); ?> Und<?php if (!empty($filafaya2['consumo_totalfaya2'])): ?>
                                            <hr class="my-3"><?= htmlspecialchars($filafaya2['consumo_totalfaya2']); ?> Und<?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_fayacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php if (!empty($filafaya2['precio_faya2compra'])): ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?><?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_fayacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_fayacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_faya'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_faya'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_faya'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_faya'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_comprafaya']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra12<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalFayaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="modalFayaLabel">Cargar Orden de Compra - Faya</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_faya" enctype="multipart/form-data">
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
                                                                name="orden_comprafaya"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput12<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile12(this, 'excelPreview12<?= $fila['id_producto']; ?>', 'fileNameExcel12_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput12<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview12<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_comprafaya']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_comprafaya']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_comprafaya']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_comprafaya']) ? 'orden_comprafaya/' . $fila['orden_comprafaya'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel12_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_comprafaya']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_comprafaya']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_comprafaya']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_comprafaya" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarFaya<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title">¿Desea homologar el tipo de Faya?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_faya" value="<?php echo $fila['id_faya']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Faya:</label>
                                                    <?php $id_faya_actual = $fila['id_faya']; ?>
                                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_faya, insumo, precio FROM cinta_faya';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_faya"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_faya_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) ? $fila['precio_faya'] : 0; ?>" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) ? $fila['cant_faya'] : 0; ?>" min="0">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_faya" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- marquilla -->
                            <?php if (!empty($fila['id_marquilla'])): ?>
                                <?php
                                $id_marquilla = $fila['id_marquilla'];

                                $consulta_1000 = "SELECT marquilla.id_marquilla, proveedor.id_proveedor, proveedor.nombre AS proveedor_marquilla FROM marquilla LEFT JOIN proveedor ON marquilla.id_proveedor = proveedor.id_proveedor WHERE marquilla.id_marquilla = '$id_marquilla'";
                                $resultado_1000 = mysqli_query($enlace, $consulta_1000);
                                $fila1000 = mysqli_fetch_array($resultado_1000);
                                ?>

                                <?php if (empty($fila['dif_und_marquilla']) && empty($fila['dif_total_marquilla']) && !(isset($fila['orden_compramarquilla']) && strlen($fila['orden_compramarquilla']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_marquilla" value="<?php echo $fila['precio_marquilla']; ?>">
                                            <input type="hidden" name="precio_marquillacompra" value="<?php echo $fila['precio_marquilla']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_marquilla']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila1000['proveedor_marquilla']); ?></td>
                                            <td class="text-center align-middle">1 Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle">1 Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_marquillacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_marquillacotizado" id="total_marquillacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_marquillacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_marquillacompra" id="total_marquillacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_marquillainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_marquillacom" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_marquilla']) || !empty($fila['dif_total_marquilla'])) && !(isset($fila['orden_compramarquilla']) && strlen($fila['orden_compramarquilla']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_marquilla']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila1000['proveedor_marquilla']); ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_marquillacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_marquillacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_marquilla'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_marquilla'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra13<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_marquilla']) || !empty($fila['dif_total_marquilla'])) || (isset($fila['orden_compramarquilla']) && strlen($fila['orden_compramarquilla']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_marquilla']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila1000['proveedor_marquilla']); ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_marquillacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_marquillacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_marquilla'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_marquilla'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compramarquilla']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra13<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalMarquillaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="modalMarquillaLabel">Cargar Orden de Compra - Marquilla</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_marquilla" enctype="multipart/form-data">
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
                                                                name="orden_compramarquilla"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput13<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile13(this, 'excelPreview13<?= $fila['id_producto']; ?>', 'fileNameExcel13_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput13<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview13<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compramarquilla']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compramarquilla']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compramarquilla']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compramarquilla']) ? 'orden_compramarquilla/' . $fila['orden_compramarquilla'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel13_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compramarquilla']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compramarquilla']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compramarquilla']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_compramarquilla" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- bolsa -->
                            <?php if (!empty($fila['id_bolsa'])): ?>
                                <?php

                                // Bolsa
                                $id_bolsa = $fila['id_bolsa'];

                                $consulta_1001 = "SELECT bolsa.id_bolsa, proveedor.id_proveedor, proveedor.nombre AS proveedor_bolsa FROM bolsa LEFT JOIN proveedor ON bolsa.id_proveedor = proveedor.id_proveedor WHERE bolsa.id_bolsa = '$id_bolsa'";
                                $resultado_1001 = mysqli_query($enlace, $consulta_1001);
                                $fila1001 = mysqli_fetch_array($resultado_1001)
                                ?>
                                <?php if (empty($fila['dif_und_bolsa']) && empty($fila['dif_total_bolsa']) && !(isset($fila['orden_comprabolsa']) && strlen($fila['orden_comprabolsa']) > 0)): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_bolsa" value="<?php echo $fila['precio_bolsa']; ?>">
                                            <input type="hidden" name="precio_bolsacompra" value="<?php echo $fila['precio_bolsa']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_bolsa']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila1001['proveedor_bolsa']); ?></td>
                                            <td class="text-center align-middle">1 Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle">1 Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_bolsacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_bolsacotizado" id="total_bolsacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_bolsacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_bolsacompra" id="total_bolsacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display:inline-block;">
                                                    <button type="submit" name="dif_bolsainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                    <button type="submit" name="dif_bolsacom" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_bolsa']) || !empty($fila['dif_total_bolsa'])) && !(isset($fila['orden_comprabolsa']) && strlen($fila['orden_comprabolsa']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_bolsa']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila1001['proveedor_bolsa']); ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_bolsacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_bolsacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_bolsa'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_bolsa'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra14<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_bolsa']) || !empty($fila['dif_total_bolsa'])) || (isset($fila['orden_comprabolsa']) && strlen($fila['orden_comprabolsa']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_bolsa']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila1001['proveedor_bolsa']); ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_bolsacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_bolsacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_bolsa'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_bolsa'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_comprabolsa']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra14<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBolsaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="modalBolsaLabel">Cargar Orden de Compra - Bolsa</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_bolsa" enctype="multipart/form-data">
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
                                                                name="orden_comprabolsa"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput14<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile14(this, 'excelPreview14<?= $fila['id_producto']; ?>', 'fileNameExcel14_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput14<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview14<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_comprabolsa']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_comprabolsa']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_comprabolsa']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_comprabolsa']) ? 'orden_comprabolsa/' . $fila['orden_comprabolsa'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel14_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_comprabolsa']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_comprabolsa']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_comprabolsa']; ?>
                                                                </span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_orden_comprabolsa" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Prendas Compradas -->
                            <?php if (!empty($fila['nombre_producto'])): ?>
                                <?php if (empty($fila['dif_und_prenda']) && empty($fila['dif_total_prenda'])): ?>
                                    <tr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="precio_compra" value="<?php echo $fila['precio_compra']; ?>">
                                            <input type="hidden" name="precio_prendacompra" value="<?php echo $fila['precio_prendacompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_proveedor']); ?></td>
                                            <td class="text-center align-middle">1 Und</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['suma_prendas']); ?></td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_prendacompra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><input type="text" id="total_prendacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_prendacotizado" id="total_prendacotizado_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"><input type="text" id="total_prendacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center"><input type="hidden" name="total_prendacompra" id="total_prendacompra_<?php echo $fila['id_producto']; ?>"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                                <button type="submit" name="dif_prendainv" class="btn btn-success w-100 mb-2"><i class="bi bi-list-check"></i> En Inventario</button>
                                                <button type="submit" name="dif_prendacom" class="btn btn-danger w-100 mb-2"><i class="bi bi-check2-all"></i> Comprado</button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_prenda']) || !empty($fila['dif_total_prenda'])) && !(isset($fila['orden_compraprenda']) && strlen($fila['orden_compraprenda']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_proveedor']); ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['suma_prendas']); ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_prendacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_prendacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_prendacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_prenda'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_prenda'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_prenda'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_prenda'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra15<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-upload me-1"></i> Cargar Orden
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif ((!empty($fila['dif_und_prenda']) || !empty($fila['dif_total_prenda'])) || (isset($fila['orden_compraprenda']) && strlen($fila['orden_compraprenda']) > 0)): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre_proveedor']); ?></td>
                                        <td class="text-center align-middle">1 Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['suma_prendas']); ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_prendacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_prendacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_prendacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_und_prenda'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_und_prenda'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle <?php echo ($fila['dif_total_prenda'] < 0) ? 'text-danger' : 'text-success'; ?>"><?php $precio_formateado = number_format($fila['dif_total_prenda'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle">
                                            <a href="orden_compra/<?php echo ($fila['orden_compraprenda']); ?>" class="btn btn-success" download> Descargar Orden de Compra <i class="bi bi-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra15<?= $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalPrendaLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="modalPrendaLabel">Cargar Orden de Compra - Prenda</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario_prenda" enctype="multipart/form-data">
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
                                                                name="orden_compraprenda"
                                                                accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx"
                                                                id="excelInput15<?= $fila['id_producto']; ?>"
                                                                onchange="previewFile15(this, 'excelPreview15<?= $fila['id_producto']; ?>', 'fileNameExcel15_<?= $fila['id_producto']; ?>')">

                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput15<?= $fila['id_producto']; ?>" style="max-width: 100%;">
                                                                <i class="bi bi-upload"></i> Seleccionar archivo
                                                            </label>
                                                        </div>

                                                        <div class="mt-3">
                                                            <center>
                                                                <!-- Vista previa si es imagen -->
                                                                <img
                                                                    id="excelPreview15<?= $fila['id_producto']; ?>"
                                                                    class="img-thumbnail shadow-sm"
                                                                    style="max-width: 50%; height: auto; border-radius: 12px; display: <?= empty($fila['orden_compraprenda']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraprenda']) ? 'none' : 'block'; ?>;"
                                                                    src="<?= !empty($fila['orden_compraprenda']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraprenda']) ? 'orden_compraprenda/' . $fila['orden_compraprenda'] : ''; ?>">

                                                                <!-- Nombre del archivo si no es imagen -->
                                                                <span
                                                                    id="fileNameExcel15_<?= $fila['id_producto']; ?>"
                                                                    class="text-muted"
                                                                    style="display: <?= !empty($fila['orden_compraprenda']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['orden_compraprenda']) ? 'block' : 'none'; ?>;">
                                                                    <?= $fila['orden_compraprenda']; ?>
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
                            <!----->
                        </tbody>
                    </table>
                    <br>
                </div>

                <!-- Modal enviar -->
                <div class="modal fade" id="modalenviar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning" role="alert">
                                    Si oprime continuar el producto pasara a Produccion.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                    <button type="submit" name="submit_enviar" class="btn btn-success">continuar</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                // Agrupamos todos los patrones de IDs visibles en un solo selector
                const selector = '[id^="total_"][id*="visible_"]';

                // Selecciona todos los inputs visibles que coinciden con los patrones
                document.querySelectorAll(selector).forEach(function(inputVisible) {
                    inputVisible.addEventListener('input', function() {
                        // Obtiene el ID base para buscar el hidden correspondiente
                        const idBase = this.id.replace('_visible', '');
                        const inputHidden = document.getElementById(idBase);

                        // Elimina puntos y caracteres no numéricos
                        let rawValue = this.value.replace(/\./g, '').replace(/\D/g, '');

                        // Asigna el valor crudo al input oculto
                        inputHidden.value = rawValue;

                        // Si está vacío, limpia el campo visible
                        if (rawValue === '') {
                            this.value = '';
                            return;
                        }

                        // Formatea el número con separador de miles
                        this.value = new Intl.NumberFormat('es-CO').format(rawValue);
                    });
                });
            });
        </script>
        <script>
            function previewFile(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    // Si es imagen, previsualizar
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile2(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile3(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile4(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFileGeneric(input, previewId, fileNameId) {
                const file = input.files[0];
                const preview = document.getElementById(previewId);
                const fileName = document.getElementById(fileNameId);

                if (file) {
                    const fileExt = file.name.split('.').pop().toLowerCase();
                    const validImages = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];

                    if (validImages.includes(fileExt)) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileName.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileName.textContent = file.name;
                        fileName.style.display = 'block';
                    }
                } else {
                    preview.style.display = 'none';
                    fileName.style.display = 'none';
                }
            }
        </script>
        <script>
            function previewFile5(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile6(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile7(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile8(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile9(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile10(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile11(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile12(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile13(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile14(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
        <script>
            function previewFile15(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block';
                    }
                }
            }
        </script>
    </body>
</html>