<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
}

include ("libreria.php");

	$id						= $_POST['id'];
	$zona			 		= $_POST['zona'];
	$base			 		= $_POST['base'];
	$tarifa1			 	= $_POST['tarifa1'];
	$tarifa2			 	= $_POST['tarifa2'];
	$tarifa3			 	= $_POST['tarifa3'];
	$entrega			 	= $_POST['entrega'];
	$tarifa4			 	= $_POST['tarifa4'];
	$tarifa5			 	= $_POST['tarifa5'];
	$tarifa6			 	= $_POST['tarifa6'];
	$entrega2			 	= $_POST['entrega2'];
	$tarifa7			 	= $_POST['tarifa7'];
	$tarifa8			 	= $_POST['tarifa8'];
	$tarifa9			 	= $_POST['tarifa9'];
	$entrega3			 	= $_POST['entrega3'];

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("dbmaster",$con);
	 			
			
			$query = "UPDATE `tbtransporte` SET zona='$zona', base='$base', tarifa_premium_carro_movil='$tarifa1', tarifa_premium_codec='$tarifa2', tarifa_premium_monitor='$tarifa3', entrega_premium='$entrega', tarifa_priority_carro_movil='$tarifa4' , tarifa_priority_codec='$tarifa5', tarifa_priority_monitor='$tarifa6', entrega_priority='$entrega2', tarifa_express_carro_movil='$tarifa7', tarifa_express_codec='$tarifa8', tarifa_express_monitor='$tarifa9', entrega_express='$entrega3' WHERE idtbtransporte='$id'";	
			
			mysql_query($query);
			
			$var = mysql_affected_rows();
			
	if ($var>0){echo "Sus datos fueron modificados con éxito";
				
	}else {echo "Hubo un error al modificar los datos";
		}	
			mysql_close($con);

	
?>