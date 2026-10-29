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
      window.close(); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
} 
include ("libreria.php"); ?>
<html>
<head>
<meta content="300" http-equiv="REFRESH"> </meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<script type="text/javascript" language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script type="text/javascript" src="jquery.js" ></script>
<script type='text/javascript' src="jquery.autocomplete.js" ></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script>

//$.noConflict();
//  jQuery(document).ready(function($) {
//  });
//Codigo que utiliza la otra libreria con el signo $ puede comenzar acá

	//noConflict();

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
             <td> <input type="text" name="cotizacion" id="cotizacion" maxlength="50" /></td>
      </tr>
      <tr>
      <td>Fecha Emisión Cotización</td>
           <td><input name="fecha_cotizacion" type="text" id = "fecha_cotizacion" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/> </td>
            </tr>
		 <tr>
           <td>Nombre Empresa</td>
           <td><input type="text" name="empresa" id="empresa" maxlength="50"/></td>
         </tr>
         <tr>
           <td>Nombre Contacto</td>
           <td><input type="text" name="nombre" id="nombre" maxlength="50"/></td>
         </tr>
          <tr>
           <td>E-mail Contacto</td>
           <td><input type="text" name="correo" id="correo" maxlength="50" /></td>
         </tr>
          <tr>
           <td>Teléfono Contacto</td>
           <td><input type="text" name="telefono" id="telefono" onKeyPress="return soloLetras(event)" maxlength="12" /></td>
         </tr>
		 <tr>
           <td>Monto</td>
           <td><?php echo Tipo_Moneda_Combo(); ?><input type="text" name="valor" id="valor" onKeyPress="return soloLetras(event)" maxlength="21"/></td>
         </tr>
		 <tr>
           <td>Vendedor</td>
           <td><input type="text" readonly="readonly" name="vendedor" id="vendedor" style="color:#00C; font-weight:bold;" value="<?php echo Seguimiento_Vendedor($_SESSION['rut'])?>" /></td>
         </tr> 
         <tr>
           <td>Adjuntar Cotización</td>
           <td> <input type="file" name="archivo" id="archivo"></td>
         </tr> 
          <tr>   
         <td></td>
           <td> <br/><input type="submit" name="Enviar" id="Enviar" value="Enviar"/>&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
         </tr>         
        </table>                                                                 
	</form>
    </blockquote>
</body>