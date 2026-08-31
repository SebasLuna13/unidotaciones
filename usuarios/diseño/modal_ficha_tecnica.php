
                                        <div class="modal-dialog modal-dialog-centered mw-100 w-100 px-5">
                                            <div class="modal-content shadow-lg border-0 rounded-4">

                                                <!--<div class="modal-header text-white justify-content-center position-relative" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                    <div class="d-flex align-items-center text-center">
                                                        <img src="../../img/unidotaciones.png" alt="Logo" width="150" class="me-3 rounded">
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="text-white text-center py-2 fw-bold" style="background-color:#18a000;">
                                                    FICHA TÉCNICA DE PRODUCCIÓN
                                                </div>-->

                                                <?php
                                                $consultaFicha = "SELECT pedido.id_pedido, producto.id_producto, producto.num_ficha, prenda.id_prenda, pedido.fecha_pedido, producto.fecha_fichatecnica, prenda.nombre_prenda, cliente.nit, cliente.cliente, producto.suma_prendas, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4,
                                                                producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.estado, orden_compra.id_ordencompra, orden_compra.prendas_comprar, orden_compra.precio_prendacompra,
                                                                producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14,
                                                                producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.talla_26, producto.talla_28, producto.talla_30, producto.talla_32, producto.talla_34, producto.talla_36, producto.talla_38, producto.talla_40, producto.talla_42, producto.talla_44, producto.talla_46, producto.talla_48, producto.talla_especial, 
                                                                producto.id_mano_obra, mano_obra.id_mano_obra, mano_obra.producto, mano_obra.id_tipo_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda,
                                                                
                                                                
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
                                                                LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra
                                                                LEFT JOIN tipo_prenda ON mano_obra.id_tipo_prenda = tipo_prenda.id_tipo_prenda
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
                                                                <input type="hidden" name="id_producto" value="<?php echo $filaFicha['id_producto']; ?>">
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
                                                                                    <td><?php echo date('d/m/Y', strtotime($filaFicha['fecha_pedido'])); ?></td>
                                                                                    <td><?php echo date('d/m/Y', strtotime($filaFicha['fecha_fichatecnica'])); ?></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- ENCABEZADO FICHA -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <?php
                                                                    $meses = [1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'];

                                                                    $dias = ['Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado', 'Sunday' => 'Domingo'];

                                                                    $fecha = new DateTime($filaFicha['fecha_pedido']);
                                                                    $diaSemana = $dias[$fecha->format('l')];
                                                                    ?>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <!-- BLOQUE IZQUIERDO 40% -->
                                                                                    <td class="fw-bold text-end" style="width:12%;">Fecha Pedido:</td>
                                                                                    <td class="text-center" style="width:28%;">
                                                                                        <?= $diaSemana . ', ' . $fecha->format('d') . ' de ' . $meses[$fecha->format('n')] . ' del ' . $fecha->format('Y'); ?>
                                                                                    </td>

                                                                                    <!-- BLOQUE DERECHO 60% -->
                                                                                    <td class="fw-bold text-center" style="width:11%;">FDE</td>
                                                                                    <td style="width:20%;"></td>

                                                                                    <td class="fw-bold text-center" style="width:17%;">
                                                                                        Número de Ficha
                                                                                    </td>
                                                                                    <td class="text-center fw-bold" style="width:12%; background:#ffff00;">
                                                                                        <?php echo $filaFicha['num_ficha']; ?>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="fw-bold text-end">Ciudad:</td>
                                                                                    <td class="text-center">PEREIRA</td>

                                                                                    <td class="fw-bold text-center">Cliente:</td>
                                                                                    <td class="text-center fw-bold" colspan="3" style="color:red;">
                                                                                        <?php echo $filaFicha['cliente']; ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="fw-bold text-end">Destino:</td>
                                                                                    <td class="text-center">UNIDOTACIONES DEL EJE S.A.S</td>

                                                                                    <td class="fw-bold text-center">NIT:</td>
                                                                                    <td></td>

                                                                                    <td class="fw-bold text-center">Forma de Pago:</td>
                                                                                    <td></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="fw-bold text-end">Cuenta:</td>
                                                                                    <td class="text-center">9.011.918.976</td>

                                                                                    <td class="fw-bold text-center">Dirección:</td>
                                                                                    <td class="text-center" colspan="3"></td>
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

                                                                <!-- TIPO PRENDA -->
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
                                                                                    <th style="text-align: center; vertical-align: middle; width: 7%;">Muestra F</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 16%;">Cuello</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 13%;">Tipo de Empaque</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['producto']); ?></td>
                                                                                    <td>
                                                                                        <?php if (in_array($filaFicha['id_tipo_prenda'], [1, 2, 5, 6])) { ?>
                                                                                            <select name="manga" class="form-select form-select-sm">
                                                                                                <option value=""></option>
                                                                                                <option value="Larga">Larga</option>
                                                                                                <option value="Corta">Corta</option>
                                                                                                <option value="Sisa">Sisa</option>
                                                                                                <option value="Al Codo">Al Codo</option>
                                                                                                <option value="Japonesa">Japonesa</option>
                                                                                                <option value="Rodada">Rodada</option>
                                                                                                <option value="Ranglan">Ranglan</option>
                                                                                                <option value="3/4">3/4</option>
                                                                                                <option value="Clásico">Clásico</option>
                                                                                                <option value="Informal">Informal</option>
                                                                                            </select>
                                                                                        <?php } else { ?>
                                                                                            <input type="text" class="form-control form-control-sm" value="" readonly>
                                                                                        <?php } ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <select name="genero" class="form-select form-select-sm">
                                                                                            <option value=""></option>
                                                                                            <option value="Dama">Dama</option>
                                                                                            <option value="Hombre">Hombre</option>
                                                                                            <option value="Junior">Junior</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>UDE</td>
                                                                                    <td style="background:#ffff00;"></td>
                                                                                    <td></td>
                                                                                    <td style="background:#ffff00;"></td>
                                                                                    <td></td>
                                                                                    <td>
                                                                                        <?php if (in_array($filaFicha['id_tipo_prenda'], [1, 2, 5, 6])) { ?>
                                                                                            <select name="cuello" class="form-select form-select-sm">
                                                                                                <option value=""></option>
                                                                                                <option value="Botón Down">Botón Down</option>
                                                                                                <option value="Botón Down Oculto">Botón Down Oculto</option>
                                                                                                <option value="Sin Botón Down">Sin Botón Down</option>
                                                                                                <option value="Sport">Sport</option>
                                                                                                <option value="Camisero">Camisero</option>
                                                                                                <option value="Tejido">Tejido</option>
                                                                                                <option value="Y Puños Tejidos">Y Puños Tejidos</option>
                                                                                                <option value="Y Puños en la misma tela">Y Puños en la misma tela</option>
                                                                                                <option value="Sastre">Sastre</option>
                                                                                                <option value="Smoking">Smoking</option>
                                                                                                <option value="En V">En V</option>
                                                                                                <option value="Corbata">Corbata</option>
                                                                                                <option value="Nerhú">Nerhú</option>
                                                                                            </select>
                                                                                        <?php } else { ?>
                                                                                            <input type="text" class="form-control form-control-sm" value="" readonly>
                                                                                        <?php } ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <select name="empaque" class="form-select form-select-sm">
                                                                                            <option value=""></option>
                                                                                            <option value="Doblada">Doblada</option>
                                                                                            <option value="Colgada">Colgada</option>
                                                                                            <option value="Doblado casero">Doblado casero</option>
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
                                                                    $id_tela = $filaFicha['id_tela'];
                                                                    $color_tela = $filaFicha['color_tela'];

                                                                    $consulta_1 = "SELECT producto.id_tela, tela.id_tela, tela.caracteristicas AS caracteristicas_tela, tela.ancho AS ancho_tela, tela.rendimiento AS rendimiento_tela, tela.id_proveedor, proveedor_tela.nombre AS nombre_tela                                                            
                                                                            FROM producto
                                                                            LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.id_tela = '$id_tela'";

                                                                    $resultado_1 = mysqli_query($enlace, $consulta_1);

                                                                    $fila1 = mysqli_fetch_array($resultado_1)
                                                                    ?>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle text-center mb-0">
                                                                            <thead>
                                                                                <tr class="table-primary">
                                                                                    <th style="text-align: center; vertical-align: middle; width: 20%;">Codigo</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 20%;">Composicion</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                                                    <th style="text-align: center; vertical-align: middle; width: 20%;">AREA</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['color_tela']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($filaFicha['tela']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($fila1['caracteristicas_tela']); ?></td>
                                                                                    <td><?php echo htmlspecialchars($fila1['ancho_tela']); ?></td>
                                                                                    <td style="background:#ffff00;"><input type="text" class="form-control" style="background:#ffff00;" name="area" pattern="[A-Za-z0-9.# %+-]+" maxlength="300"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- TELA COMBINADA -->
                                                                <?php if (!empty($filaFicha['id_telacombi'])): ?>
                                                                    <div class="card shadow-sm border-0 mb-3">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm align-middle mb-0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fw-bold text-end" style="width:10%;">Combinado</td>
                                                                                        <td style="width:90%;">
                                                                                            <input type="text" class="form-control" name="ubicacion_combinado" pattern="[A-Za-z0-9.# %+-]+" maxlength="300">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                        $id_telacombi = $filaFicha['id_telacombi'];
                                                                        $color_telacombi = $filaFicha['color_telacombi'];

                                                                        $consulta_2 = "SELECT producto.id_telacombi, tela_combinada.id_telacombi, tela_combinada.caracteristicas AS caracteristicas_combinado, tela_combinada.ancho AS ancho_combinado, tela_combinada.rendimiento AS rendimiento_combinado, tela_combinada.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                                                                                                FROM producto
                                                                                                                LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.id_telacombi = '$id_telacombi'";

                                                                        $resultado_2 = mysqli_query($enlace, $consulta_2);

                                                                        $fila2 = mysqli_fetch_array($resultado_2)
                                                                    ?>

                                                                    <div class="card shadow-sm border-0 mb-3" style="max-width: 1100px;">
                                                                        <div class="table-responsive">
                                                                            <table id="mytabla" class="table table-bordered table-sm text-center mb-0">
                                                                                <thead>
                                                                                    <tr class="table-primary">
                                                                                        <th style="text-align: center; vertical-align: middle; width: 20%;">Código</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 20%;">Composición</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['color_telacombi']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['tela_combi']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($fila2['caracteristicas_combinado']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($fila2['ancho_combinado']); ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <!-- TELA FORRO -->
                                                                <?php if (!empty($filaFicha['id_telaforro'])): ?>

                                                                    <div class="card shadow-sm border-0 mb-3">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm align-middle mb-0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fw-bold text-end" style="width:10%;">Forro</td>
                                                                                        <td style="width:90%;">
                                                                                            <input type="text" class="form-control" name="ubicacion_forro" pattern="[A-Za-z0-9.# %+-]+" maxlength="300">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                    $id_telaforro = $filaFicha['id_telaforro'];

                                                                    $consulta_3 = "SELECT producto.id_telaforro, tela_forro.id_telaforro, tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.ancho AS ancho_forro, tela_forro.rendimiento AS rendimiento_forro, tela_forro.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                                                                    FROM producto
                                                                                    LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.id_telaforro = '$id_telaforro'";

                                                                    $resultado_3 = mysqli_query($enlace, $consulta_3);
                                                                    $fila3 = mysqli_fetch_array($resultado_3);
                                                                    ?>

                                                                    <div class="card shadow-sm border-0 mb-3" style="max-width: 1100px;">
                                                                        <div class="table-responsive">
                                                                            <table id="mytabla" class="table table-bordered table-sm text-center mb-0">
                                                                                <thead>
                                                                                    <tr class="table-primary">
                                                                                        <th style="text-align: center; vertical-align: middle; width: 20%;">Código</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 20%;">Composición</th>
                                                                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Ancho</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['color_telaforro']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($filaFicha['tela_forro']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($fila3['caracteristicas_forro']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($fila3['ancho_forro']); ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                <?php endif; ?>

                                                                <!-- CODIGOS DE MOLDE -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">
                                                                            <tbody>

                                                                                <!-- TITULO -->
                                                                                <tr>
                                                                                    <td colspan="6" class="text-center fw-bold"
                                                                                        style="background:#ffff00; font-size:18px;">
                                                                                        Codigos de Molde
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- NOMBRE PRENDA -->
                                                                                <tr>
                                                                                    <td colspan="6"
                                                                                        class="text-center fw-bold"
                                                                                        style="background:#a8d0ff; font-size:28px;">
                                                                                        <input type="text" class="form-control" style="background:#a8d0ff;" name="ubicacion_combinado" pattern="[A-Za-z0-9.# %+-]+" maxlength="300">
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- CODIGOS -->
                                                                                <tr>
                                                                                    <td style="width:15%;"></td>
                                                                                    <td style="width:17%;">
                                                                                        <input type="text" class="form-control form-control-sm"
                                                                                            name="codigo_molde1">
                                                                                    </td>
                                                                                    <td style="width:17%;">
                                                                                        <input type="text" class="form-control form-control-sm"
                                                                                            name="codigo_molde2">
                                                                                    </td>
                                                                                    <td style="width:17%;">
                                                                                        <input type="text" class="form-control form-control-sm"
                                                                                            name="codigo_molde3">
                                                                                    </td>
                                                                                    <td class="fw-bold text-center" style="width:12%;">
                                                                                        Puño
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" class="form-control form-control-sm"
                                                                                            name="codigo_puno">
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- BORDADO -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center align-middle">
                                                                                        BORDADO
                                                                                    </td>

                                                                                    <td colspan="5"
                                                                                        style="background:#ffff00; height:100px;">
                                                                                        <textarea class="form-control border-0"
                                                                                                style="background:#ffff00; resize:none; height:100px;"
                                                                                                name="bordado"></textarea>
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- OJALES -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center"
                                                                                        style="background:#d9e3f0;">
                                                                                        Ojales
                                                                                    </td>
                                                                                    <td colspan="5">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-sm"
                                                                                            name="ojales">
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- BOTONES -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center"
                                                                                        style="background:#d9e3f0;">
                                                                                        Botones
                                                                                    </td>
                                                                                    <td colspan="5">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-sm"
                                                                                            name="botones">
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- FDD Y COSER -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center"
                                                                                        style="background:#d9e3f0;">
                                                                                        FDD
                                                                                    </td>

                                                                                    <td colspan="2">
                                                                                        <input type="date"
                                                                                            class="form-control form-control-sm"
                                                                                            name="fdd">
                                                                                    </td>

                                                                                    <td class="fw-bold text-center"
                                                                                        style="background:#d9e3f0;">
                                                                                        Coser
                                                                                    </td>

                                                                                    <td colspan="2"
                                                                                        class="text-center fw-bold"
                                                                                        style="background:#ffff00; color:red;">
                                                                                        <input type="text"
                                                                                            class="form-control text-center fw-bold border-0"
                                                                                            style="background:#ffff00; color:red;"
                                                                                            name="coser">
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- REF SUGERIDA -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center"
                                                                                        style="background:#d9e3f0;">
                                                                                        Ref sugerida
                                                                                    </td>

                                                                                    <td colspan="5">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-sm"
                                                                                            name="ref_sugerida">
                                                                                    </td>
                                                                                </tr>

                                                                                <!-- OBSERVACION -->
                                                                                <tr>
                                                                                    <td class="fw-bold text-center"
                                                                                        style="background:#d9e3f0;">
                                                                                        Observación
                                                                                    </td>

                                                                                    <td colspan="5"
                                                                                        style="background:#ffff00; height:100px;">
                                                                                        <textarea class="form-control border-0 text-center fw-bold"
                                                                                                style="background:#ffff00;
                                                                                                        color:red;
                                                                                                        font-size:32px;
                                                                                                        resize:none;
                                                                                                        height:100px;"
                                                                                                name="observacion"></textarea>
                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- CURVAS Y CORTE -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle text-center mb-0">

                                                                            <!-- CURVA INICIAL -->
                                                                            <tr>
                                                                                <td colspan="13" class="fw-bold text-danger"
                                                                                    style="background:#ffff00;">
                                                                                    CURVA INICIAL
                                                                                </td>
                                                                            </tr>

                                                                            <tr class="table-secondary">
                                                                                <td class="fw-bold" style="width:15%;">Color / Talla</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td class="fw-bold" style="width:12%;">Total Uds</td>
                                                                            </tr>

                                                                            <?php for($i=1; $i<=5; $i++): ?>
                                                                            <tr>
                                                                                <td class="fw-bold"><?php echo $i; ?></td>

                                                                                <?php for($j=1; $j<=11; $j++): ?>
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-sm border-0 text-center"
                                                                                            name="curva_inicial_<?php echo $i.'_'.$j; ?>">
                                                                                    </td>
                                                                                <?php endfor; ?>

                                                                                <td class="fw-bold bg-light">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm border-0 text-center fw-bold"
                                                                                        name="total_curva_inicial_<?php echo $i; ?>"
                                                                                        readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <?php endfor; ?>

                                                                            <!-- TOTAL GENERAL -->
                                                                            <tr>
                                                                                <td colspan="12"></td>
                                                                                <td class="fw-bold bg-light">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm border-0 text-center fw-bold"
                                                                                        name="total_general_curva_inicial"
                                                                                        readonly>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- CURVA PARCIAL -->
                                                                            <tr>
                                                                                <td colspan="13" class="fw-bold text-danger"
                                                                                    style="background:#ffff00;">
                                                                                    CURVA PARCIAL
                                                                                </td>
                                                                            </tr>

                                                                            <tr class="table-secondary">
                                                                                <td class="fw-bold">Color / Talla</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td class="fw-bold">Total Uds</td>
                                                                            </tr>

                                                                            <?php for($i=1; $i<=5; $i++): ?>
                                                                            <tr>
                                                                                <td class="fw-bold"><?php echo $i; ?></td>

                                                                                <?php for($j=1; $j<=11; $j++): ?>
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-sm border-0 text-center"
                                                                                            name="curva_parcial_<?php echo $i.'_'.$j; ?>">
                                                                                    </td>
                                                                                <?php endfor; ?>

                                                                                <td class="fw-bold bg-light">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm border-0 text-center fw-bold"
                                                                                        name="total_curva_parcial_<?php echo $i; ?>"
                                                                                        readonly>
                                                                                </td>
                                                                            </tr>
                                                                            <?php endfor; ?>

                                                                            <tr>
                                                                                <td colspan="12"></td>
                                                                                <td class="fw-bold bg-light">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm border-0 text-center fw-bold"
                                                                                        name="total_general_curva_parcial"
                                                                                        readonly>
                                                                                </td>
                                                                            </tr>

                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- OBSERVACION CORTE -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm mb-0">
                                                                            <tr>
                                                                                <td class="fw-bold text-center"
                                                                                    style="width:30%; background:#d9e7ec;">
                                                                                    OBSERVACION CORTE
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="height:120px;">
                                                                                    <textarea class="form-control border-0"
                                                                                            style="height:120px; resize:none;"
                                                                                            name="observacion_corte"></textarea>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- INFORMACION DE CORTE -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">

                                                                            <tr>
                                                                                <td class="text-danger text-center"
                                                                                    style="background:#ffff00; width:20%;">
                                                                                    TELA REPOSADA
                                                                                </td>

                                                                                <td style="width:5%;" class="fw-bold text-center">SI</td>
                                                                                <td style="width:5%;">
                                                                                    <input type="radio" name="tela_reposada" value="SI">
                                                                                </td>

                                                                                <td style="width:5%;" class="fw-bold text-center">NO</td>
                                                                                <td style="width:5%;">
                                                                                    <input type="radio" name="tela_reposada" value="NO">
                                                                                </td>

                                                                                <td class="text-danger text-center"
                                                                                    style="background:#ffff00; width:15%;">
                                                                                    HORAS DE REPOSO
                                                                                </td>

                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        name="horas_reposo">
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td class="fw-bold text-center" style="background:#ffff99;">
                                                                                    FIRMA RESPONSABLE
                                                                                </td>
                                                                                <td colspan="6">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        name="firma_responsable">
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td class="fw-bold text-center" style="background:#ffff99;">
                                                                                    CORTE COMPLETO
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <input type="checkbox" name="corte_completo">
                                                                                </td>

                                                                                <td colspan="4"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td class="fw-bold text-center" style="background:#ffff99;">
                                                                                    CORTE INCOMPLETO
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <input type="checkbox" name="corte_incompleto">
                                                                                </td>

                                                                                <td colspan="4"></td>
                                                                            </tr>

                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- RECIBIDO PRODUCCION -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm align-middle mb-0">
                                                                            <tr>
                                                                                <td class="fw-bold text-center"
                                                                                    style="width:25%; background:#d9e7ec;">
                                                                                    FIRMA DE RECIBIDO DE CORTE A PRODUCCION
                                                                                </td>

                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        name="firma_recibido_produccion">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                

                                                                <!-- Boton para Imprimir -->
                                                                <button type="button" class="btn btn-primary" onclick="imprimirSeccion('dotaciones<?php echo $id_producto; ?>')">
                                                                    <i class="bi bi-printer"></i>Imprimir
                                                                </button>

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
                                                                                <tr>
                                                                                    <th colspan="8"
                                                                                        class="fw-bold"
                                                                                        style="background:#8fb1d9;">
                                                                                        ENTRETELAS
                                                                                    </th>
                                                                                </tr>
                                                                                <tr class="table-secondary">
                                                                                    <th>Pieza</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Entretela</th>
                                                                                    <th>Ancho</th>
                                                                                    <th>Pieza</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Entretela</th>
                                                                                    <th>Ancho</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php for($i=1;$i<=4;$i++): ?>
                                                                                <tr>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>

                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                                                </tr>
                                                                                <?php endfor; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <!-- DIBUJO DEL PANTALON -->
                                                                <div class="card shadow-sm border-0 mb-3">

                                                                    <div class="card-header fw-bold text-center">
                                                                        Dibujo Técnico
                                                                    </div>

                                                                    <div class="card-body text-center">

                                                                        <input
                                                                            type="file"
                                                                            id="imagenPantalon<?php echo $id_producto; ?>"
                                                                            accept="image/*"
                                                                            class="form-control mb-3">

                                                                        <img
                                                                            id="previewPantalon<?php echo $id_producto; ?>"
                                                                            src=""
                                                                            class="img-fluid border rounded d-none"
                                                                            style="max-height:700px;">

                                                                    </div>

                                                                </div>

                                                                <!-- INFORMACION INFERIOR -->
                                                                <div class="card shadow-sm border-0 mb-3">
                                                                    <div class="table-responsive">

                                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">

                                                                            <tr>
                                                                                <th colspan="4" style="background:#f1f1f1;">
                                                                                    PESPUNTES
                                                                                </th>

                                                                                <th colspan="2" style="background:#f1f1f1;">
                                                                                    ACCESORIO
                                                                                </th>

                                                                                <th rowspan="4"
                                                                                    style="width:25%;">
                                                                                    INSTRUCCION DE LAVADO<br>
                                                                                    CON TALLA EN CENTRO POSTERIOR
                                                                                </th>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>TIROS</td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        value="1/16">
                                                                                </td>

                                                                                <td rowspan="2">
                                                                                    PRETINA<br>
                                                                                    INCORPORADA
                                                                                </td>

                                                                                <td rowspan="2">
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        value="1/16 y 1/4">
                                                                                </td>

                                                                                <td rowspan="3">
                                                                                    pretina interna<br>
                                                                                    con cordón
                                                                                </td>

                                                                                <td rowspan="3" style="width:150px;">

                                                                                    <input
                                                                                        type="file"
                                                                                        id="imagenAccesorio<?php echo $id_producto; ?>"
                                                                                        accept="image/*"
                                                                                        class="form-control form-control-sm mb-2">

                                                                                    <img
                                                                                        id="previewAccesorio<?php echo $id_producto; ?>"
                                                                                        src=""
                                                                                        class="img-fluid d-none"
                                                                                        style="max-height:120px;">

                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>RUEDO</td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        value="2.5 CM">
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>LATERALES</td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        value="1/16">
                                                                                </td>

                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>

                                                                        </table>

                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>

                                                        <!-- DESCRIPCION -->
                                                        <div class="tab-pane fade"
                                                            id="descripcion<?php echo $id_producto; ?>"
                                                            role="tabpanel">

                                                            Contenido Descripción

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