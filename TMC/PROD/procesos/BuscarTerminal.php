<?php
include("config.php");
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
<div id="SrchBox">
	<fieldset><legend>Introduzca el S/N y pulse Buscar</legend>
		<input type="text" name="nserie_srch" id="nserie_srch" maxlength="16"/>
		<input type="button" name="btnSrch" id="btnSrch" value="Buscar" onclick="javascript:buscarTerminal()"/>
	</fieldset>
</div>
<div id="DatosTerminal"></div>
<div id="Resultado"></div>

<div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>