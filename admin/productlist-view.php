<p class="lead">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum voluptates, corporis nisi dolores cumque obcaecati perferendis, quisquam, ipsa commodi labore molestias dolor itaque nam cupiditate totam, ea dicta? Sit, asperiores?
</p>
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=product">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nuevo producto
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=productlist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Productos en tienda</a>
    </li>
</ul>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
              <div class="panel-heading text-center"><h4>Productos en tienda</h4></div>
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                      <thead class="">
                          <tr>
                          	  <th class="text-center">#</th>
                              <th class="text-center">Código</th>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">Categoría</th>
                              <th class="text-center">Precio</th>
                              <th class="text-center">Modelo</th>
                              <th class="text-center">Marca</th>
                              <th class="text-center">Stock</th>
                              <th class="text-center">Proveedor</th>
                              <th class="text-center">Estado</th>
                              <th class="text-center">Actualizar</th>
                              <th class="text-center">Eliminar</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$mysqli = mysqli_connect(SERVER, USER, PASS, BD);
							mysqli_set_charset($mysqli, "utf8");

							$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
							$regpagina = 30;
							$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

							$productos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM producto LIMIT $inicio, $regpagina");

							$totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
							$totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

							$numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

							$cr=$inicio+1;
                            while($prod=mysqli_fetch_array($productos, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                        	<td class="text-center"><?php echo $cr; ?></td>
                        	<td class="text-center"><?php echo $prod['CodigoProd']; ?></td>
                        	<td class="text-center"><?php echo $prod['NombreProd']; ?></td>
                        	<td class="text-center">
                        		<?php 
                        			$categ=ejecutarSQL::consultar("SELECT Nombre FROM categoria WHERE CodigoCat='".$prod['CodigoCat']."'");
                        			$datc=mysqli_fetch_array($categ, MYSQLI_ASSOC);
                        			echo $datc['Nombre'];
                        		?>
                        	</td>
                        	<td class="text-center"><?php echo $prod['Precio']; ?></td>
                        	<td class="text-center"><?php echo $prod['Modelo']; ?></td>
                        	<td class="text-center"><?php echo $prod['Marca']; ?></td>
                        	<td class="text-center"><?php echo $prod['Stock']; ?></td>
                        	<td class="text-center">
                        		<?php
                        			$prov=ejecutarSQL::consultar("SELECT NombreProveedor FROM proveedor WHERE NITProveedor='".$prod['NITProveedor']."'");
                        			$datp=mysqli_fetch_array($prov, MYSQLI_ASSOC);
                        			echo $datp['NombreProveedor'];
                        		?>
                        	</td>
                        	<td class="text-center">
                        		<?php echo $prod['Estado']; ?>
                        	</td>
                        	<td class="text-center">
                        		<a href="configAdmin.php?view=productinfo&code=<?php echo $prod['CodigoProd']; ?>" class="btn btn-raised btn-xs btn-success">Actualizar</a>
                        	</td>
                        	<td class="text-center">
                        		<form action="process/delprod.php" method="POST" class="FormCatElec" data-form="delete">
                        			<input type="hidden" name="prod-code" value="<?php echo $prod['CodigoProd']; ?>">
                        			<button type="submit" class="btn btn-raised btn-xs btn-danger">Eliminar</button>	
                        		</form>
                        	</td>
                        </tr>
                        <?php 
                        	$cr++;
                        	}
                        ?>
                      </tbody>
                  </table>
                </div>
                <?php if($numeropaginas>=1): ?>
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
                            <a href="configAdmin.php?view=productlist&pag=<?php echo $pagina-1; ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="configAdmin.php?view=productlist&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="configAdmin.php?view=productlist&pag='.$i.'">'.$i.'</a></li>';
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
                            <a href="configAdmin.php?view=productlist&pag=<?php echo $pagina+1; ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
	</div>
</div>