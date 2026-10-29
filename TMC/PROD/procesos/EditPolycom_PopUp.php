<?php
require("config.php");
require("lib_functions.php");

$id_contrato = $_GET['id'];

$qry      = "SELECT * FROM dbtmedia.tbcontratos_polycom WHERE idtbcontratos_polycom = '$id_contrato'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);
if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	
	$id          = $id_contrato;
	$f_inicio    = $Reg['fecha_inicio'];
	$f_termino   = $Reg['fecha_termino'];
	$descripcion = $Reg['descripcion'];
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
	<input type="hidden" id="hddn" value="<?php echo $id; ?>">
	<table width="1">
		<tr>
			<td align="center"><strong>Fecha Inicio</strong></td>
			<td align="center" width="100">&nbsp;</td>
			<td align="center"><strong>Fecha Termino</strong></td>
		</tr>
		<tr>
			<td><label><input type="text" name="f_inicio" id="f_inicio" value="<? echo date("d-m-Y", strtotime($f_inicio));?>" datepicker="true" datepicker_format="YYYY-MM-DD"/></label></td>
			<td>&nbsp;</td>
			<td><label><input type="text" name="f_termino" id="f_termino" value="<? echo date("d-m-Y", strtotime($f_termino));?>" datepicker="true" datepicker_format="YYYY-MM-DD" /></label></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><strong>Descripci&oacute;n</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input type="text" name="textfield" id="textfield" value="<? echo $descripcion; ?>" style="width:100%"/></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr align="center">
			<td colspan="3"><input type="button" name="btn" id="btn" value="Enviar" onClick="javascript:updateContratoPolycom()"/></td>
		</tr>
	</table>
	<div id="resultado"></div>
</body>
</html>
<?php
}else{
	echo "Se ha producido un error.";
}
?>