<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
if ($_POST['user']!='' && $_POST['pwd']!='' ){
	$sql="ALTER USER ".$_POST['user']." WITH PASSWORD ".value($_POST['pwd']);
	$res=connector1($user,$pass,$sql);
	?>
	<script>
		$("#resultado").empty();
		alert("Password Cambiado");
	</script>
	<?php
	include($page);
}
?>