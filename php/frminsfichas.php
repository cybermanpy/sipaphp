<?php
include'session.php';
include'../includes/charset.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/datatables.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jqueryui.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<link rel="stylesheet" href="../css/tableui.css" />
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<script type="text/javascript">
  $(document).ready(function(){
	  $('#send').click(function(){
		  $('#frminsficha').validate()		
	  });
	  $('#sendup').click(function(){
		  $('#frmupficha').validate()		
	  });
  });
</script>
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$page='viewbienes.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table="fichas";
$array=array('id_ficha','id_bien','proc_mar','proc_mod','proc_vel','disco_mod','disco_cap','disco_vel','mem_mod','mem_cap','mem_vel','disketera','un_optica','tarj_red','tarj_son','parlante','microfono','cerra_tipo','cerra_nro','so_marca','so_mod','so_licen','ip_add','mac_add');
$sql=select($table,$array);
$sql.=" WHERE id_bien='".$_GET['pk']."' ";
$res=connector1($user,$pass,$sql);
$rows=getNumRows($res);
$arrayproc=array('AMD','INTEL','OTROS');
$arraydvd=array('CD-R','CD-RW','CD-RW/DVD','CD-DVD RW');
$arrays=array('SI','NO');
$arrayp=array('SI','NO','Interno');
if($rows>0){
	while($row=fetchArray($res)){
	  ?>
	  <form id="frmupficha" name="frmupficha" method="post" onSubmit="update('updatefichas.php','#frmupficha');return false;">
		  <input type="hidden" id="page" name="page" value="<?= $page?>" />
		  <table id="tablereg" class="tablereg">
			  <tr>
				  <th colspan="2">Actualizar Ficha</th>
			  </tr>
			  <tr>
				  <td>PK</td>
				  <td><input type="hidden" id="pkficha" name="pkficha" value="<?= $row['id_ficha']?>" /><?= $row['id_ficha']?></td>
			  </tr>
			  <tr>
				  <td>Bien</td>
				  <td><input  type="hidden" id="pkbien" name="pkbien" value="<?= $row['id_bien']?>" /><?= $row['id_bien']?></td>
			  </tr>
			  <tr>
				  <td>Procesador</td>
				  <td><select class="required" id="procmar" name="procmar" ><?= sele1($row['proc_mar'],$arrayproc)?></select></td>
			  </tr>
			  <tr>
				  <td>Procesador Modelo</td>
				  <td><input class="required" type="text" id="procmod" name="procmod" value="<?= $row['proc_mod']?>" /></td>
			  </tr>
			  <tr>
				  <td>Procesador Velocidad</td>
				  <td><input class="required" type="text" id="procvel" name="procvel" value="<?= $row['proc_vel']?>" /></td>
			  </tr>
			  <tr>
				  <td>Disco Modelo</td>
				  <td><input class="required" type="text" id="hddmod" name="hddmod" value="<?= $row['disco_mod']?>" /></td>
			  </tr>
			  <tr>
				  <td>Disco Capacidad</td>
				  <td><input class="required" type="text" id="hddcab" name="hddcap" value="<?= $row['disco_cap']?>" /></td>
			  </tr>
			  <tr>
				  <td>Disco Velocidad</td>
				  <td><input class="required" type="text" id="hddvel" name="hddvel" value="<?= $row['disco_vel']?>" /></td>
			  </tr>
			  <tr>
				  <td>Memoria Modelo</td>
				  <td><input class="required" type="text" id="memmod" name="memmod" value="<?= $row['mem_mod']?>" /></td>
			  </tr>
			  <tr>
				  <td>Memoria Capacidad</td>
				  <td><input class="required" type="text" id="memcap" name="memcap" value="<?= $row['mem_cap']?>" /></td>
			  </tr>
			  <tr>
				  <td>Memoria Velocidad</td>
				  <td><input class="required" type="text" id="memvel" name="memvel" value="<?= $row['mem_vel']?>" /></td>
			  </tr>
              <tr>
				  <td>Floppy Disk</td>
				  <td><select class="required" id="floppy" name="floppy" ><?= sele1($row['disketera'],$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Unidad Optica</td>
				  <td><select class="required" id="dvd" name="dvd" ><?= sele1($row['un_optica'],$arraydvd)?></select></td>
			  </tr>
              <tr>
				  <td>Tarjeta de Red</td>
				  <td><input class="required" type="text" id="nic" name="nic" value="<?= $row['tarj_red']?>" /></td>
			  </tr>
              <tr>
				  <td>Tarjeta de Sonido</td>
				  <td><input class="required" type="text" id="sound" name="sound" value="<?= $row['tarj_son']?>" /></td>
			  </tr>
              <tr>
				  <td>Parlante</td>
				  <td><select class="required" id="speak" name="speak" ><?= sele1($row['parlante'],$arrayp)?></select></td>
			  </tr>
              <tr>
				  <td>Microfono</td>
				  <td><select class="required" id="mic" name="mic" ><?= sele1($row['microfono'],$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Cerradura</td>
				  <td><select class="required" id="lock" name="lock" ><?= sele1($row['cerra_tipo'],$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Nro. Cerradura</td>
				  <td><input class="required" type="text" id="nlock" name="nlock" value="<?= $row['cerra_nro']?>" /></td>
			  </tr>
              <tr>
				  <td>Sistema Operativo</td>
				  <td><input class="required" type="text" id="so" name="so" value="<?= $row['so_marca']?>" /></td>
			  </tr>
              <tr>
				  <td>Modelo S.O.</td>
				  <td><input class="required" type="text" id="somod" name="somod" value="<?= $row['so_mod']?>" /></td>
			  </tr>
              <tr>
				  <td>Licencia</td>
				  <td><input class="required" type="text" id="lic" name="lic" value="<?= $row['so_licen']?>" /></td>
			  </tr>
              <tr>
				  <td>IP</td>
				  <td><input class="required" type="text" id="ip" name="ip" value="<?= $row['ip_add']?>" /></td>
			  </tr>
              <tr>
				  <td>MAC Address</td>
				  <td><input class="required" type="text" id="mac" name="mac" value="<?= $row['mac_add']?>" /></td>
			  </tr>
			  <tr>	
				  <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
				  <input type="hidden" id="pk" name="pk" value="<?= $row['id_ficha']?>" />
				  <td><input class="boton" type="submit" id="sendup" value="Actualizar" /></td>
			  </tr>
		  </table>
	  </form>
<?php
	}
}else{
?>
<form id="frminsficha" name="frminsficha" method="post" onSubmit="insert('insertfichas.php','#frminsficha');return false;">
	<input type="hidden" id="page" name="page" value="<?= $page?>" />
		  <table id="tablereg" class="tablereg">
			  <tr>
				  <th colspan="2">Cargar Ficha</th>
			  </tr>
			  <tr>
				  <td>Bien</td>
				  <td><input type="hidden" id="pkbien" name="pkbien" value="<?= $_GET['pk'] ?>" /><?= $_GET['pk'] ?></td>
			  </tr>
			  <tr>
				  <td>Procesador</td>
				  <td><select class="required" id="procmar" name="procmar" ><?= sele1($datos,$arrayproc)?></select></td>
			  </tr>
			  <tr>
				  <td>Procesador Modelo</td>
				  <td><input class="required" type="text" id="procmod" name="procmod" /></td>
			  </tr>
			  <tr>
				  <td>Procesador Velocidad</td>
				  <td><input class="required" type="text" id="procvel" name="procvel" /></td>
			  </tr>
			  <tr>
				  <td>Disco Modelo</td>
				  <td><input class="required" type="text" id="hddmod" name="hddmod"  /></td>
			  </tr>
			  <tr>
				  <td>Disco Capacidad</td>
				  <td><input class="required" type="text" id="hddcab" name="hddcap"  /></td>
			  </tr>
			  <tr>
				  <td>Disco Velocidad</td>
				  <td><input class="required" type="text" id="hddvel" name="hddvel"  /></td>
			  </tr>
			  <tr>
				  <td>Memoria Modelo</td>
				  <td><input class="required" type="text" id="memmod" name="memmod"  /></td>
			  </tr>
			  <tr>
				  <td>Memoria Capacidad</td>
				  <td><input class="required" type="text" id="memcap" name="memcap"  /></td>
			  </tr>
			  <tr>
				  <td>Memoria Velocidad</td>
				  <td><input class="required" type="text" id="memvel" name="memvel" /></td>
			  </tr>
              <tr>
				  <td>Floppy Disk</td>
				  <td><select class="required" id="floppy" name="floppy" ><?= sele1($datos,$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Unidad Optica</td>
				  <td><select class="required" id="dvd" name="dvd" ><?= sele1($datos,$arraydvd)?></select></td>
			  </tr>
              <tr>
				  <td>Tarjeta de Red</td>
				  <td><input class="required" type="text" id="nic" name="nic"  /></td>
			  </tr>
              <tr>
				  <td>Tarjeta de Sonido</td>
				  <td><input class="required" type="text" id="sound" name="sound" /></td>
			  </tr>
              <tr>
				  <td>Parlante</td>
				  <td><select class="required" id="speak" name="speak" ><?= sele1($datos,$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Microfono</td>
				  <td><select class="required" id="mic" name="mic" ><?= sele1($datos,$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Cerradura</td>
				  <td><select class="required" id="lock" name="lock" ><?= sele1($datos,$arrays)?></select></td>
			  </tr>
              <tr>
				  <td>Nro. Cerradura</td>
				  <td><input class="required" type="text" id="nlock" name="nlock"  /></td>
			  </tr>
              <tr>
				  <td>Sistema Operativo</td>
				  <td><input class="required" type="text" id="so" name="so" /></td>
			  </tr>
              <tr>
				  <td>Modelo S.O.</td>
				  <td><input class="required" type="text" id="somod" name="somod"  /></td>
			  </tr>
              <tr>
				  <td>Licencia</td>
				  <td><input class="required" type="text" id="lic" name="lic" /></td>
			  </tr>
              <tr>
				  <td>IP</td>
				  <td><input class="required" type="text" id="ip" name="ip"  /></td>
			  </tr>
              <tr>
				  <td>MAC Address</td>
				  <td><input class="required" type="text" id="mac" name="mac"  /></td>
			  </tr>
              <tr>	
				  <td><input type="submit" id="volver" value="volver" class="boton" onClick="mostrar1('<?= $page?>');return false;"></td>
				  <td><input class="boton" type="submit" id="send" value="Insertar" /></td>
			  </tr>
       	</table>
</form>
<?php
}
?>
</body>
</html>