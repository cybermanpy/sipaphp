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
$fkform=$_GET['fkform'];
$fkbien=$_GET['fkbien'];
$table='bienform10';
$array=array('fkform10','fkbien');
$sql=select($table,$array);
$sql.=" WHERE fkform10='".$fkform."' AND fkbien='".$fkbien."' ";
$res =connector1($user,$pass,$sql);
$row=fetchArray($res);
$rows=getNumRows($res);
$fkformt='fkform10';
$fkbient='fkbien';
$pages='viewform10.php';
if($rows>0){
?>
<form id="form" name="form" method="post" onSubmit="borrar1('deletef.php','#form');return false;">
<input type="hidden" id="table" name="table" value="<?=$table?>">
<input type="hidden" id="fkformt" name="fkformt" value="<?=$fkformt?>">
<input type="hidden" id="fkbient" name="fkbient" value="<?=$fkbient?>">
<input type="hidden" id="page" name="page" value="<?=$pages?>">
<table id="tablereg" class="tablereg">
  <tr>
  	<th colspan="2">Borrar Detalles FC 10</th>
  </tr>
  <tr>
    <td>FkForm </td>
    <td><input type="hidden" id="fkform" name="fkform" value="<?=$fkform?>" /><?=$fkform;?></td>
  </tr>
  <tr>
    <td>FkBien</td>
    <td><input type="hidden" id="fkbien" name="fkbien"  value="<?=$fkbien?>" /><?=$fkbien;?></td>
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