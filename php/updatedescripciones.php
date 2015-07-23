<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='descripciones';
$pk=$_POST['pk'];
$pkt='id_desc';
if ($_POST['des']!='' && $_POST['tipo']!='' ){
	$array1=array('des_desc','fktipo');
	$array2=array(value($_POST['des']),value($_POST['tipo']));
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