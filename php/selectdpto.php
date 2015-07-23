<?php
include'session.php';
require_once'../includes/DbConnector.php';
include'../includes/charset.php';
?>
<?php
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table="ubicaciones";
$array=array('id_ubic','nom_depto');
$sql=select($table,$array);
$sql.=" WHERE fkdir='".$_POST['id']."' ORDER BY des_ubic ";
$res=connector1($user,$pass,$sql);
$rows=getNumRows($res);
if($rows>0){
	?>
    <option selected="Selected" value="">Seleccionar</option>
    <?
  while($row=fetchArray($res)){
	?>
    <option value="<? echo $row['id_ubic']?>"><? echo $row['nom_depto']?></option>
    <?  
  }
}else{
	?>
	<option selected="Selected" value="">Seleccionar</option>
    <?
}
?>