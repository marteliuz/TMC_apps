<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}
include ("fecha.php");
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$result = mysql_query ("SELECT * FROM inventario ORDER BY Nombre");
	
	$numero = mysql_num_rows($result);
	
	
	$r=mysql_query("SELECT SUM(Valor) as total FROM inventario WHERE Tipo_Moneda ='2'");
	$row = mysql_fetch_array($r);
	
	$r1=mysql_query("SELECT SUM(Valor) as total1 FROM inventario WHERE Tipo_Moneda ='1'");
	$row1 = mysql_fetch_array($r1);
	$enpesos = $row1["total1"]*500;
	
	$r2=mysql_query("SELECT SUM(Valor) as total2 FROM inventario WHERE Tipo_Moneda ='3'");
	$row2 = mysql_fetch_array($r2);
	$enpesos1 = $row2["total2"]*23000;
	
	$r3=mysql_query("SELECT SUM(Valor) as total3 FROM inventario WHERE Tipo_Moneda ='4'");
	$row3 = mysql_fetch_array($r3);
	$enpesos2 = $row3["total3"]*700;
	
	
	$t= $row["total"]+$enpesos+$enpesos1+$enpesos2;
	$formato_precio  = number_format($t,  0,  ',',  '.');
	?>
	<head>
	<script type="text/javascript" src="fun_inv.js"></script>
<style media="print" type="text/css">
#oculto {
visibility:hidden
}
</style>
<style type="text/css">
.fila_0 { background-color: ;}
.fila_1 { background-color: #D3EDFF;}
</style>
<head>
    <table width="600" cellpadding="3" cellspacing="3">
    <tr>
    <td width="500"><?php echo"<h2>INVENTARIO ACTUAL<h2>"?></td>
	<td id= "oculto" width="173"><a href="javascript:imprime()"><img src="boton_imprimir.png" alt="imprimir" longdesc="boton-imprimir.jpg" ></img></a></td>
     </tr> 
	 </table>	
    <table width="1200">
          <tr>   
    <td id= "oculto" width="350">Filtrar por: Categoría
      <?php echo Categoria_Ver_Combo()?></td>
       <td id= "oculto" width="210">Marca<?php echo Marca_Ver_Combo()?></td>
       <td width="180" id= "oculto">Bodega<?php echo Lugar_Ver_Combo()?></td>
       <td width="250" id= "oculto"><B>TOTAL EXISTENCIAS:</B>&nbsp;<?php echo "<font color=red size=4>$numero</font>"?></td>
       <td width="350" id= "oculto"><B>TOTAL VALORIZADO:</B>&nbsp;<font color=red>$</font> <?php echo "<font color=red size=4>$formato_precio</font>"?></td>
	   </tr>                   
	</table> 

	
		<table width=1500 border=1 cellpadding=3 cellspacing=0>
		 
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>ID</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Guía Despacho</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Serie</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nombre</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Categoría</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Marca</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Moneda</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Valor</font></B></td>
<td align= center width= 80 bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Ingreso</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Descripción</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Lugar</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Ingreso</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Control</font></B></td>
<td align= center width= 80 bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Control</font></B></td>

</tr>
<?php
$i = 0 ;
	$reg = mysql_fetch_array($result, MYSQL_BOTH);
	
	{
		 while($reg)
{

$formato_precio  = number_format($reg['Valor'],  2,  ',',  '.');
?>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["ID_Inv"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Tipo_Guia($reg["Tipo_Guia"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo$reg["Guia_Despacho"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nro_Serie"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nombre"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Categoria($reg["Categoría"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Marca($reg["Marca"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Tipo_Moneda($reg["Tipo_Moneda"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $formato_precio ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg['Fecha_Ingreso']) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Descripción"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Lugar($reg["Lugar"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Encargado_Ingreso"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Encargado_Control"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg['Fecha_Control']) ?></font></td>
<tr>
<?php
$i ++;
$reg = mysql_fetch_array($result, MYSQL_BOTH);

}

	mysql_close($con);
	}
	?>
</table>
</form>
</div>
</body>
</html>
