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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nuevo Usuario</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<style type="text/css">
	<!--
	#nuevousuario {
	position:absolute;
	left:25px;
	top:25px;
	}
	#resultado {
	position:absolute;
	left:515px;
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
<div id="nuevousuario">
	<fieldset id="fldusuario"><legend>Datos del usuario</legend>
	<table id="tbusuario">
		<tr >
			<td width="200"><strong>Nombre</strong></td>
			<td width="20"></td>
			<td width="200"></td>
	    </tr>
		<tr nowrap="nowrap">
			<td colspan="3"><input type="text" name="nomb_usuario" id="nomb_usuario" style="width:100%" onkeypress="return soloLetras(event)"/></td>
		</tr>
		<tr>
			<td><strong>Username</strong></td>
			<td></td>
			<td><strong>Email</strong></td>
	    </tr>
		<tr>
			<td><input type="text" name="username" id="username" /></td>
			<td></td>
			<td><input type="text" name="email" id="email" style="width:100%"/></td>
	    </tr>
		<tr>
			<td><strong>Password</strong></td>
			<td rowspan="4"><div id="checkpass"></div></td>
			<td></td>
	    </tr>
		<tr>
			<td><input type="text" name="password" id="password" /></td>
			<td></td>
	    </tr>
		<tr>
			<td><strong>Repite Password</strong></td>
			<td></td>
	    </tr>
		<tr>
			<td><input type="text" name="password2" id="password2" /></td>
			<td></td>
	    </tr>
		<tr>
			<td><strong>Privilegios</strong></td>
			<td></td>
			<td rowspan="2"><div id="cliente" style="visibility:hidden"><?php echo getCmbClientes("cmbClientes",null); ?> </div></td>
	    </tr>
		<tr>
			<td><p><label><input type="radio" name="RadioGroup" value="1" id="RadioGroup_0" onclick="javascript:hideDiv('cliente')" checked="checked"/>Administrador</label><br />
				   <label><input type="radio" name="RadioGroup" value="2" id="RadioGroup_1" onclick="javascript:showDiv('cliente')"/>Cliente</label><br /></p>
			</td>
			<td></td>
	    </tr>
		<tr>
			<td colspan="3"></td>
	    </tr>
		<tr>
			<td colspan="3" align="center"><input type="button" name="btnCrear" id="btnCrear" value="Crear Usuario" onclick="javascript:InsertUsuario()"/></td>
	    </tr>
	</table>
	</fieldset>
</div>
<div id="resultado"></div>
<div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p>
								  <p>2012 Derechos Reervados.</p>
								  <p>Uso exclusivo e interno de Touchmedia Consulting Ltda.</p></div>
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>