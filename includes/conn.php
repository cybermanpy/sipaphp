<?php
session_start();
require_once'DbConnector.php';
$user=$_POST['user'];
$pass=$_POST['pass'];
$conn=connectorpass($user,$pass);
if($conn){
  $_SESSION["s_user"] = $user;
  $_SESSION["s_pass"] = $pass;
  /*$sql="SELECT usename,usesuper FROM pg_shadow WHERE usename='".$user."'";
  $res=pg_query($conn,$sql);
  $row=pg_fetch_array($res);
  $_SESSION['s_superuser']=$row['usesuper'];*/
  ?>
 	<script language="javascript">
		window.location.href="php/";
	</script>
  <?php
  pg_close($conn);
}else{
  ?>
	<script language="javascript">
	  $(document).ready(function(){
	    $("#box").effect("shake");
	  });
	  //alert("Usuario o password incorrecto");
	  //window.location.href="../login";
	</script> 
  <?php
}	
?>

<?php
/*session_start();
require_once'DbConnector.php';
$user=$_POST['user'];
$pass=$_POST['pass'];
$conn=connectorpass($user,$pass);
if(!$conn){
?>
		<script language="javascript">
		alert("Usuario o password incorrecto");
		window.location.href="../login";
		</script> 
<?
	}
		$_SESSION["s_username"] = $user;
		$_SESSION["s_pass"] = $pass;
?>
	<script language="javascript">
		window.location.href="../php/";
	</script>

<?
pg_close($conn);*/
/***************************************************/
?>
<?
/*session_start();
require_once'DbConnector.php';
$user=$_POST['user'];
$pass=$_POST['pass'];
$conn=connectorpass($user,$pass);
if(!$conn){
?>
		<script language="javascript">
		alert("Usuario o password incorrecto");
		window.location.href="../login";
		</script> 
<?
	}
		$_SESSION["s_username"] = $user;
		$_SESSION["s_pass"] = $pass;
?>
	<script language="javascript">
		window.location.href="../php/";
	</script>

<?
mysql_close($conn);*/
?>
