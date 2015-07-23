<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='tipo_traslados';
$pk=$_POST['pk'];
$pkt='id_tipo_tras';
if ($_POST['tipotras']!='' ){
	$array1=array('des_tipo_tras');
	$array2=array(value($_POST['tipotras']));
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