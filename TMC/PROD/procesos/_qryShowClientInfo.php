<?php
require('config.php');
require("lib_functions.php");

$cliente = $_POST['cliente'];

$qry      = "SELECT * FROM dbtmedia.tbclientes WHERE idtbclientes = '$cliente'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);

if($num_rows==0)
{
	echo "<IMG src='../resources/error.png'><strong>No existe un cliente asociado al ID '$cliente'.</strong>";
}else{
	$Reg = mysql_fetch_array($result);
	$id             = $Reg['idtbclientes'];
	$nomb_cliente   = $Reg['nombre_cliente'];
	$rut_cliente    = $Reg['rut_cliente'];
	$telef_cliente  = $Reg['telef_cliente'];
	$giro_cliente   = $Reg['giro_cliente'];
	$dir_cliente    = $Reg['direccion_cliente'];
	$reg_cliente    = $Reg['region_cliente'];
	$nomb_contacto  = $Reg['nombre_contacto'];
	$cargo_contacto = $Reg['cargo_contacto'];
	$email_contacto = $Reg['email_contacto'];
	$telef_contacto = $Reg['telef_contacto'];
	$movil_contacto = $Reg['movil_contacto'];
	$dir_contacto   = $Reg['direccion_contacto'];
	$reg_contacto   = $Reg['region_contacto'];
}
?>
<fieldset id="fldempresa"><legend>Datos Empresa</legend>
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
	<table id="tbempresa">
		<tr >
			<td width="250"><strong>Nombre</strong></td>
			<td width="25"></td>
			<td width="250"><strong>RUT</strong></td>
		</tr>
		<tr nowrap="nowrap">
			<td><input type="text" name="nomb_cliente" id="nomb_cliente" style="width:100%" value="<?php echo $nomb_cliente;?>"/></td>
			<td></td>
			<td><input type="text" name="rut_cliente" id="rut_cliente" style="width:100%" value="<?php echo $rut_cliente;?>"/></td>
		</tr>
		<tr>
			<td><strong>Tel&eacute;fono</strong></td>
			<td></td>
			<td><strong>Giro Empresa</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="telef_cliente" id="telef_cliente" value="<?php echo $telef_cliente;?>"/></td>
			<td></td>
			<td><input type="text" name="giro_cliente" id="giro_cliente" style="width:100%" value="<?php echo $giro_cliente;?>"/></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Direcci&oacute;n</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="dir_cliente" id="dir_cliente" style="width:100%" value="<?php echo $dir_cliente;?>"/></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Regi&oacute;n</strong></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo getSelectedCmbRegion('region_cliente',$reg_cliente);?></td>
		</tr>
	</table>
</fieldset>
<fieldset><legend>Datos de Contacto</legend>
	<table id="tbcontacto">
		<tr>
			<td width="250"><strong>Nombre</strong></td>
			<td width="25"></td>
			<td width="250"><strong>Cargo</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="nomb_contacto" id="nomb_contacto" style="width:100%" value="<?php echo $nomb_contacto;?>"/></td>
			<td></td>
			<td><input type="text" name="cargo_contacto" id="cargo_contacto" style="width:100%" value="<?php echo $cargo_contacto;?>"/></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td></td>
			<td><strong>Tel&eacute;fono</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="email_contacto" id="email_contacto" style="width:100%" value="<?php echo $email_contacto;?>"/></td>
			<td></td>
			<td><input type="text" name="telef_contacto" id="telef_contacto" value="<?php echo $telef_contacto;?>"/></td>
		</tr>
		<tr>
			<td><strong>M&oacute;vil</strong></td>
			<td></td>
			<td><strong>Regi&oacute;n</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="movil_contacto" id="movil_contacto" value="<?php echo $movil_contacto;?>"/></td>
			<td></td>
			<td><?php echo getSelectedCmbRegion('region_contacto',$reg_contacto);?></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Direcci&oacute;n</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="dir_contacto" id="dir_contacto" style="width:100%" value="<?php echo $dir_contacto;?>"/></td>
		</tr>
		<tr>
			<td align="center" colspan="3"><br><input type="button" name="update" id="update" value="Actualizar" onclick="javascript:updateClientInfo()"/></td>
		</tr>
	</table>
</fieldset> 





