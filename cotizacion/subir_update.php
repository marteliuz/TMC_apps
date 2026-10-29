<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("libreria.php");

	$id				= $_POST['id'];
	$nombre			= $_POST['nombre'];
	$part			= $_POST['part'];
	$categoria		= $_POST['categoria'];
	$marca			= $_POST['marca'];
	$descripcion	= $_POST['descripcion'];
	$moneda			= $_POST['moneda'];
	$precio			= $_POST['precio'];
	$moneda2		= $_POST['moneda2'];
	$precio2	 	= $_POST['precio2'];
	$moneda3	 	= $_POST['moneda3'];
	$precio3	 	= $_POST['precio3'];
	$moneda4	 	= $_POST['moneda4'];
	$precio4	 	= $_POST['precio4'];
	$estado			= $_POST['estado'];
	
	$archivo = $_FILES["archivo"]['name'];
	$tamano_archivo = $_FILES['archivo']['size'];
	 
	
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("dbmaster",$con);

 for ($i=0;$i<count($categoria) && ($moneda) && ($marca) && ($moneda2) && ($moneda3) && ($moneda4);$i++)    
{       
	$tipos = array("image/gif","image/jpeg","image/bmp","image/pjpeg");
	
if($archivo!="" && $tamano_archivo <=1024000){
	
			
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
			
			
			$query = mysql_query ("UPDATE tbproductos SET nombre='$nombre', part_number='$part', categoria='$categoria[$i]', marca='$marca[$i]', descripcion='$descripcion', moneda='$moneda[$i]', precio='$precio', moneda2='$moneda2[$i]', precio2='$precio2', moneda3='$moneda3[$i]', precio3='$precio3', moneda4='$moneda4[$i]', precio4='$precio4', estado='$estado', imagen='$imagen', nombreimg='$nombreimg',tipo='".$_FILES['archivo']['type']."' WHERE idtbproductos='$id'",$con );

		
	
	
}else{
	
	$query = mysql_query ("UPDATE tbproductos SET nombre='$nombre', part_number='$part', categoria='$categoria[$i]', marca='$marca[$i]', descripcion='$descripcion', moneda='$moneda[$i]', precio='$precio', moneda2='$moneda2[$i]', precio2='$precio2', moneda3='$moneda3[$i]', precio3='$precio3', moneda4='$moneda4[$i]', precio4='$precio4', estado='$estado' WHERE idtbproductos='$id'",$con );
	

}
$var = mysql_affected_rows();
			
	if ($var>0){echo "<script language='JavaScript'>alert('Sus datos fueron modificados correctamente')</script>";
				echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
				
	}else {echo "<script language='JavaScript'>alert('Hubo un error al modificar los datos')</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; }	
			
			mysql_close($con);
}


?>