<?php 
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj= new sentenciasCRUD();
		$datos=array(
			$_POST['terminal'],
			$_POST['nombreEmp'],
			$_POST['apellidoPEmp'],
			$_POST['apellidoMEmp'],
			$_POST['direccionEmp'],
			$_POST['telefonoEmp'],
			$_POST['fechaEmp'],
			$_POST['rolEmp'],
			$_POST['nombreUserEmp'],
			$_POST['passEmp']
		);
		echo $obj->agregarEmpleado($datos);
 ?>