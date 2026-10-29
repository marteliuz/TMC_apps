<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}?>
<script type="text/javascript" src="fun_inv.js"></script>
<form name="formDatos" method="post">
<?php 
include ("fecha.php");
	
	$where = stripslashes($_POST['where']);
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);
	$qry ="SELECT ID_Inv,Tipo_Guia, Guia_Despacho, Nro_Serie, Nombre, Categoría, Marca, Tipo_Moneda, Valor, Fecha_Ingreso, Descripción, Lugar, Encargado_Ingreso FROM inventario ".$where;
	// echo ($qry);
	$result =mysql_query($qry);

$var = mysql_affected_rows();
if ($var>0){
	echo "<h2>INVENTARIO ACTUAL<h2>";
	echo "<a href='#' title='enviar' onClick='seleccion();'><img src='enviar.png'></a>";
	echo "&nbsp;"."<img src='borrar.png' onclick='document.formDatos.reset()' style='CURSOR:hand' title='borrar'>";
	echo "<table width=1500 border=1 cellpadding=3 cellspacing=0>";
	echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF></font></B></td>";
	echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Guía Despacho</font></B></td>";
	echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho</font></B></td>";
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
	echo "</tr>";
	
	while ($row=mysql_fetch_array($result)){
	echo"<td><input type='checkbox' name='chckbx' value=".$row['ID_Inv']."></td>
		<td>".Tipo_Guia($row['Tipo_Guia'])."</td>
		<td>".$row['Guia_Despacho']."</td>
		<td>".$row['Nro_Serie']."</td>
		<td>".$row['Nombre']."</td>
		<td>".Categoria($row['Categoría'])."</td>
		<td>".Marca($row['Marca'])."</td>
		<td>".Tipo_Moneda($row['Tipo_Moneda'])."</td>
		<td>".$row['Valor']."</td>
		<td>".DateConvertB($row['Fecha_Ingreso'])."</td>
		<td>".$row['Descripción']."</td>
		<td>".Lugar($row['Lugar'])."</td>
		<td>".$row['Encargado_Ingreso']."</td>
		</tr>";
	echo "</tr>";
	}

echo "</table>"; 

}else{
	echo "<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<B><font size=3 color=#FF0000>Lo sentimos. No se encuentra ningún objeto con las características especificadas</font><B>";
}
mysql_close($con); 
?>
</form>
