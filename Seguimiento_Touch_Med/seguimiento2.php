<META HTTP-EQUIV="REFRESH" CONTENT="200;URL=logout.php">
<script type="text/javascript">
       window.onbeforeunload = function Aviso(){
            return "Está saliendo de la página o han caducado sus 5 minutos";
           header("Location: logout.php");
		  
        }
</script>
<body onunload="Aviso">
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
      header("Location: logout.php"); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
} 

include ("libreria.php");

if( isset($_POST['where']) === true ){
$where		= stripslashes($_POST['where']);
	
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry = "SELECT * FROM facturacion ".$where." AND ID_Facturacion>'0' ORDER BY Fecha_Orden_Compra" ; 

$result = mysql_query($qry);


$var = mysql_affected_rows();
	if ($var>0){
	$numero = mysql_num_rows($result);
	?>
<html>    
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<style type="text/css">
.fila_0 { background-color: ;}
.fila_1 { background-color: #D3EDFF;}
</style>
</head>
<body text=black>
<div id= "filtro">
    <form name="form1" method="post">
    <table width="1500" cellpadding="3" cellspacing="3">
    <tr>
    <td width="1237"><?php echo"<h2 style=color:#0073c4>Seguimiento de Ventas</h2>"?></td>
    <td width="240"><a  id="atrás" href="index2.php"><img src="boton_atras.png" alt="atras" longdesc="boton_atras1.jpg" /></img></a></td>
    </tr>
    <table width="1500" cellpadding="3" cellspacing="3">
    <tr>
    <td width="70"><B><font size=2>Filtrar por: </font></B></td>
    <td width="501"><font size=2>Nombre Empresa <?php Cliente_Ver_Combo1()?></font></td>
    <td width="192"><font size=2>Rut Empresa <?php Ver_Rut(); ?></font></td>
    <td width="701"><font size=2>Rut Vendedor <?php Ver_Vendedor1(); ?></font></td>
    </tr>
  	<table width="1500" cellpadding="3" cellspacing="3">
    <tr>
    <td width="65"></td>
     <td width="239"><font size=2>Situación Cotización: <?php Situacion_Cotizacion1() ?></font></td>
    <td width="330"><font size=2>Situación Orden de Compra: <?php Situacion_Compra1() ?></font></td>
    <td width="386"><font size=2>Situación Factura: <?php Situacion_Factura1() ?></font></td>
	<td width="54"><a href='#' title="enviar" onClick="javascript:filtrarcom()"><img src='enviar.png'></a></td>
    <td width="52"><img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
    <td width="93"><a href='#' title="enviar" onClick="javascript:mostrarcom()"><img src='mostrar_todo.png'></a></td>
    <td width="231">Total <font color=red><?php echo $numero?></font></td>
	
	</table>
    </form> 

	<form name="form2" method="post">
		<table width=3000 border=1 cellpadding=3 cellspacing=0>
		 
<td width="18" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>ID</font></B></td>
<td width="18" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="56" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nombre Empresa</font></B></td>
<td width="80" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Rut Empresa</font></B></td>
<td width="59" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nro Cotización</font></B></td>
<td width="66" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Fecha Cotización</font></B></td>
<td width="70" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Situación Cotización</font></B></td>
<td width="72" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Descargar Cotización</font></B></td>
<td width="55" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nro Orden Compra</font></B></td>
<td width="49" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Fecha Orden Compra</font></B></td>
<td width="72" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Situación Orden Compra</font></B></td>
<td width="77" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Descargar Orden Compra</font></B></td>
<td width="77" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="46" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nro Factura</font></B></td>
<td width="49" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Fecha Factura</font></B></td>
<td width="63" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Situación Factura</font></B></td>
<td width="69" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Descargar Factura</font></B></td>
<td width="69" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Tipo Moneda</font></B></td>
<td width="34" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Monto</font></B></td>
<td width="52" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Vendedor</font></B></td>
<td width="57" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nombre Contacto</font></B></td>
<td width="56" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Correo Contacto</font></B></td>
<td width="59" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Teléfono Contacto</font></B></td>
<td width="200" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Dirección Instalación</font></B></td>
<td width="62" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="62" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="66" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
</tr>
<?php
$i = 0 ;
	$reg = mysql_fetch_array($result, MYSQL_BOTH);
	
	{
		 while($reg)
{
	$formato_precio  = number_format($reg['Monto'],  2,  ',',  '.');
	
	?> 
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["ID_Facturacion"] ?></font></td>
<td class="fila_<?php echo $i%2; ?>"> <a href=javascript:poponload(<?php echo $reg["ID_Facturacion"] ?>)>Editar</a></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nombre_Empresa"] ?></font></td>
<td width="84" align= center><font size=2><?php echo $reg["Rut_Empresa"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nro_Cotizacion"]?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg["Fecha_Cotizacion"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php Situacion_Cotizacion('situacion_cotizacion'.$reg["ID_Facturacion"],$reg["Situacion_Cotizacion"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo leer_archivo($reg["Nro_Cotizacion"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nro_Orden_Compra"]?></font></td>
<td align= center width="80" class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg["Fecha_Orden_Compra"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php Situacion_Orden_Compra('situacion_orden_compra'.$reg["ID_Facturacion"],$reg["Situacion_Orden_Compra"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo leer_archivo($reg["Nro_Orden_Compra"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Nro_Factura']?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg["Fecha_Factura"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php Situacion_Factura('situacion_factura'.$reg["ID_Facturacion"],$reg["Situacion_Factura"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo leer_archivo($reg["Nro_Factura"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Tipo_Moneda($reg["Tipo_Moneda"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $formato_precio?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Seguimiento_Vendedor($reg["Vendedor"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Nombre_Contacto']?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Correo_Contacto']?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Telefono_Contacto']?></font></td>
<td align= center width="100" class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Direccion']?></font></td>
<td align= center width="100" class="fila_<?php echo $i%2; ?>"><font size=2><a href='#' title="Detalles" onClick="window.open('rechazado.php?id=<?php echo $reg["ID_Facturacion"] ?>', 'Detalles','status = 1, height = 300, width = 700, scrollbars=1, resizable = 0')"><img src='detalles.png'></a></font></td>
<td class="fila_<?php echo $i%2; ?>"><a href='#' title="Guardar" onClick="javascript:seguimiento('<?php echo $reg['ID_Facturacion'];?>')"><img src='guardar.png'></a></td>
<td class="fila_<?php echo $i%2; ?>"><img src="borrar.png" onclick="document.form2.reset()" style="CURSOR:hand" title="borrar"></td>
</tr>
<?php
$i ++;
$reg = mysql_fetch_array($result, MYSQL_BOTH);

	}
mysql_close($con);	
}
?>
</table>
</form>
</div>
</body>
</html>
<?php
}else{echo("<br>"."<br>"."<B><font size=4 color=#FF0000>No se han encontrado resultados</font></B>");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  id="atrás" href="seguimiento2.php"><img src="boton_atras.png" alt="atras" longdesc="boton_atras1.jpg" /></img></a> <?php ; }
}
elseif( isset($_POST['where']) === false ){
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)	
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$result = mysql_query ("SELECT * FROM facturacion WHERE ID_Facturacion>'0' ORDER BY Fecha_Orden_Compra");
  
  	$numero = mysql_num_rows($result);

	?>
<html>  
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<style type="text/css">
.fila_0 { background-color: ;}
.fila_1 { background-color: #D3EDFF;}
</style>
</head>
<body text=black>
<div id= "normal">
    <form name="form1" method="post">
    <table width="1500" cellpadding="3" cellspacing="3">
    <tr>
    <td width="1237"><?php echo"<h2 style=color:#0073c4>Seguimiento de Ventas</h2>"?></td>
    <td width="240"><a  id="atrás" href="index2.php"><img src="boton_atras.png" alt="atras" longdesc="boton_atras1.jpg" /></img></a></td>
    </tr>
    <table width="1500" cellpadding="3" cellspacing="3">
    <tr>
    <td width="70"><B><font size=2>Filtrar por: </font></B></td>
    <td width="501"><font size=2>Nombre Empresa <?php Cliente_Ver_Combo1()?></font></td>
    <td width="192"><font size=2>Rut Empresa <?php Ver_Rut(); ?></font></td>
    <td width="701"><font size=2>Rut Vendedor <?php Ver_Vendedor1(); ?></font></td>
    </tr>
  	<table width="1500" cellpadding="3" cellspacing="3">
    <tr>
    <td width="65"></td>
     <td width="239"><font size=2>Situación Cotización: <?php Situacion_Cotizacion1() ?></font></td>
    <td width="330"><font size=2>Situación Orden de Compra: <?php Situacion_Compra1() ?></font></td>
    <td width="386"><font size=2>Situación Factura: <?php Situacion_Factura1() ?></font></td>
	<td width="54"><a href='#' title="enviar" onClick="javascript:filtrarcom();"><img src='enviar.png'></a></td>
    <td width="52"><img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
    <td width="93"><a href='#' title="enviar" onClick="javascript:mostrarcom()"><img src='mostrar_todo.png'></a></td>
    <td width="231">Total <font color=red><?php echo $numero?></font></td>
    
	</table>
    </form> 

	<form name="form2" method="post">
		<table width=3000 border=1 cellpadding=3 cellspacing=0>
		 
<td width="18" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>ID</font></B></td>
<td width="18" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="56" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nombre Empresa</font></B></td>
<td width="80" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Rut Empresa</font></B></td>
<td width="59" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nro Cotización</font></B></td>
<td width="66" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Fecha Cotización</font></B></td>
<td width="70" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Situación Cotización</font></B></td>
<td width="72" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Descargar Cotización</font></B></td>
<td width="55" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nro Orden Compra</font></B></td>
<td width="49" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Fecha Orden Compra</font></B></td>
<td width="72" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Situación Orden Compra</font></B></td>
<td width="77" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Descargar Orden Compra</font></B></td>
<td width="77" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="46" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nro Factura</font></B></td>
<td width="49" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Fecha Factura</font></B></td>
<td width="63" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Situación Factura</font></B></td>
<td width="69" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Descargar Factura</font></B></td>
<td width="69" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Tipo Moneda</font></B></td>
<td width="34" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Monto</font></B></td>
<td width="52" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Vendedor</font></B></td>
<td width="57" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Nombre Contacto</font></B></td>
<td width="56" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Correo Contacto</font></B></td>
<td width="59" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Teléfono Contacto</font></B></td>
<td width="200" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2>Dirección Instalación</font></B></td>
<td width="62" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="62" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
<td width="66" bgcolor='#0073c4' align= center><B><font color=#FFFFF size=2></font></B></td>
</tr>
<?php
$i = 0 ;
	$reg = mysql_fetch_array($result, MYSQL_BOTH);
	
	{
		 while($reg)
{
	$formato_precio  = number_format($reg['Monto'],  2,  ',',  '.');
	?> 
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["ID_Facturacion"] ?></font></td>
<td class="fila_<?php echo $i%2; ?>"> <a href=javascript:poponload(<?php echo $reg["ID_Facturacion"] ?>)><font size=2>Editar</font></a></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nombre_Empresa"] ?></font></td>
<td width="84" align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Rut_Empresa"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nro_Cotizacion"]?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg["Fecha_Cotizacion"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php Situacion_Cotizacion('situacion_cotizacion'.$reg["ID_Facturacion"],$reg["Situacion_Cotizacion"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo leer_archivo($reg["Nro_Cotizacion"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nro_Orden_Compra"]?></font></td>
<td align= center width="80" class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg["Fecha_Orden_Compra"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php Situacion_Orden_Compra('situacion_orden_compra'.$reg["ID_Facturacion"],$reg["Situacion_Orden_Compra"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo leer_archivo($reg["Nro_Orden_Compra"])?></font></td>
<td align= center width="100" class="fila_<?php echo $i%2; ?>"> <a href=javascript:poponloadfact(<?php echo $reg["ID_Facturacion"] ?>)><font size=2>Subir Factura</font></a></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Nro_Factura']?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg["Fecha_Factura"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php Situacion_Factura('situacion_factura'.$reg["ID_Facturacion"],$reg["Situacion_Factura"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo leer_archivo($reg["Nro_Factura"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Tipo_Moneda($reg["Tipo_Moneda"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $formato_precio?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Seguimiento_Vendedor($reg["Vendedor"])?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Nombre_Contacto']?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Correo_Contacto']?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Telefono_Contacto']?></font></td>
<td align= center width="100" class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg['Direccion']?></font></td>
<td align= center width="100" class="fila_<?php echo $i%2; ?>"><font size=2><a href='#' title="Detalles" onClick="window.open('rechazado.php?id=<?php echo $reg["ID_Facturacion"] ?>', 'Detalles','status = 1, height = 300, width = 700, scrollbars=1, resizable = 0')"><img src='detalles.png'></a></font></td>
<td class="fila_<?php echo $i%2; ?>"><a href='#' title="Guardar" onClick="javascript:seguimiento('<?php echo $reg['ID_Facturacion'];?>')"><img src='guardar.png'></a></td>
<td class="fila_<?php echo $i%2; ?>"><img src="borrar.png" onclick="document.form2.reset()" style="CURSOR:hand" title="borrar"></td>
</tr>
<?php
$i ++;
$reg = mysql_fetch_array($result, MYSQL_BOTH);
}
	mysql_close($con);
	}
?>
</table>
</form>
</div>
</body>
</html>
<?php
}
?>