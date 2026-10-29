<script type="text/javascript" src="fun_inv.js"></script>
<style media="print" type="text/css">
#oculto {
visibility:hidden
}
</style>
<?php

$categoria	 = $_POST['categoria'];
$marca		 = $_POST['marca'];
$lugar		 = $_POST['lugar'];
$cliente	 = $_POST['cliente'];
	
include ("fecha.php");
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	if($categoria>0){
	$result = mysql_query ("SELECT * FROM inventario_usado WHERE Categoria='$categoria' ORDER BY Nombre, Fecha_Salida");
	}
	if($marca>0){
	$result = mysql_query ("SELECT * FROM inventario_usado WHERE Marca='$marca' ORDER BY Nombre, Fecha_Salida");
	}
	if($lugar>0){
	$result = mysql_query ("SELECT * FROM inventario_usado WHERE Lugar='$lugar' ORDER BY Nombre, Fecha_Salida");
	}
	if($cliente>0){
	$result = mysql_query ("SELECT * FROM inventario_usado WHERE Cliente='$cliente' ORDER BY Nombre, Fecha_Salida");
	}
	$numero = mysql_num_rows($result);
	?>
   <table width="1000" cellpadding="3" cellspacing="3">
    <tr>
    <td width="900"><?php echo"<h2>INVENTARIO HISTÓRICO UTILIZADO<h2>"?></td>
<td id= "oculto" width="531"><a href="javascript:imprime()"><img src="boton_imprimir.png" alt="imprimir" longdesc="boton-imprimir.jpg" ></img></a></td>
	 </tr>
     </table>
     <table width="1337" cellpadding="3" cellspacing="3">
    <tr>  
    <td id= "oculto" width="330">Filtrar por: Categoría
      <?php echo Categoria_Ver_Combo1_Visita()?></td>
        <td width="200" id= "oculto">Marca<?php echo Marca_Ver_Combo1_Visita()?></td>
        <td width="869" id= "oculto">Bodega<?php echo Lugar_Ver_Combo1_Visita()?></td> </tr>
     </table>
     <table width="1337" cellpadding="3" cellspacing="3">
    <tr> 
        <td width="530" id= "oculto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Cliente_Ver_Combo1_Visita()?></td>
        <td width="745" id= "oculto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL EXISTENCIAS:&nbsp;<?php echo "<font color=red size=4>$numero</font></B>" ?></td>
        </tr>                   
	</table>
<?php
		echo "<table width=1600 border=1 cellpadding=3 cellspacing=0>";
		
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>ID</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Guía Despacho</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho Ingreso</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho Retiro</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Factura</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Serie</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nombre</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Categoría</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Marca</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Moneda</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Valor</font></B></td>";
echo "<td align= center width= 80 bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Ingreso</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Descripción</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Lugar</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Ingreso</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Control</font></B></td>";
echo "<td align= center width= 80 bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Control</font></B></td>";
echo "<td align= center width= 80 bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Salida</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Salida o Modificación</font></B></td>";
echo "<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Cliente</font></B></td>";

echo "</tr>";
	$reg = mysql_fetch_array($result, MYSQL_BOTH);
	
	{
		 while($reg)
{

$formato_precio  = number_format($reg['Valor'],  2,  ',',  '.');


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
echo "<td align= center><font size=2>".$formato_precio."</font></td>";
echo "<td align= center><font size=2>".DateConvertB($reg['Fecha_Ingreso'])."</font></td>";
echo "<td align= center><font size=2>".$reg["Descripción"]."</font></td>";
echo "<td align= center><font size=2>".Lugar($reg["Lugar"])."</font></td>";
echo "<td align= center><font size=2>".$reg["Encargado_Ingreso"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Encargado_Control"]."</font></td>";
echo "<td align= center><font size=2>".DateConvertB($reg['Fecha_Control'])."</font></td>";
echo "<td align= center><font size=2>".DateConvertB($reg['Fecha_Salida'])."</font></td>";
echo "<td align= center><font size=2>".$reg["Encargado_Salida"]."</font></td>";
echo "<td align= center style=color:blue><font size=2><B>".Cliente($reg["Cliente"])."<B></font></td>";
$reg = mysql_fetch_array($result, MYSQL_BOTH);
echo "</tr>";
}
echo "</table>";
    
	mysql_close($con);
	}
	?>