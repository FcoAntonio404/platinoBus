<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj = new sentenciasCRUD();
	$pass = null;
	if (!empty($_POST['passEmpAct'])) $pass = trim($_POST['passEmpAct']);
	$datos = array(
		trim($_POST['id_empleado']),
		trim($_POST['terminalEmpAct']),
		trim($_POST['nombreEmpAct']),
		trim($_POST['apellidoPEmpAct']),
		trim($_POST['apellidoMEmpAct']),
		trim($_POST['direccionEmpAct']),
		trim($_POST['telefonoEmpAct']),
		trim($_POST['fechaEmpAct']),
		trim($_POST['rolEmpAct']),
		$pass
	);
	echo $obj->actualizarEmpleado($datos);
}
