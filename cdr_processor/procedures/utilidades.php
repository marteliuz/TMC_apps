<?php
//Función auxiliar para errores (solo AJAX)
function mostrar_error($mensaje_error){
  $arr = array("error" => true, "mensaje" => $mensaje_error);
  echo json_encode($arr);
  exit();
};
?>