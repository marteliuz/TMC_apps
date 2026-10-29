<?php
include("config.php");
require("lib_functions.php"); 

$id_terminal = $_POST['id_terminal'];
$qry = "SELECT * FROM dbtmedia.tbterminales WHERE idtbterminales = '$id_terminal'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	$modelo = $Reg['modelo'];
	$nserie = $Reg['nserie'];
	
	$modelo = getModeloById($modelo);
}
?>
	<fieldset id="fldTerminal"><legend>Datos Terminal</legend>
		<table id="tbTerminal">
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td width="250"><strong>Modelo Terminal</strong></td>
				<td width="25">&nbsp;</td>
				<td width="250"><strong>N&deg; de serie Terminal</strong></td>
				<td width="25">&nbsp;</td>
				<td width="250"><strong>N&deg; de serie Dispositivo Falla</strong></td>
			</tr>
			<tr>
				<td><label><input type="text" name="modelo" id="modelo" style="width:100%" disabled value="<?php echo $modelo; ?>" /></label></td>
				<td>&nbsp;</td>
				<td><label><input type="text" name="nserie_terminal" id="nserie_terminal" maxlength="16" disabled style="width:100%" value="<?php echo $nserie; ?>" /></label></td>
				<td>&nbsp;</td>
				<td><label><input type="text" name="nserie_falla" id="nserie_falla" maxlength="16" style="width:100%"/></label></td>
			</tr>
			<tr>
				<td colspan="5"><div id="divInfoTerminal"></div></td>
			</tr>
			<tr>
				<td><p><strong>Detalle sobre la falla</strong></p></td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5"><label><textarea name="detalle_falla" id="detalle_falla" cols="50" rows="5" style="width:100%"></textarea></label></td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5" align="center"><label><input type="button" name="btnCrear" id="btnCrear" value="Crear Ticket" onClick="javascript:CrearNuveoTicketAdmin()"/></label></td>
			</tr>
      </table>
    </fieldset>