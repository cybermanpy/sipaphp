<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
include'../includes/pagesearchmove1.php';

if(isset($_GET['orden'])){$orden=$_GET['orden'];}
else{$orden="id_traslado";}

if(isset($_GET['type'])){$type=$_GET['type'];}
else{$type="DESC";}

if(isset($_POST["term"])){$filtro = $_POST["term"];}
if(isset($_POST["radio"])){$radio = $_POST["radio"];}
if(isset($_POST["bien"])) $bien = $_POST["bien"];
if(isset($_POST["resp"])) $resp = $_POST["resp"];
if(isset($_POST["resp1"])) $resp1 = $_POST["resp1"];
if(isset($_POST["ubic"])) $ubic = $_POST["ubic"];
if(isset($_POST["ubic1"])) $ubic1 = $_POST["ubic1"];
if(isset($_POST["nrow"])) $nrow = $_POST["nrow"];
if(isset($_POST["dir"])) $dir = $_POST["dir"];
if(isset($_POST["dir1"])) $dir1 = $_POST["dir1"];
if(isset($_POST["cod"])) $cod = $_POST["cod"];
if(isset($_POST["codn"])) $codn = $_POST["codn"];
if(isset($_POST["marca"])) $marca = $_POST["marca"];
if(isset($_POST["marca1"])) $marca1 = $_POST["marca1"];
if(isset($_POST["modelo"])) $modelo = $_POST["modelo"];
if(isset($_POST["sn"])) $sn = $_POST["sn"];
if(isset($_POST["tipo"])) $tipo = $_POST["tipo"];
if(isset($_POST["desc"])) $desc = $_POST["desc"];
if(isset($_POST["desc1"])) $desc1 = $_POST["desc1"];

if(isset($radio)){$_SESSION["radio"] = $radio;}
if(isset($filtro)){$_SESSION["term"] = $filtro;}
if (isset($bien)) $_SESSION["bien"] = $bien;
if (isset($resp)) $_SESSION["resp"] = $resp;
if (isset($resp1)) $_SESSION["resp1"] = $resp1;
if (isset($ubic)) $_SESSION["ubic"] = $ubic;
if (isset($ubic1)) $_SESSION["ubic1"] = $ubic1;
if (isset($nrow)) $_SESSION["nrow"] = $nrow;
if (isset($dir)) $_SESSION["dir"] = $dir;
if (isset($dir1)) $_SESSION["dir1"] = $dir1;
if (isset($cod)) $_SESSION["cod"] = $cod;
if (isset($codn)) $_SESSION["codn"] = $codn;
if (isset($marca)) $_SESSION["marca"] = $marca;
if (isset($marca1)) $_SESSION["marca1"] = $marca1;
if (isset($modelo)) $_SESSION["modelo"] = $modelo;
if (isset($sn)) $_SESSION["sn"] = $sn;
if (isset($tipo)) $_SESSION["tipo"] = $tipo;
if (isset($desc)) $_SESSION["desc"] = $desc;
if (isset($desc1)) $_SESSION["desc1"] = $desc1;

if(!isset($radio) && isset($_SESSION["radio"])){$radio = $_SESSION["radio"];}
if(!isset($filtro) && isset($_SESSION["term"])){$filtro = $_SESSION["term"];}
if(!isset($bien) && isset($_SESSION["bien"])) $bien = $_SESSION["bien"];
if(!isset($resp) && isset($_SESSION["resp"])) $resp = $_SESSION["resp"];
if(!isset($resp1) && isset($_SESSION["resp1"])) $resp1 = $_SESSION["resp1"];
if(!isset($ubic) && isset($_SESSION["ubic"])) $ubic = $_SESSION["ubic"];
if(!isset($ubic1) && isset($_SESSION["ubic1"])) $ubic1 = $_SESSION["ubic1"];
if(!isset($nrow) && isset($_SESSION["nrow"])) $nrow = $_SESSION["nrow"];
if(!isset($dir) && isset($_SESSION["dir"])) $dir = $_SESSION["dir"];
if(!isset($dir1) && isset($_SESSION["dir1"])) $dir1 = $_SESSION["dir1"];
if(!isset($cod) && isset($_SESSION["cod"])) $cod = $_SESSION["cod"];
if(!isset($codn) && isset($_SESSION["codn"])) $codn = $_SESSION["codn"];
if(!isset($marca) && isset($_SESSION["marca"])) $marca = $_SESSION["marca"];
if(!isset($marca1) && isset($_SESSION["marca1"])) $marca1 = $_SESSION["marca1"];
if(!isset($modelo) && isset($_SESSION["modelo"])) $modelo = $_SESSION["modelo"];
if(!isset($sn) && isset($_SESSION["sn"])) $sn = $_SESSION["sn"];
if(!isset($tipo) && isset($_SESSION["tipo"])) $tipo = $_SESSION["tipo"];
if(!isset($desc) && isset($_SESSION["desc"])) $desc = $_SESSION["desc"];
if(!isset($desc1) && isset($_SESSION["desc1"])) $desc1 = $_SESSION["desc1"];

