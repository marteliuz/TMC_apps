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
<title>Registro Nuevo Contrato Cliente</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<script type="text/javascript" src="../js/datepickercontrol.js"></script> 
<link type="text/css" rel="stylesheet" href="../css/datepickercontrol.css"> 
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
	font-size: 10px;
	position: fixed;
	left: 0px;
	bottom: 0;
	height: 65px;
	width: 100%;
	background: #cecece;
}
-->
</style>
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
<fieldset><legend>Crear Nuevo Contrato Cliente</legend>
<table style="width:100%">
	<tr>
    	<td>
        	<table>
            	<tr>
                	<td><strong>Cliente</strong></td>
                    <td rowspan="4" width="50" align="center"><input type="button" name="btnCopiar" id="btnCopiar" value=">" onclick="javascript:CopyClientName()"/></td>
                  	<td><strong>Cliente Final</strong></td>
                </tr>
            	<tr>
                	<td><?php echo getCmbClientes("cmbClientes","getSiglaByCliente()");?></td>
                    <td><input type="text" name="cliente_final" id="cliente_final" style="width:100%"/></td>
                </tr>
            	<tr>
                	<td><strong>Sigla</strong></td>
                  	<td><strong>Sigla</strong></td>
                </tr>
            	<tr>
                	<td><label><input name="sigla_cliente" type="text" id="sigla_cliente" maxlength="3" /></label></td>
                  	<td><input name="sigla_cliente_final" type="text" id="sigla_cliente_final" maxlength="3" /></td>
                </tr>
             </table>
        </td>
    </tr>
  	<tr>
	    <td>
        	<table>
            	<tr>
                	<td><strong>Fecha Inicio</strong></td>
               	  <td rowspan="2" width="50">&nbsp;</td>
               	  <td><strong>Fecha Termino</strong></td>
                </tr>
            	<tr>
                	<td><input type="text" name="fecha_inicio" id="fecha_inicio" datepicker="true" datepicker_format="YYYY-MM-DD" /></td>
                	<td><input type="text" name="fecha_termino" id="fecha_termino" datepicker="true" datepicker_format="YYYY-MM-DD" /></td>
                </tr>
            </table>
        </td>
    </tr>
  	<tr>
    	<td>
        	<table>
	      		<tr>
        			<td><strong>SLA</strong></td>
        			<td rowspan="2" width="75">&nbsp;</td>
        			<td><strong>Tipo Contrato</strong></td>
      			</tr>
      			<tr>
        			<td><input type="text" name="sla" id="sla" maxlength="3"/></td>
        			<td><?php echo getCmbTipoContratos("cmbTipoContratos");?></td>
      			</tr>
    		</table>
       </td>
    </tr>
  	<tr>
    	<td>
        	<table>
      			<tr>
        			<td><strong>Vigente</strong></td>
      			</tr>
      			<tr>
        			<td>
                    	<table width="200">
		    				<tr>
								<td><label><input name="Vigencia" type="radio" id="Vigencia_0" value="1" checked="checked" />SI</label></td>
							</tr>
							<tr>
								<td><label><input type="radio" name="Vigencia" value="0" id="Vigencia_1" />NO</label></td>
							</tr>
						</table>
                   </td>
      			</tr>
	    	</table>
        </td>
    </tr>
    <tr>
		<td colspan="3" align="center"><input type="button" id="btnCrear" value="Crear" onclick="javascript:CrearContrato()"></td>
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
