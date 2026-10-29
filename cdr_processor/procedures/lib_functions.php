<?php

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/11/29

//include file config.php for connection bd
include("../cnfg/config.php");

// GET VALUES FOR MINSAL DMT REPORT
		
// TOTAL DE REGISTROS DMT
function GetTotalRecords(){
	$qry = "SELECT COUNT(name) FROM dbpolycom.tbdata WHERE name LIKE '%DMT%';";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$allItems = $result[0];

	return $allItems;
}

// INTENTOS FALLIDOS 
function GetattemptsFall(){
	$qry = "SELECT count(*) FROM dbpolycom.tbdata WHERE disconnect_info LIKE 'Fail%' AND name LIKE '%DMT%';";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$failedAttempr = $result[0];

	return $failedAttempr;
}

// PRIMER REGISTRO
function GetFirstRecords(){
	$qry = "SELECT start_date, start_time FROM dbpolycom.tbdata WHERE name LIKE '%DMT%' ORDER BY start_date ASC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$primerRegistro = $result[0]." ".$result[1];

	return $primerRegistro;
}

// ULTIMO REGISTRO
function GetLastRecords(){
	$qry = "SELECT start_date, start_time FROM dbpolycom.tbdata WHERE name LIKE '%DMT%'  ORDER BY start_date DESC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$ultimoRegistro = $result[0]." ".$result[1];

	return $ultimoRegistro;
}

function parse_date($fecha)
{
	list($month, $day, $yr) = split('-', $fecha);
	$rdate = $yr."-".$month."-".$day;

	return date($rdate);	
}

function clearDB()
{
	$qry = "TRUNCATE ".$db_name.".".$tb_name.";";
	mysql_query($qry);
}

function getDateActual() {
	$qry = "select sysdate();";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$date = $result[0];
	
	return $date;
}

function getCountAllItems() {
	$qry = "SELECT COUNT(*) FROM dbpolycom.tbdata;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$totalRegistros = $result[0];
	
	return $totalRegistros;
}

function getNameClient() {
	$qry = "SELECT upper(nombre_cliente) from dbpolycom.tbclientes order by idtbcliente desc limit 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$nameclient = $result[0];
	
	return $nameclient;
}

//MODIFIED
function getNameTtitleClient() {
	$idtbclient = getLastRecordIdClient();
	$qry = "SELECT nombre_cliente from dbpolycom.tbclientes WHERE idtbcliente = '$idtbclient'";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$nameclient = $result[0];
	
	return $nameclient;

}

function getDateFirstRecord() {
	$qry = "SELECT start_date, start_time FROM dbpolycom.tbdata ORDER BY start_date ASC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$primerRegistro = $result[0]." ".$result[1];
	
	return $primerRegistro;
}

function getDateLastRecord(){
	$qry = "SELECT start_date, start_time FROM dbpolycom.tbdata ORDER BY start_date DESC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$ultimoRegistro = $result[0]." ".$result[1];

	return $ultimoRegistro;
}

function getLastRecordFile(){
	$qry = "SELECT idtbfile FROM dbpolycom.tbfile ORDER BY idtbfile DESC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$ultimate = $result[0];

	return $ultimate;
}

function getLastRecordClient(){
	$qry = "SELECT idtbcliente FROM dbpolycom.tbclientes ORDER BY idtbcliente DESC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$ultimate = $result[0];

	return $ultimate;
}

function getLastRecordClientRuta(){
	$qry = "SELECT ruta FROM dbpolycom.tbclientes ORDER BY ruta ASC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$ultimate = $result[0];

	return $ultimate;
}
//MODIFIED
function getLastRecordIdClient(){
	$qry = "SELECT id_cliente FROM dbpolycom.tbfile ORDER BY idtbfile DESC LIMIT 1;";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$ultimate = $result[0];

	return $ultimate;
}

function getFileName(){
	$qry = "SELECT fileName FROM dbpolycom.tbfile ORDER BY idtbfile DESC LIMIT 1";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$fileName = $result[0];

	return $fileName;
}

function getFileType(){
	$qry = "SELECT fileType FROM dbpolycom.tbfile ORDER BY idtbfile DESC LIMIT 1";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$fileType = $result[0];

	return $fileType;
}

function getFileSize(){
	$qry = "SELECT fileSize FROM dbpolycom.tbfile ORDER BY idtbfile DESC LIMIT 1";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$fileSize = $result[0];

	$aux = $fileSize / 1024;
	return number_format($aux, 1, ',','')." KB";
}

function getCountItemsFile(){
	$qry = "SELECT countItems FROM dbpolycom.tbfile ORDER BY idtbfile DESC LIMIT 1";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$countItems = $result[0];

	return $countItems;
}

function getPercentEffectiveness(){
	$procesados = getCountAllItems();
	$total = getCountItemsFile();

	$porcentaje = ($procesados * 100) / $total;
	
	$aux = number_format($porcentaje, 2, ',', '');
	return $aux." %";
}

function getCountFailedAttempr(){
	$qry = "SELECT count(*) FROM dbpolycom.tbdata WHERE disconnect_info like 'Fail%'";
	$result = mysql_query($qry);
	$result = mysql_fetch_array($result);
	$countItems = $result[0];

	return $countItems;
}

?>