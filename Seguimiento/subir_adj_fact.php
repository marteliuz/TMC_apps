<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();}else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 300) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      header("Location: index.php"); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
} 

include ("libreria.php");
	
	$id				= $_POST['id'];
	$factura		= $_POST['factura'];
	$fecha_factura1	= $_POST['fecha2'];
	$fecha2			= DateConvertD($_POST['fecha2']);
	$oc			 	= $_POST['oc'];
	
	
	$archivo = $_FILES["archivo"]['name'];
	$tamano_archivo = $_FILES['archivo']['size'];
	
	
	
			$matriz		= explode(".",$archivo);
			$nombre		= $matriz[0];
			$extension	= $matriz[1];
			

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);			
			    

if($archivo!="" && $factura!="" && $fecha2!=""){

	
	$query = mysql_query ("UPDATE facturacion SET Nro_Factura='$factura', Fecha_Factura='$fecha2',Situacion_Factura='2' WHERE ID_Facturacion='$id'",$con );
	
	$var = mysql_affected_rows();
			
	if ($var>0){echo"<script language='JavaScript'>alert('Se han ingresado correctamente los datos') </script>";
				$destino =  "files/$factura".".".$extension;
				move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
				echo "<script type='text/javascript'>"; 
				echo "window.close()"; 
				echo "</script>"; 
				exit();	
				mysql_close($con);
			}
		}else{
?>
<head>
<meta content="300" http-equiv="REFRESH"> </meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script language='javascript' src='popcalendar.js'></script>
</head>
<body OnLoad='compt=setTimeout("self.close();",250000)' text=black>

<blockquote>
<h2 style= color:#0073c4>Datos Factura</h2><br>
<form method="post" action="subir_adj_fact.php" enctype="multipart/form-data" name="form4" id="form4">
	<table width="678" cellpadding="3" cellspacing="3">
	<tr>
	<tr><td width="155">ID</td><td width="258"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $id?>" /></td></tr>
    <td width="257">Nro Factura </td>
    <td><?php 		if($factura=="")			{
						$div_factura=  "<input type='text' style='background-color:#F00' name='factura' id='factura' maxlength='8' onclick= this.style.backgroundColor='#FFF' /> "."<font color=#FF0000>Ingrese número factura</font>" ;
												}else{
						$div_factura= "<input type='text' name='factura' id='factura' value='$factura' maxlength='8'/>" ;				 			 	 }
	
		 echo $div_factura; ?></td>
    </tr>
    <tr>
    <td>Fecha Emisión Factura</td>
    <td><?php 		if($fecha2=="")		{
						$div_fecha= "<input name='fecha2' style='background-color:#F00' type='text' id ='fecha2' onclick =popCalendar.show(this,this,'dd/mm/yyyy','es');this.style.backgroundColor='#FFF' /> "."<font color=#FF0000>Ingrese fecha de emisión</font>" ;
							  					}else{
						$fecha2 = DateConvertA($fecha2);
						$div_fecha= "<input name='fecha2' type='text' id = 'fecha2' onclick =popCalendar.show(this,this,'dd/mm/yyyy','es')  value='$fecha_factura1'/> " ;		 
												 	 } 	
		 echo $div_fecha; ?></td>
    </tr>
    <tr>
    <td>Nro Orden de Compra Asociada</td>
    <td> <?php 		echo ("<input type='text' readonly='readonly' name='oc' id='oc' size=60 value='$oc' />");
	?></td>
    </tr>
    <tr>
    <td>Adjuntar Factura</td>
    <td><?php 		if ($archivo== "") 		{
						$div_archivo= "<input type='file' style='background-color:#F00' name='archivo' id='archivo' onclick= this.style.backgroundColor='#FFF' /> " ;			
											}else{				
						$div_archivo= "<input type='file' name='archivo' id='archivo'/>"."<br>"."<font color=#FF0000>Debe readjuntar el archivo</font>" ;									 									 												 }
		 echo $div_archivo; ?></td>
    </tr> 
    <td></td>
    <td> <br/><input type="submit" name="Enviar" id="Enviar" value="Enviar"/>&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
    </tr>         
    </table>                                                                 
</form>
</blockquote>
</body>    
<?php
		}
	

?>