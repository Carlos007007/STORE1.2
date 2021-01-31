<p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
</p>
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=provider">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nuevo Proveedor
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=providerlist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Proveedores de la tienda</a>
    </li>
</ul>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-primary text-center">Actualizar datos del proveedor</h3>
                <?php
                    $code=$_GET['code'];
                    $proveedor=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE NITProveedor='$code'");
                    $prov=mysqli_fetch_array($proveedor, MYSQLI_ASSOC);
                ?>
                <form action="process/updateProveedor.php" method="POST" class="FormCatElec" data-form="update">
                    <input type="hidden" name="nit-prove-old" value="<?php echo $prov['NITProveedor']; ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">NIT/CEDULA</label>
                                    <input class="form-control" value="<?php echo $prov['NITProveedor']; ?>" type="text" name="prove-nit" readonly pattern="[0-9]{1,20}" maxlength="20" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre</label>
                                    <input class="form-control" type="text" value="<?php echo $prov['NombreProveedor']; ?>" name="prove-name" maxlength="30" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" value="<?php echo $prov['Direccion']; ?>" name="prove-dir" required="">
                                </div> 
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input class="form-control" value="<?php echo $prov['Telefono']; ?>" type="tel" name="prove-tel" pattern="[0-9]{1,20}" maxlength="20" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Página Web (http://ejemplo.com)</label>
                                    <input class="form-control" value="<?php echo $prov['PaginaWeb']; ?>" type="url" name="prove-web">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Actualizar proveedor</button></p>
                </form>
            </div>
        </div>
    </div>
</div>