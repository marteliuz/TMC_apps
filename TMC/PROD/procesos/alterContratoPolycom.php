<?php
include("config.php");
require("lib_functions.php");

session_start();
if(isset($_SESSION['Usuario']))
{ 
	$usuario = $_SESSION['Usuario'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Modificar Contratos Polycom</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
	<style type="text/css">
		<!--
		body {
		//background-image: url(../resources/BackGround.png);
		background-repeat: no-repeat;
		font-size:12px;
		}
		#tabla {
		position:absolute;
		left:50px;
		top:50px;
		}
		-->
	</style>
</head>
<body>
<?php
	$qry = "SELECT  t1.idtbcontratos_polycom,
					t1.id_terminal,
					t1.fecha_inicio,
					t1.fecha_termino,
					t1.descripcion,
					t2.nserie,
					t2.modelo,
					t2.cliente
			FROM dbtmedia.tbcontratos_polycom AS t1,
					dbtmedia.tbterminales AS t2
			WHERE t1.id_terminal = t2.idtbterminales";
	$result   = mysql_query($qry);
	$num_rows = mysql_num_rows($result);
	if($num_rows==0)
	{
		echo "No hay info que mostrar.";
	}else{
?>
<table id="tabla">
	<tr bgcolor="#999999">
		<td colspan="4" align="center">Contrato</td>
		<td colspan="5" align="center">Terminal</td>
	</tr>
	<tr bgcolor="#999999" align="center">
		<td>ID Contrato</td>
		<td>Fecha Inicio</td>
		<td>Fecha Termino</td>
		<td>Descripcion</td>
		<td>ID Terminal</td>
		<td>Nserie</td>
		<td>Modelo</td>
		<td>Cliente</td>
		<td>Editar</td>
	</tr>
<?php
		while($Reg = mysql_fetch_array($result))
		{
?>
		<tr>
			<td align="center"><?php echo $Reg['idtbcontratos_polycom']; ?></td>
			<td align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_inicio'])); ?></td>
			<td align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_termino'])); ?></td>
			<td align="center"><?php echo $Reg['descripcion']; ?></td>
			<td align="center"><?php echo $Reg['id_terminal']; ?></td>
			<td align="center"><?php echo $Reg['nserie']; ?></td>
			<td align="center"><?php echo getModeloById($Reg['modelo']); ?></td>
			<td align="center"><?php echo getClientNameById($Reg['cliente']); ?></td>
			<td align="center"><img src="../resources/edit.jpg" onclick="javascript:EditPolycom_PopUp('<?php echo $Reg['idtbcontratos_polycom']; ?>');" style="cursor:pointer"></td>
		</tr>
<?php
		}
	}
}
?>
</table>
</body>
</html>