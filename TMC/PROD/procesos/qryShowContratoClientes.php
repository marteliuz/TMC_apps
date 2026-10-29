<?php
require('config.php');
require("lib_functions.php");

mysql_set_charset('utf8');

$id_cliente = $_POST['id_cliente'];

$qry      = "SELECT * FROM dbtmedia.tbcontratos WHERE cliente = '$id_cliente'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	echo "No hay info que mostrar.";
}else{
?>
	<table border="1">
		<tr bgcolor="#999999">
			<td><strong>ID Contrato</strong></td>
			<td><strong>Tipo Contrato</strong></td>
			<td><strong>Cliente Final</strong></td>
			<td><strong>Fecha Inicio</strong></td>
			<td><strong>Fecha Término</strong></td>
			<td><strong>SLA</strong></td>
			<td><strong>Vigente</strong></td>
			<td><strong>Editar</strong></td>
		</tr>
<?php
	while($Reg = mysql_fetch_array($result))
	{
?>
		<tr>
			<td align="center"><?php echo $Reg['id_contrato']; ?></td>
			<td align="center"><?php echo getTipoContratoById($Reg['tipo_contrato']); ?></td>
			<td align="center"><?php echo $Reg['cliente_final']; ?></td>
			<td align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_inicio'])); ?></td>
			<td align="center"><?php echo date("d-m-Y", strtotime($Reg['fecha_termino'])); ?></td>
			<td align="center"><?php echo $Reg['SLA']; ?></td>
			<td align="center"><?php if($Reg['vigente']==1){echo "Si";}else{echo "No";} ?></td>
			<td align="center"><img src="../resources/edit.jpg" onclick="javascript:Edit_PopUp('<?php echo $Reg['idtbcontratos']; ?>');" style="cursor:pointer"></td>
		</tr>
<?php
	}
?>
</table>
<?php
}
?>