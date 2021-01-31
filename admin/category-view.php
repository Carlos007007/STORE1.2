<p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
</p>
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=category">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nueva Categoría
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=categorylist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Categoría de productos</a>
    </li>
</ul>
<div class="container">
	<div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-info text-center">Agregar nueva categoría</h3>
                <form action="process/regcategori.php" method="POST" class="FormCatElec" data-form="save">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Código</label>
                                    <input class="form-control" type="text" name="categ-code" maxlength="9" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre</label>
                                    <input class="form-control" type="text" name="categ-name" maxlength="30" required="">
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Descripción</label>
                                    <input class="form-control" type="text" name="categ-descrip" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Agregar categoría</button></p>
                </form>
            </div>
        </div>
    </div>
</div>