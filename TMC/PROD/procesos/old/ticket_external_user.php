<?php
require('config.php');
require("lib_functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nuevo Ticket Externo</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		body {
		background-image: url(../resources/BackGround.png);
		background-repeat: no-repeat;
		font-size:12px;
		}
		#formTicket {
		position:absolute;
		left:25px;
		top:25px;
		}
		#tbContacto {
		width:800px;
		}
		#tbTerminal {
		width:800px;
		}
		#resultado {
		position:absolute;
		left:875px;
		top:30px;
		}		
		-->
	</style>
</head>

<body>
<div id="formTicket">
	<fieldset id="fldContacto"><legend>Datos de Contacto</legend>
        <table id="tbContacto">
          <tr>
            <td width="250">&nbsp;</td>
            <td width="25">&nbsp;</td>
            <td width="250">&nbsp;</td>
            <td width="25">&nbsp;</td>
            <td width="250" align="center"><input name="fecha_creacion" type="text" disabled="disabled" id="fecha_creacion" value="<?php echo getNow(); ?> "/></td>
          </tr>
          <tr>
            <td><strong>Nombre Empresa</strong></td>
            <td>&nbsp;</td>
            <td><strong>Nombre Contacto</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label><input type="text" name="nomb_cliente" id="nomb_cliente" style="width:100%" /></label></td>
            <td>&nbsp;</td>
            <td><label><input type="text" name="nomb_contacto" id="nomb_contacto" style="width:100%" /></label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Telefono Contacto</strong></td>
            <td>&nbsp;</td>
            <td><strong>Movil Contacto</strong></td>
            <td>&nbsp;</td>
            <td><strong>Email Contacto</strong></td>
          </tr>
          <tr>
            <td><label><input type="text" name="telef_contacto" id="telef_contacto" /></label></td>
            <td>&nbsp;</td>
            <td><label><input type="text" name="movil_contacto" id="movil_contacto" /></label></td>
            <td>&nbsp;</td>
            <td><label><input type="text" name="email_contacto" id="email_contacto" style="width:100%" /></label></td>
          </tr>
          <tr>
            <td><strong>Direccion Contacto</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><label><input type="text" name="dir_contacto" id="dir_contacto" style="width:100%" /></label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
	</fieldset>
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
				<td><label><input type="text" name="modelo" id="modelo" style="width:100%" /></label></td>
				<td>&nbsp;</td>
				<td><label><input type="text" name="nserie_terminal" id="nserie_terminal" style="width:100%" /></label></td>
				<td>&nbsp;</td>
				<td><label><input type="text" name="nserie_falla" id="nserie_falla" style="width:100%"/></label></td>
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
				<td colspan="5" align="center"><label><input type="button" name="btnCrear" id="btnCrear" value="Crear Ticket" onClick="javascript:CrearNuveoTicketExterno()"/></label></td>
			</tr>
      </table>
    </fieldset>
</div>
<div id="resultado"></div>
</body>
</html>