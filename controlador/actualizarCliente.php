<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj = new sentenciasCRUD();
	$pass = null;
	if (!empty($_POST['passAct'])) $pass = trim($_POST['passAct']);
	$datos = array(
		trim($_POST['id_cliente']),
		trim($_POST['nombreAct']),
		trim($_POST['apellidoPAct']),
		trim($_POST['apellidoMAct']),
		trim($_POST['correoAct']),
		trim($_POST['telefonoAct']),
		$pass
	);
	echo $obj->actualizarCliente($datos);
}
