<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jqueryui.js"></script>
<script type="text/javascript" src="js/functionlogin.js"></script>
<link rel="stylesheet" href="css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="css/stylelogin.css" />
<title>.::INVENTARIO::.</title>
</head>
<body>
  <form id="frmlogin" name="frmlogin" method="post" action="includes/conn.php">
    <div id="box" name="box" title="Login">
      <input type="text" id="user" name="user" value="Usuario" /><br>
      <input type="password" id="pass" name="pass" /><br>
      <input type="submit" id="login" value="Login" />
    </div>
  </form>
  <div id="resultado">
  </div>
</body>
</html>
