<?php
require_once "modelo/sentenciasCRUD.php";
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

	<title>Administrador</title>
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
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
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
															<option value="3">Orizaba</option>
															<option value="4">Córdoba</option>
															<option value="5">Xalapa</option>
															<option value="6">Verarcruz</option>
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
													<span class="input-group-text" id="addon-wrapping"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
												<input type="text" id="nombreUserEmp" name="nombreUserEmp" class="form-control" placeholder="Nombre de usuario" aria-label="Username" aria-describedby="addon-wrapping">
											</div>
											<div class="input-group flex-nowrap  mt-3 mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="addon-wrapping"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
												</div>
												<input type="password" id="passEmp" name="passEmp" class="form-control" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping">
											</div>

											<div class="row">
												<div class="col-md-12 mb-3">
													<div class="alert alert-success " role="alert" id="OK" style="display:none;">
														<label> Renovará periodo vacacional cada: <strong id="Next1"></strong>;
															del cual, deberá tomar las vacaciones en un plazo no mayor a 18 meses.
															<span> </span>
														</label>
													</div>
												</div>
											</div>
											<br>
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
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
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
																<option value="3">Orizaba</option>
																<option value="4">Córdoba</option>
																<option value="5">Xalapa</option>
																<option value="6">Verarcruz</option>
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
													<input type="password" id="passEmpAct" name="passEmpAct" class="form-control" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping" readonly>
												</div>

												<div class="row">
													<div class="col-md-12 mb-3">
														<div class="alert alert-success " role="alert" id="OK" style="display:none;">
															<label> Renovará periodo vacacional cada: <strong id="Next1"></strong>;
																del cual, deberá tomar las vacaciones en un plazo no mayor a 18 meses.
																<span> </span>
															</label>
														</div>
													</div>
												</div>
												<br>


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

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tablas/tabla.php');
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#frmAlta').submit(function(event) {
			event.preventDefault();
			var terminal = $('#terminal').val();
			var nombreEmp = $('#nombreEmp').val();
			var apellidoPEmp = $('#apellidoPEmp').val();
			var apellidoMEmp = $('#apellidoMEmp').val();
			var direccionEmp = $('#direccionEmp').val();
			var telefonoEmp = $('#telefonoEmp').val();
			$('#fechaEmp').on("change", function() {
				this.setAttribute(
					"data-date",
					moment(this.value, "YYYY-MM-DD")
					.format(this.getAttribute("data-date-format"))
				)
			}).trigger("change");
			var fechaEmp = $('#fechaEmp').val();
			var rolEmp = $('#rolEmp').val();
			var usuarioEmp = $('#nombreUserEmp').val();
			var passEmp = $('#passEmp').val();
			if (terminal == '' || nombreEmp == '' || apellidoPEmp == '' || apellidoMEmp == '' || direccionEmp == '' || telefonoEmp == '' || fechaEmp == '' || rolEmp == '' || usuarioEmp == '' || passEmp == '') {
				alertify.warning("Por favor ingrese todos los datos solicitados");
				return false;
			} else {
				$.ajax({
					url: "controlador/agregarEmpleado.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					success: function(r) {
						if (r != false && r != 2 && r == 1) {
							//$('#OK').hide();
							$('#frmAlta')[0].reset();
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.success("El registro se realizó con exito");
						} else if (r == 2) {
							alertify.error("¡ERROR!, Nombre de usuario ya existe");

						} else {
							alertify.error("Fallo al realizar el registro, verifique los datos");
						}
					}
				});
			}
			return false;
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#frmEditarEmp').submit(function(event) {
			event.preventDefault();
			var terminal = $('#terminalEmpAct').val();
			var nombreEmp = $('#nombreEmpAct').val();
			var apellidoPEmp = $('#apellidoPEmpAct').val();
			var apellidoMEmp = $('#apellidoMEmpAct').val();
			var direccionEmp = $('#direccionEmpAct').val();
			var telefonoEmp = $('#telefonoEmpAct').val();
			$('#fechaEmpAct').on("change", function() {
				this.setAttribute(
					"data-date",
					moment(this.value, "YYYY-MM-DD")
					.format(this.getAttribute("data-date-format"))
				)
			}).trigger("change");
			var fechaEmp = $('#fechaEmpAct').val();
			var rolEmp = $('#rolEmpAct').val();
			var usuarioEmp = $('#nombreUserEmpAct').val();
			var passEmp = $('#passEmpAct').val();
			if (terminal == '' || nombreEmp == '' || apellidoPEmp == '' || apellidoMEmp == '' || direccionEmp == '' || telefonoEmp == '' || fechaEmp == '' || rolEmp == '' || usuarioEmp == '' || passEmp == '') {
				alertify.warning("Por favor ingrese todos los datos solicitados");
				return false;
			} else {
				$.ajax({
					url: "controlador/actualizarEmpleado.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					success: function(r) {
						if (r == 1) {
							$('#frmEditarEmp')[0].reset();
							$('#modalEditarEmp').modal('hide');
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.success("Se guardaron los cambios con exito");
						} else {
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.error("Fallo al guardar cambios, verifique los datos");
						}
					}
				});
			}
			return false;
		});
	});
</script>

<script type="text/javascript">
	function eliminarEmpleado(empleado) {
		alertify.confirm('Eliminar a un empleado', '¿Seguro de eliminar este registro?', function() {
			$.ajax({
				type: "POST",
				data: "empleado=" + empleado,
				url: "controlador/eliminarEmpleado.php",
				success: function(r) {
					if (r == 1) {
						$('#tablaDatatable').load('tablas/tabla.php');
						alertify.success("¡Registro eliminado con exito!");
					} else {
						$('#tablaDatatable').load('tablas/tabla.php');
						alertify.error("No se pudo eliminar el registro");
					}
				}
			});
		}, function() {

		}); ///
	}
</script>

<script type="text/javascript">
	function agregaFrmEditar(empleado) {
		$.ajax({
			type: "POST",
			data: "empleado=" + empleado,
			url: "controlador/obtenerDatosEmpleado.php",
			success: function(res) {
				datos = jQuery.parseJSON(res);
				$('#id_empleado').val(datos['idEmpleado']);
				$('#terminalEmpAct').val(datos['idTerminal']);
				$('#nombreEmpAct').val(datos['nombreEmp']);
				$('#apellidoPEmpAct').val(datos['apellidoPEmp']);
				$('#apellidoMEmpAct').val(datos['apellidoMEmp']);
				$('#direccionEmpAct').val(datos['direccionEmp']);
				$('#telefonoEmpAct').val(datos['telefonoEmp']);
				$('#fechaEmpAct').val(datos['fechaEmp']);
				$('#rolEmpAct').val(datos['rolEmp']);
				$('#nombreUserEmpAct').val(datos['usuarioEmp']);
				$('#passEmpAct').val(datos['passEmp']);
			}
		});
	}
</script>