<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
}else { 
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
?><head>
<meta content="290" http-equiv="REFRESH"> </meta>
<script type="text/javascript" language='javascript' src="fun_cotizacion.js"></script>
<div style="float: right"><img height="120" width="170"  src="logo Blanco.jpg"></div>
<div style="float: right"><a  id="cerrar" href="index.php"><img src="cerrar sesion.jpg" width="109" height="25" alt="cerrar sesion" longdesc="cerrar sesion.jpg" /></a></div>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script> 
miFecha = new Date() 
document.write(miFecha.getHours() + ":" + miFecha.getMinutes() + ":" + miFecha.getSeconds()) 
</script>

<style type="text/css">

#Step1 {
	position:absolute;
	left:20px;
	top:220px;
	width:100%;
	height:807px;
	z-index:1;
}

</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body link="#0000CC" alink="#0000CC" vlink="#0000CC">
	<table  width="1045" cellpadding="3" cellspacing="3">
    <tr>
    <td align= "right" width="636"><h1> ¡Bienvenido al sistema</h1></td>
    <td width="386" ><h1 style="color:#00C"><? echo $_SESSION['name']; ?>!</h1></td>
    </tr>
	</table>
<blockquote>
  	<table  width="604" cellpadding="3" cellspacing="3">
    <tr>
    <td width="20"><input type="radio" name="mantenedor" value="insertar" id="insertar" onClick="javascript:Step1()" /></td>
    <td width="226" >Ingresar Nuevo Equipo</td>
    <td width="62"></td>
    <td width="20"><input type="radio" name="mantenedor" value="actualizar" id="actualizar" onClick="javascript:Step1()"></td>
    <td width="226" >Modificar Equipos</td>
	<tr>
    <td width="20"><input type="radio" name="mantenedor" value="insertar2" id="insertar2" onClick="javascript:Step1()" /></td>
    <td width="226" >Ingresar Servicio Mantención</td>
	<td width="62"></td>
    <td><input type="radio" name="mantenedor" value="actualizar2" id="actualizar2" onClick="javascript:Step1()"></td>
    <td >Modificar Servicios de Mantención</td>
	<tr>
    <td width="20"><input type="radio" name="mantenedor" value="insertar3" id="insertar3" onClick="javascript:Step1()"></td>
    <td width="226">Ingresar Nuevo Valor Transporte</td>
    <td width="62"></td>
    <td><input type="radio" name="mantenedor" value="actualizar3" id="actualizar3" onClick="javascript:Step1()"></td>
    <td >Modificar Valores Transporte</td>
    </tr>
  </table>
</blockquote>

<div id="Step1"></div>
</body>
</html>
