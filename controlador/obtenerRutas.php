<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { 
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
	$datos = array(
		trim($_POST['terminalOrigen']),
		trim($_POST['terminalDestino']),
		trim($_POST['fecha'])
	);
	echo json_encode($obj->obtenerRutas($datos));
}
 ?>