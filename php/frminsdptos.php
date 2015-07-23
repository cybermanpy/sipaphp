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
		  $('#frminsdpto').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupdpto').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewdptos.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$pkd="pkdir";
$desd="sigladir";
$tabled="direcciones";
$arraydir=array('pkdir','sigladir');

if(!$_GET['pk']){
?>
<form id="frminsdpto" name="frminsdpto" method="post" onSubmit="insert('insertdptos.php','#frminsdpto');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cargar Departamento</th>
        </tr>
        <tr>
        	<td>Departamento</td>
            <td><input class="required" type="text" id="dpto" name="dpto" /></td>
        </tr>
        <tr>
        	<td>Sigla</td>
            <td><input class="required" type="text" id="sigla" name="sigla" /></td>
        </tr>
        <tr>
        	<td>Número</td>
            <td><input class="required" type="text" id="num" name="num" /></td>
        </tr>
        <?php
		?>
        <tr>
        	<td>Dirección</td>
            <td><select class="required" id="dir" name="dir"><?= sele($datos,$tabled,$pkd,$desd,$arraydir) ?></select></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Insertar" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='ubicaciones';
	$array=array('id_ubic','des_ubic','nom_depto','num_depto','fkdir');
	$sql=select($table,$array);
	$sql.=" WHERE id_ubic='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupdpto" name="frmupdpto" method="post" onSubmit="update('updatedptos.php','#frmupdpto');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Actualizar Departamento</th>
        </tr>
        <tr>
        	<td>Departamento</td>
            <td><input class="required" type="text" id="dpto" name="dpto" value="<?= $row['nom_depto']?>" /></td>
        </tr>
        <tr>
        	<td>Sigla</td>
            <td><input class="required" type="text" id="sigla" name="sigla" value="<?= $row['des_ubic']?>" /></td>
        </tr>
        <tr>
        	<td>Numero</td>
            <td><input class="required" type="text" id="num" name="num" value="<?= $row['num_depto']?>" /></td>
        </tr>
        <tr>
        	<td>Dirección</td>
            <td><select class="required" id="dir" name="dir"><?= sele($row['fkdir'],$tabled,$pkd,$desd,$arraydir) ?></select></td>
        </tr>
        <tr>
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <input type="hidden" id="pk" name="pk" value="<?= $row['id_ubic']?>" />
            <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>