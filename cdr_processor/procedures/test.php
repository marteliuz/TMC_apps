<?php

	include("lib_functions.php");
	include("config.php");

    $idtbclient = getLastRecordIdClient();

        $qry = "SELECT path_logo from dbpolycom.tbclientes WHERE idtbcliente = '$idtbclient'";
        
        $result =  mysql_query($qry, $conexion);

        $fila = mysql_fetch_assoc($result);
        //$fila = mysql_fetch_array($result);
        $fila0 = mysql_fetch_assoc($result);

        echo $fila["path_logo"];

        if ($fila['path_logo'] == $fila0['path_logo']) {
            # code...
            echo "NO TENGO LOGO";
        } else {
            # code...
            echo "TENGO LOGO";
        }
        
?>