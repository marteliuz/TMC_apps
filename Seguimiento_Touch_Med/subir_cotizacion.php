<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

	$cotizacion		 		= $_POST['cotizacion'];
	$fecha_cotizacion 		= DateConvertD($_POST['fecha_cotizacion']);
	$fecha_cotizacion1		= $_POST['fecha_cotizacion'];
	$empresa			 	= $_POST['empresa'];
	$nombre			 		= $_POST['nombre'];
	$correo			 		= $_POST['correo'];
	$telefono		 		= $_POST['telefono'];
	$moneda					= $_POST['moneda'];
	$valor			 		= $_POST['valor'];
	$vendedor		 		= $_SESSION['rut'];
	
	
	 $tamano = $_FILES["archivo"]['size'];
     $tipo = $_FILES["archivo"]['type'];
     $archivo = $_FILES["archivo"]['name'];
	  
	  for ($i=0;$i<count($moneda);$i++)   
{        
	 
if($cotizacion!="" && $fecha_cotizacion!="" && $empresa!="" && $nombre!="" && $correo!="" &&$vendedor!="" && $archivo!=""){
	
	$matriz= explode(".",$archivo);
	$nombre1	= $matriz[0];
	$extension	= $matriz[1];
						
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);

$result= mysql_query("INSERT INTO facturacion (Nombre_Empresa, Nro_Cotizacion, Fecha_Cotizacion, Situacion_Cotizacion, Tipo_Moneda, Monto, Vendedor, Nombre_Contacto, Correo_Contacto, Telefono_Contacto)
VALUES('$empresa','$cotizacion','$fecha_cotizacion', '1','$moneda[$i]', '$valor','$vendedor','$nombre','$correo','$telefono')");
	
	$var = mysql_affected_rows();
	
	if ($var>0){echo"<script language='JavaScript'>alert('Se han ingresado correctamente los datos') </script>";
	
		$destino =  "files/$cotizacion".".".$extension;
        if (move_uploaded_file($_FILES['archivo']['tmp_name'],$destino)) {}
		
			$celis=mysql_query("SELECT correo, nombre FROM usuarios_venta WHERE idusuario='7'");
			$rcelis=mysql_fetch_array($celis);
			$correoc=$rcelis['correo'];
			$nombrec=$rcelis['nombre'];
			
			$gonzalez=mysql_query("SELECT correo, nombre FROM usuarios_venta WHERE idusuario='3'");
			$rgonzalez=mysql_fetch_array($gonzalez);
			$correog=$rgonzalez['correo'];
			$nombreg=$rgonzalez['nombre'];
			
			$qry1	="SELECT Vendedor FROM vendedor WHERE ID_Vendedor='$vendedor'";
	
			$result1	=	mysql_query($qry1);
			$reg		=	mysql_fetch_array($result1);
			$vendedor1	= 	$reg['Vendedor'];
			
			mail("$correoc, $correog","Se ha generado una nueva Cotizacion $cotizacion","Estimados $nombrec y $nombreg: Se ha generado una nueva cotizacion con numero $cotizacion por el señor $vendedor1, su visualizacion esta disponible en el software de seguimiento. Saludos");
	
	
				echo "<script type='text/javascript'>"; 
				echo "window.close()"; 
				echo "</script>"; 
				exit();	
				mysql_close($con);
		}
	}else{
?><head>
<meta content="300" http-equiv="REFRESH"> </meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script type="text/javascript" src="jquery.js" ></script>
<script type='text/javascript' src="jquery.autocomplete.js" ></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script>
	jQuery(document).ready(function(){
	 jQuery("#empresa").autocomplete("autocomplete_empresa.php", {
			selectFirst: true
		});
	});
</script>
<script>
	
	jQuery(document).ready(function(){
	 jQuery("#cotizacion").autocomplete("autocomplete_cotizacion.php", {
			selectFirst: true
		});
	});
</script>
<script>
	
	jQuery(document).ready(function(){
	 jQuery("#nombre").autocomplete("autocomplete_nombre.php", {
			selectFirst: true
		});
	});
</script>
<script>
	
	jQuery(document).ready(function(){
	 jQuery("#correo").autocomplete("autocomplete_correo.php", {
			selectFirst: true
		});
	});
</script>
<script>
	
	jQuery(document).ready(function(){
	 jQuery("#telefono").autocomplete("autocomplete_telefono.php", {
			selectFirst: true
		});
	});
</script>
</head>
<body OnLoad='compt=setTimeout("self.close();",250000)' text=black>
<blockquote>
<h2 style= color:#0073c4>Datos Cotización</h2><br>
<form action="subir_cotizacion.php" method="post" enctype="multipart/form-data" name"form1" id="form1">
	<table width="678" cellpadding="3" cellspacing="3">
	<tr>
    <td width="207">Nro Cotización </td>
    <td><?php 		if($cotizacion=="")	{
						$div_cotizacion= "<input type='text' style='background-color:#F00' name='cotizacion' id='cotizacion' maxlength='50' onclick= this.style.backgroundColor='#FFF' /> "."<font color=#FF0000>Ingrese número de cotización</font>" ;
												}else{
						
						$div_cotizacion= "<input type='text' name='cotizacion' id='cotizacion' value='$cotizacion' maxlength='50' /> ";							 }
						
		 echo $div_cotizacion; ?></td>
    </tr>
    <tr>
    <td>Fecha Emisión Cotización</td>
    <td><?php 		if($fecha_cotizacion=="")			{
						$div_fecha= "<input name='fecha_cotizacion' style='background-color:#F00' type='text' id = 'fecha_cotizacion' onclick =popCalendar.show(this,this,'dd/mm/yyyy','es');this.style.backgroundColor='#FFF' /> "."<font color=#FF0000>Ingrese fecha de emisión</font>" ; 					}else{
						$div_fecha= "<input name='fecha_cotizacion' type='text' id = 'fecha_cotizacion' onclick =popCalendar.show(this,this,'dd/mm/yyyy','es') value='$fecha_cotizacion1' /> ";						 }
							
		 echo $div_fecha; ?></td>
    </tr>
	<tr>
    <td>Nombre Empresa</td>
    <td><?php 		if($empresa=="")			{
						$div_empresa= "<input type='text' style='background-color:#F00' name='empresa' id='empresa'  maxlength='50' onclick= this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese nombre empresa</font>" ;				}else{
						$div_empresa= "<input type='text' name='empresa' id='empresa' value=' $empresa' maxlength='50'  />" ;										 }
		 echo $div_empresa; ?></td>
    </tr>
    <tr>
    <td>Nombre Contacto</td>
    <td><?php 		if($nombre=="")			{
						$div_nombre= "<input type='text' style='background-color:#F00' name='nombre' id='nombre' maxlength='50' onclick= this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese nombre contacto</font>" ;			}else{ 
						$div_nombre= "<input type='text' name='nombre' id='nombre' value='$nombre' maxlength='50'  />";							 }
						
		 echo $div_nombre; ?></td>
    </tr>
    <tr>
    <td>E-mail Contacto</td>
    <td><?php 		if($correo=="")			{
						$div_correo= "<input type='text' style='background-color:#F00'  name='correo' id='correo' maxlength='50' onclick= this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese e-mail de contacto</font>" ;		}else{  
						$div_correo= "<input type='text' name='correo' id='correo' value='$correo' maxlength='50'  />";							 } 
		 echo $div_correo; ?></td>
    </tr> 
    <tr>
    <td>Teléfono Contacto</td>
    <td><?php 		if($telefono=="")			{
						$div_telefono= "<input type='text' style='background-color:#F00' name='telefono' id='telefono' maxlength='12' onclick= this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese teléfono de contacto</font>" ;		
												}else{
						$div_telefono= "<input type='text' name='telefono' id='telefono' value='$telefono' maxlength='12' />" ;								 } 
												
		 echo $div_telefono; ?></td>
    </tr>
	<tr>
    <td>Monto</td>
    <td><?php 		if($moneda[$i]=='0')		{ 
						$div_moneda= Tipo_Moneda_Combo()."<font color=#FF0000>Seleccione Tipo de Moneda</font>";
											}else{
						$div_moneda= Tipo_Moneda_Selected("moneda[]", $moneda[$i]);
												}
						
		 echo $div_moneda;
	
					if($valor=="")			{ 
						$div_valor= "<input type='text' style='background-color:#F00' name='valor' id='valor' maxlength='21' onclick= this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese monto de venta</font>" ;			}else{
						$div_valor= "<input type='text' name='valor' id='valor' value='$valor' maxlength='21' />";												 }
			
		 echo $div_valor; ?></td>
    </tr>
	<tr>
    <td>Vendedor</td>
    <td><input type="text" readonly="readonly" name="vendedor" id="vendedor" style="color:#00C; font-weight:bold;" value="<?php echo Seguimiento_Vendedor($_SESSION['rut'])?>" /></td>
    </tr> 
    <tr>
    <td>Adjuntar Cotización</td>
    <td><?php 		if ($archivo== "") 		{
						$div_archivo= "<input type='file' style='background-color:#F00' name='archivo' id='archivo' onclick= this.style.backgroundColor='#FFF' /> " ;			
											}else{				
						$div_archivo= "<input type='file' name='archivo' id='archivo'/>"."<br>"."<font color=#FF0000>Debe readjuntar el archivo</font>" ;									 									 												 }
		 echo $div_archivo; ?></td>
    </tr> 
    <tr>   
    <td></td>
    <td> <br/><input type="submit" name="Enviar" id="Enviar" value="Enviar"/>&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
    </tr>         
    </table>                                                                 
</form>
</blockquote>
</body>
<?php
		}
}
?>
