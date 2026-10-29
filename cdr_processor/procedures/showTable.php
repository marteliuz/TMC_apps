<?php

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/11/29

//require file config.php for connection bd
require('../cnfg/config.php');
//include lib_function.php for extrac values
include("lib_functions.php");
//include lib_log.php for create registry log
include("lib_log.php");

log_info("Creando Tabla On Demand");
?>

<table class="table hovered">
<thead>
	<tr>
		<th class="text-left">ID DB</th>
		<th class="text-left">Name</th>
		<th class="text-left">Serial Number</th>
		<th class="text-left">Start Date</th>
		<th class="text-left">Start Time</th>
		<th class="text-left">End Date</th>
		<th class="text-left">End Time</th>
		<th class="text-left">Call Duration</th>
		<th class="text-left">Account Number</th>
		<th class="text-left">Remote System Name</th>
		<th class="text-left">Call Number 1</th>
		<th class="text-left">Call Number 2</th>
		<th class="text-left">Transport Type</th>
		<th class="text-left">Call Rate</th>
		<th class="text-left">System Manufacturer</th>
		<th class="text-left">Call Direction</th>
		<th class="text-left">Conference Id</th>
		<th class="text-left">Call Id</th>
		<th class="text-left">H320 Channels</th>
		<th class="text-left">Endpoint Alias</th>
		<th class="text-left">Endpoint Additional Alias</th>
		<th class="text-left">Endpoint Type</th>
		<th class="text-left">Endpoint Transport Address</th>
		<th class="text-left">Audio Protocol Tx</th>
		<th class="text-left">Audio Protocol Rx</th>
		<th class="text-left">Video Protocol Tx</th>
		<th class="text-left">Video Protocol Rx</th>
		<th class="text-left">Video Format Tx</th>
		<th class="text-left">Video Format Rx</th>
		<th class="text-left">Precedence Level</th>
		<th class="text-left">Disconnect Info</th>
		<th class="text-left">Q850 Cause</th>
		<th class="text-left">Total H320 Errors</th>
		<th class="text-left">Avg. Percent Packet Loss Tx</th>
		<th class="text-left">Avg. Percent Packet Loss Rx</th>
		<th class="text-left">Avg. Packets Lost Tx</th>
		<th class="text-left">Avg. Packets Lost Rx</th>
		<th class="text-left">Avg. Latency Tx</th>
		<th class="text-left">Avg. Latency Rx</th>
		<th class="text-left">Max Latency Tx</th>
		<th class="text-left">Max Latency Rx</th>
		<th class="text-left">Avg. Jitter Tx</th>
		<th class="text-left">Avg. Jitter Rx</th>
		<th class="text-left">Max Jitter Tx</th>
		<th class="text-left">Max Jitter Rx</th>
	<tr>
</thead>
<tbody>
<?php
$result = mysql_query ("SELECT * FROM dbpolycom.tbdata",$conexion);
while($Reg = mysql_fetch_array($result))
{
?>
	<tr>
		<td><?php echo $Reg['idtbdata']; ?></td>
		<td><?php echo $Reg['name']; ?></td>
		<td><?php echo $Reg['serial_number']; ?></td>
		<td><?php echo $Reg['start_date']; ?></td>
		<td><?php echo $Reg['start_time']; ?></td>
		<td><?php echo $Reg['end_date']; ?></td>
		<td><?php echo $Reg['end_time']; ?></td>
		<td><?php echo $Reg['call_duration']; ?></td>
		<td><?php echo $Reg['account_number']; ?></td>
		<td><?php echo $Reg['remote_system_name']; ?></td>
		<td><?php echo $Reg['call_number1']; ?></td>
		<td><?php echo $Reg['call_number2']; ?></td>
		<td><?php echo $Reg['transport_type']; ?></td>
		<td><?php echo $Reg['call_rate']; ?></td>
		<td><?php echo $Reg['system_manufacturer']; ?></td>
		<td><?php echo $Reg['call_direction']; ?></td>
		<td><?php echo $Reg['conference_id']; ?></td>
		<td><?php echo $Reg['call_id']; ?></td>
		<td><?php echo $Reg['h320_channels']; ?></td>
		<td><?php echo $Reg['endpoint_alias']; ?></td>
		<td><?php echo $Reg['endpoint_additional_alias']; ?></td>
		<td><?php echo $Reg['endpoint_type']; ?></td>
		<td><?php echo $Reg['endpoint_transport_address']; ?></td>
		<td><?php echo $Reg['audio_protocol_tx']; ?></td>
		<td><?php echo $Reg['audio_protocol_rx']; ?></td>
		<td><?php echo $Reg['video_protocol_tx']; ?></td>
		<td><?php echo $Reg['video_protocol_rx']; ?></td>
		<td><?php echo $Reg['video_format_tx']; ?></td>
		<td><?php echo $Reg['video_format_rx']; ?></td>
		<td><?php echo $Reg['precedence_level']; ?></td>
		<td><?php echo $Reg['disconnect_info']; ?></td>
		<td><?php echo $Reg['q850_cause']; ?></td>
		<td><?php echo $Reg['total_h320_error']; ?></td>
		<td><?php echo $Reg['avg_percent_packet_loss_tx']; ?></td>
		<td><?php echo $Reg['avg_percent_packeT_loss_rx']; ?></td>
		<td><?php echo $Reg['avg_packets_lost_tx']; ?></td>
		<td><?php echo $Reg['avg_packets_lost_rx']; ?></td>
		<td><?php echo $Reg['avg_latency_tx']; ?></td>
		<td><?php echo $Reg['avg_latency_rx']; ?></td>
		<td><?php echo $Reg['max_latency_tx']; ?></td>
		<td><?php echo $Reg['max_latency_rx']; ?></td>
		<td><?php echo $Reg['avg_jitter_tx']; ?></td>
		<td><?php echo $Reg['avg_jitter_rx']; ?></td>
		<td><?php echo $Reg['max_jitter_tx']; ?></td>
		<td><?php echo $Reg['max_jitter_rx']; ?></td>
	</tr>
<?php
}
?>
	</tbody>
	<tfoot></tfoot>
</table>
<?php	