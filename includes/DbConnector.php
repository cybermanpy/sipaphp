<?php
	function user(){
		$user='root';
		return $user;
	}
	function pass(){
		$pass='rootadmin';
		return $pass;
	}
	function host(){
		$host='192.168.192.160';
		#$host='localhost';
		return $host;
	}
	function port(){
		$port='5432';
		return $port;
	}
	function dbname1(){
		$dbname='postgres';
		return $dbname;
	}
	function dbname2(){
		$dbname='inventario';
		return $dbname;
	}
#----------------------------------------------------------------------------------------------------
function while1($res){
	while($row=fetchArray($res)){
		$aux[]=$row;
	}
	return $aux;
}
	
#----------------------------------------------------------------------------------------------------
	function connector($user, $pass, $sql){
		$host=host();
		$port=port();
		$dbname=dbname1();
		$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene permiso para realizar esta operacion');
		pg_close($conn);
		return $res;
	}
#----------------------------------------------------------------------------------------------------
	function fetchArray($res){
		$row=pg_fetch_array($res);
		return $row;
	}
#----------------------------------------------------------------------------------------------------
	function getNumRows($res){
		$num=pg_num_rows($res);
		return $num;
	}
#----------------------------------------------------------------------------------------------------
	function disconnect($res){
		pg_close($res);
	}
#----------------------------------------------------------------------------------------------------
	function fetchAssoc($res){
		$row=pg_fetch_assoc($res);
		return $row;
	}
#----------------------------------------------------------------------------------------------------
	function fetchObject($res){
		$row=pg_fetch_object($res);
		return $row;
	}
#----------------------------------------------------------------------------------------------------
	function select($table,$arrayselect){
		/*$host=host();
		$port=port();
		$dbname=dbname2();
		$user=user();
		$pass=pass();*/
		$sql=" SELECT ";
		for($x=0;$x<count($arrayselect);$x++){
			if($x==0){
				$sql.=" ".$arrayselect[$x]." ";
			}else{
				$sql.=",".$arrayselect[$x]." ";
			}
		}
		$sql.= " FROM ".$table." ";
		return $sql;
	}
#----------------------------------------------------------------------------------------------------
	function selectdistinct($table,$arrayselect){
		/*$host=host();
		$port=port();
		$dbname=dbname2();
		$user=user();
		$pass=pass();*/
		$sql=" SELECT DISTINCT ";
		for($x=0;$x<count($arrayselect);$x++){
			if($x==0){
				$sql.=" ".$arrayselect[$x]." ";
			}else{
				$sql.=",".$arrayselect[$x]." ";
			}
		}
		$sql.= " FROM ".$table." ";
		return $sql;
	}

#----------------------------------------------------------------------------------------------------
	function delete($pk,$pkt,$table,$user,$pass){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$sql="DELETE FROM ".$table." WHERE ".$pkt." = ".$pk;
		$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
	}
#----------------------------------------------------------------------------------------------------
	function delete1($pk,$pkt,$table){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$sql="DELETE FROM ".$table." WHERE ".$pkt." = ".$pk;
		$conn=@pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=@pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
	}
#----------------------------------------------------------------------------------------------------
	function insert($array,$table,$array1,$user,$pass){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$sql="INSERT INTO ".$table."(";
		for($x=0;$x<count($array);$x++){
			if($x==0){
				$sql.=$array[$x];	
			}else{
				$sql.=",".$array[$x];
			}
		}
		$sql.=")";
		$sql.=" VALUES (";
		for($x=0;$x<count($array1);$x++){
			if($x==0){
				$sql.=$array1[$x];	
			}else{
				$sql.=",".$array1[$x];
			}
		}
		$sql.=")";
		$conn=@pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
	}
