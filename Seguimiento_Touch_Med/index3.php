<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();}else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 300) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      header("Location: index.php"); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
} 
 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seguimiento Ventas</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<script type="text/javascript">
       window.onbeforeunload = function Aviso(){
            return "Está saliendo de la página o han caducado sus 5 minutos";
           header("Location: logout.php");
		  
        }
</script>
<script> 
miFecha = new Date() 
document.write(miFecha.getHours() + ":" + miFecha.getMinutes() + ":" + miFecha.getSeconds()) 
</script>
<STYLE> 
A.clase1:link {font-size: 15px;} 
</STYLE> 

</head>

 <style type="text/css">
#titulo {

position:absolute;
left: 20px;
top: 100px;
}

#img {

	position:absolute;
	left: 75px;
	top: 70px;
	}

#botones {

position:absolute;
left: 100px;
top: 350px;
}

hr.linea { 
	height: 1px;
	border: 0;
	color: #cc0000;
	background-color: #616161;
	width: 80%;
	} 
	
	
	#text {

	position:absolute;
	left: 50px;
	top: 220px;
	}
</style>
<div style="float: right"><a  id="cerrar" href="logout.php"><img src="cerrar_sesion2.png" alt="cerrar sesion" longdesc="cerrar_sesion.png" /></img></a></div>
<br><br><br>
<body onunload="Aviso" bgcolor="#07C4D5" text="#FFFFFF" link="#33FFFF" alink="#FFFFFF" vlink="#33FFFF">

		<div id="text"><table>
		<tr>
		<td><h1>Seguimiento</h1></td>
		<td><h2>Facturación</h2></td>
		</tr>
		</table>
		</div>
		
	   <div id=img><img src="touchmed-2.png" alt="tm" width="350" height="200"/></div>

<form>
		<table id=botones align="center" cellspacing="100" cellpadding="2" border="0">
		<td align="Center">
		<td align="center"><div id="factura"><img width="150" src="ingresar_factura2.png" style="CURSOR:hand" name="factura" type="button" id="factura" onclick = "window.open('factura.php', 'Factura','status = 1, height = 320, width = 760, scrollbars=1, resizable = 0' )"/><div>
		<td width=220></td>
		<td align="center"><div id="seguimiento"><img width="150" src="seguimiento_venta2.png" style="CURSOR:hand" name="seguimiento" type="button" id="seguimiento" onclick = "location='seguimiento1.php'"/><div>
		<td align="center"> 
		</table>
</form>
</body>

<footer>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<HR class="linea">
<div align=right><h5><B>Team Technologies &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><h5></div>
<div><h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
©2014 Derechos Reservados</h6></div>

</footer>