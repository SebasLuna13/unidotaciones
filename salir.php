<?php
    ob_start();
    session_start();
    session_destroy();
    echo "<script>alert('Acaba de Cerrar Sesion');</script>";
    header("location: index.php");
    ob_end_flush();
    exit();
?>