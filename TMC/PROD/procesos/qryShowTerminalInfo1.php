<?php
require('config.php');
require("lib_functions.php");

$terminal = $_POST['terminal'];

$qry      = "SELECT * FROM dbtmedia.tbterminales WHERE idtbterminales = '$terminal'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);

if($num_rows==0)
{
	echo "<IMG src='../resources/error.png'><strong>No existe un Terminal asociado al ID '$terminal'.</strong>";
}else{
	$Reg = mysql_fetch_array($result);
	$id              = $Reg['idtbterminales'];
	$nserie		     = $Reg['nserie'];
	$modelo		     = $Reg['modelo'];
	$cliente	     = $Reg['cliente']; //combo de clientes
	$ubicacion	     = $Reg['ubicacion'];
	$nserie_camara   = $Reg['nserie_camara'];
	$nserie_mic	     = $Reg['nserie_mic'];
	$nserie_cremoto  = $Reg['nserie_cremoto'];
	$contrato		 = $Reg['contrato'];//combo contrato
	$contrato_polycom= $Reg['contrato_polycom']; //combo contrato


?>
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<script type="text/javascript" src="../js/datepickercontrol.js"></script> 
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
    <link rel="stylesheet" type="text/css" href="../css/datepickercontrol.css"> 

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
</head>
<body> -->
<div id="divTerminal2">
<fieldset id="fldinfoterminal"><legend>Datos Terminal</legend>
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
	<table id="tbempresa">
		<tr >
			<td colspan="2">
				<table style="width:100%">
					<tr>
						<td width="132"><strong>ID del Terminal</strong></td>
						<td width="25">&nbsp;</td>
						<td width="20"><strong>Modelo</strong></td>
						<td width="10">&nbsp;</td>
						<td width="125"><strong>Nro Serie</strong></td>
					</tr>
					<tr>
						<td><input name="id_terminal" type="text" readonly="readonly" id="id_terminal" style="width:97%" maxlength="11" value="<?php echo $id;?>"/></td>
						<td>&nbsp;</td>
						<td><?php echo getCmbModelosTerminales1("cmbModelos", null, $modelo); ?></td>
						<td>&nbsp;</td>
						<td><input name="nro_serie" type="text" id="nro_serie" maxlength="20" style="width:100%" value="<?php echo $nserie;?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table style="width:100%">
					<tr>
						<td width="60"><strong>Nro Serie Cámara</strong></td>
						<td width="25">&nbsp;</td>
						<td width="60"><strong>Nro Serie Micrófono</strong></td>
						<td width="25">&nbsp;</td>
						<td width="60"><strong>Nro Serie C. Remoto</strong></td>
					</tr>
					<tr>
						<td><input name="serie_camara" type="text" id="serie_camara" maxlength="16" style="width:100%" value="<?php echo $nserie_camara;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="serie_mic" type="text" id="serie_mic" style="width:100%" maxlength="16" value="<?php echo $nserie_mic;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="serie_cremoto" type="text" id="serie_cremoto" maxlength="16" style="width:100%" value="<?php echo $nserie_cremoto;?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><strong>Ubicación</strong></td>
		</tr>
		<tr>
			<td colspan="2"><input name="ubicacion" type="text" id="ubicacion" style="width:100%" maxlength="45" value="<?php echo $ubicacion;?>"/></td>
		</tr>
		<tr>
			<td colspan="2">
				<table style="width:100%">
					<tr>
						<td width="200"><strong>Asociar a Cliente</strong></td>
						<td width="100"><strong>Asociar a Contrato</strong></td>
					</tr>
					<tr>
						<td><?php echo getCmbClientesTerminales("cmbClientes", "loadContratosByCliente1()", $cliente); ?></td>
						<td><div id="DIVcontratos1"></div></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td align="center"><input type="reset"  name="btn_reset"   id="btn_reset"   value="Limpiar"              onClick="javascript:resetFormNuevoTerminal()"/></td>
						<td align="center"><input type="button" name="update"      id="update"      value="Actualizar"           onClick="javascript:updateTerminalInfo1()" disabled="disabled"/></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</fieldset>

</div>
<!--</body>-->
<?php
}
?>