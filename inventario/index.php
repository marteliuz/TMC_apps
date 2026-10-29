<?php
session_start();
include_once "conexion.php";

function verificar_login($user,$password,&$result)
{
	$sql = "SELECT * FROM usuarios WHERE usuario = '$user' and password = '$password'";
	$rec = mysql_query($sql);
	$count = 0;
	while($row = mysql_fetch_object($rec))
	{
		$count++;
		$result = $row;
	}
	if($count == 1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

if(!isset($_SESSION['userid']))
{
	if(isset($_POST['Ingresar']))
	{
		if(verificar_login($_POST['user'],$_POST['password'],$result) == 1)
		{
			$_SESSION["autentica"] = "SIP";
			$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
			$_SESSION['userid'] = $result->idusuario;
			$_SESSION['username'] = $result->usuario;
			$_SESSION['name'] = $result->nombre;
			$_SESSION['type'] = $result->type;
			header("location:inicio.php");
		}
		else
		{
			echo "<font color= #8BACFF>Su usuario o contraseña son incorrectos. Inténtelo nuevamente</font>";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Inventario</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
	<script src="jquery.js" type="text/javascript"></script> 
	<script type="text/javascript">
	function borracampo(){
 if( document.frm.user.value == " Usuario")
   document.frm.user.value = ""
}

function restauracampo(){
 if( document.frm.user.value=="")
   document.frm.user.value=" Usuario"
 }
 	</script>
	<script type="text/javascript">

        function pwdFocus() {
            $('#fakepassword').hide();
            $('#password').show();
            $('#password').focus();
        }

        function pwdBlur() {
            if ($('#password').attr('value') == '') {
                $('#password').hide();
                $('#fakepassword').show();
            }
        }
    </script>
	<style type="text/css">
	hr.linea { 
	height: 1px;
	border: 0;
	color: #cc0000;
	background-color: #616161;
	width: 80%;
	} 
	</style>
</head>
<body bgcolor="#789600" text="#FFFFFF" link="#8BACFF" alink="#8BACFF" vlink="#8BACFF">
<br><br><br><br>
    <div="header">
		<table align="left" width="480" cellspacing="2" cellpadding="2" border="0" style="position:absolute;top:90px;left:125px;">
		<tr>
		<td><img src="tm2.png" alt="tm" height="50" width="50" /></td>
		<td><h1>Inventario</h1></td>
		<td><h2>Touch Media</h2></td>
		</tr>
		</table>
	</div><br><br><br><br><br><br>
	<div id="headerh2">
    <form name="frm" method="post">
		<table align="left" width="350" cellspacing="2" cellpadding="2" border="0" style="position:absolute;top:200px;left:45px;"> 
		<tr> 
			<td width=100><td>
			<td align="right"><input type="text" name="user" size="20" placeholder=" Usuario" onclick="borracampo()" onblur="restauracampo()"  value=" Usuario" title="Usuario"></td> <!-- style="background-color:#939393; border: 1px solid #444; font-size:12pt; color: #444"--> 
		</tr> 
		<tr> 
			<td width=100><td>
			<td align="right"><input placeholder=" Contraseña" size="20" title="Contraseña" type="text" name="fakepassword" id="fakepassword" value=" Contraseña" onfocus="pwdFocus()" /><!-- style="background-color:#939393; border: 1px solid #444; font-size:12pt; color: #444"--> 
			<input placeholder=" Contraseña" style="display: none;" title="Contraseña" type="password" name="password" id="password" value="" onblur="pwdBlur()" /></td><!-- style="background-color:#939393; border: 1px solid #444; font-size:12pt; color: #444"--> 
		</tr> 
		<tr> 
			<td width=100><td>
			<td colspan="2" align="left"><br>
				<p><input name="Ingresar" type="image" value="Ingresar" src="boton_inicio_sesion.png" class="boton" title="Iniciar sesión"/>
			</td>
		</tr>
		<tr>
			<td width=100><td>
			<td colspan="2" align="center">
				<p class='white'>¿No tienes cuenta? &nbsp;<a href="visitante.php" title="Ingresar sin cuenta">Ingresa como visitante</a>
			</p></td> 
		</tr> 
		</table>
	</form>
	</div>
</body>

</html>
<footer>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<HR class="linea">
<div align=right><h5><B>Gestión Audiovisual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><h5></div>
<div><h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
©2014 Derechos Reservados</h6></div>

</footer>