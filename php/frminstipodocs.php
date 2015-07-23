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
		  $('#frminstipodoc').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmuptipodoc').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewtipodocs.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminstipodoc" name="frminstipodoc" method="post" onSubmit="insert('inserttipodocs.php','#frminstipodoc');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Tipo Documento</th>
        </tr>
        <tr>
        	<td>Tipo Documento</td>
            <td><input class="required" type="text" id="tipodoc" name="tipodoc" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='tipo_documentos';
	$array=array('id_tipo_doc','des_tipo_doc');
	$sql=select($table,$array);
	$sql.=" WHERE id_tipo_doc='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmuptipodoc" name="frmuptipodoc" method="post" onSubmit="update('updatetipodocs.php','#frmuptipodoc');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Tipo Documento</th>
        </tr>
        <tr>
        	<td>Estado</td>
            <td><input class="required" type="text" id="tipodoc" name="tipodoc" value="<?= $row['des_tipo_doc']?>" /></td>
        </tr>
        
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_tipo_doc']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>