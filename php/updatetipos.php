<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='tipos';
$pk=$_POST['pk'];
$pkt='pktipo';
if ($_POST['tipo']!='' && $_POST['cod']!='' ){
	$array1=array('tiponame','codtipo');
	$array2=array(value($_POST['tipo']),value($_POST['cod']));
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