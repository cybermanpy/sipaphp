<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="direcciones";
$array=array('sigladir','pkdir');
$sql=select($table,$array);
$sql.=" WHERE UPPER(sigladir) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['pkdir'];
	$row['value']=$row['sigladir'];
	$row['label']=$row['sigladir'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>