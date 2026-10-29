<?php
require("config.php");

function getNow()
{
	return date("Y-m-d H:i:s");	
}

function dateConvertShow($date)
{
	//from = yyyy-mm-dd
	//to   = dd-mm-yyyy
	
	$str = explode('-', $date);
	
	if(strlen($str[0])==4)
	{
		$day   = $str[2];
		$month = $str[1];
		$year  = $str[0];
	
		$str = $day."-".$month."-".$year;
		return $str;
	}else{
		return $date;
	}
}

function dateConvertSQL($date)
{
	//from = dd-mm-yyyy
	//to   = yyyy-mm-dd
	
	$str = explode('-', $date);
	
	if(strlen($str[0])==2)
	{
		$day   = $str[0];
		$month = $str[1];
		$year  = $str[2];
	
		$str = $year."-".$month."-".$day;
		return $str;
	}else{
		return $date;
	}
}

function getNewIDContrato($last_insert)
{
	// $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	// for($i=0; $i<10; $i++){
		// $var = $var.$str[mt_rand(0,34)];
	// }
	// $id_contrato = $var."-".$last_insert;
	
	$qry    = "SELECT * FROM dbtmedia.tbcontratos WHERE idtbcontratos = '$last_insert'";
	$result = mysql_query($qry);
	$Reg    = mysql_fetch_array($result);
	$id_cliente = $Reg['cliente'];
	$sigla_cliente = $Reg['sigla_cliente'];
	$sigla_cliente_final = $Reg['sigla_cliente_final'];
	
	$id_contrato = "TMC-".$sigla_cliente."-".$sigla_cliente_final;
	
	$qry    = "SELECT COUNT(*) AS count FROM dbtmedia.tbcontratos WHERE sigla_cliente = '$sigla_cliente' AND sigla_cliente_final = '$sigla_cliente_final'";
	$result = mysql_query($qry);
	$Reg    = mysql_fetch_array($result);
	$count  = $Reg['count'];
	$id_contrato = $id_contrato."-".$count;
	
	$qry = "UPDATE dbtmedia.tbcontratos SET id_contrato = '$id_contrato' WHERE idtbcontratos = '$last_insert'";
	mysql_query($qry);
	return $id_contrato;
}
// se reemplaza por semáforo
// function getProxVencimientosContratosClientes()
// {
	// try{
		// $qry    = "SELECT COUNT(*) FROM dbtmedia.tbcontratos WHERE DATEDIFF(fecha_termino, NOW()) < 60";
		// $result = mysql_query($qry);
		// $Reg    = mysql_fetch_array($result);
		// $var    = $Reg[0];
		// return $var;
	// }catch(Exception $ex){
		// echo "Error capturado en getProxVencimientosContratosClientes | ".$ex->getMessage();
		// return 0;
	// }
// }

function getContratosClientesVencidos()
{
	try{
		$qry    = "SELECT COUNT(*) FROM dbtmedia.tbcontratos WHERE DATEDIFF(fecha_termino, NOW()) <= 0";
		$result = mysql_query($qry);
		$Reg    = mysql_fetch_array($result);
		$var    = $Reg[0];
		return $var;
	}catch(Exception $ex){
		echo "Error capturado en getContratosClientesVencidos | ".$ex->getMessage();
		return 0;
	}
}

function getContratosClientesPorVencer()
{
	try{
		$qry    = "SELECT COUNT(*) FROM dbtmedia.tbcontratos WHERE DATEDIFF(fecha_termino, NOW()) <= 45";
		$result = mysql_query($qry);
		$Reg    = mysql_fetch_array($result);
		$var    = $Reg[0];
		return $var;
	}catch(Exception $ex){
		echo "Error capturado en getContratosClientesPorVencidos | ".$ex->getMessage();
		return 0;
	}
}

function getContratosClientesNoVencidos()
{
	try{
		$qry    = "SELECT COUNT(*) FROM dbtmedia.tbcontratos WHERE DATEDIFF(fecha_termino, NOW()) > 45";
		$result = mysql_query($qry);
		$Reg    = mysql_fetch_array($result);
		$var    = $Reg[0];
		return $var;
	}catch(Exception $ex){
		echo "Error capturado en getContratosClientesNoVencidos | ".$ex->getMessage();
		return 0;
	}
}

