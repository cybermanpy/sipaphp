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
<script type="text/javascript">
	$(document).ready(function(){
		$(".botonExcel").click(function(event) {  
      		$("#datos_a_enviar").val( $("<div>").append( $("#searcht").eq(0).clone()).html());  
      		$("#FormularioExportacion").submit();  
 		});
		$("#bien").autocomplete({
			source:"searchpkbien.php",
			minLength:1
		});
		$("#padre").autocomplete({
			source:"searchpadre.php",
			minLength:1
		});
		$("#cod").autocomplete({
			source:"searchcod.php",
			minLength:4
		});
		$("#codn").autocomplete({
			source:"searchcodn.php",
			minLength:6
		});
		$("#marca1").autocomplete({
			source:"searchmarcas.php",
			minLength:2,
			select:function(event,ui){
				$("#marca").attr("value",ui.item.id);
			}
		});
		$("#modelo").autocomplete({
			source:"searchmodelos.php",
			minLength:2
		});
		$("#sn").autocomplete({
			source:"searchsn.php",
			minLength:2
		});
		$("#tipo1").autocomplete({
			source:"searchtipos.php",
			minLength:2,
			select:function(event,ui){
				$("#tipo").attr("value",ui.item.id);
			}
		});
		$("#desc1").autocomplete({
			source:"searchdesc.php",
			minLength:2,
			select:function(event,ui){
				$("#desc").attr("value",ui.item.id);
			}
		});
	});
</script>
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
$page="frmsearchequiposb.php";
require_once'../includes/DbConnector.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
#Paginas
$arrayrow=array('5','10','15','20','30','40','50','60','100','200','500','1000');
if($_GET['a']=="reset"){
	$bien="";
	$resp="";
	$ubic="";
	$padre="";
	$nrow=5;
	$dir="";
	$cod="";
	$codn="";
	$marca="";
	$modelo="";
	$radio="";
	$filtro="";
}	
?>
<form id="frmsearcheq" name="frmsearcheq" method="post" onSubmit="search1('searchbienes1.php','#frmsearcheq');return false;">
	<table class="tablereg1">
    <tr>
      <th colspan="6">Buscar Bienes Sin Responsables</th>
    </tr>
    <tr>
      <td>Bien</td>
      <td><input type="text" id="bien" name="bien" /></td>
      <td>Modelo</td>
      <td><input type="text" id="modelo" name="modelo" /></td>
      <td>Nro. Serie</td>
      <td><input type="text" id="sn" name="sn" /></td>
    </tr>
    <tr>
      <td>Padre</td>
      <td><input type="text" id="padre" name="padre" /></td>
      <td>Cantidad Paginas</td>
      <td><select id="nrow" name="nrow"><?php echo sele1($nrow,$arrayrow);?></select></td>            
      <td>Código Patrimonial</td>
      <td><input type="text" id="cod" name="cod" /></td>
    </tr>
    <tr>
      <td>Código Patrimonial Nuevo</td>
      <td><input type="text" id="codn" name="codn" /></td>
      <td>Marcas</td>
      <td><input type="text" id="marca1" name="marca1" /><input type="hidden" name="marca" id="marca" /></td>
      <td>Tipo</td>
      <td><input type="text" id="tipo1" name="tipo1" /><input type="hidden" name="tipo" id="tipo" /></td>
    </tr>
    <tr>
    	<td>Descripción</td>
      <td><input type="text" id="desc1" name="desc1" /><input type="hidden" name="desc" id="desc" /></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Filtro:</td>
      <td><input type="text" id="term" name="term" /></td>
      <td>CodPat<input type="radio" name="campo" value="1"/></td>
      <td>CodPat nuevo<input type="radio" name="campo" value="2"/><td>
      <td>Nro Serie<input type="radio" name="campo" value="3"/></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5"><input onClick="mostrar1('<?php echo $page?>?a=reset'); return false;" class="boton" type="submit" id="clean1" value="Limpiar" /></td>
      <td colspan="5"><input class="boton" type="submit" id="send" value="Aplicar" /></td>
    </tr>
  </table>
</form>
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">  
    <p>Exportar a Excel  <img src="../img/page_excel.png" class="botonExcel" /></p>  
    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />  
</form>  
</body>
</html>