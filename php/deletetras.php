<?php
include'session.php';
?>

<?php
require_once('../includes/DbConnector.php');
$pk=$_POST['pk'];
$pkt=$_POST['pkt'];
$table=$_POST['table'];
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
#Busca el ultimo traslado del bien
$arraymax=array(" MAX(id_traslado) AS pkmax ");
$sqlmax=select($table,$arraymax);
$sqlmax.=" WHERE bien_id ='".$_POST['pkbien']."' ";
$resmax=connector1($user,$pass,$sqlmax);
$rowmax=fetchArray($resmax);
$pkmaxtras=$rowmax['pkmax'];
if($pkmaxtras==$pk){
	delete($pk,$pkt,$table,$user,$pass);
	$arraymax2=array('MAX(id_traslado) AS pkmax');
	$sqlmax2=select($table,$arraymax2);
	$sqlmax2.=" WHERE bien_id ='".$_POST['pkbien']."'";
	$resmax2=connector1($user,$pass,$sqlmax2);
	$rowmax2=fetchArray($resmax2);
	$pkmaxtras2=$rowmax2['pkmax'];
	$array1=array('ultimo');
	$array2=array(value("si"));
	echo update($array1,$table,$pkmaxtras2,$pkt,$array2,$user,$pass);
	?>
	<script>
		$("#resultado").empty();
		alert("Datos Borrados");
	</script>
	<?php
	include($page);
}else{
	?>
    <script type="text/javascript">
		alert('No se puede borrar el traslado por que no es el ultimo movimiento');
	</script>
    <?php
	include"'".$page."'";
}
?>