<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
	<script src="js/jquery.js" type="text/javascript"></script> 
	<title>Tickets</title>
	<script type="text/javascript">
	function borracampo(){
 if( document.form1.User.value == " Usuario")
   document.form1.User.value = ""
}

function restauracampo(){
 if( document.form1.User.value=="")
   document.form1.User.value=" Usuario"
 }
 	</script>
	<script type="text/javascript">

        function pwdFocus() {
            $('#fakepassword').hide();
            $('#Pass').show();
            $('#Pass').focus();
        }

        function pwdBlur() {
            if ($('#Pass').attr('value') == '') {
                $('#Pass').hide();
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
<body bgcolor="#2E9AFE" text="#FFFFFF" link="#8BACFF" alink="#8BACFF" vlink="#8BACFF">
<br><br><br><br>
 <div="header">
		<table align="left" width="680" cellspacing="2" cellpadding="2" border="0" style="position:absolute;top:90px;left:125px;">
		<tr>
		<td><img src="resources/tm2.png" alt="tm" height="50" width="50" /></td>
		<td><h1>Control de Incidentes</h1></td>
		<td><h2>Touch Media</h2></td>
		</tr>
		</table>
	</div><br><br><br><br><br><br>
	<div id="headerh2">
    <form name="form1" method="post" action="procesos/checklogin.php">
		<table align="left" width="350" cellspacing="2" cellpadding="2" border="0" style="position:absolute;top:200px;left:45px;"> 
		<tr> 
			<td width=100><td>
			<td align="right"><input type="text" name="User" id="User" size="20" placeholder=" Usuario" onclick="borracampo()" onblur="restauracampo()" value=" Usuario" title="Usuario"></td> <!-- style="background-color:#939393; border: 1px solid #444; font-size:12pt; color: #444"--> 
		</tr> 
		<tr> 
			<td width=100><td>
			<td align="right"><input placeholder=" Contraseña" size="20" title="Contraseña" type="text" name="fakepassword" id="fakepassword" value=" Contraseña" onfocus="pwdFocus()" /><!-- style="background-color:#939393; border: 1px solid #444; font-size:12pt; color: #444"--> 
			<input placeholder=" Contraseña" style="display: none;" title="Contraseña" type="password" name="Pass" id="Pass" value="" onblur="pwdBlur()" /></td><!-- style="background-color:#939393; border: 1px solid #444; font-size:12pt; color: #444"--> 
		</tr> 
		<tr> 
			<td width=100><td>
			<td colspan="2" align="left"><br>
				<p><input name="BtLogin" id="BtLogin" type="image" value="Ingresar" src="resources/boton_inicio_sesion.png" class="boton" title="Iniciar sesión"/>
			</td>
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