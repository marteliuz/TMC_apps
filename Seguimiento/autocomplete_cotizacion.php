<?php
$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);
	
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT Nro_Cotizacion from facturacion where Nro_Cotizacion LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['Nro_Cotizacion'];
	echo "$cname\n";
}
?>