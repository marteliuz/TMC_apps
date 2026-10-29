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
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
	<style type="text/css">
	<!--
		body {
		background-color:#0C0304;
		color:#CCC;
		}
		#formTicket {
		position:absolute;
		left:100px;
		top:75px;
		}
		#title {
		position:absolute;
		left:100px;
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
		#footer {
		position:fixed;
		left:100px;
		bottom: 0;
		width: 100%;
		}
	-->
	</style>
	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
</head>

<body>
	<a href="../index.php">Salir</a><br>
	<h1 id="title" align="center">Nueva solicitud de servicio</h1>

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
            <td>Nombre Empresa</td>
            <td>&nbsp;</td>
            <td>Nombre Contacto</td>
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
            <td>Telefono Contacto</td>
            <td>&nbsp;</td>
            <td>Movil Contacto</td>
            <td>&nbsp;</td>
            <td>Email Contacto</td>
          </tr>
          <tr>
            <td><label><input name="telef_contacto" type="text" id="telef_contacto" maxlength="9" onkeypress="return soloNumeros(event)"/></label></td>
            <td>&nbsp;</td>
            <td><label><input name="movil_contacto" type="text" id="movil_contacto" maxlength="9" onkeypress="return soloNumeros(event)"/></label></td>
            <td>&nbsp;</td>
            <td><label><input type="text" name="email_contacto" id="email_contacto" style="width:100%" /></label></td>
          </tr>
          <tr>
            <td>Direccion Contacto</td>
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
				<td width="250">Modelo Terminal</td>
				<td width="25">&nbsp;</td>
				<td width="250">N&deg; de serie Terminal</td>
				<td width="25">&nbsp;</td>
				<td width="250">N&deg; de serie Dispositivo Falla</td>
			</tr>
			<tr>
				<td><?php echo getCmbModelosTerminales("cmbModelos",null); ?></td>
				<td>&nbsp;</td>
				<td><label><input name="nserie_terminal" type="text" id="nserie_terminal" style="width:100%" maxlength="16" /></label></td>
				<td>&nbsp;</td>
				<td><label><input name="nserie_falla" type="text" id="nserie_falla" style="width:100%" maxlength="16"/></label></td>
			</tr>
			<tr>
				<td colspan="5"><div id="divInfoTerminal"></div></td>
			</tr>
			<tr>
				<td><p>Detalle sobre la falla</p></td>
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
<table id="footer">
	<tbody>
	<tr>
		<td>
			<p><span><span style="color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left; background-color: #0c0304;">Valentín Letelier 1373 Oficina 705 Santiago Chile. <br />Teléfonos +56 2 (6964016)&nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">&nbsp;(6964051) &nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">(6964057) &nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2&nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">(6964031)&nbsp;</span></span></p>
			<p><span style="color: #8b8077; font-family: Arial,Helvetica,sans-serif; font-size: 11px; line-height: 17px; text-align: left; background-color: #0c0304;"><span>Soporte y Post Venta&nbsp;Todos los derechechos reservados a touchmedia.cl</span> <br /></span></p>
		</td>
		<td><img alt="solologos" src="../resources/solologos.png" height="84" width="400" /></td>
	</tr>
	</tbody>
</table>
</body>
</html>