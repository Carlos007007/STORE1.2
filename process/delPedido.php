<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$NumPedidoDel=consultasSQL::clean_string($_POST['num-pedido']);
if(consultasSQL::DeleteSQL('detalle', "NumPedido='".$NumPedidoDel."'") && consultasSQL::DeleteSQL("venta", "NumPedido='".$NumPedidoDel."'")){
    echo '<script>
	    swal({
	      title: "Pedido eliminado",
	      text: "El pedido se eliminó con éxito",
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
