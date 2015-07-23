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
		  $('#frminsusers').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupusers').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewusers.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
if(!$_GET['pk']){
?>
<form id="frminsusers" name="frminsusers" method="post" onSubmit="insert('insertusers.php','#frminsusers');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Crear Usuario</th>
        </tr>
        <tr>
        	<td>User</td>
            <td><input class="required" type="text" id="user" name="user" /></td>
        </tr>
        <tr>
        	<td>Password</td>
            <td><input class="required" type="password" id="pwd" name="pwd" /></td>
        </tr>
        <tr>
        	<td>Super user</td>
            <td><input type="checkbox" id="super" name="super" value="1" /></td>
        </tr>
        <tr>
        	<td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
        	<td><input class="boton" type="submit" id="send" value="Crear" /></td>
        </tr>
    </table>
</form>
<?php
}else{
	$table='pg_shadow';
	$array=array('usename');
	$sql=select($table,$array);
	$sql.=" WHERE usename='".$_GET['pk']."' ";
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
?>
<form id="frmupusers" name="frmupusers" method="post" onSubmit="update('updatepwd.php','#frmupusers');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cambiar Password</th>
        </tr>
        <tr>
        	<td>User</td>
            <td><input type="hidden" id="user" name="user" value="<?= $row['usename']?>" /><?= $row['usename']?></td>
        </tr>
        <tr>
        	<td>Password</td>
            <td><input class="required" type="password" id="pwd" name="pwd" /></td>
        </tr>
        <tr>	
            <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
            <td><input class="boton" type="submit" id="sendup" value="Cambiar" /></td>
        </tr>
    </table>
</form>
<?php
}
?>
</body>
</html>