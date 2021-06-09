<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			trim($_POST['nombre']),
			trim($_POST['apellidoP']),
			trim($_POST['apellidoM']),
			trim($_POST['correo']),
			trim($_POST['telefono']),
			trim($_POST['nombreUser']),
			trim($_POST['pass'])
		);
		echo $obj->agregarUsuario($datos);
}	
?>