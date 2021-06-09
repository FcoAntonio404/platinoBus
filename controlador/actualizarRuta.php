<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
            trim($_POST['id_ruta']),
			trim($_POST['id_terminal_origen']),
			trim($_POST['id_terminal_destino']),
			trim($_POST['id_autobus']),
			trim($_POST['horario']),
			trim($_POST['precio']),
		);
	//echo $obj->actualizarRuta($datos);
}
 ?>