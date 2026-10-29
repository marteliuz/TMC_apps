<?php

/**
 * @author Marteliuz
 * @copyright 2014
 */

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 28-11-2014

function create_log(){

    $fp = fopen("../file_storage/cdr_process.log", "w");
    $t = microtime(true);
    $micro = sprintf("%06d",($t - floor($t)) * 1000000);
    $d = Date( 'Y-m-d H:i:s.'.$micro );
    $d = (string)$d;
	$info=detect();
	
      
    fputs($fp, "Creating this log file :)"."\n");
	fputs($fp, "Sistema operativo: ".$info['os']."\n");
	fputs($fp, "Navegador: ".$info["browser"]."\n");
	fputs($fp, "Agente: ".$_SERVER['HTTP_USER_AGENT']."\n");
    fputs($fp, "Direccion IP: ".$_SERVER['REMOTE_ADDR']."\n");
	
	fputs($fp, "(❍ᴥ❍ʋ)"."\n");
    fclose($fp);
}

function log_info($message){
    $fp = fopen("../file_storage/cdr_process.log", "a");
    $t = microtime(true);
    $micro = sprintf("%06d",($t - floor($t)) * 1000000);
    $d = Date( 'Y-m-d H:i:s.'.$micro );
    $d = (string)$d;

    fputs($fp, $d." - INFO - ".$message."\n");
    fclose($fp);
}

function log_warning($message){
	$fp = fopen("../file_storage/cdr_process.log", "a");
	$t = microtime(true);
	$micro = sprintf("%06d",($t - floor($t)) * 1000000);
	$d = Date( 'Y-m-d H:i:s.'.$micro );
	$d = (string)$d;
	
	fputs($fp, $d." - WARNING - ".$message."\n");
	fclose($fp);
}

function log_error($message){
	$fp = fopen("../file_storage/cdr_process.log", "a");
	$t = microtime(true);
	$micro = sprintf("%06d",($t - floor($t)) * 1000000);
	$d = Date( 'Y-m-d H:i:s.'.$micro );
	$d = (string)$d;
	
	fputs($fp, $d." - ERROR - ".$message."\n");
	fclose($fp);
}

function detect()
{
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
	$os=array("WIN","MAC","LINUX");
	
	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";
	$info['os'] = "OTHER";
	
	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent)
	{
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s)
		{
			$info['browser'] = $parent;
			$info['version'] = $version;
		}
	}
	
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
	}
	
	# devolvemos el array de valores
	return $info;
}

?>