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

include ("libreria.php");

$id        = $_GET['id'];
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);

$result= mysql_query("SELECT * FROM facturacion WHERE ID_Facturacion='$id'", $con);

 
$data=mysql_fetch_array($result);

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='fun_seg.js'></script>
<script language='javascript' src='popcalendar.js'></script>
</head>
<body>
<form method="post" action="subir_editar.php" enctype="multipart/form-data">
<table> 
<tr><td width="155">ID</td><td width="258"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $id?>" /></td></tr>
<tr><td>Nombre Empresa</td><td><input type="text" name="empresa" id="empresa" style="WIDTH: 350px; HEIGHT: 22px" maxlength="50" value="<?php echo $data["Nombre_Empresa"]?>" /></td></tr>
<tr><td>Rut Empresa</td><td><input type="text" name="rut" id="rut" onkeypress="return soloLetras(event)" maxlength="15" value="<?php echo $data["Rut_Empresa"]?>" /></td></tr>
<tr><td>Nro Cotización</td><td><input type="text" name="cotizacion" id="cotizacion" style="WIDTH: 350px; HEIGHT: 22px" maxlength="50" value="<?php echo $data["Nro_Cotizacion"]?>" /></td></tr>
<tr><td>Fecha Cotización</td><td><input type="text" name="fecha" id="fecha" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Cotizacion']) ?>" /></td></tr>
<tr><td>Cambiar Cotización</td><td><input type="file" name="arcotizacion" id="arcotizacion"></td></tr>
<tr><td>Nro Orden Compra</td><td><input type="text" name="orden" id="orden" maxlength="50" value="<?php echo $data["Nro_Orden_Compra"]?>" /></td></tr>
<tr><td>Fecha Orden Compra</td><td><input type="text" name="fecha1" id="fecha1" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Orden_Compra']) ?>" /></td></tr>
<tr><td>Cambiar Orden Compra</td><td><input type="file" name="arorden" id="arorden"></td></tr>
<tr><td>Nro Factura</td><td><input type="text" name="factura" id="factura" onkeypress="return soloLetras(event)" maxlength="8" value="<?php echo $data["Nro_Factura"]?>" /></td></tr>
<tr><td>Fecha Factura</td><td><input type="text" name="fecha2" id="fecha2" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Factura']) ?>" /></td></tr>
<tr><td>Cambiar Factura</td><td><input type="file" name="arfactura" id="arfactura"></td></tr>
<tr><td>Tipo Moneda</td><td><?php Tipo_Moneda_Combo_Selected('moneda[]',$data["Tipo_Moneda"]); ?></td></tr>
<tr><td>Monto</td><td><input type="text" name="monto" id="monto" onkeypress="return soloLetras(event)" maxlength="21" value="<?php echo $data["Monto"]?>" /></td></tr>
<tr><td>Vendedor</td><td><?php echo Vendedor_Combo_Selected('vendedor[]',$data["Vendedor"])?></td></tr>
<tr><td>Nombre Contacto</td><td><input type="text" name="contacto" id="contacto" style="WIDTH: 350px; HEIGHT: 22px" maxlength="50" value="<?php echo $data["Nombre_Contacto"]?>" /></td></tr>
<tr><td>Correo Contacto</td><td><input type="text" name="correo" id="correo" style="WIDTH: 350px; HEIGHT: 22px" maxlength="50" value="<?php echo $data["Correo_Contacto"]?>" /></td></tr>
<tr><td>Teléfono Contacto</td><td><input type="text" name="telefono" id="telefono" onkeypress="return soloLetras(event)" maxlength="12" value="<?php echo $data["Telefono_Contacto"]?>" /></td></tr>
<tr><td>Dirección Instalación</td><td><input type="text" name="direccion" id="direccion" maxlength="100" style="WIDTH: 350px; HEIGHT: 22px" value="<?php echo $data["Direccion"]?>" /></td></tr>

</table>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Enviar" type="submit" value="Enviar"/>
<input name="button" type="button" onClick="window.close();" value="Cancelar" />
</form>
</body>
</html>
<?php
mysql_close($con);

?> 