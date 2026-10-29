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
include ("libreria.php"); ?>
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
<body OnLoad='compt=setTimeout("self.close();",250000)' text=black>
<blockquote>
<h2 style= color:#0073c4>Datos Orden de Compra</h2><br>
<form method="post" action="subir_orden_compra.php" enctype="multipart/form-data" name="form2" id="form2">
	<table width="940" cellpadding="3" cellspacing="3">
	<tr>
    <td width="300">Nro Orden de Compra </td>
    <td width="610"> <input type="text" name="compra" id="compra" maxlength="50" />No Utilice "/"</td>
    </tr>
    <tr>
    <td>Fecha Emisión Orden de Compra</td>
    <td><input name="fecha_orden_compra" type="text" id = "fecha_orden_compra" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/> </td>
    </tr>
	<tr>
    <td>Nro Cotización Asociado</td>
    <td><?php echo Compra_Combo(); ?></td>
    </tr>
	<tr>
    <td>Rut Empresa</td>
    <td><p>
      <input type="text" name="rut" id="rut" onkeypress="return soloLetras(event)" maxlength="15" /> 
      Sin puntos (Ej:8963946-8)&nbsp;<input name="clientes" type="button" id="clientes" value="Buscar Rut Clientes TM" onclick = "window.open('ver_clientes.php', 'clientes','status = 1, height = 650, width = 1300, scrollbars=1, resizable = 0' )"/></td>
	</tr>
    <td></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<input name="clientes2" type="button" id="clientes2" value="Buscar Rut Clientes en la Web" onclick = "window.open('http://www.mercantil.com/index.asp', 'clientes','status = 1, height = 650, width = 1300, scrollbars=1, resizable = 0' )"/></td>
    </tr>
	<td>Dirección Instalación/Entrega</td>
    <td><p>
      <input type="text" name="direccion" id="direccion" maxlength="100" style="WIDTH: 450px; HEIGHT: 22px"/></td>
	</tr>
    <tr>
    <td>Adjuntar Orden de Compra</td>
    <td> <input type="file" name="archivo" id="archivo"></td>
    </tr> 
    <td></td>
    <td> <br/><input type="submit" name="Enviar" id="Enviar" value="Enviar"/>&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
    </tr>         
    </table>                                                                 
</form>
</blockquote>
</body>
    
