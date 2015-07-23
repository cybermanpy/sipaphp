<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="bienes";
$array=array('nro_serie');
$sql=select($table,$array);
$sql.=" WHERE nro_serie <> '' AND UPPER(nro_serie) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row_set[]=$row['nro_serie'];
}
echo json_encode($row_set);
?>