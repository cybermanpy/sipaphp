<?php
function page($res,$total,$pagetam,$page,$inicio,$arraydb,$arrayhead,$title,$index,$frm,$del,$orden,$type,$tableparte,$arrayparte,$arraypartedb,$arraypartehead,$whereparte,$user,$pass,$show,$dist){
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
  <table id="searcht" class="viewtable">
  	<tr bgcolor="<?=$head?>">
    	<th colspan="<?=$cant?>"><?=$title."<br> Registro ".$show?></th>
    </tr>
	<tr bgcolor="<?=$head?>">
		<?php
		for($ihead=0;$ihead<count($arrayhead);$ihead++){
			?>
			<th><a href="" onClick="mostrar2('<?=$index?>?orden=<?=$arraydb[$ihead]?>&type=<?=$type?>');return false;"><?=$arrayhead[$ihead]?></a></th>
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
				case (count($arraydb)-1):
					?>
					<td>
            <table class="tablereg1">
              <tr bgcolor="<?=$head ?>">
								<?php
                for($iparte=0;$iparte<count($arraypartehead);$iparte++){
									?>
									<th><?=$arraypartehead[$iparte]?></th>	
									<?php
                }
                ?>
              </tr>
							<?php
              $sqlparte=select($tableparte,$arrayparte);
              $sqlparte.=" ".$whereparte." ".$row[$arraydb[$idb]]."' AND ".$dist." ".$row[$arraydb[$idb]]."' ";
              $resparte=connector1($user,$pass,$sqlparte);
              while($rowparte=fetchArray($resparte)){
                ?>
                <tr bgcolor="<?=$color?>">
                  <?php
                  for($ipartedb=0;$ipartedb<count($arraypartedb);$ipartedb++){
                    ?>
                    <td><?=$rowparte[$arraypartedb[$ipartedb]]?></td>
                    <?php								
                  }
                  ?>
                </tr>
                <?php
              }
              ?>
            </table>
					</td>
					<?php
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