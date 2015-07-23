<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="tipos";
$array=array('pktipo','tiponame');
$sql=select($table,$array);
$sql.=" WHERE UPPER(tiponame) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row['id']=$row['pktipo'];
	$row['value']=$row['tiponame'];
	$row['label']=$row['tiponame'];
	$row_set[]=$row;
}
echo json_encode($row_set);
?>