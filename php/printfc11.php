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
$array=array('id_traslado','bien_id','des_desc','modelo','des_marca','nro_serie','ip_add','mac_add','cerra_tipo','des_org_fin','proc_mar','proc_mod','proc_vel','disco_mod','disco_cap','disco_vel','mem_mod','mem_cap','mem_vel','so_marca','so_mod','so_licen','disketera','tarj_red','tarj_son','parlante','microfono','obs_bien','nom_prov','tp.id_tipo_tras','des_tipo_tras','nom_resp','fec_traslado','des_ubic','motivo','cod_pat_mh','codpatnew','nom_depto','sigladir');
$sql=select($table,$array);
$sql.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND r.id_resp=t.id_resp AND tp.id_tipo_tras=t.id_tipo_tras AND e.id_estado=b.id_estado AND p.id_prov=b.id_prov AND of.id_org_fin=b.id_org_fin AND f.id_bien=b.id_bien AND m.id_marca = b.id_marca AND t.bien_id=b.id_bien AND b.id_desc=d.id_desc AND (b.id_desc=11 OR b.id_desc=16 OR b.id_desc=25) AND id_traslado='".$_GET['pk']."' ";
$res=connector1($user,$pass,$sql);
$row=fetchArray($res);
$rows=getNumRows($res);
if($rows>0){
?>
<table id="head">
	<tr>
    	<td colspan="8"><div id="banner"><br><img id="imgbanner" src="../img/logo1.jpg" />SISTEMA PATRIMONIAL (SIPA)<br> SUB SECRETARÍA DE ECONOMÍA</div></td>
    </tr>
    <tr>
    	<td colspan="8">&nbsp;</td>
    </tr>
</table>
<table id="title">
    <tr>
        <th colspan="8">FORMULARIO DE RECEPCIÓN O SALIDA DE BIENES</th>
    </tr>
    <tr>
    	<td colspan="8">&nbsp;</td>
    </tr>
</table>
<table id="body">
    <tr>
        <td colspan="8">Nro. Movimiento: <?= $row['id_traslado']?></td>
    </tr>
    <tr>
    	<th>N°</th>
    	<th>DETALLES</th>
        <th>MARCA</th>
        <th>NRO. SERIE</th>
        <th>Cod Patrimonial</th>
        <th>Cod Patrimonial</th>
        <th>Características</th>
        <th>Motivo</th>
    </tr>
    <tr>
    	<td><?= $row['bien_id']?></td>
    	<td><?= $row['des_desc']." ".$row['modelo']?></td>
        <td><?= $row['des_marca']?></td>
        <td><?= $row['nro_serie']?></td>
        <td><?= $row['cod_pat_mh']?></td>
        <td><?= $row['codpatnew']?></td>
        <td><?= $row['proc_mar']." ".$row['proc_mod']." ".$row['proc_vel']." HDD: ".$row['disco_cap']." ".$row['disco_vel']." Memoria: ".$row['mem_mod']." ".$row['mem_cap']." ".$row['mem_vel']?></td>
        <td><?= $row['motivo']?></td>
    </tr>
    <?php
		$tablepart=" bienes b, descripciones d, marcas m, org_fin of ";
		$arraypart=array('id_bien','des_desc','modelo','nro_serie','des_marca','caracteristicas','modelo','nro_serie','des_org_fin','cod_pat_mh','codpatnew');
		$sqlpart=select($tablepart,$arraypart);
		$sqlpart.=" WHERE of.id_org_fin=b.id_org_fin  AND b.id_marca = m.id_marca AND d.id_desc = b.id_desc AND b.id_bien<>'".$row['bien_id']."' AND bien_padre ='".$row['bien_id']."' ORDER BY b.id_desc ";
		$respart=connector1($user,$pass,$sqlpart);
		while($rowpart=fetchArray($respart)){
			?>
            	<tr>
                	<td><?= $rowpart['id_bien']?></td>
                	<td><?= $rowpart['des_desc']." ".$rowpart['modelo']?></td>
                    <td><?= $rowpart['des_marca']?></td>
                    <td><?= $rowpart['nro_serie']?></td>
                    <td><?= $rowpart['cod_pat_mh']?></td>
                    <td><?= $rowpart['codpatnew']?></td>
                    <td><?= $rowpart['caracteristicas']?></td>
                    <td></td>
                </tr>
            <?php
		}
	?>
</table>
<br>
<br>
<br>
<table id="printfee1">
    <tr>
    	<td colspan="8">Fecha: <?= $row['fec_traslado']?></td>
    </tr>
   	<tr>
   		<td colspan="8">Por la presente se autoriza a trasladar el(los) equipo(s) mencionados anteriormente, ubicados en la Dirección/Departamento SSEE</td>
   	</tr>
    <tr>
    	<td colspan="8">&nbsp;</td>
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
			    <td colspan="2"><span class="negrita">EMISOR: </span></td>
                <td colspan="2"><input class="textprint" type="text" value="<?= $rowresp['sigladir']."-".$rowresp['nom_depto']?>" /></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Firma Funcionario: </td>        
                <td colspan="2"><input type="text" value="" /></td>
        		<td colspan="2">Aclaración de firma:</td>
                <td colspan="2"><input type="text" value="<?= $rowresp['nom_resp']?>" /></td>
    		</tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="2">V°B° Director: </td>
                <td colspan="2"><input type="text" /></td>
                <td colspan="2">Aclaración de firma</td>
                <td colspan="2"><input type="text" /></td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <?php
		}else{
			?>
            <tr>
			    <td colspan="2"><span class="negrita">EMISOR:</span> </td>
                <td colspan="2"><input class="textprint" type="text" /></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Firma Funcionario: </td>        
                <td colspan="2"><input type="text" value="" /></td>
        		<td colspan="2">Aclaración de firma:</td>
                <td colspan="2"><input type="text" /></td>
    		</tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="2">V°B° Director: </td>
                <td colspan="2"><input type="text" /></td>
                <td colspan="2">Aclaración de firma</td>
                <td colspan="2"><input type="text" /></td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <?php
		}
		?>
    <tr>
    	<td colspan="2"><span class="negrita">RECEPTOR:</span></td>
        <td colspan="2"><input class="textprint" type="text" value="<?= $row['sigladir']."-".$row['nom_depto']?>" /></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2">Firma de Funcionario:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" value="<?= $row['nom_resp']?>" /></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">V°B° Director:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">V°B° Jefe Administrativo:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">Funcionario de Patrimonio SSEE:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">Personal de Seguridad:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
    	<td colspan="2">Fecha y hora de salida</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">Personal de Seguridad:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
    	<td colspan="2">Fecha y hora de entrada</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr align="center">
    <?
	$tabletipo="tipo_traslados";
	$arraytipo=array('id_tipo_tras','des_tipo_tras');
	$sqltipo=select($tabletipo,$arraytipo);
	$sqltipo.=" WHERE id_tipo_tras <> 1 AND id_tipo_tras <> 4 AND id_tipo_tras <> 41 AND id_tipo_tras <> 39";
	$restipo=connector1($user,$pass,$sqltipo);
	echo"<td colspan='8'>";
	while($rowtipo=fetchArray($restipo)){
		if($rowtipo['id_tipo_tras']==$row['id_tipo_tras']){
			echo '<span class="negrita">'.$rowtipo['des_tipo_tras'].'</span><input type="checkbox" name="checkbox" value="checkbox" checked>';
		}else{
			echo $rowtipo['des_tipo_tras'].'<input type="checkbox" name="checkbox" value="checkbox">';
		}
	}
	echo"</td>";
	?>
    </tr>
