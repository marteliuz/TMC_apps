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
		left:25px;
		top:400px;
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
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
</head>
<body>
<div id="divTerminal">
<fieldset><legend>Terminal</legend>
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
		<tr>
		  <td><strong>Modelo Codec</strong></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td><?php echo getCmbModelosTerminales("cmbModelos",null); ?></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
			<td><strong>S/Number Codec</strong></td>
			<td>&nbsp;</td>
			<td><strong>S/Number Camara</strong></td>
		</tr>
		<tr>
			<td><label><input name="nserie" type="text" id="nserie" maxlength="14" /></label></td>
			<td>&nbsp;</td>
			<td><label><input name="nserie_camara" type="text" id="nserie_camara" maxlength="14" /></label></td>
		</tr>
		<tr>
			<td><strong>S/Number Microfono</strong></td>
			<td>&nbsp;</td>
			<td><strong>S/Number Control</strong></td>
		</tr>
		<tr>
			<td><label><input name="nserie_mic" type="text" id="nserie_mic" maxlength="14" /></label></td>
			<td>&nbsp;</td>
			<td><label><input name="nserie_cremoto" type="text" id="nserie_cremoto" maxlength="14" /></label></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Ubicacion</strong></td>
		</tr>
		<tr>
			<td colspan="3"><label><input type="text" id="ubicacion"/></label></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><label><input type="button" id="btnCrear" value="Agregar" onClick="javascript:nuevoTerminal();"/></label></td>
		</tr>
	</table>
</fieldset>
</div>
<div id="Resultado"></div>
<div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>