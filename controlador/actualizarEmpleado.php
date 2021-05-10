<?php 
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			$_POST['id_empleado'],
			$_POST['terminalEmpAct'],
			$_POST['nombreEmpAct'],
			$_POST['apellidoPEmpAct'],
			$_POST['apellidoMEmpAct'],
			$_POST['direccionEmpAct'],
			$_POST['telefonoEmpAct'],
			$_POST['fechaEmpAct'],
			$_POST['rolEmpAct'],
			$_POST['nombreUserEmpAct'],
			$_POST['passEmpAct']
		);
		echo $obj->actualizarEmpleado($datos);
 ?>