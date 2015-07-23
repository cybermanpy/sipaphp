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
	$("#frmchange").validate({
			rules: {
				pwdre: {required: true, equalTo: "#pwdnew"}
			}
	});
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$user=$_SESSION['s_user'];
?>
<form id="frmchange" name="frmchange" method="post" onSubmit="insert('changepass.php','#frmchange');return false;">
	<table id="tablereg" class="tablereg">
    	<tr>
        	<th colspan="2">Cambiar password</th>
        </tr>
        <tr>
        	<td>User</td>
            <td><input type="hidden" name="user" id="user" value="<?=$user?>"/><?php echo $user?></td>
        </tr>
        <tr>
        	<td>Password anterior</td>
            <td><input class="required" type="password" id="pwdold" name="pwdold" /></td>
        </tr>
        <tr>
        	<td>Nuevo Password </td>
            <td><input class="required" type="password" id="pwdnew" name="pwdnew" /></td>
        </tr>
        <tr>
        	<td>Repita Password </td>
            <td><input class="required" type="password" id="pwdre" name="pwdre" /></td>
        </tr>
        <tr>
        	<td colspan="2"><input class="boton" type="submit" id="send" value="Cambiar" /></td>
        </tr>
    </table>
</form>
</body>
</html>