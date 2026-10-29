<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");

	$tipoguia		= $_POST['tipo'];
	$despacho		= $_POST['despacho'];
	$serie			= trim($_POST['serie']);
	$nombre			= $_POST['nombre'];
	$categoria		= $_POST['categoria'];
	$marca			= $_POST['marca'];
	$tipomoneda		= $_POST['moneda'];
	$valor			= $_POST['valor'];
	$fecha			= DateConvertD($_POST['fecha']);
	$descripcion	= $_POST['descripcion'];
	$tipobodega		= $_POST['lugar'];
	$ingreso		= $_POST['ingreso'];
	$codigo			= trim($_POST['codigo']);
	
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

	
	$qry	= "SELECT * FROM inventario WHERE Nro_Serie = '$serie'";
	$s   	= mysql_query($qry);
	
	$num_rows = mysql_num_rows($s);
	
	if($num_rows==0 OR $serie== ''){
	
		$result= mysql_query("INSERT INTO inventario (Tipo_Guia,Guia_Despacho, Nro_Serie, Nombre, Categoría, Marca, Tipo_Moneda, Valor, Fecha_Ingreso, Descripción, Lugar, Encargado_Ingreso)
VALUES('$tipoguia','$despacho','$serie','$nombre','$categoria','$marca','$tipomoneda','$valor','$fecha','$descripcion','$tipobodega','$ingreso')");
	
		$var = mysql_affected_rows();
	
		if ($var>0){echo "Sus datos fueron ingresados correctamente";
	
		mysql_select_db("dbmaster",$con);
		
		$r=mysql_num_rows(mysql_query("SELECT part_number FROM tbproductos WHERE part_number='$codigo'"));
		if($r="0"){
			$r2=mysql_query("INSERT INTO tbproductos(nombre, part_number, categoria, marca, moneda, precio) VALUES('$nombre', '$codigo', '$categoria', '$marca', '$tipomoneda', '$valor'");
		
	}
	}else{
	echo "Hubo un error al ingresar los datos";
	}
	
	}else{ echo "Este número de serie ya está asociado a otro producto";}
	
mysql_close($con);
?>