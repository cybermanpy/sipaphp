// JavaScript Document
/****************************************************************************************************/
//var charset="application/x-www-form-urlencoded;charset=utf-8";
//var charset="application/x-www-form-urlencoded;charset=iso-8859-1";
$(function(){
    // add multiple select / deselect functionality
    $("#updateall").click(function () {
          $('.case3').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case3").click(function(){
        if($(".case3").length == $(".case3:checked").length) {
            $("#updateall").attr("checked", "checked");
        } else {
            $("#updateall").removeAttr("checked");
        }
 
    });
});
/****************************************************************************************************/
$(function(){
    // add multiple select / deselect functionality
    $("#deleteall").click(function () {
          $('.case2').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case2").click(function(){
        if($(".case2").length == $(".case2:checked").length) {
            $("#deleteall").attr("checked", "checked");
        } else {
            $("#deleteall").removeAttr("checked");
        }
 
    });
});
/****************************************************************************************************/
$(function(){
    // add multiple select / deselect functionality
    $("#insertall").click(function () {
          $('.case1').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case1").click(function(){
        if($(".case1").length == $(".case1:checked").length) {
            $("#insertall").attr("checked", "checked");
        } else {
            $("#insertall").removeAttr("checked");
        }
 
    });
});
/****************************************************************************************************/
$(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
/****************************************************************************************************/
function permit(url,id){
	var v1=$(id).serialize();
    $.ajax({
		   url: url,
           type: "POST",
		   data: v1,
           success: llegada
          });
	return false;
}

/****************************************************************************************************/
function insert(url,id){
	var v1=$(id).serialize();
    $.ajax({		   
		   url: url,
           type: "POST",
           data: v1,
           success: llegada1
          });
	return false;
}
/****************************************************************************************************/
function filter(url){
	var v1=$('input[type=radio]:checked').attr("value"); 
	var v2=$("#term").attr("value");
    $.ajax({		   
		   url: url,
           type: "POST",
           data: "radio="+v1+"&term="+v2,
		   beforeSend:inicioEnvio,
           success: llegada
          });
	return false;
}
/****************************************************************************************************/
function update(url,id){
	var v1=$(id).serialize();
    $.ajax({		   
		   url: url,
           type: "POST",
           data: v1,
		   success: llegada1
          });
	return false;
}
/****************************************************************************************************/
function search1(url,id){
	var v1=$(id).serialize();
	var v2=$("input[type=radio]:checked").attr("value");
	var v3=$("#term").attr("value");
    $.ajax({		   
		   url: url,
           type: "POST",
           data: v1+"&radio="+v2+"&term="+v3,
           success: llegada1
          });
	return false;
}

function mostrar1(www){
	$.ajax({
			url: www,
			type: "GET",
			beforeSend:inicioEnvio,
			success: llegada
	});
}
function mostrar2(www){
	$.ajax({
			url: www,
			type: "GET",
			success: llegada1
	});
}
function borrar(www){
    $.ajax({		   
		   url: www,
       type: "GET",
		   beforeSend:inicioEnvio,
       success: llegada1
    });
	return false;
}

function borrar1(url,id){
	var v1=$(id).serialize();
    $.ajax({		   
		   url: url,
           type: "POST",
           data: v1,
           success: llegada1
          });
	return false;
}

/****************************************************************************************************/
function inicioEnvio()
{
  $("#resultado").html('<div align="center"><h3>Cargando...</h3><img id="loading" src="../img/loading4.gif"></div>');
}
/****************************************************************************************************/
function llegada1(datos)
{
  $("#resultado1").empty();
  $("#resultado1").html(datos);
}
/*function llegada2(datos){
	$("#resultado1").html(datos);
}*/
function llegada(datos)
{
  $("#resultado").empty();
  $("#resultado1").empty();
  $("#resultado").html(datos);
}

/****************************************************************************************************/
$(document).ready(function(){
	/*$("#term").autocomplete({
	  source:"searchestados.php",
	  minLength: 2
  	});*/
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sPaginationType":"full_numbers",
			"aaSorting":[[2	, "desc"]],
			"bJQueryUI":true
		});
	})
	$('#codpat').blur(function(){
		$.post('verifycodpat.php',{v1:$('#codpat').val()},function(data){
			$('#msgbox').html(data);	
		});
	});
	$('#codpatnew').blur(function(){
		$.post('verifycodpatnew.php',{v1:$('#codpatnew').val()},function(data){
			$('#msgbox1').html(data);	
		});
	});
	$('#serie').blur(function(){
		$.post('verifyserie.php',{v1:$('#serie').val()},function(data){
			$('#msgbox2').html(data);	
		});
	});
	$('#cedula').blur(function(){
		$.post('verifycedula.php',{v1:$('#cedula').val()},function(data){
			$('#msgbox2').html(data);	
		});
	});
	$("#tipo").change(function(){
		$.post("selectedtipo.php",{id:$(this).val()},function (data){$("#des").html(data);})
  	});
	$("#dir").change(function(){
		$.post("selectdpto.php",{id:$(this).val()},function (data){$("#ubic").html(data);})
  	});
	/*$("#delete").button();
	$("#search").button();
	$("#filtro").button();
	$("#send").button();
	$("#sendup").button();
	$("#volver").button();
	$("#clean").button();
	$("#volver").addClass("boton");
	$("#send").addClass("boton");
	$("#sendup").addClass("boton");
	$("#search").addClass("boton");
	$("#filtro").addClass("boton");
	$("#clean").addClass("boton");
	$("#delete").addClass("boton");*/
	/*$('.viewtable th').parent().addClass('cabecera');
	$('.viewtable tr:not([th]):even').addClass('even');
	$('.viewtable tr:not([th]):odd').addClass('odd');
	$('.viewtableScroll th').parent().addClass('cabecera');
	$('.viewtableScroll tr:not([th]):even').addClass('even');
	$('.viewtableScroll tr:not([th]):odd').addClass('odd');*/
	/*$('#tablereg td div').addClass('floatright');
	$('#tablereg td input[type=text]').addClass('inputs');
	$('#tablereg td input[type=password]').addClass('inputs');
	$('#tablereg td select').addClass('inputs');
	$('#tablereg td textarea').addClass('textarea');
	$('#tablereg td').addClass('aligntext');
	$('#tablereg1 td div').addClass('floatright');
	$('#tablereg1 td input[type=text]').addClass('inputs1');
	$('#tablereg1 td input[type=password]').addClass('inputs1');
	$('#tablereg1 td select').addClass('inputs1');
	$('#tablereg1 td').addClass('aligntext');*/
	$('#title').addClass('titlestyle');
	$('#imgbanner').addClass('imgbanner');
	$("#printfee").addClass("tableprint");
	$("#printfee td").addClass("tabletd");
	$("#printfee th").addClass("tabletd");
	$("#head").addClass("tableprint");
	$("#title").addClass("tableprint");
	$("#title th").addClass("tabletd");
	$("#body").addClass("tableprint");
	$("#body td").addClass("tabletd");
	$("#body th").addClass("tabletd");
	$("#obs1").addClass("tableprint");
	$("#foot").addClass("tableprint");
	$("#foot td").addClass("tabletd");
	$("#foot th").addClass("tabletd");
	$("#printfee1").addClass("tableprint1");
	//$("#printfee td div").removeClass("tableprint");
	//$('#ap td select').addClass('inputs');
	//$('#ap td').addClass('aligntext');
	//$('#ap').addClass('tablereg');
	//$('#reg').addClass('link');
	//$('#log').addClass('link');
	//$('#regdiv').addClass('divreg');
	//$('#footer').addClass('divfooter');
	//$('#ad').addClass('divad');
	//$('#back').addClass('link');
	//$('#cargar').addClass('boton1');
	//$('#cargar1').addClass('boton1');
	//$('#send1').addClass('aligntext');
	//$('#tablerent').addClass('tablereg');
	//$('#tablerent td input[type=submit]').addClass('floatright');
	//$('#tablerent td input[type=text]').addClass('inputs');	
});


/****************************************************************************************************/
var newwindow;
function popup(url)
{
	newwindow=window.open(url,'name','height=900,width=840,menubar=yes, left=150,top=50,scrollbars=yes');
	if (window.focus) {newwindow.focus()}
}

/****************************************************************************************************/





/*$(document).ready(function(){
	$('#email').blur(function(){
		$.post('php/veryusers.php',{v2:$('#email').val()},function(data){
			$('#msgusr').html(data);	
		});
	});
});*/

/****************************************************************************************************/
/*$(document).ready(function(){
	$('#send').click(function(){
		$('#frminsusers').validate({
			rules:{
				pwd1:{required: true, equalTo: "#pwd"}
			}
		})		
	});
});*/

/****************************************************************************************************/


/****************************************************************************************************/
/*$(document).ready(function(){
    $('#send').click(function(){
	  $('#frame').show();
      $('#form').hide();
    });
});*/
