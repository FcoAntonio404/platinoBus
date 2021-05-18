<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			trim($_POST['terminal']),
			trim($_POST['nombreEmp']),
			trim($_POST['apellidoPEmp']),
			trim($_POST['apellidoMEmp']),
			trim($_POST['direccionEmp']),
			trim($_POST['telefonoEmp']),
			trim($_POST['fechaEmp']),
			trim($_POST['rolEmp']),
			trim($_POST['nombreUserEmp']),
			trim($_POST['passEmp'])
		);
		echo $obj->agregarEmpleado($datos);
}	
?>