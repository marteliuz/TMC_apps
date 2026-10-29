<?php
require('config.php');
require('lib_functions.php');

$iduser   = $_POST['iduser'];
$qry      = "SELECT * FROM dbtmedia.tbusuarios WHERE idtbusuarios = '$iduser'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);

if($num_rows!=0)
{
	$Reg = mysql_fetch_array($result);
	
	$id       = $Reg['idtbusuarios'];
	$username = $Reg['username'];
	$password = $Reg['password'];
	$nombre   = $Reg['nombre'];
	$email    = $Reg['email'];
	$status   = $Reg['estatus'];
	$cliente  = $Reg['cliente'];
	$tipo	  = $Reg['tipo'];
}
?>
<fieldset id="fldDatos">
	<table id="tbusuario">
    <tr>
		<td width="200"><strong>Nombre</strong></td>
		<td width="20"><input type="hidden" name="idtb" id="idtb" value="<? echo $id; ?>"/></td>
		<td width="200"></td>
    </tr>
    <tr>
		<td colspan="3"><input type="text" name="nomb_usuario" id="nomb_usuario" style="width:100%" onkeypress="return soloLetras(event)" value="<? echo $nombre; ?>"/></td>
    </tr>
    <tr>
		<td><strong>Username</strong></td>
		<td></td>
		<td><strong>Email</strong></td>
    </tr>
    <tr>
		<td><input type="text" name="username" id="username" value="<? echo $username; ?>"/></td>
		<td></td>
		<td><input type="text" name="email" id="email" style="width:100%" value="<? echo $email; ?>"/></td>
    </tr>
    <tr>
		<td><strong>Password</strong></td>
		<td></td>
		<td><strong>Estado</strong></td>
    </tr>
    <tr>
		<td><input type="text" name="password" id="password" value="<? echo $password; ?>"/></td>
		<td></td>
<?php
if($status==1)
{
	echo "<td><p><input type='radio' name='RadioGroupEstado' value='1' id='RadioGroupEstado_0' checked/>Activo<br />
			     <input type='radio' name='RadioGroupEstado' value='0' id='RadioGroupEstado_1' />Inactivo<br /></p></td>";
}else{
	echo "<td><p><input type='radio' name='RadioGroupEstado' value='1' id='RadioGroupEstado_0' />Activo<br />
			     <input type='radio' name='RadioGroupEstado' value='0' id='RadioGroupEstado_1' checked/>Inactivo<br /></p></td>";
}
?>
    </tr>
    <tr>
		<td><strong>Privilegios</strong></td>
		<td></td>
		<td></td>
    </tr>
    <tr>
<?php if($tipo==1){ $style = "style='visibility:hidden'"; ?>
	<td><p><label><input type="radio" name="RadioGroup" value="1" id="RadioGroup_0" onclick="javascript:hideDiv('cliente')" checked/>Administrador</label><br />
			     <label><input type="radio" name="RadioGroup" value="2" id="RadioGroup_1" onclick="javascript:showDiv('cliente')"/>Cliente</label><br /></p></td>
<?php }else{ $style = "style='visibility:visible'"; ?>
	<td><p><label><input type="radio" name="RadioGroup" value="1" id="RadioGroup_0" onclick="javascript:hideDiv('cliente')"/>Administrador</label><br />
			     <label><input type="radio" name="RadioGroup" value="2" id="RadioGroup_1" onclick="javascript:showDiv('cliente')" checked/>Cliente</label><br /></p></td>
<?php } ?>
		<td></td>
        <td><div id="cliente" <?php echo $style; ?> ><strong>Seleccione</strong> <?php echo getCmbClientes('cmbClientes',null); ?></div></td>
    </tr>
    <tr>
		<td colspan="3"></td>
    </tr>
    <tr>
		<td colspan="3" align="center"><input type="button" name="btnActualizar" id="btnActualizar" value="Actualizar" onclick="javascript:updateUserInfo()"/></td>
    </tr>
	</table>
</fieldset>