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

        <!-- Import FilePond styles -->
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

        <!-- Para los estilos -->
        <link rel="stylesheet" href="../../css/barra.css">
        <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/estilo_base.css">
        <link rel="icon" type="image/png" href="../../img/Logo.png">

        <title>Comercial | Solicitud de Pedido 2</title>
    <head>
    
    <body>
        <?php
        $consulta = "SELECT id_usuario FROM usuario ";
        ?>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="../../img/Logo.png" alt="Logo" width="70" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
                </a>
                <a href="pedido_confirmado_comercial.php?id_usuario=<?php echo $id_usuario; ?>" class="btn active btn-primary" style="margin-left: 10px;">
                    <i class="bi bi-arrow-bar-left"></i> Volver
                </a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Pedidos en Espera</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

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
            $fila = mysqli_fetch_assoc($resultado) 
        ?>

        <!-- Productos -->
        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                mysqli_data_seek($resultado, 0);
                while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                <?php if ($fila['id_tipo_producto'] != 8): ?>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="modal-content rounded-4 modal-fullscreen">
                            <div class="modal-header" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%); border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?></h5>
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
                                    <?php if (!empty($imagenProducto1) || !empty($imagenProducto2) || !empty($imagenProducto3) || !empty($imagenProducto4)): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-2">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes de Guía</h6>
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <?php if (!empty($imagenProducto1)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto1_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto2)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto2_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto3)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto3_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto4)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto4_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Modales para imágenes -->
                                    <?php if (!empty($imagenProducto1)): ?>
                                        <div class="modal fade" id="modalImagenProducto1_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($imagenProducto2)): ?>
                                        <div class="modal fade" id="modalImagenProducto2_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto2" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($imagenProducto3)): ?>
                                        <div class="modal fade" id="modalImagenProducto3_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto3" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($imagenProducto4)): ?>
                                        <div class="modal fade" id="modalImagenProducto4_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto4" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded">
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

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <div class="mb-2 row">
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p></div>
                                    </div>
                                </div>

                                <!-- Datos de la solicitud -->
                                <div class="card-text-container">
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p></div>
                                        <?php if (!empty($fila['mangas'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Mangas:</span> <?= $fila['mangas'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cuello'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cuello:</span> <?= $fila['cuello'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['puño'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Puño:</span> <?= $fila['puño'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['boton'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Boton:</span> <?= $fila['boton'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cremallera'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cremallera:</span> <?= $fila['cremallera'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_combi'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Combinados:</span> <?= $fila['ubica_combi'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_reflectivos'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Reflectivos:</span> <?= $fila['ubica_reflectivos'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['marca_tallaje'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['logo'])): ?>
                                            <div><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p></div>
                                        <?php endif; ?>     
                                        <div class="row mb-1">
                                            <?php if (!empty($fila['id_tipo_logo'])): ?>
                                                <div class="col"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p></div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_cartera'])): ?>
                                                <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row mb-1">
                                            <?php if (!empty($fila['cant_bolsillos'])): ?>
                                                <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p></div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_tablon'])): ?>
                                                <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p></div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($fila['observaciones'])):?>
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p></div>
                                            </div>
                                        <?php endif;?>
                                        <?php if (!empty($fila['obs_logo'])):?>
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p></div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <!---->

                                <?php if (!empty($fila['observaciones_cotizacion'])):?>
                                    <div class="card-text-container">
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones Sobre la Cotizacion</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_cotizacion'] ?></p></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Prenda y la Tela</h6>
                                    <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela Cotizado:</span> <?= $fila['tela'] ?></p></div>
                                    <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['nombre_prenda'] ?></p></div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Prenda:</span> <?= $fila['promedio_consumo'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de Tela:</span> $<?= $fila['precio_tela'] ?></p></div>
                                    </div>
                                    <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Valor Tela:</span> $<?= $fila['valor_tela'] ?></p></div>
                                </div>

                                <?php
                                    $secciones = [
                                        ['id' => 'telacombi', 'titulo' => 'Datos de la Tela Combinada', 'nombre' => 'tela_combi', 'precio' => 'precio_telacombinada', 'promedio' => 'promedio_telacombi', 'valor' => 'valor_telacombi'],
                                        ['id' => 'telaforro', 'titulo' => 'Datos Tela Forro', 'nombre' => 'tela_forro', 'precio' => 'precio_forro', 'promedio' => 'promedio_forro', 'valor' => 'valor_forro']
                                    ];

                                    foreach ($secciones as $seccion):
                                        if ($fila["id_{$seccion['id']}"] > 0): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila[$seccion['nombre']] ?></p>
                                                <div class="row">
                                                    <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Promedio:</span> <?= $fila[$seccion['promedio']] ?></p></div>
                                                    <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Metro/Unidad:</span> $<?= $fila[$seccion['precio']] ?></p></div>
                                                </div>
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Valor Tela:</span> $<?= $fila[$seccion['valor']] ?></p></div>
                                            </div>
                                        <?php endif;
                                    endforeach;
                                ?>

                                <?php 
                                    $secciones = [
                                        ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'precio' => 'precio_cuello', 'valor' => 'valor_cuello'],
                                        ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'precio' => 'precio_puño', 'valor' => 'valor_puño'],
                                        ['id' => 'boton', 'titulo' => 'Datos del Botón', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'valor' => 'valor_boton'],
                                        ['id' => 'boton2', 'titulo' => 'Datos del Botón Secundario', 'insumo' => 'insumo_boton2', 'consumo' => 'cant_boton2', 'precio' => 'precio_boton2', 'valor' => 'valor_boton2'],
                                        ['id' => 'entretela', 'titulo' => 'Datos de la Entrela', 'insumo' => 'insumo_entretela', 'consumo' => 'cant_entretela', 'precio' => 'precio_entretela', 'valor' => 'valor_entretela'],
                                        ['id' => 'fusionado', 'titulo' => 'Datos del Fusionado', 'insumo' => 'insumo_fusionado', 'consumo' => 'consumo_fusionado', 'precio' => 'precio_fusionado', 'valor' => 'valor_fusionado'],
                                        ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera 1', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'valor' => 'valor_cremallera'],
                                        ['id' => 'cremallera2', 'titulo' => 'Datos de la Cremallera 2', 'insumo' => 'insumo_cremallera2', 'consumo' => 'cant_cremallera2', 'precio' => 'precio_cremallera2', 'valor' => 'valor_cremallera2'],
                                        ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'precio' => 'precio_velcro', 'valor' => 'valor_velcro'],
                                        ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'valor' => 'valor_cinta'],
                                        ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'valor' => 'valor_faya'],
                                        ['id' => 'resorte', 'titulo' => 'Datos del Resorte 1', 'insumo' => 'insumo_resorte2', 'consumo' => 'cant_resorte2', 'precio' => 'precio_resorte2', 'valor' => 'valor_resorte2'],
                                        ['id' => 'resorte2', 'titulo' => 'Datos del Resorte 2', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'precio' => 'precio_resorte', 'valor' => 'valor_resorte'],
                                        ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'precio' => 'precio_hombrera', 'valor' => 'valor_hombrera'],
                                        ['id' => 'sesgo', 'titulo' => 'Datos del Sesgo', 'insumo' => 'insumo_sesgo', 'consumo' => 'cant_sesgo', 'precio' => 'precio_sesgo', 'valor' => 'valor_sesgo'],
                                        ['id' => 'trabilla', 'titulo' => 'Datos de la Trabilla', 'insumo' => 'insumo_trabilla', 'consumo' => 'cant_trabilla', 'precio' => 'precio_trabilla', 'valor' => 'valor_trabilla'],
                                        ['id' => 'vivo', 'titulo' => 'Datos del Vivo', 'insumo' => 'insumo_vivo', 'consumo' => 'cant_vivo', 'precio' => 'precio_vivo', 'valor' => 'valor_vivo'],
                                        ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'precio' => 'precio_guata', 'valor' => 'valor_guata'],
                                        ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'precio' => 'precio_pretina', 'valor' => 'valor_pretina'],
                                        ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'precio' => 'precio_broche', 'valor' => 'valor_broche'],
                                        ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'precio' => 'precio_cordon', 'valor' => 'valor_cordon'],
                                        ['id' => 'puntera', 'titulo' => 'Datos de la Puntera', 'insumo' => 'insumo_puntera', 'consumo' => 'cant_puntera', 'precio' => 'precio_puntera', 'valor' => 'valor_puntera'],
                                        ['id' => 'plumilla', 'titulo' => 'Datos del plumilla', 'insumo' => 'insumo_plumilla', 'consumo' => 'cant_plumilla', 'precio' => 'precio_plumilla', 'valor' => 'valor_plumilla'],
                                        ['id' => 'vinilo', 'titulo' => 'Datos de la vinilo', 'insumo' => 'insumo_vinilo', 'consumo' => 'cant_vinilo', 'precio' => 'precio_vinilo', 'valor' => 'valor_vinilo'],
                                    ];

                                    foreach ($secciones as $seccion):
                                        if ($fila["id_{$seccion['id']}"] > 0): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Insumo:</span> <?= $fila[$seccion['insumo']] ?></p>
                                                <div class="row">
                                                    <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo o Cantidad:</span> <?= $fila[$seccion['consumo']] ?></p></div>
                                                    <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Metro/Unidad:</span> $<?= $fila[$seccion['precio']] ?></p></div>
                                                </div>
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila[$seccion['valor']] ?></p></div>
                                            </div>
                                        <?php endif;
                                    endforeach;
                                ?>  
                                    
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                    <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p></div>
                                    <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_obra'] ?></p></div>
                                </div>

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Logistica:</span> $<?= $fila['precio_logistica'] ?></p>
                                        </div>
                                        <?php if (!empty($fila['precio_bordado'])):?>
                                            <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Bordado:</span> $<?= $fila['precio_bordado'] ?></p></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="row">
                                        <?php if (!empty($fila['precio_estampado'])):?>
                                            <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Estampado:</span> $<?= $fila['precio_estampado'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['valor_flete'])):?>
                                            <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del flete:</span> $<?= $fila['valor_flete'] ?></p></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="row">
                                        <?php if (!empty($fila['id_bolsa'])):?>
                                            <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de la Bolsa:</span> $<?= $fila['precio_bolsa'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_marquilla'])):?>
                                            <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de la Marquilla:</span> $<?= $fila['precio_marquilla'] ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                    <?php if (!empty($fila['id_diseño'])):?>
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tiene diseño:</span> <?= $fila['opcion_diseño'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del diseño:</span> $<?= $fila['valor_diseño'] ?></p></div>
                                    <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <?php if (!empty($fila['id_corte'])): ?>
                                            <div class="col-md-6">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cant. Corte:</span> <?= $fila['cant_corte'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Corte:</span> $<?= $fila['precio_corte'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Margen Bruto:</span> <?= $fila['margen_bruto'] ?></p></div>
                                        <?php if (!empty($fila['valor_porcentajeestampilla'])):?>
                                            <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Estampilla:</span> <?= $fila['valor_porcentajeestampilla'] ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo de Produccion</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Unitario Sin Iva</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Unitario con Iva Incluido</h6>
                                        <span class="card-title font-weight-bold text-danger" style="font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                        <span class="card-title font-weight-bold text-danger" style="font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
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
                                <!-- Cargar imagen -->
                                <div>
                                    <?php
                                        $imagenProducto1 = $fila['imagen'];
                                        $imagenProducto2 = $fila['imagen2'];
                                        $imagenProducto3 = $fila['imagen3'];
                                        $imagenProducto4 = $fila['imagen4'];
                                    ?>
                                    <?php if (!empty($imagenProducto1) || !empty($imagenProducto2) || !empty($imagenProducto3) || !empty($imagenProducto4)): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-2">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes de Guía</h6>
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <?php if (!empty($imagenProducto1)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto1_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto2)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto2_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto3)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto3_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto4)): ?>
                                                    <div class="text-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" 
                                                            class="img-fluid rounded shadow-sm img-thumbnail" 
                                                            style="width: 110px; height: 110px; object-fit: cover;" 
                                                            data-toggle="modal" data-target="#modalImagenProducto4_<?= $contador_producto ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Modales para imágenes -->
                                    <?php if (!empty($imagenProducto1)): ?>
                                        <div class="modal fade" id="modalImagenProducto1_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($imagenProducto2)): ?>
                                        <div class="modal fade" id="modalImagenProducto2_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto2" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($imagenProducto3)): ?>
                                        <div class="modal fade" id="modalImagenProducto3_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto3" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($imagenProducto4)): ?>
                                        <div class="modal fade" id="modalImagenProducto4_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto4" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <img src="../../img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded">
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

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <div class="mb-2 row">
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p></div>
                                    </div>
                                </div>

                                <!-- Datos de la solicitud -->
                                <div class="card-text-container">
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p></div>
                                        <?php if (!empty($fila['mangas'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Mangas:</span> <?= $fila['mangas'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cuello'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cuello:</span> <?= $fila['cuello'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['puño'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Puño:</span> <?= $fila['puño'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['boton'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Boton:</span> <?= $fila['boton'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cremallera'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cremallera:</span> <?= $fila['cremallera'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_combi'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Combinados:</span> <?= $fila['ubica_combi'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_reflectivos'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Reflectivos:</span> <?= $fila['ubica_reflectivos'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['marca_tallaje'])): ?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['logo'])): ?>
                                            <div><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p></div>
                                        <?php endif; ?>     
                                        <div class="row mb-1">
                                            <?php if (!empty($fila['id_tipo_logo'])): ?>
                                                <div class="col"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p></div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_cartera'])): ?>
                                                <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row mb-1">
                                            <?php if (!empty($fila['cant_bolsillos'])): ?>
                                                <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p></div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_tablon'])): ?>
                                                <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p></div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($fila['observaciones'])):?>
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p></div>
                                            </div>
                                        <?php endif;?>
                                        <?php if (!empty($fila['obs_logo'])):?>
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p></div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <!---->

                                <?php if (!empty($fila['observaciones_cotizacion'])):?>
                                    <div class="card-text-container">
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones Sobre la Cotizacion</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_cotizacion'] ?></p></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Margen Bruto:</span> <?= $fila['margen_bruto'] ?></p></div>
                                        <?php if (!empty($fila['valor_porcentajeestampilla'])):?>
                                            <div class="col-md-6"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Estampilla:</span> <?= $fila['valor_porcentajeestampilla'] ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra del Producto</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Unitario Sin Iva</h6>
                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Unitario con Iva Incluido</h6>
                                        <span class="card-title font-weight-bold text-danger" style="font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                        <span class="card-title font-weight-bold text-danger" style="font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                            $ <?= $precio_formateado ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?> 
                <?php
                    $contador_producto++; // Incrementar contador de productos
                }?>
            </div>
        </div>

        <!-- Modales eliminar y editar-->  
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
        ?>

        <!-- Aceptar Cotizacion -->
        <div class="modal fade" id="modalAceptar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            Si oprime continuar la cotizacion pasara a ser visualizada por gerencia para ser enviada al cliente.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                            <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                            <button type="submit" name="aceptar_cotizacion" class="btn btn-success">continuar</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rechazar Cotizacion -->
        <div class="modal fade" id="modalRechazar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            Si oprime continuar la cotizacion pasara a ser visualizada por la Gerencia para realizar los cambios necesarios.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                            <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                            <button type="submit" name="rechazar_cotizacion" class="btn btn-success">continuar</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        }
        ?>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx-style@0.8.13/dist/xlsx-style.min.js"></script>
    </body>
</html>