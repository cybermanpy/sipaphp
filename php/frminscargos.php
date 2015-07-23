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
		  $('#frminscargos').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupcargos').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewcargos.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminscargos" name="frminscargos" method="post" onSubmit="insert('insertcargos.php','#frminscargos');return false;">
	<input type="hidden" id="page" name="page" value="<?=$page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Cargo</th>
        </tr>
        <tr>
        	<td>Cargo</td>
            <td><input class="required" type="text" id="cargo" name="cargo" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?=$page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='cargos';
	$array=array('pkcargo','descargo');
	$sql=select($table,$array);
	$sql.=" WHERE pkcargo='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupcargos" name="frmupcargos" method="post" onSubmit="update('updatecargos.php','#frmupcargos');return false;">
	<input type="hidden" id="page" name="page" value="<?=$page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Cargo</th>
        </tr>
        <tr>
        	<td>Tipo</td>
            <td><input class="required" type="text" id="cargo" name="cargo" value="<?=$row['descargo']?>" /></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?=$page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?=$row['pkcargo']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>