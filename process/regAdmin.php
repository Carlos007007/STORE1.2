<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$nameAdmin=consultasSQL::clean_string($_POST['admin-name']);
$passAdmin1=consultasSQL::clean_string($_POST['admin-pass1']);
$passAdmin2=consultasSQL::clean_string($_POST['admin-pass2']);

if($passAdmin1!=$passAdmin2){
    echo '<script>swal("ERROR", "Las contraseñas que acaba de ingresar no coinciden", "error");</script>';
    exit();
}

$passAdminFinal=md5($passAdmin1);

$verificar=ejecutarSQL::consultar("SELECT * FROM administrador WHERE Nombre='".$nameAdmin."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultasSQL::InsertSQL("administrador", "Nombre, Clave", "'$nameAdmin','$passAdminFinal'")){
        echo '<script>
            swal({
              title: "Administrador registrado",
              text: "El administrador se registró con éxito",
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
    echo '<script>swal("ERROR", "El nombre de usuario que acaba de ingresar ya se encuentra registrado, por favor elija otro", "error");</script>';
}