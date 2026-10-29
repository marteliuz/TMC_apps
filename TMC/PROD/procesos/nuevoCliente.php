<?php
include("config.php");
require("lib_functions.php");

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Nuevo Cliente</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<style type="text/css">
<!--
#form {
	position:absolute;
	width:525px;
	top:25px;
	left:25px;	
}
#tbempresa{
	width:525px;
}
#tbcontacto{
	width:525px;
}
#resultado{
	position:absolute;
	top:30px;
	left:600px;
}
#foot {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10px;
	position:fixed;
	left:0px;
	bottom: 0;
	height: 65px;
	width: 100%;
	background: #cecece;
}
-->
</style>
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type='text/javascript' src="../js/jquery.autocomplete.js" ></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />

<script>
	var $j = jQuery.noConflict();

	$j(document).ready(function(){
	 $j("#nomb_cliente").autocomplete("autocomplete_nombCliente.php", {
			selectFirst: true
		});
	});
</script>

<script type="text/javascript" src="../AlertBox/mootools.js"></script>
<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>

<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
</script>

</head>
<body>
<div id="form">
	<fieldset id="fldempresa"><legend>Datos Empresa</legend>
		<table id="tbempresa">
			<tr >
				<td colspan="2">
					<table style="width:100%">
						<tr>
							<td><strong>Nombre o Raz&oacute;n Social</strong></td>
							<td width="25">&nbsp;</td>
							<td width="120"><strong>RUT</strong></td>
						</tr>
						<tr>
							<td><input name="nomb_cliente" type="text" id="nomb_cliente" style="width:100%" maxlength="45" /></td>
							<td>&nbsp;</td>
							<td><input name="rut_cliente" type="text" id="rut_cliente" onkeypress="return modoRut(event)" maxlength="13" style="width:100%"/></td>
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
							<td><input name="telef_cliente" type="text" id="telef_cliente" onkeypress="return soloNumeros(event)" maxlength="11" style="width:100%"/></td>
							<td>&nbsp;</td>
							<td><input name="giro_cliente" type="text" id="giro_cliente" style="width:100%" maxlength="45"/></td>
							<td>&nbsp;</td>
							<td><input name="sigla" type="text" id="sigla_cliente" maxlength="3" style="width:100%"/></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Direcci&oacute;n</strong></td>
			</tr>
			<tr>
				<td colspan="2"><input name="dir_cliente" type="text" id="dir_cliente" style="width:100%" maxlength="50"/></td>
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
				<td><?php echo getCmbRegionesJS("cmbRegiones_cliente","loadComunasByRegion1()");?></td>
				<td>
					<table>
						<tr>
							<td width="25" >&nbsp;</td>
							<td><div id="divComunas1">Seleccione una Región...</div></td>
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
				<td width="250"><strong>Nombre</strong></td>
				<td width="25"></td>
				<td width="250"><strong>Cargo</strong></td>
			</tr>
			<tr>
				<td><input name="nomb_contacto" type="text" id="nomb_contacto" style="width:100%" size="45"/></td>
				<td></td>
				<td><input name="cargo_contacto" type="text" id="cargo_contacto" style="width:100%" maxlength="45"/></td>
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
							<td><input name="email_contacto" type="text" id="email_contacto" /></td>
							<td>&nbsp;</td>
							<td><input name="telef_contacto" type="text" id="telef_contacto" onkeypress="return soloNumeros(event)" maxlength="11"/></td>
							<td>&nbsp;</td>
							<td><input name="movil_contacto" type="text" id="movil_contacto" onkeypress="return soloNumeros(event)" maxlength="11" /></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3"><strong>Direcci&oacute;n</strong></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><input name="dir_contacto" type="text" id="dir_contacto" style="width:100%" maxlength="50"/></td>
			</tr>
			<tr>
				<td colspan="2" align="left"><strong>Regi&oacute;n</strong></td>
				<td>
					<table>
						<tr>
							<td width="25">&nbsp;</td>
							<td><strong>Ciudad/Comuna</strong></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2"><?php echo getCmbRegionesJS('cmbRegiones_contacto','loadComunasByRegion2()');?></td>
				<td>
					<table>
						<tr>
							<td width="25">&nbsp;</td>
							<td><div id="divComunas2">Seleccione una Región...</div></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td align="center"><input type="reset" name="btn_reset" id="btn_reset" value="Limpiar" onClick="javascript:resetFormNuevoCliente()"/></td>
				<td></td>
				<td align="center"><input type="button" name="btn_guardar" id="btn_guardar" value="Registrar" onClick="javascript:InsertCliente()"/></td>
			</tr>
			<tr>
				<td colspan="3" align="center"></td>
			</tr>
		</table>
	</fieldset> 
</div>
<div id="resultado"></div>
<!-- <div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div> -->

</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>