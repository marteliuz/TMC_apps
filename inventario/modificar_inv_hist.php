<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");
$id        = $_GET['id'];
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$result= mysql_query("SELECT * FROM inventario_usado WHERE ID_Inv='$id'", $con);

$data=mysql_fetch_array($result); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='fun_inv.js'></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
</head>
<body>
<form name="form1" method="post">
<table width="658">
<tr><td width="205"><font size=2 color=#000000>ID</td><td width="441"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $data["ID_Inv"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Tipo de Guía</td><td><?php Tipo_Guia_Combo_Selected('tipo',$data["Tipo_Guia"]); ?></td></tr>
<tr>
  <td><font size=2 color=#000000>Nro Guía de Despacho Ingreso</font></td><td><input type="text" name="guia" id="guia" value="<?php echo $data["Guia_Despacho"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Nro Guía de Despacho de Retiro</font></td><td><input type="text" name="guia1" id="guia1" value="<?php echo $data["Guia_Despacho_Retiro"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Nro Factura</font></td><td><input type="text" name="factura" id="factura" value="<?php echo $data["Factura_Venta"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Nro de Serie</font></td><td><input type="text" name="serie" id="serie" value="<?php echo $data["Nro_Serie"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Nombre</font></td><td><input type="text" name="nombre" id="nombre" value="<?php echo $data["Nombre"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Categoría</font></td><td><?php Categoria_Combo_Selected('categoria',$data["Categoria"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Marca</font></td><td><?php Marca_Combo_Selected('marca',$data["Marca"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Tipo de Moneda</font></td><td><?php Tipo_Moneda_Combo_Selected('moneda',$data["Tipo_Moneda"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Valor</font></td><td><input type="text" name="valor" id="valor" value="<?php echo $data["Valor"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Fecha de Ingreso</font></td><td><input type="text" name="fecha"  id="fecha" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Ingreso']) ?>" /></td></tr>
<tr><td><font size=2 color=#000000>Descripción</font></td><td><input type="text" name="descripcion" id="descripcion" value="<?php echo $data["Descripción"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Lugar</font></td><td><?php Lugar_Combo_Selected('lugar',$data["Lugar"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Encargado de Ingreso</font></td><td><input type="text" name="encargado" id="encargado" value="<?php echo $data["Encargado_Ingreso"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Encargado de Control</font></td><td><input type="text" name="encargado1" id="encargado1" value="<?php echo $data["Encargado_Control"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Fecha de Control</font></td><td><input type="text" name="fecha1" id="fecha1" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Control'])?>" /></td></tr>
<tr><td><font size=2 color=#000000>Fecha de Salida</font></td><td><input type="text" name="fecha2" id="fecha2" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Salida'])?>" /></td></tr>
<tr><td><font size=2 color=#000000>Encargado de Salida</font></td><td><input type="text" name="encargado2" id="encargado2"value="<?php echo $data["Encargado_Salida"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Cliente</font></td><td><?php Cliente_Combo_Selected('cliente',$data["Cliente"]); ?></td></tr>
</table>
<a href='#' title="enviar" onClick="editar();"><img src='enviar.png' height="29"></a>
<a href='#' title="enviar" onClick="window.close();"><img src='borrar.png'></a>
</form>
</body>
</html>
<?php
mysql_close($con);

?> 