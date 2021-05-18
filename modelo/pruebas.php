<?php
   require_once("conexion.php");
   require_once("sentenciasCRUD.php");
   $obj = new sentenciasCRUD();
   echo json_encode($obj->obtenerDatosTerminal(4));

?>