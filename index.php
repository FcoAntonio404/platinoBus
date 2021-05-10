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

	<title>PlatinoBus</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12 pr-0">
				<div class="card text-center">
					<h3 class="text-center mt-3 mb-0 d-inline-block text-primary"><span class="fa fa-bus"> </span> Consulta nuestras rutas</h3>
					<div class="d-flex justify-content-center align-items-md-center mt-4 border rounded">
						<div class="row justify-content-center">

							<form action="">
								<nav class="navbar navbar-light w-100">
									<div class="col-md-4 align-self-center input-group mb-3">
										<div class="input-group-prepend">
											<label class="input-group-text" for="inputGroupSelect01">Origen:</label>
										</div>
										<select class="custom-select" id="inputGroupSelect01">
											<option selected>Elija</option>
											<option value="1">Orizaba</option>
											<option value="2">Córdoba</option>
											<option value="3">Xalapa</option>
											<option value="4">Veracruz</option>
										</select>
									</div>
									<div class="col-md-4 align-self-center input-group mb-3">
										<div class="input-group-prepend">
											<label class="input-group-text" for="inputGroupSelect01">Destino:</label>
										</div>
										<select class="custom-select" id="inputGroupSelect01">
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
													<div class="col card-center"> <input type="date" id="Fecha" name="Fecha" class="form-control form-control-sm" value="">
													</div>
												</div>
											</div>
											<div class="col-4 mt-2">
												<input type="submit" id="submit" name="submit" value="Buscar" class="btn btn-sm btn-info mt-2">
												<input type="reset" value="Limpiar" class="btn btn-sm btn-success mt-2">
											</div>
										</div>
									</div>
								</nav>
							</form>
						</div>
					</div>

					<div class="album py-2 mt-2 pb-md-4 bg-light">
						<div class="container">
							<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
								<?php
								for ($i = 0; $i < 9; $i++) {
								?>
									<!------->
									<div class="col-md-4 mt-3">
										<div class="card shadow-sm">
											<img src="img/PB_Logo.png" alt="logotipo" class="card-img">
											<div class="card-body">
												<h3 class="text-primary">Orizaba</h3>
												<p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis nostrum sint, dolorum dolor eligendi minima exercitationem quae porro blanditiis voluptates necessitatibus optio libero qui, neque nemo suscipit? Aperiam, non repellat!.</p>
												<div class="d-flex justify-content-between align-items-center">
													<div class="btn-group">
														<button type="button" class="btn btn-sm btn-outline-primary">Consultar</button>
													</div>
													<small class="text-muted">9 mins</small>
												</div>
											</div>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>



					<!-- Modal Editar -->
					<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
									<h5 class="modal-title" id="exampleModalLabel">Editar datos:</h5>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form id="frmEditar" enctype="multipart/form-data">
											<div class="card-body">

												<div class="row">
													<div class="col-md-6 mb-3">
														<label class="text-left col-form-label">RPE del Trabajador: </label>
														<input type="text" id="rpeE" name="rpeE" class="form-control" placeholder="RPE del trabajador" readonly="readonly" value="">

													</div>
													<div class="col-md-6 mb-3">
														<label class="text-left col-form-label">Area: </label>
														<input type="text" id="areaE" name="areaE" class="form-control" placeholder="Area del trabajador" value="">

													</div>
												</div>

												<div class="row">
													<div class="col-md-12 mb-3">

														<label class="text-left col-form-label">Nombre completo del Trabajador: </label>
														<input type="text" id="nombreE" name="nombreE" class="form-control" value="">

													</div>
												</div>

												<div class="row">
													<div class="col-md-6 mb-3">

														<label class="text-left col-form-label">Fecha de ingreso laboral: </label>
														<input type="date" id="FechaE" name="FechaE" class="form-control" value="">
														<input type="hidden" id="DiasE" name="DiasE" value="">


													</div>
													<div class="col-md-6 mb-3">
														<div class="row mb-2">
															<div class="col-md-5">
																<label class="text-center col-form-label">Antiguedad (años):</label>
															</div>
															<div class="col-md-7">
																<input type="number" id="ANTE" name="ANTE" class="form-control" placeholder="Años" value="" min="0">
															</div>

															<button type="button" class="btn btn-link" id="calcularE"><span class="fa fa-magic"></span> Calcular Automaticamente</button>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 mb-3">
														<div class="alert alert-primary " role="alert" id="OKE" style="display:none;">
															<label> Renovará periodo vacacional cada: <strong id="Next2"></strong>;
																del cual, deberá tomar las vacaciones en un plazo no mayor a 18 meses.
																<span> </span>
															</label>

														</div>
													</div>
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