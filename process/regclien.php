<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

$nitCliente=consultasSQL::clean_string($_POST['clien-nit']);
$nameCliente=consultasSQL::clean_string($_POST['clien-name']);
$fullnameCliente=consultasSQL::clean_string($_POST['clien-fullname']);
$apeCliente=consultasSQL::clean_string($_POST['clien-lastname']);
$passCliente=consultasSQL::clean_string(md5($_POST['clien-pass']));
$passCliente2=consultasSQL::clean_string(md5($_POST['clien-pass2']));
$dirCliente=consultasSQL::clean_string($_POST['clien-dir']);
$phoneCliente=consultasSQL::clean_string($_POST['clien-phone']);
$emailCliente=consultasSQL::clean_string($_POST['clien-email']);

if(!$nitCliente=="" && !$nameCliente=="" && !$apeCliente=="" && !$dirCliente=="" && !$phoneCliente=="" && !$emailCliente=="" && !$fullnameCliente==""){
    if($passCliente==$passCliente2){
        $verificar= ejecutarSQL::consultar("SELECT * FROM cliente WHERE NIT='".$nitCliente."'");
        $verificaltotal = mysqli_num_rows($verificar);
        if($verificaltotal<=0){
            if(consultasSQL::InsertSQL("cliente", "NIT, Nombre, NombreCompleto, Apellido, Direccion, Clave, Telefono, Email", "'$nitCliente','$nameCliente','$fullnameCliente','$apeCliente','$dirCliente', '$passCliente','$phoneCliente','$emailCliente'")){
                echo '<script>
                    swal({
                      title: "Registro completado",
                      text: "El registro se completó con éxito, ya puedes iniciar sesión en el sistema",
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
            echo '<script>swal("ERROR", "El DNI que ha ingresado ya está registrado en el sistema, por favor ingrese otro número de DNI", "error");</script>';
        }
        mysqli_free_result($verificar);
    }else{
        echo '<script>swal("ERROR", "Las contraseñas no coinciden, por favor verifique e intente nuevamente", "error");</script>';
    }
}else {
    echo '<script>swal("ERROR", "Los campos no pueden estar vacíos", "error");</script>';
}