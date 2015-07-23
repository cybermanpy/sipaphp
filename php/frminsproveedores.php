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
		  $('#frminsprov').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupprov').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewproveedores.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminsprov" name="frminsprov" method="post" onSubmit="insert('insertproveedores.php','#frminsprov');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Proveedor</th>
        </tr>
        <tr>
        	<td>Proveedor</td>
            <td><input class="required" type="text" id="prov" name="prov" /></td>
        </tr>
        <tr>
        	<td>Contacto</td>
            <td><input type="text" id="contacto" name="contacto" /></td>
        </tr>
        <tr>
        	<td>Télefono</td>
            <td><input class="required" type="text" id="tel" name="tel" /></td>
        </tr>
        <tr>
        	<td>Dirección</td>
            <td><input class="required" type="text" id="dir" name="dir" /></td>
        </tr>
        <tr>
        	<td>Correo</td>
            <td><input type="text" id="email" name="email" /></td>
        </tr>
        <tr>
        	<td>Web</td>
            <td><input type="text" id="web" name="web" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='proveedores';
	$array=array('id_prov','nom_prov','contacto','telefono','direccion','correo','web');
	$sql=select($table,$array);
	$sql.=" WHERE id_prov='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupprov" name="frmupprov" method="post" onSubmit="update('updateproveedores.php','#frmupprov');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Proveedor</th>
        </tr>
        <tr>
        	<td>Proveedor</td>
            <td><input class="required" type="text" id="prov" name="prov" value="<?= $row['nom_prov']?>" /></td>
        </tr>
        <tr>
        	<td>Contacto</td>
            <td><input type="text" id="contacto" name="contacto" value="<?= $row['contacto']?>" /></td>
        </tr>
        <tr>
        	<td>Télefono</td>
            <td><input class="required" type="text" id="tel" name="tel" value="<?= $row['telefono']?>" /></td>
        </tr>
        <tr>
        	<td>Dirección</td>
            <td><input class="required" type="text" id="dir" name="dir" value="<?= $row['direccion']?>" /></td>
        </tr>
        <tr>
        	<td>Correo</td>
            <td><input type="text" id="email" name="email" value="<?= $row['correo']?>" /></td>
        </tr>
        <tr>
        	<td>Web</td>
            <td><input type="text" id="web" name="web" value="<?= $row['web']?>" /></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_prov']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>