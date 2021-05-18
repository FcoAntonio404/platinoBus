<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			trim($_POST['empleado']),
			trim($_POST['numeroBus']),
			trim($_POST['placaBus']),
			trim($_POST['asientos'])
		);
		echo $obj->agregarAutobus($datos);
}	
?>