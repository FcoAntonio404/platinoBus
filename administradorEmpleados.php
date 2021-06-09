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

	<title>Empleados</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12 pr-0">
				<div class="card text-center">
					<div class="row mb-2 mt-4">
						<!---- Sección A ----->
						<div class="col-md-5">
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
								<div class="col p-4 d-flex flex-column position-static">
									<h3 class="d-inline-block mb-2 text-primary"><span class="fa fa-user-plus"></span> Registrar empleados:</h3>

									<!---- Formulario Registro de empleados ----->
									<form id="frmAlta" enctype="multipart/form-data">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<label class="input-group-text" for="inputGroupSelect01">Terminal</label>
														</div>
														<select class="custom-select" id="terminal" name="terminal">
															<option selected>Elija</option>
															<?php
															$terminales = getTerminales();
															foreach ($terminales as $key => $terminal) :
															?>
																<option value="<?php echo $terminal->id_terminal; ?>"> <?php echo $terminal->nombre_ter; ?> </option>
															<?php
															endforeach;
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="nombreEmp" name="nombreEmp" class="form-control" placeholder="Nombre(s)" aria-label="Username" aria-describedby="addon-wrapping">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="apellidoPEmp" name="apellidoPEmp" class="form-control" placeholder="Ap. Paterno" aria-label="Username" aria-describedby="addon-wrapping">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="apellidoMEmp" name="apellidoMEmp" class="form-control" placeholder="Ap. Materno" aria-label="Username" aria-describedby="addon-wrapping">
													</div>
												</div>
											</div>
											<div class="input-group flex-nowrap mt-2 mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="addon-wrapping"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												</div>
												<input type="text" id="direccionEmp" name="direccionEmp" class="form-control" placeholder="Direcci&oacute;n" aria-label="Username" aria-describedby="addon-wrapping">
											</div>
											<div class="input-group flex-nowrap mt-3 mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="addon-wrapping"><i class="fa fa-phone" aria-hidden="true"></i></span>
												</div>
												<input type="text" id="telefonoEmp" name="telefonoEmp" class="form-control" placeholder="Tel&eacute;fono celular" aria-label="Username" aria-describedby="addon-wrapping">
											</div>
											<div class="input-group flex-nowrap mt-3 mb-3">
												<div class="input-group-prepend">
													<label class="input-group-text" for="inputGroupSelect01">Fecha de inicio laboral:</label>
												</div>
												<input type="date" id="fechaEmp" name="fechaEmp" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="">
											</div>
											<div class="input-group flex-nowrap mt-1 mb-1">
												<div class="input-group-prepend">
													<label class="input-group-text" for="inputGroupSelect01">Rol:</label>
												</div>
												<select class="custom-select" id="rolEmp" name="rolEmp">
													<option selected>Elija</option>
													<option value="1">Administrador</option>
													<option value="2">Emp. ventas</option>
													<option value="3">Emp. verificador</option>
													<option value="4">Emp. operador</option>
												</select>
											</div>
											<div class="input-group flex-nowrap  mt-3 mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
												<input type="text" id="nombreUserEmp" name="nombreUserEmp" class="form-control" placeholder="Nombre de usuario" aria-label="Username" aria-describedby="addon-wrapping">
											</div>
											<div class="input-group flex-nowrap  mt-3 mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
												</div>
												<input type="password" id="passEmp" name="passEmp" class="form-control" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping">
											</div>
											<input type="submit" id="submit" name="submit" value="Agregar" class="btn btn-primary">
											<input type="reset" value="Limpiar" class="btn btn-danger">
										</div>
									</form>
								</div>
							</div>
						</div>
						<!---- Fin de sección A ----->
						<!---- Sección B ----->
						<div class="col-md-7">
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
								<div class="col p-4 d-flex flex-column position-static">
									<h3 class="d-inline-block mb-2 text-success"><span class="fa fa-users"></span> Empleados registrados:</h3>

									<div id="tablaDatatable" class="mt-3"></div>

								</div>
							</div>
						</div>
						<!---- Fin de sección B ----->
					</div>

					<!-- Modal Editar -->
					<div class="modal fade" id="modalEditarEmp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-pencil"></span> Editar empleado:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form id="frmEditarEmp" enctype="multipart/form-data">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group flex-nowrap mt-2 mb-2">
															<div class="input-group-prepend">
																<label class="input-group-text" for="inputGroupSelect01">Terminal</label>
															</div>
															<input type="text" id="id_empleado" name="id_empleado" class="form-control" value="" style="display:none;">
															<select class="custom-select" id="terminalEmpAct" name="terminalEmpAct">
																<option selected>Elija</option>
																<?php
																$terminales = getTerminales();
																foreach ($terminales as $key => $terminal) :
																?>
																<option value="<?php echo $terminal->id_terminal; ?>"> <?php echo $terminal->nombre_ter; ?> </option>
																<?php
																endforeach;
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="input-group flex-nowrap mt-2 mb-2">
															<div class="input-group-prepend">
																<span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
															</div>
															<input type="text" id="nombreEmpAct" name="nombreEmpAct" class="form-control" placeholder="Nombre(s)" aria-label="Username" aria-describedby="addon-wrapping">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="input-group flex-nowrap mt-2 mb-2">
															<div class="input-group-prepend">
																<span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
															</div>
															<input type="text" id="apellidoPEmpAct" name="apellidoPEmpAct" class="form-control" placeholder="Ap. Paterno" aria-label="Username" aria-describedby="addon-wrapping">
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group flex-nowrap mt-2 mb-2">
															<div class="input-group-prepend">
																<span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
															</div>
															<input type="text" id="apellidoMEmpAct" name="apellidoMEmpAct" class="form-control" placeholder="Ap. Materno" aria-label="Username" aria-describedby="addon-wrapping">
														</div>
													</div>
												</div>
												<div class="input-group flex-nowrap mt-2 mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="addon-wrapping"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
													</div>
													<input type="text" id="direccionEmpAct" name="direccionEmpAct" class="form-control" placeholder="Direcci&oacute;n" aria-label="Username" aria-describedby="addon-wrapping">
												</div>
												<div class="input-group flex-nowrap mt-3 mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="addon-wrapping"><i class="fa fa-phone" aria-hidden="true"></i></span>
													</div>
													<input type="text" id="telefonoEmpAct" name="telefonoEmpAct" class="form-control" placeholder="Tel&eacute;fono celular" aria-label="Username" aria-describedby="addon-wrapping">
												</div>
												<div class="input-group flex-nowrap mt-3 mb-3">
													<div class="input-group-prepend">
														<label class="input-group-text" for="inputGroupSelect01">Fecha de inicio laboral:</label>
													</div>
													<input type="date" id="fechaEmpAct" name="fechaEmpAct" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="">
												</div>
												<div class="input-group flex-nowrap mt-1 mb-1">
													<div class="input-group-prepend">
														<label class="input-group-text" for="inputGroupSelect01">Rol:</label>
													</div>
													<select class="custom-select" id="rolEmpAct" name="rolEmpAct">
														<option selected>Elija</option>
														<option value="1">Administrador</option>
														<option value="2">Emp. ventas</option>
														<option value="3">Emp. verificador</option>
														<option value="4">Emp. operador</option>
													</select>
												</div>
												<div class="input-group flex-nowrap  mt-3 mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="addon-wrapping"><i class="fa fa-user" aria-hidden="true"></i></span>
													</div>
													<input type="text" id="nombreUserEmpAct" name="nombreUserEmpAct" class="form-control" placeholder="Nombre de usuario" aria-label="Username" aria-describedby="addon-wrapping" readonly>
												</div>
												<div class="input-group flex-nowrap  mt-3 mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="addon-wrapping"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
													</div>
													<input type="password" id="passEmpAct" name="passEmpAct" class="form-control" placeholder="Nueva contraseña" aria-label="Username" aria-describedby="addon-wrapping">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="submit" id="submit" name="submit" class="btn btn-primary">Guardar cambios</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Fin de modal -->
				</div>
			</div>
		</div>
	</div>
	<?php require_once "footer.php"; ?>
</body>

</html>
<script src="js/validaciones.js"></script>
<script src="js/administradorEmpleados.js"></script>