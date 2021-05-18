<?php
//require_once "modelo/sentenciasCRUD.php";
	session_start();
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

	<title>Terminales</title>
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
									<h3 class="d-inline-block mb-2 text-primary"><span class="fa fa-map-marker"></span> Registrar terminales:</h3>

									<!---- Formulario Registro de empleados ----->
									<form id="frmAltaTerminal" enctype="multipart/form-data">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-building" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="nombreTer" name="nombreTer" class="form-control" placeholder="Nombre PB:">
													</div>
												</div>
											</div>
											<div class="input-group flex-nowrap mt-2 mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												</div>
												<input type="text" id="direccionTer" name="direccionTer" class="form-control" placeholder="Direcci&oacute;n">
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="ciudadTer" name="ciudadTer" class="form-control" placeholder="Ciudad">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group flex-nowrap mt-2 mb-2">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
														</div>
														<input type="text" id="estadoTer" name="estadoTer" class="form-control" placeholder="Estado" value="Veracruz">
													</div>
												</div>
											</div>
											<div class="input-group flex-nowrap mt-2 mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
												</div>
												<input type="text" id="telefonoTer" name="telefonoTer" class="form-control" placeholder="Tel&eacute;fono">
											</div>
											<div class="input-group flex-nowrap mt-3 mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
												</div>
												<div class="custom-file border">
													<input type="file" class="ml-3" id="imagen" name="imagen" accept="image/*">
												</div>
											</div>
											<input type="submit" id="submitAltaTerminal" name="submitAltaTerminal" value="Agregar" class="btn btn-primary">
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
									<h3 class="d-inline-block mb-2 text-success"><span class="fa fa-location-arrow"></span> Terminales registradas:</h3>

									<div id="tablaTerminales" class="mt-3"></div>

								</div>
							</div>
						</div>
						<!---- Fin de sección B ----->
					</div>

					<!-- Modal Editar -->
					<div class="modal fade" id="modalEditarTer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-pencil"></span> Editar terminal:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-lg-5">
											<div class="card shadow mt-4 ml-3">
												<img id="img" src="img/terminales/BocaDelRio.jpg" alt="logotipo" class="card-img">
												<div class="card-body">
													<h4 class="text-primary"><span class="fa fa-picture"> </span> Im&aacute;gen</h4>
												</div>
											</div>
										</div>
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
																	<option value="<?php echo $empleado->id_empleado; ?>"> <?php echo $empleado->nombre_emp.' '.$empleado-> apellidop_emp. ' ' .$empleado->apellidom_emp; ?> </option>
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
<script src="js/validaciones.js"></script>
<script src="js/administradorTerminales.js"></script>