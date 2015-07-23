<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='responsables';
	$arraydir=array('MAX(id_resp) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['name']!='' && $_POST['cargo']!='' && $_POST['estado']!='' && $_POST['ubic']!='' && $_POST['cedula']!=''&& (int)$_POST['cedula']){
		$array1=array('id_resp','nom_resp','fkcargo','fkestado','fkubicacion','cedula');
		$array2=array(value($pk),value($_POST['name']),value($_POST['cargo']),value($_POST['estado']),value($_POST['ubic']),value($_POST['cedula']));
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