#----------------------------------------------------------------------------------------------------              		
	function insert1($array,$table,$array1){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$sql="INSERT INTO ".$table."(";
		for($x=0;$x<count($array);$x++){
			if($x==0){
				$sql.=$array[$x];	
			}else{
				$sql.=",".$array[$x];
			}
		}
		$sql.=")";
		$sql.=" VALUES (";
		for($x=0;$x<count($array1);$x++){
			if($x==0){
				$sql.=$array1[$x];	
			}else{
				$sql.=",".$array1[$x];
			}
		}
		$sql.=")";
		$conn=@pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('<div align="center">Todos los datos deben ser cargados</div>');
		pg_close($conn);
	}
#----------------------------------------------------------------------------------------------------              	
	function update($array,$table,$pk,$pkt,$array1,$user,$pass){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$sql="UPDATE ".$table." SET ";
		for($x=0;$x<count($array);$x++){
			if($x!=count($array)-1){
				$sql.=$array[$x]." = ".$array1[$x].",";	
			}else{
				$sql.=$array[$x]." = ".$array1[$x];	
			}
		}
		$sql.=" WHERE ".$pkt."=".$pk;
		$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
	}

#----------------------------------------------------------------------------------------------------              	
	function update1($array,$table,$pk,$pkt,$array1){
		$user=user();
		$pass=pass();
		$host=host();
		$port=port();
		$dbname=dbname2();
		$sql="UPDATE ".$table." SET ";
		for($x=0;$x<count($array);$x++){
			if($x!=count($array)-1){
				$sql.=$array[$x]." = ".$array1[$x].",";	
			}else{
				$sql.=$array[$x]." = ".$array1[$x];	
			}
		}
		$sql.=" WHERE ".$pkt."=".$pk;
		$conn=@pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
	}

#----------------------------------------------------------------------------------------------------              	
	function connector1($user, $pass, $sql){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
		return $res;
	}
#----------------------------------------------------------------------------------------------------	
	function connector2($sql){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		$res=pg_query($conn,$sql) or die('No tiene suficientes privilegios');
		pg_close($conn);
		return $res;
	}
#----------------------------------------------------------------------------------------------------
	function connectorpass($user,$pass){
		$host=host();
		$port=port();
		$dbname=dbname1();
		$conn=@pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
		//pg_close($conn);
		return $conn;
	}
	
#----------------------------------------------------------------------------------------------------	
function value($data){
	if($data=="")
		$tmp="NULL";
	else 
		$tmp="'".$data."'";
	return $tmp;
}

function sele($datos,$table,$pk,$des,$array){
	$sql=select($table,$array);
	$sql.=" ORDER BY ".$des." ";
	$res=connector2($sql);
	?>
    <option value="">Seleccionar</option>
    <?php
	while($rowb=fetchArray($res)){
		if($rowb[$pk]==$datos){
		?>
        	<option selected="selected" value="<?php echo $rowb[$pk];?>"> <?php echo $rowb[$des]?></option>
        <?php
		}else{
		?>
        	<option value="<?php echo $rowb[$pk];?>"> <?php echo $rowb[$des];?></option>
        <?php
		}
	}
}

function seleif($datos,$table,$pk,$des,$if,$array){
	$sql=select($table,$array);
	$sql.=" ".$if." ";
	$sql.=" ORDER BY ".$des." ";
	$res=connector2($sql);
	?>
    <option value="">Seleccionar</option>
    <?php
	while($rowb=fetchArray($res)){
		if($rowb[$pk]==$datos){
		?>
        	<option selected="selected" value="<?php echo $rowb[$pk];?>"> <?php echo $rowb[$des]?></option>
        <?php
		}else{
		?>
        	<option value="<?php echo $rowb[$pk];?>"> <?php echo $rowb[$des];?></option>
        <?php
		}
	}
}
function sele1($datos,$array){
	?>
    <option value="">Seleccionar</option>
    <?php
	for($x=0;$x<count($array);$x++){
		if($datos==$array[$x]){
		?>
        	<option selected="selected" value="<?php echo $array[$x];?>"> <?php echo $array[$x];?></option>
        <?php
		}else{
		?>
        	<option value="<?php echo $array[$x];?>"> <?php echo $array[$x];?></option>
        <?php
		}
	}
}



