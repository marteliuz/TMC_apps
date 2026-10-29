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
<title>Asociar Terminal a Cliente</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
	#divTerminal {
	position:absolute;
	left:25px;
	top:25px;
	}
	#divTerminales1 {
	position:absolute;
	left:25px;
	top:75px;
	}
	#divContratos {
	position:absolute;
	left:450px;
	top:25px;
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

	<fieldset id="fldterminal">
		<table border="0">
			<tr>
				<td><strong>Seleccione un Terminal</strong></td>
				<td><strong>:</strong></td>
				<td><?php echo getCmbTerminalesHuerfanos('cmbTerminalesHuerfanos','showTerminalInfo()'); ?></td>
			</tr>
		</table>
	</fieldset>
</div>	
<div id="divTerminales1"></div>
<div id="resultado"></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>