<?php
error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();
$codigo=consultasSQL::clean_string($_POST['codigo']);
$cantidad=consultasSQL::clean_string($_POST['cantidad']);
if(empty($_SESSION['carro'][$codigo]))
{
	$_SESSION['carro'][$codigo] = array('producto' => $codigo, 
                                        'cantidad' => $cantidad
                                        );
	echo '<script>
        swal({
        title: "Producto agregado",
        text: "Quieres ver el carrito de compras?",
        type: "info",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        cancelButtonClass: "btn-primary",
        confirmButtonText: "Si, ir al carrito",
        cancelButtonText: "No, seguir comprando",
        closeOnConfirm: false
        },
        function(){
            window.location="carrito.php";
        });
    </script>';
}else{
	echo '<script>
        swal({
        title: "ERROR",
        text: "El producto ya fue agregado al carrito. Quieres ver el carrito de compras?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        cancelButtonClass: "btn-primary",
        confirmButtonText: "Si, ver el carrito",
        cancelButtonText: "No, seguir comprando",
        closeOnConfirm: false
        },
        function(){
            window.location="carrito.php";
        });
    </script>';
}