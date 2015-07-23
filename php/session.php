<?php
session_start();
if (!isset($_SESSION['s_user'])){ 
?>
    <script>
		alert("Debe iniciar session");
		window.location.href="../";
	</script>
<?php
	exit;
}
?>