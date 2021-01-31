<p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
</p>
<div class="container">
	<div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-info text-center">Actualizar cuenta</h3>
                <?php
                	$admin=ejecutarSQL::consultar("SELECT * FROM administrador WHERE id='".$_SESSION['adminID']."'");
                	$dataAdmin=mysqli_fetch_array($admin, MYSQLI_ASSOC);
                ?>
                <form action="./process/updateAdmin.php" method="POST" role="form" class="FormCatElec" data-form="update">
                	<input type="hidden" name="admin-code" value="<?php echo $_SESSION['adminID']; ?>">
                	<input type="hidden" name="admin-name-old" value="<?php echo $dataAdmin['Nombre']; ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre de usuario</label>
                                    <input class="form-control" type="text" name="admin-name" value="<?php echo $dataAdmin['Nombre']; ?>" maxlength="9" pattern="[a-zA-Z0-9]{4,9}" required="">
                                </div>
                            </div>
                            <div class="col-xs-12">
                            	<p class="text-primary text-center" style="padding-top: 20px;">No es necesario actualizar la contraseña, sin embargo si desea hacerlo debe de ingresar una nueva contraseña y volver a ingresarla</p>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nueva contraseña</label>
                                    <input class="form-control" type="password" name="admin-pass1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Repita la nueva contraseña</label>
                                    <input class="form-control" type="password" name="admin-pass2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Actualizar cuenta</button></p>
                </form>
            </div>
        </div>
    </div>
</div>