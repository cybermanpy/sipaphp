<?php
include'session.php';
require_once"../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table="bienes";
$array=array('id_bien');
$sql=select($table,$array);
$sql.=" WHERE codpatnew = '".$_POST['v1']."' AND codpatnew <>'' ";
$res=connector1($user,$pass,$sql);
$rows=getNumRows($res);
if($rows>0){
	?>
		<span class="messageboxerror">El codigo ya existe</span>
    <?
}else{
	?>
		<span class="messageboxok">El codigo esta disponible</span>
    <?
}
?>