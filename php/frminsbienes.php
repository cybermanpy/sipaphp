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
		  $('#frminsbien').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupbien').validate()		
	  });
	  $("#fecha").datepicker();
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewbienes.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];

//Tabla Org_fin
$tableorg="org_fin";
$pkorg="id_org_fin";
$desorg="des_org_fin";
$arrayorg=array('id_org_fin','des_org_fin');
//Tabla tipos
$tabletp="tipos";
$pktp="pktipo";
$destp="tiponame";
$arraytp=array('pktipo','tiponame');
//Tabla descripciones
$tabledes="descripciones";
$pkdes="id_desc";
$desdes="des_desc";
$arraydes=array('id_desc','des_desc');
//Tabla marcas
$tablemar="marcas";
$pkmar="id_marca";
$desmar="des_marca";
$arraymar=array('id_marca','des_marca');
//Tabla proveedor
$tableprov="proveedores";
$pkprov="id_prov";
$desprov="nom_prov";
$arrayprov=array('id_prov','nom_prov');
//Tabla tipo documentos
$tabletdoc="tipo_documentos";
$pktdoc="id_tipo_doc";
$destdoc="des_tipo_doc";
$arraytdoc=array('id_tipo_doc','des_tipo_doc');
//Tabla estados
$tablees="estados";
$pkes="id_estado";
$deses="des_estado";
$arrayes=array('id_estado','des_estado');
//Tabla conservacion
$tablecon="conservacion";
$pkcon="id_conserv";
$descon="des_conserv";
$arraycon=array('id_conserv','des_conserv');
$table="bienes";
if(!$_GET['pk']){
	$arrayb=array("MAX(id_bien) AS pk");
	$sqlb=select($table,$arrayb);
	$resb=connector1($user,$pass,$sqlb);
	$row=fetchArray($resb);
	$pkbien=$row['pk']+1;
?>
<form id="frminsbien" name="frminsbien" method="post" onSubmit="insert('insertbienes.php','#frminsbien');return false;">
    <input type="hidden" id="page" name="page" value="<?= $page?>" />    
	<table id="tablereg" class="tablereg">
        <tr>
            <td>PK</td>
            <td><input type="hidden" id="pkbien" name="pkbien" value="<?= $pkbien?>" /><?= $pkbien?></td>
            <td>Codigo Patrimonial nuevo</td>
    		<td><input type="text" id="codpatnew" name="codpatnew" /><div id="msgbox1"></div></td>
        </tr>
        <tr>
        	<td>Financiador</td>
            <td><select class="required" id="orgfin" name="orgfin"><?= sele($datos,$tableorg,$pkorg,$desorg,$arrayorg)?></select></td>
        	<td>Codigo Patrimonial</td>
    		<td><input type="text" id="codpat" name="codpat" /><div id="msgbox"></div></td>
        </tr>
        <tr>
            <td>Tipo</td>
            <td><select class="required" id="tipo" name="tipo"><?= sele($datos,$tabletp,$pktp,$destp,$arraytp)?></select></td>
            <td>Descripción</td>
            <td><select class="required" id="des" name="des"><option value="">Seleccionar</option></select></td>
        </tr>
        <tr>
        	<td>Codigo Financiador</td>
            <td><input type="text" id="codfin" name="codfin" /></td>
            <td>Marca</td>
            <td><select class="required" id="marca" name="marca"><?= sele($datos,$tablemar,$pkmar,$desmar,$arraymar)?></select></td>
        </tr>
        <tr>
        	<td>Modelo</td>
       		<td><input type="text" id="modelo" name="modelo" /></td>
        	<td>Nro. Serie</td>
        	<td><input class="required" type="text" id="serie" name="serie" /><div id="msgbox2"></div></td>
        </tr>
        <tr>
        	<td>Características</td>
            <td><textarea id="carac" name="carac" ></textarea></td>
            <td>Referencia</td>
            <td><input type="text" id="ref" name="ref" /></td>
        </tr>
        <tr>
        	<td>Proveedor</td>
            <td><select class="required" id="prov" name="prov" ><?= sele($datos,$tableprov,$pkprov,$desprov,$arrayprov);?></select></td>
            <td>Fecha</td>
            <td><input class="required" type="text" id="fecha" name="fecha" /></td>
        </tr>
        <tr>
        	<td>Documento</td>
            <td><select class="required" id="doc" name="doc" ><?= sele($datos,$tabletdoc,$pktdoc,$destdoc,$arraytdoc);?></select></td>
            <td>Nro. Documento</td>
            <td><input type="text" id="ndoc" name="ndoc" /></td>
        </tr>
        <tr>
        	<td>Precio</td>
            <td><input type="text" id="precio" name="precio" /></td>
            <td>Garantía</td>
            <td><input type="text" id="gar" name="gar" /></td>
        </tr>
        <tr>
        	<td>Observación Garantía</td>
            <td><input type="text" id="obsgar" name="obsgar" /></td>
            <td>Estado</td>
            <td><select class="required" id="est" name="est"><?php $datose=1; echo sele($datose,$tablees,$pkes,$deses,$arrayes);?></select></td>
        </tr>
        <tr>
        	<td>Observación Estado</td>
            <td><input type="text" id="obses" name="obses" /></td>
            <td>Estado Conservación</td>
            <td><select class="required" id="escon" name="escon"><?php $datosc=1; echo sele($datosc,$tablecon,$pkcon,$descon,$arraycon);?></select></td>
        </tr>
        <tr>
        	<td>Observación Conservación</td>
            <td><input type="text" id="obscon" name="obscon" /></td>
            <td>Padre</td>
            <td><input class="required" type="text" id="padre" name="padre" value="<?= $pkbien?>" /></td>
        </tr>
        <tr>
        	<td>Observaciones</td>
            <td><textarea id="obs" name="obs" ></textarea></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td colspan="3"><input type="submit" id="send" value="Insertar" class="boton" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$array=array('id_bien','tipos','cod_pat_mh','id_org_fin','cod_pat_of','id_desc','id_marca','modelo','nro_serie','caracteristicas','referencia','id_prov','fec_com','id_tipo_doc','nro_doc','prec_com','plazo_gar','obs_gar','id_estado','obs_est','id_conserv','obs_conserv','obs_bien','bien_padre','codpatnew');
	$sql=select($table,$array);
	$sql.=" WHERE id_bien='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupbien" name="frmupbien" method="post" onSubmit="update('updatebienes.php','#frmupbien');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
            <td>PK</td>
            <td><?= $row['id_bien']?></td>
            <td>Codigo Patrimonial nuevo</td>
    		<td><input type="text" id="codpatnew" name="codpatnew" value="<?= $row['codpatnew']?>" /></td>
        </tr>
        <tr>
        	<td>Financiador</td>
            <td><select class="required" id="orgfin" name="orgfin"><?= sele($row['id_org_fin'],$tableorg,$pkorg,$desorg,$arrayorg)?></select></td>
        	<td>Codigo Patrimonial</td>
    		<td><input type="text" id="codpat" name="codpat" value="<?= $row['cod_pat_mh']?>" /></td>
        </tr>
        <tr>
            <td>Tipo</td>
            <td><select class="required" id="tipo" name="tipo"><?= sele($row['tipos'],$tabletp,$pktp,$destp,$arraytp)?></select></td>
            <td>Descripción</td>
            <td><select class="required" id="des" name="des"><?= sele($row['id_desc'],$tabledes,$pkdes,$desdes,$arraydes)?></select></td>
        </tr>
        <tr>
        	<td>Codigo Financiador</td>
            <td><input type="text" id="codorgfin" name="codorgfin" value="<?= $row['cod_pat_of']?>" /></td>
            <td>Marca</td>
            <td><select class="required" id="marca" name="marca"><?= sele($row['id_marca'],$tablemar,$pkmar,$desmar,$arraymar)?></select></td>
        </tr>
        <tr>
        	<td>Modelo</td>
       		<td><input type="text" id="modelo" name="modelo" value="<?= $row['modelo']?>" /></td>
        	<td>Nro. Serie</td>
        	<td><input class="required" type="text" id="serie" name="serie" value="<?= $row['nro_serie']?>" /></div></td>
        </tr>
        <tr>
        	<td>Características</td>
            <td><textarea id="carac" name="carac" ><?= $row['caracteristicas']?></textarea></td>
            <td>Referencia</td>
            <td><input type="text" id="ref" name="ref" value="<?= $row['referencia']?>" /></td>
        </tr>
        <tr>
        	<td>Proveedor</td>
            <td><select class="required" id="prov" name="prov" ><?= sele($row['id_prov'],$tableprov,$pkprov,$desprov,$arrayprov);?></select></td>
            <td>Fecha</td>
            <td><input class="required" type="text" id="fecha" name="fecha" value="<?= $row['fec_com']?>" /></td>
        </tr>
        <tr>
        	<td>Documento</td>
            <td><select class="required" id="doc" name="doc" ><?= sele($row['id_tipo_doc'],$tabletdoc,$pktdoc,$destdoc,$arraytdoc);?></select></td>
            <td>Nro. Documento</td>
            <td><input type="text" id="ndoc" name="ndoc" value="<?= $row['nro_doc']?>"/></td>
        </tr>
        <tr>
        	<td>Precio</td>
            <td><input type="text" id="precio" name="precio" value="<?= $row['prec_com']?>" /></td>
            <td>Garantía</td>
            <td><input type="text" id="gar" name="gar" value="<?= $row['plazo_gar']?>" /></td>
        </tr>
        <tr>
        	<td>Observación Garantía</td>
            <td><input type="text" id="obsgar" name="obsgar" value="<?= $row['obs_gar']?>" /></td>
            <td>Estado</td>
            <td><select class="required" id="est" name="est"><?= sele($row['id_estado'],$tablees,$pkes,$deses,$arrayes);?></select></td>
        </tr>
        <tr>
        	<td>Observación Estado</td>
            <td><input type="text" id="obses" name="obses" value="<?= $row['obs_est']?>" /></td>
            <td>Estado Conservación</td>
            <td><select class="required" id="escon" name="escon"><?= sele($row['id_conserv'],$tablecon,$pkcon,$descon,$arraycon);?></select></td>
        </tr>
        <tr>
        	<td>Observación Conservación</td>
            <td><input type="text" id="obscon" name="obscon" value="<?= $row['obs_conserv']?>" /></td>
            <td>Padre</td>
            <td><input class="required" type="text" id="padre" name="padre" value="<?= $row['bien_padre']?>" /></td>
        </tr>
        <tr>
        	<td>Observaciones</td>
            <td><textarea id="obs" name="obs" ><?= $row['obs_bien']?></textarea></td>
            <td></td>
            <td></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_bien']?>" />
            <td colspan="3"><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>