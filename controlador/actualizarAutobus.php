<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj = new sentenciasCRUD();
		$datos=array(
			trim($_POST['id_autobus']),
			trim($_POST['empleadoAct']),
			trim($_POST['placaBusAct']),
			trim($_POST['estadoAct'])
		);
	echo $obj->actualizarAutobus($datos);
}
 ?>