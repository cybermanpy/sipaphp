<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='conservacion';
$pk=$_POST['pk'];
$pkt='id_conserv';
if ($_POST['conserv']!='' ){
	$array1=array('des_conserv');
	$array2=array(value($_POST['conserv']));
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