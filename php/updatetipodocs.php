<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='tipo_documentos';
$pk=$_POST['pk'];
$pkt='id_tipo_doc';
if ($_POST['tipodoc']!='' ){
	$array1=array('des_tipo_doc');
	$array2=array(value($_POST['tipodoc']));
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