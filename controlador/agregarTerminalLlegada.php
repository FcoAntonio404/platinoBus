<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj = new sentenciasCRUD();
	$datos = array(
		trim($_POST['id_empleado']),
		trim($_POST['terminal'])
	);
	echo $obj->agregarTerminalLlegada($datos);
}
