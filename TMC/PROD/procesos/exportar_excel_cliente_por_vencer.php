<?php
require('config.php');
require('lib_functions.php');

mysql_set_charset('utf8');

$qry = "SELECT 	
		t1.id_contrato,
		t2.nombre_cliente,
		t1.cliente_final,
		t1.vigente,
		t1.fecha_inicio,
		t1.fecha_termino,
		t1.SLA,
		t3.descripcion AS tipo_contrato,
		(SELECT count(*) FROM dbtmedia.tbterminales WHERE contrato = t1.idtbcontratos) AS cantidad_terminales,
		DATEDIFF(fecha_termino, NOW()) AS vencimiento,
		t1.idtbcontratos
FROM dbtmedia.tbcontratos AS t1,
	 dbtmedia.tbclientes AS t2,
	 dbtmedia.tbtipocontratos AS t3
WHERE 	t1.cliente = t2.idtbclientes AND 
		t1.tipo_contrato = t3.idtbtipocontratos AND
		t1.vigente = 1 AND
		DATEDIFF(fecha_termino, NOW()) <= 45";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	echo "No hay info que mostrar.";
}else{

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=Tabla_Cliente_Por_Vencer.xls");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vencimientos proximos</title>
<style type="text/css">
.fila_0 { background-color: ;}
.fila_1 { background-color: #DCD5D5;}
</style>
</head>
<body>
<table border="0">
	<tr bgcolor="#999999">
		<td style="color:#DBDBDB" align= center>ID Contrato</td>
		<td style="color:#DBDBDB" align= center>Nombre Cliente</td>
		<td style="color:#DBDBDB" align= center>Cliente Final</td>
		<td style="color:#DBDBDB" align= center>Vigente</td>
		<td style="color:#DBDBDB" align= center>Fecha Inicio</td>
		<td style="color:#DBDBDB" align= center>Fecha Término</td>
		<td style="color:#DBDBDB" align= center>SLA</td>
		<td style="color:#DBDBDB" align= center>Tipo Contrato</td>
		<td style="color:#DBDBDB" align= center>Terminales<br>asociados</td>
		<td style="color:#DBDBDB" align= center>Próximo<br>vencimiento</td>
		<td style="color:#DBDBDB" align= center>Productos</td>
	</tr>
<?php
	$i = 0 ;
	while($Reg = mysql_fetch_array($result))
	{
		if($Reg['vigente']==1)
		{
			$vigente = "Si";
		}else{
			$vigente = "No";
		}
	
?>
	<tr>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['id_contrato']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['nombre_cliente']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['cliente_final']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo $vigente; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_inicio'])); ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_termino'])); ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['SLA']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['tipo_contrato']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['cantidad_terminales']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['vencimiento']; ?></td>
		<td align= center><input type="button" name="productos" id="productos" value ="Ver Productos" onclick="window.open('VerProductos1.php?id=<?php echo $Reg['idtbcontratos'] ?>', 'Ver','status = 1, height = 500, width = 600, scrollbars=1, resizable = 0')"></td>
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