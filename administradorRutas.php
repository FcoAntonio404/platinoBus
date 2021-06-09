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

		.text-orange {
			color: #FF6038;
		}
	</style>

	<title>Rutas</title>
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
									<h3 class="d-inline-block mb-2 text-primary"><span class="fa fa-map-marker"></span> Registrar rutas:</h3>

									<!---- Formulario Registro de rutas ----->
									<form id="frmAltaRuta" enctype="multipart/form-data">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<label class="input-group-text" for="inputGroupSelect01">Terminal origen:</label>
														</div>
														<select class="custom-select" id="terminalOrigen" name="terminalOrigen">
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
															<label class="input-group-text" for="inputGroupSelect01">Terminal destino:</label>
														</div>
														<select class="custom-select" id="terminalDestino" name="terminalDestino">
															<option selected>Elija</option>

														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<label class="input-group-text" for="inputGroupSelect01">Número de autobus:</label>
														</div>
														<select class="custom-select" id="autobus" name="autobus">
															<option selected>Elija</option>

														</select>
													</div>
												</div>
											</div>


											<div class="row">
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
														</div>
														<input type="time" id="horario" name="horario" class="form-control" placeholder="Horario">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="precio" name="precio" class="form-control" placeholder="Precio">
													</div>
												</div>
											</div>


											<div class="mt-2">
												<input type="submit" id="submitAltaRuta" name="submitAltaRuta" value="Agregar" class="btn btn-primary">
												<input type="reset" value="Limpiar" class="btn btn-danger">
											</div>
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
									<h3 class="d-inline-block mb-2 text-orange"><span class="fa fa-location-arrow"></span> Rutas registradas:</h3>

									<div id="tablaRutas" class="mt-3"></div>

								</div>
							</div>
						</div>
						<!---- Fin de sección B ----->
					</div>

					<!-- Modal Editar -->
					<div class="modal fade" id="modalEditarRuta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-pencil"></span> Editar ruta:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">

										<div class="col-lg-7">
											<form id="frmEditarTer" enctype="multipart/form-data">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<div class="input-group flex-nowrap mt-2 mb-2">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fa fa-building" aria-hidden="true"></i></span>
																</div>
																<input type="text" id="id_terminal" name="id_terminal" class="form-control" value="4" style="display:none;">
																<input type="text" id="nombreTerAct" name="nombreTerAct" class="form-control" placeholder="Nombre PB:">
															</div>
														</div>
													</div>
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="direccionTerAct" name="direccionTerAct" class="form-control" placeholder="Direcci&oacute;n">
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="input-group flex-nowrap mt-2 mb-2">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
																</div>
																<input type="text" id="ciudadTerAct" name="ciudadTerAct" class="form-control" placeholder="Ciudad">
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-group flex-nowrap mt-2 mb-2">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
																</div>
																<input type="text" id="estadoTerAct" name="estadoTerAct" class="form-control" placeholder="Estado" value="Veracruz">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="input-group flex-nowrap mt-2 mb-2">
																<div class="input-group-prepend">
																	<label class="input-group-text" for="inputGroupSelect01">Gerente</label>
																</div>
																<select class="custom-select" id="empleado" name="empleado">
																	<option selected>Elija</option>
																	<?php
																	$empleados = getEmpleados(4);
																	foreach ($empleados as $key => $empleado) :
																	?>
																		<option value="<?php echo $empleado->id_empleado; ?>"> <?php echo $empleado->nombre_emp . ' ' . $empleado->apellidop_emp . ' ' . $empleado->apellidom_emp; ?> </option>
																	<?php
																	endforeach;
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="telefonoTerAct" name="telefonoTerAct" class="form-control" placeholder="Tel&eacute;fono">
													</div>
													<div class="input-group flex-nowrap mt-3 mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
														</div>
														<div class="custom-file border">
															<input type="file" class="ml-3" id="imagenAct" name="imagenAct" placeholder="Subir im&aacute;gen">
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
		var html2;
		$("#terminalDestino").prop('disabled', true);
		$("#autobus").prop('disabled', true);
		$("#terminalOrigen").change(function() {
			var destino = $("#terminalDestino");
			var autobus = $("#autobus");
			$("#terminalDestino").prop('disabled', true);
			$("#autobus").prop('disabled', true);
			var origen = $(this);
			html = '';
			html2 = '';
			if ($(this).val() != 0) {
				$.ajax({
					data: {
						origen: origen.val()
					},
					url: 'controlador/terminalesDestinoNombres.php',
					type: 'POST',
					dataType: 'json',
					beforeSend: function() {
						origen.prop('disabled', true);
					},
					success: function(respuesta) {
						res = JSON.parse(respuesta);

						origen.prop('disabled', false);
						destino.find('option').remove();
						$(res["destinos"]).each(function(i, v) {
							html += '<option value = "' + v.id_terminal + '">' + v.nombre_ter + '</option>';
						});
						destino.append(html);
						console.log(res);
						destino.prop('disabled', false);

						autobus.find('option').remove();
						if ($.isEmptyObject(res["autobuses"])) {
							html2 = '<option value = "0">Sin autobuses disponibles</option>';
						} else {
							$(res["autobuses"]).each(function(i, v) {
								html2 += '<option value = "' + v.id_autobus + '">' + v.numero_autobus + ' con ' + v.capacidad_asientos + ' asientos' + '</option>';
							});
						}

						autobus.append(html2);
						autobus.prop('disabled', false);
					},
					error: function() {
						alert('Ocurrio un error en el servidor ..');
						origen.prop('disabled', false);
					}
				});

			} else {
				//origen.find('option').remove();
				//origen.prop('disabled', true);
			}

		});
	});
</script>
<script src="js/validaciones.js"></script>
<script src="js/administradorRutas.js"></script>