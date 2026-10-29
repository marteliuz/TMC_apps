<?php
require("config.php");
require("lib_functions.php");

$nserie   = $_POST['nserie'];
$qry      = "
SELECT t1.idtbterminales,
		t1.nserie,
		t1.nserie_camara,
		t1.nserie_cremoto,
		t1.nserie_mic,
		t1.modelo,
		t1.cliente,
		t1.ubicacion,
		t1.contrato,
		t1.contrato_polycom
FROM dbtmedia.tbterminales as t1
WHERE nserie = '$nserie' OR 
	  nserie_camara = '$nserie' OR 
	  nserie_mic = '$nserie' OR 
	  nserie_cremoto = '$nserie' ";


$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	echo "No se encuentra este S/N registrado en la DB.";
}else{
?>
<br><br>
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
<div id=imprimir>
<fieldset id="fldCo"><legend>Resultado</legend>

<table width=1310 border=1 cellpadding=3 cellspacing=0>
    <td align= center><strong>Cliente</strong></td>
    <td align= center><strong>Modelo</strong></td>
    <td align= center><strong>Ubicacion</strong></td>
    <td align= center><strong>Nserie Codec</strong></td>
    <td align= center><strong>Nserie Camara</strong></td>
    <td align= center><strong>Nserie Mic</strong></td>
    <td align= center><strong>Nserie Cremoto</strong></td>
    <td align= center><strong>ID Contrato Cliente</strong></td>
    <td align= center><strong>Fecha Inicio Polycom</strong></td>
	<td align= center><strong>Fecha Término Polycom</strong></td>
  </tr>
<?php
	while($Reg = mysql_fetch_array($result))
	{
	
	$id			= $Reg['contrato_polycom'];
	$result1 	= mysql_query ("SELECT * FROM tbcontratos_polycom WHERE $id = idtbcontratos_polycom");
?>	
	<tr align="center">
	<td align= center><?php echo getClientNameById($Reg['cliente']); ?></td>
	<td align= center><?php echo getModeloById($Reg['modelo']); ?></td>
	<td align= center><?php echo $Reg['ubicacion']; ?></td>
	<td align= center><?php echo $Reg['nserie']; ?></td>
	<td align= center><?php echo $Reg['nserie_camara']; ?></td>
	<td align= center><?php echo $Reg['nserie_mic']; ?></td>
	<td align= center><?php echo $Reg['nserie_cremoto']; ?></td>
	<td align= center><a href="#" onclick="javascript:PopUp_Contrato('<?php echo $Reg['contrato'];?>')"> <?php echo getContratoIdById($Reg['contrato']);?> </a></td>
	
<?php
	}
	while($reg1 = mysql_fetch_array($result1))
	{
?>
	<td align= center><?php echo date("d-m-Y", strtotime($reg1['fecha_inicio'])); ?></td>
	<td align= center><?php echo date("d-m-Y", strtotime($reg1['fecha_termino'])); ?></td>
	</tr>
<?php
}
?>
</table>
</div>
</fieldset>
<?php
}
?>