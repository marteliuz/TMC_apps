<?php
include("config.php");
require("lib_functions.php");
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{
	$username = $_SESSION['Usuario'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Agregar un nuevo Terminal</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		#divTerminal {
		position:absolute;
		left:25px;
		top:25px;
		}
		#Resultado {
		position:absolute;
		left:500px;
		top:50px;
		}
		#foot {
		font-family: Arial, Helvetica, sans-serif;
		font-size:10px;
		position:fixed;
		left:0px;
		bottom: 0;
		height: 65px;
		width: 100%;
		background: #cecece;
		}
		-->
	</style>
	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<script type="text/javascript" src="../js/datepickercontrol.js"></script> 
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
    <link rel="stylesheet" type="text/css" href="../css/datepickercontrol.css"> 

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
</head>
<body>
<div id="divTerminal">
	<fieldset><legend>Detalle del Terminal</legend>
		<table>
			<tr>
				<td><strong>Modelo Codec</strong></td>
				<td>&nbsp;</td>
				<td><strong>S/Number Codec</strong></td>
			</tr>
			<tr>
				<td><?php echo getCmbModelosTerminales("cmbModelos",null); ?></td>
				<td>&nbsp;</td>
				<td><input name="nserie" type="text" id="nserie" maxlength="20" /></td>
			</tr>
			<tr>
				<td><strong>S/Number Camara</strong></td>
				<td>&nbsp;</td>
				<td><strong>S/Number Microfono</strong></td>
			</tr>
			<tr>
				<td><input name="nserie_camara" type="text" id="nserie_camara" maxlength="16" /></td>
				<td>&nbsp;</td>
				<td><input name="nserie_mic" type="text" id="nserie_mic" maxlength="16" /></td>
			</tr>
			<tr>
				<td><strong>S/Number Control</strong></td>
				<td>&nbsp;</td>
				<td><strong>Ubicacion</strong></td>
			</tr>
			<tr>
				<td><input name="nserie_cremoto" type="text" id="nserie_cremoto" maxlength="16" /></td>
				<td>&nbsp;</td>
				<td><input type="text" id="ubicacion"/></td>
			</tr>
		</table>
		<div align="center"><input type="button" id="btnNvoTerminal" value="Crear Terminal" onClick="javascript:nuevoTerminal();"/></div>

	</fieldset>
	<fieldset><legend>Contrato con Polycom</legend>
		<table>
			<tr>
				<td width="150" height="20"><strong>Fecha Inicio</strong></td>
				<td width="25"  height="20"></td>
				<td width="150" height="20"><strong>Fecha Termino</strong></td>
			</tr>
			<tr>
				<td><input type="text" name="fecha_inicio" id="fecha_inicio" datepicker="true" datepicker_format="YYYY-MM-DD" /></td>
				<td></td>
				<td><input type="text" name="fecha_termino" id="fecha_termino" datepicker="true" datepicker_format="YYYY-MM-DD" /></td>
			</tr>
			<tr>
				<td colspan="3"><strong>Descripcion</strong></td>
			</tr>
			<tr>
				<td colspan="3"><input type="text" name="descripcion" id="descripcion" maxlength="45" style="width:100%"/></td>
			</tr>
		</table>
		<div align="center"><input type="button" id="btnNvoContrato" value="Crear Contrato" onClick="javascript:nuevoContratoPolycom();" disabled="disabled">
			<input type="hidden" id="id_terminal"></div>

	</fieldset> 
	<fieldset><legend>Asociar a un Cliente</legend>
		<table>
			<tr>
				<td><strong>Cliente</strong></td>
				<td>&nbsp;</td>
				<td><strong>Contrato</strong></td>
			</tr>
			<tr>
				<td><label><?php echo getCmbClientes("cmbClientes","loadContratosByCliente()"); ?></label></td>
				<td>&nbsp;</td>
				<td><div id="DIVcontratos"></div></td>
			</tr>
		</table>
		<div align="center"><input type="button" id="btnAsociar" value="Asociar" onClick="javascript:asociaClienteATerminal();" disabled="disabled"></div>
	</fieldset>
</div>
<div id="Resultado"></div>
<!-- <div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div> -->
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>