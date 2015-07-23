<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='proveedores';
	$arraydir=array('MAX(id_prov) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['prov']!='' && $_POST['tel']!='' && $_POST['dir']!='' ){
		$array1=array('id_prov','nom_prov','contacto','telefono','direccion','correo','web');
		$array2=array(value($pk),value($_POST['prov']),value($_POST['contacto']),value($_POST['tel']),value($_POST['dir']),value($_POST['email']),value($_POST['web']));
		insert($array1,$table,$array2,$user,$pass);
		?>
		<script>
			$("#resultado").empty();
			alert("Datos Insertados");
		</script>
		<?php
		include($pages);
	}
?>