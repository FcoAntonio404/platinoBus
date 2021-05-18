<?php 
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	
	$obj = new sentenciasCRUD();

	$datos=array(
		$_POST['usuario'],
	  $_POST['passAuntenticar']
	);

	$obj->login($datos);
	
 ?>