// se reemplaza por semáforo
// function getProxVencimientosContratosPolycom()
// {
	// try{
		// $qry    = "SELECT COUNT(*) FROM dbtmedia.tbcontratos_polycom WHERE DATEDIFF(fecha_termino, NOW()) < 60";
		// $result = mysql_query($qry);
		// $Reg    = mysql_fetch_array($result);
		// $var    = $Reg[0];
		// return $var;
	// }catch(Exception $ex){
		// echo "Error capturado en getProxVencimientosContratosPolycom | ".$ex->getMessage();
		// return 0;
	// }
// }

function getContratosPolycomVencidos()
{
	try{
		$qry = "SELECT 	
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,
		t1.fecha_inicio,
		t1.fecha_termino,
		t1.descripcion AS descripcion_contrato,
		DATEDIFF(t1.fecha_termino, NOW()) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		DATEDIFF(t1.fecha_termino, NOW()) <= 0";
		$result   = mysql_query($qry);
		$num_rows = mysql_num_rows($result);
		return $num_rows;
	}catch(Exception $ex){
		echo "Error capturado en getContratosPolycomVencidos | ".$ex->getMessage();
		return 0;
	}
}

function getContratosPolycomPorVencer()
{
	try{
		$qry = "SELECT 	
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,
		t1.fecha_inicio,
		t1.fecha_termino,
		t1.descripcion AS descripcion_contrato,
		DATEDIFF(t1.fecha_termino, NOW()) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		DATEDIFF(t1.fecha_termino, NOW()) <= 45 AND DATEDIFF(t1.fecha_termino, NOW()) > 0";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
		return $num_rows;
	}catch(Exception $ex){
		echo "Error capturado en getContratosPolycomPorVencer | ".$ex->getMessage();
		return 0;
	}
}

function getContratosPolycomNoVencidos()
{
	try{
		$qry = "SELECT 	
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,
		t1.fecha_inicio,
		t1.fecha_termino,
		t1.descripcion AS descripcion_contrato,
		DATEDIFF(t1.fecha_termino, NOW()) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		DATEDIFF(t1.fecha_termino, NOW()) > 45";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
		return $num_rows;
	}catch(Exception $ex){
		echo "Error capturado en getContratosPolycomNoVencidos | ".$ex->getMessage();
		return 0;
	}
}

// se reemplaza por semáforo
// function getProxVencimientosClientePolycom()
// {
	// try{
		// $qry = "SELECT
		// t1.id_terminal,
		// t2.nserie,
		// t3.descripcion AS modelo,
		// t4.nombre_cliente,	
		// t5.fecha_termino AS f_c,
		// t1.fecha_termino AS f_po,
		// t6.descripcion AS tipo_contrato,
		// DATEDIFF(t1.fecha_termino, t5.fecha_termino) AS vencimiento
// FROM dbtmedia.tbcontratos_polycom AS t1,
	 // dbtmedia.tbterminales        AS t2,
	 // dbtmedia.tbmodelos           AS t3,
	 // dbtmedia.tbclientes          AS t4,
	 // dbtmedia.tbcontratos         AS t5,
	 // dbtmedia.tbtipocontratos 	  AS t6
// WHERE 	t1.id_terminal = t2.idtbterminales AND
		// t2.modelo = t3.idtbmodelos AND
		// t2.cliente = t4.idtbclientes AND
		// t5.tipo_contrato = t6.idtbtipocontratos AND
		// t2.contrato_polycom = t1.idtbcontratos_polycom AND
		// t2.contrato = t5.idtbcontratos AND
		// DATEDIFF(t1.fecha_termino, t5.fecha_termino) < 0";
		
		// $result   = mysql_query($qry);
	
		// $num_rows = mysql_num_rows($result);
		
		// return $num_rows;
		
	// }catch(Exception $ex){
		// echo "Error capturado en getProxVencimientosContratosClientes | ".$ex->getMessage();
		// return 0;
	// }
// }

