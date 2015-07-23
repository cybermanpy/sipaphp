<?php
include'session.php';
include'../includes/charset.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/datatables.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jqueryui.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<link rel="stylesheet" href="../css/tableui.css" />
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<title>.::INVENTARIO:.</title>
</head>

<body>
<?php
require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$pk=$_GET['pk'];
$table='bienes';
$array=array('id_bien','nro_serie');
$sql=select($table,$array);
$sql.=" WHERE id_bien='".$pk."'";
$res = connector1($user,$pass,$sql);
$row=fetchArray($res);
$rows=getNumRows($res);
$pkt='id_bien';
$pages='viewbienes.php';
if($rows>0){
?>
<form id="form" name="form" method="post" onSubmit="borrar1('delete.php','#form');return false;">
<input type="hidden" id="table" name="table" value="<?=$table?>">
<input type="hidden" id="pkt" name="pkt" value="<?=$pkt?>">
<input type="hidden" id="page" name="page" value="<?=$pages?>">
<table id="tablereg" class="tablereg">
  <tr>
  	<th colspan="2">Borrar Bien</th>
  </tr>
  <tr>
    <td>PK </td>
    <td><input type="hidden" id="pk" name="pk" value="<?=$pk?>" /><? echo $pk;?></td>
  </tr>
  <tr>
    <td>Descripción</td>
    <td><input type="text" id="des" name="des"  value="<?=$row['nro_serie']?>" /></td>
  </tr>
  <tr>
    <td><input id="volver" type="submit" class="boton" value="Volver" onClick="mostrar1('<?=$pages?>');return false;"></td>
    <td><input id="delete" type="submit" class="boton" value="Borrar" ></td>
  </tr>
</table>
</form>
<?
}
?>
</body>
</html>