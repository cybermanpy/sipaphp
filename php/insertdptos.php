<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='ubicaciones';
	$arraydir=array('MAX(id_ubic) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['dpto']!='' && $_POST['sigla']!='' && $_POST['num']!='' && $_POST['dir']!=''){
		$array1=array('id_ubic','nom_depto','des_ubic','num_depto','fkdir');
		$array2=array(value($pk),value($_POST['dpto']),value($_POST['sigla']),value($_POST['num']),value($_POST['dir']));
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