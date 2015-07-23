<?php
include'session.php';
require_once"../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table="responsables";
$array=array('cedula');
$sql=select($table,$array);
$sql.=" WHERE cedula= '".$_POST['v1']."' AND cedula <>'' ";
$res=connector1($user,$pass,$sql);
$rows=getNumRows($res);
if($rows>0){
	?>
		<span class="messageboxerror">La cedula ya existe</span>
    <?
}else{
	?>
		<span class="messageboxok">La cedula esta disponible</span>
    <?
}
?>