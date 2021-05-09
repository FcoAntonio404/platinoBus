<?php 
	
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";

	$obj= new sentenciasCRUD();

	echo $obj->eliminarEmpleado($_POST['empleado']);

 ?>