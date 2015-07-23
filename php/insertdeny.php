<?php
include'session.php';
require_once'../includes/DbConnector.php';
$select=$_POST['select'];
$insert=$_POST['insert'];
$update=$_POST['update'];
$delete=$_POST['delete'];
$table=$_POST['table'];
$user=$_POST['user'];
$user1=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
for($x=0;$x<count($table);$x++){
	if($select[$x]=='select' && $insert[$x]=='insert' && $update[$x]=='update' && $delete[$x]=='delete'){
	  $sql="REVOKE ".$select[$x].",".$insert[$x].",".$update[$x].",".$delete[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif ($select[$x]=="select" && $insert[$x]=="insert" && $update[$x]=="update"){
	  $res=connector1($user1,$pass,$sql);  
	  $sql="REVOKE ".$select[$x].",".$insert[$x].",".$update[$x]." ON ".$table[$x]." FROM ".$user.";";
	}elseif($select[$x]=="select" && $insert[$x]=="insert" && $delete[$x]=="delete"){
	  $sql="REVOKE ".$select[$x].",".$insert[$x].",".$delete[$x]." ON ".$table[$x]." FROM ".$user.";";
  	  $res=connector1($user1,$pass,$sql);
	}elseif($update[$x]=="update" && $insert[$x]=="insert" && $delete[$x]=="delete"){
	  $sql="REVOKE ".$update[$x].",".$insert[$x].",".$delete[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($select[$x]=="select" && $insert[$x]=="insert"){
	  $sql= "REVOKE ".$select[$x].",".$insert[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($select[$x]=="select" && $update[$x]=="update"){
	  $sql="REVOKE ".$select[$x].",".$update[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($select[$x]=="select" && $delete[$x]=="delete"){
	  $sql="REVOKE ".$select[$x].",".$delete[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($insert[$x]=="insert" && $delete[$x]=="delete"){
	  $sql="REVOKE ".$insert[$x].",".$delete[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($insert[$x]=="insert" && $update[$x]=="update"){
	  $sql="REVOKE ".$insert[$x].",".$update[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($insert[$x]=="insert" && $update[$x]=="update"){
	  $sql="REVOKE ".$insert[$x].",".$update[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($select[$x]=="select" ){
	  $sql="REVOKE ".$select[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($insert[$x]=="insert" ){
	  $sql="REVOKE ".$insert[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($update[$x]=="update" ){
	  $sql="REVOKE ".$update[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}elseif($delte[$x]=="delete" ){
	  $sql="REVOKE ".$delete[$x]." ON ".$table[$x]." FROM ".$user.";";
	  $res=connector1($user1,$pass,$sql);
	}
}
?>
<script>
	alert("Permisos Revocados");
</script>