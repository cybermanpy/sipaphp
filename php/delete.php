<?php
include'session.php';
?>

<?php
require_once('../includes/DbConnector.php');
$pk=$_POST['pk'];
$pkt=$_POST['pkt'];
$table=$_POST['table'];
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
delete($pk,$pkt,$table,$user,$pass);
?>
<script>
	$("#resultado").empty();
	alert("Datos Borrados");
</script>
<?php
include($page);
?>
