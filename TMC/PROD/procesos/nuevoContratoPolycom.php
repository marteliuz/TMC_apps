<?php
include("config.php");
require("lib_functions.php");

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Nuevo Contrato Polycom</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<script type="text/javascript" src="../js/datepickercontrol.js"></script> 
<link type="text/css" rel="stylesheet" href="../css/datepickercontrol.css"> 
<style type="text/css">
<!--
#form {
	position:absolute;
	width:800px;
	top:25px;
	left:25px;	
}
#resultado{
	position:absolute;
	top:30px;
	left:600px;
}
#foot{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	position: fixed;
	left: 0px;
	bottom: 0;
	height: 65px;
	width: 100%;
	background: #cecece;
}
-->
</style>
	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
</head>
<body>
<div id="form">
<fieldset><legend>Datos del Contrato Polycom</legend>
	<table id="tbcontrato">
		<tr>
			<td width="150" height="20"><strong>Fecha Inicio</strong></td>
			<td width="25"  height="20"></td>
			<td width="150" height="20"><strong>Fecha Termino</strong></td>
			<td width="25"  height="20"></td>
			<td width="300" height="20"><strong>Descripcion</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="fecha_inicio" id="fecha_inicio" datepicker="true" datepicker_format="YYYY-MM-DD" /></td>
			<td></td>
			<td><input type="text" name="fecha_termino" id="fecha_termino" datepicker="true" datepicker_format="YYYY-MM-DD" /></td>
			<td></td>
			<td><input type="text" name="descripcion" id="descripcion" maxlength="45" style="width:100%"/></td>
		</tr>
		<tr>
			<td colspan="5" align="center"><input type="button" id="btnCrear" value="Crear" onclick="javascript:nuevoContratoPolycom()"></td>
		</tr>
	</table>
</fieldset> 
</div>
<div id="resultado"></div>
<div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>
