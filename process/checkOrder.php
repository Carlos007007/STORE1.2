<?php
session_start(); 
include '../library/configServer.php';
include '../library/consulSQL.php';
$code=consultasSQL::clean_string($_POST['code']);
$selOrder=ejecutarSQL::consultar("SELECT Estado FROM venta WHERE NumPedido='".$code."'");
$peU=mysqli_fetch_array($selOrder, MYSQLI_ASSOC);
echo '<input type="hidden" value="'.$code.'" name="num-pedido">';
echo '
	<div class="form-group">
        <label>Estado del pedido</label>
        <select class="form-control" name="pedido-status" >
';
	if($peU['Estado']=="Pendiente"){
		echo '
			<option value="Pendiente">Pendiente (Actual)</option>
			<option value="Entregado">Entregado
			</option><option value="Enviado">Enviado</option>
		';
	}
	if($peU['Estado']=="Entregado"){
		echo '
			<option value="Entregado">Entregado (Actual)</option>
			<option value="Pendiente">Pendiente</option>
			<option value="Enviado">Enviado</option>
		';
	}
	if($peU['Estado']=="Enviado"){
		echo '
			<option value="Enviado">Enviado (Actual)</option>
			<option value="Entregado">Entregado</option>
			<option value="Pendiente">Pendiente</option>
		';
	}
echo '
        </select>
    </div>
';