<?php
include'session.php';
require_once'../includes/DbConnector.php';
?>
<?php
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table="descripciones";
$array=array('id_desc','des_desc');
$sql=select($table,$array);
$sql.=" WHERE fktipo='".$_POST['id']."' ORDER BY des_desc ";
$res=connector1($user,$pass,$sql);
$rows=getNumRows($res);
if($rows>0){
	?>
    <option selected="Selected" value="">Seleccionar</option>
    <?
  while($row=fetchArray($res)){
	?>
    <option value="<? echo $row['id_desc']?>"><? echo $row['des_desc']?></option>
    <?  
  }
}else{
	?>
	<option selected="Selected" value="">Seleccionar</option>
    <?
}
?>