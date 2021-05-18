<?php
session_start();
class sentenciasCRUD{
	public function agregarEmpleado($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$var = "SELECT usuario_emp FROM empleados WHERE usuario_emp = '$datos[8]'";
		$resultado = $conexion->query($var);
		$cant = $resultado->num_rows;
		if ($cant == "1") {
			return 2;
		} else {
			$sql = "INSERT INTO empleados (id_terminal, nombre_emp, apellidop_emp, apellidom_emp, direccion_emp, telefono_emp, fecha_ingreso_laboral, rol, usuario_emp, contrasena_emp)
							VALUES ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]',
											'$datos[6]',
											'$datos[7]',
											'$datos[8]',
											'$datos[9]')";
			return $conexion->query($sql);
			//return mysqli_query($conexion,$sql);
		}
	}

	public function actualizarEmpleado($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();

		$sql1 = "UPDATE empleados SET id_terminal = '$datos[1]',
								  				  			nombre_emp = '$datos[2]',
								  				  			apellidop_emp = '$datos[3]',
								  				  			apellidom_emp = '$datos[4]',
												  				direccion_emp = '$datos[5]',
												  				telefono_emp = '$datos[6]',
												  				fecha_ingreso_laboral = '$datos[7]',
												  				rol = '$datos[8]',
												  				usuario_emp = '$datos[9]',
												  				contrasena_emp = '$datos[10]'
																	WHERE id_empleado = '$datos[0]'";

		$proceso = $conexion->query($sql1);
		if ($proceso == true) {
			return 1;
		} else {
			return 2;
		}
	}

	public function eliminarEmpleado($empleado){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "DELETE FROM empleados WHERE id_empleado ='$empleado';";
		$proceso = $conexion->query($sql);
		if ($proceso == true) {
			return 1;
		} else {
			return 2;
		}
	}

	public function obtenerDatosEmpleado($empleado){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();

		$sql = "SELECT * FROM empleados WHERE id_empleado = '$empleado'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);

		$datos = array(
			'idEmpleado' => $mostrar[0],
			'idTerminal' => $mostrar[1],
			'nombreEmp' => $mostrar[2],
			'apellidoPEmp' => $mostrar[3],
			'apellidoMEmp' => $mostrar[4],
			'direccionEmp' => $mostrar[5],
			'telefonoEmp' => $mostrar[6],
			'fechaEmp' => $mostrar[7],
			'rolEmp' => $mostrar[8],
			'usuarioEmp' => $mostrar[9],
			'passEmp' => $mostrar[10]
		);
		return $datos;
	}

	public function login($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$user = $datos[0];
		$pass = $datos[1];
		$sql = "SELECT usuario_emp,contrasena_emp FROM empleados WHERE usuario_emp = '$user' and contrasena_emp = '$pass' ";
		$resultado = $conexion->query($sql);
		$fila = $resultado->num_rows;
		if ($fila == "1") {
			$data = $resultado->fetch_array(MYSQLI_ASSOC);
			$_SESSION["usuario"] = $data["usuario_emp"];
			header("Location: ../administradorEmpleados.php");
		} else {
			echo '<script language = javascript>
					alert("Usuario o contraseña incorrectos, por favor verifique")
					self.location = "../index.php"
					</script>';
		}
	}

	public function agregarTerminal($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sentenciaSQL = "SELECT nombre_ter FROM terminales WHERE nombre_ter = '$datos[0]'";
		$resultado = $conexion->query($sentenciaSQL);
		$cant = $resultado->num_rows;
		if ($cant == "1") {
			return 2;
		} else {
			$sql = "INSERT INTO terminales (nombre_ter, direccion_ter, ciudad_ter, estado_ter, telefono_ter, imagen)
							VALUES ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]')";
			return $conexion->query($sql);
			//return mysqli_query($conexion,$sql);
		}
	}

	public function eliminarTerminal($terminal){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "DELETE FROM terminales WHERE id_terminal ='$terminal';";
		$proceso = $conexion->query($sql);
		if ($proceso == true) {
			return 1;
		} else {
			return 2;
		}
	}

	public function obtenerDatosTerminal($terminal){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$array = array();

		$sql = "SELECT * FROM terminales WHERE id_terminal = '$terminal'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);
		$sentenciaSQL = "SELECT id_empleado, nombre_emp, apellidop_emp, apellidom_emp FROM empleados WHERE id_terminal = '$terminal' ORDER BY nombre_emp ASC";
		$resultado = $conexion->query($sentenciaSQL);
		while ($aux = $resultado->fetch_object()) {
			$array[] = $aux;
		}
		$datos = array(
			'idTerminal' => $mostrar[0],
			'idEmpleado' => $mostrar[1],
			'nombreTer' => $mostrar[2],
			'direccionTer' => $mostrar[3],
			'ciudadTer' => $mostrar[4],
			'estadoTer' => $mostrar[5],
			'telefonoTer' => $mostrar[6],
			'imagen' => $mostrar[7],
			'empleados' => $array
		);
		return $datos;
	}

	public function agregarAutobus($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$var = "SELECT numero_autobus, placa FROM autobuses WHERE numero_autobus = '$datos[1]' OR placa = '$datos[2]'";
		$resultado = $conexion->query($var);
		$cant = $resultado->num_rows;
		if ($cant >= "1") {
			return 2;
		} else {
			$sql = "INSERT INTO autobuses (id_empleado, numero_autobus, placa, capacidad_asientos, estado)
							VALUES ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'c')";
			return $conexion->query($sql);
			//return mysqli_query($conexion,$sql);
		}
	}

	public function obtenerDatosAutobus($autobus){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();

		$sql = "SELECT * FROM autobuses WHERE id_autobus = '$autobus'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);

		$datos = array(
			'idAutobus' => $mostrar[0],
			'idEmpleado' => $mostrar[1],
			'numeroAutobus' => $mostrar[2],
			'numPlaca' => $mostrar[3],
			'asientos' => $mostrar[4],
			'estado' => $mostrar[5]
		);
		return $datos;
	}

	public function obtenerTerminalesDestino($origen){
		$obj = new conectar();
		$array = array();
		$conexion = $obj->abrirConexion();

		$sql = "SELECT id_terminal, ciudad_ter FROM terminales WHERE id_terminal <> '$origen' ORDER BY ciudad_ter ASC";
		$result = $conexion->query($sql);
		while ($aux = $result->fetch_object()) {
			$array[] = $aux;
		}
		return json_encode($array);
		
		///$mostrar = $result->fetch_array(MYSQLI_NUM);

		//$datos = array(
			//'id_terminal' => $mostrar[0],
			//'ciudad_ter' => $mostrar[1]
		//);
		//return json_encode($datos);
	}

}

