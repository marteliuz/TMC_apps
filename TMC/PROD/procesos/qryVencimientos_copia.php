<?php
require('config.php');
require('lib_functions.php');

$contratos_cliente = getProxVencimientosContratosClientes();
$contratos_polycom = getProxVencimientosContratosPolycom();
$contratos_cliente_polycom = getProxVencimientosClientePolycom();
$suma = $contratos_cliente + $contratos_polycom;

if($contratos_cliente==0 && $contratos_polycom==0 && $contratos_cliente_polycom==0)
{
	echo "No hay vencimientos proximos.";
}else{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<fieldset style="background-color:#FFF;border-color:#000">
<table width="290">
  <tr>
    <td colspan="4" align="center"><strong>Resumen de Vencimientos</strong></td>
  </tr>
  <tr>
    <td width="119" rowspan="2"><?php if($suma!=0){echo "<img src='../resources/alert.gif'/>";}?></td>
    <td width="149"><a href="../procesos/qryContratosVencidos.php" target="_blank"><em>Contratos Clientes</em></a></td>
    <td width="3">:</td>
    <td width="45"><?php echo $contratos_cliente; ?></td>
  </tr>
  <tr>
    <td><a href="../procesos/qryContratosPolycom.php" target="_blank"><em>Contratos Polycom</em></a></td>
    <td>:</td>
    <td><?php echo $contratos_polycom; ?></td>
  </tr>
  </tr>
  <tr>
	<td>
    <td><a href="../procesos/qryContratosClientePolycom.php" target="_blank"><em>Cliente con Polycom</em></a></td>
    <td>:</td>
    <td><?php echo $contratos_cliente_polycom; ?></td>
  </tr>
</table>
</fieldset>
</body>
</html>
<?php
}
?>