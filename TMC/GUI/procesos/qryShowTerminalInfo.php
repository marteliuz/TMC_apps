<?php
require('config.php');
require("lib_functions.php");

$idterminal = $_POST['idterminal'];

$qry      = "SELECT * FROM dbtmedia.tbterminales WHERE idtbterminales = '$idterminal'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);
if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	$modelo = $Reg['modelo'];
	$modelo = getModeloById($modelo);
	$nserie = $Reg['nserie'];
?>
<table>
	<tr>
		<td width="250">Modelo Terminal</td>
		<td width="25">&nbsp;</td>
		<td width="250" maxlength="14">N&deg; de serie Terminal</td>
		<td width="25">&nbsp;</td>
		<td width="250" maxlength="14">N&deg; de serie Dispositivo Falla</td>
    </tr>
    <tr>
        <td><label><input type="text" name="modelo" id="modelo" maxlength="14" style="width:100%" disabled value="<?php echo $modelo; ?>"/></label></td>
        <td><input type="hidden" id="idtb" value="<?php echo $idterminal; ?>"></td>
        <td><label><input type="text" name="nserie_terminal" id="nserie_terminal" maxlength="14" style="width:100%" disabled value="<?php echo $nserie; ?>"/></label></td>
        <td>&nbsp;</td>
        <td><label><input type="text" name="nserie_falla" id="nserie_falla" style="width:100%" maxlength="14"/></label></td>
    </tr>
</table>
<?php
}else{
?>
	<table>
		<tr>
			<td width="250">Modelo Terminal</td>
			<td width="25">&nbsp;</td>
			<td width="250">N&deg; de serie Terminal</td>
			<td width="25">&nbsp;</td>
			<td width="250">N&deg; de serie Dispositivo Falla</td>
		</tr>
		<tr>
			<td><?php echo getCmbModelosTerminales("cmbModelos",null); ?></td>
			<td><input type="hidden" id="idtb" value="<?php echo $idterminal; ?>"></td>
			<td><label><input type="text" name="nserie_terminal" id="nserie_terminal" maxlength="14" style="width:100%" /></label></td>
			<td>&nbsp;</td>
			<td><label><input type="text" name="nserie_falla" id="nserie_falla" maxlength="14" style="width:100%"/></label></td>
		</tr>
	</table>
<?php
}
?>