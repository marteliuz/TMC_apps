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
	// $cliente       = getClientNameById($Reg['cliente']);
	$cliente       = $Reg['cliente'];
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
	$sigla_cliente = $Reg['sigla_cliente'];
	$sigla_cliente_final = $Reg['sigla_cliente_final'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
<script type="text/javascript" src="../js/datepickercontrol.js"></script> 
<link type="text/css" rel="stylesheet" href="../css/datepickercontrol.css"> 

	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>

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
		<td><?php echo getSelectedCmbClientes("cmbClientes", "$cliente"); ?></td>
	</tr>
	<tr>
		<td>Sigla</td>
		<td>:</td>
		<td><label><input type="text" name="sigla_cliente" id="sigla_cliente" value="<? echo $sigla_cliente;?>" /></label></td>
	</tr>
	<tr>
		<td>Cliente Final</td>
		<td>:</td>
		<td><label><input type="text" name="cliente_final" id="cliente_final" value="<? echo $cliente_final;?>" /></label></td>
	</tr>
	<tr>
		<td>Sigla Cliente Final</td>
		<td>:</td>
		<td><label><input type="text" name="sigla_cliente_final" id="sigla_cliente_final" value="<? echo $sigla_cliente_final;?>" /></label></td>
	</tr>
	<tr>
		<td>Vigente</td>
		<td>:</td>
		<td>
			<select name="vigente" id="vigente">
				<option value="1">Si</option>
				<option value="0">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Fecha Inicio</td>
		<td>:</td>
		<td><label><input type="text" name="f_inicio" id="f_inicio" value="<? echo date("d-m-Y", strtotime($f_inicio));?>" datepicker="true" datepicker_format="YYYY-MM-DD"/></label></td>
	</tr>
	<tr>
		<td>Fecha Término</td>
		<td>:</td>
		<td><label><input type="text" name="f_termino" id="f_termino" value="<? echo date("d-m-Y", strtotime($f_termino));?>" datepicker="true" datepicker_format="YYYY-MM-DD" /></label></td>
	</tr>
	<tr>
		<td>SLA</td>
		<td>:</td>
		<td><label><input type="text" name="sla" id="sla" value="<? echo $sla;?>" /></label></td>
	</tr>
	<tr>
		<td>Tipo Contrato</td>
		<td>:</td>
		<td><?php getSelectedCmbTipoContratos('cmbTipoContrato',$tipo, 'null');	?></td>
		<!-- <td><label><input type="text" name="tipo_contrato" id="tipo_contrato" value="<? echo getTipoContratoById($tipo).$tipo;?>" /></label></td> -->
	</tr>
	<tr>
		<td colspan="3" align="center"><input type="button" value="Actualizar" onClick="javascript:updateContrato()"></td>
	</tr>
</table>
<input name="id_tb" id="id_tb" type="hidden" value="<?php echo $id; ?>">
</fieldset>
<div id="resultado"></div>
</body>
</html>
<?php
}else{
	echo "Se ha producido un error.";
}
?>