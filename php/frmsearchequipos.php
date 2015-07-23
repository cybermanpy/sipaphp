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
	});
</script>
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
$page="frmsearchequipos.php";
require_once'../includes/DbConnector.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
#Tabla Usuario
$tableusu="responsables";
$pkusu="id_resp";
$desusu="nom_resp";
$arrayusu=array('id_resp','nom_resp');
$ifusu=" WHERE fkestado=1 ";
#Tabla departamentos
$tabledpto="ubicaciones";
$pkdpto="id_ubic";
$desdpto="nom_depto";
$arraydpto=array('id_ubic','nom_depto');
#Tabla bienes
$tableb="bienes";
$pkb="id_bien";
$desb="id_bien";
$arrayb=array('id_bien');
$ifb=" WHERE cod_pat_mh <>'' AND (id_desc=11 OR id_desc=16 OR id_desc=25) ";
#Tabla bienes
$tablep="bienes";
$pkp="bien_padre";
$desp="bien_padre";
$arrayp=array('bien_padre');
$ifp=" WHERE (id_desc=11 OR id_desc=16 OR id_desc=25) ";
#Tabla direcciones
$tabledir="direcciones";
$pkdir="pkdir";
$desdir="sigladir";
$arraydir=array('pkdir','sigladir');
#codigo patrmonial
$tablecodp="bienes";
$pkcodp="cod_pat_mh";
$descodp="cod_pat_mh";
$arraycodp=array('cod_pat_mh');
$ifcodp=" WHERE cod_pat_mh <>'' AND (id_desc=11 OR id_desc=16 OR id_desc=25) ";
#codigo patrmonial nuevo
$tablecodn="bienes";
$pkcodn="codpatnew";
$descodn="codpatnew";
$arraycodn=array('codpatnew');
$ifcodn=" WHERE codpatnew <> '' AND (id_desc=11 OR id_desc=16 OR id_desc=25 )";
#Table Marcas
$tablemarca="marcas";
$pkmarca="id_marca";
$desmarca="des_marca";
$arraymarca=array('id_marca','des_marca');
#Tabla bienes-modelo
$tablemod="bienes";
$pkmod="modelo";
$desmod="modelo";
$arraymod=array(' DISTINCT  modelo');
$ifmod=" WHERE modelo <>'' ";
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
<form id="frmsearcheq" name="frmsearcheq" method="post" onSubmit="search1('searcheq.php','#frmsearcheq');return false;">
	<table class="tablereg1">
    <tr>
      <th colspan="6">Buscar Computadoras / Notebbok / Servidores</th>
    </tr>
    <tr>
      <td>Responsable</td>
      <td><select id="resp" name="resp" ><?php echo seleif($resp,$tableusu,$pkusu,$desusu,$ifusu,$arrayusu)?></select></td>
      <td>Departamento</td>
      <td><select id="ubic" name="ubic" ><?php echo sele($ubic,$tabledpto,$pkdpto,$desdpto,$arraydpto)?></select></td>
      <td>Bien</td>
      <td><select id="bien" name="bien" ><?php echo seleif($bien,$tableb,$pkb,$desb,$ifp,$arrayb)?></select></td>
    </tr>
    <tr>
      <td>Padre</td>
      <td><select id="padre" name="padre" ><?php echo seleif($padre,$tablep,$pkp,$desp,$ifp,$arrayp)?></select></td>
      <td>Cantidad Paginas</td>
      <td><select id="nrow" name="nrow"><?php echo sele1($nrow,$arrayrow);?></select></td>
      <td>Dirección</td>
      <td><select id="dir" name="dir" ><?php echo sele($dir,$tabledir,$pkdir,$desdir,$arraydir)?></select></td>
    </tr>
    <tr>
      <td>Código Patrimonial</td>
      <td><select id="cod" name="cod"><?php  echo seleif($cod,$tablecodp,$pkcodp,$descodp,$ifcodp,$arraycodp)?></select></td>
      <td>Código Patrimonial Nuevo</td>
      <td><select id="codn" name="codn" ><?php echo seleif($codn,$tablecodn,$pkcodn,$descodn,$ifcodn,$arraycodn)?></select></td>
      <td>Marcas</td>
      <td><select id="marca" name="marca" ><?php echo sele($marca,$tablemarca,$pkmarca,$desmarca,$arraymarca)?></select></td>
    </tr>
    <tr>
      <td>Modelo</td>
      <td><select id="modelo" name="modelo" ><?php echo seleif($modelo,$tablemod,$pkmod,$desmod,$ifmod,$arraymod)?></select></td>
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