<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
}

include ("libreria.php");

	$nombre			 		= $_POST['nombre'];
	$part			 		= $_POST['part'];
	$categoria			 	= $_POST['categoria'];
	$part2			 		= $_POST['part2'];
	$marca				 	= $_POST['marca'];
	$descripcion	 		= $_POST['descripcion'];
	$moneda			 		= $_POST['moneda'];
	$precio			 		= $_POST['precio'];

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("dbmaster",$con);
	 			
			
			$query = "INSERT INTO `tbmantencion` (nombre, part_number, categoria, part_number_asociado, descripcion, moneda, precio) VALUES('$nombre', '$part', '$categoria', '$part2', '$descripcion', '$moneda', '$precio')";	
			
			mysql_query($query);
			
			$var = mysql_affected_rows();
			
	if ($var>0){echo "Sus datos fueron ingresados correctamente";
				
	}else {echo "Hubo un error al ingresar los datos";
		}	
			mysql_close($con);

	
?>
