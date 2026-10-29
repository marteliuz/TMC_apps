<?php
//@autor     : Paulo Ossandon
//@date      : 2014/12/03
//@modified  : 2014/12/05

//Include file config.php - connection bd
include('../cnfg/config.php');
//Include lib_functions.php for obtain result query sql
include("lib_functions.php");
//Include lib_log.php for create log
include("lib_log.php");

try {

    if (isset($_POST['str']) && !empty($_POST['str']))
{

    //Validate
    $nombre = ($_POST["str"]);

    //Envia una consulta unica
    $res=mysql_query("SELECT idtbcliente,nombre_cliente FROM tbclientes WHERE   nombre_cliente = '".$nombre."'");
    //Pasar valor a un array
    $reg = mysql_fetch_array($res);
    //Obtener el numero de fila de un conjunto de resultados se utiliza con una sentencia SELECT - SHOW
    $count = mysql_num_rows($res);
    
        if ($count!=0) {
            
            //Obtiene ultimo registro tabla tbfile
            $idtbfile = getLastRecordFile();
            
            $idtbcliente = $reg['idtbcliente'];

            $sql= mysql_query("UPDATE tbfile SET id_cliente=$idtbcliente WHERE idtbfile=$idtbfile");

            echo "YES";

         } else {
                      
               $sql= mysql_query("INSERT INTO tbclientes (nombre_cliente) VALUES ('$nombre')");

               //Obtiene el ultimo registro - tabla tbfile
               $idtbfile = getLastRecordFile();
               //Obtiene el ultimo registro - tbclientes
               $idtbcliente = getLastRecordClient();

               $sql= mysql_query("UPDATE tbfile SET id_cliente=$idtbcliente WHERE idtbfile=$idtbfile");

               echo "NOT";

         }
     }

    
} catch (Exception $e) {
    echo $e;  
}
?>