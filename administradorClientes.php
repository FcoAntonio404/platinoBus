<?php
session_start();
if (!isset($_SESSION['usuarioNombre']) || $_SESSION['usuarioTipo'] != "1") {
	echo '<script language = javascript>
	        alert("Debe iniciar sesión para acceder a este contenido")
	        self.location = "index.php"
	      </script>';
}
require_once "modelo/conexion.php";
require_once "modelo/funciones.php";
?>

<!DOCTYPE html>
<html>

<head>
	<?php require_once "scripts.php"; ?>

	<style>
		body {
			padding-top: 50px;
			padding-left: 0px;
			padding-right: 0px;
			margin: 0px;
			margin-left: 0px;
		}

		#footer {
			background-color: rgba(83, 105, 116, 0.568);
		}

		.fc th {
			padding: 10px 0px;
			vertical-align: middle;
			background: #F2F2F2;
		}
	</style>

	<title>Clientes</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12">
				<div class="card text-center">
					<div class="row mb-2 mt-4 d-flex justify-content-around">

						<!---- Sección B ----->
						<div class="col-md-8 align-middle">
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
								<div class="col p-4 d-flex flex-column position-static">
									<h3 class="d-inline-block mb-2 text-success"><span class="fa fa-user"></span> Clientes registrados:</h3>

									<div id="tablaClientes" class="mt-3"></div>

								</div>
							</div>
						</div>
						<!---- Fin de sección B ----->
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once "footer.php"; ?>
</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tablaClientes").load("tablas/tablaClientes.php");
	});
</script>