<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");

	$id				= $_POST['id'];
	$tipoguia		= $_POST['tipo'];
	$despacho		= $_POST['guia'];
	$serie			= $_POST['serie'];
	$nombre			= $_POST['nombre'];
	$categoria		= $_POST['categoria'];
	$marca			= $_POST['marca'];
	$tipomoneda		= $_POST['moneda'];
	$valor			= $_POST['valor'];
	$fecha			= DateConvertC($_POST['fecha']);
	$descripcion	= $_POST['descripcion'];
	$tipobodega		= $_POST['lugar'];
	$ingreso		= $_POST['encargado'];
	$encargado1		= $_POST['encargado1'];
	$fecha1			= DateConvertC($_POST['fecha1']);
	
$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);
	
	$result = mysql_query ("UPDATE inventario SET Tipo_Guia='$tipoguia', Guia_Despacho='$despacho', Nro_Serie='$serie', Nombre='$nombre', Categoría='$categoria', Marca='$marca', Tipo_Moneda='$tipomoneda', Valor='$valor', Fecha_Ingreso='$fecha', Descripción='$descripcion', Lugar='$tipobodega', Encargado_Ingreso='$ingreso',Encargado_Control='$encargado1',Fecha_Control='$fecha1' WHERE ID_Inv='$id'",$con );
	
	
	$var = mysql_affected_rows();
	
	if ($var>0){echo "Sus datos fueron modificados correctamente";
	}else{
	echo"Se produjo un error al intentar modificar los datos";
	
mysql_close($con);}
	
	?>