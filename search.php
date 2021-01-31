<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-product">
    <?php include './inc/navbar.php'; ?>
    <section id="store">
       <br>
        <div class="container">
            <div class="page-header">
              <h1>BÚSQUEDA DE PRODUCTOS <small class="tittles-pages-logo">STORE</small></h1>
            </div>
            <div class="container-fluid">
              <div class="row">
                <div class="col-xs-12 col-md-4 col-md-offset-8">
                  <form action="./search.php" method="GET">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                        <input type="text" id="addon1" class="form-control" name="term" required="" title="Escriba nombre o marca del producto">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-raised" type="submit">Buscar</button>
                        </span>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
              $search=consultasSQL::clean_string($_GET['term']);
              if(isset($search) && $search!=""){
            ?>
              <div class="container-fluid">
                <div class="row">
                  <?php
                    $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                    mysqli_set_charset($mysqli, "utf8");

                    $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
                    $regpagina = 20;
                    $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                    $consultar_productos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE NombreProd LIKE '%".$search."%' OR Modelo LIKE '%".$search."%' OR Marca LIKE '%".$search."%' LIMIT $inicio, $regpagina");

                    $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                    $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
          
                    $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                    if(mysqli_num_rows($consultar_productos)>=1){
                      echo '<div class="col-xs-12"><h3 class="text-center">Se muestran los productos con el nombre, marca o modelo <strong>"'.$search.'"</strong></h3></div><br>';
                      while($prod=mysqli_fetch_array($consultar_productos, MYSQLI_ASSOC)){
                  ?>
                      <div class="col-xs-12 col-sm-6 col-md-4">
                           <div class="thumbnail">
                             <img src="./assets/img-products/<?php if($prod['Imagen']!="" && is_file("./assets/img-products/".$prod['Imagen'])){ echo $prod['Imagen']; }else{ echo "default.png"; } ?>
                             ">
                             <div class="caption">
                               <h3><?php echo $prod['Marca']; ?></h3>
                               <p><?php echo $prod['NombreProd']; ?></p>
                               <p>$<?php echo $prod['Precio']; ?></p>
                               <p class="text-center">
                                   <a href="infoProd.php?CodigoProd=<?php echo $prod['CodigoProd']; ?>" class="btn btn-primary btn-raised btn-sm btn-block"><i class="fa fa-plus"></i>&nbsp; Detalles</a>
                               </p>

                             </div>
                           </div>
                       </div>     
                  <?php    
                    }
                    if($numeropaginas>0):
                  ?>
                  <div class="clearfix"></div>
                  <div class="text-center">
                    <ul class="pagination">
                      <?php if($pagina == 1): ?>
                          <li class="disabled">
                              <a>
                                  <span aria-hidden="true">&laquo;</span>
                              </a>
                          </li>
                      <?php else: ?>
                          <li>
                              <a href="search.php?term=<?php echo $search; ?>&pag=<?php echo $pagina-1; ?>">
                                  <span aria-hidden="true">&laquo;</span>
                              </a>
                          </li>
                      <?php endif; ?>


                      <?php
                          for($i=1; $i <= $numeropaginas; $i++ ){
                              if($pagina == $i){
                                  echo '<li class="active"><a href="search.php?term='.$search.'&pag='.$i.'">'.$i.'</a></li>';
                              }else{
                                  echo '<li><a href="search.php?term='.$search.'&pag='.$i.'">'.$i.'</a></li>';
                              }
                          }
                      ?>
                      

                      <?php if($pagina == $numeropaginas): ?>
                          <li class="disabled">
                              <a>
                                  <span aria-hidden="true">&raquo;</span>
                              </a>
                          </li>
                      <?php else: ?>
                          <li>
                              <a href="search.php?term=<?php echo $search; ?>&pag=<?php echo $pagina+1; ?>">
                                  <span aria-hidden="true">&raquo;</span>
                              </a>
                          </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                  <?php
                    endif;
                    }else{
                      echo '<h2 class="text-center">Lo sentimos, no hemos encontrado productos con el nombre, marca o modelo <strong>"'.$search.'"</strong></h2>';
                    }
                  ?>
                </div>
              </div>
            <?php
              }else{
                  echo '<h2 class="text-center">Por favor escriba el nombre o marca del producto que desea buscar</h2>';
              }
            ?>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>