<?php
require('config.php');
require("lib_functions.php");
session_start();

$username     = $_SESSION['Usuario'];
$userid       = getUserIdByUsername($username);
$cliente      = getClientAssocByUserId($userid);
$nomb_cliente = getClientNameById($cliente);

$qry      = "SELECT * FROM dbtmedia.tbclientes WHERE idtbclientes = '$cliente'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	$nomb_contacto  = $Reg['nombre_contacto'];
	$email_contacto = $Reg['email_contacto'];
	$movil_contacto = $Reg['movil_contacto'];
	$telef_contacto = $Reg['telef_contacto'];
	$direc_contacto = $Reg['direccion_contacto'];
	
	$cmb_terminales = getCmbterminalesByIdCliente('cmbTerminales', 'loadTerminalInfo()', $cliente);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nuevo Ticket de Cliente</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>
	<style type="text/css">
		<!--
		body {
		background-color:#0C0304;
		color:#CCC;
		}
		#title {
		position:absolute;
		left:25px;
		}
		#formTicket {
		position:absolute;
		left:100px;
		top:60px;
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
		#sesion {
		position:absolute;
		color:#CCC;
		top:50px;
		right:100px;
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
<div id="sesion"><p>Ha iniciado sesión como: <?php echo $username;?> <a href="../procesos/logout.php">Cerrar Sesión</a></p></div>
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
            <td><label><input type="text" name="nomb_cliente" id="nomb_cliente" style="width:100%" value="<?php echo $nomb_cliente; ?>"/></label></td>
            <td><input type="hidden" id="id_cliente" value="<?php echo $cliente; ?>"></td>
            <td><label><input type="text" name="nomb_contacto" id="nomb_contacto" style="width:100%" value="<?php echo $nomb_contacto; ?>"/></label></td>
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
            <td><label><input type="text" name="telef_contacto" id="telef_contacto" value="<?php echo $telef_contacto; ?>"/></label></td>
            <td>&nbsp;</td>
            <td><label><input type="text" name="movil_contacto" id="movil_contacto" value="<?php echo $movil_contacto; ?>"/></label></td>
            <td>&nbsp;</td>
            <td><label><input type="text" name="email_contacto" id="email_contacto" style="width:100%" value="<?php echo $email_contacto; ?>"/></label></td>
          </tr>
          <tr>
            <td>Direccion Contacto</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><label><input type="text" name="dir_contacto" id="dir_contacto" style="width:100%" value="<?php echo $direc_contacto; ?>"/></label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
	</fieldset>
	<fieldset id="fldTerminal"><legend>Datos Terminal</legend>
   	  <table id="tbTerminal">
        <tr>
          <td colspan="5">
			<div id="divTerminales">            
				<table>
					<tr>
						<td><input type="radio" name="RadioGroup" value="1" id="RadioGroup_0" checked="true" onclick="javascript:ShowDivCmbTerminales()"/>Seleccione un terminal de la lista</td>
						<td><div id="DivCmbTerminales"><?php echo $cmb_terminales; ?></div></td>
						<td><input type="radio" name="RadioGroup" value="2" id="RadioGroup_1" onclick="javascript:NuevoTerminalTicket()"/>Ingrese uno nuevo</td>
					</tr>
				</table>
			</div></td>
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
			<td colspan="5" align="center"><label><input type="button" name="btnCrear" id="btnCrear" value="Crear Ticket" onClick="javascript:CrearNuveoTicketCliente()"/></label></td>
        </tr>
      </table>
    </fieldset>
</div>
<div id="resultado"></div>
<table id="footer">
	<tbody>
	<tr>
		<td>
			<p><span><span style="color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left; background-color: #0c0304;">Valent&iacute;n Letelier 1373 Oficina 705 Santiago Chile. <br />Tel&eacute;fonos +56 2 (6964016)&nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">&nbsp;(6964051) &nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">(6964057) &nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 16px; text-align: left;">+56 2&nbsp;</span><span style="background-color: #0c0304; color: #8b8077; font-family: Arial,Helvetica,sans-serif; line-height: 17px; text-align: left;">(6964031)&nbsp;</span></span></p>
			<p><span style="color: #8b8077; font-family: Arial,Helvetica,sans-serif; font-size: 11px; line-height: 17px; text-align: left; background-color: #0c0304;"><span>Soporte y Post Venta&nbsp;Todos los derechechos reservados a touchmedia.cl</span> <br /></span></p>
		</td>
		<td><img alt="solologos" src="../resources/solologos.png" height="84" width="400" /></td>
	</tr>
	</tbody>
</table>
</body>
</html>
<?php
}else{
echo "Error al recuperar los datos.<br><a href='../procesos/logout.php'>Volver</a>";
}
?>