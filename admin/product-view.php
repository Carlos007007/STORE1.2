<p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
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
            <div class="container-form-admin">
                <h3 class="text-primary text-center">Agregar un producto a la tienda</h3>
                <form action="./process/regproduct.php" method="POST" enctype="multipart/form-data" class="FormCatElec" data-form="save">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <legend>Datos básicos</legend>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Código de producto</label>
                                <input type="text" class="form-control" required maxlength="30" name="prod-codigo">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Nombre de producto</label>
                                <input type="text" class="form-control" required maxlength="30" name="prod-name">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Marca</label>
                                <input type="text" class="form-control" required name="prod-marca">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Modelo</label>
                                <input type="text" class="form-control" required name="prod-model">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Precio</label>
                                <input type="text" class="form-control" required maxlength="20" pattern="[0-9.]{1,20}" name="prod-price">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Descuento (%)</label>
                                <input type="text" class="form-control" required maxlength="2" pattern="[0-9]{1,2}" name="prod-desc-price" value="0">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group label-floating">
                                <label class="control-label">Unidades disponibles</label>
                                <input type="text" class="form-control" required maxlength="20" pattern="[0-9]{1,20}" name="prod-stock">
                              </div>
                            </div>
                            <div class="col-xs-12">
                                <legend>Categoría, proveedor y estado</legend>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" name="prod-categoria">
                                    <?php
                                        $categoriac= ejecutarSQL::consultar("SELECT * FROM categoria");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['CodigoCat'].'">'.$catec['Nombre'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label>Proveedor</label>
                                <select class="form-control" name="prod-codigoP">
                                    <?php
                                        $proveedoresc=  ejecutarSQL::consultar("SELECT * FROM proveedor");
                                        while($provc=mysqli_fetch_array($proveedoresc, MYSQLI_ASSOC)){
                                            echo '<option value="'.$provc['NITProveedor'].'">'.$provc['NombreProveedor'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name="prod-estado">
                                    <option value="Activo" selected="">Activo</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-12">
                                <legend>Imagen/Foto del producto</legend>
                                <p class="text-center text-primary">
                                    Seleccione una imagen/foto en el siguiente campo. Formato de imágenes admitido png y jpg. Tamaño máximo 5MB
                                </p>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                  <input type="file" name="img">
                                  <div class="input-group">
                                    <input type="text" readonly="" class="form-control" placeholder="Seleccione la imagen del producto...">
                                      <span class="input-group-btn input-group-sm">
                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                          <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                        </button>
                                      </span>
                                  </div>
                                    <p class="help-block">Formato de imágenes admitido png y jpg. Tamaño máximo 5MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Agregar a la tienda</button></p>
                </form>
            </div>
        </div>     
    </div>
</div>