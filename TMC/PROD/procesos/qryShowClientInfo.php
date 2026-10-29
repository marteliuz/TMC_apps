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
	$id              = $Reg['idtbclientes'];
	$nomb_cliente    = $Reg['nombre_cliente'];
	$rut_cliente     = $Reg['rut_cliente'];
	$telef_cliente   = $Reg['telef_cliente'];
	$giro_cliente    = $Reg['giro_cliente'];
	$sigla_cliente   = $Reg['sigla'];
	$dir_cliente     = $Reg['direccion_cliente'];
	$reg_cliente     = $Reg['region_cliente'];
	$nomb_contacto   = $Reg['nombre_contacto'];
	$cargo_contacto  = $Reg['cargo_contacto'];
	$email_contacto  = $Reg['email_contacto'];
	$telef_contacto  = $Reg['telef_contacto'];
	$movil_contacto  = $Reg['movil_contacto'];
	$dir_contacto    = $Reg['direccion_contacto'];
	$reg_contacto    = $Reg['region_contacto'];
	$ciudad_cliente  = $Reg['ciudad_cliente'];
	$ciudad_contacto = $Reg['ciudad_contacto'];
	
	if($Reg['activo']==0)
	{
		$activo = "<input name='activo' type='text' id='activo' value='Cliente Deshabilitado' readonly='readonly' style='color:#F00'/><br>";
		$btn    = "<input type='button' name='btn_enable' id='btn_enable' value='Habilitar Cliente' onClick='javascript:enableCliente($id)'>";
	}else{
		$activo = "<input name='activo' type='text' id='activo' value='Cliente Activo' readonly='readonly' style='color:#060'/>";
		$btn    = "<input type='button' name='btn_disable' id='btn_disable' value='Deshabilitar Cliente' onClick='javascript:disableCliente($id)'>";
	} 
}
?>
<fieldset id="fldempresa"><legend>Datos Empresa</legend>
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
	<table id="tbempresa">
		<tr>
			<td colspan="3" align="center"><?php echo $activo; ?></td>
		</tr>
		<tr >
			<td colspan="2">
				<table style="width:100%">
					<tr>
						<td><strong>Nombre o Raz&oacute;n Social</strong></td>
						<td width="25">&nbsp;</td>
						<td width="120"><strong>RUT</strong></td>
					</tr>
					<tr>
						<td><input name="nomb_cliente" type="text" id="nomb_cliente" style="width:100%" maxlength="45" value="<?php echo $nomb_cliente;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="rut_cliente" type="text" id="rut_cliente" onkeypress="return modoRut(event)" maxlength="13" style="width:100%" value="<?php echo $rut_cliente;?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table style="width:100%">
					<tr>
						<td width="85"><strong>Tel&eacute;fono</strong></td>
						<td width="25">&nbsp;</td>
						<td><strong>Giro Empresa</strong></td>
						<td width="25">&nbsp;</td>
						<td width="50"><strong>Sigla</strong></td>
					</tr>
					<tr>
						<td><input name="telef_cliente" type="text" id="telef_cliente" onkeypress="return soloNumeros(event)" maxlength="11" style="width:100%" value="<?php echo $telef_cliente;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="giro_cliente" type="text" id="giro_cliente" style="width:100%" maxlength="45" value="<?php echo $giro_cliente;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="sigla" type="text" id="sigla_cliente" maxlength="3" style="width:100%" value="<?php echo $sigla_cliente;?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><strong>Direcci&oacute;n</strong></td>
		</tr>
		<tr>
			<td colspan="2"><input name="dir_cliente" type="text" id="dir_cliente" style="width:100%" maxlength="50" value="<?php echo $dir_cliente;?>"/></td>
		</tr>
		<tr>
			<td width="275"><strong>Regi&oacute;n</strong></td>
			<td width="250">
				<table>
					<tr>
						<td width="25">&nbsp;</td>
						<td><strong>Ciudad/Comuna</strong></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><?php echo getSelectedCmbRegion('region_cliente',$reg_cliente);?></td>
			<td>
				<table>
					<tr>
						<td width="25" >&nbsp;</td>
						<td><? echo getSelectedCmbCiudades("cmbCiudades_cliente", $ciudad_cliente); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>
	</table>
</fieldset>

<br />

<fieldset><legend>Datos de Contacto</legend>
	<table id="tbcontacto">
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td width="250"><strong>Nombre</strong></td>
						<td width="25">&nbsp;</td>
						<td width="250"><strong>Cargo</strong></td>
					</tr>
					<tr>
						<td><input name="nomb_contacto" type="text" id="nomb_contacto" style="width:100%" size="45" value="<?php echo $nomb_contacto;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="cargo_contacto" type="text" id="cargo_contacto" style="width:100%" maxlength="45" value="<?php echo $cargo_contacto;?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td><strong>Email</strong></td>
						<td width="25">&nbsp;</td>
						<td><strong>Tel&eacute;fono</strong></td>
						<td width="25">&nbsp;</td>
						<td><strong>M&oacute;vil</strong></td>
					</tr>
					<tr>
						<td><input name="email_contacto" type="text" id="email_contacto" value="<?php echo $email_contacto;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="telef_contacto" type="text" id="telef_contacto" onkeypress="return soloNumeros(event)" maxlength="11" value="<?php echo $telef_contacto;?>"/></td>
						<td>&nbsp;</td>
						<td><input name="movil_contacto" type="text" id="movil_contacto" onkeypress="return soloNumeros(event)" maxlength="11" value="<?php echo $movil_contacto;?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3"><strong>Direcci&oacute;n</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input name="dir_contacto" type="text" id="dir_contacto" style="width:100%" maxlength="50" value="<?php echo $dir_contacto;?>"/></td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td align="left"><strong>Regi&oacute;n</strong></td>
						<td width="225">&nbsp;</td>
						<td><strong>Ciudad/Comuna</strong></td>
					</tr>
					<tr>
						<td><?php echo getSelectedCmbRegion('region_contacto',$reg_contacto);?></td>
						<td>&nbsp;</td>
						<td><? echo getSelectedCmbCiudades("cmbCiudades_contacto", $ciudad_contacto); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td align="center"><input type="reset"  name="btn_reset"   id="btn_reset"   value="Limpiar"              onClick="javascript:resetFormNuevoCliente()"/></td>
			<td align="center"><?php echo $btn; ?></td>
			<td align="center"><input type="button" name="update"      id="update"      value="Actualizar"           onClick="javascript:updateClientInfo()"/></td>
		</tr>
	</table>
</fieldset>