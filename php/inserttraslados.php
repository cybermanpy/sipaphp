<?php
include'session.php';
?>
<?php
	require_once'../includes/DbConnector.php';
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];
	$pages=$_POST['page'];
	$table='traslados';
	$arraydir=array('MAX(id_traslado) AS pk');
	$sql=select($table,$arraydir);
	$res=connector1($user,$pass,$sql);
	$row=fetchArray($res);
	$pk=$row['pk']+1;
	
	$arraytras=array('MAX(id_traslado) AS pktrasmax');
	$sqltras=select($table,$arraytras);
	$sqltras.=" WHERE bien_id ='".$_POST['pkbien']."'";
	$restras=connector1($user,$pass,$sqltras);
	$rowtras=fetchArray($restras);
	$maxpktras=$rowtras['pktrasmax'];
	
	if ($_POST['pkbien']!='' && $_POST['res']!='' /*&& $_POST['ubic']!=''*/ && $_POST['tipo']!='' && $_POST['motivo']!='' ){
		$array1=array('id_traslado','bien_id','motivo','id_resp'/*,'id_ubic'*/,'fec_traslado','id_tipo_tras');
		$array2=array(value($pk),value($_POST['pkbien']),value($_POST['motivo']),value($_POST['res']),/*value($_POST['ubic']),*/'now()',value($_POST['tipo']));
		insert($array1,$table,$array2,$user,$pass);
		
		$arrayup1=array('ultimo');
		$arrayup2=array(value("no"));
		$pkt="id_traslado";
		update($arrayup1,$table,$maxpktras,$pkt,$arrayup2,$user,$pass);
		?>
		<script>
			$("#resultado").empty();
			alert("Datos Insertados");
		</script>
		<?php
		include($pages);
	}
?>