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
<title>Terminales segun Cliente</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<script type="text/javascript" src="../js/datepickercontrol.js"></script> 
<link type="text/css" rel="stylesheet" href="../css/datepickercontrol.css"> 
<style type="text/css">
<!--
#form {
	position:absolute;
	top:25px;
	left:25px;	
}
#resultado{
	position:absolute;
	top:75px;
	left:25px;
}
#foot {
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
	Seleccione un cliente <?php echo getCmbClientes("cmbClientes","showAllTerminalesByCliente()");?>




<!-- <div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div> -->
</div>
<div id="resultado"></div>
<br><br><br><br>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>

