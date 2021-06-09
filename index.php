<?php
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

	<title>PlatinoBus</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12">
				<div class="card text-center">
					<h3 class="text-center mt-4 d-inline-block text-primary"><span class="fa fa-bus"> </span> Consulta nuestras rutas</h3>
					<div class="d-flex justify-content-center align-items-md-center mt-4 border rounded shadow-sm">
						<div class="row justify-content-center">
							<form id="frmRutas" enctype="multipart/form-data">
								<nav class="navbar navbar-light w-100">
									<div class="col-md-4 align-self-center input-group mb-3">
										<div class="input-group-prepend">
											<label class="input-group-text" for="terminalOrigen">Origen:</label>
										</div>
										<select class="custom-select" id="terminalOrigen" name="terminalOrigen">
											<option value="0" selected> Elija </option>
											<?php
											$terminales = getTerminalesCiudad();
											foreach ($terminales as $key => $terminal) :
											?>
												<option value="<?php echo $terminal->id_terminal; ?>"> <?php echo $terminal->ciudad_ter; ?> </option>
											<?php
											endforeach;
											?>
										</select>
									</div>
									<div class="col-md-4 align-self-center input-group mb-3">
										<div class="input-group-prepend">
											<label class="input-group-text" for="terminalDestino">Destino:</label>
										</div>
										<select class="custom-select" id="terminalDestino" name="terminalDestino">
											<option selected>Elija</option>
											<option value="1">Orizaba</option>
											<option value="2">Córdoba</option>
											<option value="3">Xalapa</option>
											<option value="4">Veracruz</option>
										</select>
									</div>
									<div class="col-md-4 align-self-center">
										<div class="row">
											<div class="col-8">
												<div class="row">
													<div class="col"> <label class="col-form-label">Fecha de salida:</label>
													</div>
												</div>
												<div class="row">
													<div class="col card-center"> <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" value="">
													</div>
												</div>
											</div>
											<div class="col-4 mt-2">
												<input type="submit" id="submit" name="submit" value="Buscar" class="btn btn-sm btn-info mt-2">
												<input type="reset" value="Limpiar" class="btn btn-sm btn-danger mt-2">
											</div>
										</div>
									</div>
								</nav>
							</form>
						</div>
					</div>

					<div class="album py-2 mt-2 pb-md-4 bg-light">
						<div class="container">
							<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="rutasRecibidas">

							</div>
						</div>
					</div>

					<div class="container">
						<div class="card col-md-12 mb-4 shadow">
							<div class="row no-gutters">
								<div class="col-md-5">
									<img src="img/PB_LogoPresentación.png" alt="Logo PB" class="card-img my-2">
								</div>
								<div class="col-md-7">
									<div class="card-body">
										<h5 class="card-title text-info">Platino Bus</h5>
										<?php
										if (!isset($_SESSION['usuarioNombre'])) {
										?>
											<p class="card-text text-justify">¡Comodidad asegurada en cada uno de nuestros viajes! Crea una cuenta de usuario y mantente informado de nuestras promociones.</p>
											<button type="button" class="btn btn-sm m-1 btn-info" data-toggle="modal" data-target="#modalRegistro">Crear cuenta</button>
											<hr>
										<?php
										}
										?>
										<p class="card-text text-justify">En México, el autobús sigue siendo el medio de transporte más utilizado para viajar. Actualmente existen más de 12,000 rutas en el país, 8.5 veces más terminales de autobús que aeropuertos y 42,000 unidades de autotransporte contra 258 aeronaves comerciales.<small class="text-muted"> (2015)</small></p>

									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Modal Consulta -->
					<div class="modal fade" id="modalConsulta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #FF6038;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-ticket"></span> Consultar boletos:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form id="frmConsultarBoletos" enctype="multipart/form-data">
											<div class="card-body pt-0">
												<div class="row">
													<div class="col-md-6 text-center">
														<h3 class="text-dark">Asientos</h3>
														<div class="row d-flex justify-content-around">
															<div class="col-md-9 align-middle" id="tablaAsientos">

															</div>
														</div>
													</div>
													<div class="col-md-6">
														<h3 class="text-info" id="rutaNombre"> </h3>
														<div class="row">
															<div class="col-md-6 mb-3">
																<label class="text-left col-form-label">Fecha de salida:</label>
																<input type="text" id="usuarioTipo" name="usuarioTipo" class="form-control" value="<?php if (isset($_SESSION['usuarioTipo'])) echo $_SESSION['usuarioTipo'];
																																																										else echo 0 ?>" style="display:none;">
																<input type="text" id="id_ruta" name="id_ruta" class="form-control" value="" style="display:none;">
																<input type="text" id="fechaSalida" name="fechaSalida" class="form-control" value="" readonly>
															</div>
															<div class="col-md-6 mb-3">
																<label class="text-left col-form-label">Horario: </label>
																<input type="text" id="horario" name="horario" class="form-control" value="" readonly>
															</div>
														</div>
														<div class="input-group flex-nowrap mt-2 mb-2">
															<div class="input-group-prepend">
																<label class="input-group-text" for="costo">Costo:</label>
															</div>
															<input type="text" id="costo" name="costo" class="form-control" value="" readonly>
														</div>
														<div class="input-group flex-nowrap mt-3 mb-2">
															<div class="input-group-prepend">
																<label class="input-group-text" for="asiento">Asiento seleccionado:</label>
															</div>
															<input type="text" id="asiento" name="asiento" class="form-control" value="" readonly>
														</div>
														<?php
														if (isset($_SESSION['usuarioNombre']) && ($_SESSION['usuarioTipo'] == "1" || $_SESSION['usuarioTipo'] == "2")) {
														?>
															<div class="input-group flex-nowrap mt-3 mb-2">
																<div class="input-group-prepend">
																	<label class="input-group-text" for="categoria">Categor&iacute;a:</label>
																</div>
																<select class="custom-select" id="categoria" name="categoria">
																	<option value="0" selected>Elija</option>
																	<option value="a">Adulto mayor</option>
																	<option value="b">Infantil</option>
																	<option value="c">Estudiante</option>
																	<option value="d">Normal</option>
																</select>
															</div>
															<div class="input-group flex-nowrap mt-3 mb-2">
																<div class="input-group-prepend">
																	<label class="input-group-text" for="nombreCliente">Nombre:</label>
																</div>
																<input type="text" id="nombreCliente" name="nombreCliente" class="form-control">
															</div>
															<div class="input-group flex-nowrap mt-3 mb-2">
																<div class="input-group-prepend">
																	<label class="input-group-text" for="total">Total a pagar:</label>
																</div>
																<input type="text" id="total" name="total" class="form-control" value="" readonly>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
																<button type="submit" id="submitBoleto" name="submitBoleto" class="btn btn-primary">Comprar boleto</button>
															</div>
														<?php
														} else if (isset($_SESSION['usuarioNombre']) && $_SESSION['usuarioTipo'] == "5") {
														?>
															<hr>
															<div id="smart-button-container">
																<div style="text-align: center;">
																	<div id="paypal-button-container"></div>
																</div>
															</div>
															<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=MXN" data-sdk-integration-source="button-factory"></script>
															<script>
																function initPayPalButton() {
																	paypal.Buttons({
																		style: {
																			shape: 'rect',
																			color: 'gold',
																			layout: 'vertical',
																			label: 'paypal',

																		},

																		createOrder: function(data, actions) {
																			return actions.order.create({
																				purchase_units: [{
																					"description": "Boleto PlatinoBus",
																					"amount": {
																						"currency_code": "MXN",
																						"value": 1
																					}
																				}]
																			});
																		},

																		onApprove: function(data, actions) {
																			return actions.order.capture().then(function(details) {
																				alert('Transaction completed by ' + details.payer.name.given_name + '!');
																				
																			});
																		},

																		onError: function(err) {
																			console.log(err);
																		}
																	}).render('#paypal-button-container');
																}
																initPayPalButton();
															</script>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
																
															</div>
														<?php
														} else {
														?>
															<div class="alert alert-primary mt-4" role="alert">
																<p class="text-justify">Para continuar y realizar la compra de un boleto, debe <b>registrarse</b>, sí usted ya tiene una cuenta, lo invitamos a <b>inciar sesión</b>.</p>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
															</div>
														<?php
														}
														?>

													</div>

												</div>
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
<script src="js/usuarioRegistro.js"></script>
<script src="js/rutas.js"></script>