</table>
<?php

/*IMPRESIÓN DE OTROS EQUIPOS DE COMPUTACIÓN */

}else{
	$table1="traslados t, bienes b, descripciones d, marcas m, org_fin of, proveedores p, estados e, tipo_traslados tp, responsables r, ubicaciones u, direcciones dir ";
	$array1=array('id_traslado','bien_id','des_desc','modelo','des_marca','nro_serie','obs_bien','nom_prov','tp.id_tipo_tras','des_tipo_tras','nom_resp','fec_traslado','des_ubic','caracteristicas','motivo','cod_pat_mh','codpatnew','nom_depto','sigladir');
	$sql1=select($table,$array1);
	$sql1.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND r.id_resp=t.id_resp AND tp.id_tipo_tras=t.id_tipo_tras AND e.id_estado=b.id_estado AND p.id_prov=b.id_prov AND of.id_org_fin=b.id_org_fin AND m.id_marca = b.id_marca AND t.bien_id=b.id_bien AND b.id_desc=d.id_desc AND id_traslado='".$_GET['pk']."' ";
	$res1=connector1($user,$pass,$sql1);
	$row1=fetchArray($res1);
?>
<table id="head">
	<tr>
    	<td colspan="8"><div id="banner"><br><img id="imgbanner" src="../img/logo1.jpg" />SISTEMA PATRIMONIAL (SIPA)<br> SUB SECRETARÍA DE ECONOMÍA</div></td>
    </tr>
    <tr>
    	<td colspan="8">&nbsp;</td>
    </tr>
</table>
<table id="title">
    <tr>
        <th colspan="8">FORMULARIO DE RECEPCIÓN O SALIDA DE BIENES</th>
    </tr>
    <tr>
    	<td colspan="8">&nbsp;</td>
    </tr>
</table>
<table id="body">    
    <tr>
        <td colspan="8">Nro. Movimiento: <?= $row1['id_traslado']?></td>
    </tr>
    <tr>
    	<th>N°</th>
    	<th>DETALLES</th>
        <th>MARCA</th>
        <th>NRO. SERIE</th>
        <th>Cod Patrimonial</th>
        <th>Cod Patrimonial</th>
        <th>Características</th>
        <th>Motivo</th>
    </tr>
    <tr>
    	<td><?= $row1['bien_id']?></td>
    	<td><?= $row1['des_desc']." ".$row1['modelo']?></td>
        <td><?= $row1['des_marca']?></td>
        <td><?= $row1['nro_serie']?></td>
        <td><?= $row1['cod_pat_mh']?></td>
        <td><?= $row1['codpatnew']?></td>
        <td><?= $row1['caracteristicas']?></td>
        <td><?= $row1['motivo']?></td>
    </tr>
    <?php
		$tablepart1=" bienes b, descripciones d, marcas m, org_fin of ";
		$arraypart1=array('id_bien','des_desc','modelo','nro_serie','des_marca','caracteristicas','modelo','nro_serie','des_org_fin','cod_pat_mh','codpatnew');
		$sqlpart1=select($tablepart1,$arraypart1);
		$sqlpart1.=" WHERE id_bien<>".$row1['bien_id']." AND of.id_org_fin=b.id_org_fin  AND b.id_marca = m.id_marca AND d.id_desc = b.id_desc AND bien_padre ='".$row1['bien_id']."' ORDER BY b.id_desc ";
		$respart1=connector1($user,$pass,$sqlpart1);
		while($rowpart1=fetchArray($respart1)){
			?>
            	<tr>
                	<td><?= $rowpart1['id_bien']?></td>
                	<td><?= $rowpart1['des_desc']." ".$rowpart1['modelo']?></td>
                    <td><?= $rowpart1['des_marca']?></td>
                    <td><?= $rowpart1['nro_serie']?></td>
                    <td><?= $rowpart1['cod_pat_mh']?></td>
                    <td><?= $rowpart1['codpatnew']?></td>
                    <td><?= $rowpart1['caracteristicas']?></td>
                    <td></td>
                </tr>
            <?php
		}
	?>
</table>
<br>
<br>
<br>
<table id="printfee1">
    <tr>
    	<td colspan="8">Fecha: <?= $row1['fec_traslado']?></td>
    </tr>
   	<tr>
   		<td colspan="8">Por la presente se autoriza a trasladar el(los) equipo(s) mencionados anteriormente, ubicados en la Dirección/Departamento SSEE</td>
   	</tr>
    <tr>
    	<td colspan="8">&nbsp;</td>
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
			$tableresp="traslados t, responsables r, ubicaciones u, direcciones dir ";
			$arrayresp=array('nom_resp','nom_depto','sigladir');
			$sqlresp=select($tableresp,$arrayresp);
			$sqlresp.=" WHERE u.id_ubic=r.fkubicacion AND u.fkdir=dir.pkdir AND t.id_resp=r.id_resp AND t.id_traslado='".$pkant."'";
			$resresp=connector1($user,$pass,$sqlresp);
			$rowresp=fetchArray($resresp);
			$rowsresp=getNumRows($resresp);
			?>
            <tr>
			    <td colspan="2"><span class="negrita">EMISOR: </span></td>
                <td colspan="2"><input class="textprint" type="text" value="<?= $rowresp['sigladir']."-".$rowresp['nom_depto']?>" /></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Firma Funcionario: </td>        
                <td colspan="2"><input type="text" value="" /></td>
        		<td colspan="2">Aclaración de firma:</td>
                <td colspan="2"><input type="text" value="<?= $rowresp['nom_resp']?>" /></td>
    		</tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="2">V°B° Director: </td>
                <td colspan="2"><input type="text" /></td>
                <td colspan="2">Aclaración de firma</td>
                <td colspan="2"><input type="text" /></td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <?php
		}else{
			?>
            <tr>
			    <td colspan="2"><span class="negrita">EMISOR: </span></td>
                <td colspan="2"><input  class="textprint" type="text" /></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>	
        		<td colspan="2">Firma Funcionario: </td>        
                <td colspan="2"><input type="text" value="" /></td>
        		<td colspan="2">Aclaración de firma:</td>
                <td colspan="2"><input type="text" /></td>
    		</tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="2">V°B° Director: </td>
                <td colspan="2"><input type="text" /></td>
                <td colspan="2">Aclaración de firma</td>
                <td colspan="2"><input type="text" /></td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="8">&nbsp;</td>
            </tr>
            <?php
		}
		?>
    <tr>
    	<td colspan="2"><span class="negrita">RECEPTOR:</span></td>
        <td colspan="2"><input class="textprint"  type="text" value="<?= $row1['sigladir']."-". $row1['nom_depto']?>" /></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2">Firma de Funcionario:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" value="<?= $row1['nom_resp']?>" /></td>
    </tr>
    <tr>
       <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">V°B° Director:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
       <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">V°B° Jefe Administrativo:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
       <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">Funcionario de Patrimonio SSEE:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
       <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">Personal de Seguridad:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
    	<td colspan="2">Fecha y hora de salida</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="4"></td>
    </tr>
    <tr>
       <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2">Personal de Seguridad:</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="2">Aclaración de firma:</td>
        <td colspan="2"><input type="text" /></td>
    </tr>
    <tr>
    	<td colspan="2">Fecha y hora de entrada</td>
        <td colspan="2"><input type="text" /></td>
        <td colspan="4"></td>
    </tr>
    <tr>
       <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
       	<td colspan="8">&nbsp;</td>
    </tr>
    <tr align="center">
	<?
	$tabletipo="tipo_traslados";
	$arraytipo=array('id_tipo_tras','des_tipo_tras');
	$sqltipo=select($tabletipo,$arraytipo);
	$sqltipo.=" WHERE id_tipo_tras <> 1 AND id_tipo_tras <> 4 AND id_tipo_tras <> 41 AND id_tipo_tras <> 39";
	$restipo=connector1($user,$pass,$sqltipo);
	echo"<td colspan='8'>";
	while($rowtipo=fetchArray($restipo)){
		if($rowtipo['id_tipo_tras']==$row1['id_tipo_tras']){
			echo '<span class="negrita">'.$rowtipo['des_tipo_tras'].'</span><input type="checkbox" name="checkbox" value="checkbox" checked>';
		}else{
			echo $rowtipo['des_tipo_tras'].'<input type="checkbox" name="checkbox" value="checkbox">';
		}
	}
	echo"</td>";
	?>
</table>
<?php	
}
?>
</body>
</html>