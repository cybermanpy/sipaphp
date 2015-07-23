<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table='traslados';
$pk=$_POST['pk'];
$pkt='id_traslado';
$size = $_FILES["file"]['size'];
$tipo = $_FILES["file"]['type'];
$file = $_FILES["file"]['name'];
$targetpath =  "../../inventario/uploads/".$file;
$targetdb =  "uploads/".$file;
if ($file!="" ){
	if (copy($_FILES['file']['tmp_name'],$targetpath)) {
		$array1=array('filetras');
		$array2=array(value($targetdb));
		update($array1,$table,$pk,$pkt,$array2,$user,$pass);
		?>
		<script>
			alert("Documento Insertado");
			/*$("#resultado").empty();*/
		</script>
		<?php
	}else{
		?>
		<script>
			/*$("#resultado").empty();*/
			alert("Error al subir el archivo");
		</script>
		<?php
	}
	#include($page);
}
?>