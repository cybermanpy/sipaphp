<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesviewdetfc10.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="pkform10";}
if(isset($_GET['type'])){$type=$_GET['type'];}
else{$type="DESC";}
if(isset($_POST["term"])){$filtro = $_POST["term"];}
if(isset($_POST["radio"])){$radio = $_POST["radio"];}
if(isset($radio)){$_SESSION["radio"] = $radio;}
if(isset($filtro)){$_SESSION["term"] = $filtro;}
if(isset($_POST["bien"])) $bien = $_POST["bien"];
if(isset($_POST["resp"])) $resp = $_POST["resp"];
if(isset($_POST["ubic"])) $ubic = $_POST["ubic"];
if(isset($_POST["padre"])) $padre = $_POST["padre"];
if(isset($_POST["nrow"])) $nrow = $_POST["nrow"];
if(isset($_POST["dir"])) $dir = $_POST["dir"];
if(isset($_POST["cod"])) $cod = $_POST["cod"];
if(isset($_POST["codn"])) $codn = $_POST["codn"];
if(isset($_POST["marca"])) $marca = $_POST["marca"];
if(isset($_POST["modelo"])) $modelo = $_POST["modelo"];
if(!isset($radio) && isset($_SESSION["radio"])){$radio = $_SESSION["radio"];}
if(!isset($filtro) && isset($_SESSION["term"])){$filtro = $_SESSION["term"];}
if(!isset($bien) && isset($_SESSION["bien"])) $bien = $_SESSION["bien"];
if(!isset($resp) && isset($_SESSION["resp"])) $resp = $_SESSION["resp"];
if(!isset($ubic) && isset($_SESSION["ubic"])) $ubic = $_SESSION["ubic"];
if(!isset($padre) && isset($_SESSION["padre"])) $padre = $_SESSION["padre"];
if(!isset($nrow) && isset($_SESSION["nrow"])) $nrow = $_SESSION["nrow"];
if(!isset($dir) && isset($_SESSION["dir"])) $dir = $_SESSION["dir"];
if(!isset($cod) && isset($_SESSION["cod"])) $cod = $_SESSION["cod"];
if(!isset($codn) && isset($_SESSION["codn"])) $codn = $_SESSION["codn"];
if(!isset($codn) && isset($_SESSION["marca"])) $marca = $_SESSION["marca"];
if(!isset($modelo) && isset($_SESSION["modelo"])) $modelo = $_SESSION["modelo"];
if (isset($bien)) $_SESSION["bien"] = $bien;
if (isset($resp)) $_SESSION["resp"] = $resp;
if (isset($ubic)) $_SESSION["ubic"] = $ubic;
if (isset($padre)) $_SESSION["padre"] = $padre;
if (isset($nrow)) $_SESSION["nrow"] = $nrow;
if (isset($dir)) $_SESSION["dir"] = $dir;
if (isset($cod)) $_SESSION["cod"] = $cod;
if (isset($codn)) $_SESSION["codn"] = $codn;
if (isset($marca)) $_SESSION["marca"] = $marca;
if (isset($modelo)) $_SESSION["modelo"] = $modelo;

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
$index="viewform10.php";
$table="form10 f, responsables r, ubicaciones u, direcciones d";
$array=array('pkform10','dateform10','nom_resp','nom_depto','id_resp');
$sql1=select($table,$array);
$sql1.=" WHERE f.fkresp=r.id_resp AND r.fkubicacion=u.id_ubic AND d.pkdir=u.fkdir ";

$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
$sql.=" WHERE f.fkresp=r.id_resp AND r.fkubicacion=u.id_ubic AND d.pkdir=u.fkdir ";

$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
$res=connector1($user,$pass,$sql);
$arrayhead=array('Tareas','PK','Fecha','Responsable','Departamento','Detalles');
$arraydb=array('pkform10','pkform10','dateform10','nom_resp','nom_depto','pkform10');
$title="FORMULARIO FC 10";

/************************************************************/
//Codigo para buscar hijos
$tableparte='bienform10 bf, bienes b, descripciones d';
$arrayparte=array('fkform10','fkbien','des_desc','caracteristicas');
$arraypartehead=array('DELETE','PKBIEN','Descripción','Características');
$arraypartedb=array('fkform10','fkbien','des_desc','caracteristicas');
$whereparte =" WHERE d.id_desc=b.id_desc AND bf.fkbien=b.id_bien AND fkform10='";

$frm="frmfc10.php";
$delparte="frmdelbienform10.php";
$del="frmdelform10.php";

page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$tableparte,$arrayparte,$arraypartedb,$arraypartehead,$whereparte,$user,$pass,$delparte);
?>
</body>
</html>