<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesearchbienes.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_bien";}

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
<link rel="stylesheet" href="../css/tableui.css" />
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<title>.::INVENTARIO:.</title>
</head>

<body>
<?php
$index="viewbienes.php";
$table=" marcas m, descripciones d, proveedores p, conservacion c, tipo_documentos td, estados e, org_fin o, tipos ti, (bienes b LEFT JOIN traslados t ON b.id_bien = t.bien_id and t.ultimo='si') ";
$array=array('id_bien','tiponame','cod_pat_mh','codpatnew','nro_serie','cod_pat_of','des_desc','des_marca','modelo','nom_prov','des_org_fin','des_estado','bien_padre','d.id_desc','caracteristicas','fec_com');
$sql1=select($table,$array);
$sql1.=" WHERE (b.id_marca=m.id_marca AND b.id_desc=d.id_desc AND b.id_prov=p.id_prov AND b.id_conserv=c.id_conserv AND b.id_tipo_doc=td.id_tipo_doc AND b.id_estado=e.id_estado AND b.id_org_fin=o.id_org_fin AND ti.pktipo=d.fktipo) ";
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql1.=" AND id_bien = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql1.=" AND bien_padre = '".$filtro."' ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(nro_serie) = UPPER('".$filtro."') ";
}
if($radio==4 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(des_desc) LIKE UPPER('%".$filtro."%') ";
}
$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
$sql.=" WHERE (b.id_marca=m.id_marca AND b.id_desc=d.id_desc AND b.id_prov=p.id_prov AND b.id_conserv=c.id_conserv AND b.id_tipo_doc=td.id_tipo_doc AND b.id_estado=e.id_estado AND b.id_org_fin=o.id_org_fin AND ti.pktipo=d.fktipo) ";
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql.=" AND id_bien = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql.=" AND bien_padre = '".$filtro."' ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(nro_serie) = UPPER('".$filtro."') ";
}
if($radio==4 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(des_desc) LIKE UPPER('%".$filtro."%') ";
}
$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
$res=connector1($user,$pass,$sql);
$arrayhead=array('Tareas','ID Bien','Padre','Código Pat','Código Pat','Serie','Descripción','Características','Marca','Modelo','Proveedor','Estado','Fecha');
$arraydb=array('id_bien','id_bien','bien_padre','cod_pat_mh','codpatnew','nro_serie','des_desc','caracteristicas','des_marca','modelo','nom_prov','des_estado','fec_com');
$title="TABLA BIENES";
$del="frmdelbienes.php";
$frm="frminsbienes.php";
$frmmove="frminstraslados.php";
$frmchart="frminsfichas.php";
$filtro1="ID_Bien";
$filtro2="Padre";
$filtro3="Serie";
$filtro4="Descripción";
$filtro5="";
$filtro6="";
page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$frmmove,$frmchart);
?>
</body>
</html>