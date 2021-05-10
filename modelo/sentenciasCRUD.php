<?php
session_start();
class sentenciasCRUD
{

	public function agregarEmpleado($datos)
	{
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

	public function actualizarEmpleado($datos)
	{
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

	public function eliminarEmpleado($empleado)
	{
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

	public function obtenerDatosEmpleado($empleado)
	{
		$obj = new conectar();
		$conexion = $obj->abrirConexion();

		$sql = "SELECT * FROM empleados where id_empleado = '$empleado';";
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

	public function login($datos)
	{
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
			header("Location: ../administrador.php");
		} else {
			echo '<script language = javascript>
					alert("Usuario o contraseña incorrectos, por favor verifique")
					self.location = "../index.php"
					</script>';
		}
	}
}
