<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");
$fecha	   = DateConvertD($_POST['f_salida']);
$encargado = $_POST['encargado'];
$categoria = $_POST['categoria'];
$id        = $_POST['id'];
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$result= mysql_query("SELECT Tipo_Guia,Guia_Despacho, Nro_Serie, Nombre, Categoria, Marca, Tipo_Moneda, Valor, Descripción, Lugar FROM inventario_usado WHERE ID_Inv='$id'", $con);

 $row= mysql_fetch_array($result);

$tipo_guia	=	$row['Tipo_Guia'];
$guia		=	$row['Guia_Despacho'];
$serie		=	$row['Nro_Serie'];
$nombre		=	$row['Nombre'];
$categoria1	=	$row['Categoria'];
$marca		=	$row['Marca'];
$moneda		=	$row['Tipo_Moneda'];
$valor		=	$row['Valor'];
$descripcion=	$row['Descripción'];
$lugar		=	$row['Lugar'];

$result1= mysql_query("INSERT INTO inventario(ID_Inv, Tipo_Guia,Guia_Despacho, Nro_Serie, Nombre, Categoría, Marca, Tipo_Moneda, Valor, Fecha_Ingreso, Descripción, Lugar, Encargado_Ingreso) VALUES ('$id', '$tipo_guia', '$guia', '$serie', '$nombre', '$categoria1', '$marca', '$moneda', '$valor','$fecha', '$descripcion', '$lugar', '$encargado')", $con);


 
$var = mysql_affected_rows();
	if ($var>0){echo "Los datos fueron reingresados correctamente";
	$result2= mysql_query("DELETE FROM inventario.inventario_usado WHERE ID_Inv='$id';", $con);
	}else{
		echo "Se produjo un error al reingresar los datos";
	
}
mysql_close($con);

?> 

