<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj = new sentenciasCRUD();
	$nombreImagen = $_FILES['imagen']['name'];
	$archivoImagen = $_FILES['imagen']['tmp_name'];
	$ruta = "../img/terminales/" . $nombreImagen;
	if (move_uploaded_file($archivoImagen, $ruta)) {
		$datos = array(
			trim($_POST['nombreTer']),
			trim($_POST['direccionTer']),
			trim($_POST['ciudadTer']),
			trim($_POST['estadoTer']),
			trim($_POST['telefonoTer']),
			$nombreImagen
		);
		echo $obj->agregarTerminal($datos);
	}else echo 3;
}
