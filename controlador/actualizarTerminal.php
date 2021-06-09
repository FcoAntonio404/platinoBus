<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { 
	require_once "../modelo/conexion.php";
	require_once "../modelo/sentenciasCRUD.php";
	$obj = new sentenciasCRUD();
	$nombreImagen = null;
	if(!empty($_FILES['imagenAct']['name'])){
		$nombreImagen = $_FILES['imagenAct']['name'];
		$archivoImagen = $_FILES['imagenAct']['tmp_name'];
		$ruta = "../img/terminales/" . $nombreImagen;
		if (move_uploaded_file($archivoImagen, $ruta)) {
			$datos = array(
				trim($_POST['id_terminal']),
				trim($_POST['empleado']),
				trim($_POST['nombreTerAct']),
				trim($_POST['direccionTerAct']),
				trim($_POST['telefonoTerAct']),
				$nombreImagen
			);
			echo $obj->actualizarTerminal($datos);
		} else echo 3;
	} else {
		$datos=array(
			trim($_POST['id_terminal']),
			trim($_POST['empleado']),
			trim($_POST['nombreTerAct']),
			trim($_POST['direccionTerAct']),
			trim($_POST['telefonoTerAct']),
			$nombreImagen
		);
		echo $obj->actualizarTerminal($datos);
	}	
}
 ?>