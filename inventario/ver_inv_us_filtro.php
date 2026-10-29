<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}?>
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
    <td width="900"><?php echo"<h2>INVENTARIO HISTÓRICO UTILIZADO<h2>"
?></td>
<td id= "oculto" width="531"><a href="javascript:imprime()"><img src="boton_imprimir.png" alt="imprimir" longdesc="boton-imprimir.jpg" ></img></a></td>
	 </tr>
     </table>
     <table width="1337" cellpadding="3" cellspacing="3">
    <tr>  
    <td id= "oculto" width="330">Filtrar por: Categoría
      <?php echo Categoria_Ver_Combo1()?></td>
        <td width="200" id= "oculto">Marca<?php echo Marca_Ver_Combo1()?></td>
        <td width="869" id= "oculto">Bodega<?php echo Lugar_Ver_Combo1()?></td> </tr>
     </table>
     <table width="1337" cellpadding="3" cellspacing="3">
    <tr> 
         <td width="530" id= "oculto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Cliente_Ver_Combo1_Visita()?></td>
        <td width="745" id= "oculto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL EXISTENCIAS:&nbsp;<?php echo "<font color=red size=4>$numero</font></B>" ?></td>
       </tr>                   
	</table>

		<table width=1600 border=1 cellpadding=3 cellspacing=0>
		
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>ID</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Tipo Guía Despacho</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho Ingreso</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Nro Guía Despacho Retiro</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Factura</font></B></td>
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
<td align= center width= 80 bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Fecha de Salida</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Encargado de Salida o Modificación</font></B></td>
<td align= center bgcolor='#0073c4'><B><font size=2 color=#FFFFF>Cliente</font></B></td>

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
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Guia_Despacho"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Guia_Despacho_Retiro"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Factura_Venta"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nro_Serie"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Nombre"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Categoria($reg["Categoria"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Marca($reg["Marca"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Tipo_Moneda($reg["Tipo_Moneda"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $formato_precio ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg['Fecha_Ingreso']) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Descripción"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo Lugar($reg["Lugar"]) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Encargado_Ingreso"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Encargado_Control"] ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg['Fecha_Control']) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo DateConvertB($reg['Fecha_Salida']) ?></font></td>
<td align= center class="fila_<?php echo $i%2; ?>"><font size=2><?php echo $reg["Encargado_Salida"] ?></font></td>
<td align= center style=color:blue class="fila_<?php echo $i%2; ?>"><font size=2><B><?php echo Cliente($reg["Cliente"]) ?><B></font></td>
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
