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
	
	$id				= $_POST['id'];
	$empresa		= $_POST['empresa'];
	$rut			= $_POST['rut'];
	$cotizacion		= $_POST['cotizacion'];
	$fecha			= DateConvertC($_POST['fecha']);
	$orden			= $_POST['orden'];
	$fecha1			= $_POST['fecha1'];
	$factura		= $_POST['factura'];
	$fecha2			= $_POST['fecha2'];
	$moneda		 	= $_POST['moneda'];
	$monto		 	= $_POST['monto'];
	$vendedor	 	= $_POST['vendedor'];
	$contacto	 	= $_POST['contacto'];
	$correo		 	= $_POST['correo'];
	$telefono		= $_POST['telefono'];
	$direccion		= $_POST['direccion'];
	
	$archivo1 = $_FILES["arcotizacion"]['name'];
	$tamano_archivo1 = $_FILES['arcotizacion']['size'];
	
	$archivo2 = $_FILES["arorden"]['name'];
	$tamano_archivo2 = $_FILES['arorden']['size'];
	
	$archivo3 = $_FILES["arfactura"]['name'];
	$tamano_archivo3 = $_FILES['arfactura']['size'];
	
			$matriz		= explode(".",$archivo1);
			$nombre1	= $matriz[0];
			$extension1	= $matriz[1];
			
			$matriz		= explode(".",$archivo2);
			$nombre2	= $matriz[0];
			$extension2	= $matriz[1];
			
			$matriz		= explode(".",$archivo3);
			$nombre3	= $matriz[0];
			$extension3	= $matriz[1];

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);			
			
 for ($i=0;$i<count ($moneda) && ($vendedor);$i++)    
{       

if($archivo1!="" && $archivo2!="" && $archivo3!=""){

	
	$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino1 =  "files/$cotizacion".".".$extension1;
        if (move_uploaded_file($_FILES['arcotizacion']['tmp_name'],$destino1)) {}
		
		$destino2 =  "files/$orden".".".$extension2;
        if (move_uploaded_file($_FILES['arorden']['tmp_name'],$destino2)) {}
		
		$destino3 =  "files/$factura".".".$extension3;
        if (move_uploaded_file($_FILES['arfactura']['tmp_name'],$destino3)) {}
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	
	
	}elseif($archivo1!="" && $archivo2!=""){
	
		$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino1 =  "files/$cotizacion".".".$extension1;
        if (move_uploaded_file($_FILES['arcotizacion']['tmp_name'],$destino1)) {}
		
		$destino2 =  "files/$orden".".".$extension2;
        if (move_uploaded_file($_FILES['arorden']['tmp_name'],$destino2)) {}
	
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	}elseif($archivo1!="" && $archivo3!=""){
	
		$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino1 =  "files/$cotizacion".".".$extension1;
        if (move_uploaded_file($_FILES['arcotizacion']['tmp_name'],$destino1)) {}
		
		$destino3 =  "files/$factura".".".$extension3;
        if (move_uploaded_file($_FILES['arfactura']['tmp_name'],$destino3)) {}
	
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	}elseif($archivo2!="" && $archivo3!=""){
	
		$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino2 =  "files/$orden".".".$extension2;
        if (move_uploaded_file($_FILES['arorden']['tmp_name'],$destino2)) {}
		
		$destino3 =  "files/$factura".".".$extension3;
        if (move_uploaded_file($_FILES['arfactura']['tmp_name'],$destino3)) {}
	
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	}elseif($archivo1!=""){
	
		$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino1 =  "files/$cotizacion".".".$extension1;
        if (move_uploaded_file($_FILES['arcotizacion']['tmp_name'],$destino1)) {}
	
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	}elseif($archivo2!=""){
	
		$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino2 =  "files/$orden".".".$extension2;
        if (move_uploaded_file($_FILES['arorden']['tmp_name'],$destino2)) {}
	
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	}elseif($archivo3!=""){
	
		$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){
	
		$destino3 =  "files/$factura".".".$extension3;
        if (move_uploaded_file($_FILES['arfactura']['tmp_name'],$destino3)) {}
	
	
				echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
	
	}else{
	
	$query = mysql_query ("UPDATE facturacion SET Nombre_Empresa='$empresa', Rut_Empresa='$rut', Nro_Cotizacion='$cotizacion', Fecha_Cotizacion='$fecha', Nro_Orden_Compra='$orden', Fecha_Orden_Compra='$fecha1', Nro_Factura='$factura', Fecha_Factura='$fecha2', Tipo_Moneda='$moneda[$i]', Monto='$monto', Vendedor='$vendedor[$i]', Nombre_Contacto='$contacto', Correo_Contacto='$correo', Telefono_Contacto='$telefono', Direccion='$direccion' WHERE ID_Facturacion='$id'",$con );

	
	$var = mysql_affected_rows();
			
	if ($var>0){echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
	mysql_close($con);
}		
			

}


?>			
			
			
					