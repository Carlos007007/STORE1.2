<?php
	session_start();
	include '../library/configServer.php';
	include '../library/consulSQL.php';

	$code=consultasSQL::clean_string($_POST['code']);

	$SelectUser=ejecutarSQL::consultar("SELECT * FROM cliente WHERE NIT='".$code."'");
	if(mysqli_num_rows($SelectUser)==1){
		$DataUser=mysqli_fetch_array($SelectUser, MYSQLI_ASSOC);
		echo '
            <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12">
                    <legend><i class="fa fa-user"></i> &nbsp; Datos personales</legend>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp; DNI</label>
                      <input class="form-control" type="text" required readonly name="clien-nit" value="'.$DataUser['NIT'].'">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-user"></i>&nbsp; Nombres</label>
                      <input class="form-control" type="text" required name="clien-fullname" value="'.$DataUser['NombreCompleto'].'" title="Ingrese sus nombres (solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-user"></i>&nbsp; Apellidos</label>
                      <input class="form-control" type="text" required name="clien-lastname" value="'.$DataUser['Apellido'].'" title="Ingrese sus apellido (solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-mobile"></i>&nbsp; Teléfono</label>
                        <input class="form-control" type="tel" required name="clien-phone" value="'.$DataUser['Telefono'].'" maxlength="15" title="Ingrese su número telefónico. Mínimo 8 digitos máximo 15">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; Email</label>
                        <input class="form-control" type="email" required name="clien-email" value="'.$DataUser['Email'].'" title="Ingrese la dirección de su Email" maxlength="50">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-home"></i>&nbsp; Dirección</label>
                      <input class="form-control" type="text" required name="clien-dir" value="'.$DataUser['Direccion'].'" title="Ingrese la direción en la reside actualmente" maxlength="100">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <legend><i class="fa fa-lock"></i> &nbsp; Datos de la cuenta</legend>
                  </div>
                  <input type="hidden" name="clien-old-name" value="'.$DataUser['Nombre'].'">
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; Nombre de usuario</label>
                        <input class="form-control" type="text" required name="clien-name" value="'.$DataUser['Nombre'].'" title="Ingrese su nombre. Máximo 9 caracteres (solamente letras y numeros sin espacios)" pattern="[a-zA-Z0-9]{1,9}" maxlength="9">
                    </div>
                  </div>
                
                    <div class="col-xs-12">
                        <p>No es necesario actualizar la contraseña sin embargo si desea actualizarla debe de introducir la contraseña actual y definir una nueva</p>
                    </div>
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Contraseña actual</label>
                      <input class="form-control" type="password" name="clien-old-pass">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Nueva contraseña</label>
                      <input class="form-control" type="password"  name="clien-new-pass">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Repita la nueva contraseña</label>
                        <input class="form-control" type="password"  name="clien-new-pass2">
                    </div>
                  </div>
                </div>
            </div>
		';

	}else{
		echo "Ocurrio un error, por favor recargue la pagina e intente nuevamente";
	}
	