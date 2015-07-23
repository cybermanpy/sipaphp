<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$pass=$_POST['pwdold'];
$user=$_SESSION['s_user'];
if($pass!="" && $_POST['user']!='' && $_POST['pwdnew']!='' && $_POST['pwdre']==$_POST['pwdnew'] ){
  $conn=connectorpass($user,$pass);
  if($conn){
	  $sql="ALTER USER ".$_POST['user']." WITH PASSWORD ".value($_POST['pwdnew']);
	  $res=connector1($user,$pass,$sql);
	  $_SESSION['s_pass']=$_POST['pwdnew'];
	  ?>
	  <script>
		  $("#resultado").empty();
		  alert("Password Cambiado");
	  </script>
	  <?php
  }else{
	  ?>
	  <script>
		  alert("El password anterior no es correcto");
	  </script>
	  <?php
  }
}
?>