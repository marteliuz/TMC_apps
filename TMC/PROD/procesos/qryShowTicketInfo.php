<?php
require('config.php');
require("lib_functions.php");

$id_tbticket = $_POST['id_ticket'];
$usuario     = $_SESSION['Usuario'];

$qry      = "SELECT * FROM dbtmedia.tbtickets WHERE idtbtickets = '$id_tbticket'";
$result   = mysql_query($qry);
$Reg      = mysql_fetch_array($result);

$id_ticket       = $Reg['id_ticket'];
$tipo            = $Reg['tipo'];
$fecha_creacion  = $Reg['fecha_creacion'];
$id_cliente      = $Reg['id_cliente'];
$nomb_cliente    = $Reg['nombre_cliente'];
$nomb_contacto   = $Reg['nombre_contacto'];
$telef_contacto  = $Reg['telef_contacto'];
$movil_contacto  = $Reg['movil_contacto'];
$email_contacto  = $Reg['email_contacto'];
$dir_contacto    = $Reg['direccion_contacto'];
$id_terminal     = $Reg['id_terminal'];
$modelo_terminal = $Reg['modelo_terminal'];
$nserie_terminal = $Reg['nserie_terminal'];
$nserie_falla    = $Reg['nserie_falla'];
$detalle_falla   = $Reg['detalle_falla'];
// 20130905
// SE AGREGA MOSTRAR DETALLE INTERNO
$detalle_interno = $Reg['detalle_interno'];


if(is_numeric($modelo_terminal))
{
	$modelo_terminal = getModeloById($modelo_terminal);
}

// echo "<br>".$id_ticket;echo "<br>".$tipo;echo "<br>".$fecha_creacion;echo "<br>".$id_cliente;echo "<br>".$nomb_cliente;echo "<br>".$nomb_contacto;echo "<br>".$telef_contacto;echo "<br>".$movil_contacto;echo "<br>".$email_contacto;echo "<br>".$dir_contacto;echo "<br>".$id_terminal;echo "<br>".$modelo_terminal;echo "<br>".$nserie_terminal;echo "<br>".$nserie_falla;echo "<br>".$detalle_falla;

?>
<fieldset><legend>Ticket</legend>
<table id="tbContacto">
	<tr>
		<td width="200">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="200">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="200" align="center"><input name="fecha_creacion" type="text" disabled id="fecha_creacion" value="<?php echo $fecha_creacion; ?> "/></td>
	</tr>
	<tr>
		<td><strong>Nombre Empresa</strong></td>
		<td>&nbsp;</td>
		<td><strong>Nombre Contacto</strong></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td><label><input type="text" name="nomb_cliente" id="nomb_cliente" style="width:100%" disabled value="<?php echo $nomb_cliente; ?>"/></label></td>
		<td><input type="hidden" id="id_cliente" disabled value="<?php echo $id_cliente; ?>"></td>
		<td><label><input type="text" name="nomb_contacto" id="nomb_contacto" style="width:100%" disabled value="<?php echo $nomb_contacto; ?>"/></label></td>
		<td colspan="2" align="center"><label><input type="submit" name="btnComments" id="btnComments" value="Comentarios &gt;" onclick="javascript:showTicketComments()"/></label></td>
	</tr>
	<tr>
		<td><strong>Telefono Contacto</strong></td>
		<td>&nbsp;</td>
		<td><strong>Movil Contacto</strong></td>
		<td>&nbsp;</td>
		<td><strong>Email Contacto</strong></td>
	</tr>
	<tr>
		<td><label><input type="text" name="telef_contacto" id="telef_contacto" disabled value="<?php echo $telef_contacto; ?>"/></label></td>
		<td>&nbsp;</td>
		<td><label><input type="text" name="movil_contacto" id="movil_contacto" disabled value="<?php echo $movil_contacto; ?>"/></label></td>
		<td>&nbsp;</td>
		<td><label><input type="text" name="email_contacto" id="email_contacto" style="width:100%" disabled value="<?php echo $email_contacto; ?>"/></label></td>
	</tr>
	<tr>
		<td><strong>Direccion Contacto</strong></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><label><input type="text" name="dir_contacto" id="dir_contacto" style="width:100%" disabled value="<?php echo $dir_contacto; ?>"/></label></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Modelo Terminal</strong></td>
		<td>&nbsp;</td>
		<td><strong>N&deg; de serie Terminal</strong></td>
		<td>&nbsp;</td>
		<td><strong>N&deg; de serie Dispositivo Falla</strong></td>
    </tr>
    <tr>
        <td><label><input type="text" name="modelo" id="modelo" style="width:100%" disabled value="<?php echo $modelo_terminal; ?>"/></label></td>
        <td><input type="hidden" id="idtb" value="<?php echo $id_terminal; ?>"></td>
        <td><label><input type="text" name="nserie_terminal" id="nserie_terminal" style="width:100%" disabled value="<?php echo $nserie_terminal; ?>"/></label></td>
        <td>&nbsp;</td>
        <td><label><input type="text" name="nserie_falla" id="nserie_falla" style="width:100%" disabled value="<?php echo $nserie_falla; ?>"/></label></td>
    </tr>
	<tr>
		<td><p><strong>Detalle sobre la falla</strong></p></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5"><label><textarea name="detalle_falla" id="detalle_falla" cols="50" rows="5" disabled style="width:100%"><?php echo $detalle_falla; ?></textarea></label></td>
	</tr>
</table>
</fieldset>

<fieldset><legend>Uso Interno</legend>
<table>
  <tr>
    <td width="200"></td>
    <td width="20"></td>
    <td width="200"></td>
    <td width="20"></td>
    <td width="200"></td>
  </tr>
  <tr>
    <td><p><strong>Detalle Interno</strong></p></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><label><textarea name="detalle_interno" id="detalle_interno" onKeyUp="contar(this);" cols="50" rows="5" style="width:100%"><?php echo $detalle_interno; ?></textarea><span id="letras">300/300 caracteres</span></label></td>
  </tr>
</table>
</fieldset>

<div id="acciones">
<fieldset><legend>Acciones</legend>
<table>
	<tr>
		<td><input type="button" id="btnGuardar" onclick="javascript:InsertDetalleInterno('<?php echo $id_tbticket; ?>')" value="Guardar Detalle" /></td>
		<td><input type="button" id="btnRevisar" onclick="javascript:RevisarTicket('<?php echo $id_tbticket; ?>')" value="Ticket Revisado" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="button" id="btnCerrar" onclick="javascript:CerrarTicket('<?php echo $id_tbticket; ?>')" value="Cerrar Ticket" /></td>
	</tr>
</table>
</fieldset>
</div>