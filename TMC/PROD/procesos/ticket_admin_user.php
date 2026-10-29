<?php
require('config.php');
require("lib_functions.php");
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nuevo Ticket de Admin</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		#formTicket {
		position:absolute;
		left:25px;
		top:25px;
		}
		#tbFecha {
		width:800px;
		}
		#tbContacto {
		width:800px;
		}
		#tbTerminal {
		width:800px;
		}
		#resultado {
		position:absolute;
		left:875px;
		top:30px;
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
<div id="formTicket">
	<fieldset id="fldContacto"><legend>Datos de Contacto</legend>
	    <table id="tbFecha">
			<tr>
				<td width="250">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="250">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="250" align="center"><input name="fecha_creacion" type="text" disabled="disabled" id="fecha_creacion" value="<?php echo getNow(); ?> "/></td>
			</tr>
		</table>
		
		<table>
			<tr>
				<td>Seleccione un Cliente</td>
				<td><?php getCmbClientes('cmbClientes','loadClientInfoByClientId()'); ?></td>
			</tr>
		</table>
		
		<div id="InfoCliente"></div>
	</fieldset>
	<div id="divInfoTerminal"></div>
</div>
<div id="resultado"></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>