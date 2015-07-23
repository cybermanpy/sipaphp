<?php
include'session.php';
include'../includes/charset.php';
require_once'../includes/DbConnector.php';
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
	  $('#send1').click(function(){
		  $('#frminsfc10').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
$page='viewform10.php';
$grabar='viewform10.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$pk="id_resp";
$des="nom_resp";
$table="responsables";
$array=array('id_resp','nom_resp');
$if=" WHERE fkestado = 1 ";

?>
<form id="frminsfc10" name="frminsfc10" method="post" onSubmit="insert('frmviewfc10.php','#frminsfc10');return false;"  >
	<table id="tablereg" class="tablereg">
    <tr>
      <th colspan="2">Formulario FC 10</th>
    </tr>
    <tr>
      <td>Responsable</td>
      <td><select class="required" id="resp" name="resp"><?=seleif($datos,$table,$pk,$des,$if,$array)?></select></td>
    </tr>
    <tr>
      <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?=$page?>');return false;"></td>
      <td><input id="send1" class="boton" type="submit" value="Seleccionar" /></td>
    </tr>
  </table>
</form>
</body>
</html>