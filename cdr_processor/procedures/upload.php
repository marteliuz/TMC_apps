<?php

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/11/29

//Star session
session_start();

//require file config.php for connection bd
require('../cnfg/config.php');
//include library lib_functions.php for extrac values
include("lib_functions.php");
//include library lib_log.php for create log
include("lib_log.php");

$username = $_SESSION['username'];

create_log();
log_info("Sesion iniciada como: ".$username);
log_info("Here we go!");

//control of exception
try{
	if (array_key_exists('HTTP_X_FILE_NAME', $_SERVER) && array_key_exists('CONTENT_LENGTH', $_SERVER)) {
		$fileName = $_SERVER['HTTP_X_FILE_NAME'];
		$contentLength = $_SERVER['CONTENT_LENGTH'];
		$fileType = $_SERVER['CONTENT_TYPE'];
		log_info("Subiendo archivo : ".$fileName);
		log_info("Tipo: " .$fileType);
		log_info("Largo: " .$contentLength." KB");
		
	} else throw new Exception("Error retrieving headers");

	$path = $upload_dir;
	
	if ($fileType != "application/vnd.ms-excel" ){
		log_warning("Tipo de archivo no soportado: ".$fileType);
		throw new Exception('ErrorType');
	}
	
	if (!$contentLength > 0) {
		log_warning("Tamaño de archivo invalido: ".$contentLength);
		throw new Exception('ErrorSize');
	}

	file_put_contents(
		$path . $fileName,
		file_get_contents("php://input")
	);
	log_info("Archivo cargado en: ".$path.$fileName);

	chmod($path.$fileName, 0777);
	
	// CLEAR DATA TABLE 
	
	$clearqry = "TRUNCATE ".$db_name.".".$tb_name.";";
	log_info("limpiando tabla con query '".$clearqry."'");
	mysql_query($clearqry);
	log_info("Clear complete!");
	
	// READ AND DEFINE THE VERSION OF CSV FILE
	
	define("CSV_PATH",$path);
	$csv_file = CSV_PATH . $fileName;
	
	$path_parts = pathinfo($csv_file);

	log_info("Abriendo archivo");
	$csvfile = fopen($csv_file, 'r');
	$theData = fgets($csvfile);
	$titles = explode(",", $theData);
	$i = 0;

	log_info("Archivo de ".count($titles)." campos");
	switch (count($titles)) {
	case 43:
		while (!feof($csvfile)) 
		{
			$csv_data[] = fgets($csvfile);
			$csv_array = explode(",", $csv_data[$i]);
			
			$largoLinea = count($csv_array);
			$linea = $i + 1;
			$aux = count($titles) + 1;
			if($largoLinea == count($titles) OR $aux == $largoLinea){
				$name 						= str_replace('"','',$csv_array[0]);
				$serial_number 				= str_replace('"','',$csv_array[1]);
				//fecha con formato mm-dd-yyyy
				$start_date 				= str_replace('"','',$csv_array[2]);
				$start_date 				= parse_date($start_date);
				//
				$start_time 				= str_replace('"','',$csv_array[3]);
				//fecha con formato mm-dd-yyyy
				$end_date 					= str_replace('"','',$csv_array[4]);
				$end_date					= parse_date($end_date);
				
				$end_time 					= str_replace('"','',$csv_array[5]);
				$call_duration 				= str_replace('"','',$csv_array[6]);
				$account_number 			= str_replace('"','',$csv_array[7]);
				$remote_system_name 		= str_replace('"','',$csv_array[8]);
				$call_number1 				= str_replace('"','',$csv_array[9]);
				$call_number2 				= str_replace('"','',$csv_array[10]);
				$transport_type 			= str_replace('"','',$csv_array[11]);
				$call_rate 					= str_replace('"','',$csv_array[12]);
				$system_manufacturer 		= str_replace('"','',$csv_array[13]);
				$call_direction 			= str_replace('"','',$csv_array[14]);
				$conference_id 				= str_replace('"','',$csv_array[15]);
				$call_id 					= str_replace('"','',$csv_array[16]);
				$h320_channels 				= str_replace('"','',$csv_array[17]);
				$endpoint_alias 			= str_replace('"','',$csv_array[18]);
				$endpoint_additional_alias  = str_replace('"','',$csv_array[19]);
				$endpoint_type 				= str_replace('"','',$csv_array[20]);
				$endpoint_transport_address = str_replace('"','',$csv_array[21]);
				$audio_protocol_tx 			= str_replace('"','',$csv_array[22]);
				$audio_protocol_rx 			= str_replace('"','',$csv_array[23]);
				$video_protocol_tx 			= str_replace('"','',$csv_array[24]);
				$video_protocol_rx 			= str_replace('"','',$csv_array[25]);
				$video_format_tx 			= str_replace('"','',$csv_array[26]);
				$video_format_rx 			= str_replace('"','',$csv_array[27]);
				//precedence_level no viene en esta version
				$precedence_level 			= "";
				$disconnect_info 			= str_replace('"','',$csv_array[28]);
				// disconnect_info es un campo compuesto y podria tener coma
				switch($disconnect_info){
					case "Your call could not be completed due to gatekeeper problems. Try the call again later. If the problem persists":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[29]);
						$q850_cause 				= str_replace('"','',$csv_array[30]);
						$total_h320_errors 			= str_replace('"','',$csv_array[31]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[33]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[34]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[35]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[36]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[37]);
						$max_latency_tx 			= str_replace('"','',$csv_array[38]);
						$max_latency_rx 			= str_replace('"','',$csv_array[39]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[40]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[41]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[43]);
						break;
					case "Failed Attempt;Your call could not be completed due to gatekeeper problems. Try the call again later. If the problem persists":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[29]);
						$q850_cause 				= str_replace('"','',$csv_array[30]);
						$total_h320_errors 			= str_replace('"','',$csv_array[31]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[33]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[34]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[35]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[36]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[37]);
						$max_latency_tx 			= str_replace('"','',$csv_array[38]);
						$max_latency_rx 			= str_replace('"','',$csv_array[39]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[40]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[41]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[43]);
						break;
					case "Failed Attempt;The far end system is capable of accepting the call":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[29]);
						$q850_cause 				= str_replace('"','',$csv_array[30]);
						$total_h320_errors 			= str_replace('"','',$csv_array[31]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[33]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[34]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[35]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[36]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[37]);
						$max_latency_tx 			= str_replace('"','',$csv_array[38]);
						$max_latency_rx 			= str_replace('"','',$csv_array[39]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[40]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[41]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[43]);
						break;
					case "The far end system is capable of accepting the call":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[29]);
						$q850_cause 				= str_replace('"','',$csv_array[30]);
						$total_h320_errors 			= str_replace('"','',$csv_array[31]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[33]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[34]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[35]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[36]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[37]);
						$max_latency_tx 			= str_replace('"','',$csv_array[38]);
						$max_latency_rx 			= str_replace('"','',$csv_array[39]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[40]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[41]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[43]);
						break;
					default:
						$q850_cause 				= str_replace('"','',$csv_array[29]);
						$total_h320_errors 			= str_replace('"','',$csv_array[30]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[31]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[32]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[33]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[34]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[35]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[36]);
						$max_latency_tx 			= str_replace('"','',$csv_array[37]);
						$max_latency_rx 			= str_replace('"','',$csv_array[38]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[39]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[40]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[41]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[42]);
						break;
				}
				// INSERT CSV RECORD IN MYSQL TABLE
				$query = "INSERT INTO dbpolycom.tbdata(
						name, serial_number, start_date, start_time, end_date, end_time, call_duration, account_number, remote_system_name,
						call_number1, call_number2, transport_type, call_rate, system_manufacturer, call_direction, conference_id, call_id,
						h320_channels, endpoint_alias, endpoint_additional_alias, endpoint_type, endpoint_transport_address, audio_protocol_tx,
						audio_protocol_rx, video_protocol_tx, video_protocol_rx, video_format_tx, video_format_rx, precedence_level, disconnect_info,
						q850_cause, total_h320_error, avg_percent_packet_loss_tx, avg_percent_packeT_loss_rx, avg_packets_lost_tx, avg_packets_lost_rx,
						avg_latency_tx, avg_latency_rx, max_latency_tx, max_latency_rx, avg_jitter_tx, avg_jitter_rx, max_jitter_tx, max_jitter_rx) 
						VALUES ('$name', '$serial_number', '$start_date', '$start_time', '$end_date', '$end_time', '$call_duration', '$account_number', 
						'$remote_system_name', '$call_number1', '$call_number2', '$transport_type', '$call_rate', '$system_manufacturer', '$call_direction',
						'$conference_id', '$call_id', '$h320_channels', '$endpoint_alias', '$endpoint_additional_alias', '$endpoint_type', 
						'$endpoint_transport_address', '$audio_protocol_tx', '$audio_protocol_rx', '$video_protocol_tx', '$video_protocol_rx', '$video_format_tx', 
						'$video_format_rx', '$precedence_level', '$disconnect_info', '$q850_cause', '$total_h320_errors', '$avg_percent_packet_loss_tx', 
						'$avg_percent_packet_loss_rx', '$avg_packet_loss_tx', '$avg_packet_loss_rx', '$avg_latency_tx', '$avg_latency_rx', '$max_latency_tx', 
						'$max_latency_rx', '$avg_jitter_tx', '$avg_jitter_rx', '$max_jitter_tx', '$max_jitter_rx')";
				$n=mysql_query($query, $conexion );
				$i++;
			}else{
				log_warning("No se procesará la linea ".$linea." tiene ".$largoLinea." campo(s).");
				$i++;
			}
		}
		break;
    case 44:
		// echo "procesando 44 campos";
		while (!feof($csvfile)) 
		{
			// $csv_data[] = fgets($csvfile, 1024);
			$csv_data[] = fgets($csvfile);
			$csv_array = explode(",", $csv_data[$i]);
			
			$largoLinea = count($csv_array);
			$linea = $i + 1;
			$aux = count($titles) + 1;
			
			if($largoLinea == count($titles) OR $aux == $largoLinea){
				$name 						= str_replace('"','',$csv_array[0]);
				$serial_number 				= str_replace('"','',$csv_array[1]);
				//fecha con formato mm-dd-yyyy
				$start_date 				= str_replace('"','',$csv_array[2]);
				$start_date 				= parse_date($start_date);
				//
				$start_time 				= str_replace('"','',$csv_array[3]);
				//fecha con formato mm-dd-yyyy
				$end_date 					= str_replace('"','',$csv_array[4]);
				$end_date					= parse_date($end_date);
				
				$end_time 					= str_replace('"','',$csv_array[5]);
				$call_duration 				= str_replace('"','',$csv_array[6]);
				$account_number 			= str_replace('"','',$csv_array[7]);
				$remote_system_name 		= str_replace('"','',$csv_array[8]);
				$call_number1 				= str_replace('"','',$csv_array[9]);
				$call_number2 				= str_replace('"','',$csv_array[10]);
				$transport_type 			= str_replace('"','',$csv_array[11]);
				$call_rate 					= str_replace('"','',$csv_array[12]);
				$system_manufacturer 		= str_replace('"','',$csv_array[13]);
				$call_direction 			= str_replace('"','',$csv_array[14]);
				$conference_id 				= str_replace('"','',$csv_array[15]);
				$call_id 					= str_replace('"','',$csv_array[16]);
				$h320_channels 				= str_replace('"','',$csv_array[17]);
				$endpoint_alias 			= str_replace('"','',$csv_array[18]);
				$endpoint_additional_alias  = str_replace('"','',$csv_array[19]);
				$endpoint_type 				= str_replace('"','',$csv_array[20]);
				$endpoint_transport_address = str_replace('"','',$csv_array[21]);
				$audio_protocol_tx 			= str_replace('"','',$csv_array[22]);
				$audio_protocol_rx 			= str_replace('"','',$csv_array[23]);
				$video_protocol_tx 			= str_replace('"','',$csv_array[24]);
				$video_protocol_rx 			= str_replace('"','',$csv_array[25]);
				$video_format_tx 			= str_replace('"','',$csv_array[26]);
				$video_format_rx 			= str_replace('"','',$csv_array[27]);
				//precedence_level es un campo compuesto y puede traer una coma.
				$precedence_level 			= str_replace('"','',$csv_array[28]);
				$disconnect_info 			= str_replace('"','',$csv_array[29]);
				
				switch($disconnect_info){
					case "Your call could not be completed due to gatekeeper problems. Try the call again later. If the problem persists":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[30]);
						$q850_cause 				= str_replace('"','',$csv_array[31]);
						$total_h320_errors 			= str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[33]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[34]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[35]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[36]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[37]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[38]);
						$max_latency_tx 			= str_replace('"','',$csv_array[39]);
						$max_latency_rx 			= str_replace('"','',$csv_array[40]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[41]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[43]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[44]);
						break;
					case "Failed Attempt;Your call could not be completed due to gatekeeper problems. Try the call again later. If the problem persists":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[30]);
						$q850_cause 				= str_replace('"','',$csv_array[31]);
						$total_h320_errors 			= str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[33]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[34]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[35]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[36]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[37]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[38]);
						$max_latency_tx 			= str_replace('"','',$csv_array[39]);
						$max_latency_rx 			= str_replace('"','',$csv_array[40]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[41]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[43]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[44]);
						break;
					case "Failed Attempt;The far end system is capable of accepting the call":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[30]);
						$q850_cause 				= str_replace('"','',$csv_array[31]);
						$total_h320_errors 			= str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[33]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[34]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[35]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[36]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[37]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[38]);
						$max_latency_tx 			= str_replace('"','',$csv_array[39]);
						$max_latency_rx 			= str_replace('"','',$csv_array[40]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[41]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[43]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[44]);
						break;
					case "The far end system is capable of accepting the call":
						log_warning("Fila ".$linea." capturada y corregida.");
						$disconnect_info = $disconnect_info.", ".str_replace('"','',$csv_array[30]);
						$q850_cause 				= str_replace('"','',$csv_array[31]);
						$total_h320_errors 			= str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[33]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[34]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[35]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[36]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[37]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[38]);
						$max_latency_tx 			= str_replace('"','',$csv_array[39]);
						$max_latency_rx 			= str_replace('"','',$csv_array[40]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[41]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[43]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[44]);
						break;
					default:
						$q850_cause 				= str_replace('"','',$csv_array[30]);
						$total_h320_errors 			= str_replace('"','',$csv_array[31]);
						$avg_percent_packet_loss_tx = str_replace('"','',$csv_array[32]);
						$avg_percent_packet_loss_rx = str_replace('"','',$csv_array[33]);
						$avg_packet_loss_tx 		= str_replace('"','',$csv_array[34]);
						$avg_packet_loss_rx 		= str_replace('"','',$csv_array[35]);
						$avg_latency_tx 			= str_replace('"','',$csv_array[36]);
						$avg_latency_rx 			= str_replace('"','',$csv_array[37]);
						$max_latency_tx 			= str_replace('"','',$csv_array[38]);
						$max_latency_rx 			= str_replace('"','',$csv_array[39]);
						$avg_jitter_tx 				= str_replace('"','',$csv_array[40]);
						$avg_jitter_rx 				= str_replace('"','',$csv_array[41]);
						$max_jitter_tx 				= str_replace('"','',$csv_array[42]);
						$max_jitter_rx 				= str_replace('"','',$csv_array[43]);
						break;
				
				}
				
				// INSERT CSV RECORD IN MYSQL TABLE
				$query = "INSERT INTO dbpolycom.tbdata(
						name, serial_number, start_date, start_time, end_date, end_time, call_duration, account_number, remote_system_name,
						call_number1, call_number2, transport_type, call_rate, system_manufacturer, call_direction, conference_id, call_id,
						h320_channels, endpoint_alias, endpoint_additional_alias, endpoint_type, endpoint_transport_address, audio_protocol_tx,
						audio_protocol_rx, video_protocol_tx, video_protocol_rx, video_format_tx, video_format_rx, precedence_level, disconnect_info,
						q850_cause, total_h320_error, avg_percent_packet_loss_tx, avg_percent_packeT_loss_rx, avg_packets_lost_tx, avg_packets_lost_rx,
						avg_latency_tx, avg_latency_rx, max_latency_tx, max_latency_rx, avg_jitter_tx, avg_jitter_rx, max_jitter_tx, max_jitter_rx) 
						VALUES ('$name', '$serial_number', '$start_date', '$start_time', '$end_date', '$end_time', '$call_duration', '$account_number', 
						'$remote_system_name', '$call_number1', '$call_number2', '$transport_type', '$call_rate', '$system_manufacturer', '$call_direction',
						'$conference_id', '$call_id', '$h320_channels', '$endpoint_alias', '$endpoint_additional_alias', '$endpoint_type', 
						'$endpoint_transport_address', '$audio_protocol_tx', '$audio_protocol_rx', '$video_protocol_tx', '$video_protocol_rx', '$video_format_tx', 
						'$video_format_rx', '$precedence_level', '$disconnect_info', '$q850_cause', '$total_h320_errors', '$avg_percent_packet_loss_tx', 
						'$avg_percent_packet_loss_rx', '$avg_packet_loss_tx', '$avg_packet_loss_rx', '$avg_latency_tx', '$avg_latency_rx', '$max_latency_tx', 
						'$max_latency_rx', '$avg_jitter_tx', '$avg_jitter_rx', '$max_jitter_tx', '$max_jitter_rx')";
				$n=mysql_query($query, $conexion );
				$i++;
			}else{
				log_warning("No se procesará la linea ".$linea." tiene ".$largoLinea." campo(s).");
				$i++;
			}
		}
		break;
	default:
		log_warning("No se puede procesar el largo del archivo.");
	}
	//	INSERT DATA IN TBFILE TABLE
	log_info("Se van a insertar valores en tbfile");
	$qry = "INSERT INTO dbpolycom.tbfile (fileName, fileType, fileSize, countItems, sessionUser ) VALUES ('$fileName', '$fileType', '$contentLength', '$i', '$username')";
	$n = mysql_query($qry, $conexion);
	if($n == 1){
		log_info("INSERT correcto...");
	}else{
		log_warning("INSERT fallido...");
	}
	
	log_info("Completo! cerrando archivo.");
	fclose($csvfile);
	
	$count = getCountAllItems();
	log_info("Se insertaron: ".$count." registros en tbdata.");
	echo "OK";
	
} catch (Exception $e){
    echo $e->getMessage();
	log_error($e->getMessage());
}
?>