<?php
include'session.php';
require_once('../includes/DbConnector.php');
$fkform=$_POST['fkform'];
$fkformt=$_POST['fkformt'];
$fkbien=$_POST['fkbien'];
$fkbient=$_POST['fkbient'];
$table=$_POST['table'];
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
deletef($fkform,$fkformt,$fkbien,$fkbient,$table,$user,$pass);
?>
<script>
	$("#resultado").empty();
	alert("Datos Borrados");
</script>
<?php
include($page);
?>