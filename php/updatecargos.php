<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='cargos';
$pk=$_POST['pk'];
$pkt='pkcargo';
if ($_POST['cargo']!='' ){
	$array1=array('descargo');
	$array2=array(value($_POST['cargo']));
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