function exdate($var){
	$tmp=explode(' ',$var);
	$var1=$tmp[0];
	return $var1;
}
function exhour($var){
	$tmp=explode(' ',$var);
	$var1=$tmp[1];
	$tmp1= explode(':',$var1);
	$var2=hour($tmp1[0]);
	return $var2;
}

function exhoura($var){
	$tmp1= explode(':',$var);
	$var2=hour($tmp1[0]);
	return $var2;
}

function hour($tmp){
	for($x=7;$x<19;$x++){
		if($tmp==$x){
		  ?>
		  <option selected="selected" value="<? echo $x;?>"><? echo $x;?></option>
		  <?
		}else{
		  ?>
		  <option value="<? echo $x;?>"><? echo $x;?></option>
		  <?
		}
	}
}
function exmin($var){
		$tmp=explode(' ',$var);
		$var1=$tmp[1];
		$tmp1= explode(':',$var1);
		$var2=mins($tmp1[1]);
		return $var2;
}

function exmina($var){
		$tmp1= explode(':',$var);
		$var2=mins($tmp1[1]);
		return $var2;
}
function mins($tmp){
	for($x=0;$x<60;$x++){
		if($x<10){
			$x="0".$x;
			if($tmp==$x){
				?>
				<option selected="selected" value="<? echo $x;?>"><? echo $x;?></option>
				<?
			}else{
				?>
				<option value="<? echo $x;?>"><? echo $x;?></option>
				<?
			}
		}else{
			if($tmp==$x){
				?>
				<option selected="selected" value="<? echo $x;?>"><? echo $x;?></option>
				<?
			}else{
				?>
				<option value="<? echo $x;?>"><? echo $x;?></option>
				<?
			}
		}
	}
}
#----------------------------------------------------------------------------------------------------
#Funciones para conexion con Mysql	
#----------------------------------------------------------------------------------------------------
	function usermy(){
		$user='root';
		return $user;
	}
	function passmy(){
		$pass='user123';
		return $pass;
	}
	function hostmy(){
		$host='192.168.192.183';
		return $host;
	}
	function dbname1my(){
		$dbname='mysql';
		return $dbname;
	}
	function dbname2my(){
		$dbname='legajos';
		return $dbname;
	}
#----------------------------------------------------------------------------------------------------
	function connectormy2($sql){
		$host=hostmy();
		$dbname=dbname2my();
		$user=usermy();
		$pass=passmy();
		$conn=mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
		return $res;
	}

#----------------------------------------------------------------------------------------------------
  function selemy($datos,$table,$pk,$des,$array){
	  $sql=select($table,$array);
	  $sql.=" ORDER BY ".$des." ";
	  $res=connectormy2($sql);
	  ?>
	  <option value="">Seleccionar</option>
	  <?php
	  while($rowb=fetchArraymy($res)){
		  if($rowb[$pk]==$datos){
		  ?>
			  <option selected="selected" value="<?php echo $rowb[$pk];?>"> <?php echo $rowb[$des]?></option>
		  <?php
		  }else{
		  ?>
			  <option value="<?php echo $rowb[$pk];?>"> <?php echo $rowb[$des];?></option>
		  <?php
		  }
	  }
  }

#----------------------------------------------------------------------------------------------------
	function fetchArraymy($res){
		$row=mysql_fetch_array($res);
		return $row;
	}

#----------------------------------------------------------------------------------------------------
	function fetchAssocmy($res){
		$row=mysql_fetch_assoc($res);
		return $row;
	}
#----------------------------------------------------------------------------------------------------
	function getNumRowsmy($res){
		$num=mysql_num_rows($res);
		return $num;
	}
