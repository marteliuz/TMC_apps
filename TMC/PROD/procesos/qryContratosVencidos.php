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
		DATEDIFF(fecha_termino, NOW()) AS vencimiento
FROM dbtmedia.tbcontratos AS t1,
	 dbtmedia.tbclientes AS t2,
	 dbtmedia.tbtipocontratos AS t3
WHERE 	t1.cliente = t2.idtbclientes AND 
		t1.tipo_contrato = t3.idtbtipocontratos AND
		t1.vigente = 1 AND
		DATEDIFF(fecha_termino, NOW()) < 90";
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
	
	$estilo="";
		if($Reg['vencimiento'] <=45)
		{
			$estilo='style="color:#DBDBDB; background:#C40000"';
		}
		if($Reg['vencimiento'] <=60 AND $Reg['vencimiento'] >45)
		{
			$estilo='style="color:#DBDBDB; background:#B29800"';
		}
		if($Reg['vencimiento'] >60)
		{
			$estilo='style="color:#DBDBDB; background:#1C9700"';
		}
?>
	<tr>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>"><?php echo $Reg['id_contrato']; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>"><?php echo $Reg['nombre_cliente']; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>"><?php echo $Reg['cliente_final']; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>" align="center"><?php echo $vigente; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>" align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_inicio'])); ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>" align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_termino'])); ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['SLA']; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>"><?php echo $Reg['tipo_contrato']; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['cantidad_terminales']; ?></td>
		<td <?php echo $estilo; ?>class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['vencimiento']; ?></td>
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