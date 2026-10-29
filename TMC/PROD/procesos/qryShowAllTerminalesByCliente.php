<?php
include("config.php");
require("lib_functions.php");
session_start();
$id_cliente = $_POST['id_cliente'];
$qry = "
SELECT  idtbterminales,
		nserie,
		nserie_camara,
		nserie_cremoto,
		nserie_mic,
		modelo,
		cliente,
		ubicacion,
		contrato,
		contrato_polycom
FROM dbtmedia.tbterminales 
WHERE cliente = '$id_cliente'";
$request   = mysql_query($qry);
if(mysql_num_rows($request)==0)
{
	echo "No hay datos que mostrar";
}else{
?>
<!-- <a href="../procesos/xls_terminales.php?id_cliente=<?php echo $id_cliente;?>"><img src="../resources/exportExcel.png"></a><br><br> -->
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
	while($Reg = mysql_fetch_array($request))
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