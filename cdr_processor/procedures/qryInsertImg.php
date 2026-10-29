<?php
//@autor     : Paulo Ossandon
//@date      : 2014/12/03
//@modified  : 2014/12/09

//Include file config.php - connection bd
include('../cnfg/config.php');
//Include lib_functions.php for abtain result query sql
include("lib_functions.php");
//Include lib_log.php for create log
include("lib_log.php");

//start session
session_start();

$username = $_SESSION['username'];

create_log();
log_info("Sesion iniciada como: ".$username);
log_info("Here we go!");

//Carpeta que contiene img en el servidor
$ruta="imagenes";

//Se extrae img desde arreglo bidimensional
$archivo=$_FILES['imagen']['tmp_name'];

//Se extrae nombre img desde arreglo bidimensional
$nombre=$_FILES['imagen']['name'];

//Copiamos nombre y ruta a nuestro servidor
move_uploaded_file($archivo, $ruta."/".$nombre);

//Ruta actual donde esta alojada la imap_gc(imap_stream, caches)
$ruta=$ruta."/".$nombre;

echo "ruta actual ".$ruta."<br>";

//Obtiene el ultimo registro - tbclientes - 2
//$ruta2 = getLastRecordClientRuta();

//echo "ruta final ".$ruta2."<br>";

//Obtiene el ultimo registro - tbclientes - 2
$idtbcliente = getLastRecordClient();

echo "id cliente ".$idtbcliente."<br>";

$sql= mysql_query("UPDATE tbclientes SET idtbcliente=$idtbcliente, ruta='$ruta'  WHERE idtbcliente=$idtbcliente");


if ($sql) {
    # code...
    echo "YES";
    //header('Location: selectafile.php');
}else{
    echo "Error!";
}

?>
  
