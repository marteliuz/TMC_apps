<?php include ("fecha.php");

	$where			= stripslashes($_POST['where']);
	

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("inventario", $con);

$qry = "SELECT * FROM inventario_usado ".$where; 
 
$result = mysql_query($qry);


$var = mysql_affected_rows();
	if ($var>0){
		
		$numero = mysql_num_rows($result);

		$reg = mysql_fetch_array($result);

echo "<table width=800 border=0 cellpadding=3 cellspacing=0>";

echo "<td><h2>INVENTARIO HISTÓRICO UTILIZADO<h2></td>";
echo "<td><font size=2>Total de Existencias: </font></td>";
echo "<td><B><font size=2 color= red>".$numero."</font></B></td>";
echo "</table>";

echo "<table width=1500 border=1 cellpadding=3 cellspacing=0>";
		 
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>ID</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Guía Despacho</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho Retiro</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Factura</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Serie</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nombre</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Categoría</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Marca</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Moneda</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Valor</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Ingreso</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Descripción</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Lugar</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Ingreso</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Control</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Control</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Salida</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Salida</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Cliente</font></B></td>";

echo "</tr>";
while($reg)
{
	echo "<td align= center><font size=2>".$reg["ID_Inv"]."</font></td>";
	echo "<td align= center><font size=2>".Tipo_Guia($reg["Tipo_Guia"])."</font></td>";
	echo "<td align= center><font size=2>".$reg["Guia_Despacho"]."</font></td>";
	echo "<td align= center><font size=2>".$reg["Guia_Despacho_Retiro"]."</font></td>";
	echo "<td align= center><font size=2>".$reg["Factura_Venta"]."</font></td>";
	echo "<td align= center><font size=2>".$reg["Nro_Serie"]."</font></td>";
	echo "<td align= center><font size=2>".$reg["Nombre"]."</font></td>";
	echo "<td align= center><font size=2>".Categoria($reg["Categoria"])."</font></td>";
	echo "<td align= center><font size=2>".Marca($reg["Marca"])."</font></td>";
	echo "<td align= center><font size=2>".Tipo_Moneda($reg["Tipo_Moneda"])."</font></td>";
	echo "<td align= center><font size=2>".$reg["Valor"]."</font></td>";
	echo "<td align= center><font size=2>".DateConvertB($reg['Fecha_Ingreso'])."</font></td>";
	echo "<td align= center><font size=2>".$reg["Descripción"]."</font></td>";
	echo "<td align= center><font size=2>".Lugar($reg["Lugar"])."</font></td>";
	echo "<td align= center><font size=2>".$reg["Encargado_Ingreso"]."</font></td>";
	echo "<td align= center><font size=2>".$reg["Encargado_Control"]."</font></td>";
	echo "<td align= center><font size=2>".DateConvertB($reg['Fecha_Control'])."</font></td>";
	echo "<td align= center><font size=2>".DateConvertB($reg['Fecha_Salida'])."</font></td>";
	echo "<td align= center><font size=2>".$reg["Encargado_Salida"]."</font></td>";
	echo "<td align= center style=color:blue><font size=2><B>".Cliente($reg["Cliente"])."<B></font></td>";
	$reg = mysql_fetch_array($result);
	
	
	echo "</tr>";
}

echo "</table>";

}else{
		echo "<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<B><font size=3 color=#FF0000>Lo sentimos. No se encuentra ningún objeto con las características especificadas</font><B>";
	
	
}
	mysql_close($con);
?>
 