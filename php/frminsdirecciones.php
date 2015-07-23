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
		  $('#frminsdir').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupdir').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewdirecciones.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminsdir" name="frminsdir" method="post" onSubmit="insert('insertdirecciones.php','#frminsdir');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Dirección</th>
        </tr>
        <tr>
        	<td>Dirección</td>
            <td><input class="required" type="text" id="dir" name="dir" /></td>
        </tr>
        <tr>
        	<td>Sigla</td>
            <td><input class="required" type="text" id="sigla" name="sigla" /></td>
        </tr>
        <tr>
        	<td>Número</td>
            <td><input class="required" type="text" id="num" name="num" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='direcciones';
	$array=array('pkdir','sigladir','namedir','numdir');
	$sql=select($table,$array);
	$sql.=" WHERE pkdir='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupdir" name="frmupdir" method="post" onSubmit="update('updatedirecciones.php','#frmupdir');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Dirección</th>
        </tr>
        <tr>
        	<td>Dirección</td>
            <td><input class="required" type="text" id="dir" name="dir" value="<?= $row['namedir']?>" /></td>
        </tr>
        <tr>
        	<td>Sigla</td>
            <td><input class="required" type="text" id="sigla" name="sigla" value="<?= $row['sigladir']?>" /></td>
        </tr>
        <tr>
        	<td>Numero</td>
            <td><input class="required" type="text" id="num" name="num" value="<?= $row['numdir']?>" /></td>
        </tr>
        <tr>
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['pkdir']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>