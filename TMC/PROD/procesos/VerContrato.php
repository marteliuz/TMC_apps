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
<div style="float: right"><a href="javascript:imprime_clientes()"><img src="../resources/boton-imprimir.jpg" alt="imprimir" width="130" height="38" longdesc="boton-imprimir.jpg" ></img></a></div>
<title>Ver Contratos Clientes</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
	<!--
	#select {
	position:absolute;
	left:25px;
	top:25px;
	}
	#imprimir {
	position:absolute;
	left:23px;
	top:120px;
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
    <form>
    <table>
    <tr>
    <td width="280" align="center"><label><input type="radio" name="radio" id="op1" value="op1"  onclick="javascript:changeSearchMode3('BySN','ByCliente', 'ByCliente2')" checked="checked"/>Búsqueda por S/N</label></td>
	<td width="280" align="center"><label><input type="radio" name="radio" id="op2" value="op2" onclick="javascript:changeSearchMode3('BySN','ByCliente', 'ByCliente2')" />Búsqueda por Cliente Final</label></td>
	<td width="280" align="center"><label><input type="radio" name="radio" id="op3" value="op3"  onclick="javascript:changeSearchMode3('BySN','ByCliente', 'ByCliente2')"/>Búsqueda por Cliente</label></td>
	</tr>
	<tr>
	<td align="center">
	<div id="BySN"><fieldset><legend>Introduzca el S/N y pulse Buscar</legend>
	<input type="text" name="nserie_srch" id="nserie_srch" maxlength="20"/>
	<input type="button" name="btnSrch" id="btnSrch" value="Buscar" onclick="javascript:buscarContrato()"/>
	</fieldset>
	</div>
	</td>
	
	<td align="center">
	<div id="ByCliente" style="visibility:hidden"><fieldset><legend>Introduzca nombre y pulse Buscar</legend>
	<input type="text" name="cliente_srch" id="cliente_srch" maxlength="50"/>
	<input type="button" name="btnSrch1" id="btnSrch1" value="Buscar" onclick="javascript:buscarContrato2()"/>
	</fieldset>
	</div>
	</td>
	<td align="center">
	<div id="ByCliente2" style="visibility:hidden"><fieldset><legend>Seleccione un cliente</legend>
	<?php echo getCmbClientes("cmbClientes","showAllTerminalesByCliente1()");?>
	</fieldset>
	</div>
	</td>
    </tr>
    </table>
    </form>
	</div>
	<div id=imprimir>
	<fieldset id="fldCo"><legend>Resultado</legend>
    
	
	<table width=1310 border=1 cellpadding=3 cellspacing=0>
	<td align= center><strong>Cliente</strong></td>	 
	<td align= center><strong>Cliente Final</strong></td>
	<td align= center><strong>Estado Vigencia</strong></td>
	<td align= center><strong>Fecha Inicio</strong></td>
	<td align= center><strong>Fecha Término</strong></td>
	<td align= center><strong>Tipo de Contrato</strong></td>
	<td align= center><strong>Fecha Inicio Polycom</strong></td>
	<td align= center><strong>Fecha Término Polycom</strong></td>
	<td align= center><strong>Productos</strong></td>
	</tr>
	<?php
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbtmedia", $con);
	
	 $result 	= mysql_query ("SELECT * FROM tbcontratos");
	
	while($reg = mysql_fetch_array($result))
	{

?>
<tr align="center">
<td align= center><?php echo getClientNameById($reg['cliente']); ?></td>
<td align= center><?php echo $reg['cliente_final'] ?></td>
<td align= center><?php if($reg['vigente']==1){echo "Si";}else{echo "No";}?></td>
<td align= center><?php echo date("d-m-Y", strtotime($reg['fecha_inicio']))?></td>
<td align= center><?php echo date("d-m-Y", strtotime($reg['fecha_termino']))?></td>
<td align= center><?php echo getTipoContratoById($reg['tipo_contrato'])?></td>

<?php

	$id			= $reg['idtbcontratos'];
	$result1 	= mysql_query ("SELECT * FROM tbcontratos_polycom WHERE idtbcontratos_polycom = $id");
	
	while($reg1 = mysql_fetch_array($result1))
	{
?>

<td align= center><?php echo date("d-m-Y", strtotime($reg1['fecha_inicio']))?></td>
<td align= center><?php echo date("d-m-Y", strtotime($reg1['fecha_termino']))?></td>
<td align= center><input type="button" name="productos" id="productos" value ="Ver Productos" onclick="window.open('VerProductos.php?id=<?php echo $id ?>', 'Ver','status = 1, height = 500, width = 600, scrollbars=1, resizable = 0')"></td>
</tr>
<?php

}
}

?>
</table>
</div>
</fieldset>
<?php

}else{
	header("location:../errores/SinPermisos.php");
}
?>