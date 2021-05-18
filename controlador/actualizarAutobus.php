<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			trim($_POST['empleado']),
			trim($_POST['numeroBus']),
			trim($_POST['placaBus']),
			trim($_POST['asientos']),
			trim($_POST['apellidoMEmpAct']),
			trim($_POST['direccionEmpAct']),
			trim($_POST['telefonoEmpAct']),
			trim($_POST['fechaEmpAct']),
			trim($_POST['rolEmpAct']),
			trim($_POST['nombreUserEmpAct']),
			trim($_POST['passEmpAct'])
		);
	echo $obj->actualizarEmpleado($datos);
}
 ?>