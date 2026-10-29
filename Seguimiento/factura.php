<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");}else { 
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
include ("libreria.php"); ?>
<meta content="300" http-equiv="REFRESH"> </meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script language='javascript' src='popcalendar.js'></script>

<body OnLoad='compt=setTimeout("self.close();",250000)' text=black>
<blockquote>
<h2 style= color:#0073c4>Datos Factura</h2><br>
<form method="post" action="subir_factura.php" enctype="multipart/form-data" name="form3" id="form3">
	<table width="678" cellpadding="3" cellspacing="3">
		<tr>
           <td width="207">Nro Factura </td>
             <td> <input type="text" name="factura" id="factura" onkeypress="return soloLetras(event)" maxlength="8"/>Sólo números
           </td>
      </tr>
       <tr>
      <td>Fecha Emisión Factura</td>
           <td><input name="fecha_factura" type="text" id = "fecha_factura" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/> </td>
      </tr>
		 <tr>
           <td>Nro Orden de Compra Asociada</td>
           <td><?php echo Factura_Combo();?></td>
         </tr>
         <tr>
           <td>Adjuntar Factura</td>
           <td> <input type="file" name="archivo" id="archivo"></td>
         </tr> 
         <td></td>
           <td> <br/><input type="submit" name="Enviar" id="Enviar" value="Enviar"/>&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
         </tr>         
    </table>                                                                 
</form>
    </blockquote>
	</body>
	