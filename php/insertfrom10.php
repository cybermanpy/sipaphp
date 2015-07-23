<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='form10';
	$arraydir=array('MAX(pkform10) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	if ($_POST['resp']!='' && $_POST['ubic']!=''){
		$array1=array('pkform10','dateform10','fkresp'/*,'fkubic'*/);
		$array2=array(value($pk),"now()",value($_POST['resp'])/*,value($_POST['ubic'])*/);
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