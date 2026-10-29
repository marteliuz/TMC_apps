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
<title>Asociar Terminal a Contrato</title>
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

<table >
	<tr>
		<td>Paso 1:</td>
		<td width="48">&nbsp;</td>
		<td>Paso 2:</td>
		<td width="48">&nbsp;</td>
		<td>Paso 3:</td>
    </tr>
	<tr>
		<td>Seleccione un Cliente</td>
		<td>&nbsp;</td>
		<td>Seleccione un Terminal</td>
		<td>&nbsp;</td>
		<td>Seleccione un Contrato</td>
    </tr>
    <tr>
		<td><?php echo getCmbClientes('cmbClientes','showTerminalesByClientID()'); ?></td>
		<td>&nbsp;</td>
		<td><div id="divTerminales"></div></td>
		<td>&nbsp;</td>
		<td><div id="divContratos"></div></td>
    </tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><input type="button" value="Asociar" onClick="javascript:asociarTerminalContrato()"></td>
    </tr>
</table>


</div>
<div id="Resultado"></div>
<div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reservados.</p></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>