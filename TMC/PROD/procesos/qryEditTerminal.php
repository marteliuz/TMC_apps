<?php
require("config.php");
require("lib_functions.php");

$nserie   = $_POST['nserie'];
$qry      = "SELECT * FROM dbtmedia.tbterminales WHERE nserie = '$nserie' OR nserie_camara = '$nserie' OR nserie_mic = '$nserie' OR nserie_cremoto = '$nserie'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{echo "No existe un terminal asociado a este S/N.";}
if($num_rows>1)
{echo "Wow! hay mas de un registro asociado a este S/N, contacte al admin.";}

if($num_rows==1)
{
	$Reg            = mysql_fetch_array($result);
	$idtbterminales = $Reg['idtbterminales'];
	$modelo         = getModeloById($Reg['modelo']);
	$cliente        = getClientNameById($Reg['cliente']);
	$nserie         = $Reg['nserie'];
	$nserie_camara  = $Reg['nserie_camara'];
	$nserie_mic     = $Reg['nserie_mic'];
	$nserie_cremoto = $Reg['nserie_cremoto'];
	$ubicacion      = $Reg['ubicacion'];

	// echo "<br>".$idtbterminales;echo "<br>".$modelo;echo "<br>".$cliente;echo "<br>".$nserie;echo "<br>".$nserie_camara;echo "<br>".$nserie_mic;echo "<br>".$nserie_cremoto;echo "<br>".$ubicacion;
?>
<fieldset><legend>Terminal</legend>
	<table>
		<tr>
			<td><strong>Cliente</strong></td>
			<td>&nbsp;</td>
			<td><strong>Modelo Codec</strong></td>
		</tr>
		<tr>
			<td><label><?php echo getCmbClientes("cmbClientes",null); ?></label></td>
			<td>&nbsp;</td>
			<td><label><?php echo getCmbModelosTerminales("cmbTerminales",null); ?></label></td>
		</tr>
		<tr>
			<td><strong>S/Number Codec</strong></td>
			<td>&nbsp;</td>
			<td><strong>S/Number Camara</strong></td>
		</tr>
		<tr>
			<td><label><input name="nserie" type="text" id="nserie" maxlength="16" value="<?php echo $nserie; ?>"/></label></td>
			<td>&nbsp;</td>
			<td><label><input name="nserie_camara" type="text" id="nserie_camara" maxlength="16" value="<?php echo $nserie_camara; ?>"/></label></td>
		</tr>
		<tr>
			<td><strong>S/Number Microfono</strong></td>
			<td>&nbsp;</td>
			<td><strong>S/Number Control</strong></td>
		</tr>
		<tr>
			<td><label><input name="nserie_mic" type="text" id="nserie_mic" maxlength="16" value="<?php echo $nserie_mic; ?>"/></label></td>
			<td>&nbsp;</td>
			<td><label><input name="nserie_cremoto" type="text" id="nserie_cremoto" maxlength="16" value="<?php echo $nserie_cremoto; ?>"/></label></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Ubicacion</strong></td>
		</tr>
		<tr>
			<td colspan="3"><label><input type="text" id="ubicacion" value="<?php echo $ubicacion; ?>"/></label></td>
		</tr>
		<tr>
			<td colspan="3"><input type="hidden" id="idtb" value="<?php echo $idtbterminales; ?>"></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input type="button" id="btnUpdate" value="Actualizar" onclick="javascript:UpdateTerminal()"></td>
		</tr>
	</table>
</fieldset>
<?php
}
?>