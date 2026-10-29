<?php
require('config.php');
require('lib_functions.php');

$abiertos     = getCountTicketsByEstado('0');
	$clientes = getCountOpenTicketByTipo('1');
	$externos = getCountOpenTicketByTipo('2');
$en_revision  = getCountTicketsByEstado('1');
$cerrados     = getCountTicketsByEstado('2');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<fieldset style="background-color:#FFF;border-color:#000">
<table>
  <tr>
    <td colspan="5" align="center"><strong>Resumen de Tickets</strong></td>
  </tr>
  <tr>
    <td width="100" rowspan="5"><?php if($abiertos!=0){echo "<img src='../resources/alert.gif'/>";}?></td>
    <td width="71"><em>Abiertos</em></td>
    <td width="53">&nbsp;</td>
    <td width="3">:</td>
    <td width="36"><?php echo $abiertos; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><kbd>Clientes</kbd></td>
    <td>:</td>
    <td><kbd><?php echo $clientes; ?></kbd></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><kbd>Externos</kbd></td>
    <td>:</td>
    <td><kbd><?php echo $externos; ?></kbd></td>
  </tr>
  <tr>
    <td><em>En Revision</em></td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><?php echo $en_revision; ?></td>
  </tr>
  <tr>
    <td><em>Cerrados</em></td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><?php echo $cerrados; ?></td>
  </tr>
</table>
</fieldset>
</body>
</html>