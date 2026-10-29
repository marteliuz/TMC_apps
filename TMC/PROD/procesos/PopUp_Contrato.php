<?php
require("config.php");
require("lib_functions.php");

$id_contrato = $_GET['id'];

$qry = "SELECT * FROM dbtmedia.tbcontratos WHERE idtbcontratos = '$id_contrato'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);
if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	
	$id            = $id_contrato;
	$cliente       = getClientNameById($Reg['cliente']);
	$cliente_final = $Reg['cliente_final'];
		if($Reg['vigente']==0) 
		{$vigente= "NO";}
		else{$vigente="Si";}
	#$vigente       = $Reg['vigente'];
	$f_inicio      = $Reg['fecha_inicio'];
	$f_termino 	   = $Reg['fecha_termino'];
	$sla 		   = $Reg['SLA'];
	$tipo 		   = $Reg['tipo_contrato'];
	$id_contrato   = $Reg['id_contrato'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
</head>
<body>
<fieldset><legend>Contrato con Cliente</legend>
<br>
<table>
	<tr>
		<td><p>ID Contrato</p></td>
		<td>:</td>
		<td><label><input type="text" name="id_contrato" id="id_contrato" value="<? echo $id_contrato;?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>Cliente</td>
		<td>:</td>
		<td><label><input type="text" name="cliente" id="cliente" value="<? echo $cliente;?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>Cliente Final</td>
		<td>:</td>
		<td><label><input type="text" name="cliente_final" id="cliente_final" value="<? echo $cliente_final;?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>Vigente</td>
		<td>:</td>
		<td><label><input type="text" name="vigente" id="vigente" value="<? echo $vigente;?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>Fecha Inicio</td>
		<td>:</td>
		<td><label><input type="text" name="f_inicio" id="f_inicio" value="<? echo date("d-m-Y", strtotime($f_inicio));?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>Fecha Termino</td>
		<td>:</td>
		<td><label><input type="text" name="f_termino" id="f_termino" value="<? echo date("d-m-Y", strtotime($f_termino));?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>SLA</td>
		<td>:</td>
		<td><label><input type="text" name="sla" id="sla" value="<? echo $sla;?>" readonly="readonly"/></label></td>
	</tr>
	<tr>
		<td>Tipo Contrato</td>
		<td>:</td>
		<td><label><input type="text" name="tipo_contrato" id="tipo_contrato" value="<? echo getTipoContratoById($tipo);?>" readonly="readonly"/></label></td>
	</tr>
</table>
</fieldset>
</body>
</html>
<?php
}else{
	echo "Se ha producido un error.";
}
?>