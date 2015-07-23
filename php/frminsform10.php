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
		  $('#frminsform10').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frminsform10').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewform10.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
#Tabla responsables
$tableres="responsables";
$pkres="id_resp";
$desres="nom_resp";
$arrayres=array('id_resp','nom_resp');
$if=" WHERE fkestado=1 ";
#Tabla ubicaciones
$tableu="ubicaciones";
$pku="id_ubic";
$desu="des_ubic";
$arrayu=array('id_ubic','des_ubic');
?>
<form id="frminsform10" name="frminsform10" method="post" onSubmit="insert('insertform10.php','#frminsform10');return false;">
	<input type="hidden" id="page" name="page" value="<?php echo $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar FC10</th>
        </tr>
        <tr>
        	<td>Responsable</td>
            <td><select class="required" id="res" name="res" ><?php echo seleif($datos,$tableres,$pkres,$desres,$if,$arrayres);?></select></td>
        </tr>
        <!--<tr>
        	<td>Ubicación</td>
        	<td><select class="required" id="ubic" name="ubic" ><?php #echo sele($datos,$tableu,$pku,$desu,$arrayu);?></select></td>-->
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?php echo $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>

</body>
</html>