if($_GET['a']=="reset"){
	$_SESSION['term']=$filtro="";
	$_SESSION['radio']=$radio="";
	$_SESSION["bien"]=$bien="";
	$_SESSION["resp"]=$resp="";
	$_SESSION["resp1"]=$resp1="";
	$_SESSION["ubic"]=$ubic="";
	$_SESSION["ubic1"]=$ubic1="";
	$_SESSION['nrow']=$nrow=10;
	$_SESSION["dir"]=$dir="";
	$_SESSION["cod"]=$cod="";
	$_SESSION["cod"]=$codn="";
	$_SESSION["marca"]=$marca="";
	$_SESSION["marca1"]=$marca1="";
	$_SESSION["modelo"]=$modelo="";
	$_SESSION["desc"]=$desc="";
	$_SESSION["desc1"]=$desc1="";
	$_SESSION["sn"]=$sn="";
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
<script type="text/javascript">
	$(document).ready(function(){
		$("#resp1").autocomplete({
			source:"searchresp.php",
			minLength:2,
			select:function(event,ui){
				$("#resp").attr("value",ui.item.id);
			}
		});
		$("#ubic1").autocomplete({
			source:"searchdptos.php",
			minLength:2,
			select:function(event,ui){
				$("#ubic").attr("value",ui.item.id);
			}
		});
		$("#bien").autocomplete({
			source:"searchpkbien.php",
			minLength:1
		});
		$("#dir1").autocomplete({
			source:"searchdir.php",
			minLength:1,
			select:function(event,ui){
				$("#dir").attr("value",ui.item.id);
			}
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
		$("#desc1").autocomplete({
			source:"searchdesc1.php",
			minLength:2,
			select:function(event,ui){
				$("#desc").attr("value",ui.item.id);
			}
		});
		$("#estado1").autocomplete({
			source:"searchestados.php",
			minLength:2,
			select:function(event,ui){
				$("#estado").attr("value",ui.item.id);
			}
		});
	});
</script>
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
$index="viewsearchtraslados.php";
$table=" bienes b, traslados t, responsables r, ubicaciones u, tipo_traslados  tt, descripciones d, direcciones dir ";
$array=array('id_traslado','bien_id','motivo','nom_resp','des_desc','nom_depto','fec_traslado','des_tipo_tras','ultimo','filetras','fc11tras','namedir','nro_serie');
$sql1=select($table,$array);
$sql1.=" WHERE (t.bien_id=b.id_bien AND t.id_resp=r.id_resp AND r.fkubicacion=u.id_ubic AND u.fkdir=dir.pkdir AND t.id_tipo_tras=tt.id_tipo_tras AND b.id_desc = d.id_desc) ";
if($bien!=""){
	$sql1.=" AND b.id_bien = '".$bien."' ";
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
if($ubic!=""){
	$sql1.=" AND u.id_ubic = '".$ubic."' ";
}
if($dir!=""){
	$sql1.=" AND fkdir = '".$dir."' ";
}
if($resp!=""){
	$sql1.=" AND t.id_resp = '".$resp."' ";
}
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql1.=" AND cod_pat_mh = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql1.=" AND codpatnew = '".$filtro."' ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql1.=" AND nro_serie = '".$filtro."' ";
}

$res1=connector1($user,$pass,$sql1);
$rows=getNumRows($res1);
$total=ceil($rows/$pagtam);
$sql=select($table,$array);
$sql.=" WHERE (t.bien_id=b.id_bien AND t.id_resp=r.id_resp AND r.fkubicacion=u.id_ubic AND u.fkdir=dir.pkdir AND t.id_tipo_tras=tt.id_tipo_tras AND b.id_desc = d.id_desc) ";
if($bien!=""){
	$sql.=" AND b.id_bien = '".$bien."' ";
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
if($ubic!=""){
	$sql.=" AND u.id_ubic = '".$ubic."' ";
}
if($dir!=""){
	$sql.=" AND fkdir = '".$dir."' ";
}
if($resp!=""){
	$sql.=" AND t.id_resp = '".$resp."' ";
}
if($radio==1 && $filtro!="" && (int)$filtro){
	$sql.=" AND cod_pat_mh = '".$filtro."' ";
}
if($radio==2 && $filtro!="" && (int)$filtro){
	$sql.=" AND codpatnew = '".$filtro."' ";
}
if($radio==3 && $filtro!="" && $filtro){
	$sql.=" AND nro_serie = '".$filtro."' ";
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
?>
  <div id="resultado1">
  <?php
  page($res,$total,$pagtam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$upfee,$upfc11,$printfee,$printfc11,$modelo,$resp,$resp1,$ubic,$ubic1,$bien,$dir,$dir1,$cod,$codn,$marca,$marca1,$sn,$desc,$desc1);
  ?>
  </div>
</body>
</html>