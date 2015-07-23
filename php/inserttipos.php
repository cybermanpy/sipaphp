<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='tipos';
	$arraydir=array('MAX(pktipo) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['tipo']!='' && $_POST['cod']!=''){
		$array1=array('pktipo','tiponame','codtipo');
		$array2=array(value($pk),value($_POST['tipo']),value($_POST['cod']));
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