<?php 
	
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";

	$obj= new sentenciasCRUD();

	echo json_encode($obj->obtenerDatosEmpleado($_POST['empleado']));

 ?>