<?php
     include '../library/configServer.php';
     include '../library/consulSQL.php';
     
     $codeProd=consultasSQL::clean_string($_POST['prod-code']);

    $checP=ejecutarSQL::consultar("SELECT * FROM detalle WHERE CodigoProd='$codeProd'");
    $cons=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='$codeProd'");
    $tmp=mysqli_fetch_array($cons, MYSQLI_ASSOC);
    if(mysqli_num_rows($checP)<=0){
        if(consultasSQL::DeleteSQL('producto', "CodigoProd='".$codeProd."'")){
            $imagen=$tmp['Imagen'];
            $carpeta='../assets/img-products/';
            $directorio=$carpeta.$imagen;
            if(is_file($directorio)){
              chmod($directorio, 0777);
              unlink($directorio);
            }
            echo '<script>
                swal({
                  title: "Producto eliminado",
                  text: "El producto se eliminó con éxito de la tienda",
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
        echo '<script>swal("ERROR", "No podemos eliminar el producto porque se encuentra registrado en una venta", "error");</script>';
    }
    mysqli_free_result($checP);
    mysqli_free_result($cons);