<?php
require("config.php");
require("lib_functions.php");

$id_ticket = $_GET['id_ticket'];
// echo "ID Ticket= ".$id_ticket;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Historial de comentarios</title>
<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
<style type="text/css">
		<!--
		body {
		font-size:12px;
		}
		#Cliente	{
		background-color:#FF6;
		text-align:left;
		}
		#Admin {
		background-color:#6F6;
		text-align:right;
		}
		-->
</style>
</head>
<body>
<?php
$qry      = "SELECT * FROM dbtmedia.tbcomments WHERE id_ticket = $id_ticket";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);

if($num_rows!=0)
{
	while($Reg = mysql_fetch_array($result))
	{
		$origen  = $Reg['origen'];
		$comment = $Reg['comment'];
		$fecha   = $Reg['fecha'];
?>

<fieldset id="<?php echo $origen;?>">
<table>
  <tr>
	  <td><?php echo $fecha;?></td>
	  <td><?php echo $origen;?> dice:</td>
  </tr>
  <tr>
	  <td colspan="2"><?php echo $comment; ?></td>
  </tr>
</table>
</fieldset>
<br>
<?php
	}
}else{
	echo "No hay comentarios";
}
?>
<table id="tbcomment">
	<tr>
		<td align="right"><input type="hidden" id="id_ticket" value="<?php echo $id_ticket; ?>"><label><input type="text" name="fecha" id="fecha" disabled value="<?php echo getNow(); ?> "/></label></td>
	</tr>
	<tr>
		<td align="center"><input type="hidden" id="origen" value="<?php echo $origen; ?>"><label><textarea name="txt" id="comment" cols="35" rows="5"></textarea></label></td>
	</tr>
	<tr>
		<td align="center"><label><input type="button" name="btnEnviar" id="btnEnviar" value="Enviar" onClick="javascript:SendComment()"/></label></td>
	</tr>
</table>
<div id="ResultadoTicketComment"></div>
</body>
</html>