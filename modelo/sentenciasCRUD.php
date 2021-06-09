<?php
session_start();
class sentenciasCRUD{
	public function agregarEmpleado($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$verificacion1 = "SELECT usuario_emp FROM empleados WHERE usuario_emp = '$datos[8]'";
		$resultado = $conexion->query($verificacion1);
		$cantEmp = $resultado->num_rows;
		$verificacion2 = "SELECT usuario_cli FROM cliente WHERE usuario_cli = '$datos[8]'";
		$resultado = $conexion->query($verificacion2);
		$cantUser = $resultado->num_rows;
		if ($cantEmp == "0" && $cantUser == "0") {
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
		} else {
			return 2;
		}
	}

	public function actualizarEmpleado($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		if($datos[9] != null)
		$sql1 = "UPDATE empleados SET id_terminal = '$datos[1]',
								  				  			nombre_emp = '$datos[2]',
								  				  			apellidop_emp = '$datos[3]',
								  				  			apellidom_emp = '$datos[4]',
												  				direccion_emp = '$datos[5]',
												  				telefono_emp = '$datos[6]',
												  				fecha_ingreso_laboral = '$datos[7]',
												  				rol = '$datos[8]',
												  				contrasena_emp = '$datos[9]'
																	WHERE id_empleado = '$datos[0]'";
		else
		$sql1 = "UPDATE empleados SET id_terminal = '$datos[1]',
								  				  			nombre_emp = '$datos[2]',
								  				  			apellidop_emp = '$datos[3]',
								  				  			apellidom_emp = '$datos[4]',
												  				direccion_emp = '$datos[5]',
												  				telefono_emp = '$datos[6]',
												  				fecha_ingreso_laboral = '$datos[7]',
												  				rol = '$datos[8]'
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
			'usuarioEmp' => $mostrar[9]
		);
		return $datos;
	}

	public function login($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$user = $datos[0];
		$pass = $datos[1];
		$empleado = "SELECT * FROM empleados WHERE usuario_emp = '$user' AND contrasena_emp = '$pass'";
		$cliente = "SELECT * FROM cliente WHERE usuario_cli = '$user' AND contrasena_cli = '$pass'";
		$resultado = $conexion->query($empleado);
		$fila = $resultado->num_rows;
		if ($fila == "1") {
			$data = $resultado->fetch_array(MYSQLI_ASSOC);
			$_SESSION["usuarioID"] = $data["id_empleado"];
			$_SESSION["usuarioNombre"] = $data["nombre_emp"];
			$_SESSION["usuarioTipo"] = $data["rol"];
			if($data["rol"] == "1") header("Location: ../administradorTerminales.php");
			if($data["rol"] == "2") header("Location: ../index.php");
			if($data["rol"] == "3") header("Location: ../verificadorBoletos.php");
			if($data["rol"] == "4") header("Location: ../operadorAutobus.php");
		} else {
			$resultado = $conexion->query($cliente);
			$fila = $resultado->num_rows;
			if($fila == "1") {
				$data = $resultado->fetch_array(MYSQLI_ASSOC);
				$_SESSION["usuarioID"] = $data["id_cliente"];
				$_SESSION["usuarioNombre"] = $data["nombre_cli"];
				$_SESSION["usuarioTipo"] = 5;
				header("Location: ../index.php");
			} else {
			echo '<script language = javascript>
					alert("Usuario o contraseña incorrectos, por favor verifique")
					self.location = "../index.php"
					</script>';
			}
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
	
	public function actualizarTerminal($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		if($datos[5] != null)
		$sentenciaSQL = "UPDATE terminales SET id_empleado = '$datos[1]',
																					 nombre_ter = '$datos[2]',
																					 direccion_ter = '$datos[3]',
																					 telefono_ter = '$datos[4]', 
																					 imagen = '$datos[5]'
																					 WHERE id_terminal = '$datos[0]'";
		
		else 
		$sentenciaSQL = "UPDATE terminales SET id_empleado = '$datos[1]',
																					 nombre_ter = '$datos[2]',
																					 direccion_ter = '$datos[3]',
																					 telefono_ter = '$datos[4]'
																					 WHERE id_terminal = '$datos[0]'";
		$resultado = $conexion->query($sentenciaSQL);
		if ($resultado == true) {
			return 1;
		} else {
			return 2;
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
		$sentenciaSQL = "SELECT id_empleado, nombre_emp, apellidop_emp, apellidom_emp FROM empleados WHERE id_terminal = '$terminal' AND rol = '1' ORDER BY nombre_emp ASC";
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
		$validarEmp = "SELECT id_empleado FROM autobuses WHERE id_empleado = '$datos[0]'";
		$resultado = $conexion->query($validarEmp);
		$cant = $resultado->num_rows;
		if($cant >= "1"){
			return 3;
		} else {
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
			}
		}
	}

	public function actualizarAutobus($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sentencia1 = ""; 
		$var = "SELECT placa FROM (SELECT placa FROM autobuses WHERE id_autobus <> '$datos[0]') t WHERE placa = '$datos[2]'";
		$resultado = $conexion->query($var);
		$cant = $resultado->num_rows;
		if ($cant == "1") {
			return 2;
		} else {
			$sql = "UPDATE autobuses SET id_empleado = '$datos[1]', placa = '$datos[2]', estado = '$datos[3]'
							WHERE id_autobus = '$datos[0]'";
			return $conexion->query($sql);
		}
	}

	public function obtenerDatosAutobus($autobus){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$array = array();
		$sql = "SELECT * FROM autobuses WHERE id_autobus = '$autobus'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);
		$sentenciaOperadores = "SELECT id_empleado, nombre_emp, apellidop_emp, apellidom_emp FROM empleados 
														WHERE id_terminal = (SELECT id_terminal FROM empleados WHERE id_empleado = (SELECT id_empleado FROM autobuses WHERE id_autobus = '$autobus')) AND empleados.id_empleado NOT IN (SELECT id_empleado FROM autobuses WHERE id_autobus <> '$autobus') AND rol = '4' ORDER BY nombre_emp ASC";
		$resultado = $conexion->query($sentenciaOperadores);
		while ($aux = $resultado->fetch_object()) {
			$array[] = $aux;
		}
		$datos = array(
			'idAutobus' => $mostrar[0],
			'idEmpleado' => $mostrar[1],
			'numeroAutobus' => $mostrar[2],
			'numPlaca' => $mostrar[3],
			'asientos' => $mostrar[4],
			'estado' => $mostrar[5],
			'empleados' => $array
		);
		return $datos;
	}

	public function agregarRuta($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$var = "SELECT id_autobus FROM rutas WHERE id_autobus = '$datos[2]' AND horario = '$datos[3]'";
		$resultado = $conexion->query($var);
		$cant = $resultado->num_rows;
		if ($cant >= "1") {
			return 2;
		} else {
			$sql = "INSERT INTO rutas (id_terminal_origen, id_terminal_destino, id_autobus, horario, precio, estado)
							VALUES ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'1')";
			return $conexion->query($sql);
			//return mysqli_query($conexion,$sql);
		}
	}

	public function ocultarRuta($ruta){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "UPDATE rutas SET estado = '0' WHERE id_ruta ='$ruta';";
		$proceso = $conexion->query($sql);
		if ($proceso == true) {
			return 1;
		} else {
			return 2;
		}
	}

	public function reaparecerRuta($ruta){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "UPDATE rutas SET estado = '1' WHERE id_ruta ='$ruta';";
		$proceso = $conexion->query($sql);
		if ($proceso == true) {
			return 1;
		} else {
			return 2;
		}
	}

	/////////////////////
	public function agregarUsuario($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$verificacion1 = "SELECT usuario_emp FROM empleados WHERE usuario_emp = '$datos[5]'";
		$resultado = $conexion->query($verificacion1);
		$cantEmp = $resultado->num_rows;
		if ($cantEmp == "1") {
			return 2;
		} else {
			$verificacion2 = "SELECT usuario_cli FROM cliente WHERE usuario_cli = '$datos[5]'";
			$verificacion3 = "SELECT correo_electronico FROM cliente WHERE correo_electronico = '$datos[3]'";
			$resultado = $conexion->query($verificacion2);
			$cantUser = $resultado->num_rows;
			$resultado = $conexion->query($verificacion3);
			$cantUserCorreo = $resultado->num_rows;
			if($cantUser == "0" && $cantUserCorreo == "0"){
				$sql = "INSERT INTO cliente (nombre_cli, apellidop_cli, apellidom_cli, correo_electronico, telefono_cli, usuario_cli, contrasena_cli)
							VALUES ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]',
											'$datos[6]')";
				return $conexion->query($sql);
			} else {
				if ($cantUser == "1" && $cantUserCorreo == "0") return 2;
				if ($cantUser == "0" && $cantUserCorreo == "1") return 3;
				if ($cantUser == "1" && $cantUserCorreo == "1") return 4;
			}
		}
	}

	public function actualizarCliente($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$verificacion = "SELECT correo_electronico FROM (SELECT correo_electronico FROM cliente WHERE id_cliente <> '$datos[0]')t WHERE correo_electronico = '$datos[4]'";
		$resultado = $conexion->query($verificacion);
		$cantCorreo = $resultado->num_rows;
		if ($cantCorreo >= "1") {
			return 2;
		} else {
			if ($datos[6] != null)
			$sql1 = "UPDATE cliente SET nombre_cli = '$datos[1]',
								  				  		apellidop_cli = '$datos[2]',
								  				  		apellidom_cli = '$datos[3]',
												  			correo_electronico = '$datos[4]',
												  			telefono_cli = '$datos[5]',
												  			contrasena_cli = '$datos[6]'
																WHERE id_cliente = '$datos[0]'";
			else
			$sql1 = "UPDATE cliente SET nombre_cli = '$datos[1]',
								  				  		apellidop_cli = '$datos[2]',
								  				  		apellidom_cli = '$datos[3]',
												  			correo_electronico = '$datos[4]',
												  			telefono_cli = '$datos[5]'
																WHERE id_cliente = '$datos[0]'";

			$proceso = $conexion->query($sql1);
			if ($proceso == true) {
				return 1;
			} else {
				return 3;
			}
		}
	}

	public function eliminarCliente($cliente){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "DELETE FROM cliente WHERE id_cliente ='$cliente';";
		$proceso = $conexion->query($sql);
		if ($proceso == true) {
			session_destroy();
			return 1;
			header("Location: ../index.php");
		} else {
			return 2;
		}
	}

	public function obtenerDatosCliente($cliente){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "SELECT * FROM cliente WHERE id_cliente = '$cliente'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);

		$datos = array(
			'idCliente' => $mostrar[0],
			'nombre' => $mostrar[1],
			'apellidoP' => $mostrar[2],
			'apellidoM' => $mostrar[3],
			'correo' => $mostrar[4],
			'telefono' => $mostrar[5],
			'usuario' => $mostrar[6]
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
	}

	public function obtenerTerminalesDestinoNombres($origen){
		$obj = new conectar();
		$arrayDestinos = array();
		$arrayAutobuses = array();
		$conexion = $obj->abrirConexion();
		$sql = "SELECT id_terminal, nombre_ter FROM terminales WHERE id_terminal <> '$origen' ORDER BY ciudad_ter ASC";
		$result = $conexion->query($sql);
		while ($aux = $result->fetch_object()) {
			$arrayDestinos[] = $aux;
		}
		$sql2 = "SELECT id_autobus, numero_autobus, capacidad_asientos FROM autobuses WHERE id_empleado IN (SELECT id_empleado FROM empleados WHERE id_terminal = '$origen') AND id_autobus NOT IN (SELECT id_autobus FROM rutas) ORDER BY numero_autobus ASC";
		$resultado = $conexion->query($sql2);
		while ($aux2 = $resultado->fetch_object()) {
			$arrayAutobuses[] = $aux2;
		}
		$datos = array(
			'destinos' => $arrayDestinos,
			'autobuses' => $arrayAutobuses
		);
		return json_encode($datos);
	}

	public function obtenerOperadoresLibres($terminal){
		$obj = new conectar();
		$array = array ();
		$conexion = $obj->abrirConexion();
		$sentenciaSQL = "SELECT id_empleado, nombre_emp, apellidop_emp, apellidom_emp FROM empleados WHERE empleados.id_terminal = '$terminal' AND empleados.id_empleado NOT IN (SELECT id_empleado FROM autobuses) AND rol = 4 ORDER BY nombre_emp ASC";
		$resultado = $conexion->query($sentenciaSQL);
		while ($aux = $resultado->fetch_object()) {
			$array[] = $aux;
		}
		return json_encode($array);
	}

	public function obtenerRutas($datos){
		$obj = new conectar();
		$array = array ();
		$conexion = $obj->abrirConexion();
		$sentenciaSQL = "SELECT id_ruta, (SELECT ciudad_ter FROM terminales WHERE id_terminal = '$datos[0]')AS origen, (SELECT ciudad_ter FROM terminales WHERE id_terminal = '$datos[1]')AS destino, (SELECT imagen FROM terminales WHERE id_terminal = '$datos[1]')AS imagen, horario, precio FROM rutas WHERE id_terminal_origen = '$datos[0]' AND id_terminal_destino = '$datos[1]' AND estado = '1'";
		$resultado = $conexion->query($sentenciaSQL);
		while ($aux = $resultado->fetch_object()) {
			$array[] = $aux;
		}
		return $array;
	}

	public function obtenerDatosRuta($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$array = array();
		$sql = "SELECT id_ruta, (SELECT ciudad_ter FROM terminales WHERE id_terminal = id_terminal_origen)AS origen, (SELECT ciudad_ter FROM terminales WHERE id_terminal = id_terminal_destino)AS destino, (SELECT capacidad_asientos FROM autobuses WHERE autobuses.id_autobus = rutas.id_autobus)AS asientos, horario, precio FROM rutas WHERE id_ruta = '$datos[0]'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);
		$sentenciaSQL = "SELECT num_asiento FROM boletos WHERE id_ruta = '$datos[0]' AND fecha_salida = '$datos[1]' ORDER BY num_asiento ASC";
		$resultado = $conexion->query($sentenciaSQL);
		while ($aux = $resultado->fetch_object()) {
			$array[] = $aux;
		}
		$datos = array(
			'idRuta' => $mostrar[0],
			'origen' => $mostrar[1],
			'destino' => $mostrar[2],
			'asientosCant' => $mostrar[3],
			'horario' => $mostrar[4],
			'costo' => $mostrar[5],
			'fecha' => $datos[1],
			'asientos' => $array
		);
		return ($datos);
	}

	public function obtenerDatosTerminalOperador($empleado) {
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$array = array();
		$sentenciaSQL = "SELECT id_terminal, nombre_ter FROM terminales WHERE id_terminal <> (SELECT id_terminal FROM empleados WHERE id_empleado = '$empleado') ORDER BY nombre_ter ASC";
		$resultado = $conexion->query($sentenciaSQL);
		while ($aux = $resultado->fetch_object()) {
			$array[] = $aux;
		}
		return $array;
	}

	public function agregarTerminalLlegada($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql1 = "UPDATE empleados SET id_terminal = '$datos[1]' WHERE id_empleado = '$datos[0]'";

		$proceso = $conexion->query($sql1);
		if ($proceso == true) {
			return 1;
		} else {
			return 2;
		}
	}

	public function obtenerBoletos($datos) {
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$boletos = array();
		$sentenciaSQL = "SELECT id_boleto, (SELECT nombre_ter FROM terminales, rutas WHERE id_terminal = id_terminal_origen AND rutas.id_ruta = boletos.id_ruta)AS origen, (SELECT nombre_ter FROM terminales, rutas WHERE id_terminal = id_terminal_destino AND rutas.id_ruta = boletos.id_ruta)AS destino, folio, categoria, fecha_salida, num_asiento, fecha_expedicion, boletos.precio, boletos.estado FROM boletos, rutas WHERE id_terminal_origen = '$datos[0]' AND id_terminal_destino = '$datos[1]' AND fecha_salida = '$datos[2]'";
		$resultado = $conexion->query($sentenciaSQL);
		while ($aux = $resultado->fetch_object()) {
			$boletos[] = $aux;
		}
		return $boletos;
	}

	public function agregarBoleto($datos){
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$id_persona = $_SESSION["usuarioID"];
		$verificacion1 = "SELECT num_asiento FROM boletos WHERE id_ruta = '$datos[0]' AND fecha_salida = '$datos[1]' AND num_asiento = '$datos[2]'";
		$resultado = $conexion->query($verificacion1);
		$cantAsiento = $resultado->num_rows;
		if ($cantAsiento >= "1") {
			return 2;
		} else {
			if($_SESSION["usuarioTipo"] == "1" || $_SESSION["usuarioTipo"] == "2")
			$sql = "INSERT INTO boletos (id_ruta, id_empleado, nombre_pasajero, categoria, fecha_salida, num_asiento, precio, estado)
							VALUES ('$datos[0]',
											'$id_persona',
											'$datos[4]',
											'$datos[3]',
											'$datos[1]',
											'$datos[2]',
											'$datos[5]',
											'e')";
			if($_SESSION["usuarioTipo"] == "5")
			$sql = "INSERT INTO boletos (id_ruta, id_cliente, nombre_pasajero, fecha_salida, num_asiento, estado)
							VALUES ('$datos[0]',
											'$id_persona',
											'$datos[4]',
											'$datos[3]',
											'$datos[1]',
											'$datos[2]',
											'$datos[5]',
											'e')";		

			return $conexion->query($sql);
		}
	}

	public function obtenerDatosBoleto($boleto) {
		$obj = new conectar();
		$conexion = $obj->abrirConexion();
		$sql = "SELECT id_boleto, (SELECT nombre_ter FROM terminales,rutas WHERE id_terminal = id_terminal_origen AND boletos.id_ruta = rutas.id_ruta)AS origen, (SELECT nombre_ter FROM terminales, rutas WHERE id_terminal = id_terminal_destino AND boletos.id_ruta = rutas.id_ruta)AS destino, (SELECT horario FROM rutas WHERE rutas.id_ruta = boletos.id_ruta)AS horario, fecha_salida, num_asiento, estado FROM boletos WHERE id_boleto = '$boleto'";
		$result = $conexion->query($sql);
		$mostrar = $result->fetch_array(MYSQLI_NUM);
		$datos = array(
			'idBoleto' => $mostrar[0],
			'origen' => $mostrar[1],
			'destino' => $mostrar[2],
			'horario' => $mostrar[3],
			'fecha' => $mostrar[4],
			'asiento' => $mostrar[5],
			'estado' => $mostrar[6]
		);
		return $datos;
	}

}

