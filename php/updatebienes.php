<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='bienes';
$pk=$_POST['pk'];
$pkt='id_bien';
if($_POST['pk']!="" && $_POST['orgfin']!="" && $_POST['des']!="" && $_POST['marca']!="" && $_POST['prov']!="" && $_POST['est']!="" && $_POST['tipo']!="" && $_POST['serie']!="" && $_POST['fecha']!="" && $_POST['doc']!="" && $_POST['escon']!=""){
		$array1=array('tipos','cod_pat_mh','id_org_fin','cod_pat_of','id_desc','id_marca','modelo','nro_serie','caracteristicas','referencia','id_prov','fec_com','id_tipo_doc','nro_doc','prec_com','plazo_gar','obs_gar','id_estado','obs_est','id_conserv','obs_conserv','obs_bien','bien_padre','codpatnew');
		$array2=array(value($_POST['tipo']),value($_POST['codpat']),value($_POST['orgfin']),value($_POST['codfin']),value($_POST['des']),value($_POST['marca']),value($_POST['modelo']),value($_POST['serie']),value($_POST['carac']),value($_POST['ref']),value($_POST['prov']),value($_POST['fecha']),value($_POST['doc']),value($_POST['ndoc']),value($_POST['precio']),value($_POST['gar']),value($_POST['obsgar']),value($_POST['est']),value($_POST['obses']),value($_POST['escon']),value($_POST['obscon']),value($_POST['obs']),value($_POST['padre']),value($_POST['codpatnew']));
	update($array1,$table,$pk,$pkt,$array2,$user,$pass);
	?>
	<script>
		$("#resultado").empty();
		alert("Datos Actualizados");
	</script>
	<?php
	include($page);
}
?>