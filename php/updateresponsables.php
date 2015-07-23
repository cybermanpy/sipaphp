<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='responsables';
$pk=$_POST['pk'];
$pkt='id_resp';
if ($_POST['name']!='' && $_POST['cargo']!='' && $_POST['estado']!='' && $_POST['ubic']!='' && $_POST['cedula']!='' && (int)$_POST['cedula']){
	$array1=array('nom_resp','fkcargo','fkestado','fkubicacion','cedula');
	$array2=array(value($_POST['name']),value($_POST['cargo']),value($_POST['estado']),value($_POST['ubic']),value($_POST['cedula']));
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