<?php
require('config.php');
require('lib_functions.php');

mysql_set_charset('utf8');

$qry = "SELECT 	
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,
		t1.fecha_inicio,
		t1.fecha_termino,
		t1.descripcion AS descripcion_contrato,
		DATEDIFF(t1.fecha_termino, NOW()) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		DATEDIFF(t1.fecha_termino, NOW()) > 45";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	echo "No hay info que mostrar.";
}else{

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=Tabla_Polycom_No_Vencidos.xls");

?>
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
		<td style="color:#DBDBDB" align= center>ID Terminal</td>
		<td style="color:#DBDBDB" align= center>Número de Serie</td>
		<td style="color:#DBDBDB" align= center>Modelo</td>
		<td style="color:#DBDBDB" align= center>Nombre Cliente</td>
		<td style="color:#DBDBDB" align= center>Fecha Inicio</td>
		<td style="color:#DBDBDB" align= center>Fecha Término</td>
		<td style="color:#DBDBDB" align= center>Descripción Contrato</td>
		<td style="color:#DBDBDB" align= center>Vencimiento</td>
	</tr>
<?php
	$i = 0 ;
	while($Reg = mysql_fetch_array($result))
	{
?>
	<tr>
		<td class="fila_<?php echo $i%2; ?>" align= center><?php echo $Reg['id_terminal']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['nserie']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['modelo']; ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['nombre_cliente']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_inicio'])); ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_termino'])); ?></td>
		<td class="fila_<?php echo $i%2; ?>"><?php echo $Reg['descripcion_contrato']; ?></td>
		<td class="fila_<?php echo $i%2; ?>" align="center"><?php echo $Reg['vencimiento']; ?></td>
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