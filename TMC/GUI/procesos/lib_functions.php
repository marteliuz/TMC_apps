<?php
require("config.php");

function getNow()
{
	return date("Y-m-d H:i:s");	
}

function getNewIDContrato($last_insert)
{
	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	for($i=0; $i<10; $i++){
		$var = $var.$str[mt_rand(0,34)];
	}
	$id_contrato = $var."-".$last_insert;
	$qry = "UPDATE dbtmedia.tbcontratos SET id_contrato = '$id_contrato' WHERE idtbcontratos = '$last_insert'";
	mysql_query($qry);
	return $id_contrato;
}

// TIckets Functions
function getNewIDTicket($last_insert)
{
	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	for($i=0; $i<6; $i++){
		$var = $var.$str[mt_rand(0,34)];
	}
	$id_ticket = $var."-".$last_insert;
	$qry = "UPDATE dbtmedia.tbtickets SET id_ticket = '$id_ticket' WHERE idtbtickets = '$last_insert'";
	mysql_query($qry);
	return $id_ticket;
}

function getCountTicketsByEstado($estado)
{
	try{
		if($estado!="")
		{
			$qry = "SELECT COUNT(id_ticket) AS count FROM dbtmedia.tbtickets WHERE estado = $estado;";
			$result = mysql_query($qry);
			$Reg = mysql_fetch_array($result);
			$var = $Reg['count'];
			return $var;
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getCountTicketsByEstado | ".$ex->getMessage();
		return 0;
	}
}

function getCountOpenTicketByTipo($tipo)
{
	try{
		if($tipo!="")
		{
			$qry = "SELECT COUNT(id_ticket) AS count FROM dbtmedia.tbtickets WHERE estado = 0 AND tipo = $tipo";
			$result = mysql_query($qry);
			$Reg = mysql_fetch_array($result);
			$var = $Reg['count'];
			return $var;
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getCountOpenTicketByTipo | ".$ex->getMessage();
		return 0;
	}
}


// Client Functions
function getClientIdByName($name)
{
	try{
		if($name!=""){
			$qry = "SELECT idtbclientes FROM dbtmedia.tbclientes WHERE descripcion = '$name'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['idtbclientes'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getClientIDbyName | ".$ex->getMessage();
		return 0;
	}
}

function getClientNameById($id)
{
	try{
		if($id!=""){
			$qry = "SELECT nombre_cliente FROM dbtmedia.tbclientes WHERE idtbclientes = '$id'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['nombre_cliente'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getClientIDbyName | ".$ex->getMessage();
		return 0;
	}
}

// User Functions
function isAdmin($username)
{
	try{
		if($username!=""){
			$qry = "SELECT tipo FROM dbtmedia.tbusuarios WHERE username = '$username'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$tipo = $Reg['tipo'];
				if($tipo==1)
				{
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}catch(Exception $ex){
		echo "Error capturado en getUserIdByUsername | ".$ex->getMessage();
		return false;
	}
}

function getUserIdByUsername($username)
{
	try{
		if($username!=""){
			$qry = "SELECT idtbusuarios FROM dbtmedia.tbusuarios WHERE username = '$username'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['idtbusuarios'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getUserIdByUsername | ".$ex->getMessage();
		return 0;
	}
}

function getUsernameByUserId($userid)
{
	try{
		if($userid!=""){
			$qry = "SELECT username FROM dbtmedia.tbusuarios WHERE idtbusuarios = '$userid'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['username'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getUsernameByUserId | ".$ex->getMessage();
		return 0;
	}
}

function getClientAssocByUserId($userid)
{
	try{
		if($userid!=""){
			$qry = "SELECT cliente FROM dbtmedia.tbusuarios WHERE idtbusuarios = '$userid'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['cliente'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getClientAssocByUserId | ".$ex->getMessage();
		return 0;
	}
}

// Terminales Functions
function getModeloById($modelid)
{
	try{
		if($modelid!=""){
			$qry = "SELECT descripcion FROM dbtmedia.tbmodelos WHERE idtbmodelos = '$modelid'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['descripcion'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getModeloById | ".$ex->getMessage();
		return 0;
	}
}

function getModelIdByName($nombre)
{
	try{
		if($nombre!=""){
			$qry = "SELECT idtbmodelos FROM dbtmedia.tbmodelos WHERE descripcion = '$nombre'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['idtbmodelos'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getModelIdByName | ".$ex->getMessage();
		return 0;
	}
}

function getRegionNameById($region_id)
{
	try{
		if($region_id!=""){
			$qry      = "SELECT descripcion FROM dbtmedia.tbregiones WHERE idtbregiones = '$region_id'";
			$result   = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['descripcion'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getRegionNameById | ".$ex->getMessage();
		return 0;
	}
}

function getRegionIdByName($region_name)
{
	try{
		if($region_name!=""){
			$qry = "SELECT idtbregiones FROM dbtmedia.tbregiones WHERE descripcion = '$region_name'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['idtbregiones'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getRegionIdByName | ".$ex->getMessage();
		return 0;
	}
}

function getModeloTerminalByIDterminal($id_terminal)
{
	try{
		if($id_terminal!=""){
			$qry = "SELECT modelo FROM dbtmedia.tbterminales WHERE idtbterminales = $id_terminal";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0)
			{
				$Reg = mysql_fetch_array($result);
				$var = $Reg['modelo'];
				return $var;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getModeloTerminalByIDterminal | ".$ex->getMessage();
		return 0;
	}
}

function getTerminalIdByNSerie($nserie)
{
	try{
		if($nserie!=""){
			$qry = "SELECT idtbterminales as ID FROM dbtmedia.tbterminales WHERE nserie = '$nserie'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0)
			{
				$Reg = mysql_fetch_array($result);
				$var = $Reg['ID'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getTerminalIdByNSerie | ".$ex->getMessage();
		return 0;
	}
}

function getNumbMessagesTicket($id_ticket)
{
	try{
		if($id_ticket!=""){
			$qry = "SELECT COUNT(*) FROM dbtmedia.tbcomments WHERE id_ticket = '$id_ticket'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			$Reg = mysql_fetch_array($result);
			$var = $Reg['COUNT(*)'];
			return $var;
		}else{
			return null;
		}
	}catch(Exception $ex){
		echo "Error capturado en getNumbMessagesTicket | ".$ex->getMessage();
		return null;
	}
}

function getStatusById($id_status)
{
	try{
		if($id_status!=""){
			$qry = "SELECT descripcion FROM dbtmedia.tbstatustickets WHERE idtbstatustickets = '$id_status'";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0)
			{
				$Reg = mysql_fetch_array($result);
				$var = $Reg['descripcion'];
				return $var;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}catch(Exception $ex){
		echo "Error capturado en getStatusById | ".$ex->getMessage();
		return 0;
	}
}

// Get Cmb 

function getCmbTipoContratos($idcmb)
{
$qry = "SELECT * FROM dbtmedia.tbtipocontratos";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['idtbtipocontratos']."'>".$Reg['descripcion']."</option>";
		}
	}
	echo "</select>";
}

function getCmbRegiones($idcmb)
{
	$qry = "SELECT * FROM dbtmedia.tbregiones";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['idtbregiones']."'>".$Reg['descripcion']."</option>";
		}
	}
	echo "</select>";
}

function getCmbterminalesByIdCliente($idcmb, $js_function, $idcliente)
{
	$qry = "SELECT * FROM dbtmedia.tbterminales WHERE cliente = '$idcliente'";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	if($js_function==null)
	{
		$select = "<select name='$idcmb' id='$idcmb'>";
	}else{
		$select = $select."<select name='$idcmb' id='$idcmb' onClick='javascript:$js_function' onChange='javascript:$js_function'>";
	}
	if($cont==0)
	{
		$select =$select."<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			$idtb = $Reg['idtbterminales'];
			$modelo = $Reg['modelo'];
				$modelo = getModeloById($modelo);
			$nserie = $Reg['nserie'];
			
			$select = $select."<option value='".$idtb."'>".$modelo." - ".$nserie."</option>";
		}
	}
	$select = $select."</select>";
	return $select;
}

function getCmbClientes($idcmb, $js_function)
{
	$qry = "SELECT * FROM dbtmedia.tbclientes";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	if($js_function==null)
	{
		echo "<select name='$idcmb' id='$idcmb'>";
	}else{
		echo "<select name='$idcmb' id='$idcmb' onClick='javascript:$js_function' onChange='javascript:$js_function'>";
	}
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['idtbclientes']."'>".$Reg['nombre_cliente']."</option>";
		}
	}
	echo "</select>";
}

function getCmbModelosTerminales($idcmb, $js_function)
{
	$qry = "SELECT * FROM dbtmedia.tbmodelos";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	if($js_function==null)
	{
		echo "<select name='$idcmb' id='$idcmb'>";
	}else{
		echo "<select name='$idcmb' id='$idcmb' onClick='javascript:$js_function' onChange='javascript:$js_function'>";
	}
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['idtbmodelos']."'>".$Reg['descripcion']."</option>";
		}
	}
	echo "</select>";
}

function getCmbUsuarios($idcmb, $js_function)
{
	$qry = "SELECT * FROM dbtmedia.tbusuarios";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	if($js_function==null)
	{
		echo "<select name='$idcmb' id='$idcmb'>";
	}else{
		echo "<select name='$idcmb' id='$idcmb' onClick='javascript:$js_function' onChange='javascript:$js_function'>";
	}
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['idtbusuarios']."'>".$Reg['username']."</option>";
		}
	}
	echo "</select>";
}

function getSelectedCmbRegion($idcmb, $idx)
{
	$qry = "SELECT * FROM dbtmedia.tbregiones";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['idtbregiones']==$idx)
			{
				echo "<option value='".$Reg['idtbregiones']."' selected>".$Reg['descripcion']."</option>";
			}else{
				echo "<option value='".$Reg['idtbregiones']."'>".$Reg['descripcion']."</option>";
			}
		}
	}
	echo "</select>";
}

function getCmbContratosByCliente($idcmb, $id_cliente)
{
	$qry = "SELECT * FROM dbtmedia.tbcontratos WHERE cliente = '$id_cliente'";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['idtbcontratos']."'>".$Reg['id_contrato']."</option>";
		}
	}
	echo "</select>";
}

?>