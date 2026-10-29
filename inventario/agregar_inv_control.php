<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");
	$encargado1		= $_POST['encargado1'];
	$fecha1			= DateConvertD($_POST['fecha1']); 
	
	$tipoguia		= $_POST['tipo'];
	$despacho		= $_POST['despacho'];
	$serie			= $_POST['serie'];
	$nombre			= $_POST['nombre'];
	$categoria		= $_POST['categoria'];
	$marca			= $_POST['marca'];
	$tipomoneda		= $_POST['moneda'];
	$valor			= $_POST['valor'];
	$fecha			= DateConvertD($_POST['fecha']);
	$descripcion	= $_POST['descripcion'];
	$tipobodega		= $_POST['lugar'];
	$ingreso		= $_POST['ingreso'];
	
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

	$result= mysql_query("INSERT INTO inventario (Tipo_Guia,Guia_Despacho, Nro_Serie, Nombre, Categoría, Marca, Tipo_Moneda, Valor, Fecha_Ingreso, Descripción, Lugar, Encargado_Ingreso)
VALUES('$tipoguia','$despacho','$serie','$nombre','$categoria','$marca','$tipomoneda','$valor','$fecha','$descripcion','$tipobodega','$ingreso')",$con);
	
	$var = mysql_affected_rows();
	
	if ($var>0){echo "OK";
	$result1= mysql_query("UPDATE inventario SET Encargado_Control='$encargado1', Fecha_Control='$fecha1'",$con);
	}else{
	echo"NO";
	
mysql_close($con);}




?>
