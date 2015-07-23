<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesform10.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_traslado";}

if(isset($_GET['type'])){$type=$_GET['type'];}
else{$type="DESC";}

if(isset($_POST["resp"])) $resp = $_POST["resp"];
if(!isset($resp) && isset($_SESSION["resp"])) $resp = $_SESSION["resp"];
if(isset($resp)) $_SESSION["resp"] = $resp;
$pagtam=100;
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
$resp=$_POST['resp'];
if($resp!=""){
	$index="frmviewfc10.php";
	$table="traslados t, bienes b, descripciones d, responsables r, marcas m";
	$array=array('id_traslado','t.id_resp','des_desc','modelo','nom_resp','cod_pat_mh','codpatnew','des_marca','bien_id');
	$sql1=select($table,$array);
	$sql1.=" WHERE m.id_marca=b.id_marca AND t.bien_id=b.id_bien AND d.id_desc=b.id_desc AND ultimo='si' AND r.id_resp=t.id_resp AND t.id_resp='".$resp."' ";
	$res1=connector1($user,$pass,$sql1);
	$rows=getNumRows($res1);
	$total=ceil($rows/$pagtam);
	$sql=select($table,$array);
	$sql.=" WHERE m.id_marca=b.id_marca AND t.bien_id=b.id_bien AND d.id_desc=b.id_desc AND ultimo='si' AND r.id_resp=t.id_resp AND t.id_resp='".$resp."' ";
	$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
	$res=connector1($user,$pass,$sql);
	$arrayhead=array('Tareas','ID_bien','Responsable','Descripción','Marca','Modelo','Cod Pat','Cod Pat');
	$arraydb=array('bien_id','bien_id','nom_resp','des_desc','des_marca','modelo','cod_pat_mh','codpatnew');
	$title="GENERAR FORMULARIO FC 10";
	$del="frmdeltipos.php";
	$frm="insertfc10.php";
	$name="insfc10";
	page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$name,$resp);
}
?>
</body>
</html>