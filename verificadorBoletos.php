<?php
session_start();
if (!isset($_SESSION['usuarioNombre']) || ($_SESSION['usuarioTipo'] != "3" && $_SESSION['usuarioTipo'] != "2")) {
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

	<title>Verificador de boletos</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12 pr-0">
				<div class="card text-center">

					<h3 class="text-center mt-4 d-inline-block text-primary"><span class="fa fa-search"> </span> Indicar ruta a consultar</h3>
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

					<div class="row mb-2 mt-4 d-flex justify-content-around">

						<!---- Fin de sección A ----->
						<!---- Sección B ----->
						<div class="col-lg-8">
							<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
								<div class="col p-4 d-flex flex-column position-static">
									<h3 class="d-inline-block mb-2 text-success"><span class="fa fa-ticket"></span> Boletos:</h3>

									<div id="tablaDatatable" class="mt-3"></div>

								</div>
							</div>
						</div>
						<!---- Fin de sección B ----->
					</div>

					<!-- Modal Editar -->
					<div class="modal fade" id="modalEditarEstadoBoleto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-pencil"></span> Editar estado del boleto:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form id="frmEditarEstado" enctype="multipart/form-data">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group flex-nowrap mt-2 mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">Folio</span>
															</div>
															<input type="text" id="id_boleto" name="id_boleto" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" readonly>
														</div>
														<div class="input-group flex-nowrap mt-2 mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">Ruta</span>
															</div>
															<input type="text" id="ruta" name="ruta" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" readonly>
														</div>
														<div class="input-group flex-nowrap mt-2 mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">Horario</span>
															</div>
															<input type="text" id="horario" name="horario" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" readonly>
														</div>
														<div class="input-group flex-nowrap mt-2 mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">Fecha de salida</span>
															</div>
															<input type="text" id="fechaSalida" name="fechaSalida" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" readonly>
														</div>
														<div class="input-group flex-nowrap mt-2 mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">Asiento</span>
															</div>
															<input type="text" id="asiento" name="asiento" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" readonly>
														</div>
														<div class="input-group flex-nowrap mt-3 mb-2">
															<div class="input-group-prepend">
																<label class="input-group-text" for="estado">Estado</label>
															</div>
															<select class="custom-select" id="estado" name="estado">
																<option value="0" selected>Elija</option>
																<option value="e">Espera</option>
																<option value="c">Cerrado</option>
																<option value="s">Suspendido</option>
															</select>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
															<button type="submit" id="submitEditarBoleto" name="submitEditarBoleto" class="btn btn-primary">Guardar cambios</button>
														</div>
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
<script type="text/javascript">
	var fechaSolicitada;
	$(document).ready(function() {
		var html;
		$("#terminalDestino").prop("disabled", true);
		$("#terminalOrigen").change(function() {
			var destino = $("#terminalDestino");
			$("#terminalDestino").prop("disabled", true);
			var origen = $(this);
			html = "";
			if ($(this).val() != 0) {
				$.ajax({
					data: {
						origen: origen.val(),
					},
					url: "controlador/terminalesDestino.php",
					type: "POST",
					dataType: "json",
					beforeSend: function() {
						origen.prop("disabled", true);
					},
					success: function(respuesta) {
						res = JSON.parse(respuesta);

						origen.prop("disabled", false);
						destino.find("option").remove();
						$(res).each(function(i, v) {
							html +=
								'<option value = "' +
								v.id_terminal +
								'">' +
								v.ciudad_ter +
								"</option>";
						});
						destino.append(html);
						console.log(res);
						destino.prop("disabled", false);
					},
					error: function() {
						alert("Ocurrio un error en el servidor ..");
						origen.prop("disabled", false);
					},
				});
			} else {
				//origen.find('option').remove();
				//origen.prop('disabled', true);
			}
		});
		$("#frmRutas").submit(function(event) {
			event.preventDefault();

			var origen = $("#terminalOrigen").val();
			var destino = $("#terminalDestino").val();
			fechaSolicitada = $("#fecha").val();
			if (origen == "0" && destino == "Elija" && fechaSolicitada == "") {
				alertify.warning("Ingrese todos los datos solicitados");
			} else {
				if (
					validarTerminalRol(origen, "Terminal origen") == 1 &&
					validarTerminalRol(destino, "Terminal destino") == 1 &&
					validarFechaSalida(fechaSolicitada, "Fecha") == 1
				) {
					html = "<table class='table table - bordered table - striped' cellspacing='0'width='100%' id='idtablaBoletos'>" +
						"<thead style = 'background-color: #17a2b8;color: white; font-weight: bold;'>" +
						"<tr>" +
						"<td > Folio </td> " +
						"<td > Ruta </td> " +
						"<td > Fecha </td> " +
						"<td > Asiento </td> " +
						"<td > Estado </td> " +
						"<td > Acciones </td> " +
						"</tr> " +
						"</thead> " +
						"<tbody > " +
						"</tbody> " +
						"</table>";
					//$("#tablaDatatable").html(html);


					//return false;
					$.ajax({
						url: "controlador/obtenerBoletos.php",
						method: "POST",
						data: new FormData(this),
						contentType: false,
						processData: false,
						cache: false,
						beforeSend: function() {
							$("#terminalOrigen").prop("disabled", true);
							$("#terminalDestino").prop("disabled", true);
							$("#fecha").prop("disabled", true);
						},
						success: function(respuesta) {
							res = JSON.parse(respuesta);

							$("#terminalOrigen").prop("disabled", false);
							$("#terminalDestino").prop("disabled", false);
							$("#fecha").prop("disabled", false);

							$("#rutasRecibidas").find("div").remove();
							if ($.isEmptyObject(res)) {
								html = '<div class = "col-md-12 mt-3"> <h3 class="text-center text-danger"><span class="fa fa-exclamation-circle"></span> Sin rutas </h3> </div>';
							} else {
								$(res).each(function(i, v) {
									html +=
										'<div class = "col-md-4 mt-3" > ' +
										'<div class="card shadow">' +
										'<img src="img/terminales/' +
										v.imagen +
										'" alt="logotipo" class="card-img">' +
										'<div class="card-body">' +
										'<h3 class="text-info"><span class="fa fa-map-marker"></span>' +
										" " +
										v.origen +
										" - " +
										v.destino +
										"</h3>" +
										'<p class="card-text"><b> Horario: ' +
										v.horario +
										" hrs. </b> </p>" +
										'<p class="card-text"><span class="fa fa-calendar-check-o"></span>' +
										" " +
										fechaSolicitada +
										" </p>" +
										'<div class="d-flex justify-content-between align-items-center">' +
										'<div class="btn-group">' +
										'<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalConsulta" onclick="agregaFrmConsultar(' +
										v.id_ruta +
										')">Consultar</button>' +
										"</div>" +
										'<p class="text-dark"><b> Costo: $' +
										v.precio +
										" </b></p>" +
										"</div>" +
										"</div>" +
										"</div>" +
										"</div>";
								});
							}
							$("#rutasRecibidas").append(html);
							console.log(res);
						},
						error: function() {
							alert("Ocurrio un error en el servidor");
							$("#terminalOrigen").prop("disabled", false);
							$("#terminalDestino").prop("disabled", false);
							$("#fecha").prop("disabled", false);
						}
					});
				}
			}
			return false;
		});
	});
</script>
<script src="js/validaciones.js"></script>
<script src="js/verificadorBoletos.js"></script>