<?php
    error_reporting(E_PARSE);
    session_start();
	include '../library/configServer.php';
	include '../library/consulSQL.php';
    $codigo=consultasSQL::clean_string($_POST['codigo']);
    unset($_SESSION['carro'][$codigo]);
    echo '<script> window.location="carrito.php"; </script>';