function getClientePolycomVencidos()
{
	try{
		$qry = "SELECT
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,	
		t5.fecha_termino AS f_c,
		t1.fecha_termino AS f_po,
		t6.descripcion AS tipo_contrato,
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4,
	 dbtmedia.tbcontratos         AS t5,
	 dbtmedia.tbtipocontratos 	  AS t6
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		t5.tipo_contrato = t6.idtbtipocontratos AND
		t2.contrato_polycom = t1.idtbcontratos_polycom AND
		t2.contrato = t5.idtbcontratos AND
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) <= 0";
		
		$result   = mysql_query($qry);
	
		$num_rows = mysql_num_rows($result);
		
		return $num_rows;
		
	}catch(Exception $ex){
		echo "Error capturado en getClientePolycomVencidos | ".$ex->getMessage();
		return 0;
	}
}

function getClientePolycomPorVencer()
{
	try{
		$qry = "SELECT
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,	
		t5.fecha_termino AS f_c,
		t1.fecha_termino AS f_po,
		t6.descripcion AS tipo_contrato,
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4,
	 dbtmedia.tbcontratos         AS t5,
	 dbtmedia.tbtipocontratos 	  AS t6
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		t5.tipo_contrato = t6.idtbtipocontratos AND
		t2.contrato_polycom = t1.idtbcontratos_polycom AND
		t2.contrato = t5.idtbcontratos AND
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) <= 45 AND DATEDIFF(t1.fecha_termino, t5.fecha_termino) > 0 ";
		
		$result   = mysql_query($qry);
	
		$num_rows = mysql_num_rows($result);
		
		return $num_rows;
		
	}catch(Exception $ex){
		echo "Error capturado en getClientePolycomPorVencer | ".$ex->getMessage();
		return 0;
	}
}

function getClientePolycomNoVencidos()
{
	try{
		$qry = "SELECT
		t1.id_terminal,
		t2.nserie,
		t3.descripcion AS modelo,
		t4.nombre_cliente,	
		t5.fecha_termino AS f_c,
		t1.fecha_termino AS f_po,
		t6.descripcion AS tipo_contrato,
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) AS vencimiento
FROM dbtmedia.tbcontratos_polycom AS t1,
	 dbtmedia.tbterminales        AS t2,
	 dbtmedia.tbmodelos           AS t3,
	 dbtmedia.tbclientes          AS t4,
	 dbtmedia.tbcontratos         AS t5,
	 dbtmedia.tbtipocontratos 	  AS t6
WHERE 	t1.id_terminal = t2.idtbterminales AND
		t2.modelo = t3.idtbmodelos AND
		t2.cliente = t4.idtbclientes AND
		t5.tipo_contrato = t6.idtbtipocontratos AND
		t2.contrato_polycom = t1.idtbcontratos_polycom AND
		t2.contrato = t5.idtbcontratos AND
		DATEDIFF(t1.fecha_termino, t5.fecha_termino) > 45";
		
		$result   = mysql_query($qry);
	
		$num_rows = mysql_num_rows($result);
		
		return $num_rows;
		
	}catch(Exception $ex){
		echo "Error capturado en getClientePolycomNoVencidos | ".$ex->getMessage();
		return 0;
	}
}

// TIckets Functions
function getNewIDTicket($last_insert)
{
	//$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	//for($i=0; $i<6; $i++){
	//	$var = $var.$str[mt_rand(0,34)];
	//}
	//$id_ticket = $var."-".$last_insert;
	//** MODIFICACION SOLICITADA 2013/08/23
	// EL ID DEL TICKET DEBE COMENZAR CON LAS SIGLAS "TMC-INC"
	//
	
	$var = "TMC-INC";
	$id_ticket = $var.$last_insert;
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

function getContratoIdById($id)
{
	try{
		if($id!=""){
			$qry = "SELECT id_contrato FROM dbtmedia.tbcontratos WHERE idtbcontratos = $id";
			$result = mysql_query($qry);
			$num_rows = mysql_num_rows($result);
			if($num_rows!=0){
				$Reg = mysql_fetch_array($result);
				$var = $Reg['id_contrato'];
				return $var;
			}else{
				return "N/A 1";
			}
		}else{
			return "N/A 2";
		}
	}catch(Exception $ex){
		echo "Error capturado en getContratoIdById | ".$ex->getMessage();
		return "error";
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

function getCmbRegionesJS($idcmb, $js_function)
{
	$qry = "SELECT * FROM dbtmedia.tbregiones";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name=$idcmb' id='$idcmb' onClick='javascript:$js_function' onChange='javascript:$js_function'>";
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

function getCmbterminalesWithoutIdCliente($idcmb, $js_function, $id_clientes)
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
		if($Reg['idtbclientes']==$id_clientes)
			{
				echo "<option value='".$Reg['idtbclientes']."' selected>".$Reg['nombre_cliente']."</option>";
			}else{
			echo "<option value='".$Reg['idtbclientes']."'>".$Reg['nombre_cliente']."</option>";
			}
		}
	}
	echo "</select>";
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
//función agregada
function getCmbTerminalesHuerfanos($idcmb, $js_function)
{
	$qry = "SELECT * FROM dbtmedia.tbterminales WHERE contrato is NULL OR cliente is NULL";
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

function getCmbModelosTerminales1($idcmb, $js_function, $idx)
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
			if($Reg['idtbmodelos']==$idx)
			{
				echo "<option value='".$Reg['idtbmodelos']."' selected>".$Reg['descripcion']."</option>";
			}else{
				echo "<option value='".$Reg['idtbmodelos']."'>".$Reg['descripcion']."</option>";
			}
		}
	}
	echo "</select>";
}

