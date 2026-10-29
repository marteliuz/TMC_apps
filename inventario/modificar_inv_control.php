<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}?>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<?php
include ("fecha.php");
$id        = $_GET['id'];
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$result= mysql_query("SELECT * FROM inventario WHERE ID_Inv='$id'", $con);
$data=mysql_fetch_array($result);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
</head>
<body>
<form name="form1" method="post">
<table>
<tr><td width="201"><font size=2 color=#000000>ID</font></td><td width="258"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $data["ID_Inv"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Tipo de Guía</font></td><td><?php Tipo_Guia_Combo_Selected('tipo',$data["Tipo_Guia"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Nro Guía de Despacho</font></td><td><input type="text" name="guia" id="guia" value="<?php echo $data["Guia_Despacho"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Nro de Serie</font></td><td><input type="text" name="serie" id="serie" value="<?php echo $data["Nro_Serie"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Nombre</font></td><td><input type="text" name="nombre" id="nombre" value="<?php echo $data["Nombre"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Categoría</font></td><td><?php Categoria_Combo_Selected('categoria',$data["Categoría"]); ?> </td><td width="10"></td></tr>
<tr><td><font size=2 color=#000000>Marca</font></td><td><?php Marca_Combo_Selected('marca',$data["Marca"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Tipo de Moneda</font></td><td><?php Tipo_Moneda_Combo_Selected('moneda',$data["Tipo_Moneda"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Valor</font></td><td><input type="text" name="valor" id="valor" value="<?php echo $data["Valor"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Fecha de Ingreso</font></td><td><input type="text" name="fecha"  id="fecha" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Ingreso']) ?>" /></td></tr>
<tr><td><font size=2 color=#000000>Descripción</font></td><td><input type="text" name="descripcion" id="descripcion" value="<?php echo $data["Descripción"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Lugar</font></td><td><?php Lugar_Combo_Selected('lugar',$data["Lugar"]); ?></td></tr>
<tr><td><font size=2 color=#000000>Encargado de Ingreso</font></td><td><input type="text" name="encargado" id="encargado" value="<?php echo $data["Encargado_Ingreso"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Encargado de Control</font></td><td><input type="text" name="encargado1" id="encargado1" value="<?php echo $data["Encargado_Ingreso"]?>" /></td></tr>
<tr><td><font size=2 color=#000000>Fecha de Control</font></td><td><input type="text" name="fecha1"  id="fecha1" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo DateConvertA($data['Fecha_Control']) ?>" /></td></tr>
</table>
<a href='#' title="enviar" onClick="editar2();"><img src='enviar.png' height="29"></a>
<a href='#' title="enviar" onClick="window.close();"><img src='borrar.png'></a>
</form>
</body>
</html>
<?php
mysql_close($con);

?> 