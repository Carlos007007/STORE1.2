<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$bancoCuenta=consultasSQL::clean_string($_POST['bancoCuenta']);
$bancoNombre=consultasSQL::clean_string($_POST['bancoNombre']);
$bancoBeneficiario=consultasSQL::clean_string($_POST['bancoBeneficiario']);
$bancoTipo=consultasSQL::clean_string($_POST['bancoTipo']);

if(consultasSQL::InsertSQL("cuentabanco", "NumeroCuenta, NombreBanco, NombreBeneficiario, TipoCuenta", "'$bancoCuenta','$bancoNombre','$bancoBeneficiario','$bancoTipo'")){
  echo '<script>
    swal({
      title: "Cuenta agregada",
      text: "La cuenta bancaria se agregó con éxito",
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