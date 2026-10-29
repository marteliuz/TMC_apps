<?php
include("config.php");
require("lib_functions.php");

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<div id="oculto"  style="float: right"><img src="../resources/boton-imprimir.jpg" class="imagen" alt="imprimir" width="91" height="27" style="cursor: pointer" longdesc="boton-imprimir.jpg" onclick="window.print();"></img></div><br><br>
<?php
if(isset($_SESSION['Usuario']))
{ 

$id        = $_GET['id'];


	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbtmedia", $con);
	
	 $result 	= mysql_query ("SELECT * FROM tbterminales WHERE contrato = $id");
	
	while($reg = mysql_fetch_array($result))
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ver Productos Clientes</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
	<!--
	#select {
	position:absolute;
	left:25px;
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
	</script>
	</head>
	
	<body>
	
	<fieldset id="productos"><legend>Productos con Mantención</legend>	
	<table width=400 border=0 cellpadding=5 cellspacing=0>
	<tr>
	<td align= left>Modelo</td>
	<td align= center><? echo getModeloById($reg['modelo']) ?></td>
	</tr>
	<tr>
	<td align= left>Nro de Serie</td>
	<td align= center><? echo $reg['nserie'] ?></td>
	</tr>
	<tr>
	<td align= left>Nro de Cámara</td>
	<td align= center><? echo $reg['nserie_camara'] ?></td>
	</tr>
	<tr>
	<td align= left>Nro de Micrófono</td>
	<td align= center><? echo $reg['nserie_mic'] ?></td>
	</tr>
	<tr>
	<td align= left>Nro de Control Remoto</td>
	<td align= center><? echo $reg['nserie_cremoto'] ?></td>
	</tr>
	<tr>
	<td align= left>Ubicación</td>
	<td align= center><? echo $reg['ubicacion'] ?></td>
	</tr>
	<?php
	
	$id			= $reg['contrato_polycom'];
	$result1 	= mysql_query ("SELECT * FROM tbcontratos_polycom WHERE $id = idtbcontratos_polycom");

	while($reg1 = mysql_fetch_array($result1))
	{
	?>
	<tr>
	<td align= left>Fecha Inicio Polycom</td>
	<td align= center><? echo date("d-m-Y", strtotime($reg1['fecha_inicio'])) ?></td>
	</tr>
	<tr>
	<td align= left>Fecha Término Polycom</td>
	<td align= center><? echo date("d-m-Y", strtotime($reg1['fecha_termino'])) ?></td>
	</tr>
	</table>
	</div>
	</fieldset>
<?php
}
}
?>
	
<?php
}
?>