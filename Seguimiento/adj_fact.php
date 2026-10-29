<head>
<meta content="300" http-equiv="REFRESH"> </meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='fun_seg.js'></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
</head>
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

$id        = $_GET['id'];
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);

$result= mysql_query("SELECT * FROM facturacion WHERE ID_Facturacion='$id'", $con);

 
$data=mysql_fetch_array($result);

$factura = $data['Nro_Factura'];

if($factura=="" OR $factura=="0"){

?>
<body OnLoad='compt=setTimeout("self.close();",250000)' text=black>
<blockquote>
<h2 style= color:#0073c4>Datos Factura</h2><br>
<form method="post" action="subir_adj_fact.php" enctype="multipart/form-data">
<table width="678" cellpadding="3" cellspacing="3"> 
<tr><td width="207">ID</td><td><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $id?>" /></td></tr>
<tr><td>Nro Factura</td><td><input type="text" name="factura" id="factura" onkeypress="return soloLetras(event)" maxlength="8" value="<?php echo $data["Nro_Factura"]?>" />Sólo números</td></tr>
<tr><td>Fecha Emisión Factura</td><td><input type="text" name="fecha2" id="fecha2" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Factura']) ?>" /></td></tr>
<tr><td>Nro Orden de Compra Asociada</td><td><input type="text" readonly="readonly" name="oc" id="oc" size="60" value="<?php echo $data['Nombre_Empresa'].'/'.$data['Nro_Cotizacion'].'/'.$data['Nro_Orden_Compra']?>" /></td></tr>
<tr><td>Adjuntar Factura</td><td><input type="file" name="archivo" id="archivo"></td></tr>
</tr> 
<td></td>
<td> <br/><input name="Enviar" type="submit" value="Enviar"/>&nbsp; &nbsp; &nbsp; &nbsp; <input name="button" type="button" onClick="window.close();" value="Cancelar" />
</tr>         
</table> 
</form>
</blockquote>
<div>
<?php

}else{
echo "<br>"."<br>"."<br>"."<h1 style= color:#0073c4>"."Factura ya ingresada"."<h1>"."<h4 style= color:#444>"."Esta venta ya se encuentra facturada con factura Nro $factura. Si desea editar esta factura, por favor dirijase al hipervinculo editar ubicado a un costado de la columna ID"."<h4>";
}
mysql_close($con);
?> 
</div>
</body>
</html>