<?php
require('config.php');
require("lib_functions.php");

session_start();
header('Content-Type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename=ListadoTickets.xls');
header('Pragma:no-cache');
header('Expire:0');

$contL = 0;

$qry = "SELECT 
		t1.id_ticket,
		if(t1.tipo=1,'Interno','Externo') as tipo,
		case t1.estado
			when 0 then 'Abierto'
			when 1 then 'En Revision'
			when 2 then 'Cerrado'
		end as estado,
		t1.fecha_creacion,
		t1.fecha_revision,
		t1.fecha_cierre,
		t1.id_cliente,
		t1.nombre_cliente,
		t1.nombre_contacto,
		t1.telef_contacto,
		t1.movil_contacto,
		t1.email_contacto,
		t1.direccion_contacto,
		t1.id_terminal,
		t1.modelo_terminal,
		t1.nserie_terminal,
		t1.nserie_falla,
		t1.detalle_falla,
		t1.detalle_interno
	FROM dbtmedia.tbtickets AS t1";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	echo "No hay valores que mostrar";
}else{
	echo "<table width='530' border='1'>
			<tr bgcolor='#66CCFF'>
				<td align='center'><strong>ID Ticket</strong></td>
				<td align='center'><strong>Tipo</strong></td>
				<td align='center'><strong>Estado</strong></td>
				<td align='center'><strong>Fecha Creacion</strong></td>
				<td align='center'><strong>Fecha Revision</strong></td>
				<td align='center'><strong>Fecha Cierre</strong></td>
				<td align='center'><strong>ID Cliente</strong></td>
				<td align='center'><strong>Nombre Cliente</strong></td>
				<td align='center'><strong>Nombre Contacto</strong></td>
				<td align='center'><strong>Telefono Contacto</strong></td>
				<td align='center'><strong>Movil Contacto</strong></td>
				<td align='center'><strong>Email Contacto</strong></td>
				<td align='center'><strong>Dirección Contacto</strong></td>
				<td align='center'><strong>ID Terminal</strong></td>
				<td align='center'><strong>Modelo Terminal</strong></td>
				<td align='center'><strong>Nserie Terminal</strong></td>
				<td align='center'><strong>Nserie Falla</strong></td>
				<td align='center'><strong>Detalle Falla</strong></td>
				<td align='center'><strong>Detalle Interno</strong></td>
			</tr>";
		while($Reg = mysql_fetch_array($result))
		{
			$contL = $contL + 1;
			if($contL % 2 == 0)
			{
				$bgcolor = "<tr bgcolor='#FFFFCC'>";
			}else{
				$bgcolor = "<tr>";
			}
				echo $bgcolor;
				echo "<td>".$Reg['id_ticket']."</td>";
				echo "<td>".$Reg['tipo']."</td>";
				echo "<td>".$Reg['estado']."</td>";
				echo "<td>".$Reg['fecha_creacion']."</td>";
				echo "<td>".$Reg['fecha_revision']."</td>";
				echo "<td>".$Reg['fecha_cierre']."</td>";
				
				if($Reg['tipo']=="Externo")
				{
					echo "<td>Externo</td>";
				}else{
					echo "<td>".$Reg['id_cliente']."</td>";
				}
				echo "<td>".$Reg['nombre_cliente']."</td>";
				echo "<td>".$Reg['nombre_contacto']."</td>";
				echo "<td>".$Reg['telef_contacto']."</td>";
				echo "<td>".$Reg['movil_contacto']."</td>";
				echo "<td>".$Reg['email_contacto']."</td>";
				echo "<td>".$Reg['direccion_contacto']."</td>";
				
				if($Reg['tipo']=="Externo")
				{
					echo "<td>Externo</td>";
				}else{
					echo "<td>".$Reg['id_terminal']."</td>";
				}
				
				$modelo_terminal = $Reg['modelo_terminal'];
				if(is_numeric($Reg['modelo_terminal']))
				{
					$modelo_terminal = getModeloById($Reg['modelo_terminal']);
				}
				echo "<td>".$modelo_terminal."</td>";
				echo "<td>".$Reg['nserie_terminal']."</td>";
				echo "<td>".$Reg['nserie_falla']."</td>";
				echo "<td>".$Reg['detalle_falla']."</td>";
				echo "<td>".$Reg['detalle_interno']."</td>";
				echo "</tr>";
		}
	echo "</table>";
}
?>
