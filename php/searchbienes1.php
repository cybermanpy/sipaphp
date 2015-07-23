<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesview.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_bien";}
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
if(isset($_POST["sn"])) $sn = $_POST["sn"];
if(isset($_POST["tipo"])) $tipo = $_POST["tipo"];
if(isset($_POST["desc"])) $desc = $_POST["desc"];
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
if(!isset($sn) && isset($_SESSION["sn"])) $sn = $_SESSION["sn"];
if(!isset($tipo) && isset($_SESSION["tipo"])) $tipo = $_SESSION["tipo"];
if(!isset($desc) && isset($_SESSION["desc"])) $desc = $_SESSION["desc"];
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
if (isset($sn)) $_SESSION["sn"] = $sn;
if (isset($tipo)) $_SESSION["tipo"] = $tipo;
if (isset($desc)) $_SESSION["desc"] = $desc;

if($_GET['a']=="reset"){
	$_SESSION['term']=$filtro="";
	$_SESSION['radio']=$radio="";
}	
$pagtam=$nrow;
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
$index="searchbienes1.php";
$table=" marcas m, descripciones d, proveedores p, conservacion c, tipo_documentos td, estados e, org_fin o, tipos ti, bienes b ";
$array=array('b.id_bien','modelo','nro_serie','des_desc','des_marca','cod_pat_mh','codpatnew','des_estado','bien_padre');
$sql1=select($table,$array);
$sql1.=" WHERE (b.id_marca=m.id_marca AND b.id_desc=d.id_desc AND b.id_prov=p.id_prov AND b.id_conserv=c.id_conserv AND b.id_tipo_doc=td.id_tipo_doc AND b.id_estado=e.id_estado AND b.id_org_fin=o.id_org_fin AND ti.pktipo=d.fktipo ) ";
if($bien!=""){
	$sql1.=" AND b.id_bien = '".$bien."' ";
}
if($padre!=""){
	$sql1.=" AND bien_padre = '".$padre."' ";
}
if($cod!=""){
	$sql1.=" AND cod_pat_mh = '".$cod."' ";
}
if($codn!=""){
	$sql1.=" AND codpatnew = '".$codn."' ";
}
if($marca!=""){
	$sql1.=" AND b.id_marca = '".$marca."' ";
}
if($modelo!=""){
	$sql1.=" AND modelo = '".$modelo."' ";
}
if($sn!=""){
	$sql1.=" AND nro_serie = '".$sn."' ";
}
if($tipo!=""){
	$sql1.=" AND pktipo = '".$tipo."' ";
}
if($desc!=""){
	$sql1.=" AND b.id_desc = '".$desc."' ";
}
if($radio==1 && $filtro!=""){
	$sql1.=" AND cod_pat_mh = '".$filtro."'";
}
if($radio==2 && $filtro!=""){
	$sql1.=" AND codpatnew = '".$filtro."'";
}
if($radio==3 && $filtro!=""){
	$sql1.=" AND nro_serie = '".$filtro."'";
}
$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
$sql.=" WHERE (b.id_marca=m.id_marca AND b.id_desc=d.id_desc AND b.id_prov=p.id_prov AND b.id_conserv=c.id_conserv AND b.id_tipo_doc=td.id_tipo_doc AND b.id_estado=e.id_estado AND b.id_org_fin=o.id_org_fin AND ti.pktipo=d.fktipo ) ";
if($bien!=""){
	$sql.=" AND b.id_bien = '".$bien."' ";
}
if($padre!=""){
	$sql.=" AND bien_padre = '".$padre."' ";
}
if($cod!=""){
	$sql.=" AND cod_pat_mh = '".$cod."' ";
}
if($codn!=""){
	$sql.=" AND codpatnew = '".$codn."' ";
}
if($marca!=""){
	$sql.=" AND b.id_marca = '".$marca."' ";
}
if($modelo!=""){
	$sql.=" AND modelo = '".$modelo."' ";
}
if($sn!=""){
	$sql.=" AND nro_serie = '".$sn."' ";
}
if($tipo!=""){
	$sql.=" AND pktipo = '".$tipo."' ";
}
if($desc!=""){
	$sql.=" AND b.id_desc = '".$desc."' ";
}
if($radio==1 && $filtro!=""){
	$sql.=" AND cod_pat_mh = '".$filtro."'";
}
if($radio==2 && $filtro!=""){
	$sql.=" AND codpatnew = '".$filtro."'";
}
if($radio==3 && $filtro!=""){
	$sql.=" AND nro_serie = '".$filtro."'";
}
$sql.=" ORDER BY ".$orden." ".$type." LIMIT ".$pagtam." OFFSET ".$inicio;
$res=connector1($user,$pass,$sql);
$arrayhead=array('Bien','Padre','Serie','Código MH','Código MH','Marca','Tipo','Modelo','Estado');
$arraydb=array('id_bien','bien_padre','nro_serie','cod_pat_mh','codpatnew','des_marca','des_desc','modelo','des_estado');
$title="BUSQUEDA DE EQUIPOS";

$show=$inicio+1 ." al ".$fin = min($nrow * $page, $rows)." / Total de registros: ".$rows;
page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$show);
?>
</body>
</html>