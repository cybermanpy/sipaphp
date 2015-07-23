<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="estados";
$array=array('id_estado','des_estado');
$sql=select($table,$array);
$sql.=" WHERE UPPER(des_estado) LIKE UPPER('%".$term."%') AND (id_estado=1 OR id_estado=7)";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['id_estado'];
	$row['value']=$row['des_estado'];
	$row['label']=$row['des_estado'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>