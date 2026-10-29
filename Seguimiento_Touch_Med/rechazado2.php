<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");

$id        		= $_GET['id'];
$descripcion	= $_GET['descripcion'];

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);

	$result= mysql_query("UPDATE facturacion SET Detalle='$descripcion' WHERE ID_Facturacion='$id' ");

	
	$var = mysql_affected_rows();
	
	if ($var>0){echo"<script language='JavaScript'>alert('Se han ingresado correctamente los datos') </script>";
				echo "<script type='text/javascript'>"; 
				echo "window.close()"; 
				echo "</script>"; 
				exit();	}
	else{echo"<script language='JavaScript'>alert('Hubo un error al ingresar los datos') </script>";
				echo "<script type='text/javascript'>"; 
				echo "window.close()"; 
				echo "</script>"; 
				exit();	}
	
	mysql_close($con);
?>
