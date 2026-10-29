<?php
require("config.php");
require("lib_functions.php");
session_start();

$id_ticket = $_POST["id_ticket"];
$qry       = "SELECT * FROM dbtmedia.tbtickets WHERE id_ticket = '$id_ticket'";
$result    = mysql_query($qry,$conexion);
$num_rows  = mysql_num_rows($result);

if($num_rows!=0)
{
	$Reg             = mysql_fetch_array($result);
	$idtbticket      = $Reg['idtbtickets'];
	$tipo            = $Reg['tipo'];
	$estado          = $Reg['estado'];
	$xEstado         = getStatusById($estado);
	$fecha_creacion  = $Reg['fecha_creacion'];
	$fecha_revision  = $Reg['fecha_revision'];
	$fecha_cierre    = $Reg['fecha_cierre'];
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
	$detalle_interno = $Reg['detalle_interno'];
	$usuario         = $Reg['usuario'];
	
	$num_comments    = getNumbMessagesTicket($idtbticket);
	
	//
	//echo "<br>".$idtbticket;echo "<br>".$tipo;echo "<br>".$estado;echo "<br>".$fecha_creacion;echo "<br>".$fecha_revision;echo "<br>".$fecha_cierre;echo "<br>".$id_cliente;echo "<br>".$nomb_cliente;echo "<br>".$nomb_contacto;echo "<br>".$telef_contacto;echo "<br>".$movil_contacto;echo "<br>".$email_contacto;echo "<br>".$dir_contacto;echo "<br>".$id_terminal;echo "<br>".$modelo_terminal;echo "<br>".$nserie_terminal;echo "<br>".$nserie_falla;echo "<br>".$detalle_falla;echo "<br>".$detalle_interno;echo "<br>".$usuario;
?>	
<fieldset><legend>Ticket</legend>
<table id="tbContacto">
	<tr>
		<td width="200">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="200"><strong>Estado</strong></td>
		<td width="20">&nbsp;</td>
		<td width="200"><strong>Fecha creacion</strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="text" id="xEstado" disabled value="<?php echo $xEstado; ?>"></td>
		<td>&nbsp;</td>
		<td><input name="fecha_creacion" type="text" disabled id="fecha_creacion" value="<?php echo $fecha_creacion; ?> "/></td>
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
		<td colspan="2" align="center">&nbsp;</td>
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
	<tr>
		<td><p><strong>Detalle Interno</strong></p></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="5"><textarea name="detalle_interno" id="detalle_interno" cols="50" rows="5" disabled style="width:100%"><?php echo $detalle_interno;?></textarea></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<?php
			if($num_comments!=0)
			{
				echo "<td><a href='#' onclick='javascript:showCommentsPopUp($idtbticket)'>Ver los ($num_comments) comentarios</a></td>";
			}else{
				echo "<td>No hay comentarios asociados al Ticket</td>";
			}
		?>
	</tr>
</table>
</fieldset>
	
<?php	
}else{
	echo "No hemos encontrado un Ticket asociado al ID ingresado";
}
?>