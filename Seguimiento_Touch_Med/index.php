<?php
session_start();
include_once "conexion.php";

function verificar_login($user,$password,&$result)
{
	$sql = "SELECT * FROM usuarios_venta WHERE usuario = '$user' and password = '$password'";
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
	}else{
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
			$_SESSION['correo'] = $result->correo;
			$_SESSION['rut'] = $result->rut;
			$_SESSION['tipo'] = $result->tipo;
				
		}if($_SESSION['tipo'] =="operaciones"){
				header("location:index1.php");}
				elseif($_SESSION['tipo'] =="comercial"){
					header("location:index2.php");}elseif($_SESSION['tipo'] =="jose"){
					header("location:index3.php");}else{
			echo "<font color= white>Su usuario o contraseña son incorrectos. Inténtelo nuevamente</font>";
			}
	}
}

	// $con = mysql_connect("localhost","root","Touchmedia");
	// mysql_set_charset('utf8');
	// mysql_select_db("inventario",$con);
	
	// $FechaActual = time();

	// $consulta = mysql_query("SELECT Fecha_Factura FROM facturacion");

	// $fila = mysql_fetch_array($consulta);

	// $FechaAnterior = mktime($fila['fecha']);

	// $compara = $FechaActual - $FechaAnterior;
	
	// echo $FechaAnterior;
	
	// if($compara >= 2592000 )
	// {
	// echo "hay facturas";
	// }
	// else
	// {
	// echo "NO hay facturas";
	// }
	
	
	// $qry1 = mysql_query("SELECT * FROM facturacion");

	
	// $num_rows = mysql_num_rows($qry1);
	
	// echo $num_rows;
	
	
	// echo "<table border=1 cellpadding=3 cellspacing=0>";
		 
// echo "<td width=400 align= center><B><font size=3>Fecha</font></B></td>";
// echo "</tr>";

// $reg	=mysql_fetch_array($qry1);
// {
// while($reg3['Fecha_Factura']){
	// echo "<td align= left<font size=1>".$reg["Fecha_Factura"]."</font></td>";
	// echo "</tr>";
// }
// echo "</table>";

// mysql_close($con);
// }
	
	// 
	
	// echo $reg3['ID_Facturacion'];
	// }}
	
	// echo $num_rows;
	// if($num_rows>0){
	
	// $qry2="SELECT * FROM usuarios_venta WHERE idusuario='10'";
	
	// $result2= mysql_query($qry2);
	// $reg2=mysql_fetch_array($result2);
	// $nombre2	= 	$reg2['nombre'];
	// $correo2	=	$reg2['correo'];

// mail("$correo2","Hay Facturas listas para ser cobradas","Estimada $nombre2: Hay algunas facturas que han cumplido los 30 días desde su facturacion, por lo que ya se puede dar inicio a la cobranza. Para mayor informacion ingrese a http://10.0.20.30/seguimiento. Saludos");

// }


// delimiter |

// CREATE EVENT e_daily
    // ON SCHEDULE
      // EVERY 1 DAY
    // COMMENT 'Verifica si pasaron los 30 dias desde que se facturo un proyecto'
    // DO
      // BEGIN
        // INSERT INTO site_activity.totals (time, total)
          // SELECT CURRENT_TIMESTAMP, COUNT(*)
            // FROM site_activity.sessions;
        // mail("$correo2","Hay Facturas listas para ser cobradas","Estimada $nombre2: Hay algunas facturas que han cumplido los 30 días desde su facturacion, por lo que ya se puede dar inicio a la cobranza. Para mayor informacion ingrese a http://10.0.20.30/seguimiento. Saludos");
      // END |

// delimiter ;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Seguimiento Ventas Touch Med</title>
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
	
	</style>
	<style type="text/css">
	.background {
    background-color: #FFFFFF;
    margin: 0px 0px 10px 0px;
	}
 </style>
 <style type="text/css">
	.trans {
    opacity: 1;
	}
	
	#img {

	position:absolute;
	left: 750px;
	top: 70px;
	}
	
	#text {

	position:absolute;
	left: 730px;
	top: 220px;
	}
</style>
</head>
<body bgcolor="#07C4D5" text="#FFFFFF" link="#8BACFF" alink="#8BACFF" vlink="#8BACFF">
<br><br><br><br>
		<div id="text"><table>
		<tr>
		<td><h1>Seguimiento</h1></td>
		<td><h2>TouchMed</h2></td>
		</tr>
		</table>
		</div>
		<div id=img><img src="touchmed-2.png" alt="tm" width="350" height="200"/>
	</div><br><br><br><br><br><br>
	<div id="headerh2" >
    <form name="frm" method="post">
		<table align="left" width="350" cellspacing="2" cellpadding="2" border="0" style="position:absolute;top:200px;left:45px;"> 
		<tr> 
			<td width=100><td>
			<td align="right"><input type="text" name="user" size="20" placeholder=" Usuario" onclick="borracampo()" onblur="restauracampo()"  value=" Usuario" title="Usuario" class="background trans"></td>
		</tr> 
		<tr> 
			<td width=100><td>
			<td align="right"><input placeholder=" Contraseña" size="20" title="Contraseña" type="text" name="fakepassword" id="fakepassword" value=" Contraseña" onfocus="pwdFocus()" class="background trans"/>
			<input placeholder=" Contraseña" style="display: none;" title="Contraseña" type="password" name="password" id="password" value="" onblur="pwdBlur()" class="background trans"/></td>
		</tr> 
		<tr> 
			<td width=100><td>
			<td colspan="2" align="left">
				<p><input name="Ingresar" type="image" value="Ingresar" src="boton_inicio_sesion2.png" class="boton" title="Iniciar sesión"/>
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
<div align=right><h5><B>Team Technologies &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><h5></div>
<div><h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
©2014 Derechos Reservados</h6></div>

</footer>