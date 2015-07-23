<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesearch.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_ubic";}

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
$index="viewdptos.php";
$table=" ubicaciones u, direcciones d ";
$array=array('id_ubic','des_ubic','nom_depto','num_depto','sigladir');
$sql1=select($table,$array);
$sql1.=" WHERE u.fkdir=d.pkdir ";
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql1.=" AND id_ubic = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(nom_depto) LIKE UPPER('%".$filtro."%') ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql1.=" AND UPPER(des_ubic) LIKE UPPER('%".$filtro."%') ";
}
if($radio==4 && $filtro!="" && (int)$filtro){
	$sql1.=" AND num_depto = '".$filtro."'";
}
$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
$sql.=" WHERE u.fkdir=d.pkdir ";
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql.=" AND id_ubic = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(nom_depto) LIKE UPPER('%".$filtro."%') ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql.=" AND UPPER(des_ubic) LIKE UPPER('%".$filtro."%') ";
}
if($radio==4 && $filtro!="" && (int)$filtro){
	$sql.=" AND num_depto = '".$filtro."'";
}
$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
$res=connector1($user,$pass,$sql);
$arrayhead=array('Tareas','PK','Departamento','Siglas','Numero','Dirección');
$arraydb=array('id_ubic','id_ubic','nom_depto','des_ubic','num_depto','sigladir');
$title="TABLA DEPARTAMENTOS";
$del="frmdeldptos.php";
$frm="frminsdptos.php";
$filtro1="PK";
$filtro2="Nombre";
$filtro3="Sigla";
$filtro4="Numero";
$filtro5="";
$filtro6="";
page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6);
?>
</body>
</html>