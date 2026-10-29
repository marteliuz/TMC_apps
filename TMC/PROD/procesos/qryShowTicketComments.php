<?php
require('config.php');
require("lib_functions.php");
session_start();

$origen      = $_SESSION['UserType'];
$id_tbticket = $_POST['id_ticket'];
$qry         = "SELECT * FROM dbtmedia.tbcomments WHERE id_ticket = '$id_tbticket' ORDER BY fecha DESC LIMIT 3 ";
$result      = mysql_query($qry);
$num_rows    = mysql_num_rows($result);

if($num_rows!=0)
{
	echo "<fieldset><legend>Comentarios</legend>";
	while($Reg = mysql_fetch_array($result))
	{
		$idtb    = $Reg['idtbcomments'];
		$fecha   = $Reg['fecha'];
		$comment = $Reg['comment'];
?>

<table>
	<tr>
		<td><?php echo $fecha;?></td>
		<td><?php echo $origen;?> dice:</td>
	</tr>
	<tr>
		<td colspan="2">"<?php echo $comment; ?>"</td>
	</tr>
</table>
<?php
	}
}else{
	echo "No hay comentarios anteriores.<br>";
}
$num_comments = getNumbMessagesTicket($id_tbticket);
if($num_comments!=0){
	echo "<a href='#' onclick='javascript:showCommentsPopUp($id_tbticket)'>Ver los ($num_comments) comentarios</a>";
}
echo "</fieldset><br>";
?>
<table id="tbcomment">
	<tr>
		<td align="right"><input type="hidden" id="id_ticket" value="<?php echo $id_tbticket; ?>"><label><input type="text" name="fecha" id="fecha" disabled value="<?php echo getNow(); ?> "/></label></td>
	</tr>
	<tr>
		<td align="center"><input type="hidden" id="origen" value="<?php echo $origen; ?>"><label><textarea name="txt" id="comment" cols="35" rows="5"></textarea></label></td>
	</tr>
	<tr>
		<td align="center"><label><input type="button" name="btnEnviar" id="btnEnviar" value="Enviar" onClick="javascript:SendComment()"/></label></td>
	</tr>
</table>
<div id="ResultadoTicketComment"></div>