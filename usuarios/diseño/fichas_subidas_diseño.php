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

    if (isset($_POST['actualizar_ficha'])) {

        $id_fichatecnica = $_POST['id_fichatecnica'];
        date_default_timezone_set('America/Bogota');
        $fecha_subida = date('Y-m-d H:i:s');
        $ficha_tecnica = isset($_POST['ficha_tecnica']) ? $_POST['ficha_tecnica'] : null;
        $ficha_nombre = isset($_FILES['ficha_tecnica']['name']) ? $_FILES['ficha_tecnica']['name'] : null;
        $ficha_temporal = isset($_FILES['ficha_tecnica']['tmp_name']) ? $_FILES['ficha_tecnica']['tmp_name'] : null;
        move_uploaded_file($ficha_temporal, "fichas_tecnicas/" . $ficha_nombre);

        $consulta = "UPDATE ficha_tecnica SET ficha_tecnica = '$ficha_nombre', fecha_subida = '$fecha_subida' WHERE id_fichatecnica = '$id_fichatecnica'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: fichas_subidas_diseño.php");
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
        
        <title>Diseño | Fichas Tecnicas Subidas</title>
    <head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(50deg, #000DD3 0%, #020873 100%);">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="navbar-brand text-center" href="inicio_diseño.php">
                        <img src="../../img/Logo.png" alt="Logo" class="img-fluid rounded" style="max-width: 60px;">
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
                        <h1 style="font-family: 'Times New Roman'">Fichas Técnicas Subidas</h1>
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
                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Fecha enviado<br>a Produccion</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "SELECT pedido.id_pedido, producto.id_producto, producto.num_ficha, prenda.id_prenda, prenda.nombre_prenda, cliente.nit, cliente.cliente, producto.estado, ficha_tecnica.id_fichatecnica, ficha_tecnica.id_producto, ficha_tecnica.ficha_tecnica, ficha_tecnica.fecha_subida, producto.fecha_produccion
                                                    FROM pedido 
                                                    LEFT JOIN cliente ON pedido.nit = cliente.nit 
                                                    LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido 
                                                    LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                    LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto
                                                    WHERE producto.estado IS NOT NULL AND producto.estado != 'Diseño'
                                                    ORDER BY ficha_tecnica.fecha_subida DESC";

                                            $resultado = mysqli_query($enlace, $consulta);

                                            while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                                <?php
                                                if (!function_exists('displayFichaTecnica')) {
                                                    function displayFichaTecnica($file, $id_producto)
                                                    {
                                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                        $fileName = basename($file);
                                                        $filePath = "../../fichas_tecnicas/" . $file;

                                                        if (file_exists($filePath)) {
                                                            echo    '<a href="' . $filePath . '" class="btn btn-success btn-block mb-2" download>
                                                                                <i class="bi bi-download"></i> Descargar Ficha Técnica 
                                                                            </a>';
                                                        } else {
                                                            echo    '<button class="btn btn-secondary btn-block mb-2" disabled>
                                                                                <i class="bi bi-exclamation-circle"></i> Archivo no disponible
                                                                            </button>';
                                                        }
                                                    }
                                                }
                                                ?>

                                                <tr>
                                                    <td class="text-center align-middle"><?php echo $fila['num_ficha']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $fila['nombre_prenda']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                    <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish');
                                                                                            echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila['fecha_subida'])); ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish');
                                                                                            echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila['fecha_produccion'])); ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        
                                                        <?php displayFichaTecnica($fila['ficha_tecnica'], $fila['id_producto']); ?>
                                                        <button type="button" class="btn btn-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#modalFichaTecnica<?= $fila['id_fichatecnica']; ?>"> <i class="bi bi-upload"></i> Actualizar Ficha Técnica</button>

                                                        <div class="modal fade" id="modalFichaTecnica<?= $fila['id_fichatecnica']; ?>" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content rounded-4 shadow">

                                                                    <div class="modal-header text-white rounded-top" style="background: linear-gradient(70deg, #020873 0%, #000DD3 100%);">
                                                                        <h5 class="modal-title">Actualizar Ficha Técnica</h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="alert alert-warning d-flex align-items-start gap-2" role="alert">
                                                                            <div>
                                                                                <strong><i class="bi bi-exclamation-triangle-fill"></i> Importante:</strong>
                                                                                Para continuar, debe seleccionar un nuevo archivo para actualizar la ficha técnica.<br>
                                                                                El botón “Continuar” se habilitará únicamente cuando se haya cargado una nueva ficha técnica.
                                                                            </div>
                                                                        </div>


                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <input type="hidden" name="id_fichatecnica" value="<?= $fila['id_fichatecnica']; ?>">
                                                                            <div class="mb-3 text-center">
                                                                                <input type="file" class="form-control d-none" name="ficha_tecnica" id="ficha_tecnica<?= $fila['id_fichatecnica']; ?>" accept=".xls,.xlsx,.csv,.pdf,.doc,.docx,.png,.jpg,.jpeg" required>
                                                                                <label for="ficha_tecnica<?= $fila['id_fichatecnica']; ?>" class="btn btn-outline-primary w-100"> <i class="bi bi-file-earmark-arrow-up"></i> Seleccionar archivo</label>
                                                                                <small class="text-success d-none mt-2" id="nombreArchivo<?= $fila['id_fichatecnica']; ?>"></small>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" name="actualizar_ficha" class="btn btn-success" disabled id="btnEnviar<?= $fila['id_fichatecnica']; ?>"> <i class="bi bi-check-circle"></i> Continuar</button>
                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
        <!-- Datatables -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.5/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.js"></script>
        <!-- Configuración de DataTable -->
        <script>
            $(document).ready(function() {
                var table = new DataTable('#mytabla', {
                    "ordering": false, 
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
            function descargarFicha(idProducto) {
                window.location.href = "?descargar_ficha=" + idProducto;
            }
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll("input[type='file']").forEach(input => {
                    const id = input.id.replace("ficha_tecnica", "");
                    const nombreArchivo = document.getElementById("nombreArchivo" + id);
                    const btnEnviar = document.getElementById("btnEnviar" + id);

                    input.addEventListener("change", () => {
                        if (input.files.length > 0) {
                            nombreArchivo.textContent = "Archivo seleccionado: " + input.files[0].name;
                            nombreArchivo.classList.remove("d-none");
                            btnEnviar.disabled = false;
                        } else {
                            nombreArchivo.classList.add("d-none");
                            btnEnviar.disabled = true;
                        }
                    });
                });
            });
        </script>
    </body>
</html>