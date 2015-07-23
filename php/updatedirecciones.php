<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='direcciones';
$pk=$_POST['pk'];
$pkt='pkdir';
if ($_POST['dir']!='' && $_POST['sigla']!='' && $_POST['num']!=''){
	$array1=array('namedir','sigladir','numdir');
	$array2=array(value($_POST['dir']),value($_POST['sigla']),value($_POST['num']));
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