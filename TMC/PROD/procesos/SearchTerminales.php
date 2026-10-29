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
<title>Buscar Terminales</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		#SrchBox {
		position:absolute;
		left:50px;
		top:50px;
		}
		#DatosTerminal {
		position:absolute;
		left:50px;
		top:115px;
		}
		#Resultado {
		position:absolute;
		left:50px;
		top:405px;
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
<table>
	<tr>
		<td width="280" align="center"><label><input type="radio" name="radio" id="op1" value="op1"  onclick="javascript:changeSearchMode('BySN','ByCliente')" checked="checked"/>Busqueda por S/N</label></td>
		<td width="280" align="center"><label><input type="radio" name="radio" id="op2" value="op2" onclick="javascript:changeSearchMode('BySN','ByCliente')" />Busqueda por Cliente</label></td>
	</tr>
	<tr>
		<td align="center">
			<div id="BySN"><fieldset><legend>Introduzca el S/N y pulse Buscar</legend>
								<input type="text" name="nserie_srch" id="nserie_srch" maxlength="20"/>
								<input type="button" name="btnSrch" id="btnSrch" value="Buscar" onclick="javascript:buscarTerminal()"/>
						   </fieldset>
			</div>
		</td>
		<td align="center">
			<div id="ByCliente" style="visibility:hidden"><fieldset><legend>Seleccione un cliente</legend>
									<?php echo getCmbClientes("cmbClientes","showAllTerminalesByCliente()");?>
								</fieldset>
			</div>
		</td>
	</tr>
</table>
<div id="resultado" align="center"></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>