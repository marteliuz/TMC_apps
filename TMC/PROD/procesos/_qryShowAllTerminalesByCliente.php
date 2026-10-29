<?php
include("config.php");
session_start();
$id_cliente = $_POST['id_cliente'];
$qry = "
SELECT 	t1.idtbterminales AS id_terminal,
		t2.nombre_cliente,
		t5.descripcion AS modelo,
		t1.nserie,
		t1.nserie_camara,
		t1.nserie_mic,
		t1.nserie_cremoto,
		t1.ubicacion,
		t1.contrato_polycom AS id_contrato_polycom,
		t3.id_contrato AS id_contrato_cliente,
		t3.cliente_final,
		t3.vigente,
		t3.fecha_inicio  AS fecha_inicio_cliente,
		t3.fecha_termino AS fecha_termino_cliente,
		t3.sla,
		t6.descripcion   AS tipo_contrato_cliente,
		t4.fecha_inicio  AS fecha_inicio_polycom,
		t4.fecha_termino AS fecha_termino_polycom,
		t4.descripcion   AS descripcion_contrato_polycom
FROM dbtmedia.tbterminales        AS t1,
	 dbtmedia.tbclientes          AS t2,
	 dbtmedia.tbcontratos         AS t3,
	 dbtmedia.tbcontratos_polycom AS t4,
	 dbtmedia.tbmodelos           AS t5,
	 dbtmedia.tbtipocontratos     AS t6
WHERE t1.cliente = t2.idtbclientes   AND
	  t1.modelo = t5.idtbmodelos     AND
      t1.contrato = t3.idtbcontratos AND
	  t1.contrato_polycom = t4.idtbcontratos_polycom AND
	  t3.tipo_contrato = t6.idtbtipocontratos AND
	  t1.cliente = '$id_cliente'";
$request   = mysql_query($qry);
if(mysql_num_rows($request)==0)
{
	echo "No hay datos que mostrar";
}else{
?>
<!-- <a href="../procesos/xls_terminales.php?id_cliente=<?php echo $id_cliente;?>"><img src="../resources/exportExcel.png"></a><br><br> -->
<br><br>
<table border="1" style="font-size:9px">
	<tr bgcolor="#999999">
		<td colspan="8" align="center">Detalle Terminal</td>
		<td colspan="7" align="center">Detalle Contrato Cliente</td>
		<td colspan="4" align="center">Detalle Contrato Polycom</td>
	</tr>
	<tr bgcolor="#999999">
		<td>ID Terminal</td>
		<td>Nombre Cliente</td>
		<td>Modelo</td>
		<td>NSerie Terminal</td>
		<td>NSerie Camara</td>
		<td>NSerie Mic</td>
		<td>NSerie Remoto</td>
		<td>Ubicacion</td>
		<td>ID Contrato</td>
		<td>Cliente Final</td>
		<td>Tipo Contrato</td>
		<td>Vigente</td>
		<td width='100'>Fecha Inicio</td>
		<td width='100'>Fecha Termino</td>
		<td>SLA</td>
		<td>ID Contrato</td>
		<td width='100'>Fecha Inicio</td>
		<td width='100'>Fecha Termino</td>
		<td>Descipcion</td>
	</tr>
<?php
}
while($Reg = mysql_fetch_array($request))
{
	if($Reg['vigente']==1)
	{
		$vigente = "Si";
	}else{
		$vigente = "No";
	}
?>
<tr>
	<td><?php echo $Reg['id_terminal'];?></td>
	<td><?php echo $Reg['nombre_cliente'];?></td>
	<td><?php echo $Reg['modelo'];?></td>
	<td><?php echo $Reg['nserie'];?></td>
	<td><?php echo $Reg['nserie_camara'];?></td>
	<td><?php echo $Reg['nserie_mic'];?></td>
	<td><?php echo $Reg['nserie_cremoto'];?></td>
	<td><?php echo $Reg['ubicacion'];?></td>
	<td><?php echo $Reg['id_contrato_cliente'];?></td>
	<td><?php echo $Reg['cliente_final'];?></td>
	<td><?php echo $Reg['tipo_contrato_cliente'];?></td>
	<td><?php echo $vigente;?></td>
	<td><?php echo $Reg['fecha_inicio_cliente'];?></td>
	<td><?php echo $Reg['fecha_termino_cliente'];?></td>
	<td><?php echo $Reg['sla'];?></td>
	<td><?php echo $Reg['id_contrato_polycom'];?></td>
	<td><?php echo $Reg['fecha_inicio_polycom'];?></td>
	<td><?php echo $Reg['fecha_termino_polycom'];?></td>
	<td><?php echo $Reg['descripcion_contrato_polycom'];?></td>
</tr>
<?php
}
?>
</table>
<br><br><br><br>