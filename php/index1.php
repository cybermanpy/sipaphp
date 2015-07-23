<?php
include'session.php';
include'../includes/charset.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta "charset=utf-8" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jqueryui.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<link rel="stylesheet" href="../css/cupertino/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/stylesmain.css" />
<title>.::INVENTARIO::.</title>
</head>

<body>
<div id="content">
        <div id="header">
           <div id="banner"><br><img id="imgbanner" src="../img/logo1.jpg" />SISTEMA PATRIMONIAL (SIPA) SUB SECRETARÍA DE ECONOMÍA</div>
           <div id="menu">
           		 <a class="alogon" href="exit.php">Logon: <? echo $_SESSION['s_user']?></a>
			</div>
        </div>
        <br>
        <br>
        <div id="mleft">
        	<table>
              <tr>
                <td>Busqueda</td>
              </tr>
              <tr>
                <td><div class="boton1" onClick="mostrar1('frmsearchbienes.php?a=reset');return false">Bienes</div></td>
              </tr>
              <tr>
                <td><div class="boton1" onClick="mostrar1('frmsearchprinters.php?a=reset');return false">Impresoras</div></td>
              </tr>
              <tr>
                <td><div class="boton1" onClick="mostrar1('frmsearchequipos.php?a=reset');return false">PC/NB/SERVER</div></td>
              <tr>
              	<td>Actividades</td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewbienes.php?a=reset');return false">Bienes</div></td>
              </tr>
              </tr>
              	<td><div class="boton1" onClick="mostrar1('viewtraslados.php?a=reset');return false">Traslados</div></td>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewform10.php?a=reset');return false">Formulario FC10</div></td>
              </tr>
              <tr>
              	<td>Tabla de Referencias</td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewdirecciones.php?a=reset');return false">Direcciones</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewdptos.php?a=reset');return false">Departamentos</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewestados.php?a=reset');return false">Estados</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewmarcas.php?a=reset');return false">Marcas</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewtipodocs.php?a=reset');return false">Tipo Documentos</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewconservaciones.php?a=reset');return false">Conservaciones</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('vieworgfin.php?a=reset');return false">Financiador</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewtipos.php?a=reset');return false">Tipos</div></li></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewdescripciones.php?a=reset');return false">Descripciones</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewtipotraslados.php?a=reset');return false">Tipo Traslados</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewproveedores.php?a=reset');return false">Proveedores</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewcargos.php?a=reset');return false">Cargos</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewresponsables.php?a=reset');return false">Responsables</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewfichas.php?a=reset');return false">Fichas</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewusers.php?a=reset');return false">Users</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('frmchangepwd.php?a=reset');return false">Cambiar Password</div></td>
              </tr>
              <tr>
              	<td><div class="boton1" onClick="mostrar1('viewpermit.php?a=reset');return false">Permisos</div></td>
              </tr>         
            </table>
        </div>
        <!--<div id="mright">
        	<img src="../img/logo2.jpg">
        </div>-->
        <br>
        <div id="mmain">
            <div id="resultado"></div>            
           	<div id="resultado1"></div>
        </div>
</div>

</body>
</html>
