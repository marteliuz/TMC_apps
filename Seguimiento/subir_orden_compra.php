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

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);

	$compra			 		= $_POST['compra'];
	$fecha_orden_compra 	= DateConvertD($_POST['fecha_orden_compra']);
	$fecha_orden_compra1 	= $_POST['fecha_orden_compra'];
	$compra_combo			= $_POST['compra_combo'];
	$rut					= $_POST['rut'];
	$direccion				= $_POST['direccion'];
	
	$archivo = $_FILES["archivo"]['name'];
	$tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
	 	
	
	 for ($i=0;$i<count($compra_combo);$i++)    
	{        
     	if($compra!="" && $fecha_orden_compra!="" && $compra_combo[$i]>'0' && $rut!="" && $direccion!="") 
		{
		
			$matriz= explode(".", $archivo);
			$nombre		= $matriz[0];
			$extension	= $matriz[1];
			
								
$result= mysql_query("UPDATE facturacion SET Situacion_Cotizacion= '2', Nro_Orden_Compra= '$compra', Fecha_Orden_Compra='$fecha_orden_compra',Situacion_Orden_Compra='1', Rut_Empresa='$rut', Direccion='$direccion' WHERE ID_Facturacion='$compra_combo[$i]' ");
	
	$var = mysql_affected_rows();
	
	if ($var>0){echo"<script language='JavaScript'>alert('Se han ingresado correctamente los datos') </script>";
		
	   $destino =  "files/$compra".".".$extension;
       move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
	   
			$erwin=mysql_query("SELECT correo, nombre FROM usuarios_venta WHERE idusuario='2'");
			$rerwin=mysql_fetch_array($erwin);
			$correoe=$rerwin['correo'];
			$nombree=$rerwin['nombre'];
			
			$jose=mysql_query("SELECT correo, nombre FROM usuarios_venta WHERE idusuario='9'");
			$rjose=mysql_fetch_array($jose);
			$correoj=$rjose['correo'];
			$nombrej=$rjose['nombre'];
			
			$qry1	="SELECT Vendedor FROM facturacion WHERE ID_Facturacion='$compra_combo[$i]' ";
	
			$result1	=	mysql_query($qry1);
			$reg		=	mysql_fetch_array($result1);
			$vendedor1	= 	Seguimiento_Vendedor($reg['Vendedor']);
			$correo1	=	Seguimiento_Vendedor1($reg['Vendedor']);
			
			
			mail("$correoe, $correoj, $correo1","Se ha generado una nueva Orden de Compra $compra","Estimados $nombree y $nombrej: Se ha generado una nueva orden de compra con numero $compra por la persona $vendedor1, el id de esta orden es el $compra_combo[$i] y su visualizacion esta disponible en el software de seguimiento http://10.0.20.30. Saludos");
	
				 
			$result1="SELECT * FROM facturacion WHERE ID_Facturacion='$compra_combo[$i]' ";
			$resultado=mysql_query($result1) or die (mysql_error());
			
  			while ($row=mysql_fetch_array($resultado)){ 
   				$var1 = $row['Nombre_Empresa'];
				$var2= $row['Rut_Empresa'];
				$var4= $row['Nombre_Contacto']; 
				$var5= $row['Correo_Contacto']; 
				$var6= $row['Telefono_Contacto']; 
			}
			
			$result2="SELECT Rut_Clientes FROM clientes WHERE Rut_Clientes='$var2' ";	
			$resultado2=mysql_query($result2) or die (mysql_error());
			
			$var3 = mysql_affected_rows();
	
			if ($var3==0){$result3=mysql_query("INSERT INTO clientes (Clientes, Rut_Clientes, Direccion, Contacto, Correo, Tcontacto) VALUES ('$var1', '$var2', '$direccion', '$var4', '$var5', '$var6')");}
   		
	
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
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script type="text/javascript" src="jquery.js" ></script>
<script type='text/javascript' src="jquery.autocomplete.js" ></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script>
	jQuery(document).ready(function(){
	 jQuery("#rut").autocomplete("autocomplete_rut.php", {
			selectFirst: true
		});
	});
</script>
</head>

<body OnLoad='compt=setTimeout("self.close();",250000)' text=black >
<blockquote>
<h2 style= color:#0073c4>Datos Orden de Compra</h2><br>
<form method="post" action="subir_orden_compra.php" enctype="multipart/form-data" name="form22" id="form22">
	<table width="924" cellpadding="3" cellspacing="3">
	<tr>
    <td width="300">Nro Orden de Compra </td>
    <td width="593"><?php 		if($compra=="")				{
						$div_orden= "<input type='text' style='background-color:#F00' name='compra' maxlength='50' id='compra' onclick= this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese número orden de compra. No Utilice /</font>" ;
												}else{
						$div_orden= "<input type='text' name='compra' id='compra' value='$compra' maxlength='50'/>";												 }
													
		 echo $div_orden; ?></td>
    </tr>
    <tr>
    <td>Fecha Emisión Orden de Compra</td>
    <td><?php 		if($fecha_orden_compra=="")	{
    					$div_fecha= "<input name='fecha_orden_compra' style='background-color:#F00' type='text' id = 'fecha_orden_compra' onclick =popCalendar.show(this,this,'dd/mm/yyyy','es');this.style.backgroundColor='#FFF' />"."<font color=#FF0000>Ingrese fecha de emisión</font>" ;
												}else{
						$fecha_orden_compra = DateConvertA($fecha_orden_compra);
						$div_fecha= "<input name='fecha_orden_compra' type='text' id = 'fecha_orden_compra' onclick =popCalendar.show(this,this,'dd/mm/yyyy','es') value='$fecha_orden_compra1' />";					 }
						
		  echo $div_fecha; ?></td>
    </tr>
	<tr>
    <td>Nro Cotización Asociado</td>
    <td><?php 		if($compra_combo[$i]==0)	{
						$div_combo= Compra_Combo()."<font color=#FF0000>Seleccione cotización asociada</font>"; 
												}else{
						$div_combo= Orden_Combo_Selected("compra_combo[]", $compra_combo[$i]);					 													 }
						
		  echo $div_combo; ?></td>
    </tr>
	<td>Rut Empresa</td>
    <td><?php 		if($rut=="")			{
						$div_rut= "<input type='text' style='background-color:#F00' name='rut' id='rut' maxlength='15' onclick= this.style.backgroundColor='#FFF' /> "."<font color=#FF0000>Ingrese rut de la empresa</font>" ;
											}else{
						$div_rut= "<input type='text' name='rut' id='rut' value='$rut' maxlength='15'/> " ;									 									 		 	 }
		 echo $div_rut; ?><input name="clientes" type="button" id="clientes" value="Ver Clientes" onclick = "window.open('ver_clientes.php', 'clientes','status = 1, height = 650, width = 1300, scrollbars=1, resizable = 0' )"/></td>
    </tr>
	<tr>
    <td></td>
    <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
      <input name="clientes2" type="button" id="clientes2" value="Buscar Rut Clientes en la Web" onclick = "window.open('http://www.mercantil.com/index.asp', 'clientes','status = 1, height = 650, width = 1300, scrollbars=1, resizable = 0' )"/></td>
    </tr>
	<td>Dirección Instalación/Entrega</td>
	<td><?php		if($direccion=="")		{
						$div_direccion="<input type='text' name='direccion' id='direccion' maxlength='100' style='WIDTH: 450px; HEIGHT: 22px; background-color:#F00' onclick= this.style.backgroundColor='#FFF' /> "."<font color=#FF0000>Ingrese direccion de la empresa</font>";
											}else{
						$div_direccion="<input type='text' name='direccion' id='direccion' maxlength='100' style='WIDTH: 450px; HEIGHT: 22px' value='$direccion'/>";			}
		echo $div_direccion; ?></td>
    </tr> 
    <tr>
    <td>Adjuntar Orden de Compra</td>
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
	}

?>