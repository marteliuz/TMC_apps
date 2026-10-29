<?php
include("config.php");
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registro de Clientes</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		body {
		background-image: url(../resources/BackGround.png);
		background-repeat: no-repeat;
		font-size:12px;
		}
		#unCliente {
		position:absolute;
		left:50px;
		top:150px;
		z-index:1;
		}
		#UnContainer {
		position:absolute;
		left:450px;
		top:150px;
		z-index:1;
		}		
		-->
	</style>
</head>

<body>
<div id="unCliente">
	<form name="form1" method="post" action="">
		<table width="313" border="0">
			<tr>
				<td width="142"><strong>Nombre de cliente</strong></td>
				<td width="3" align="center">:</td>    
				<td width="146"><input type="text" name="nombre" id="nombre" /></td>
			</tr>
			<tr>
				<td><strong>Nombre de contacto</strong></td>
				<td align="center">:</td>     
				<td width="146"><input type="text" name="contacto" id="contacto" /></td>
			</tr>
			<tr>
				<td><strong>Email contacto</strong></td>
				<td align="center">:</td>     
				<td width="146"><input type="text" name="email" id="email" /></td>
			</tr>
			<tr>
				<td><strong>Telefono contacto</strong></td>
				<td align="center">:</td>        
				<td><input type="text" name="telefono" id="telefono" /></td>
			</tr>
			<tr>
				<td><strong>Direcci&oacuten</strong></td>
				<td align="center">:</td>        
				<td><input type="text" name="direccion" id="direccion" /></td>
			</tr>
			<tr>
				<td><strong>Regi&oacuten</strong></td>
				<td align="center">:</td>
				<td><select name="region" id="region">
					<?php
						$qry = "SELECT * FROM dbtmedia.tbregiones";
						$result = mysql_query($qry,$conexion);
						$cont   = mysql_num_rows($result);
						
						if($cont==0)
						{
							echo "<option>vacio</option>";
						}else{
							while($Reg = mysql_fetch_array($result))
							{
								echo "<option value='".$Reg['idtbregiones']."'>".$Reg['descripcion']."</option>";
							}
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td align="center" colspan="3"><br><input type="button" name="crear" id="crear" value="Crear" onclick="javascript:InsertCliente()"/></td>
			</tr>
		</table>
	</form>
</div>
<div id="UnContainer">
</div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>