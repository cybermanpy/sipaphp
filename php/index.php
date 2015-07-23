<?php
include'session.php';
include'../includes/charset.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta "charset=utf-8" />
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
<div id="content">
        <div id="header">
           <div id="banner"><br><img id="imgbanner" src="../img/logo1.jpg" /><br>SISTEMA PATRIMONIAL (SIPA) SUB SECRETARÍA DE ECONOMÍA</div>
           <br>
           <div id="menu">
           		<table class="tablemenu">
                <tr>
                <td>
                  <ul id="nav">
                      <li><a href="" >Home</a></li>
                      <li><a href="">Movimientos</a>
                          <ul>
                          	<li><a href="" onClick="mostrar1('viewtraslados.php?a=reset');return false">Traslados</a></li>
                            <li><a href="" onClick="mostrar1('viewsearchtraslados.php?a=reset');return false">Buscar Traslados</a></li>
                            <li><a href="" onClick="mostrar1('viewbienes.php?a=reset');return false">Bienes</a></li>
                            <li><a href="" onClick="mostrar1('viewform10.php?a=reset');return false">Formulario FC10</a></li>
                          </ul>
                      </li>
                      <li><a href="">Tablas de Referencias</a>
                    	<ul>  
                        	<li><a href="" onClick="mostrar1('viewdirecciones.php?a=reset');return false">Direcciones</a></li>
                            <li><a href="" onClick="mostrar1('viewdptos.php?a=reset');return false">Departamentos</a></li>
                            <li><a href="" onClick="mostrar1('viewestados.php?a=reset');return false">Estados</a></li>
                            <li><a href="" onClick="mostrar1('viewmarcas.php?a=reset');return false">Marcas</a></li>
                            <li><a href="" onClick="mostrar1('viewtipodocs.php?a=reset');return false">Tipo Documentos</a></li>
                            <li><a href="" onClick="mostrar1('viewconservaciones.php?a=reset');return false">Conservaciones</a></li>
                            <li><a href="" onClick="mostrar1('vieworgfin.php?a=reset');return false">Organismo Financiador</a></li>
                            <li><a href="" onClick="mostrar1('viewtipos.php?a=reset');return false">Tipos</a></li>
                            <li><a href="" onClick="mostrar1('viewdescripciones.php?a=reset');return false">Descripciones</a></li>
                            <li><a href="" onClick="mostrar1('viewtipotraslados.php?a=reset');return false">Tipo Traslados</a></li>
                            <li><a href="" onClick="mostrar1('viewproveedores.php?a=reset');return false">Proveedores</a></li>
                            <li><a href="" onClick="mostrar1('viewresponsables.php?a=reset');return false">Responsables</a></li>
                            <li><a href="" onClick="mostrar1('viewcargos.php?a=reset');return false">Cargos</a></li>
                            <li><a href="" onClick="mostrar1('viewfichas.php?a=reset');return false">Fichas</a></li>
                            <li><a href="" onClick="mostrar1('viewusers.php?a=reset');return false">Users</a></li>
                            <li><a href="" onClick="mostrar1('frmchangepwd.php?a=reset');return false">Cambiar Password</a></li>
                            <li><a href="" onClick="mostrar1('viewpermit.php?a=reset');return false">Permisos</a></li>
                   	    </ul>  
               		  </li>  
                      <li><a href="">Busquedas</a>
                    	<ul>  
                        	<li><a href="" onClick="mostrar1('frmsearchequipos.php?a=reset');return false">PC/NB/SERVER</a></li>
                            <li><a href="" onClick="mostrar1('frmsearchprinters.php?a=reset');return false">Impresoras</a></li>
                            <li><a href="" onClick="mostrar1('frmsearchbienes.php?a=reset');return false">Bienes</a></li>
                            <li><a href="" onClick="mostrar1('frmsearchbienes1.php?a=reset');return false">Bienes Rapidos</a></li>
                            <li><a href="" onClick="mostrar1('frmsearchequipos1.php?a=reset');return false">PC/NB/SERVER Rapidos</a></li>
                            <li><a href="" onClick="mostrar1('frmsearchprinters1.php?a=reset');return false">Impresoras Rapidas</a></li>
                            <li><a href="" onClick="mostrar1('frmsearchequiposn.php?a=reset');return false">Bienes Sin Ficha </a></li>
                            <li><a href="" onClick="mostrar1('frmsearchequiposb.php?a=reset');return false">Bienes Sin Responsables</a></li>
                   	    </ul>  
               		  </li>  
                      <li><a href="">Logon</a>
                      	<ul>
                        	<li><a href="exit.php"><? echo $_SESSION['s_user']?></a></li>
                        </ul>
                      </li>
                  </ul>
                  </td>
                  </tr>
                </table>
			</div>
        </div>
        <br>
        <br>
        <!--<div id="mleft">
        	<img src="../img/logo2.jpg">
        </div>-->
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
