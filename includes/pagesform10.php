<?php
function page($res,$total,$pagetam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$name,$resp){

  $cant=count($arrayhead);
  $odd="#FFF8DC";
  $even="#F5DEB3";
  $head="#DEB887";
  $plus="../img/16-em-plus.png";
  $cross="../img/24-em-cross.png";
  $pencil="../img/16-em-pencil.png";
  $first="../img/24-arrow-first.png";
  $last="../img/24-arrow-last.png";
  $next="../img/24-arrow-next.png";
  $prev="../img/24-arrow-previous.png";
  ?>
  <div class="contentable">
  <form id="<?=$name?>" name="<?=$name?>" method="post" onSubmit="insert('<?=$frm?>','<?="#".$name?>');return false;">
  <input type="hidden" name="resp1" id="resp1" value="<?=$resp?>" />
  <table class="viewtable">
  	<tr bgcolor="<?=$head?>">
    	<th colspan="<?=$cant?>"><?=$title?></th>
    </tr>
	<tr bgcolor="<?=$head?>">
		<?php
		for($ihead=0;$ihead<count($arrayhead);$ihead++){
			if($ihead==0){
				?>
        <th><input type="checkbox" id="selectall" /></th>
			<?php
			}else{
				?>
        <th><a href="" onClick="mostrar2('<?=$index?>?orden=<?=$arraydb[$ihead]?>&type=<?=$type?>');return false;"><?=$arrayhead[$ihead]?></a></th>
        <?php
			}
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
			if($idb==0){
				?>
				<td><input class="case" type="checkbox" name="bien[]" id="bien" value="<?=$row[$arraydb[$idb]]?>" /></td>
				<?php
			}else{
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
  <tr>
    <td colspan="<?=$cant?>"><input class="boton" type="submit" id="send" value="Guardar" /></td>
  </tr>
  </table>
  </form>
  <div style="background:<?=$head?>">
  <a href="" onClick="mostrar2('<?=$index?>?page=1&orden=<?=$orden?>');return false;" ><img class="img" src="<?=$first?>" ></a>
  <?php
  $display=5;
  if($page>1){
		?>
		<a href="" onClick="mostrar2('<?=$index?>?page=<?=$page-1?>&orden=<?=$orden?>');return false;"><img class="img" src="<?=$prev?>" ></a>
		<?php
  }
  for($i=$page;$i<=$total&&$i<=($page+$display);$i++){
	if($page==$i){
		echo $i ." - ";
	}else{
		?>
		<a href="" onClick="mostrar2('<?=$index?>?page=<?=$i?>&orden=<?=$orden?>');return false;"><?=$i?></a>
		<?php
	}
  }
  if(($display+$page)<$total){
		echo "...";
  }
  if($page<$total){
		?>
		<a href="" onClick="mostrar2('<?=$index?>?page=<?=$page+1?>&orden=<?=$orden?>');return false;"><img class="img" src="<?=$next?>" ></a>
		<?php
  }
  ?>
  <a href="" onClick="mostrar2('<?=$index?>?page=<?=$total?>&orden=<?=$orden?>');return false;"><img class="img" src="<?=$last?>" ></a>
  </div>
  </div>
  <?
}
?>