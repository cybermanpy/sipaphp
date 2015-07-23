<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='org_fin';
	$arraydir=array('MAX(id_org_fin) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['orgfin']!='' ){
		$array1=array('id_org_fin','des_org_fin');
		$array2=array(value($pk),value($_POST['orgfin']));
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