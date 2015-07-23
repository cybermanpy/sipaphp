<?php
include'session.php';
?>
<?php

require_once('../includes/DbConnector.php');
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$page=$_POST['page'];
$table='fichas';
$pk=$_POST['pk'];
$pkt='id_ficha';
if ($_POST['pkbien']!='' && $_POST['pkficha']!='' && $_POST['procmar']!='' && $_POST['procmod']!='' && $_POST['procvel']!='' && $_POST['hddmod']!='' && $_POST['hddcap']!='' && $_POST['hddvel']!='' && $_POST['memmod']!='' && $_POST['memcap']!='' && $_POST['memvel']!='' && $_POST['floppy']!='' && $_POST['dvd']!='' && $_POST['nic']!='' && $_POST['sound']!='' && $_POST['speak']!='' && $_POST['mic']!='' && $_POST['lock']!='' && $_POST['nlock']!='' && $_POST['so']!='' && $_POST['somod']!='' && $_POST['lic']!='' && $_POST['ip']!='' && $_POST['mac']!=''){
	$array1=array('id_bien','proc_mar','proc_mod','proc_vel','disco_mod','disco_cap','disco_vel','mem_mod','mem_cap','mem_vel','disketera','un_optica','tarj_red','tarj_son','parlante','microfono','cerra_tipo','cerra_nro','so_marca','so_mod','so_licen','ip_add','mac_add');
	$array2=array(value($_POST['pkbien']),value($_POST['procmar']),value($_POST['procmod']),value($_POST['procvel']),value($_POST['hddmod']),value($_POST['hddcap']),value($_POST['hddvel']),value($_POST['memmod']),value($_POST['memcap']),value($_POST['memvel']),value($_POST['floppy']),value($_POST['dvd']),value($_POST['nic']),value($_POST['sound']),value($_POST['speak']),value($_POST['mic']),value($_POST['lock']),value($_POST['nlock']),value($_POST['so']),value($_POST['somod']),value($_POST['lic']),value($_POST['ip']),value($_POST['mac']));
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
