<?php
include("config.php");
session_start();
if(isset($_SESSION['Usuario']))
{ 
	$usuario = $_SESSION['Usuario'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exportar Tickets</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		body {
		background-image: url(../resources/BackGround.png);
		background-repeat: no-repeat;
		font-size:12px;
		}
		#combos {
		position:absolute;
		left:50px;
		top:50px;
		z-index:1;
		}
		-->
	</style>
</head>

<body>
	<div id="combos">
		<table>
			<tr>
				<td colspan="11" align="center"><strong>Filtros</strong></td>
			</tr>
			<tr>
				<td>Tipo</td>
				<td>:</td>
				<td><select name="cmbTipo" id="cmbTipo">
					<option value="all" selected="selected">Todos</option>
					<option value="1">Internos</option>
					<option value="2">Externos</option>
					</select></td>
				<td></td>
				<td>Estado</td>
				<td>:</td>
				<td><select name="cmbEstado" id="cmbEstado">
					<option value="all" selected="selected">Todos</option>
					<?php
					$qry = "SELECT idtbstatustickets as ID, descripcion FROM dbtmedia.tbstatustickets";
					$result = mysql_query($qry,$conexion);
					$cont   = mysql_num_rows($result);
					while($Reg = mysql_fetch_array($result))
					{
						echo "<option value='".$Reg['ID']."'>".$Reg['descripcion']."</option>";
					}
					?>
					</select></td>
				<td></td>
				<td>Cliente</td>
				<td>:</td>
				<td><select name="cmbCliente" id="cmbCliente">
					<option value="all" selected="selected">Todos</option>
					<?php
					$qry = "SELECT idtbclientes as ID, descripcion FROM dbtmedia.tbclientes";
					$result = mysql_query($qry,$conexion);
					$cont   = mysql_num_rows($result);
					while($Reg = mysql_fetch_array($result))
					{
						echo "<option value='".$Reg['ID']."'>".$Reg['descripcion']."</option>";
					}
					?>
					</select></td>
			</tr>
			<tr>
				<td colspan="11" align="center"><input type="button" id="btnExport" value="Exportar" onClick="javascript:crearQuery()"></td>
			</tr>
			
		</table>
	</div>
</body>
</html>
<?php
}else{ 
	// Usuario que no se ha logueado 
	//header("location:../errores/SinPermisos.php");
	echo "Usuario sin permisos.";
}
?>