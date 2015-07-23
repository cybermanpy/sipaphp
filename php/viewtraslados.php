<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesearchmove.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_traslado";}

if(isset($_GET['type'])){$type=$_GET['type'];}
else{$type="DESC";}

if(isset($_POST["term"])){$filtro = $_POST["term"];}
if(isset($_POST["radio"])){$radio = $_POST["radio"];}

if(isset($radio)){$_SESSION["radio"] = $radio;}
if(isset($filtro)){$_SESSION["term"] = $filtro;}

if(!isset($radio) && isset($_SESSION["radio"])){$radio = $_SESSION["radio"];}
if(!isset($filtro) && isset($_SESSION["term"])){$filtro = $_SESSION["term"];}

if($_GET['a']=="reset"){
	$_SESSION['term']=$filtro="";
	$_SESSION['radio']=$radio="";
}	
$pagtam=10;
$page=$_GET['page'];
if(isset($page)){
	$inicio=($page-1)*$pagtam;
}else{
	$inicio=0;
	$page=1;
}
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/datatables.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jqueryui.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<script type="text/javascript">
$(".botonExcel").click(function(event) {  
 		$("#datos_a_enviar").val( $("<div>").append( $(".viewtable").eq(0).clone()).html());  
 		$("#FormularioExportacion").submit();  
});
</script>
<link rel="stylesheet" href="../css/tableui.css" />
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<title>.::INVENTARIO:.</title>
</head>

<body>
<?php
$index="viewtraslados.php";
$table=" bienes b, traslados t, responsables r, ubicaciones u, tipo_traslados  tt, descripciones d, direcciones dir ";
$array=array('id_traslado','bien_id','motivo','nom_resp','des_desc','nom_depto','fec_traslado','des_tipo_tras','ultimo','filetras','fc11tras','namedir','nro_serie');
$sql1=select($table,$array);
$sql1.=" WHERE (t.bien_id=b.id_bien AND t.id_resp=r.id_resp AND r.fkubicacion=u.id_ubic AND u.fkdir=dir.pkdir AND t.id_tipo_tras=tt.id_tipo_tras AND b.id_desc = d.id_desc) ";
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql.=" AND id_traslado = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql1.=" AND bien_id = '".$filtro."' ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(nom_resp) LIKE UPPER('%".$filtro."%') ";
}
if($radio==4 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(des_ubic) LIKE UPPER('%".$filtro."%') ";
}
if($radio==5 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(des_desc) LIKE UPPER('%".$filtro."%') ";
}
if($radio==6 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(des_tipo_tras) = UPPER('".$filtro."') ";	
}
$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
$sql.=" WHERE (t.bien_id=b.id_bien AND t.id_resp=r.id_resp AND r.fkubicacion=u.id_ubic AND u.fkdir=dir.pkdir AND t.id_tipo_tras=tt.id_tipo_tras AND b.id_desc = d.id_desc) ";
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql.=" AND id_traslado = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql.=" AND bien_id = '".$filtro."' ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(nom_resp) LIKE UPPER('%".$filtro."%') ";
}
if($radio==4 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(des_ubic) LIKE UPPER('%".$filtro."%') ";
}
if($radio==5 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(des_desc) LIKE UPPER('%".$filtro."%') ";
}
if($radio==6 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(des_tipo_tras) = UPPER('".$filtro."') ";
}
$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
$res=connector1($user,$pass,$sql);
$arrayhead=array('Tareas','FEE','Move','UP FC11','FC11','ID_Traslado','ID_Bien','Motivo','Responsable','Equipo','Serie','Dirección','Departamento','Fecha','Tipo','Ultimo','FC11');
$arraydb=array('id_traslado','filetras','bien_id','id_traslado','id_traslado','id_traslado','bien_id','motivo','nom_resp','des_desc','nro_serie','namedir','nom_depto','fec_traslado','des_tipo_tras','ultimo','fc11tras');
$title="TABLA TRASLADOS";
$del="frmdeltraslados.php";
$frm="frminstraslados.php";
$upfee="frmupfee.php";
$upfc11="frmupfc11.php";
$printfee="printfee.php";
$printfc11="printfc11.php";
$filtro1="ID_Traslado";
$filtro2="Bien";
$filtro3="Usuario";
$filtro4="Dpto";
$filtro5="Descripcion";
$filtro6="Tipo";
?>
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">  
    <p>Exportar a Excel  <img src="../img/page_excel.png" class="botonExcel" /></p>  
    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />  
</form>  
<?
page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$upfee,$upfc11,$printfee,$printfc11);
?>
</body>
</html>