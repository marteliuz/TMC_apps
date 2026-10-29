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
	
	$qry ="SELECT * FROM tbtransporte";
	
	$result =mysql_query($qry);

	$var = mysql_affected_rows();

if ($var>0){
	echo "<B><font size=5>Tabla Valores de Transporte</font></B>"."<font color=#FF0000 size=3>&nbsp;&nbsp; Valores en pesos chilenos</font>"."<br>";
	echo "<table width=2000 border=1 cellpadding=3 cellspacing=0>";
	echo "<td align= center><B><font size=2></font></B></td>";
	echo "<td align= center><B><font size=2>Zona</font></B></td>";
	echo "<td align= center><B><font size=2>Base</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Premium Carro Móvil</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Premium Códec</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Premium Monitor</font></B></td>";
	echo "<td align= center><B><font size=2>Entrega Premium</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Priority Carro Móvil</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Priority Códec</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Priority Monitor</font></B></td>";
	echo "<td align= center><B><font size=2>Entrega Priority</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Express Carro Móvil</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Express Códec</font></B></td>";
	echo "<td align= center><B><font size=2>Tarifa Express Monitor</font></B></td>";
	echo "<td align= center><B><font size=2>Entrega Express</font></B></td>";
	echo "</tr>";
	
	while ($row=mysql_fetch_array($result)){
	echo"<td align= center><a href='javascript:poponload4(".$row['idtbtransporte'].")'>Modificar</a></td>";
		echo"<td align= center>".$row['zona']."</td>";
		echo"<td align= center>".$row['base']."</td>";
		echo"<td align= center>".$row['tarifa_premium_carro_movil']."</td>";
		echo"<td align= center>".$row['tarifa_premium_codec']."</td>";
		echo"<td align= center>".$row['tarifa_premium_monitor']."</td>";
		echo"<td align= center>".$row['entrega_premium']."</td>";
		echo"<td align= center>".$row['tarifa_priority_carro_movil']."</td>";
		echo"<td align= center>".$row['tarifa_priority_codec']."</td>";
		echo"<td align= center>".$row['tarifa_priority_monitor']."</td>";
		echo"<td align= center>".$row['entrega_priority']."</td>";
		echo"<td align= center>".$row['tarifa_express_carro_movil']."</td>";
		echo"<td align= center>".$row['tarifa_express_codec']."</td>";
		echo"<td align= center>".$row['tarifa_express_monitor']."</td>";
		echo"<td align= center>".$row['entrega_express']."</td>";
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