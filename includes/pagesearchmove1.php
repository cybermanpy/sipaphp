<?php
function page($res,$total,$pagetam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$upfee,$upfc11,$printfee,$printfc11,$modelo,$resp,$resp1,$ubic,$ubic1,$bien,$dir,$dir1,$cod,$codn,$marca,$marca1,$sn,$desc,$desc1){
  $cant=count($arrayhead);
  $odd="#FFF8DC";
  $even="#F5DEB3";
  $head="#DEB887";
  $cross="../img/24-em-cross.png";
  $move="../img/building_go.png";
  $pdf="../img/page_white_acrobat.png";
  $printer="../img/printer.png";
  $up="../img/page_save.png";
  $first="../img/24-arrow-first.png";
  $last="../img/24-arrow-last.png";
  $next="../img/24-arrow-next.png";
  $prev="../img/24-arrow-previous.png";
  $arrayrow=array('5','10','15','20','30','40','50','60','100','200','500','1000');
  ?>
  <form id="frmsearcht" name="frmsearcht" method="post" onSubmit="search1('viewsearchtraslados.php','#frmsearcht');return false;">
	<table class="tablereg1">
    <tr>
      <th colspan="6">Buscar Traslados</th>
    </tr>
    <tr>
      <td>Responsable</td>
      <td><input type="text" id="resp1" name="resp1" value="<?=$resp1?>" /><input type="hidden" id="resp" name="resp" value="<?=$resp?>" /></td>
      <td>Departamento</td>
      <td><input type="text" id="ubic1" name="ubic1" value="<?=$ubic1?>" /><input type="hidden" id="ubic" name="ubic" value="<?=$ubic?>" /></td>
      <td>Bien</td>
      <td><input type="text" id="bien" name="bien" value="<?=$bien?>" /></td>
    </tr>
    <tr>
      <td>Estado Usuario</td>
      <td><input type="text" id="estado1" name="estado1" /><input type="hidden" name="estado" id="estado" /></td>
      <td>Cantidad Paginas</td>
      <td><select id="nrow" name="nrow"><?=sele1($pagetam,$arrayrow);?></select></td>
      <td>Dirección</td>
      <td><input type="text" id="dir1" name="dir1" value="<?=$dir1?>" /><input type="hidden" name="dir" id="dir" value="<?=$dir?>" /></td>
    </tr>
    <tr>
      <td>Código Patrimonial</td>
      <td><input type="text" id="cod" name="cod" value="<?=$cod?>" /></td>
      <td>Código Patrimonial Nuevo</td>
      <td><input type="text" id="codn" name="codn" value="<?=$codn?>" /></td>
      <td>Marcas</td>
      <td><input type="text" id="marca1" name="marca1" value="<?=$marca1?>" /><input type="hidden" name="marca" id="marca" value="<?=$marca?>" /></td>
    </tr>
    <tr>
      <td>Modelo</td>
      <td><input type="text" id="modelo" name="modelo" value="<?=$modelo?>" /></td>
      <td>Nro. Serie</td>
      <td><input type="text" id="sn" name="sn" value="<?=$sn?>" /></td>
      <td>Descripción</td>
      <td><input type="text" id="desc1" name="desc1" value="<?=$desc1?>" /><input type="hidden" name="desc" id="desc" value="<?=$desc?>" /></td>
    </tr>
    <tr>
      <td>Filtro:</td>
      <td><input type="text" id="term" name="term" /></td>
      <td>CodPat<input type="radio" name="campo" value="1"/></td>
      <td>CodPat nuevo<input type="radio" name="campo" value="2"/><td>
      <td>Nro Serie<input type="radio" name="campo" value="3"/></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5"><input onClick="mostrar1('<?=$index?>?a=reset'); return false;" class="boton" type="submit" id="clean1" value="Limpiar" /></td>
      <td colspan="5"><input class="boton" type="submit" id="send" value="Aplicar" /></td>
    </tr>
  </table>
</form>
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">  
    <p>Exportar a Excel  <img src="../img/page_excel.png" class="botonExcel" /></p>  
    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />  
</form>
  <div class="contentable">
  <table class="viewtable">
  	<tr bgcolor="<?=$head?>">
    	<th colspan="<?=$cant?>"><?=$title?></th>
    </tr>
	<tr bgcolor="<?=$head?>">
		<?php
		for($ihead=0;$ihead<count($arrayhead);$ihead++){
			?>
			<th><a href="" onClick="mostrar1('<?=$index?>?orden=<?=$arraydb[$ihead]?>&type=<?=$type?>');return false;"><?=$arrayhead[$ihead]?></a></th>
			<?php
		}
		?>
	</tr>
	<?php
	$a=1;
	while($row=fetchArray($res)){
		if($a%2 == 0)$color=$odd;
		else $color=$even;
		?>
		<tr bgcolor="<?=$color?>">
		<?php
		 for($idb=0;$idb<count($arraydb);$idb++){
			switch($idb){
				case 0;
					?>
          <td>
          <a onClick="mostrar1('<?=$del?>?pk=<?=$row[$arraydb[$idb]]?>');return false;" href=""><img class="img" src="<?=$cross?>"></a>
          <?php
					switch($row['ultimo']){
						case 'si':
							?>
              <a onClick="popup('<?=$printfee?>?pk=<?=$row[$arraydb[$idb]]?>');return false;" href=""><img class="img" src="<?=$printer?>"></a>
              <?php
						break;
					}
					?>
          <a onClick="mostrar1('<?=$upfee?>?pk=<?=$row[$arraydb[$idb]]?>');return false;" href=""><img class="img" src="<?=$up?>"></a>
          </td>
          <?php
				break;
				case 1:
					if($row['filetras']!=""){
						?>
						<td><a href="<? echo "../../inventario/".$row[$arraydb[$idb]]?>"><img class="img"  src="<?=$pdf?>" /></a></td>
						<?php
					}else{
						echo "<td></td>";
					}
				break;
				case 2;
					?>
          <td><a onClick="mostrar1('<?=$frm?>?pk=<?=$row[$arraydb[$idb]]?>');return false;" href=""><img class="img" src="<?=$move?>"></a>
          </td>
          <?php
				break;
				case 3;
					?>
          <td><a onClick="mostrar1('<?=$upfc11?>?pk=<?=$row[$arraydb[$idb]]?>');return false;" href=""><img class="img" src="<?=$up?>"></a>
          </td>
          <?php
				break;
				case 4;
					switch($row['ultimo']){
						case 'si':
							?>
              <td><a onClick="popup('<?=$printfc11?>?pk=<?=$row[$arraydb[$idb]]?>');return false;" href=""><img class="img" src="<?=$printer?>"></a>
              </td>
          <?php
						break;
						case 'no':
							echo "<td></td>";
						break;
					}
				break;
				case (count($arraydb)-1):
					if($row['fc11tras']!=""){
						?>
						<td><a href="<? echo "../../inventario/".$row[$arraydb[$idb]]?>"><img class="img"  src="<?=$pdf?>" /></a></td>
						<?php
					}else{
						echo "<td></td>";
					}
				break;
				default;			
					?>
					<td><?=$row[$arraydb[$idb]]?></td>
					<?php
			}
		}
		?>
		</tr>
		<?php
		$a++;
	}
	?>
  </table>
  <div style="background:<?=$head?>">
  <a href="" onClick="mostrar1('<?=$index?>?page=1&orden=<?=$orden?>');return false;" ><img class="img" src="<?=$first?>" ></a>
  <?php
  $display=5;
  if($page>1){
		?>
		<a href="" onClick="mostrar1('<?=$index?>?page=<?=$page-1?>&orden=<?=$orden?>');return false;"><img class="img" src="<?=$prev?>" ></a>
		<?php
  }
  for($i=$page;$i<=$total&&$i<=($page+$display);$i++){
	if($page==$i){
		echo $i ." - ";
	}else{
		?>
		<a href="" onClick="mostrar1('<?=$index?>?page=<?=$i?>&orden=<?=$orden?>');return false;"><?=$i?></a>
		<?php
	}
  }
  if(($display+$page)<$total){
		echo "...";
  }
  if($page<$total){
		?>
		<a href="" onClick="mostrar1('<?=$index?>?page=<?=$page+1?>&orden=<?=$orden?>');return false;"><img class="img" src="<?=$next?>" ></a>
		<?php
  }
  ?>
  <a href="" onClick="mostrar1('<?=$index?>?page=<?=$total?>&orden=<?=$orden?>');return false;"><img class="img" src="<?=$last?>" ></a>
  </div>
  </div>
  <?
}
?>