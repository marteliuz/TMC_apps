<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
}

include ("libreria.php");

	$nombre			 		= $_POST['nombre'];
	$part			 		= $_POST['part'];
	$categoria			 	= $_POST['categoria'];
	$marca				 	= $_POST['marca'];
	$descripcion	 		= $_POST['descripcion'];
	$moneda			 		= $_POST['moneda'];
	$precio			 		= $_POST['precio'];
	$moneda2			 	= $_POST['moneda2'];
	$precio2			 	= $_POST['precio2'];
	$moneda3			 	= $_POST['moneda3'];
	$precio3			 	= $_POST['precio3'];
	$moneda4			 	= $_POST['moneda4'];
	$precio4			 	= $_POST['precio4'];
	
	$archivo = $_FILES["archivo"]['name'];
	$tamano_archivo = $_FILES['archivo']['size'];


	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("dbmaster",$con);
	 
			$tipos = array("image/gif","image/jpeg","image/bmp","image/pjpeg");

	
	for ($i=0;$i<count($categoria) && ($moneda) && ($moneda2) && ($moneda3) && ($moneda4) && ($marca);$i++)    
{      
			
			if ($tamano_archivo <=1024000){
			
			include_once("class_imgUpldr.php");
			$subir= new imgUpldr;
			$subir->init($_FILES['archivo']);
			
			$ruta= "Imgproductos/$archivo";
			$fp= fopen($ruta,"r");
			$imagen = fread($fp, filesize($ruta));
			$imagen = addslashes($imagen);
			fclose($fp);
			if(!get_magic_quotes_gpc())	$nombreimg = addslashes($_FILES['archivo']['name']); // Arreglamos el Nombre
			else $nombreimg = $_FILES['archivo']['name'];
				
			
			$query = "INSERT INTO `tbproductos` (nombre, part_number, categoria, marca, descripcion, moneda, precio, moneda2, precio2, moneda3, precio3, moneda4, precio4,estado,imagen,nombreimg,tipo,fecha,ip) VALUES('$nombre', '$part', '$categoria[$i]', '$marca[$i]','$descripcion', '$moneda[$i]', '$precio', '$moneda2[$i]', '$precio2','$moneda3[$i]', '$precio3', '$moneda4[$i]', '$precio4','1','$imagen','$nombreimg','".$_FILES['archivo']['type']."','" .date("d/m/y",time())."','".$_SERVER['REMOTE_ADDR']."')";	
			
			mysql_query($query);
			}
			
			$var = mysql_affected_rows();
			
	if ($var>0){echo "<script language='JavaScript'>alert('Sus datos fueron ingresados correctamente')</script>";
					echo "<script languaje='javascript' type='text/javascript'> window.location='mantenedor.php';</script>";
			
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al ingresar los datos o la Imagen excede el tamaño máximo (1 mb)')</script>";
					echo "<script languaje='javascript' type='text/javascript'>window.location='mantenedor.php';</script>";

		 }	
			
			mysql_close($con);
}
	
?>
