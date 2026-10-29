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

    //Ultimo registro tabla tbfile
    $idtbclient = getLastRecordIdClient();

    //echo $idtbclient;
    
    //Envia una consulta unica
    $res=mysql_query("SELECT nombre_cliente FROM tbclientes WHERE idtbcliente = '".$idtbclient."'");
    //Pasar valor a un array
    $reg = mysql_fetch_array($res);
    
    //Print array
    //print_r($reg[0]);

    $reg10 = '%MINSAL%';

    //Envia una consulta unica
    $res1 = mysql_query("SELECT * FROM tbclientes WHERE nombre_cliente LIKE  '".$reg10."'");

    //Pasar valor a un array asociativo
    $reg0 = mysql_fetch_assoc($res1);
    
    //Print array
    //print_r($reg0['nombre_cliente']);

    if($reg[0] == $reg0['nombre_cliente']) 
    {
      echo "10";

        } else {

          echo "20";
    }

} catch (Exception $e) {
    echo $e;  
}
?>