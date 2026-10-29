<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
}

include ("libreria.php");

	$zona			 		= $_POST['zona'];
	$base			 		= $_POST['base'];
	$tarifa1			 	= $_POST['tarifa1'];
	$tarifa2			 	= $_POST['tarifa2'];
	$tarifa3			 	= $_POST['tarifa3'];
	$entrega			 	= $_POST['entrega'];

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("dbmaster",$con);
	 			
			
			$query = "INSERT INTO `tbtransporte` (zona, base, tarifa_premium_carro_movil, tarifa_premium_codec, tarifa_premium_monitor, entrega) VALUES('$zona', '$base', '$tarifa1', '$tarifa2', '$tarifa3', '$entrega)";	
			
			mysql_query($query);
			
			$var = mysql_affected_rows();
			
	if ($var>0){echo "Sus datos fueron ingresados correctamente";
				
	}else {echo "Hubo un error al ingresar los datos";
		}	
			mysql_close($con);

	
?>