<?php
function page($res,$total,$pagetam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$upfee,$upfc11,$printfee,$printfc11){
if($filtro3=="" && $filtro4==""){
  ?>
  <form id="frmsearch" name="frmsearch" action="" method="post">
	  <table id="tablereg" class="tablereg">
		  <tr>
			  <td>Filtro:</td>
			  <td><input type="text" id="term" name="term" /></td>
			  <td><?=$filtro1?></td>
			  <td><input type="radio" name="campo" value="1" checked="checked" /><td>
			  <td><?=$filtro2?></td>
			  <td><input type="radio" name="campo" value="2" /></td>
		  </tr>
		  <tr>
			  <td colspan="3"><input onClick="mostrar1('<?=$index?>?a=reset'); return false;" class="boton" type="submit" id="clean1" value="Limpiar" /></td>
                  <td colspan="4"><input onClick="filter('<?=$index?>');return false;" class="boton" type="submit" id="aplicar" value="Aplicar" /></td>
		  </tr>
	  </table>
  </form>
  <?php
}else{
	if($filtro5=="" && $filtro6==""){
		?>
        <form id="frmsearch" name="frmsearch" action="" method="post">
          <table id="tablereg" class="tablereg">
              <tr>
                  <td>Filtro:</td>
                  <td><input type="text" id="term" name="term" /></td>
                  <td><?=$filtro1?></td>
                  <td><input type="radio" name="campo" value="1" checked="checked" /><td>
                  <td><?=$filtro2?></td>
                  <td><input type="radio" name="campo" value="2" /></td>
                  <td><?=$filtro3?></td>
                  <td><input type="radio" name="campo" value="3" /></td>
                  <td><?=$filtro4?></td>
                  <td><input type="radio" name="campo" value="4" /></td>
              </tr>
              <tr>
                  <td colspan="5"><input onClick="mostrar1('<?=$index?>?a=reset'); return false;" class="boton" type="submit" id="clean1" value="Limpiar" /></td>
                  <td colspan="6"><input onClick="filter('<?=$index?>');return false;" class="boton" type="submit" id="aplicar" value="Aplicar" /></td>
              </tr>
          </table>
        </form>
		<?php
	}else{
		?>
        <form id="frmsearch" name="frmsearch" action="" method="post">
          <table id="tablereg" class="tablereg">
              <tr>
                  <td>Filtro:</td>
                  <td><input type="text" id="term" name="term" /></td>
                  <td><?=$filtro1?></td>
                  <td><input type="radio" name="campo" value="1" checked="checked" /><td>
                  <td><?=$filtro2?></td>
                  <td><input type="radio" name="campo" value="2" /></td>
                  <td><?=$filtro3?></td>
                  <td><input type="radio" name="campo" value="3" /></td>
                  <td><?=$filtro4?></td>
                  <td><input type="radio" name="campo" value="4" /></td>
                  <td><?=$filtro5?></td>
                  <td><input type="radio" name="campo" value="5" /></td>
                  <td><?=$filtro6?></td>
                  <td><input type="radio" name="campo" value="6" /></td>
              </tr>
              <tr>
                  <td colspan="7"><input onClick="mostrar1('<?=$index?>?a=reset'); return false;" class="boton" type="submit" id="clean1" value="Limpiar" /></td>
                  <td colspan="8"><input onClick="filter('<?=$index?>');return false;" class="boton" type="submit" id="aplicar" value="Aplicar" /></td>
              </tr>
          </table>
        </form>
		<?php		
	}
}
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
  ?>
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