function getCmbClientesTerminales($idcmb, $js_function, $idx)
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
			if($Reg['idtbclientes']==$idx)
			{
				echo "<option value='".$Reg['idtbclientes']."' selected>".$Reg['nombre_cliente']."</option>";
			}else{
				echo "<option value='".$Reg['idtbclientes']."'>".$Reg['nombre_cliente']."</option>";
			}
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

function getSelectedCmbCiudades($idcmb, $idx)
{
	$qry = "SELECT * FROM dbtmedia.tbcomunas";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['id']==$idx)
			{
				echo "<option value='".$Reg['id']."' selected>".$Reg['nombre']."</option>";
			}else{
				echo "<option value='".$Reg['id']."'>".$Reg['nombre']."</option>";
			}
		}
	}
	echo "</select>";

}

function getSelectedCmbClientes($idcmb, $idx)
{
	$qry = "SELECT * FROM dbtmedia.tbclientes";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb' onClick='javascript:getSiglaByCliente()' onChange='javascript:getSiglaByCliente()'>"; 
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['idtbclientes']==$idx)
			{
				echo "<option value='".$Reg['idtbclientes']."' selected>".$Reg['nombre_cliente']."</option>";
			}else{
				echo "<option value='".$Reg['idtbclientes']."'>".$Reg['nombre_cliente']."</option>";
			}
		}
	}
	echo "</select>";

}

function getSelectedCmbTipoContratos($idcmb, $idx, $function)
{
	$qry = "SELECT * FROM dbtmedia.tbtipocontratos";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$idcmb' id='$idcmb' onClick='javascript:".$function."' onChange='javascript:".$function."'>"; 
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['idtbtipocontratos']==$idx)
			{
				echo "<option value='".$Reg['idtbtipocontratos']."' selected>".$Reg['descripcion']."</option>";
			}else{
				echo "<option value='".$Reg['idtbtipocontratos']."'>".$Reg['descripcion']."</option>";
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

function getCmbContratosByCliente1($idcmb, $id_cliente)
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
			if($Reg['cliente']==$id_cliente)
			{
				echo "<option value='".$Reg['idtbcontratos']."' selected>".$Reg['id_contrato']."</option>";
			}else{
				echo "<option value='".$Reg['idtbcontratos']."'>".$Reg['id_contrato']."</option>";
			}
		}
	}
	echo "</select>";

}


function getCmbComunasByCmbRegiones($id_region, $idcmb)
{
	$qry = "SELECT * FROM dbtmedia.tbcomunas WHERE region_id = '$id_region'";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	echo "<select name='$idcmb' id='$idcmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			echo "<option value='".$Reg['id']."'>".$Reg['nombre']."</option>";
		}
	}
	echo "</select>";
}

function getCuidadNameByID($ciudad_id)
{
	$qry = "SELECT * FROM dbtmedia.tbcomunas WHERE id = '$ciudad_id'";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	if($cont==0)
	{
		echo "Null";
	}else{
		echo $Reg['nombre'];
	}
}

function getTipoContratoById($id_contrato)
{
	$qry = "SELECT * FROM dbtmedia.tbtipocontratos WHERE idtbtipocontratos = '$id_contrato'";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	if($cont==0)
	{
		echo "Null";
	}else{
		$Reg = mysql_fetch_array($result);
		echo $Reg['descripcion'];
	}
}
?>