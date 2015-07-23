<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="bienes";
$array=array('DISTINCT bien_padre');
$sql=select($table,$array);
$sql.=" WHERE bien_padre = '".$term."'";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row_set[]=$row['bien_padre'];
}
echo json_encode($row_set);
?>