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
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmainprint.css" />
<title>.::INVENTARIO::.</title>
</head>

<body>
<?php
require_once'../includes/DbConnector.php';
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table="traslados t, bienes b, descripciones d, marcas m, fichas f, org_fin of, proveedores p, estados e, tipo_traslados tp, responsables r, ubicaciones u, direcciones dir ";
$array=array('id_traslado','bien_id','des_desc','modelo','des_marca','nro_serie','ip_add','mac_add','cerra_tipo','des_org_fin','proc_mar','proc_mod','proc_vel','disco_mod','disco_cap','disco_vel','mem_mod','mem_cap','mem_vel','so_marca','so_mod','so_licen','disketera','tarj_red','tarj_son','parlante','microfono','obs_bien','nom_prov','tp.id_tipo_tras','des_tipo_tras','nom_resp','fec_traslado','des_ubic','nom_depto','sigladir');
$sql=select($table,$array);
$sql.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND r.id_resp=t.id_resp AND tp.id_tipo_tras=t.id_tipo_tras AND e.id_estado=b.id_estado AND p.id_prov=b.id_prov AND of.id_org_fin=b.id_org_fin AND f.id_bien=b.id_bien AND m.id_marca = b.id_marca AND t.bien_id=b.id_bien AND b.id_desc=d.id_desc AND (b.id_desc=11 OR b.id_desc=16 OR b.id_desc=25) AND id_traslado='".$_GET['pk']."' ";
$res=connector1($user,$pass,$sql);
$row=fetchArray($res);
$rows=getNumRows($res);
if($rows>0){
?>
<table id="head">
	<tr>
    	<td colspan="4"><div id="banner"><br><img id="imgbanner" src="../img/logo1.jpg" />SISTEMA PATRIMONIAL (SIPA)<br> SUB SECRETARÍA DE ECONOMÍA</div></td>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table id="title">
    <tr>
        <th colspan="4">FORMULARIO ENTREGA DE EQUIPOS</th>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table id="body">
    <tr>
        <td colspan="4">Nro. Movimiento: <?= $row['id_traslado']?></td>
    </tr>
    <tr>
    	<th><?= $row['des_desc']?></th>
        <th>Nro. Bien: <?= $row['bien_id']?></th>
        <th colspan="2">CARACTERÍSTICAS</th>
    </tr>
    <tr>
        <td colspan="2">MARCA: <?= $row['des_marca']?></td>
        <td colspan="2">PROCESASOR: <?= $row['proc_mar']." ".$row['proc_mod']." ".$row['proc_vel']?></td>
    </tr>
    <tr>
    	<td colspan="2">MODELO: <?= $row['modelo'] ?></td>
        <td colspan="2">HDD: <?= $row['disco_mod']." ".$row['disco_cap']." ".$row['disco_vel']?></td>
    </tr>
    <tr>
    	<td colspan="2">Nro. Serie: <?= $row['nro_serie']?></td>
        <td colspan="2">RAM: <?= $row['mem_mod']." ".$row['mem_cap']." ".$row['mem_vel']?></td>
    </tr>    
    <tr>
    	<td colspan="2">IP ADDRESS: <?= $row['ip_add']?></td>
        <td colspan="2">S.O: <?= $row['so_marca']." ".$row['so_mod']." ".$row['so_licen']?></td>
    </tr>
    <tr>
    	<td colspan="2">MAC ADDRESS: <?= $row['mac_add']?></td>
        <td colspan="2">FLOPPY: <?= $row['disketera']?></td>
    </tr>
    <tr>
    	<td colspan="2">CANDADO: <?= $row['cerra_tipo']?></td>
        <td colspan="2">NIC: <?= $row['tarj_red']?></td>
    </tr>
    <tr>
    	<td colspan="2">ORGANISMO FINANCIADOR: <?= $row['des_org_fin']?></td>
        <td colspan="2">SOUND: <?= $row['tarj_son']?></td>
    </tr>
    <tr>
    	<td colspan="2">CÓDIGO PATRIMONIAL: <?= $row['cod_pat_mh']?></td>
        <td colspan="2">PARLANTE / MICROFONO: <?= $row['parlante']."/".$row['microfono']?></td>
    </tr>
    <tr>
    	<td colspan="2">CÓDIGO PATRIMONIAL: <?= $row['codpatnew']?></td>
        <td colspan="2">OBSERVACIONES: <?= $row['obs_bien']?></td>
    </tr>
    
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
    <?php
		$tablepart=" bienes b, descripciones d, marcas m, org_fin of ";
		$arraypart=array('id_bien','des_desc','modelo','nro_serie','des_marca','caracteristicas','modelo','nro_serie','des_org_fin','cod_pat_mh','codpatnew');
		$sqlpart=select($tablepart,$arraypart);
		$sqlpart.=" WHERE of.id_org_fin=b.id_org_fin  AND b.id_marca = m.id_marca AND d.id_desc = b.id_desc AND d.id_desc <> 11 AND d.id_desc <> 25 AND d.id_desc <> 16 AND bien_padre ='".$row['bien_id']."' ORDER BY b.id_desc ";
		$respart=connector1($user,$pass,$sqlpart);
		while($rowpart=fetchArray($respart)){
			?>
            	<tr>
                	<th><?= $rowpart['des_desc']?></th>
                    <th>Nro. Bien: <?= $rowpart['id_bien']?></th>
                    <th colspan="2">CARACTERÍSTICAS</th>
                </tr>
                <tr>
                	<td colspan="2">MARCA: <?= $rowpart['des_marca']?></td>
                	<td colspan="2"><?= $rowpart['caracteristicas']?></td>
                </tr>
                <tr>
                	<td colspan="2">MODELO: <?= $rowpart['modelo']?></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                	<td colspan="2">NRO. SERIE: <?= $rowpart['nro_serie']?></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                	<td colspan="2">FINANCIADOR: <?= $rowpart['des_org_fin']?></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                	<td colspan="2">CÓDIGO PATRIMONIAL: <?= $rowpart['cod_pat_mh']?></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                	<td colspan="2">CÓDIGO PATRIMONIAL: <?= $rowpart['codpatnew']?></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                	<td colspan="4">&nbsp;</td>
                </tr>
            <?php
		}
	?>
    <tr>
    	<td colspan="4">PROVEÍDO POR: <?= $row['nom_prov']?></td>
    </tr>
    <tr>
    	<td colspan="4">TIPO: <?= $row['des_tipo_tras']?></td>
    </tr>
</table>
<table id="obs1">
	<tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4">Observación: El receptor del equipo es responsable de la buena manutención del mismo y deberá informar por escrito cualquier anormalidad del equipo entregado. La instalación, configuración y traslado de los equipos queda a cargo y coordinación del Departamento Administrativo y el Departamento de Informática de la Subsecretaría de Estado de Economía. </td>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table id="foot">
    <tr>
    	<th colspan="4">ENTREGADO POR</th>
    </tr>
    <tr>
    	<td colspan="2">Fecha: <?= $row['fec_traslado']?></td>
        <td colspan="2">Interno:</td>
    </tr>
    <?php
		$tablet="traslados";
		$arrayt=array('MAX(id_traslado) AS pkmax');
		$sqlt=select($tablet,$arrayt);
		$sqlt.=" WHERE bien_id='".$row['bien_id']."' AND ultimo='no'";
		$rest=connector1($user,$pass,$sqlt);
		$rowt=fetchArray($rest);
		$pkant=$rowt['pkmax'];
		
		if($pkant!=""){
			$tableresp="traslados t, responsables r, ubicaciones u, direcciones dir ";
			$arrayresp=array('nom_resp','nom_depto','sigladir');
			$sqlresp=select($tableresp,$arrayresp);
			$sqlresp.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND t.id_resp=r.id_resp AND t.id_traslado='".$pkant."'";
			$resresp=connector1($user,$pass,$sqlresp);
			$rowresp=fetchArray($resresp);
			$rowsresp=getNumRows($resresp);
			?>
            <tr>
			    <td colspan="2">Departamento: <?= $rowresp['sigladir']."-".$rowresp['nom_depto']?></td>
	        	<td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Responsable Anterior: <?= $rowresp['nom_resp']?></td>        
        		<td colspan="2"></td>
    		</tr>
            <?php
		}else{
			?>
            <tr>
			    <td colspan="2">Departamento:</td>
	        	<td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Responsable Anterior: </td>        
        		<td colspan="2"></td>
    		</tr>
            <?php
		}
		?>
    <tr>
    	<th colspan="4">RECIBIDO POR</th>
    </tr>
    <tr>
    	<td colspan="2">Fecha: <?= $row['fec_traslado']?></td>
        <td colspan="2">Interno:</td>
    </tr>
    <tr>
    	<td colspan="2">Departamento: <?= $row['sigladir']."-".$row['nom_depto']?> </td>
        <td colspan="2"></td>
    </tr>
    <tr>	
    	<td colspan="2">Firma: <br><br><br></td>
        <td colspan="2">Aclaración de Firma: <?= $row['nom_resp']?></td>
    </tr>
</table>
<?php

/*IMPRESIÓN DE OTROS EQUIPOS DE COMPUTACIÓN */

}else{
	$table1="traslados t, bienes b, descripciones d, marcas m, org_fin of, proveedores p, estados e, tipo_traslados tp, responsables r, ubicaciones u, direcciones dir ";
	$array1=array('id_traslado','bien_id','des_desc','modelo','des_marca','nro_serie','obs_bien','nom_prov','tp.id_tipo_tras','des_tipo_tras','nom_resp','fec_traslado','des_ubic','caracteristicas','nom_depto','sigladir');
	$sql1=select($table,$array1);
	$sql1.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND r.id_resp=t.id_resp AND tp.id_tipo_tras=t.id_tipo_tras AND e.id_estado=b.id_estado AND p.id_prov=b.id_prov AND of.id_org_fin=b.id_org_fin AND m.id_marca = b.id_marca AND t.bien_id=b.id_bien AND b.id_desc=d.id_desc AND id_traslado='".$_GET['pk']."' ";
	$res1=connector1($user,$pass,$sql1);
	$row1=fetchArray($res1);
?>
<table id="head">
	<tr>
    	<td colspan="4"><div id="banner"><br><img id="imgbanner" src="../img/logo1.jpg" />SISTEMA PATRIMONIAL (SIPA)<br> SUB SECRETARÍA DE ECONOMÍA</div></td>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table id="title">
    <tr>
        <th colspan="4">FORMULARIO ENTREGA DE EQUIPOS</th>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table id="body">
    <tr>
        <td colspan="4">Nro. Movimiento: <?= $row1['id_traslado']?></td>
    </tr>
    <tr>
    	<th><?= $row1['des_desc']?></th>
        <th>Nro. Bien: <?= $row1['bien_id']?></th>
        <th colspan="2">CARACTERÍSTICAS</th>
    </tr>
    <tr>
        <td colspan="2">MARCA: <?= $row1['des_marca']?></td>
        <td colspan="2"><? echo $row1['caracteristicas']?></td>
    </tr>
    <tr>
    	<td colspan="2">MODELO: <?= $row1['modelo'] ?></td>
        <td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2">Nro. Serie: <?= $row1['nro_serie']?></td>
        <td colspan="2"></td>
    </tr>    
    
    <tr>
    	<td colspan="2">ORGANISMO FINANCIADOR: <?= $row1['des_org_fin']?></td>
		<td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2">CÓDIGO PATRIMONIAL: <?= $row1['cod_pat_mh']?></td>
        <td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2">CÓDIGO PATRIMONIAL: <?= $row1['codpatnew']?></td>
        <td colspan="2">OBSERVACIONES: <?= $row1['obs_bien']?></td>
    </tr>
    <tr>
    	<td colspan="4">PROVEÍDO POR: <?= $row1['nom_prov']?></td>
    </tr>
    <tr>
    	<td colspan="4">TIPO: <?= $row1['des_tipo_tras']?></td>
    </tr>
</table>
<table id="obs1">
	<tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4">Observación: El receptor del equipo es responsable de la buena manutención del mismo y deberá informar por escrito cualquier anormalidad del equipo entregado. La instalación, configuración y traslado de los equipos queda a cargo y coordinación del Departamento Administrativo y el Departamento de Informática de la Subsecretaría de Estado de Economía. </td>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table id="foot">
    <tr>
    	<th colspan="4">ENTREGADO POR</th>
    </tr>
    <tr>
    	<td colspan="2">Fecha: <?= $row1['fec_traslado']?></td>
        <td colspan="2">Interno:</td>
    </tr>
    <?php
		$tablet="traslados";
		$arrayt=array('MAX(id_traslado) AS pkmax');
		$sqlt=select($tablet,$arrayt);
		$sqlt.=" WHERE bien_id='".$row1['bien_id']."' AND ultimo='no'";
		$rest=connector1($user,$pass,$sqlt);
		$rowt=fetchArray($rest);
		$pkant=$rowt['pkmax'];
		
		if($pkant!=""){
			$tableresp="traslados t, responsables r, ubicaciones u, direcciones dir";
			$arrayresp=array('nom_resp','nom_depto','sigladir');
			$sqlresp=select($tableresp,$arrayresp);
			$sqlresp.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND t.id_resp=r.id_resp AND t.id_traslado='".$pkant."'";
			$resresp=connector1($user,$pass,$sqlresp);
			$rowresp=fetchArray($resresp);
			$rowsresp=getNumRows($resresp);
			?>
            <tr>
            	<td colspan="2">Departamento: <?= $rowresp['sigladir']."-".$rowresp['nom_depto']?></td>
		        <td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Responsable Anterior: <?= $rowresp['nom_resp']?></td>        
        		<td colspan="2"></td>
    		</tr>
            <?php
		}else{
			?>
            <tr>
            	<td colspan="2">Departamento:</td>
		        <td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Responsable Anterior: </td>        
        		<td colspan="2"></td>
    		</tr>
            <?php
		}
		?>
    <tr>
    	<th colspan="4">RECIBIDO POR</th>
    </tr>
    <tr>
    	<td colspan="2">Fecha: <?= $row1['fec_traslado']?></td>
        <td colspan="2">Interno:</td>
    </tr>
    <tr>
    	<td colspan="2">Departamento: <?= $row1['sigladir']."-".$row1['nom_depto']?></td>
        <td colspan="2"></td>
    </tr>
    <tr>	
    	<td colspan="2">Firma: <br><br><br></td>
        <td colspan="2">Aclaración de Firma: <?= $row1['nom_resp']?></td>
    </tr>
</table>
<?php	
}
?>
</body>
</html>