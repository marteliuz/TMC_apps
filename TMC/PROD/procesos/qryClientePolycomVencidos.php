<?php
require('config.php');
require('lib_functions.php');

mysql_set_charset('utf8');

		$qry = "SELECT
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,	
		t5.fecha_termino AS f_c,
		t1.fecha_termino AS f_po,
		t6.descripcion AS tipo_contrato,
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4,
	 dbtmedia.tbcontratos         AS t5,
	 dbtmedia.tbtipocontratos 	  AS t6
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		t5.tipo_contrato = t6.idtbtipocontratos AND
		t2.contrato_polycom = t1.idtbcontratos_polycom AND
		t2.contrato = t5.idtbcontratos AND
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) <= 0";
		
$result   = mysql_query($qry);

$num_rows = mysql_num_rows($result);

if($num_rows==0)
{
echo "No hay info que mostrar.";
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<div style="float: right"><a href="exportar_excel_cliente_polycom_vencidos.php"><img src="../resources/excel.png" alt="excel" title="exportar a excel" width="50" height="49" longdesc="excel.png" ></img></a></div>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vencimientos proximos</title>
<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
<style type="text/css">
.fila_0 { background-color: ;}
.fila_1 { background-color: #DCD5D5;}
</style>
</head>
<body>
<table border="0">
	<tr bgcolor="#999999">
		<td style="color:#DBDBDB" align= center>ID Terminal</td>
		<td style="color:#DBDBDB" align= center>Número de Serie</td>
		<td style="color:#DBDBDB" align= center>Modelo</td>
		<td style="color:#DBDBDB" align= center>Nombre Cliente</td>
		<td style="color:#DBDBDB" align= center>Fecha Término Cliente</td>
		<td style="color:#DBDBDB" align= center>Fecha Término Polycom</td>
		<td style="color:#DBDBDB" align= center>Tipo Contrato</td>
		<td style="color:#DBDBDB" align= center>Diferencia de días<br>entre vencimientos</td>
		<td style="color:#DBDBDB" align= center>Acción a tomar</td>
	</tr>
<?php
	$i = 0 ;
	while($Reg = mysql_fetch_array($result))
	{
		// $diferencia= -$Reg['vencimiento']/30;
		
		// $str= explode('.', $diferencia);
		// $meses 	= $str[0];
		// $dias 	= $str[1];
		
			if($Reg['tipo_contrato']=="Garantía"){
				
			$accion= "Sólo con Garantía TM";	
			
			}else{
			
			$accion= "Renovar contrato con Proveedor";
			}
			
?>
	<tr>
		<td class="fila_<?php echo $i%2; ?>" align= center><?php echo $Reg['id_terminal']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['nserie']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align=center><?php echo $Reg['modelo']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['nombre_cliente']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align=center><?php echo date("d-m-Y", strtotime($Reg['f_c'])); ?></td>
		<td class="fila_<?php echo $i%2; ?>" align=center><?php echo date("d-m-Y", strtotime($Reg['f_po'])); ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['tipo_contrato']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align=center><?php echo $Reg['vencimiento']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align=center><?php echo $accion; ?></td>
	</tr>
<?php
			$i ++;
	}
?>
</table>
</body>
</html>
<?php
}
?>