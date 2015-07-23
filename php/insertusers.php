<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	if ($_POST['user']!='' && $_POST['pwd']!='' ){
		$sql= "CREATE USER ".$_POST['user']." PASSWORD ".value($_POST['pwd']);
		if($_POST['super']==1){
	  		$sql .=" SUPERUSER ";
  		}
		$res=connector($user,$pass,$sql);
		?>
		<script>
			$("#resultado").empty();
			alert("Usuario creado");
		</script>
		<?php
		include($pages);
	}
?>