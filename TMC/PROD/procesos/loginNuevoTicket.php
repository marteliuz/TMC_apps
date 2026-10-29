<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Acceso clientes</title>
    <link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
</head>
<style type="text/css">
<!--
body {
	background-color:#0C0304;
}
#logo {
	position:absolute;
	top:25px;
	left:100px;
}
#title {
	position:absolute;
	top:150px;
	left:400px;
	font:"Century Gothic";
	font-size:36px;
	font-family: Arial,Helvetica,sans-serif;
	color:#999;
}
#form1{
	position:absolute;
	top:300px;
	left:150px;
	font:"Century Gothic";
	font-size:14px;
	font-family: Arial,Helvetica,sans-serif;
	color:#CCC;
}
#footer {
	position:fixed;
	left:100px;
	bottom: 0;
	width: 100%;
}
-->
</style>
	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
	
<body>
<div id="logo"><a href="http://www.touchmedia.cl"><img src="../resources/logo_touchmedia.png" width="250" height="150" /></a></div>
<div id="title">Bienvenido al Control de Incidentes</div>

<form name="form1" id="form1" method="post">
	<table width="400">
	<tr>
		<td>Usuarios No Registrados</td>
		<td width="25">&nbsp;</td>
		<td colspan="2" align="center">Usuarios Registrados</td>
    </tr>
	<tr>
		<td rowspan="3" align="center"><label><input type="button" name="button" id="button" value="Ingresar" class="boton" onclick="window.location.href='../procesos/nuevoTicket.php'"/></label></td>
		<td>&nbsp;</td>
		<td>usuario</td>
		<td><input name="User" type="text" id="User"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>contraseña</td>
		<td><input name="Pass" type="password" id="Pass"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center"><input type="button" name="BtLogin" id="BtLogin" value="Login" onclick="javascript:checkLogin()"/></td>
	</tr>
	</table>
</form>
</body>

<div id="divResultado"></div>

<table id="footer">
	<tbody>
	<tr>
		<td>
			<p><span><span style="color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left; background-color: #0c0304;">Valentín Letelier 1373 Oficina 705 Santiago Chile. <br />Teléfonos +56 2 (6964016)&nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">&nbsp;(6964051) &nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">(6964057) &nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2&nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">(6964031)&nbsp;</span></span></p>
			<p><span style="color: #8b8077; font-family: Arial,Helvetica,sans-serif; font-size: 11px; line-height: 17px; text-align: left; background-color: #0c0304;"><span>Soporte y Post Venta&nbsp;Todos los derechechos reservados a touchmedia.cl</span> <br /></span></p>
		</td>
		<td><img alt="solologos" src="../resources/solologos.png" height="84" width="400" /></td>
	</tr>
	<tr>
		<td colspan="2">Sitio optimizado para <img src="../resources/browser.png"></td>
	</tr>
	</tbody>
</table>
</html>