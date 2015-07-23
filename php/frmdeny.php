<?php
include'session.php';
require_once'../includes/DbConnector.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
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
<title>.::INVENTARIO::.</title>	
</head>

<body>
<?php
$user=$_SESSION['s_user'];
$pass=$_SESSION['s_pass'];
$table='information_schema.tables';
$array=array('table_name');
$sql=select($table,$array);
$sql.=" WHERE table_type = 'BASE TABLE' AND table_schema = 'public' AND table_catalog = 'inventario' ";
$res=connector1($user,$pass,$sql);
?>
<form id="frmpermit" name="frmpermit" method="post" onSubmit="permit('insertdeny.php','#frmpermit');return false;">
  <table class="tablereg">
  	  <tr>
      	<th bgcolor="#8f7156" colspan="6">Revocar Permisos <br><input type="hidden" id="user" name="user" value="<?= $_GET['pk']?>" />Usuario: <?= $_GET['pk']?></th>
      </tr>
      <tr bgcolor="#8f7156">
          <td>Tablas</td>
          <td>Select</td>
          <td>Insert</td>
          <td>Delete</td>
          <td>Update</td>
      </tr>
      <tr bgcolor="#8f7156">
      	<td></td>
      	<td><input type="checkbox" id="selectall" /></td>
        <td><input type="checkbox" id="insertall" /></td>
        <td><input type="checkbox" id="deleteall" /></td>
        <td><input type="checkbox" id="updateall" /></td>
      </tr>
      <?php
      while($row=fetchArray($res)){
          ?>
          <tr>
              <td><input type="hidden" id="table" name="table[]" value="<?= $row['table_name']?>" /><?= $row['table_name']?></td>
              <td><input type="checkbox" class="case" id="select" name="select[]" value="select" /></td>
              <td><input type="checkbox" class="case1" id="insert" name="insert[]" value="insert" /></td>
              <td><input type="checkbox" class="case2" id="delete" name="delete[]" value="delete" /></td>
              <td><input type="checkbox" class="case3" id="update" name="update[]" value="update" /></td>
          </tr>
          <?php
      }
      ?>
      <tr>
          <td colspan="5"><input class="boton" type="submit" id="send" name="send" value="Revocar" /></td>
      </tr>
  </table>
</form>
</body>
</html>