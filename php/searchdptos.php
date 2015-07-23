<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="ubicaciones u, direcciones d";
$array=array('nom_depto','id_ubic','sigladir');
$sql=select($table,$array);
$sql.=" WHERE u.fkdir=d.pkdir AND UPPER(nom_depto) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['id_ubic'];
	$row['value']=$row['sigladir']."-".$row['nom_depto'];
	$row['label']=$row['sigladir']."-".$row['nom_depto'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>