<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='org_fin';
$pk=$_POST['pk'];
$pkt='id_org_fin';
if ($_POST['orgfin']!='' ){
	$array1=array('des_org_fin');
	$array2=array(value($_POST['orgfin']));
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