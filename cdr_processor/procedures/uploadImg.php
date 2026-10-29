<?php
session_start();
//require file config.php for connection bd
require('../cnfg/config.php');
//include library lib_functions.php for extrac values
include("lib_functions.php");
//include library lib_log.php for create log
include("lib_log.php");
// create_log();
try{
	if (array_key_exists('HTTP_X_FILE_NAME', $_SERVER) && array_key_exists('CONTENT_LENGTH', $_SERVER)) {
		$fileName = $_SERVER['HTTP_X_FILE_NAME'];
		$contentLength = $_SERVER['CONTENT_LENGTH'];
		$fileType = $_SERVER['CONTENT_TYPE'];
		log_info("Subiendo imagen de logo : ".$fileName);
		log_info("Tipo: " .$fileType);
		log_info("Largo: " .$contentLength." KB");
		
	} else throw new Exception("Error retrieving headers");

	$path = $upload_img;
	
	if ($fileType != "image/png" ){
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

	$id_cliente = getLastRecordClient();
	$_SESSION['id_cliente'] = $id_cliente;
	
	$qry = "UPDATE dbpolycom.tbclientes SET path_logo='$fileName' WHERE `idtbcliente`='$id_cliente';";
	mysql_query($qry);

	
	echo "OK";
}catch (Exception $e){
	log_warning('Error capturado '.$e);
}
?>