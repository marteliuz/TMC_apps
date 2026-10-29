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
			echo "<font color= red>Su usuario o contraseña son incorrectos. Inténtelo nuevamente</font>";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>index</title>
	<STYLE> 
		A.clase1:link {font-size: 15px;} 
	</STYLE> 
<style type="text/css">
*{
    font-size: 17px;
}
form.login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 1px solid #DDDDDD;
    font-family: sans-serif;
    margin: 0 auto;
    padding: 20px;
    width: 278px;
}
form.login div {
    margin-bottom: 30px;
    overflow: hidden;
}
form.login div label {
    display: block;
    float: left;
    line-height: 25px;
}
form.login div input[type="text"], form.login div input[type="password"] {
    border: 1px solid #DCDCDC;
    float: right;
    padding: 4px;
}
form.login div input[type="submit"] {
    background: none repeat scroll 0 0 #DEDEDE;
    border: 1px solid #C6C6C6;
    float: right;
    font-weight: bold;
    padding: 4px 20px;
}
.error{
    color: red;
    font-weight: bold;
    margin: 10px;
    text-align: center;
}
#letra {

position:absolute;
right: 360px;
left: 550px;
top: 630px;
font-size:10px
}
</style>
</head>
<body bgcolor="#010404" text="#FFFFFF" link="#33FFFF" alink="#FFFFFF" vlink="#33FFFF">
    <p align="center" style="font-size: 40px; line-height: normal;"><img src="t negro.jpg" alt="tm" height="220" width="230" /></p>
    <p align="center" style="font-size: 40px; line-height: normal;">Inventario Touch Media</p>
	<p id="letra">©Touch Media Consulting Ltda. Todos los Derechos Reservados</p>
    <form method="post">
		<table align="center" width="225" cellspacing="2" cellpadding="2" border="0"> 
		<tr> 
			<td align="right"> Usuario</td>  <td><input name="user" type="text" class="textbox1" value=""></td> 
		</tr> 
		<tr> 
			<td align="right">Contraseña </td> <td><input name="password" type="password" class="textbox1"></td> 
		</tr> 
		<tr> 
			<td colspan="2" align="center">
				<p><input name="Ingresar" type="image" value="Ingresar" src="boton-ingresar.png" width="130" height="35"border="0" /></p>
				<p>&nbsp;</p>
				<p><a href="visitante.php">Entrar como visitante</a>
				</h3>
				</p></td> 
		</tr> 
		</table>
	</form>
</body>
</html>