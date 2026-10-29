<?php
require("config.php");
require("lib_functions.php");

$cliente   	= $_POST['cliente'];
$qry    	= "
SELECT * FROM dbtmedia.tbcontratos WHERE cliente_final LIKE '%$cliente%'";


$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	echo "No se encuentra este cliente registrado en la DB o se encuentra con otro nombre";
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	left:11.5px;
	top:60px;
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
<br><br>
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
  </tr>
	<?php
	
	while($reg = mysql_fetch_array($result))
	{
	
?>
<td align= center><?php echo getClientNameById($reg['cliente']); ?></td>
<td align= center><?php echo $reg['cliente_final'] ?></td>
<td align= center><?php if($reg['vigente']==1){echo "Si";}else{echo "No";}?></td>
<td align= center><?php echo date("d-m-Y", strtotime($reg['fecha_inicio']))?></td>
<td align= center><?php echo date("d-m-Y", strtotime($reg['fecha_termino']))?></td>
<td align= center><?php echo getTipoContratoById($reg['tipo_contrato'])?></td>

<?php
	$id			= $reg['idtbcontratos'];
	$result1 	= mysql_query ("SELECT * FROM tbcontratos_polycom WHERE $id = idtbcontratos_polycom");

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
}
?>
