<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="marcas";
$array=array('id_marca','des_marca');
$sql=select($table,$array);
$sql.=" WHERE UPPER(des_marca) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['id_marca'];
	$row['value']=$row['des_marca'];
	$row['label']=$row['des_marca'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>