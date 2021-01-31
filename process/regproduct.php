<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';

    $codeProd=consultasSQL::clean_string($_POST['prod-codigo']);
    $nameProd=consultasSQL::clean_string($_POST['prod-name']);
    $cateProd=consultasSQL::clean_string($_POST['prod-categoria']);
    $priceProd=consultasSQL::clean_string($_POST['prod-price']);
    $modelProd=consultasSQL::clean_string($_POST['prod-model']);
    $marcaProd=consultasSQL::clean_string($_POST['prod-marca']);
    $stockProd=consultasSQL::clean_string($_POST['prod-stock']);
    $codePProd=consultasSQL::clean_string($_POST['prod-codigoP']);
    $estadoProd=consultasSQL::clean_string($_POST['prod-estado']);
    $adminProd=consultasSQL::clean_string($_POST['admin-name']);
    $descProd=consultasSQL::clean_string($_POST['prod-desc-price']);
    $imgName=$_FILES['img']['name'];
    $imgType=$_FILES['img']['type'];
    $imgSize=$_FILES['img']['size'];
    $imgMaxSize=5120;

    if($codeProd!="" && $nameProd!="" && $cateProd!="" && $priceProd!="" && $modelProd!="" && $marcaProd!="" && $stockProd!="" && $codePProd!=""){
        $verificar=  ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$codeProd."'");
        $verificaltotal = mysqli_num_rows($verificar);
        if($verificaltotal<=0){
            if($imgType=="image/jpeg" || $imgType=="image/png"){
                if(($imgSize/1024)<=$imgMaxSize){
                    chmod('../assets/img-products/', 0777);
                    switch ($imgType) {
                      case 'image/jpeg':
                        $imgEx=".jpg";
                      break;
                      case 'image/png':
                        $imgEx=".png";
                      break;
                    }
                    $imgFinalName=$codeProd.$imgEx;
                    if(move_uploaded_file($_FILES['img']['tmp_name'],"../assets/img-products/".$imgFinalName)){
                        if(consultasSQL::InsertSQL("producto", "CodigoProd, NombreProd, CodigoCat, Precio, Descuento, Modelo, Marca, Stock, NITProveedor, Imagen, Nombre, Estado", "'$codeProd','$nameProd','$cateProd','$priceProd', '$descProd', '$modelProd','$marcaProd','$stockProd','$codePProd','$imgFinalName','$adminProd', '$estadoProd'")){
                            echo '<script>
                                swal({
                                  title: "Producto registrado",
                                  text: "El producto se añadió a la tienda con éxito",
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
                        echo '<script>swal("ERROR", "Ha ocurrido un error al cargar la imagen", "error");</script>';
                    }  
                }else{
                    echo '<script>swal("ERROR", "Ha excedido el tamaño máximo de la imagen, tamaño máximo es de 5MB", "error");</script>';
                }
            }else{
                echo '<script>swal("ERROR", "El formato de la imagen del producto es invalido, solo se admiten archivos con la extensión .jpg y .png ", "error");</script>';
            }
        }else{
            echo '<script>swal("ERROR", "El código de producto que acaba de ingresar ya está registrado en el sistema, por favor ingrese otro código de producto distinto", "error");</script>';
        }
    }else {
        echo '<script>swal("ERROR", "Los campos no deben de estar vacíos, por favor verifique e intente nuevamente", "error");</script>';
    }