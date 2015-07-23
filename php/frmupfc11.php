<?php
include'session.php';
include'../includes/charset.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jqueryui.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<script type="text/javascript">
  $(document).ready(function(){
	  $('#send').click(function(){
		  $('#frmupfc11').validate()	
		  $('#frame').show();
      	  $('#form').hide();
	  });
	  $("#msgbox").hide();
	  $("#frame").hide();
	  $("#file").change(function(){
         $("#msgbox").show();
		 var msg=$("#file").attr("value");
		 $("#msgbox").html(msg);
      });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewtraslados.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table='traslados';
$array=array('id_traslado','bien_id');
$sql=select($table,$array);
$sql.=" WHERE id_traslado='".$_GET['pk']."' ";
$res=connector1($user,$pass,$sql);
$row=fetchArray($res);
?>
<div id="form">
<form id="frmupfc11" name="frmupfc11" action="insertfc11.php" method="post" enctype="multipart/form-data" target="iframeUp">
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Subir Formulario FC11</th>
        </tr>
        <tr>
        	<td>PK</td>
            <td><input type="hidden" id="pk" name="pk" value="<?= $row['id_traslado']?>" /><?= $row['id_traslado']?></td>
        </tr>
        <tr>
        	<td>Documento</td>
            <td><input class="required" type="file" id="file" name="file" /></td>
        </tr>
        <tr>
        	<td colspan="2"><div id="msgbox"></div></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <td><input class="boton" type="submit" id="send" value="Guardar" /></td>
        </tr>
    </table>
</form>
</div>
<div id="frame">
  <iframe name="iframeUp" style="border:0" width="400px" height="100px"></iframe>
</div>
</body>
</html>