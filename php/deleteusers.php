<?php
include'session.php';
?>

<?php
require_once('../includes/DbConnector.php');
$use=$_GET['pk'];
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$sql= "DROP USER IF EXISTS ". $use;
$res=connector1($user,$pass,$sql);
?>
<script>
	alert("Usuario Borrados");
</script>
<?php
include'viewusers.php';
?>