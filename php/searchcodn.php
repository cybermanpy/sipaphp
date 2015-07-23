<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="bienes";
$array=array('codpatnew');
$sql=select($table,$array);
$sql.=" WHERE codpatnew <>'' AND UPPER(codpatnew) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row_set[]=$row['codpatnew'];
}
echo json_encode($row_set);
?>