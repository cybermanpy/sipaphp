<?
	session_start();
	$_SESSION = array();
	session_destroy();
?>
<script language="javascript">
	window.location.href="../";
</script>