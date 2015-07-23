<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesearch.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_ficha";}

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
$index="viewfichas.php";
$table="fichas";
$array=array('id_ficha','id_bien','proc_mar','proc_mod','proc_vel','disco_mod','disco_cap','disco_vel','mem_mod','mem_cap','mem_vel','disketera','un_optica','tarj_red','tarj_son','parlante','microfono','cerra_tipo','cerra_nro','so_marca','so_mod','so_licen','ip_add','mac_add');
$sql1=select($table,$array);
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql1.=" WHERE id_ficha = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql1.=" WHERE id_bien = '".$filtro."' ";
}
$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql.=" WHERE id_ficha = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql.=" WHERE id_bien = '".$filtro."' ";
}
$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
$res=connector1($user,$pass,$sql);
$arrayhead=array('Tareas','PK','Bien','Procesador','Modelo','Velocidad','Disco','Capacidad','Velocidad','Memoria','Capacidad','Velocidad','Floppy','DVD','RED','Sonido','Parlante','Microfono','Cerradura','Nro Cerradura','S.O.','Modelo','Licencia','IP','MAC');
$arraydb=array('id_ficha','id_ficha','id_bien','proc_mar','proc_mod','proc_vel','disco_mod','disco_cap','disco_vel','mem_mod','mem_cap','mem_vel','disketera','un_optica','tarj_red','tarj_son','parlante','microfono','cerra_tipo','cerra_nro','so_marca','so_mod','so_licen','ip_add','mac_add');
$title="TABLA FICHAS";
$del="frmdelfichas.php";
$frm="frminsfichas.php";
$filtro1="PK";
$filtro2="Descripción";
$filtro3="";
$filtro4="";
$filtro5="";
$filtro6="";
page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6);
?>
</body>
</html>