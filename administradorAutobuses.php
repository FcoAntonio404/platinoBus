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

	<title>Autobuses</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12 pr-0">
				<div class="card text-center">
					<div class="row mb-2 mt-4">
						<!---- Sección A ----->
						<div class="col-lg-5">
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
								<div class="col p-4 d-flex flex-column position-static">
									<h3 class="d-inline-block mb-2 text-primary"><span class="fa fa-plus-circle"></span> Registrar autobuses:</h3>

									<!---- Formulario Registro de autobuses ----->
									<form id="frmAltaAutobuses" enctype=" multipart/form-data">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<label class="input-group-text" for="inputGroupSelect01">Terminal:</label>
														</div>
														<select class="custom-select" id="terminal" name="terminal">
															<option value="0" selected>Elija</option>
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
															<label class="input-group-text" for="inputGroupSelect01">Operador</label>
														</div>
														<select class="custom-select" id="empleado" name="empleado">
															<option value="0" selected>Elija</option>

														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text">Autobus</span>
														</div>
														<input type="text" id="numeroBus" name="numeroBus" class="form-control" placeholder="No. de autobus" aria-label="Username" aria-describedby="addon-wrapping">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text">Placa</span>
														</div>
														<input type="text" id="placaBus" name="placaBus" class="form-control" placeholder="No. de placa" aria-label="Username" aria-describedby="addon-wrapping">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<label class="input-group-text" for="asientos">Asientos</label>
														</div>
														<select class="custom-select" id="asientos" name="asientos">
															<option selected>Elija</option>
															<option value="29">29</option>
															<option value="30">30</option>
															<option value="32">32</option>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="flex-nowrap mt-2 mb-2">
														<input type="submit" id="submitAgregar" name="submitAgregar" value="Agregar" class="btn btn-primary mr-2 mt-2">
														<input type="reset" value="Limpiar" class="btn btn-danger mt-2">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!---- Fin de sección A ----->
						<!---- Sección B ----->
						<div class="col-lg-7">
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
								<div class="col p-4 d-flex flex-column position-static">
									<h3 class="d-inline-block mb-2 text-success"><span class="fa fa-check-circle"></span> Autobuses registrados:</h3>

									<div id="tablaDatatable" class="mt-3"></div>

								</div>
							</div>
						</div>
						<!---- Fin de sección B ----->
					</div>

					<!-- Modal Editar -->
					<div class="modal fade" id="modalEditarAutobus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-pencil"></span> Editar autobuses:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form id="frmEditarAutobus" enctype="multipart/form-data">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group flex-nowrap mt-2 mb-2">
															<div class="input-group-prepend">
																<label class="input-group-text" for="empleadoAct">Operador</label>
															</div>
															<input type="text" id="id_autobus" name="id_autobus" class="form-control" value="" style="display:none;">
															<select class="custom-select" id="empleadoAct" name="empleadoAct">
																
															</select>
														</div>
													</div>
												</div>
												<div class="input-group flex-nowrap mt-2 mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">N&uacute;mero de autobus</span>
													</div>
													<input type="text" id="numeroBusAct" name="numeroBusAct" class="form-control" placeholder="No. de autobus" aria-label="Username" aria-describedby="addon-wrapping" readonly>
												</div>
												<div class="input-group flex-nowrap mt-3 mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">N&uacute;mero de placa</span>
													</div>
													<input type="text" id="placaBusAct" name="placaBusAct" class="form-control" placeholder="No. de placa" aria-label="Username" aria-describedby="addon-wrapping">
												</div>
												<div class="input-group flex-nowrap mt-3 mb-3">
													<div class="input-group-prepend">
														<label class="input-group-text" for="asientosAct">Cantidad de asientos</label>
													</div>
													<select class="custom-select" id="asientosAct" name="asientosAct">
														<option selected>Elija</option>
														<option value="29">29</option>
														<option value="30">30</option>
														<option value="32">32</option>
													</select>
												</div>
												<div class="input-group flex-nowrap mt-3 mb-3">
													<div class="input-group-prepend">
														<label class="input-group-text" for="estadoAct">Estado del autobus</label>
													</div>
													<select class="custom-select" id="estadoAct" name="estadoAct">
														<option selected>Elija</option>
														<option value="c">Circulaci&oacute;n</option>
														<option value="m">Mantenimiento</option>
														<option value="s">Suspendido</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="submit" id="submitEditar" name="submitEditar" class="btn btn-primary">Guardar cambios</button>
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
		var html;
		$("#empleado").prop('disabled', true);
		$("#terminal").change(function() {
			var empleado = $("#empleado");
			$("#empleado").prop('disabled', true);
			var terminal = $(this);
			html = '<option value="0" selected>Elija</option>';
			if ($(this).val() != 0) {
				$.ajax({
					data: {
						terminal: terminal.val()
					},
					url: 'controlador/obtenerOperadoresLibres.php',
					type: 'POST',
					dataType: 'json',
					beforeSend: function() {
						terminal.prop('disabled', true);
					},
					success: function(respuesta) {
						res = JSON.parse(respuesta);

						terminal.prop('disabled', false);
						empleado.find('option').remove();
						if ($.isEmptyObject(res)) {
							html = '<option value = "0">Sin operadores libres</option>';
						} else {
							$(res).each(function(i, v) {
								html += '<option value = "' + v.id_empleado + '">' + v.nombre_emp + ' ' + v.apellidop_emp + ' ' + v.apellidom_emp + '</option>';
							});
						}

						empleado.append(html);
						console.log(res);
						empleado.prop('disabled', false);
					},
					error: function() {
						alert('Ocurrio un error en el servidor ..');
						terminal.prop('disabled', false);
					}
				});

			} else {
				//terminal.find('option').remove();
				//terminal.prop('disabled', true);
			}

		});
	});
</script>
<script src="js/validaciones.js"></script>
<script src="js/administradorAutobuses.js"></script>