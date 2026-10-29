<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");
//ajax.send("nro_guia="+nro_guia+"&f_salida="+f_salida+"&encargado="+encargado+"&categoria="+categoria+"&id="+lcheck.value);
$nro_guia  = $_POST['nro_guia'];
$factura   = $_POST['factura'];
$cliente   = $_POST['cliente'];
$fecha	   = DateConvertD($_POST['f_salida']);
$encargado = $_POST['encargado'];
$categoria = $_POST['categoria'];
$id        = $_POST['id'];

	
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$result= mysql_query("SELECT Tipo_Guia,Guia_Despacho, Nro_Serie, Nombre, Categoría, Marca, Tipo_Moneda, Valor, Fecha_Ingreso, Descripción, Lugar, Encargado_Ingreso FROM inventario WHERE ID_Inv='$id'", $con);

 $row= mysql_fetch_array($result);

$tipo_guia	=	$row['Tipo_Guia'];
$guia		=	$row['Guia_Despacho'];
$serie		=	$row['Nro_Serie'];
$nombre		=	$row['Nombre'];
$categoria1	=	$row['Categoría'];
$marca		=	$row['Marca'];
$moneda		=	$row['Tipo_Moneda'];
$valor		=	$row['Valor'];
$f_ingreso	=	DateConvertE($row['Fecha_Ingreso']);
$descripcion=	$row['Descripción'];
$lugar		=	$row['Lugar'];
$e_ingreso	=	$row['Encargado_Ingreso'];

$result1= mysql_query("INSERT INTO inventario_usado(ID_Inv, Tipo_Guia,Guia_Despacho, Guia_Despacho_Retiro, Factura_Venta, Nro_Serie, Nombre, Categoria, Marca, Tipo_Moneda, Valor, Fecha_Ingreso, Descripción, Lugar, Encargado_Ingreso, Fecha_Salida, Encargado_Salida, Cliente) VALUES ('$id', '$tipo_guia', '$guia', '$nro_guia', '$factura', '$serie', '$nombre', '$categoria1', '$marca', '$moneda', '$valor', '$f_ingreso', '$descripcion', '$lugar', '$e_ingreso', '$fecha', '$encargado','$cliente')", $con);

 
$var = mysql_affected_rows();
	if ($var>0){echo "Los datos fueron retirados correctamente";;
	$result2= mysql_query("DELETE FROM inventario.inventario WHERE ID_Inv='$id';", $con);
	}else{
	echo"Se produjo un error al retirar los datos";
	
}
mysql_close($con);

?> 

