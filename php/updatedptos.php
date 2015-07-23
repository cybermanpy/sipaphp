<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='ubicaciones';
$pk=$_POST['pk'];
$pkt='id_ubic';
if ($_POST['dpto']!='' && $_POST['sigla']!='' && $_POST['num']!='' && $_POST['dir']!=''){
	$array1=array('nom_depto','des_ubic','num_depto','fkdir');
	$array2=array(value($_POST['dpto']),value($_POST['sigla']),value($_POST['num']),value($_POST['dir']));
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