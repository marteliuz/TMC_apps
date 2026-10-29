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
<title>Seguimiento de Estado Tickets</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		body {
		background-image: url(../resources/BackGround.png);
		background-repeat: no-repeat;
		font-size:12px;
		}
		#SrchBox {
		position:absolute;
		left:50px;
		top:50px;
		}
		#DatosTicket {
		position:absolute;
		left:50px;
		top:115px;
		}		
		-->
	</style>
</head>
<body>
<div id="SrchBox">
	<fieldset><legend>Introduzca el ID del Ticket y pulse Buscar</legend>
		<input type="text" name="id_srch" id="id_srch"/>
		<input type="button" name="btnSrch" id="btnSrch" value="Buscar" onclick="javascript:buscarTicket()"/>
	</fieldset>
</div>
<div id="DatosTicket"></div>
<div id="Resultado"></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>