<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='direcciones';
	$arraydir=array('MAX(pkdir) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['dir']!='' && $_POST['sigla']!='' && $_POST['num']!=''){
		$array1=array('pkdir','namedir','sigladir','numdir');
		$array2=array(value($pk),value($_POST['dir']),value($_POST['sigla']),value($_POST['num']));
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