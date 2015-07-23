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
<link rel="stylesheet" href="../css/tableui.css" />
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<script type="text/javascript">
  $(document).ready(function(){
	  $('#send').click(function(){
		  $('#frminsresp').validate({
			  rules:{
				  cedula:{
					  required:true,
					  number:true
				  }
			  }
		  })		
	  });
	  $('#sendup').click(function(){
		  $('#frmupresp').validate({
			  rules:{
				  cedula:{
					  required:true,
					  number:true
				  }
			  }
		  })		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewresponsables.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$pke="id_estado";
$dese="des_estado";
$tablee="estados";
$arraye=array('id_estado','des_estado');
#Table Cargos
$pkc="pkcargo";
$desc="descargo";
$tablec="cargos";
$arrayc=array('pkcargo','descargo');
#Table ubicaciones
$pku="id_ubic";
$desu="nom_depto";
#$desu="des_ubic";
$tableu="ubicaciones";
$arrayu=array('id_ubic','nom_depto');
#$arrayu=array('id_ubic','des_ubic');
#Table Direcciones
$tabledir="direcciones";
$pkdir="pkdir";
$desdir="sigladir";
$arraydir=array("pkdir",'sigladir');


if(!$_GET['pk']){
?>
<form id="frminsresp" name="frminsresp" method="post" onSubmit="insert('insertresponsables.php','#frminsresp');return false;">
	<input type="hidden" id="page" name="page" value="<?=$page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Responsable</th>
        </tr>
        <tr>
        	<td>Nombre</td>
            <td><input class="required" type="text" id="name" name="name" /></td>
        </tr>
        <tr>
        	<td>Cedula</td>
            <td><input class="required" type="text" id="cedula" name="cedula" /><div id="msgbox2"></div></td>
        </tr>
      	<tr>
        	<td>Cargo</td>
            <td><select class="required" id="cargo" name="cargo"><?= sele($datos,$tablec,$pkc,$desc,$arrayc) ?></select></td>
        </tr>
        <tr>
        	<td>Direcciones</td>
            <td><select class="required" id="dir" name="dir"><?= sele($datos,$tabledir,$pkdir,$desdir,$arraydir) ?></select></td>
        </tr>
        <tr>
        	<td>Departamento</td>
            <td><select class="required" id="ubic" name="ubic"><option value="">Seleccionar</option></select></td>
        </tr>
        <tr>
        	<td>Estado</td>
            <td><select class="required" id="estado" name="estado"><?= sele($datos,$tablee,$pke,$dese,$arraye) ?></select></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?=$page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='responsables r, ubicaciones u, direcciones d';
	$array=array('id_resp','nom_resp','fkcargo','fkestado','fkubicacion','fkdir','cedula');
	$sql=select($table,$array);
	$sql.=" WHERE r.fkubicacion=u.id_ubic AND u.fkdir=d.pkdir AND id_resp='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	#Table ubicaciones
	$pkdpto="id_ubic";
	$desdpto="nom_depto";
	$tabledpto="ubicaciones u, direcciones d ";
	$arraydpto=array('id_ubic','nom_depto');
	$ifdpto=" WHERE u.fkdir=d.pkdir AND u.fkdir=".$row['fkdir']." ";
?>
<form id="frmupresp" name="frmupresp" method="post" onSubmit="update('updateresponsables.php','#frmupresp');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Responsable</th>
        </tr>
        <tr>
        	<td>Nombre</td>
            <td><input class="required" type="text" id="tipo" name="name" value="<?= $row['nom_resp']?>" /></td>
        </tr>
        <tr>
        	<td>Cedula</td>
            <td><input class="required" type="text" id="cedula" name="cedula" value="<?= $row['cedula']?>" /><div id="msgbox2"></div></td>
        </tr>
        <tr>
        	<td>Cargo</td>
            <td><select class="required" id="cargo" name="cargo"><?= sele($row['fkcargo'],$tablec,$pkc,$desc,$arrayc) ?></select></td>
        </tr>
        <tr>
        	<td>Direcciones</td>
            <td><select class="required" id="dir" name="dir"><?= sele($row['fkdir'],$tabledir,$pkdir,$desdir,$arraydir) ?></select></td>
        </tr>
        <tr>
        	<td>Departamento</td>
            <td><select class="required" id="ubic" name="ubic"><?= seleif($row['fkubicacion'],$tabledpto,$pkdpto,$desdpto,$ifdpto,$arraydpto) ?></select></td>
        </tr>
        <tr>
        	<td>Estado</td>
            <td><select class="required" id="estado" name="estado"><?= sele($row['fkestado'],$tablee,$pke,$dese,$arraye) ?></select></td>
        </tr>
        <tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?=$page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_resp']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>