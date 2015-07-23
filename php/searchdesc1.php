<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="descripciones";
$array=array('id_desc','des_desc');
$sql=select($table,$array);
$sql.=" WHERE UPPER(des_desc) LIKE UPPER('%".$term."%') AND (id_desc = 11 OR id_desc=16 OR id_desc=25 OR id_desc=12 ) ";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['id_desc'];
	$row['value']=$row['des_desc'];
	$row['label']=$row['des_desc'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>