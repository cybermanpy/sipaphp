<?php
include"session.php";
require_once"../includes/charset.php";
require_once "../includes/DbConnector.php";
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$term=trim(strip_tags($_GET['term']));
$table="bienes";
$array=array('cod_pat_mh');
$sql=select($table,$array);
$sql.=" WHERE cod_pat_mh <>'' AND UPPER(cod_pat_mh) LIKE UPPER('%".$term."%')";
$res=connector1($user,$pass,$sql);
while($row=fetchArray($res)){
	$row_set[]=$row['cod_pat_mh'];
}
echo json_encode($row_set);
?>