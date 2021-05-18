<?php 

	class conectar
	{
		private static $conexion;

		public static function abrirConexion()
		{
			
			$puerto = 'localhost';
			$dbname = 'platinobus';
			$username = 'root';
			$password = '';
			$conexion = new mysqli($puerto,$username,$password,$dbname);
			if($conexion->connect_errno){
				echo "Fallo al conectar a MySQL: (".$conexion->connect_errno .")";
				exit();
			}
			$conexion->set_charset("utf8");
			return $conexion;
			
		}
		public static function cerrarConexion()
		{
			
				//$Cone = pg_close($conexion);
				//return $Cone;
			
		}
	}
