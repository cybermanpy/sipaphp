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
		  $('#frminsorgfin').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmuporgfin').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='vieworgfin.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminsorgfin" name="frminsorgfin" method="post" onSubmit="insert('insertorgfin.php','#frminsorgfin');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Organismo Financiador</th>
        </tr>
        <tr>
        	<td>Financiador</td>
            <td><input class="required" type="text" id="orgfin" name="orgfin" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='org_fin';
	$array=array('id_org_fin','des_org_fin');
	$sql=select($table,$array);
	$sql.=" WHERE id_org_fin='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmuporgfin" name="frmuporgfin" method="post" onSubmit="update('updateorgfin.php','#frmuporgfin');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Organismo Financiador</th>
        </tr>
        <tr>
        	<td>Financiador</td>
            <td><input class="required" type="text" id="orgfin" name="orgfin" value="<?= $row['des_org_fin']?>" /></td>
        </tr>
        <tr>	
            <<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_org_fin']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>