<?php
require('config.php');
require('lib_functions.php');

// $contratos_cliente = getProxVencimientosContratosClientes();
// $contratos_polycom = getProxVencimientosContratosPolycom();
// $contratos_cliente_polycom = getProxVencimientosClientePolycom();
$contratos_cliente_vencidos 			=	getContratosClientesVencidos();
$contratos_cliente_por_vencer			=	getContratosClientesPorVencer();
$contratos_cliente_no_vencidos			=	getContratosClientesNoVencidos();
$contratos_polycom_vencidos				=	getContratosPolycomVencidos();	
$contratos_polycom_por_vencer			=	getContratosPolycomPorVencer();
$contratos_Polycom_no_vencidos			=	getContratosPolycomNoVencidos();
$contratos_cliente_polycom_vencidos		=	getClientePolycomVencidos();
$contratos_cliente_polycom_por_vencer	=	getClientePolycomPorVencer();
$contratos_cliente_polycom_no_vencidos	=	getClientePolycomNoVencidos();

?>
<style type="text/css">
.imagenFondo {
    position: relative;
}
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<fieldset style="background-color:#FFF;border-color:#000">
<table width="290">
  <tr>
    <td width="290" colspan="4" align="center"><strong>Resumen de Vencimientos de Contratos</strong></td>
  </tr>
</table>
<table width="290">
  <tr>
	<td></td>
	<td width=5></td>
    <td align=center>Vencidos</td>
	<td width=1></td>
    <td align=center>Por<br>Vencer</td>
	<td width=12></td>
    <td align=center>No<br>Vencidos</td>
  </tr>
  <tr>
	<td>Clientes</td>
	<td width=5></td>
    <td><div style="background-image: url(../resources/luz_roja.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 140px;top: 80px; font-size: 12px" ><span><a href="../procesos/qryClienteVencido.php" target="_blank"><font color="#FFF"><?php echo $contratos_cliente_vencidos; ?></font></span><font style="font-size:10px"></div></td>
	<td width=1></td>
    <td><div style="background-image: url(../resources/luz_amarilla.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 200px;top: 80px; font-size: 12px" ><span><a href="../procesos/qryClientePorVencer.php" target="_blank"><font color="#FFF"><?php echo $contratos_cliente_por_vencer; ?></font></span><font style="font-size:10px"></div></td>
	<td width=12></td>
	<td><div style="background-image: url(../resources/luz_verde.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 266px;top: 80px; font-size: 12px" ><span><a href="../procesos/qryClienteNoVencido.php" target="_blank"><font color="#FFF"><?php echo $contratos_cliente_no_vencidos; ?></font></span><font style="font-size:10px"></div></td>
	</tr>
  <tr>
	<td>Polycom</td>
	<td width=5></td>
   <td><div style="background-image: url(../resources/luz_roja.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 140px;top: 132px; font-size: 12px" ><span><a href="../procesos/qryPolycomVencidos.php" target="_blank"><font color="#FFF"><?php echo $contratos_polycom_vencidos; ?></font></span><font style="font-size:10px"></div></td>
	<td width=1></td>
    <td><div style="background-image: url(../resources/luz_amarilla.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 200px;top: 132px; font-size: 12px" ><span><a href="../procesos/qryPolycomPorVencer.php" target="_blank"><font color="#FFF"><?php echo $contratos_polycom_por_vencer; ?></font></span><font style="font-size:10px"></div></td>
	<td width=12></td>
	<td><div style="background-image: url(../resources/luz_verde.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 266px;top: 132px; font-size: 12px" ><span><a href="../procesos/qryPolycomNoVencidos.php" target="_blank"><font color="#FFF"><?php echo $contratos_Polycom_no_vencidos; ?></font></span><font style="font-size:10px"></div></td>
	</tr>
  <tr>
	<td>Clientes/Polycom</td>
	<td width=5></td>
   <td><div style="background-image: url(../resources/luz_roja.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 140px;top: 186px; font-size: 12px" ><span><a href="../procesos/qryClientePolycomVencidos.php" target="_blank"><font color="#FFF"><?php echo $contratos_cliente_polycom_vencidos; ?></font></span><font style="font-size:10px"></div></td>
	<td width=1></td>
    <td><div style="background-image: url(../resources/luz_amarilla.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 200px;top: 186px; font-size: 12px" ><span><a href="../procesos/qryClientePolycomPorVencer.php" target="_blank"><font color="#FFF"><?php echo $contratos_cliente_polycom_por_vencer; ?></font></span><font style="font-size:10px"></div></td>
	<td width=12></td>
	<td><div style="background-image: url(../resources/luz_verde.png);background-repeat:no-repeat;height:49px;margin:0px; auto;position:relative;width:48px;margin-bottom:0px "></div>
        <div style="position: absolute; left: 266px;top: 186px; font-size: 12px" ><span><a href="../procesos/qryClientePolycomNoVencidos.php" target="_blank"><font color="#FFF"><?php echo $contratos_cliente_polycom_no_vencidos; ?></font></span><font style="font-size:10px"></div></td>
	</tr>
</table>
</fieldset>
</body>
</html>