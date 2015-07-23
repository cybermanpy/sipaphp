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
<script type="text/javascript">
  $(document).ready(function(){
	  $('#send').click(function(){
		  $('#frminsdes').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupdes').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewdescripciones.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$tablet='tipos';
$pkt='pktipo';
$dest='tiponame';
$arrayt=array('pktipo','tiponame');
if(!$_GET['pk']){
?>
<form id="frminsdes" name="frminsdes" method="post" onSubmit="insert('insertdescripciones.php','#frminsdes');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Descripción</th>
        </tr>
        <tr>
        	<td>Descripción</td>
            <td><input class="required" type="text" id="des" name="des" /></td>
        </tr>
        <tr>
        	<td>Código</td>
            <td><select class="required" id="tipo" name="tipo"><?= sele($datos,$tablet,$pkt,$dest,$arrayt)?></select></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='descripciones';
	$array=array('id_desc','des_desc','fktipo');
	$sql=select($table,$array);
	$sql.=" WHERE id_desc='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupdes" name="frmupdes" method="post" onSubmit="update('updatedescripciones.php','#frmupdes');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Descripción</th>
        </tr>
        <tr>
        	<td>Tipo</td>
            <td><input class="required" type="text" id="des" name="des" value="<?= $row['des_desc']?>" /></td>
        </tr>
        <tr>
        	<td>Código</td>
            <td><select class="required" id="tipo" name="tipo"><?= sele($row['fktipo'],$tablet,$pkt,$dest,$arrayt)?></select></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_desc']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>