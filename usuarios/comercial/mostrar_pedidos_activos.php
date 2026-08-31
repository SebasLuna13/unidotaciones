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

    // ============================================================
    // Guarda la curva de tallas + stock en la tabla `tallas` (upsert
    // vía id_talla). Antes esto se guardaba mezclado con ficha_tecnica,
    // pero esas columnas se movieron a la tabla `tallas` dedicada.
    //
    // Por cada talla: unidades_X = talla_X + stock_X
    // Por color (g):  total_tallas{g} = suma de talla{g}_X
    //                 total_stock{g}  = suma de stock{g}_X
    //                 unidades_tela{g} = suma de unidades{g}_X (incluye especial)
    // unidades_totales = suma de unidades_tela1..6
    // ============================================================
    function guardar_curva_tallas_y_stock($enlace, $id_talla_existente)
    {
        $hombre_cols = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial'];
        $dama_cols   = ['4', '6', '8', '10', '12', '14', '16', '18', '20', '22', 'especial'];
        $genero   = $_POST['genero'] ?? '';
        $cols_map = ($genero === 'Hombre') ? $hombre_cols : $dama_cols;

        $colores_post = $_POST['color'] ?? [];
        $num_filas    = min(count($colores_post), 6);

        $tallas_data       = []; // columna => valor, para la tabla `tallas`
        $unidades_totales  = 0;

        for ($j = 0; $j < $num_filas; $j++) {
            $g = $j + 1;
            $prefijo_talla     = ($g == 1) ? 'talla_'    : 'talla' . $g . '_';
            $prefijo_stock     = ($g == 1) ? 'stock_'    : 'stock' . $g . '_';
            $prefijo_unidades  = ($g == 1) ? 'unidades_' : 'unidades' . $g . '_';
            $col_total_tallas  = ($g == 1) ? 'total_tallas'  : 'total_tallas' . $g;
            $col_total_stock   = ($g == 1) ? 'total_stock'   : 'total_stock' . $g;
            $col_unidades_tela = ($g == 1) ? 'unidades_tela' : 'unidades_tela' . $g;

            $suma_talla = 0;
            $suma_stock = 0;
            $suma_unidades = 0;

            for ($i = 0; $i < count($cols_map); $i++) {
                $talla_val  = isset($_POST["cantidad_$i"][$j]) ? intval($_POST["cantidad_$i"][$j]) : 0;
                $stock_val  = isset($_POST["stock_$i"][$j]) ? intval($_POST["stock_$i"][$j]) : 0;
                $unidad_val = $talla_val + $stock_val;

                $key = $cols_map[$i];
                $tallas_data[$prefijo_talla . $key]    = $talla_val;
                $tallas_data[$prefijo_stock . $key]    = $stock_val;
                $tallas_data[$prefijo_unidades . $key] = $unidad_val;

                $suma_talla    += $talla_val;
                $suma_stock    += $stock_val;
                $suma_unidades += $unidad_val;
            }

            $tallas_data[$col_total_tallas]  = $suma_talla;
            $tallas_data[$col_total_stock]   = $suma_stock;
            $tallas_data[$col_unidades_tela] = $suma_unidades;

            $unidades_totales += $suma_unidades;
        }

        $tallas_data['unidades_totales'] = $unidades_totales;

        // UPSERT en la tabla `tallas` (nombres de columna vienen de un mapa fijo, no de POST)
        if (!empty($id_talla_existente)) {
            $sets = [];
            foreach ($tallas_data as $c => $v) {
                $sets[] = "`$c` = " . intval($v);
            }
            $sql = "UPDATE tallas SET " . implode(', ', $sets) . " WHERE id_talla = " . intval($id_talla_existente);
            mysqli_query($enlace, $sql);
            $id_talla_final = intval($id_talla_existente);
        } else {
            $cols = [];
            $vals = [];
            foreach ($tallas_data as $c => $v) {
                $cols[] = "`$c`";
                $vals[] = intval($v);
            }
            $sql = "INSERT INTO tallas (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ")";
            mysqli_query($enlace, $sql);
            $id_talla_final = mysqli_insert_id($enlace);
        }

        return [
            'id_talla'          => $id_talla_final,
            'unidades_totales'  => $unidades_totales,
            'tallas_data'       => $tallas_data,
        ];
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    // Recuperar el id_pedido de la URL
    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    $precio_total = 0;


    if (isset($_POST['cambiar_estado'])) {
        $nit         = $_POST['nit'];
        $id_producto = $_POST['id_producto'];
        $id_usuario  = $_POST['id_usuario'];
        $id_pedido   = $_POST['id_pedido'];

        $consulta_estado = "UPDATE producto SET estado = 'Diseño' WHERE id_producto = $id_producto";
        mysqli_query($enlace, $consulta_estado);

        // ===============================
        // ✅ VERIFICAR SI TODOS LOS PRODUCTOS SON DISEÑO
        // ===============================
        $verificar = mysqli_fetch_assoc(mysqli_query($enlace, "SELECT COUNT(*) total, SUM(estado='Diseño') fichas FROM producto WHERE id_pedido='$id_pedido'"));

        // ===============================
        // 🚦 CAMBIAR ESTADO DEL PEDIDO SI CORRESPONDE
        // ===============================
        if ($verificar['total'] > 0 && $verificar['total'] == $verificar['fichas']) {
            mysqli_query($enlace, "UPDATE pedido SET estado='Pedido' WHERE id_pedido='$id_pedido'");

            $datos = mysqli_fetch_assoc(mysqli_query($enlace, "SELECT p.id_usuario, c.nit  FROM pedido p LEFT JOIN cliente c ON p.nit=c.nit WHERE p.id_pedido='$id_pedido' LIMIT 1"));

            header("Location: pedidos_activos.php?id_usuario={$datos['id_usuario']}");
        } else {
            header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&nit=$nit");
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

    if (isset($_POST['crear_ficha_tecnica'])) {

        $id_producto  = intval($_POST['id_producto']);
        $nit  = intval($_POST['nit']);
        $suma_prendas = intval($_POST['suma_prendas']);

        // Seguridad: sin un id_producto valido no se puede crear la ficha
        // (evita fallos de llave foranea contra la tabla producto).
        if ($id_producto <= 0) {
            header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario");
            exit();
        }

        // ---- Campos de texto de la FICHA TECNICA ----
        $num_ficha           = intval($_POST['num_ficha'] ?? 0);
        $fecha_comercial     = !empty($_POST['fecha_comercial']) ? $_POST['fecha_comercial'] : null;
        $fecha_entrega       = !empty($_POST['fecha_entrega'])   ? $_POST['fecha_entrega']   : null;
        $forma_pago          = $_POST['forma_pago']          ?? null;
        $manga               = $_POST['manga']               ?? null;
        $genero              = $_POST['genero']              ?? null;
        $bolsillo            = $_POST['bolsillo']            ?? null;
        $lavado              = $_POST['lavado']              ?? null;
        $bordado             = $_POST['bordado']             ?? null;
        $muestra             = $_POST['muestra']             ?? null;
        $cuello_option       = $_POST['cuello_option']       ?? null;
        $empaque             = $_POST['empaque']             ?? null;
        $ubicacion_combinado = $_POST['ubicacion_combinado'] ?? null;
        $ubicacion_forro     = $_POST['ubicacion_forro']     ?? null;
        $tipo_opcion         = $_POST['tipo_opcion']         ?? null;
        $opcion_escrito      = $_POST['opcion_escrito']      ?? null;
        $ref_sugerida        = $_POST['ref_sugerida']        ?? null;
        $observacion_tallas  = $_POST['observacion_tallas']  ?? null;
        $observacion_stock   = $_POST['observacion_stock']   ?? null;

        // ---- Descripciones / colores que se guardan en PRODUCTO ----
        $mangas         = $_POST['mangas']         ?? '';
        $cuello         = $_POST['cuello']         ?? '';
        $puño           = $_POST['puño']           ?? '';
        $pretina        = $_POST['pretina']        ?? '';
        $fajon          = $_POST['fajon']          ?? '';
        $boton          = $_POST['boton']          ?? '';
        $cremallera     = $_POST['cremallera']     ?? '';
        $observacion    = $_POST['observacion']    ?? '';

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? floatval($_POST[$campo]) : $valorPredeterminado;
        }

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

        // ============================================================
        // CURVA DE TALLAS + STOCK -> se guarda en la tabla `tallas`
        // (6 grupos, uno por color de tela), vinculada a ficha_tecnica
        // mediante id_talla. Ver funcion guardar_curva_tallas_y_stock().
        // ============================================================
        $ficha_previa = mysqli_fetch_assoc(mysqli_query($enlace, "SELECT num_ficha, id_talla FROM ficha_tecnica WHERE id_producto = $id_producto LIMIT 1"));
        $ya_existe_ficha    = !empty($ficha_previa);
        $id_talla_existente = $ficha_previa['id_talla'] ?? null;

        $resultado_curva  = guardar_curva_tallas_y_stock($enlace, $id_talla_existente);
        $id_talla          = $resultado_curva['id_talla'];
        $unidades_totales  = $resultado_curva['unidades_totales'];

        // Base de calculo para los consumos de insumos: se usa unidades_totales
        // (tallas + stock de los 6 colores) si ya hay curva cargada; si todavia
        // no hay nada capturado, se sigue usando suma_prendas como antes.
        $base_calculo = ($unidades_totales > 0) ? $unidades_totales : $suma_prendas;

        // NOTA: consumo_telacombi / precio_telacombicompra / consumo_telaforro /
        // precio_telaforrocompra YA NO se calculan ni se guardan desde aqui
        // (se manejaran en otro punto del flujo mas adelante).
        $consumo_totalboton = $base_calculo * $cant_boton;
        $precio_botoncompra = $base_calculo * $valor_boton;
        $consumo_totalboton2 = $base_calculo * $cant_boton2;
        $precio_boton2compra = $base_calculo * $valor_boton2;
        $consumo_totalbroche = $base_calculo * $cant_broche;
        $precio_brochecompra = $base_calculo * $valor_broche;
        $consumo_totalfaya = $base_calculo * $cant_faya;
        $precio_fayacompra = $base_calculo * $valor_faya;
        $consumo_totalcinta = $base_calculo * $cant_cinta;
        $precio_cintacompra = $base_calculo * $valor_cinta;
        $consumo_totalcordon = $base_calculo * $cant_cordon;
        $precio_cordoncompra = $base_calculo * $valor_cordon;
        $consumo_totalcremallera = $base_calculo * $cant_cremallera;
        $precio_cremalleracompra = $base_calculo * $valor_cremallera;
        $consumo_totalcremallera2 = $base_calculo * $cant_cremallera2;
        $precio_cremallera2compra = $base_calculo * $valor_cremallera2;
        $consumo_totalcuello = $base_calculo * $consumo_cuello;
        $precio_cuellocompra = $base_calculo * $valor_cuello;
        $consumo_totaldeslizador = $base_calculo * $cant_deslizador;
        $precio_deslizadorcompra = $base_calculo * $valor_deslizador;
        $consumo_totalentretela = $base_calculo * $cant_entretela;
        $precio_entretelacompra = $base_calculo * $valor_entretela;
        $consumo_totalentretela2 = $base_calculo * $cant_entretela2;
        $precio_entretela2compra = $base_calculo * $valor_entretela2;
        $consumo_totalfajon_cintura = $base_calculo * $cant_fajon_cintura;
        $precio_fajon_cinturacompra = $base_calculo * $valor_fajon_cintura;
        $consumo_totalguata = $base_calculo * $cant_guata;
        $precio_guatacompra = $base_calculo * $valor_guata;
        $consumo_totalhiladilla = $base_calculo * $cant_hiladilla;
        $precio_hiladillacompra = $base_calculo * $valor_hiladilla;
        $consumo_totalhombrera = $base_calculo * $cant_hombrera;
        $precio_hombreracompra = $base_calculo * $valor_hombrera;
        $consumo_totalplumilla = $base_calculo * $cant_plumilla;
        $precio_plumillacompra = $base_calculo * $valor_plumilla;
        $consumo_totalpretina = $base_calculo * $cant_pretina;
        $precio_pretinacompra = $base_calculo * $valor_pretina;
        $consumo_totalpuntera = $base_calculo * $cant_puntera;
        $precio_punteracompra = $base_calculo * $valor_puntera;
        $consumo_totalpuño = $base_calculo * $consumo_puño;
        $precio_puñocompra = $base_calculo * $valor_puño;
        $consumo_totalresorte = $base_calculo * $cant_resorte;
        $precio_resortecompra = $base_calculo * $valor_resorte;
        $consumo_totalresorte2 = $base_calculo * $cant_resorte2;
        $precio_resorte2compra = $base_calculo * $valor_resorte2;
        $consumo_totalsesgo = $base_calculo * $cant_sesgo;
        $precio_sesgocompra = $base_calculo * $valor_sesgo;
        $consumo_totaltrabilla = $base_calculo * $cant_trabilla;
        $precio_trabillacompra = $base_calculo * $valor_trabilla;
        $consumo_totalvelcro = $base_calculo * $cant_velcro;
        $precio_velcrocompra = $base_calculo * $valor_velcro;
        $consumo_totalvinilo = $base_calculo * $cant_vinilo;
        $precio_vinilocompra = $base_calculo * $valor_vinilo;
        $consumo_totalvivo = $base_calculo * $cant_vivo;
        $precio_vivocompra = $base_calculo * $valor_vivo;

        // ------------------------------------------------------------
        // 1) Guardar colores, descripciones y observacion en PRODUCTO
        //    (solo los campos que realmente llegaron por POST, para no
        //     sobrescribir con vacio los que no se muestran) + estado
        // ------------------------------------------------------------
        $prod_sets = [];
        foreach (['color_tela', 'color_telacombi', 'color_telaforro'] as $base) {
            for ($i = 1; $i <= 6; $i++) {
                $campo = ($i == 1) ? $base : $base . $i;
                if (array_key_exists($campo, $_POST)) {
                    $prod_sets[] = "`$campo` = '" . mysqli_real_escape_string($enlace, $_POST[$campo]) . "'";
                }
            }
        }
        foreach (['mangas', 'cuello', 'puño', 'pretina', 'fajon', 'boton', 'cremallera', 'observaciones'] as $campo) {
            if (array_key_exists($campo, $_POST)) {
                $prod_sets[] = "`$campo` = '" . mysqli_real_escape_string($enlace, $_POST[$campo]) . "'";
            }
        }
        $prod_sets[] = "estado = 'Ficha'";

        $consulta = "UPDATE producto SET " . implode(', ', $prod_sets) . " WHERE id_producto = $id_producto";
        $resultado = mysqli_query($enlace, $consulta);

        // ------------------------------------------------------------
        // 2) Guardar / actualizar la FICHA TECNICA
        // ------------------------------------------------------------
        $ft = [];
        $ft['id_producto']         = $id_producto;
        $ft['nit']                 = $nit;
        $ft['fecha_comercial']     = $fecha_comercial;
        $ft['fecha_entrega']       = $fecha_entrega;
        $ft['forma_pago']          = $forma_pago;
        $ft['manga']               = $manga;
        $ft['genero']              = $genero;
        $ft['bolsillo']            = $bolsillo;
        $ft['lavado']              = $lavado;
        $ft['bordado']             = $bordado;
        $ft['muestra']             = $muestra;
        $ft['cuello_option']       = $cuello_option;
        $ft['empaque']             = $empaque;
        $ft['ubicacion_combinado'] = $ubicacion_combinado;
        $ft['ubicacion_forro']     = $ubicacion_forro;
        $ft['tipo_opcion']         = $tipo_opcion;
        $ft['opcion_escrito']      = $opcion_escrito;
        $ft['ref_sugerida']        = $ref_sugerida;
        $ft['observacion_tallas']  = $observacion_tallas;
        $ft['observacion_stock']   = $observacion_stock;

        // codigo_tela / area_tela / codigo_telacombi / codigo_telaforro (1..6)
        for ($i = 1; $i <= 6; $i++) {
            $s = ($i == 1) ? '' : $i;
            foreach (['codigo_tela', 'area_tela', 'codigo_telacombi', 'codigo_telaforro'] as $base) {
                $campo = $base . $s;
                if (array_key_exists($campo, $_POST)) {
                    $ft[$campo] = $_POST[$campo];
                }
            }
        }

        // Vínculo a la curva de tallas + stock, ya guardada en la tabla `tallas`
        $ft['id_talla'] = $id_talla;

        // Helper para escapar valores (NULL cuando corresponde)
        $ft_val = function ($v) use ($enlace) {
            return ($v === null) ? "NULL" : "'" . mysqli_real_escape_string($enlace, $v) . "'";
        };

        // ¿El producto ya tiene ficha? (ya se determino arriba, junto con id_talla_existente)

        if ($ya_existe_ficha) {
            // UPDATE (no se tocan las llaves num_ficha ni id_producto)
            $sets = [];
            foreach ($ft as $c => $v) {
                if ($c === 'id_producto') continue;
                $sets[] = "`$c` = " . $ft_val($v);
            }
            $sql_ft = "UPDATE ficha_tecnica SET " . implode(', ', $sets) . " WHERE id_producto = $id_producto";
        } else {
            // INSERT: num_ficha se calcula en el momento (MAX+1) para evitar duplicados,
            // y fecha_pedido queda con la fecha/hora del primer guardado.
            $rmax = mysqli_query($enlace, "SELECT COALESCE(MAX(num_ficha),0)+1 AS sig FROM ficha_tecnica");
            $ft['num_ficha']    = intval(mysqli_fetch_assoc($rmax)['sig']);
            $ft['fecha_pedido'] = date('Y-m-d H:i:s');

            $cols = [];
            $vals = [];
            foreach ($ft as $c => $v) {
                $cols[] = "`$c`";
                $vals[] = $ft_val($v);
            }
            $sql_ft = "INSERT INTO ficha_tecnica (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ")";
        }
        mysqli_query($enlace, $sql_ft);

        // Verificar si ya existe una orden_compra para ese producto
        $verificar = "SELECT id_ordencompra FROM orden_compra WHERE id_producto = '$id_producto' LIMIT 1";
        $resultado_verificar = mysqli_query($enlace, $verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // YA EXISTE → hacer UPDATE
            $consulta2 = "UPDATE orden_compra SET consumo_totalboton = '$consumo_totalboton', total_botoncotizado = '$precio_botoncompra', consumo_totalboton2 = '$consumo_totalboton2', total_boton2cotizado = '$precio_boton2compra', consumo_totalbroche = '$consumo_totalbroche', total_brochecotizado = '$precio_brochecompra', consumo_totalfaya = '$consumo_totalfaya',
                                                total_fayacotizado = '$precio_fayacompra', consumo_totalcinta = '$consumo_totalcinta', total_cintacotizado = '$precio_cintacompra', consumo_totalcordon = '$consumo_totalcordon', total_cordoncotizado = '$precio_cordoncompra', consumo_totalcremallera = '$consumo_totalcremallera', total_cremalleracotizado = '$precio_cremalleracompra', consumo_totalcremallera2 = '$consumo_totalcremallera2', total_cremallera2cotizado = '$precio_cremallera2compra', consumo_totalcuello = '$consumo_totalcuello', total_cuellocotizado = '$precio_cuellocompra', consumo_totaldeslizador = '$consumo_totaldeslizador', total_deslizadorcotizado = '$precio_deslizadorcompra', consumo_totalentretela = '$consumo_totalentretela', total_entretelacotizado = '$precio_entretelacompra', consumo_totalentretela2 = '$consumo_totalentretela2',
                                                total_entretela2cotizado = '$precio_entretela2compra', consumo_totalfajon_cintura = '$consumo_totalfajon_cintura', total_fajon_cinturacotizado = '$precio_fajon_cinturacompra', consumo_totalguata = '$consumo_totalguata', total_guatacotizado = '$precio_guatacompra', consumo_totalhiladilla = '$consumo_totalhiladilla', total_hiladillacotizado = '$precio_hiladillacompra', consumo_totalhombrera = '$consumo_totalhombrera', total_hombreracotizado = '$precio_hombreracompra', consumo_totalplumilla = '$consumo_totalplumilla', total_plumillacotizado = '$precio_plumillacompra', consumo_totalpretina = '$consumo_totalpretina', total_pretinacotizado = '$precio_pretinacompra', consumo_totalpuntera = '$consumo_totalpuntera', total_punteracotizado = '$precio_punteracompra', consumo_totalpuño = '$consumo_totalpuño',
                                                total_puñocotizado = '$precio_puñocompra', consumo_totalresorte = '$consumo_totalresorte', total_resortecotizado = '$precio_resortecompra', consumo_totalresorte2 = '$consumo_totalresorte2', total_resorte2cotizado = '$precio_resorte2compra', consumo_totalsesgo = '$consumo_totalsesgo', total_sesgocotizado = '$precio_sesgocompra', consumo_totaltrabilla = '$consumo_totaltrabilla', total_trabillacotizado = '$precio_trabillacompra', consumo_totalvelcro = '$consumo_totalvelcro', total_velcrocotizado = '$precio_velcrocompra', consumo_totalvinilo = '$consumo_totalvinilo', total_vinilocotizado = '$precio_vinilocompra', consumo_totalvivo = '$consumo_totalvivo', total_vivocotizado = '$precio_vivocompra'
                                                WHERE id_producto = '$id_producto'";
        } else {
            // NO EXISTE → hacer INSERT
            $consulta2 = "INSERT INTO orden_compra (
                                            id_producto, consumo_totalboton, total_botoncotizado, consumo_totalboton2, total_boton2cotizado, consumo_totalbroche, total_brochecotizado, consumo_totalfaya, total_fayacotizado, consumo_totalcinta, total_cintacotizado, 
                                            consumo_totalcordon, total_cordoncotizado, consumo_totalcremallera, total_cremalleracotizado, consumo_totalcremallera2, total_cremallera2cotizado, consumo_totalcuello, total_cuellocotizado, consumo_totaldeslizador, total_deslizadorcotizado, consumo_totalentretela, total_entretelacotizado, consumo_totalentretela2, total_entretela2cotizado, consumo_totalfajon_cintura, total_fajon_cinturacotizado, 
                                            consumo_totalguata, total_guatacotizado, consumo_totalhiladilla, total_hiladillacotizado, consumo_totalhombrera, total_hombreracotizado, consumo_totalplumilla, total_plumillacotizado, consumo_totalpretina, total_pretinacotizado, consumo_totalpuntera, total_punteracotizado, consumo_totalpuño, total_puñocotizado, consumo_totalresorte, total_resortecotizado, consumo_totalresorte2, total_resorte2cotizado, 
                                            consumo_totalsesgo, total_sesgocotizado, consumo_totaltrabilla, total_trabillacotizado, consumo_totalvelcro, total_velcrocotizado, consumo_totalvinilo, total_vinilocotizado, consumo_totalvivo, total_vivocotizado
                                            ) VALUES (
                                                '$id_producto', '$consumo_totalboton', '$precio_botoncompra', '$consumo_totalboton2', '$precio_boton2compra', '$consumo_totalbroche', '$precio_brochecompra', '$consumo_totalfaya', '$precio_fayacompra', '$consumo_totalcinta', '$precio_cintacompra', 
                                                '$consumo_totalcordon', '$precio_cordoncompra', '$consumo_totalcremallera', '$precio_cremalleracompra', '$consumo_totalcremallera2', '$precio_cremallera2compra', '$consumo_totalcuello', '$precio_cuellocompra', '$consumo_totaldeslizador', '$precio_deslizadorcompra', '$consumo_totalentretela', '$precio_entretelacompra', '$consumo_totalentretela2', '$precio_entretela2compra', '$consumo_totalfajon_cintura', '$precio_fajon_cinturacompra', 
                                                '$consumo_totalguata', '$precio_guatacompra', '$consumo_totalhiladilla', '$precio_hiladillacompra', '$consumo_totalhombrera', '$precio_hombreracompra', '$consumo_totalplumilla', '$precio_plumillacompra', '$consumo_totalpretina', '$precio_pretinacompra', '$consumo_totalpuntera', '$precio_punteracompra', '$consumo_totalpuño', '$precio_puñocompra', '$consumo_totalresorte', '$precio_resortecompra', '$consumo_totalresorte2', '$precio_resorte2compra', 
                                                '$consumo_totalsesgo', '$precio_sesgocompra', '$consumo_totaltrabilla', '$precio_trabillacompra', '$consumo_totalvelcro', '$precio_velcrocompra', '$consumo_totalvinilo', '$precio_vinilocompra', '$consumo_totalvivo', '$precio_vivocompra'
                                            )";
        }

        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=1");
        exit();
    }

    if (isset($_POST['crear_ficha_tecnicaEx'])) {

        $id_producto  = intval($_POST['id_producto']);
        $nit  = intval($_POST['nit']);

        // Seguridad: sin un id_producto valido no se puede crear la ficha
        // (evita fallos de llave foranea contra la tabla producto).
        if ($id_producto <= 0) {
            header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario");
            exit();
        }

        // ---- Campos de texto de la FICHA TECNICA ----
        $num_ficha           = intval($_POST['num_ficha'] ?? 0);
        $fecha_comercial     = !empty($_POST['fecha_comercial']) ? $_POST['fecha_comercial'] : null;
        $fecha_entrega       = !empty($_POST['fecha_entrega'])   ? $_POST['fecha_entrega']   : null;
        $forma_pago          = $_POST['forma_pago']          ?? null;
        $manga               = $_POST['manga']               ?? null;
        $genero              = $_POST['genero']              ?? null;
        $bolsillo            = $_POST['bolsillo']            ?? null;
        $lavado              = $_POST['lavado']              ?? null;
        $bordado             = $_POST['bordado']             ?? null;
        $muestra             = $_POST['muestra']             ?? null;
        $cuello_option       = $_POST['cuello_option']       ?? null;
        $empaque             = $_POST['empaque']             ?? null;
        $ubicacion_combinado = $_POST['ubicacion_combinado'] ?? null;
        $ubicacion_forro     = $_POST['ubicacion_forro']     ?? null;
        $tipo_opcion         = $_POST['tipo_opcion']         ?? null;
        $opcion_escrito      = $_POST['opcion_escrito']      ?? null;
        $ref_sugerida        = $_POST['ref_sugerida']        ?? null;
        $observacion_tallas  = $_POST['observacion_tallas']  ?? null;
        $observacion_stock   = $_POST['observacion_stock']   ?? null;

        // ---- Descripciones / colores que se guardan en PRODUCTO ----
        $valor_agregado = $_POST['valor_agregado'] ?? '';
        $observacion    = $_POST['observacion']    ?? '';

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? floatval($_POST[$campo]) : $valorPredeterminado;
        }

        $precio_compra = obtenerValorPost('precio_compra');

        // ============================================================
        // CURVA DE TALLAS + STOCK -> se guarda en la tabla `tallas`
        // (mismo mecanismo que crear_ficha_tecnica, ver
        // guardar_curva_tallas_y_stock()).
        // ============================================================
        $ficha_previa = mysqli_fetch_assoc(mysqli_query($enlace, "SELECT num_ficha, id_talla FROM ficha_tecnica WHERE id_producto = $id_producto LIMIT 1"));
        $ya_existe_ficha    = !empty($ficha_previa);
        $id_talla_existente = $ficha_previa['id_talla'] ?? null;

        $resultado_curva  = guardar_curva_tallas_y_stock($enlace, $id_talla_existente);
        $id_talla          = $resultado_curva['id_talla'];
        $unidades_totales  = $resultado_curva['unidades_totales'];
        $tallas_guardadas  = $resultado_curva['tallas_data'];

        // Totales por grupo, con 0 por defecto si ese grupo/color no vino
        $total_tallas  = $tallas_guardadas['total_tallas']  ?? 0;
        $total_tallas2 = $tallas_guardadas['total_tallas2'] ?? 0;
        $total_tallas3 = $tallas_guardadas['total_tallas3'] ?? 0;
        $total_tallas4 = $tallas_guardadas['total_tallas4'] ?? 0;
        $total_tallas5 = $tallas_guardadas['total_tallas5'] ?? 0;
        $total_tallas6 = $tallas_guardadas['total_tallas6'] ?? 0;

        // ---- consumo_tela ahora depende del total de tallas por grupo/color ----
        $prendas_comprar  = $total_tallas;
        $prendas_comprar2 = $total_tallas2;
        $prendas_comprar3 = $total_tallas3;
        $prendas_comprar4 = $total_tallas4;
        $prendas_comprar5 = $total_tallas5;
        $prendas_comprar6 = $total_tallas6;

        $precio_prendacompra = $total_tallas * $precio_compra;
        $precio_prendacompra2 = $total_tallas2 * $precio_compra;
        $precio_prendacompra3 = $total_tallas3 * $precio_compra;
        $precio_prendacompra4 = $total_tallas4 * $precio_compra;
        $precio_prendacompra5 = $total_tallas5 * $precio_compra;
        $precio_prendacompra6 = $total_tallas6 * $precio_compra;

        // ------------------------------------------------------------
        // 1) Guardar colores, descripciones y observacion en PRODUCTO
        //    (solo los campos que realmente llegaron por POST, para no
        //     sobrescribir con vacio los que no se muestran) + estado
        // ------------------------------------------------------------
        $prod_sets = [];
        foreach (['color_tela'] as $base) {
            for ($i = 1; $i <= 6; $i++) {
                $campo = ($i == 1) ? $base : $base . $i;
                if (array_key_exists($campo, $_POST)) {
                    $prod_sets[] = "`$campo` = '" . mysqli_real_escape_string($enlace, $_POST[$campo]) . "'";
                }
            }
        }
        foreach (['valor_agregado', 'observaciones'] as $campo) {
            if (array_key_exists($campo, $_POST)) {
                $prod_sets[] = "`$campo` = '" . mysqli_real_escape_string($enlace, $_POST[$campo]) . "'";
            }
        }
        $prod_sets[] = "estado = 'Ficha'";

        $consulta = "UPDATE producto SET " . implode(', ', $prod_sets) . " WHERE id_producto = $id_producto";
        $resultado = mysqli_query($enlace, $consulta);

        // ------------------------------------------------------------
        // 2) Guardar / actualizar la FICHA TECNICA
        // ------------------------------------------------------------
        $ft = [];
        $ft['id_producto']         = $id_producto;
        $ft['nit']                 = $nit;
        $ft['fecha_comercial']     = $fecha_comercial;
        $ft['fecha_entrega']       = $fecha_entrega;
        $ft['forma_pago']          = $forma_pago;
        $ft['manga']               = $manga;
        $ft['genero']              = $genero;
        $ft['bolsillo']            = $bolsillo;
        $ft['lavado']              = $lavado;
        $ft['bordado']             = $bordado;
        $ft['muestra']             = $muestra;
        $ft['cuello_option']       = $cuello_option;
        $ft['empaque']             = $empaque;
        $ft['ubicacion_combinado'] = $ubicacion_combinado;
        $ft['ubicacion_forro']     = $ubicacion_forro;
        $ft['tipo_opcion']         = $tipo_opcion;
        $ft['opcion_escrito']      = $opcion_escrito;
        $ft['ref_sugerida']        = $ref_sugerida;
        $ft['observacion_tallas']  = $observacion_tallas;
        $ft['observacion_stock']   = $observacion_stock;

        // codigo_tela / composicion (1..6)
        for ($i = 1; $i <= 6; $i++) {
            $s = ($i == 1) ? '' : $i;
            foreach (['codigo_tela', 'composicion'] as $base) {
                $campo = $base . $s;
                if (array_key_exists($campo, $_POST)) {
                    $ft[$campo] = $_POST[$campo];
                }
            }
        }

        // Vínculo a la curva de tallas + stock, ya guardada en la tabla `tallas`
        $ft['id_talla'] = $id_talla;

        // Helper para escapar valores (NULL cuando corresponde)
        $ft_val = function ($v) use ($enlace) {
            return ($v === null) ? "NULL" : "'" . mysqli_real_escape_string($enlace, $v) . "'";
        };

        // ¿El producto ya tiene ficha? (ya se determino arriba, junto con id_talla_existente)

        if ($ya_existe_ficha) {
            // UPDATE (no se tocan las llaves num_ficha ni id_producto)
            $sets = [];
            foreach ($ft as $c => $v) {
                if ($c === 'id_producto') continue;
                $sets[] = "`$c` = " . $ft_val($v);
            }
            $sql_ft = "UPDATE ficha_tecnica SET " . implode(', ', $sets) . " WHERE id_producto = $id_producto";
        } else {
            // INSERT: num_ficha se calcula en el momento (MAX+1) para evitar duplicados,
            // y fecha_pedido queda con la fecha/hora del primer guardado.
            $rmax = mysqli_query($enlace, "SELECT COALESCE(MAX(num_ficha),0)+1 AS sig FROM ficha_tecnica");
            $ft['num_ficha']    = intval(mysqli_fetch_assoc($rmax)['sig']);
            $ft['fecha_pedido'] = date('Y-m-d H:i:s');

            $cols = [];
            $vals = [];
            foreach ($ft as $c => $v) {
                $cols[] = "`$c`";
                $vals[] = $ft_val($v);
            }
            $sql_ft = "INSERT INTO ficha_tecnica (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ")";
        }
        mysqli_query($enlace, $sql_ft);

        // Verificar si ya existe una orden_compra para ese producto
        $verificar = "SELECT id_ordencompra FROM orden_compra WHERE id_producto = '$id_producto' LIMIT 1";
        $resultado_verificar = mysqli_query($enlace, $verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // YA EXISTE → hacer UPDATE
            $consulta2 = "UPDATE orden_compra SET prendas_comprar = '$prendas_comprar', prendas_comprar2 = '$prendas_comprar2', prendas_comprar3 = '$prendas_comprar3', prendas_comprar4 = '$prendas_comprar4', prendas_comprar5 = '$prendas_comprar5', prendas_comprar6 = '$prendas_comprar6', 
                                                precio_prendacompra = '$precio_prendacompra', precio_prendacompra2 = '$precio_prendacompra2', precio_prendacompra3 = '$precio_prendacompra3', precio_prendacompra4 = '$precio_prendacompra4', precio_prendacompra5 = '$precio_prendacompra5', precio_prendacompra6 = '$precio_prendacompra6'
                                                        WHERE id_producto = '$id_producto'";
        } else {
            // NO EXISTE → hacer INSERT
            $consulta2 = "INSERT INTO orden_compra (
                                            id_producto, 
                                            prendas_comprar, prendas_comprar2, prendas_comprar3, prendas_comprar4, prendas_comprar5, prendas_comprar6, 
                                            precio_prendacompra, precio_prendacompra2, precio_prendacompra3, precio_prendacompra4, precio_prendacompra5, precio_prendacompra6
                                            ) VALUES (
                                                '$id_producto', 
                                                '$prendas_comprar', '$prendas_comprar2', '$prendas_comprar3', '$prendas_comprar4', '$prendas_comprar5', '$prendas_comprar6',
                                                '$precio_prendacompra', '$precio_prendacompra2', '$precio_prendacompra3', '$precio_prendacompra4', '$precio_prendacompra5', '$precio_prendacompra6' 
                                            )";
        }

        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=1");
        exit();
    }

    $recibido = $_GET['recibido'] ?? null;
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
        $consulta = "SELECT usuario.id_usuario, pedido.id_pedido, pedido.id_usuario, producto.id_producto, ficha_tecnica.num_ficha, producto.estado, pedido.total_factura, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.cargo,
                    producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, 
                    producto.cant_tallas, producto.suma_prendas, tallas.unidades_totales, producto.precio_iva, producto.precio_total, 
                    ficha_tecnica.fecha_comercial, ficha_tecnica.fecha_entrega, ficha_tecnica.forma_pago,
                    ficha_tecnica.manga, ficha_tecnica.genero, ficha_tecnica.bolsillo, ficha_tecnica.lavado, ficha_tecnica.bordado, ficha_tecnica.muestra, ficha_tecnica.cuello_option, ficha_tecnica.empaque,
                    ficha_tecnica.codigo_tela, ficha_tecnica.codigo_tela2, ficha_tecnica.codigo_tela3, ficha_tecnica.codigo_tela4, ficha_tecnica.codigo_tela5, ficha_tecnica.codigo_tela6,
                    ficha_tecnica.area_tela, ficha_tecnica.area_tela2, ficha_tecnica.area_tela3, ficha_tecnica.area_tela4, ficha_tecnica.area_tela5, ficha_tecnica.area_tela6,
                    ficha_tecnica.composicion, ficha_tecnica.composicion2, ficha_tecnica.composicion3, ficha_tecnica.composicion4, ficha_tecnica.composicion5, ficha_tecnica.composicion6,
                    ficha_tecnica.ubicacion_combinado, ficha_tecnica.codigo_telacombi, ficha_tecnica.codigo_telacombi2, ficha_tecnica.codigo_telacombi3, ficha_tecnica.codigo_telacombi4, ficha_tecnica.codigo_telacombi5, ficha_tecnica.codigo_telacombi6,
                    ficha_tecnica.ubicacion_forro, ficha_tecnica.codigo_telaforro, ficha_tecnica.codigo_telaforro2, ficha_tecnica.codigo_telaforro3, ficha_tecnica.codigo_telaforro4, ficha_tecnica.codigo_telaforro5, ficha_tecnica.codigo_telaforro6,
                    ficha_tecnica.tipo_opcion, ficha_tecnica.opcion_escrito, ficha_tecnica.ref_sugerida, ficha_tecnica.observacion_tallas, ficha_tecnica.observacion_stock,
                    producto.mangas, producto.cuello, producto.puño, producto.pretina, producto.fajon, producto.observaciones, producto.valor_agregado, 
                    producto.boton, producto.cremallera, 

                    prenda.nombre_prenda, prenda_comprada.nombre_producto, tipo_prenda.id_tipo_prenda, pedido.prendas_realizar,
                    pedido.nit, cliente.nit, cliente.cod_cliente, cliente.cliente, cliente.direccion1, tallas.id_talla,
                    producto.precio_compra, mano_obra.producto, 

                    tela.id_tela, tela.tela, tela.ancho AS ancho_tela, tela.caracteristicas AS caracteristicas_tela, producto.promedio_consumo, producto.valor_tela, 
                    tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.ancho AS ancho_telacombi, tela_combinada.caracteristicas AS caracteristicas_combi, producto.promedio_telacombi, producto.valor_telacombi,
                    tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.ancho AS ancho_forro, tela_forro.caracteristicas AS caracteristicas_forro, producto.promedio_forro, producto.valor_forro,
                    producto.color_tela, producto.color_tela2, producto.color_tela3, producto.color_tela4, producto.color_tela5, producto.color_tela6,
                    producto.color_telacombi, producto.color_telacombi2, producto.color_telacombi3, producto.color_telacombi4, producto.color_telacombi5, producto.color_telacombi6,
                    producto.color_telaforro, producto.color_telaforro2, producto.color_telaforro3, producto.color_telaforro4, producto.color_telaforro5, producto.color_telaforro6,

                    tallas.talla_XS, tallas.stock_XS, tallas.unidades_XS, tallas.talla_M, tallas.stock_M, tallas.unidades_M, tallas.talla_S, tallas.stock_S, tallas.unidades_S, tallas.talla_L, tallas.stock_L, tallas.unidades_L, tallas.talla_XL, tallas.stock_XL, tallas.unidades_XL, tallas.talla_2XL, tallas.stock_2XL, tallas.unidades_2XL, tallas.talla_3XL, tallas.stock_3XL, tallas.unidades_3XL, tallas.talla_4XL, tallas.stock_4XL, tallas.unidades_4XL, tallas.talla_5XL, tallas.stock_5XL, tallas.unidades_5XL, tallas.talla_6XL, tallas.stock_6XL, tallas.unidades_6XL,
                    tallas.talla_4, tallas.stock_4, tallas.unidades_4, tallas.talla_6, tallas.stock_6, tallas.unidades_6, tallas.talla_8, tallas.stock_8, tallas.unidades_8, tallas.talla_10, tallas.stock_10, tallas.unidades_10, tallas.talla_12, tallas.stock_12, tallas.unidades_12, tallas.talla_14, tallas.stock_14, tallas.unidades_14, tallas.talla_16, tallas.stock_16, tallas.unidades_16, tallas.talla_18, tallas.stock_18, tallas.unidades_18, tallas.talla_20, tallas.stock_20, tallas.unidades_20, tallas.talla_22, tallas.stock_22, tallas.unidades_22,
                    tallas.talla_especial, tallas.stock_especial, tallas.unidades_especial, tallas.total_tallas, tallas.total_stock, tallas.unidades_tela,
                    tallas.talla2_XS, tallas.stock2_XS, tallas.unidades2_XS, tallas.talla2_S, tallas.stock2_S, tallas.unidades2_S, tallas.talla2_M, tallas.stock2_M, tallas.unidades2_M, tallas.talla2_L, tallas.stock2_L, tallas.unidades2_L, tallas.talla2_XL, tallas.stock2_XL, tallas.unidades2_XL, tallas.talla2_2XL, tallas.stock2_2XL, tallas.unidades2_2XL, tallas.talla2_3XL, tallas.stock2_3XL, tallas.unidades2_3XL, tallas.talla2_4XL, tallas.stock2_4XL, tallas.unidades2_4XL, tallas.talla2_5XL, tallas.stock2_5XL, tallas.unidades2_5XL, tallas.talla2_6XL, tallas.stock2_6XL, tallas.unidades2_6XL,
                    tallas.talla2_4, tallas.stock2_4, tallas.unidades2_4, tallas.talla2_6, tallas.stock2_6, tallas.unidades2_6, tallas.talla2_8, tallas.stock2_8, tallas.unidades2_8, tallas.talla2_10, tallas.stock2_10, tallas.unidades2_10, tallas.talla2_12, tallas.stock2_12, tallas.unidades2_12, tallas.talla2_14, tallas.stock2_14, tallas.unidades2_14, tallas.talla2_16, tallas.stock2_16, tallas.unidades2_16, tallas.talla2_18, tallas.stock2_18, tallas.unidades2_18, tallas.talla2_20, tallas.stock2_20, tallas.unidades2_20, tallas.talla2_22, tallas.stock2_22, tallas.unidades2_22,
                    tallas.talla2_especial, tallas.stock2_especial, tallas.unidades2_especial, tallas.total_tallas2, tallas.total_stock2, tallas.unidades_tela2,
                    tallas.talla3_XS, tallas.stock3_XS, tallas.unidades3_XS, tallas.talla3_S, tallas.stock3_S, tallas.unidades3_S, tallas.talla3_M, tallas.stock3_M, tallas.unidades3_M, tallas.talla3_L, tallas.stock3_L, tallas.unidades3_L, tallas.talla3_XL, tallas.stock3_XL, tallas.unidades3_XL, tallas.talla3_2XL, tallas.stock3_2XL, tallas.unidades3_2XL, tallas.talla3_3XL, tallas.stock3_3XL, tallas.unidades3_3XL, tallas.talla3_4XL, tallas.stock3_4XL, tallas.unidades3_4XL, tallas.talla3_5XL, tallas.stock3_5XL, tallas.unidades3_5XL, tallas.talla3_6XL, tallas.stock3_6XL, tallas.unidades3_6XL,
                    tallas.talla3_4, tallas.stock3_4, tallas.unidades3_4, tallas.talla3_6, tallas.stock3_6, tallas.unidades3_6, tallas.talla3_8, tallas.stock3_8, tallas.unidades3_8, tallas.talla3_10, tallas.stock3_10, tallas.unidades3_10, tallas.talla3_12, tallas.stock3_12, tallas.unidades3_12, tallas.talla3_14, tallas.stock3_14, tallas.unidades3_14, tallas.talla3_16, tallas.stock3_16, tallas.unidades3_16, tallas.talla3_18, tallas.stock3_18, tallas.unidades3_18, tallas.talla3_20, tallas.stock3_20, tallas.unidades3_20, tallas.talla3_22, tallas.stock3_22, tallas.unidades3_22,
                    tallas.talla3_especial, tallas.stock3_especial, tallas.unidades3_especial, tallas.total_tallas3, tallas.total_stock3, tallas.unidades_tela3,
                    tallas.talla4_XS, tallas.stock4_XS, tallas.unidades4_XS, tallas.talla4_S, tallas.stock4_S, tallas.unidades4_S, tallas.talla4_M, tallas.stock4_M, tallas.unidades4_M, tallas.talla4_L, tallas.stock4_L, tallas.unidades4_L, tallas.talla4_XL, tallas.stock4_XL, tallas.unidades4_XL, tallas.talla4_2XL, tallas.stock4_2XL, tallas.unidades4_2XL, tallas.talla4_3XL, tallas.stock4_3XL, tallas.unidades4_3XL, tallas.talla4_4XL, tallas.stock4_4XL, tallas.unidades4_4XL, tallas.talla4_5XL, tallas.stock4_5XL, tallas.unidades4_5XL, tallas.talla4_6XL, tallas.stock4_6XL, tallas.unidades4_6XL,
                    tallas.talla4_4, tallas.stock4_4, tallas.unidades4_4, tallas.talla4_6, tallas.stock4_6, tallas.unidades4_6, tallas.talla4_8, tallas.stock4_8, tallas.unidades4_8, tallas.talla4_10, tallas.stock4_10, tallas.unidades4_10, tallas.talla4_12, tallas.stock4_12, tallas.unidades4_12, tallas.talla4_14, tallas.stock4_14, tallas.unidades4_14, tallas.talla4_16, tallas.stock4_16, tallas.unidades4_16, tallas.talla4_18, tallas.stock4_18, tallas.unidades4_18, tallas.talla4_20, tallas.stock4_20, tallas.unidades4_20, tallas.talla4_22, tallas.stock4_22, tallas.unidades4_22,
                    tallas.talla4_especial, tallas.stock4_especial, tallas.unidades4_especial, tallas.total_tallas4, tallas.total_stock4, tallas.unidades_tela4,
                    tallas.talla5_XS, tallas.stock5_XS, tallas.unidades5_XS, tallas.talla5_S, tallas.stock5_S, tallas.unidades5_S, tallas.talla5_M, tallas.stock5_M, tallas.unidades5_M, tallas.talla5_L, tallas.stock5_L, tallas.unidades5_L, tallas.talla5_XL, tallas.stock5_XL, tallas.unidades5_XL, tallas.talla5_2XL, tallas.stock5_2XL, tallas.unidades5_2XL, tallas.talla5_3XL, tallas.stock5_3XL, tallas.unidades5_3XL, tallas.talla5_4XL, tallas.stock5_4XL, tallas.unidades5_4XL, tallas.talla5_5XL, tallas.stock5_5XL, tallas.unidades5_5XL, tallas.talla5_6XL, tallas.stock5_6XL, tallas.unidades5_6XL,
                    tallas.talla5_4, tallas.stock5_4, tallas.unidades5_4, tallas.talla5_6, tallas.stock5_6, tallas.unidades5_6, tallas.talla5_8, tallas.stock5_8, tallas.unidades5_8, tallas.talla5_10, tallas.stock5_10, tallas.unidades5_10, tallas.talla5_12, tallas.stock5_12, tallas.unidades5_12, tallas.talla5_14, tallas.stock5_14, tallas.unidades5_14, tallas.talla5_16, tallas.stock5_16, tallas.unidades5_16, tallas.talla5_18, tallas.stock5_18, tallas.unidades5_18, tallas.talla5_20, tallas.stock5_20, tallas.unidades5_20, tallas.talla5_22, tallas.stock5_22, tallas.unidades5_22,
                    tallas.talla5_especial, tallas.stock5_especial, tallas.unidades5_especial, tallas.total_tallas5, tallas.total_stock5, tallas.unidades_tela5,
                    tallas.talla6_XS, tallas.stock6_XS, tallas.unidades6_XS, tallas.talla6_S, tallas.stock6_S, tallas.unidades6_S, tallas.talla6_M, tallas.stock6_M, tallas.unidades6_M, tallas.talla6_L, tallas.stock6_L, tallas.unidades6_L, tallas.talla6_XL, tallas.stock6_XL, tallas.unidades6_XL, tallas.talla6_2XL, tallas.stock6_2XL, tallas.unidades6_2XL, tallas.talla6_3XL, tallas.stock6_3XL, tallas.unidades6_3XL, tallas.talla6_4XL, tallas.stock6_4XL, tallas.unidades6_4XL, tallas.talla6_5XL, tallas.stock6_5XL, tallas.unidades6_5XL, tallas.talla6_6XL, tallas.stock6_6XL, tallas.unidades6_6XL,
                    tallas.talla6_4, tallas.stock6_4, tallas.unidades6_4, tallas.talla6_6, tallas.stock6_6, tallas.unidades6_6, tallas.talla6_8, tallas.stock6_8, tallas.unidades6_8, tallas.talla6_10, tallas.stock6_10, tallas.unidades6_10, tallas.talla6_12, tallas.stock6_12, tallas.unidades6_12, tallas.talla6_14, tallas.stock6_14, tallas.unidades6_14, tallas.talla6_16, tallas.stock6_16, tallas.unidades6_16, tallas.talla6_18, tallas.stock6_18, tallas.unidades6_18, tallas.talla6_20, tallas.stock6_20, tallas.unidades6_20, tallas.talla6_22, tallas.stock6_22, tallas.unidades6_22,
                    tallas.talla6_especial, tallas.stock6_especial, tallas.unidades6_especial, tallas.total_tallas6, tallas.total_stock6, tallas.unidades_tela6,

                    producto.precio_entrega, entrega.id_entrega,
                    producto.cant_boton, producto.valor_boton,
                    producto.cant_boton2, producto.valor_boton2,
                    producto.cant_broche, producto.valor_broche,
                    producto.cant_faya, producto.valor_faya, 
                    producto.cant_cinta, producto.valor_cinta,
                    producto.cant_cordon, producto.valor_cordon,
                    producto.cant_cremallera, producto.valor_cremallera,
                    producto.cant_cremallera2, producto.valor_cremallera2,
                    producto.consumo_cuello, producto.valor_cuello,
                    producto.cant_deslizador, producto.valor_deslizador,
                    producto.cant_entretela, producto.valor_entretela,
                    producto.cant_entretela2, producto.valor_entretela2,
                    producto.cant_fajon_cintura, producto.valor_fajon_cintura,
                    producto.consumo_fusionado, producto.valor_fusionado,
                    producto.cant_guata, producto.valor_guata,
                    producto.cant_hiladilla, producto.valor_hiladilla,
                    producto.cant_hombrera, producto.valor_hombrera,
                    producto.cant_plumilla, producto.valor_plumilla,
                    producto.cant_pretina, producto.valor_pretina,
                    producto.cant_puntera, producto.valor_puntera,
                    producto.consumo_puño, producto.valor_puño,
                    producto.cant_resorte, producto.valor_resorte,
                    producto.cant_resorte2, producto.valor_resorte2,
                    producto.cant_sesgo, producto.valor_sesgo,
                    producto.cant_trabilla, producto.valor_trabilla,
                    producto.cant_velcro, producto.valor_velcro,
                    producto.cant_vinilo, producto.valor_vinilo,
                    producto.cant_vivo, producto.valor_vivo

                    FROM producto
                    LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido 
                    LEFT JOIN cliente ON pedido.nit = cliente.nit 
                    LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad 
                    LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                    LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                    LEFT JOIN usuario ON pedido.id_usuario = usuario.id_usuario
                    LEFT JOIN tela ON producto.id_tela = tela.id_tela 
                    LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi 
                    LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro 
                    LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo 
                    LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra  
                    LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega 
                    LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto 
                    LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla 
                    LEFT JOIN prenda_comprada ON producto.id_prendacomprada = prenda_comprada.id_prendacomprada 
                    LEFT JOIN ficha_tecnica ON producto.id_producto = ficha_tecnica.id_producto
                    LEFT JOIN tallas ON ficha_tecnica.id_talla = tallas.id_talla
                    WHERE pedido.id_pedido = $id_pedido AND (producto.estado IS NULL OR producto.estado = 'Ficha')";

        $resultado  = mysqli_query($enlace, $consulta);
        $productos  = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // "Fila cabecera" para los totales de arriba (antes era un fetch aparte)
        $fila = $productos[0] ?? [];
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
        foreach ($_REQUEST as $var => $val) {
            $$var = $val;
        }

        if ($recibido == 1) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i><strong> Éxito!</strong> La informacion se ha agregado a la Ficha Tecica Satisfatoriamente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        ?>

        <?php
            /**
             * Calcula el Domingo de Pascua (algoritmo Meeus/Jones/Butcher)
             */
            function calcular_pascua($year) {
                $a = $year % 19;
                $b = intdiv($year, 100);
                $c = $year % 100;
                $d = intdiv($b, 4);
                $e = $b % 4;
                $f = intdiv($b + 8, 25);
                $g = intdiv($b - $f + 1, 3);
                $h = (19 * $a + $b - $d - $g + 15) % 30;
                $i = intdiv($c, 4);
                $k = $c % 4;
                $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
                $m = intdiv($a + 11 * $h + 22 * $l, 451);
                $mes = intdiv($h + $l - 7 * $m + 114, 31);
                $dia = (($h + $l - 7 * $m + 114) % 31) + 1;

                return new DateTime("$year-$mes-$dia");
            }

            /**
             * Ley Emiliani: si el festivo no cae en lunes, se traslada al lunes siguiente
             */
            function aplicar_ley_emiliani(DateTime $fecha) {
                $diaSemana = (int)$fecha->format('N'); // 1=lunes ... 7=domingo
                if ($diaSemana !== 1) {
                    $fecha->modify('+' . (8 - $diaSemana) . ' days');
                }
                return $fecha;
            }

            /**
             * Devuelve un set (Y-m-d => true) con todos los festivos de Colombia para un año
             */
            function festivos_colombia($year) {
                $festivos = [];

                // Fijos (no se mueven)
                $festivos[] = "$year-01-01"; // Año Nuevo
                $festivos[] = "$year-05-01"; // Día del Trabajo
                $festivos[] = "$year-07-20"; // Independencia
                $festivos[] = "$year-08-07"; // Batalla de Boyacá
                $festivos[] = "$year-12-08"; // Inmaculada Concepción
                $festivos[] = "$year-12-25"; // Navidad

                // Ley Emiliani (se mueven al lunes siguiente)
                $emiliani = [
                    "$year-01-06", // Reyes Magos
                    "$year-03-19", // San José
                    "$year-06-29", // San Pedro y San Pablo
                    "$year-08-15", // Asunción de la Virgen
                    "$year-10-12", // Día de la Raza
                    "$year-11-01", // Todos los Santos
                    "$year-11-11", // Independencia de Cartagena
                ];
                foreach ($emiliani as $fechaStr) {
                    $fecha = aplicar_ley_emiliani(new DateTime($fechaStr));
                    $festivos[] = $fecha->format('Y-m-d');
                }

                // Basados en Semana Santa
                $pascua = calcular_pascua($year);
                $festivos[] = (clone $pascua)->modify('-3 days')->format('Y-m-d'); // Jueves Santo
                $festivos[] = (clone $pascua)->modify('-2 days')->format('Y-m-d'); // Viernes Santo
                $festivos[] = aplicar_ley_emiliani((clone $pascua)->modify('+39 days'))->format('Y-m-d'); // Ascensión
                $festivos[] = aplicar_ley_emiliani((clone $pascua)->modify('+60 days'))->format('Y-m-d'); // Corpus Christi
                $festivos[] = aplicar_ley_emiliani((clone $pascua)->modify('+68 days'))->format('Y-m-d'); // Sagrado Corazón

                return array_flip($festivos);
            }

            /**
             * Suma N días hábiles a una fecha, saltando fines de semana y festivos colombianos
             */
            function sumar_dias_habiles(DateTime $fechaInicio, $diasHabiles) {
                $fecha = clone $fechaInicio;
                $cache = [];
                $sumados = 0;

                while ($sumados < $diasHabiles) {
                    $fecha->modify('+1 day');
                    $year = (int)$fecha->format('Y');
                    if (!isset($cache[$year])) {
                        $cache[$year] = festivos_colombia($year);
                    }
                    $diaSemana = (int)$fecha->format('N');
                    $esFestivo = isset($cache[$year][$fecha->format('Y-m-d')]);

                    if ($diaSemana < 6 && !$esFestivo) {
                        $sumados++;
                    }
                }
                return $fecha;
            }
        ?>

        <!-- Productos -->
        <div class="container">
            <div class="row">
                <?php
                // Se calcula UNA sola vez, fuera del loop (antes no dependía de $fila)
                $consulta_ficha = "SELECT MAX(CAST(num_ficha AS UNSIGNED)) AS ultima_ficha FROM ficha_tecnica WHERE num_ficha REGEXP '^[0-9]+$'";
                $resultado_ficha = mysqli_query($enlace, $consulta_ficha);
                $siguiente_ficha = (mysqli_fetch_assoc($resultado_ficha)['ultima_ficha'] ?? 0) + 1;

                // Campos que van como data-* en el botón "Agregar Informacion"
                $campos_data = [ 'nit',
                    'precio_compra', 'suma_prendas',
                    'promedio_consumo', 'valor_tela',
                    'promedio_telacombi', 'valor_telacombi',
                    'promedio_forro', 'valor_forro',
                    'cant_boton', 'valor_boton',
                    'cant_boton2', 'valor_boton2',
                    'cant_broche', 'valor_broche',
                    'cant_faya', 'valor_faya',
                    'cant_cinta', 'valor_cinta',
                    'cant_cordon', 'valor_cordon',
                    'cant_cremallera', 'valor_cremallera',
                    'cant_cremallera2', 'valor_cremallera2',
                    'consumo_cuello', 'valor_cuello',
                    'cant_deslizador', 'valor_deslizador',
                    'cant_entretela', 'valor_entretela',
                    'cant_entretela2', 'valor_entretela2',
                    'cant_fajon_cintura', 'valor_fajon_cintura',
                    'cant_guata', 'valor_guata',
                    'cant_hiladilla', 'valor_hiladilla',
                    'cant_hombrera', 'valor_hombrera',
                    'cant_plumilla', 'valor_plumilla',
                    'cant_pretina', 'valor_pretina',
                    'cant_puntera', 'valor_puntera',
                    'consumo_puño', 'valor_puño',
                    'cant_resorte', 'valor_resorte',
                    'cant_resorte2', 'valor_resorte2',
                    'cant_sesgo', 'valor_sesgo',
                    'cant_trabilla', 'valor_trabilla',
                    'cant_velcro', 'valor_velcro',
                    'cant_vinilo', 'valor_vinilo',
                    'cant_vivo', 'valor_vivo',
                ];

                $colores = [
                    1 => 'color_tela',
                    2 => 'color_tela2',
                    3 => 'color_tela3',
                    4 => 'color_tela4',
                    5 => 'color_tela5',
                    6 => 'color_tela6'
                ];

                $tallas = ['4', '6', '8', '10', '12', '14', '16', '18', '20', '22', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial'];

                $contador_producto = 1;

                foreach ($productos as $fila):
                    if (in_array($fila['estado'], ['Diseño', 'Compras'])) continue;

                    $imagenesValidas = array_filter([
                        $fila['imagen'],
                        $fila['imagen2'],
                        $fila['imagen3'],
                        $fila['imagen4']
                    ]);

                    $tallasConCantidad = array_filter($tallas, fn($t) => ($fila['talla_' . $t] ?? 0) > 0);
                ?>

                    <div class="col-12 col-md-6 mb-3 d-flex">
                        <div class="card rounded-4 w-100">
                            <div class="card-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                <h5 class="card-title text-white text-center w-100 font-weight-bold mb-0" style="font-family: 'Times New Roman', serif;">
                                    Producto <?= $contador_producto ?>:
                                    <br><?= $fila['id_tipo_producto'] == 8 ? $fila['nombre_producto'] : $fila['nombre_prenda'] ?>
                                </h5>
                            </div>
                            <div class="card-body">

                                <?php if ($imagenesValidas): ?>
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

                                <div class="mb-2 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos sobre la cotizacion</h6>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="card-text" style="font-family:'Agency FB',sans-serif;color:black;font-size:18px;"><b>Cantidad Prendas:</b> <?= !empty($fila['unidades_totales']) ? $fila['unidades_totales'] : $fila['suma_prendas'] ?></p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text" style="font-family:'Agency FB',sans-serif;color:black;font-size:18px;"><b>Cantidad de Tallas:</b> <?= $fila['cant_tallas'] ?></p>
                                        </div>
                                    </div>
                                    <p class="card-text mb-1" style="font-family:'Agency FB',sans-serif;color:black;font-size:18px;"><b>Tipo de Producto:</b> <?= $fila['tipo_producto'] ?></p>
                                    <p class="card-text mb-1" style="font-family:'Agency FB',sans-serif;color:black;font-size:18px;"><b>Tipo de Cargo:</b> <?= $fila['cargo'] ?></p>

                                    <?php foreach (
                                        [
                                            'id_tela'      => ['Tipo de Tela', 'tela'],
                                            'id_telacombi' => ['Tipo de Tela Combinado', 'tela_combi'],
                                            'id_telaforro' => ['Tipo de Tela Forro', 'tela_forro'],
                                        ] as $condicion => [$label, $campo]
                                    ): ?>
                                        <?php if (!empty($fila[$condicion])): ?>
                                            <p class="card-text mb-1" style="font-family:'Agency FB',sans-serif;color:black;font-size:18px;"><b><?= $label ?>:</b> <?= $fila[$campo] ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <p class="card-text mb-1" style="font-family:'Agency FB',sans-serif;color:black;font-size:18px;">
                                        <b>Precio Unitario:</b>
                                        <span class="card-title font-weight-bold" style="color:#FF0000;font-family:'Agency FB',sans-serif;font-size:20px;">
                                            $ <?= number_format($fila['precio_iva'], 2, ',', '.') ?>
                                        </span>
                                    </p>
                                </div>

                                <?php foreach ($colores as $numColor => $campoColor): ?>
                                    <?php
                                    // Prefijo de las tallas y del stock según el color
                                    $prefijo = ($numColor == 1) ? 'talla_' : 'talla' . $numColor . '_';
                                    $prefijoStock = ($numColor == 1) ? 'stock_' : 'stock' . $numColor . '_';

                                    // Verificar si existe al menos una talla o stock con información
                                    $tieneTallas = false;
                                    foreach ($tallas as $talla) {
                                        $campo = $prefijo . $talla;
                                        $campoStockCheck = $prefijoStock . $talla;
                                        if (!empty($fila[$campo]) || !empty($fila[$campoStockCheck])) {
                                            $tieneTallas = true;
                                            break;
                                        }
                                    }
                                    ?>

                                    <?php if (!empty($fila[$campoColor]) && $tieneTallas): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-2">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">
                                                Tela Color: <?= $fila[$campoColor] ?>
                                            </h6>
                                            <div class="row justify-content-center">
                                                <?php
                                                $contador = 0;
                                                foreach ($tallas as $talla):
                                                    $campo = $prefijo . $talla;
                                                    $campoStock = $prefijoStock . $talla;
                                                    if (!empty($fila[$campo]) || !empty($fila[$campoStock])):
                                                        if ($contador > 0 && $contador % 4 == 0):
                                                ?>
                                            </div>
                                            <div class="row justify-content-center">
                                                <?php
                                                        endif;
                                                ?>
                                                <div class="col-auto">
                                                    <p class="card-text mb-1">
                                                        <b>Talla <?= $talla ?>:</b> <?= !empty($fila[$campo]) ? (int) $fila[$campo] : '' ?>
                                                        <?php if (!empty($fila[$campoStock])): ?>
                                                            <span class="badge rounded-pill bg-warning text-dark ms-1" title="Stock de esta talla">
                                                                <i class="bi bi-box-seam-fill"></i> +<?= $fila[$campoStock] ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                <?php
                                                        $contador++;
                                                    endif;
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <div class="mb-2 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Venta</h6>
                                    <span class="card-title font-weight-bold" style="color:#FF0000;font-family:'Agency FB',sans-serif;font-size:20px;">
                                        $ <?= number_format($fila['precio_total'], 2, ',', '.') ?>
                                    </span>
                                </div>

                                <?php if ($fila['id_tipo_producto'] != 8): ?>
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <button type="button"
                                            class="btn btn-warning btn-sm rounded-pill shadow-sm px-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#FichaTecnica<?= $fila['id_producto'] ?>"
                                            data-id-producto="<?= $fila['id_producto'] ?>"
                                            <?php foreach ($campos_data as $campo): ?>
                                                data-<?= str_replace('_', '-', $campo) ?>="<?= htmlspecialchars($fila[$campo] ?? '') ?>"
                                            <?php endforeach; ?>>
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Agregar Información
                                        </button>
                                        <?php if (isset($fila['estado']) && $fila['estado'] === 'Ficha'): ?>
                                            <button type="button"
                                                class="btn btn-success btn-sm rounded-pill shadow-sm px-4"
                                                data-bs-toggle="modal"
                                                data-bs-target="#CambiarEstado<?= $fila['id_producto']; ?>">
                                                <i class="bi bi-send-check-fill me-2"></i>
                                                Enviar Ficha a Diseño
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    
                                <?php endif; ?>
                                <?php if ($fila['id_tipo_producto'] == 8): ?>
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <button type="button"
                                            class="btn btn-warning btn-sm rounded-pill shadow-sm px-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#FichaTecnicaEx<?= $fila['id_producto'] ?>"
                                            data-id-producto="<?= $fila['id_producto'] ?>"
                                            <?php foreach ($campos_data as $campo): ?>
                                                data-<?= str_replace('_', '-', $campo) ?>="<?= htmlspecialchars($fila[$campo] ?? '') ?>"
                                            <?php endforeach; ?>>
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Agregar Información
                                        </button>
                                        <?php if (isset($fila['estado']) && $fila['estado'] === 'Ficha'): ?>
                                            <button type="button"
                                                class="btn btn-success btn-sm rounded-pill shadow-sm px-4"
                                                data-bs-toggle="modal"
                                                data-bs-target="#CambiarEstado<?= $fila['id_producto']; ?>">
                                                <i class="bi bi-send-check-fill me-2"></i>
                                                Enviar Ficha a Diseño
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php
                    $contador_producto++;
                endforeach;
                ?>
            </div>
        </div>

        <!-- Modales -->
        <?php
        foreach ($productos as $fila) {
            $ficha_existe = !empty($fila['num_ficha']); // true solo si YA tiene ficha guardada

            // Helper: valor guardado de la ficha (o '' si no hay)
            $fv = function ($campo) use ($fila) {
                return isset($fila[$campo]) && $fila[$campo] !== null ? $fila[$campo] : '';
            };
            // Helper: 'selected' si el valor guardado coincide
            $fsel = function ($campo, $opcion) use ($fila) {
                return (isset($fila[$campo]) && (string)$fila[$campo] === (string)$opcion) ? 'selected' : '';
            };
        ?>

            <!-- Modal Ficha Tecnica -->
            <div class="modal fade" id="FichaTecnica<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-100 w-100 px-5">
                    <div class="modal-content shadow-lg border-0 rounded-4">
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="nit" value="<?php echo $fila['nit']; ?>">
                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">
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

                                <div class="modal-header text-white justify-content-center position-relative" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                    <div class="d-flex align-items-center text-center">
                                        <img src="../../img/unidotaciones.png" alt="Logo" width="150" class="me-3 rounded">
                                    </div>
                                    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
                                                        <?php echo $ficha_existe && $fv('fecha_comercial') ? date('d/m/Y', strtotime($fv('fecha_comercial'))) : date('d/m/Y'); ?>
                                                        <input type="hidden" name="fecha_comercial" value="<?php echo $ficha_existe && $fv('fecha_comercial') ? date('Y-m-d', strtotime($fv('fecha_comercial'))) : date('Y-m-d'); ?>">
                                                    </td>
                                                    <td></td>
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
                                                    <td class="fw-bold text-end" style="width:12%;" name="fecha_pedido">Fecha Pedido:</td>
                                                    <td class="text-center" style="width:28%;">
                                                        <?php
                                                        $dias = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado'];

                                                        $meses = [1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'];

                                                        echo $dias[date('l')] . ', ' . date('d') . ' de ' . $meses[date('n')] . ' del ' . date('Y');
                                                        ?>
                                                    </td>

                                                    <!-- BLOQUE DERECHO 60% -->
                                                    <td class="fw-bold text-center" style="width:11%;">Fecha de Entrega:</td>
                                                    <td class="text-center" style="width:20%;">
                                                        <input type="date" class="form-control form-control-sm text-center" name="fecha_entrega"
                                                        value="<?= $ficha_existe && $fv('fecha_entrega') ? date('Y-m-d', strtotime($fv('fecha_entrega'))) : sumar_dias_habiles(new DateTime(), 30)->format('Y-m-d') ?>">
                                                    </td>

                                                    <td class="fw-bold text-center" style="width:17%;">Número de Ficha</td>
                                                    <td class="text-center fw-bold" style="width:12%; background:#ffff00;">
                                                        <input type="text" class="form-control form-control-sm text-center" style="background:#ffff00;" name="num_ficha" value="<?= $ficha_existe ? $fv('num_ficha') : $siguiente_ficha ?>" <?= $ficha_existe ? 'readonly' : '' ?>>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold text-end">Ciudad:</td>
                                                    <td class="text-center">PEREIRA</td>

                                                    <td class="fw-bold text-center">Cliente:</td>
                                                    <td class="text-center fw-bold" colspan="3" style="color:red;">
                                                        <?php echo $fila['cliente']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold text-end">Destino:</td>
                                                    <td class="text-center">UNIDOTACIONES DEL EJE S.A.S</td>

                                                    <td class="fw-bold text-center">NIT:</td>
                                                    <td class="text-center">
                                                        <?php echo $fila['cod_cliente']; ?>
                                                    </td>

                                                    <td class="fw-bold text-center">Forma de Pago:</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm text-center" name="forma_pago" style="color:red;" value="<?= htmlspecialchars($fv('forma_pago')) ?>">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold text-end">Cuenta:</td>
                                                    <td class="text-center">9.011.918.976</td>

                                                    <td class="fw-bold text-center">Dirección:</td>
                                                    <td class="text-center" colspan="3">
                                                        <?php echo $fila['direccion1']; ?>
                                                    </td>
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
                                                    <td>
                                                        <?php if (in_array($fila['id_tipo_prenda'], [1, 2, 5, 6])) { ?>
                                                            <select name="manga" class="form-select form-select-sm">
                                                                <option value=""></option>
                                                                <option value="Larga" <?= $fsel('manga', 'Larga') ?>>Larga</option>
                                                                <option value="Corta" <?= $fsel('manga', 'Corta') ?>>Corta</option>
                                                                <option value="Sisa" <?= $fsel('manga', 'Sisa') ?>>Sisa</option>
                                                                <option value="Al Codo" <?= $fsel('manga', 'Al Codo') ?>>Al Codo</option>
                                                                <option value="Japonesa" <?= $fsel('manga', 'Japonesa') ?>>Japonesa</option>
                                                                <option value="Rodada" <?= $fsel('manga', 'Rodada') ?>>Rodada</option>
                                                                <option value="Ranglan" <?= $fsel('manga', 'Ranglan') ?>>Ranglan</option>
                                                                <option value="3/4" <?= $fsel('manga', '3/4') ?>>3/4</option>
                                                                <option value="Clásico" <?= $fsel('manga', 'Clásico') ?>>Clásico</option>
                                                                <option value="Informal" <?= $fsel('manga', 'Informal') ?>>Informal</option>
                                                            </select>
                                                        <?php } else { ?>
                                                            <input type="text" class="form-control form-control-sm" value="" readonly>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <select name="genero" id="genero<?php echo $fila['id_producto']; ?>" class="form-select form-select-sm genero-select">
                                                            <option value=""></option>
                                                            <option value="Dama" <?= $fsel('genero', 'Dama') ?>>Dama</option>
                                                            <option value="Hombre" <?= $fsel('genero', 'Hombre') ?>>Hombre</option>
                                                            <option value="Junior" <?= $fsel('genero', 'Junior') ?>>Junior</option>
                                                        </select>
                                                    </td>
                                                    <td>UDE</td>
                                                    <td>
                                                        <select name="bolsillo" class="form-select form-select-sm">
                                                            <option value="NO" <?= $fsel('bolsillo', 'NO') ?>>NO</option>
                                                            <option value="SI" <?= $fsel('bolsillo', 'SI') ?>>SI</option>
                                                            <option value="Imitación" <?= $fsel('bolsillo', 'Imitación') ?>>Imitación</option>
                                                            <option value="1" <?= $fsel('bolsillo', '1') ?>>1</option>
                                                            <option value="2" <?= $fsel('bolsillo', '2') ?>>2</option>
                                                            <option value="3" <?= $fsel('bolsillo', '3') ?>>3</option>
                                                            <option value="4" <?= $fsel('bolsillo', '4') ?>>4</option>
                                                            <option value="5" <?= $fsel('bolsillo', '5') ?>>5</option>
                                                            <option value="Relojero" <?= $fsel('bolsillo', 'Relojero') ?>>Relojero</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="lavado" class="form-select form-select-sm">
                                                            <option value="NO" <?= $fsel('lavado', 'NO') ?>>NO</option>
                                                            <option value="SI" <?= $fsel('lavado', 'SI') ?>>SI</option>
                                                        </select>
                                                    </td>
                                                    <td style="background:#ffff00;"><input type="text" class="form-control form-control-sm" style="background:#ffff00;" name="bordado" value="<?= htmlspecialchars($fv('bordado')) ?>"></td>
                                                    <td>
                                                        <select name="muestra" class="form-select form-select-sm">
                                                            <option value="NO" <?= $fsel('muestra', 'NO') ?>>NO</option>
                                                            <option value="SI" <?= $fsel('muestra', 'SI') ?>>SI</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php if (in_array($fila['id_tipo_prenda'], [1, 2, 5, 6])) { ?>
                                                            <select name="cuello_option" class="form-select form-select-sm">
                                                                <option value=""></option>
                                                                <option value="Botón Down" <?= $fsel('cuello_option', 'Botón Down') ?>>Botón Down</option>
                                                                <option value="Botón Down Oculto" <?= $fsel('cuello_option', 'Botón Down Oculto') ?>>Botón Down Oculto</option>
                                                                <option value="Sin Botón Down" <?= $fsel('cuello_option', 'Sin Botón Down') ?>>Sin Botón Down</option>
                                                                <option value="Sport" <?= $fsel('cuello_option', 'Sport') ?>>Sport</option>
                                                                <option value="Camisero" <?= $fsel('cuello_option', 'Camisero') ?>>Camisero</option>
                                                                <option value="Tejido" <?= $fsel('cuello_option', 'Tejido') ?>>Tejido</option>
                                                                <option value="Y Puños Tejidos" <?= $fsel('cuello_option', 'Y Puños Tejidos') ?>>Y Puños Tejidos</option>
                                                                <option value="Y Puños en la misma tela" <?= $fsel('cuello_option', 'Y Puños en la misma tela') ?>>Y Puños en la misma tela</option>
                                                                <option value="Sastre" <?= $fsel('cuello_option', 'Sastre') ?>>Sastre</option>
                                                                <option value="Smoking" <?= $fsel('cuello_option', 'Smoking') ?>>Smoking</option>
                                                                <option value="En V" <?= $fsel('cuello_option', 'En V') ?>>En V</option>
                                                                <option value="Corbata" <?= $fsel('cuello_option', 'Corbata') ?>>Corbata</option>
                                                                <option value="Nerhú" <?= $fsel('cuello_option', 'Nerhú') ?>>Nerhú</option>
                                                            </select>
                                                        <?php } else { ?>
                                                            <input type="text" class="form-control form-control-sm" value="" readonly>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <select name="empaque" class="form-select form-select-sm">
                                                            <option value=""></option>
                                                            <option value="Doblada" <?= $fsel('empaque', 'Doblada') ?>>Doblada</option>
                                                            <option value="Colgada" <?= $fsel('empaque', 'Colgada') ?>>Colgada</option>
                                                            <option value="Doblado casero" <?= $fsel('empaque', 'Doblado casero') ?>>Doblado casero</option>
                                                        </select>
                                                    </td>
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
                                                    <th style="text-align: center; vertical-align: middle; width: 40%;">Nombre de la Tela</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 13%;">AREA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($colores as $c): ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control form-control-sm text-center" name="codigo_tela<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($fv('codigo_tela' . $c['sufijo'])); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
                                                        <td><input type="text" class="form-control form-control-sm text-center" name="color_tela<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($c['valor']); ?>"></td>
                                                        <td><?php echo htmlspecialchars($fila['tela']); ?></td>
                                                        <td><?php echo htmlspecialchars($fila['caracteristicas_tela']); ?></td>
                                                        <td><?php echo htmlspecialchars($fila['ancho_tela']); ?></td>
                                                        <td style="background:#ffff00;"><input type="text" class="form-control form-control-sm text-center" style="background:#ffff00;" name="area_tela<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($fv('area_tela' . $c['sufijo'])); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
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
                                                        <td class="fw-bold text-center" style="width:10%;">Combinado</td>
                                                        <td style="width:90%;">
                                                            <input type="text" class="form-control form-control-sm text-center" name="ubicacion_combinado" value="<?php echo htmlspecialchars($fv('ubicacion_combinado')); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300">
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
                                                        <th style="text-align: center; vertical-align: middle; width: 40%;">Nombre de la Tela Combinada</th>
                                                        <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion</th>
                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($colores_combi as $c): ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control form-control-sm text-center" name="codigo_telacombi<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($fv('codigo_telacombi' . $c['sufijo'])); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
                                                            <td><input type="text" class="form-control form-control-sm text-center" name="color_telacombi<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($c['valor']); ?>"></td>
                                                            <td><?php echo htmlspecialchars($fila['tela_combi']); ?></td>
                                                            <td><?php echo htmlspecialchars($fila['caracteristicas_combi']); ?></td>
                                                            <td><?php echo htmlspecialchars($fila['ancho_telacombi']); ?></td>
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
                                                        <td style="width:90%;">
                                                            <input type="text" class="form-control form-control-sm text-center" name="ubicacion_forro" value="<?php echo htmlspecialchars($fv('ubicacion_forro')); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300">
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
                                                        <th style="text-align: center; vertical-align: middle; width: 40%;">Nombre de la Tela Forro</th>
                                                        <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion</th>
                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($colores_forro as $c): ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control form-control-sm text-center" name="codigo_telaforro<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($fv('codigo_telaforro' . $c['sufijo'])); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
                                                            <td><input type="text" class="form-control form-control-sm text-center" name="color_telaforro<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($c['valor']); ?>"></td>
                                                            <td><?php echo htmlspecialchars($fila['tela_forro']); ?></td>
                                                            <td><?php echo htmlspecialchars($fila['caracteristicas_forro']); ?></td>
                                                            <td><?php echo htmlspecialchars($fila['ancho_forro']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                <?php endif; ?>

                                <!-- DESCRIPCIONES -->
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
                                                                <textarea class="form-control" name="<?= $campo ?>" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fila[$campo] ?? '') ?></textarea>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            <?php endif; ?>
                                            <tbody>
                                                <!-- TIPO OPCION-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        <select name="tipo_opcion" class="form-select form-select-sm text-center fw-bold" style="background-color:#d9e3f0; font-weight:bold; border:1px solid #b8c7d9;">
                                                            <option value="Bordado" <?= $fsel('tipo_opcion', 'Bordado') ?>>Bordado</option>
                                                            <option value="Estampado" <?= $fsel('tipo_opcion', 'Estampado') ?>>Estampado</option>
                                                            <option value="Subliminado" <?= $fsel('tipo_opcion', 'Subliminado') ?>>Subliminado</option>
                                                            <option value="Transfer" <?= $fsel('tipo_opcion', 'Transfer') ?>>Transfer</option>
                                                        </select>
                                                    </td>
                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                        <textarea class="form-control text-center fw-bold" style="background:#ffff00; color:red;" name="opcion_escrito" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('opcion_escrito')) ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- REF SUGERIDA -->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Ref sugerida
                                                    </td>
                                                    <td colspan="4">
                                                        <textarea class="form-control" name="ref_sugerida" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('ref_sugerida')) ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- OBSERVACIÓN PARA COSTEO-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Observaciónes para el Costeo
                                                    </td>
                                                    <td colspan="4">
                                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- OBSERVACIÓN DE TALLAS-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Observaciónes de las Tallas
                                                    </td>
                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                        <textarea class="form-control text-center fw-bold" style="background:#ffff00; color:red;" name="observacion_tallas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('observacion_tallas')) ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- OBSERVACIÓN DEL STOCK-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Observaciónes del Stock
                                                    </td>
                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                        <textarea class="form-control text-center fw-bold" style="background:#ffff00; color:red;" name="observacion_stock" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('observacion_stock')) ?></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- CURVA DE TALLAS -->
                                <div class="card shadow-sm border-0 mt-3">
                                    <?php
                                    // Reutilizamos la misma lógica de colores que en la tarjeta de TELA
                                    $colores_curva = [];
                                    for ($i = 1; $i <= 6; $i++) {
                                        $clave = ($i == 1) ? 'color_tela' : 'color_tela' . $i;
                                        if (!empty($fila[$clave])) {
                                            $colores_curva[] = $fila[$clave];
                                        }
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm align-middle text-center mb-0"
                                            id="tablaTallas<?php echo $fila['id_producto']; ?>"
                                            data-colores='<?php echo htmlspecialchars(json_encode($colores_curva, JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>'
                                            data-guardadas='<?php echo htmlspecialchars(json_encode($fila, JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>'>
                                        </table>
                                    </div>
                                </div>

                                <!-- BUTTON -->
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" name="crear_ficha_tecnica" class="btn btn-success">
                                        <i class="bi bi-save"></i> Guardar Ficha Técnica
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Ficha Tecnica Comprado-->
            <div class="modal fade" id="FichaTecnicaEx<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-100 w-100 px-5">
                    <div class="modal-content shadow-lg border-0 rounded-4">
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="nit" value="<?php echo $fila['nit']; ?>">
                                <input type="hidden" name="precio_compra" value="<?php echo $fila['precio_compra']; ?>">

                                <div class="modal-header text-white justify-content-center position-relative" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                    <div class="d-flex align-items-center text-center">
                                        <img src="../../img/unidotaciones.png" alt="Logo" width="150" class="me-3 rounded">
                                    </div>
                                    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
                                                        <?php echo $ficha_existe && $fv('fecha_comercial') ? date('d/m/Y', strtotime($fv('fecha_comercial'))) : date('d/m/Y'); ?>
                                                        <input type="hidden" name="fecha_comercial" value="<?php echo $ficha_existe && $fv('fecha_comercial') ? date('Y-m-d', strtotime($fv('fecha_comercial'))) : date('Y-m-d'); ?>">
                                                    </td>
                                                    <td></td>
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
                                                    <td class="fw-bold text-end" style="width:12%;" name="fecha_pedido">Fecha Pedido:</td>
                                                    <td class="text-center" style="width:28%;">
                                                        <?php
                                                        $dias = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado'];

                                                        $meses = [1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'];

                                                        echo $dias[date('l')] . ', ' . date('d') . ' de ' . $meses[date('n')] . ' del ' . date('Y');
                                                        ?>
                                                    </td>

                                                    <!-- BLOQUE DERECHO 60% -->
                                                    <td class="fw-bold text-center" style="width:11%;">Fecha de Entrega:</td>
                                                    <td class="text-center" style="width:20%;">
                                                        <input type="date" class="form-control form-control-sm text-center" name="fecha_entrega"
                                                        value="<?= $ficha_existe && $fv('fecha_entrega') ? date('Y-m-d', strtotime($fv('fecha_entrega'))) : sumar_dias_habiles(new DateTime(), 30)->format('Y-m-d') ?>">
                                                    </td>

                                                    <td class="fw-bold text-center" style="width:17%;">Número de Ficha</td>
                                                    <td class="text-center fw-bold" style="width:12%; background:#ffff00;">
                                                        <input type="text" class="form-control form-control-sm text-center" style="background:#ffff00;" name="num_ficha" value="<?= $ficha_existe ? $fv('num_ficha') : $siguiente_ficha ?>" <?= $ficha_existe ? 'readonly' : '' ?>>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold text-end">Ciudad:</td>
                                                    <td class="text-center">PEREIRA</td>

                                                    <td class="fw-bold text-center">Cliente:</td>
                                                    <td class="text-center fw-bold" colspan="3" style="color:red;">
                                                        <?php echo $fila['cliente']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold text-end">Destino:</td>
                                                    <td class="text-center">UNIDOTACIONES DEL EJE S.A.S</td>

                                                    <td class="fw-bold text-center">NIT:</td>
                                                    <td class="text-center">
                                                        <?php echo $fila['cod_cliente']; ?>
                                                    </td>

                                                    <td class="fw-bold text-center">Forma de Pago:</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm text-center" name="forma_pago" style="color:red;" value="<?= htmlspecialchars($fv('forma_pago')) ?>">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="fw-bold text-end">Cuenta:</td>
                                                    <td class="text-center">9.011.918.976</td>

                                                    <td class="fw-bold text-center">Dirección:</td>
                                                    <td class="text-center" colspan="3">
                                                        <?php echo $fila['direccion1']; ?>
                                                    </td>
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
                                                    <td><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                                    <td>
                                                        <?php if (in_array($fila['id_tipo_prenda'], [1, 2, 5, 6])) { ?>
                                                            <select name="manga" class="form-select form-select-sm">
                                                                <option value=""></option>
                                                                <option value="Larga" <?= $fsel('manga', 'Larga') ?>>Larga</option>
                                                                <option value="Corta" <?= $fsel('manga', 'Corta') ?>>Corta</option>
                                                                <option value="Sisa" <?= $fsel('manga', 'Sisa') ?>>Sisa</option>
                                                                <option value="Al Codo" <?= $fsel('manga', 'Al Codo') ?>>Al Codo</option>
                                                                <option value="Japonesa" <?= $fsel('manga', 'Japonesa') ?>>Japonesa</option>
                                                                <option value="Rodada" <?= $fsel('manga', 'Rodada') ?>>Rodada</option>
                                                                <option value="Ranglan" <?= $fsel('manga', 'Ranglan') ?>>Ranglan</option>
                                                                <option value="3/4" <?= $fsel('manga', '3/4') ?>>3/4</option>
                                                                <option value="Clásico" <?= $fsel('manga', 'Clásico') ?>>Clásico</option>
                                                                <option value="Informal" <?= $fsel('manga', 'Informal') ?>>Informal</option>
                                                            </select>
                                                        <?php } else { ?>
                                                            <input type="text" class="form-control form-control-sm" value="" readonly>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <select name="genero" id="generoEx<?php echo $fila['id_producto']; ?>" class="form-select form-select-sm genero-select">
                                                            <option value=""></option>
                                                            <option value="Dama" <?= $fsel('genero', 'Dama') ?>>Dama</option>
                                                            <option value="Hombre" <?= $fsel('genero', 'Hombre') ?>>Hombre</option>
                                                            <option value="Junior" <?= $fsel('genero', 'Junior') ?>>Junior</option>
                                                        </select>
                                                    </td>
                                                    <td>UDE</td>
                                                    <td>
                                                        <select name="bolsillo" class="form-select form-select-sm">
                                                            <option value="NO" <?= $fsel('bolsillo', 'NO') ?>>NO</option>
                                                            <option value="SI" <?= $fsel('bolsillo', 'SI') ?>>SI</option>
                                                            <option value="Imitación" <?= $fsel('bolsillo', 'Imitación') ?>>Imitación</option>
                                                            <option value="1" <?= $fsel('bolsillo', '1') ?>>1</option>
                                                            <option value="2" <?= $fsel('bolsillo', '2') ?>>2</option>
                                                            <option value="3" <?= $fsel('bolsillo', '3') ?>>3</option>
                                                            <option value="4" <?= $fsel('bolsillo', '4') ?>>4</option>
                                                            <option value="5" <?= $fsel('bolsillo', '5') ?>>5</option>
                                                            <option value="Relojero" <?= $fsel('bolsillo', 'Relojero') ?>>Relojero</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="lavado" class="form-select form-select-sm">
                                                            <option value="NO" <?= $fsel('lavado', 'NO') ?>>NO</option>
                                                            <option value="SI" <?= $fsel('lavado', 'SI') ?>>SI</option>
                                                        </select>
                                                    </td>
                                                    <td style="background:#ffff00;"><input type="text" class="form-control form-control-sm" style="background:#ffff00;" name="bordado" value="<?= htmlspecialchars($fv('bordado')) ?>"></td>
                                                    <td>
                                                        <select name="muestra" class="form-select form-select-sm">
                                                            <option value="NO" <?= $fsel('muestra', 'NO') ?>>NO</option>
                                                            <option value="SI" <?= $fsel('muestra', 'SI') ?>>SI</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php if (in_array($fila['id_tipo_prenda'], [1, 2, 5, 6])) { ?>
                                                            <select name="cuello_option" class="form-select form-select-sm">
                                                                <option value=""></option>
                                                                <option value="Botón Down" <?= $fsel('cuello_option', 'Botón Down') ?>>Botón Down</option>
                                                                <option value="Botón Down Oculto" <?= $fsel('cuello_option', 'Botón Down Oculto') ?>>Botón Down Oculto</option>
                                                                <option value="Sin Botón Down" <?= $fsel('cuello_option', 'Sin Botón Down') ?>>Sin Botón Down</option>
                                                                <option value="Sport" <?= $fsel('cuello_option', 'Sport') ?>>Sport</option>
                                                                <option value="Camisero" <?= $fsel('cuello_option', 'Camisero') ?>>Camisero</option>
                                                                <option value="Tejido" <?= $fsel('cuello_option', 'Tejido') ?>>Tejido</option>
                                                                <option value="Y Puños Tejidos" <?= $fsel('cuello_option', 'Y Puños Tejidos') ?>>Y Puños Tejidos</option>
                                                                <option value="Y Puños en la misma tela" <?= $fsel('cuello_option', 'Y Puños en la misma tela') ?>>Y Puños en la misma tela</option>
                                                                <option value="Sastre" <?= $fsel('cuello_option', 'Sastre') ?>>Sastre</option>
                                                                <option value="Smoking" <?= $fsel('cuello_option', 'Smoking') ?>>Smoking</option>
                                                                <option value="En V" <?= $fsel('cuello_option', 'En V') ?>>En V</option>
                                                                <option value="Corbata" <?= $fsel('cuello_option', 'Corbata') ?>>Corbata</option>
                                                                <option value="Nerhú" <?= $fsel('cuello_option', 'Nerhú') ?>>Nerhú</option>
                                                            </select>
                                                        <?php } else { ?>
                                                            <input type="text" class="form-control form-control-sm" value="" readonly>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <select name="empaque" class="form-select form-select-sm">
                                                            <option value=""></option>
                                                            <option value="Doblada" <?= $fsel('empaque', 'Doblada') ?>>Doblada</option>
                                                            <option value="Colgada" <?= $fsel('empaque', 'Colgada') ?>>Colgada</option>
                                                            <option value="Doblado casero" <?= $fsel('empaque', 'Doblado casero') ?>>Doblado casero</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- DESCRIPCION PRENDA -->
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
                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Codigo</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Color</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 40%;">Nombre de la Prenda</th>
                                                    <th style="text-align: center; vertical-align: middle; width: 30%;">Composicion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($colores as $c): ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control form-control-sm text-center" name="codigo_tela<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($fv('codigo_tela' . $c['sufijo'])); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
                                                        <td><input type="text" class="form-control form-control-sm text-center" name="color_tela<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($c['valor']); ?>"></td>
                                                        <td><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                                        <td><input type="text" class="form-control form-control-sm text-center" name="composicion<?php echo $c['sufijo']; ?>" value="<?php echo htmlspecialchars($fv('composicion' . $c['sufijo'])); ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- DESCRIPCIONES -->
                                <div class="card shadow-sm mb-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm align-middle mb-0" style="table-layout:fixed;width:100%;">
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Valor Agregado
                                                    </td>
                                                    <td colspan="4">
                                                        <textarea class="form-control" name="valor_agregado" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fila['valor_agregado'] ?? '') ?></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <!-- TIPO OPCION-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        <select name="tipo_opcion" class="form-select form-select-sm text-center fw-bold" style="background-color:#d9e3f0; font-weight:bold; border:1px solid #b8c7d9;">
                                                            <option value="Bordado" <?= $fsel('tipo_opcion', 'Bordado') ?>>Bordado</option>
                                                            <option value="Estampado" <?= $fsel('tipo_opcion', 'Estampado') ?>>Estampado</option>
                                                            <option value="Subliminado" <?= $fsel('tipo_opcion', 'Subliminado') ?>>Subliminado</option>
                                                            <option value="Transfer" <?= $fsel('tipo_opcion', 'Transfer') ?>>Transfer</option>
                                                        </select>
                                                    </td>
                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                        <textarea class="form-control text-center fw-bold" style="background:#ffff00; color:red;" name="opcion_escrito" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('opcion_escrito')) ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- OBSERVACIÓN PARA COSTEO-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Observaciónes para el Costeo
                                                    </td>
                                                    <td colspan="4">
                                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- OBSERVACIÓN DE TALLAS-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Observaciónes de las Tallas
                                                    </td>
                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                        <textarea class="form-control text-center fw-bold" style="background:#ffff00; color:red;" name="observacion_tallas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('observacion_tallas')) ?></textarea>
                                                    </td>
                                                </tr>

                                                <!-- OBSERVACIÓN DEL STOCK-->
                                                <tr>
                                                    <td class="fw-bold text-center align-middle" style="background:#d9e3f0;">
                                                        Observaciónes del Stock
                                                    </td>
                                                    <td colspan="4" class="text-center fw-bold" style="background:#ffff00; color:red;">
                                                        <textarea class="form-control text-center fw-bold" style="background:#ffff00; color:red;" name="observacion_stock" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?= htmlspecialchars($fv('observacion_stock')) ?></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- CURVA DE TALLAS -->
                                <div class="card shadow-sm border-0 mt-3">
                                    <?php
                                    // Reutilizamos la misma lógica de colores que en la tarjeta de TELA
                                    $colores_curva = [];
                                    for ($i = 1; $i <= 6; $i++) {
                                        $clave = ($i == 1) ? 'color_tela' : 'color_tela' . $i;
                                        if (!empty($fila[$clave])) {
                                            $colores_curva[] = $fila[$clave];
                                        }
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm align-middle text-center mb-0"
                                            id="tablaTallasEx<?php echo $fila['id_producto']; ?>"
                                            data-colores='<?php echo htmlspecialchars(json_encode($colores_curva, JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>'
                                            data-guardadas='<?php echo htmlspecialchars(json_encode($fila, JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?>'>
                                        </table>
                                    </div>
                                </div>

                                <!-- BUTTON -->
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" name="crear_ficha_tecnicaEx" class="btn btn-success">
                                        <i class="bi bi-save"></i> Guardar Ficha Técnica
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pasar a llenar la Ficha Tecnica -->
            <div class="modal fade" id="CambiarEstado<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                <div class="alert alert-warning border-0 shadow-sm rounded-3">
                                    <strong><i class="bi bi-info-circle-fill me-2"></i>Información importante</strong>
                                    <hr class="my-2">
                                    Al continuar, el producto será remitido al área de <strong>Diseño</strong> para finalizar el diligenciamiento de la ficha técnica. Asimismo, la información será compartida con el área de <strong>Compras</strong>, permitiendo iniciar el proceso de adquisición de los insumos requeridos para su fabricación.
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="cambiar_estado" class="btn btn-success">Continuar</button>
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
            const hombre = ["XS", "S", "M", "L", "XL", "2XL", "3XL", "4XL", "5XL", "6XL", "Especial"];
            const dama = ["4", "6", "8", "10", "12", "14", "16", "18", "20", "22", "Especial"];

            document.addEventListener("change", function(e) {
                if (e.target.classList.contains("genero-select")) {
                    construirTabla(e.target);
                }
            });

            function escapeHtml(str) {
                const div = document.createElement("div");
                div.textContent = str;
                return div.innerHTML;
            }

            function construirTabla(generoEl) {
                const idProducto = generoEl.id.replace("generoEx", "").replace("genero", "");

                const tabla = generoEl.id.startsWith("generoEx")
                    ? document.getElementById("tablaTallasEx" + idProducto)
                    : document.getElementById("tablaTallas" + idProducto);
                if (!tabla) return;

                let tallas = [];
                if (generoEl.value === "Hombre") {
                    tallas = hombre;
                } else if (generoEl.value === "Dama" || generoEl.value === "Junior") {
                    tallas = dama;
                }

                if (tallas.length === 0) {
                    tabla.innerHTML = "";
                    return;
                }

                // Colores que vienen desde PHP (color_tela, color_tela2 ... color_tela6)
                let colores = [];
                try {
                    colores = JSON.parse(tabla.dataset.colores || "[]");
                } catch (e) {
                    colores = [];
                }
                if (colores.length === 0) colores = [""]; // fallback: al menos una fila

                // Datos de tallas/stock ya guardados en la ficha (para reconstruir la curva)
                let guardadas = {};
                try {
                    guardadas = JSON.parse(tabla.dataset.guardadas || "{}") || {};
                } catch (e) {
                    guardadas = {};
                }

                let html = `
                    <thead>
                        <tr>
                            <td colspan="${tallas.length + 3}" class="fw-bold" style="background:#ffff00; position:relative; text-align:center;">
                                <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%);">Cant Prendas: ${guardadas['suma_prendas'] ?? 0}</span>
                                CURVA INICIAL
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th style="text-align: center; vertical-align: middle; width: 5%;">Stock</th>
                            <th style="text-align: center; vertical-align: middle; width: 18%;">Color</th>`;
                tallas.forEach(t => {
                    html += `<th style="text-align: center; vertical-align: middle; width: 5%;">${t}</th>`;
                });
                html += `
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Total Unidades</th>
                        </tr>
                    </thead>
                    <tbody id="tbody${idProducto}">`;

                colores.forEach((color, index) => {
                    const g = index + 1; // grupo / color (1..6)
                    const prefijoTalla = (g === 1) ? "talla_" : "talla" + g + "_";
                    const prefijoStock = (g === 1) ? "stock_" : "stock" + g + "_";
                    const colTotalStock = (g === 1) ? "total_stock" : "total_stock" + g;
                    let totalFila = 0;

                    const stockRowId = "filaStock" + idProducto + "_" + g;

                    // ¿Este color ya tiene algo guardado en stock? Si es asi, la fila
                    // arranca visible (no hay que volver a presionar el boton).
                    let tieneStockGuardado = false;
                    tallas.forEach(t => {
                        const key = (t === "Especial") ? "especial" : t;
                        const v = guardadas[prefijoStock + key];
                        if (v !== undefined && v !== null && v !== "" && parseInt(v) !== 0) tieneStockGuardado = true;
                    });
                    const claseVisibilidadStock = tieneStockGuardado ? "" : "d-none";

                    html += `<tr id="filaTalla${idProducto}_${g}" data-group="${g}" data-producto="${idProducto}">
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-warning btn-sm rounded-pill shadow-sm btn-toggle-stock" data-target="${stockRowId}">
                                <i class="bi bi-box-seam-fill me-1"></i>Stock
                            </button>
                        </td>
                        <td class="text-center align-middle">
                            <span class="fw-bold">${g} - ${escapeHtml(color)}</span>
                            <input type="hidden" name="color[]" value="${escapeHtml(color)}">
                        </td>`;
                    tallas.forEach((t, i) => {
                        const key = (t === "Especial") ? "especial" : t;
                        let val = guardadas[prefijoTalla + key];
                        val = (val === undefined || val === null) ? "" : val;
                        if (val !== "") totalFila += parseInt(val) || 0;
                        html += `<td>
                            <input type="number" min="0" value="${val}" class="form-control form-control-sm text-center cantidad" name="cantidad_${i}[]" style="text-align:center;">
                        </td>`;
                    });
                    html += `<td>
                        <input type="text" readonly value="${totalFila}" class="form-control form-control-sm text-center totalFila" style="text-align:center;">
                    </td>
                    </tr>`;

                    // Fila de STOCK de este color (con color distinto para diferenciar; visible
                    // desde el inicio si ya tenia datos guardados)
                    const totalStockGuardado = guardadas[colTotalStock];
                    const totalStockInicial = (totalStockGuardado === undefined || totalStockGuardado === null || totalStockGuardado === "") ? 0 : (parseInt(totalStockGuardado) || 0);

                    html += `<tr id="${stockRowId}" class="${claseVisibilidadStock} table-warning" data-group="${g}" data-producto="${idProducto}">
                        <td></td>
                        <td class="text-center align-middle">
                            <span class="fw-bold">Stock en Color: ${escapeHtml(color)}</span>
                        </td>`;
                    tallas.forEach((t, i) => {
                        const key = (t === "Especial") ? "especial" : t;
                        let val = guardadas[prefijoStock + key];
                        val = (val === undefined || val === null) ? "" : val;
                        html += `<td>
                            <input type="number" min="0" value="${val}" class="form-control form-control-sm text-center stock-input" name="stock_${i}[]" style="text-align:center;">
                        </td>`;
                    });
                    html += `<td>
                            <input type="text" readonly value="${totalStockInicial}" class="form-control form-control-sm text-center totalStockFila" style="text-align:center;">
                        </td>
                    </tr>`;
                });

                // Fila de resumen general (unidades_totales = suma de todos los colores, tallas + stock)
                const unidadesTotalesGuardadas = guardadas['unidades_totales'];
                let unidadesTotalesIniciales = 0;
                if (unidadesTotalesGuardadas !== undefined && unidadesTotalesGuardadas !== null && unidadesTotalesGuardadas !== "") {
                    unidadesTotalesIniciales = parseInt(unidadesTotalesGuardadas) || 0;
                }
                html += `<tr class="table-info fw-bold" id="filaResumen${idProducto}">
                    <td colspan="${tallas.length + 2}" class="text-end">Unidades Totales</td>
                    <td class="text-center">
                        <input type="text" readonly value="${unidadesTotalesIniciales}" class="form-control form-control-sm text-center fw-bold unidadesTotalesFila" style="text-align:center;">
                    </td>
                </tr>`;

                html += `</tbody>`;

                tabla.innerHTML = html;

                // Recalcula Total Unidades de un color especifico, y el resumen general
                function recomputarGrupo(g) {
                    const filaTalla = tabla.querySelector(`#filaTalla${idProducto}_${g}`);
                    const filaStock = tabla.querySelector(`#filaStock${idProducto}_${g}`);
                    if (!filaTalla) return;

                    let totalTallas = 0;
                    filaTalla.querySelectorAll(".cantidad").forEach(c => {
                        totalTallas += parseInt(c.value) || 0;
                    });

                    const totalFilaEl = filaTalla.querySelector(".totalFila");
                    if (totalFilaEl) totalFilaEl.value = totalTallas;

                    let totalStock = 0;
                    if (filaStock) {
                        filaStock.querySelectorAll(".stock-input").forEach(c => {
                            totalStock += parseInt(c.value) || 0;
                        });
                        const totalStockFilaEl = filaStock.querySelector(".totalStockFila");
                        if (totalStockFilaEl) totalStockFilaEl.value = totalStock;
                    }

                    recomputarResumenGeneral();
                }

                // Suma (tallas + stock) de TODOS los colores
                function recomputarResumenGeneral() {
                    let totalGeneral = 0;
                    tabla.querySelectorAll('tr[id^="filaTalla' + idProducto + '_"]').forEach(fila => {
                        const g = fila.dataset.group;
                        let totalTallas = 0;
                        fila.querySelectorAll(".cantidad").forEach(c => totalTallas += parseInt(c.value) || 0);
                        let totalStock = 0;
                        const filaStock = tabla.querySelector(`#filaStock${idProducto}_${g}`);
                        if (filaStock) {
                            filaStock.querySelectorAll(".stock-input").forEach(c => totalStock += parseInt(c.value) || 0);
                        }
                        totalGeneral += totalTallas + totalStock;
                    });
                    const resumenEl = tabla.querySelector(".unidadesTotalesFila");
                    if (resumenEl) resumenEl.value = totalGeneral;
                }

                // Botones "+": muestran/ocultan la fila de stock de ESE color unicamente
                tabla.querySelectorAll(".btn-toggle-stock").forEach(btn => {
                    btn.addEventListener("click", function() {
                        const fila = document.getElementById(this.dataset.target);
                        if (fila) fila.classList.toggle("d-none");
                    });
                });

                // Recalcular cuando cambian las cantidades de tallas
                tabla.querySelectorAll(".cantidad").forEach(input => {
                    input.addEventListener("input", function() {
                        const g = this.closest("tr").dataset.group;
                        recomputarGrupo(g);
                    });
                });

                // Recalcular cuando cambian las cantidades de stock
                tabla.querySelectorAll(".stock-input").forEach(input => {
                    input.addEventListener("input", function() {
                        const g = this.closest("tr").dataset.group;
                        recomputarGrupo(g);
                    });
                });
            }

            // Al cargar la pagina, reconstruir la curva de tallas para los productos
            // que ya tienen genero guardado en su ficha tecnica (modo edicion).
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".genero-select").forEach(function(sel) {
                    if (sel.value) construirTabla(sel);
                });
            });
        </script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function() {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
    </body>
</html>