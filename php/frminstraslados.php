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
		  $('#frminstras').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewtraslados.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
#Tabla responsables
$tableres="responsables";
$pkres="id_resp";
$desres="nom_resp";
$arrayres=array('id_resp','nom_resp');
$if=" WHERE fkestado=1 ";
#Tabla ubicacion
$tableu="ubicaciones";
$pku="id_ubic";
$desu="des_ubic";
$arrayu=array('id_ubic','des_ubic');
#Tabla tipo traslado
$tablet="tipo_traslados";
$pkt="id_tipo_tras";
$dest="des_tipo_tras";
$arrayt=array('id_tipo_tras','des_tipo_tras');
if($_GET['pk']){
?>
<form id="frminstras" name="frminstras" method="post" onSubmit="insert('inserttraslados.php','#frminstras');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="4">Realizar Traslado</th>
        </tr>
        <tr>
        	<td>Bien</td>
            <td><input type="hidden" id="pkbien" name="pkbien" value="<?= $_GET['pk']?>" /><?= $_GET['pk']?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
        	<td>Responsable</td>
            <td><select class="required" id="res" name="res" ><?= seleif($datos,$tableres,$pkres,$desres,$if,$arrayres);?></select></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
        	<td>Tipo Traslado</td>
            <td><select class="required" id="tipo" name="tipo" ><?= sele($datos,$tablet,$pkt,$dest,$arrayt);?></select></td>
            <td>Motivo</td>
            <td><textarea class="required" id="motivo" name="motivo" ></textarea></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td colspan="3"><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>