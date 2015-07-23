// JavaScript Document
$(document).ready(function(){
  $("#box").dialog({height:200,width:300,closeOnEscape: false,position:['center',200]});
  $("#login").button();
  $("#login").focus();
  $("#login").click(send);
  $("#user").focus(e1);
  $("#user").blur(e2);
});
function send(){
  var y=$("form").attr("action");
  var v1=$("#user").attr("value");
  var v2=$("#pass").attr("value");
  $.post(y,{user:v1,pass:v2},llegada);
  return false; 
}
function llegada(datos)
{
  $("#resultado").html(datos);
}
function e1(){
  $("#user").attr("value","");
}
function e2(){
  var x=$("#user").attr("value");
  if(x==""){
	  $("#user").attr("value","Usuario");
  }
}