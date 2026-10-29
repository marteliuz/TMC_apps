<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}?>
<script type="text/javascript" src="fun_cotizacion.js"></script>
<form name="formDatos">
<?php 
include ("libreria.php");
	
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("dbmaster",$con);
	
	$qry ="SELECT * FROM tbmantencion";
	
	$result =mysql_query($qry);

	$var = mysql_affected_rows();

if ($var>0){
	echo "<B><font size=5>Tabla Servicios de Mantención</font></B>"."<br>";
	echo "<table width=2000 border=1 cellpadding=3 cellspacing=0>";
	echo "<td align= center><B><font size=2></font></B></td>";
	echo "<td align= center><B><font size=2>Nombre</font></B></td>";
	echo "<td align= center><B><font size=2>Part-Number</font></B></td>";
	echo "<td align= center><B><font size=2>Categoría</font></B></td>";
	echo "<td align= center><B><font size=2>Part-Number Asociado</font></B></td>";
	echo "<td align= center><B><font size=2>Descripción</font></B></td>";
	echo "<td align= center><B><font size=2>Tipo de Moneda</font></B></td>";
	echo "<td align= center><B><font size=2>Precio</font></B></td>";
	echo "</tr>";
	
	while ($row=mysql_fetch_array($result)){
	echo"<td align= center><a href='javascript:poponload3(".$row['idtbmantencion'].")'>Modificar</a></td>";
		echo"<td align= center>".$row['nombre']."</td>";
		echo"<td align= center>".$row['part_number']."</td>";
		echo"<td align= center>".Categoria($row['categoria'])."</td>";
		echo"<td align= center>".$row['part_number_asociado']."</td>";
		echo"<td  class= align.align { text-align: justify; padding:3px }>".nl2br($row['descripcion'])."</td>";
		echo"<td align= center>".Tipo_Moneda($row['moneda'])."</td>";
		echo"<td align= center>".$row['precio']."</td>";
		echo"</tr>";
		echo "</tr>";
		}

		echo "</table>"; 

		}else{
		echo "<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<B><font size=3 color=#FF0000>Lo sentimos. No se encuentra ningún objeto con las características especificadas</font><B>";
}

mysql_close($con); 
?>
</form>