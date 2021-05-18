<?php 
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			trim($_POST['id_empleado']),
			trim($_POST['terminalEmpAct']),
			trim($_POST['nombreEmpAct']),
			trim($_POST['apellidoPEmpAct']),
			trim($_POST['apellidoMEmpAct']),
			trim($_POST['direccionEmpAct']),
			trim($_POST['telefonoEmpAct']),
			trim($_POST['fechaEmpAct']),
			trim($_POST['rolEmpAct']),
			trim($_POST['nombreUserEmpAct']),
			trim($_POST['passEmpAct'])
		);
		echo $obj->actualizarEmpleado($datos);
 ?>