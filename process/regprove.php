<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$nitProve=consultasSQL::clean_string($_POST['prove-nit']);
$nameProve=consultasSQL::clean_string($_POST['prove-name']);
$dirProve=consultasSQL::clean_string($_POST['prove-dir']);
$telProve=consultasSQL::clean_string($_POST['prove-tel']);
$webProve=consultasSQL::clean_string($_POST['prove-web']);

$verificar=  ejecutarSQL::consultar("SELECT * FROM proveedor WHERE NITProveedor='".$nitProve."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultasSQL::InsertSQL("proveedor", "NITProveedor, NombreProveedor, Direccion, Telefono, PaginaWeb", "'$nitProve','$nameProve','$dirProve','$telProve','$webProve'")){
        echo '<script>
            swal({
              title: "Proveedor registrado",
              text: "Los datos del proveedor se agregaron con éxito",
              type: "success",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Aceptar",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
              },
              function(isConfirm) {
              if (isConfirm) {
                location.reload();
              } else {
                location.reload();
              }
            });
        </script>';
    }else{
       echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
    }
}else{
    echo '<script>swal("ERROR", "El número de NIT/CEDULA que ha ingresado ya se encuentra registrado en el sistema, por favor ingrese otro número de NIT o CEDULA", "error");</script>';
}
mysqli_free_result($verificar);