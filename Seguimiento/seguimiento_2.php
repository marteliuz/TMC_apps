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
$id        = $_POST['id'];
$check	   = $_POST['check'];


	$situacion_cotizacion		 		= $_POST['situacion_cotizacion'];
	$situacion_orden_compra		 		= $_POST['situacion_orden_compra'];
	$situacion_factura					= $_POST['situacion_factura'];  
	
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);
	
	$qry3= mysql_query("SELECT * FROM facturacion WHERE ID_Facturacion = '$id'");
	$reg3=mysql_fetch_array($qry3);
	$oc			=$reg3['Nro_Orden_Compra'];
	

	for ($i=0;$i<count($check);$i++)    
	{    
	
if($situacion_orden_compra=="5" && $situacion_factura!="0" && $situacion_cotizacion!="0"){
	$qry="UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra',Situacion_Factura='$situacion_factura' WHERE ID_Facturacion='$id'";
	
	$result= mysql_query($qry);
	
}

elseif($situacion_orden_compra=="5" && $situacion_factura=="0" && $check[$i]=="1"){
	$qry = "UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra', Situacion_Factura='1' WHERE ID_Facturacion='$id'";
	
	$result= mysql_query($qry);
	
	$qry2="SELECT * FROM usuarios_venta WHERE idusuario='10'";
	
	$result2= mysql_query($qry2);
	$reg2=mysql_fetch_array($result2);
	$nombre2	= 	$reg2['nombre'];
	$correo2	=	$reg2['correo'];
	
	mail("$correo2","Hay un proyecto listo para facturar ","Estimad@ $nombre2: El Area de Operaciones ha cambiado la situacion de orden de compra con numero $oc y id = $id como finalizada, por lo que es necesario comenzar con la facturacion. Para mayor informacion ingrese a http://10.0.20.30/seguimiento/indexfact?id=$id (Este link es unico para el id de la facturacion) . Saludos");
	
}

elseif($situacion_orden_compra=="6" && $situacion_factura=="0" && $check[$i]=="1"){
	$qry = "UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra', Situacion_Factura='1' WHERE ID_Facturacion='$id'";
	
	$result= mysql_query($qry);
	
	$qry2="SELECT * FROM usuarios_venta WHERE idusuario='10'";
	
	$result2= mysql_query($qry2);
	$reg2=mysql_fetch_array($result2);
	$nombre2	= 	$reg2['nombre'];
	$correo2	=	$reg2['correo'];
	
	mail("$correo2","Hay un proyecto listo para facturar ","Estimad@ $nombre2: El Area de Operaciones ha cambiado la situacion de orden de compra con numero $oc y id = $id como equipos entregados, por lo que es necesario comenzar con la facturacion. Para mayor informacion ingrese a http://10.0.20.30/seguimiento/indexfact?id=$id (Este link es unico para el id de la facturacion) . Saludos");
	
}

elseif($situacion_orden_compra=="5" && $situacion_factura=="0"){
	$qry = "UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra', Situacion_Factura='1' WHERE ID_Facturacion='$id'";
	
	$result= mysql_query($qry);
	
}

elseif($situacion_orden_compra=="5" && $situacion_factura!="0" ){
	$qry = "UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra', Situacion_Factura='$situacion_factura' WHERE ID_Facturacion='$id'";
	
	$result= mysql_query($qry);
	
}
elseif($situacion_orden_compra=="2"){
	$qry="UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra',Situacion_Factura='$situacion_factura' WHERE ID_Facturacion='$id'";

	$result= mysql_query($qry);
	
	$qry1="SELECT Vendedor FROM facturacion WHERE ID_Facturacion='$id'";
	
	$result1= mysql_query($qry1);
	$reg=mysql_fetch_array($result1);
	$nombre	= 	Seguimiento_Vendedor($reg['Vendedor']);
	$correo	=	Seguimiento_Vendedor1($reg['Vendedor']);
	
	mail("$correo","Su Orden de Compra $oc ha sido ACEPTADA","Estimad@ $nombre: Su orden de compra con numero $oc y id = $id ha sido aceptada por el Area de Operaciones, el estado de esta orden de compra se encuentra disponible en el software de seguimiento. Para mayor informacion ingrese a http://10.0.20.30/seguimiento. Saludos");
	
}	

elseif($situacion_orden_compra=="3"){
	
	$qry="UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra',Situacion_Factura='$situacion_factura' WHERE ID_Facturacion='$id'";
	
	$result= mysql_query($qry);
	
	$qry1="SELECT Vendedor FROM facturacion WHERE ID_Facturacion='$id'";
	
	$result1= mysql_query($qry1);
	$reg=mysql_fetch_array($result1);
	$nombre	= 	Seguimiento_Vendedor($reg['Vendedor']);
	$correo	=	Seguimiento_Vendedor1($reg['Vendedor']);
	
	mail("$correo","Su Orden de Compra $oc ha sido RECHAZADA","Estimad@ $nombre: Su orden de compra con numero $oc y id = $id ha sido rechazada por el Area de Operaciones, el estado de esta orden de compra y causa de rechazo se encuentra disponible en el software de seguimiento http://10.0.20.30/seguimiento(boton detalles en tabla de seguimiento). Saludos");

}		
elseif($situacion_orden_compra!="5"){
	$qry="UPDATE facturacion SET Situacion_Cotizacion= '$situacion_cotizacion', Situacion_Orden_Compra='$situacion_orden_compra',Situacion_Factura='$situacion_factura' WHERE ID_Facturacion='$id'";

	$result= mysql_query($qry);
	
	
}


	$var = mysql_affected_rows();

	if ($var>0){echo "Se han guardado correctamente los cambios";
	}else{
	echo "Ha ocurrido un problema al guardar los datos";
	}
mysql_close($con);
}
?>