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
		  $('#frminstipotras').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmuptipotras').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewtipotraslados.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminstipotras" name="frminstipotras" method="post" onSubmit="insert('inserttipotraslados.php','#frminstipotras');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Tipo Traslado</th>
        </tr>
        <tr>
        	<td>Tipo traslado</td>
            <td><input class="required" type="text" id="tipotras" name="tipotras" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='tipo_traslados';
	$array=array('id_tipo_tras','des_tipo_tras');
	$sql=select($table,$array);
	$sql.=" WHERE id_tipo_tras='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmuptipotras" name="frmuptipotras" method="post" onSubmit="update('updatetipotraslados.php','#frmuptipotras');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Tipo Traslado</th>
        </tr>
        <tr>
        	<td>Tipo traslado</td>
            <td><input class="required" type="text" id="tipotras" name="tipotras" value="<?= $row['des_tipo_tras']?>" /></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_tipo_tras']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>