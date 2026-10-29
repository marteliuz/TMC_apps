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
<table border="1">
  <tr align="center" bgcolor="#999999">
    <td><strong>Cliente</strong></td>
    <td><strong>Modelo</strong></td>
    <td><strong>Ubicacion</strong></td>
    <td><strong>Nserie Codec</strong></td>
    <td><strong>Nserie Camara</strong></td>
    <td><strong>Nserie Mic</strong></td>
    <td><strong>Nserie Cremoto</strong></td>
    <td><strong>ID Contrato Cliente</strong></td>
    <td><strong>ID Contrato Polycom</strong></td>
  </tr>
<?php
	while($Reg = mysql_fetch_array($result))
	{
?>	
  <tr align="center">
	<td><?php echo getClientNameById($Reg['cliente']); ?></td>
	<td><?php echo getModeloById($Reg['modelo']); ?></td>
	<td><?php echo $Reg['ubicacion']; ?></td>
	<td><?php echo $Reg['nserie']; ?></td>
	<td><?php echo $Reg['nserie_camara']; ?></td>
	<td><?php echo $Reg['nserie_mic']; ?></td>
	<td><?php echo $Reg['nserie_cremoto']; ?></td>
	<td><a href="#" onclick="javascript:PopUp_Contrato('<?php echo $Reg['contrato'];?>')"> <?php echo getContratoIdById($Reg['contrato']);?> </a></td>
	<td><?php echo $Reg['contrato_polycom']; ?></td>
  </tr>
<?php
	}
?>
</table><br><br>
<?php
}
?>