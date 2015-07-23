<?php
include'session.php';
require_once'../includes/DbConnector.php';
?>
<?php
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$pages=$_POST['page'];
$table='form10';
$array=array('MAX(pkform10) AS pk');
$sql=select($table,$array);
$res=connector1($user,$pass,$sql);
$row=fetchArray($res);
$pk=$row['pk']+1;
if ($_POST['resp1']!='' ){
	$array1=array('pkform10','dateform10','fkresp');
	$array2=array(value($pk),'now()',value($_POST['resp1']));
	insert($array1,$table,$array2,$user,$pass);
}
$arraybien=$_POST['bien'];
for($i=0;$i<count($arraybien);$i++){
	$tabledet="bienform10";
	$arraydb=array('fkform10','fkbien');
	$arrayvalues=array(value($pk),value($arraybien[$i]));
	insert($arraydb,$tabledet,$arrayvalues,$user,$pass);
}
?>
<script>
	$("#resultado").empty();
	alert("Datos Insertados");
</script>
<?php
include'viewform10.php';
?>
