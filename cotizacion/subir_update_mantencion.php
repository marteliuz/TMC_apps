<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
}

include ("libreria.php");

	$id						= $_POST['id'];
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
	 			
			
			$query = "UPDATE `tbmantencion` SET nombre='$nombre', part_number='$part', categoria='$categoria', part_number_asociado='$part2', descripcion='$descripcion', moneda='$moneda', precio='$precio' WHERE idtbmantencion='$id'";	
			
			mysql_query($query);
			
			$var = mysql_affected_rows();
			
	if ($var>0){echo "Sus datos fueron modificados con éxito";
				
	}else {echo "Hubo un error al modificar los datos";
		}	
			mysql_close($con);

	
?>