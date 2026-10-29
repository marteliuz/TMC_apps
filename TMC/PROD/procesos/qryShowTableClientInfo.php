<?php
include("config.php");
require("lib_functions.php"); 

$id_cliente = $_POST['id_cliente'];

$qry      = "SELECT * FROM dbtmedia.tbclientes WHERE idtbclientes = '$id_cliente'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);

if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	$nomb_cliente   = $Reg['nombre_cliente'];
	$nomb_contacto  = $Reg['nombre_contacto'];
	$telef_contacto = $Reg['telef_contacto'];
	$movil_contacto = $Reg['movil_contacto'];
	$email_contacto = $Reg['email_contacto'];
	$direc_contacto = $Reg['direccion_contacto'];
	
	$cmb_terminales = getCmbterminalesByIdCliente('cmbTerminales', 'showTerminalesByClienteId()', $id_cliente);
}
?>
<table id="tbContacto">
	<tr>
	  <td colspan="5"><table >
	    <tr>
	      <td width="248"><strong>Nombre Empresa</strong></td>
	      <td width="25">&nbsp;</td>
	      <td width="248"><strong>Nombre Contacto</strong></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td colspan="5"><table>
	    <tr>
	      <td width="248"><input type="text" name="nomb_cliente" id="nomb_cliente" style="width:100%" value="<?php echo $nomb_cliente; ?>"/></td>
	      <td width="25"><input type="hidden" id="id_cliente" value="<?php echo $id_cliente; ?>" /></td>
	      <td width="248"><input type="text" name="nomb_contacto" id="nomb_contacto" style="width:100%" value="<?php echo $nomb_contacto; ?>"/></td>
        </tr>
      </table></td>
  </tr>
	<tr>
		<td><strong>Telefono Contacto</strong></td>
		<td>&nbsp;</td>
		<td><strong>Movil Contacto</strong></td>
		<td>&nbsp;</td>
		<td><strong>Email Contacto</strong></td>
	</tr>
	<tr>
		<td><label><input type="text" name="telef_contacto" id="telef_contacto" value="<?php echo $telef_contacto; ?>"/></label></td>
		<td>&nbsp;</td>
		<td><label><input type="text" name="movil_contacto" id="movil_contacto" value="<?php echo $movil_contacto; ?>"/></label></td>
		<td>&nbsp;</td>
		<td><label><input type="text" name="email_contacto" id="email_contacto" style="width:100%" value="<?php echo $email_contacto; ?>"/></label></td>
	</tr>
	<tr>
		<td><strong>Direccion Contacto</strong></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><label><input type="text" name="dir_contacto" id="dir_contacto" style="width:100%" value="<?php echo $direc_contacto; ?>"/></label></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Terminales asociados <?php echo $cmb_terminales; ?></strong></td>
		<td colspan="2"><input type="checkbox" name="check" id="check" onclick="javascript:toggleEnable()"/>El terminal no esta en la lista</td>
		<td colspan="2"></td>
	</tr>
</table>