#----------------------------------------------------------------------------------------------------
	/*function select($table){
		$host=host();
		$port=port();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$sql="SELECT * FROM ".$table." ";
		return $sql;
	}

#----------------------------------------------------------------------------------------------------
	function connectorpass($user,$pass){
		$host=host();
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		//mysql_close($conn);
		return $conn;
	}
#----------------------------------------------------------------------------------------------------
    function connector($user, $pass, $sql){
		$host=host();
		$dbname=dbname2();
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
		return $res;
	}
#----------------------------------------------------------------------------------------------------
	function connector1($user, $pass, $sql){
		$host=host();
		$dbname=dbname2();
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
		return $res;
	}
#----------------------------------------------------------------------------------------------------
	function connector2($sql){
		$host=host();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
		return $res;
	}
#----------------------------------------------------------------------------------------------------
	function fetchArray($res){
		$row=mysql_fetch_array($res);
		return $row;
	}
#----------------------------------------------------------------------------------------------------
	function getNumRows($res){
		$num=mysql_num_rows($res);
		return $num;
	}
#----------------------------------------------------------------------------------------------------
	function disconnect(){
		mysql_close();
	}
#----------------------------------------------------------------------------------------------------
	function fetchAssoc($res){
		$row=mysql_fetch_assoc($res);
		return $row;
	}
#----------------------------------------------------------------------------------------------------
	function fetchObject($res){
			$row=mysql_fetch_object($res);
			return $row;
		}
#----------------------------------------------------------------------------------------------------
	function delete($pk,$pkt,$table,$user,$pass){
		$host=host();
		$dbname=dbname2();
		$sql="DELETE FROM ".$table." WHERE ".$pkt." = ".$pk;
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
	}
#----------------------------------------------------------------------------------------------------
	function delete1($pk,$pkt,$table){
		$host=host();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$sql="DELETE FROM ".$table." WHERE ".$pkt." = ".$pk;
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
	}
#----------------------------------------------------------------------------------------------------
	function insert($array,$table,$array1,$user,$pass){
		$host=host();
		$dbname=dbname2();
		$sql="INSERT INTO ".$table."(";
		for($x=0;$x<count($array);$x++){
			if($x==0){
				$sql.=$array[$x];	
			}else{
				$sql.=",".$array[$x];
			}
		}
		$sql.=")";
		$sql.=" VALUES (";
		for($x=0;$x<count($array1);$x++){
			if($x==0){
				$sql.=$array1[$x];	
			}else{
				$sql.=",".$array1[$x];
			}
		}
		$sql.=")";
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
	}
#----------------------------------------------------------------------------------------------------
	function insert1($array,$table,$array1){
		$host=host();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$sql="INSERT INTO ".$table."(";
		for($x=0;$x<count($array);$x++){
			if($x==0){
				$sql.=$array[$x];	
			}else{
				$sql.=",".$array[$x];
			}
		}
		$sql.=")";
		$sql.=" VALUES (";
		for($x=0;$x<count($array1);$x++){
			if($x==0){
				$sql.=$array1[$x];	
			}else{
				$sql.=",".$array1[$x];
			}
		}
		$sql.=")";
		$conn=mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
	}
#----------------------------------------------------------------------------------------------------              	
	function update($array,$table,$pk,$pkt,$array1,$user,$pass){
		$host=host();
		$dbname=dbname2();
		$sql="UPDATE ".$table." SET ";
		for($x=0;$x<count($array);$x++){
			if($x!=count($array)-1){
				$sql.=$array[$x]." = ".$array1[$x].",";	
			}else{
				$sql.=$array[$x]." = ".$array1[$x];	
			}
		}
		$sql.=" WHERE ".$pkt."=".$pk;
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
	}
#----------------------------------------------------------------------------------------------------              	
	function update1($array,$table,$pk,$pkt,$array1){
		$host=host();
		$dbname=dbname2();
		$user=user();
		$pass=pass();
		$sql="UPDATE ".$table." SET ";
		for($x=0;$x<count($array);$x++){
			if($x!=count($array)-1){
				$sql.=$array[$x]." = ".$array1[$x].",";	
			}else{
				$sql.=$array[$x]." = ".$array1[$x];	
			}
		}
		$sql.=" WHERE ".$pkt."=".$pk;
		$conn=@mysql_connect($host, $user, $pass) or die ('Tiene problemas de conexion');
		$db=@mysql_select_db($dbname,$conn) or die ('Tiene problemas con la base de datos');
		$res=mysql_query($sql);
		mysql_close($conn);
	}*/
?>
