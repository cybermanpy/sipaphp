<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="responsables";
$array=array('nom_resp','id_resp');
$sql=select($table,$array);
$sql.=" WHERE UPPER(nom_resp) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['id_resp'];
	$row['value']=$row['nom_resp'];
	$row['label']=$row['nom_resp'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>