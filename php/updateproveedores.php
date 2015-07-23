<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='proveedores';
$pk=$_POST['pk'];
$pkt='id_prov';
if ($_POST['prov']!='' && $_POST['tel']!='' && $_POST['dir']!='' ){
	$array1=array('nom_prov','contacto','telefono','direccion','correo','web');
		$array2=array(value($_POST['prov']),value($_POST['contacto']),value($_POST['tel']),value($_POST['dir']),value($_POST['email']),value($_POST['web']));
	update($array1,$table,$pk,$pkt,$array2,$user,$pass);
	?>
	<script>
		$("#resultado").empty();
		alert("Datos Actualizados");
	</script>
	<?php
	include($page);
}
?>