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
<title>Registro de Usuarios</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		body {
		background-image: url(../resources/BackGround.png);
		background-repeat: no-repeat;
		font-size:12px;
		}
		#UnUsuario {
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
<div id="UnUsuario">
	<form name="form1" method="post" action="">
		<table width="313" border="0">
			<tr>
				<td width="142"><strong>Nombre de usuario</strong></td>
				<td width="3" align="center">:</td>    
				<td width="146"><input type="text" name="username" id="username" /></td>
			</tr>
			<tr>
				<td><strong>Contrase&ntildea</strong></td>
				<td align="center">:</td>     
				<td width="146"><input type="text" name="password" id="password" /></td>
			</tr>
			<tr>
				<td><strong>Repita Contrase&ntildea</strong></td>
				<td align="center">:</td>        
				<td><input type="text" name="Rpassword" id="Rpassword" /></td>
			</tr>
			<tr>
				<td><strong>Nombre real</strong></td>
				<td align="center">:</td>        
				<td><input type="text" name="name" id="name" /></td>
			</tr>
			<tr>
				<td><strong>Cliente</strong></td>
				<td align="center">:</td>
				<td><select name="cliente" id="cliente">
					<?php
						$qry = "SELECT idtbclientes as ID, descripcion as descripcion FROM dbtmedia.tbclientes";
						$result = mysql_query($qry,$conexion);
						$cont   = mysql_num_rows($result);
						
						if($cont==0)
						{
							echo "<option>vacio</option>";
						}else{
							while($Reg = mysql_fetch_array($result))
							{
								echo "<option value='".$Reg['ID']."'>".$Reg['descripcion']."</option>";
							}
						}
					?>
				</select></td>
			</tr>
			
			<tr>
				<td><strong>Privilegios.</strong></td>
				<td align="center">:</td>    
				<td align="center">
					<table width="200">
						<tr>
							<td align="left"><input type="radio" name="usertype" value="1" id="admin"/>Admin</td>
						</tr>
						<tr>
							<td align="left"><input type="radio" name="usertype" value="2" id="clte" Checked />Cliente</td>
						</tr>
					</table>
				</td>
			</tr>
			
			
			<tr>
				<td align="center" colspan="2"><input type="reset" name="reset" id="reset" value="Limpiar" onclick="javascript:LimpiarFormUsuario()"/></td>
				<td align="center"><input type="button" name="crear" id="crear" value="Crear" onclick="javascript:InsertUsuario()"/></td>
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