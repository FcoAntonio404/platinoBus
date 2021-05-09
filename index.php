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
<!---
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaDatatable').load('tablas/tabla.php');
		$('#calendario').fullCalendar({
			//hiddenDays: [ 0, 6 ],
			header: {
				left: 'title',
				center: '',
				right: 'today,prevYear,prev,next,nextYear'
			},
			dayClick: function(date, jsEvent, view) {
				alertify.success("fecha seleccionada: " + date.format());
				$('#fecha1').val(date.format());
				$(this).css('background-color', 'blue');
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('ul.tabs li a:first').addClass('active');
		$('.secciones article').hide();
		$('.secciones article:first').show();

		$('ul.tabs li a').click(function() {
			$('ul.tabs li a').removeClass('active');
			$(this).addClass('active');
			$('.secciones article').hide();

			var activeTab = $(this).attr('href');
			$(activeTab).show();
			return false;
		});
	});
</script>

<script type="text/javascript">
	document.getElementById("calcular").onclick = function() {
			var fecha1 = moment();
			var Fe = $('#Fecha').val();
			if (Fe != "") {
				var fecha2 = moment(Fe);

				var ant = fecha1.diff(fecha2, 'years');

				$("#ANT").val(ant);

				if (ant == 0) $('#Días').val(0);

				if (ant == 1) $('#Días').val(12);

				if (ant == 2) $('#Días').val(17);

				if (ant >= 3 && ant < 10) $('#Días').val(20);

				if (ant >= 10) $('#Días').val(24);

				var mes = moment(Fe).month();
				var meses = ['Enero',
					'Febrero',
					'Marzo',
					'Abril',
					'Mayo',
					'Junio',
					'Julio',
					'Agosto',
					'Septiembre',
					'Octubre',
					'Noviembre',
					'Diciembre'
				];
				var diames = moment(Fe).format('DD') + " de " + meses[mes];
				$('#Next1').html(diames);
				$('#OK').show();

			} else {
				alertify.warning('Capture la fecha de ingreso antes de calcular la antiguedad');
				$("#ANT").val("");
				$('#Días').val("");

				$('#Next1').html("");
				$('#OK').hide();
			}


		},
		document.getElementById("calcularE").onclick = function() {
			var fecha1 = moment();
			var Fe = $('#FechaE').val();
			if (Fe != "") {
				var fecha2 = moment(Fe);

				var ant = fecha1.diff(fecha2, 'years');

				$("#ANTE").val(ant);

				if (ant == 0) $('#DiasE').val(0);

				if (ant == 1) $('#DiasE').val(12);

				if (ant == 2) $('#DiasE').val(17);

				if (ant >= 3 && ant < 10) $('#DiasE').val(20);

				if (ant >= 10) $('#DiasE').val(24);

				var mes = moment(Fe).month();
				var meses = ['Enero',
					'Febrero',
					'Marzo',
					'Abril',
					'Mayo',
					'Junio',
					'Julio',
					'Agosto',
					'Septiembre',
					'Octubre',
					'Noviembre',
					'Diciembre'
				];
				var diames = moment(Fe).format('DD') + " de " + meses[mes];
				$('#Next2').html(diames);
				$('#OKE').show();

			} else {
				alertify.warning('Capture la fecha de ingreso antes de calcular la antiguedad');
				$("#ANTE").val("");
				$('#DiasE').val("");

				$('#Next2').html("");
				$('#OKE').hide();
			}





		},
		document.getElementById("calcularR").onclick = function() {
			var fecha1 = $('#fecha1').val();
			var dates = [];
			if (fecha1 != "") {
				var F = new Date($('#fecha1').val());
				var dias = $('#dias2').val();
				if (dias != "") {
					$.ajax({
						url: "procesos/obtenFechas.php",
						dataType: 'json',
						type: 'POST',
						data: "date=" + fecha1,

						success: function(r) {

							if ($.inArray(fecha1, r) == -1) {

								var i = 0;
								while (i <= dias) {
									F.setTime(F.getTime() + 24 * 60 * 60 * 1000);
									var mes = (F.getMonth() + 1);
									if (mes < 10) mes = '0' + mes;
									var dia = F.getDate();
									if (dia < 10) dia = '0' + dia;
									var R = F.getFullYear() + '-' + mes + '-' + dia;
									if ($.inArray(R, r) == -1) {
										if (F.getDay() != 6 && F.getDay() != 0) {
											i++;
										}
									} else {

									}

								}

								$(document).ready(function() {
									$("#fecha3").val(R);
								});




							} else {

								alert("La fecha inicial es un día NO LABORAL");
								$('#fecha1').val('');
								return false;

							}

						}
					});


				} else {
					alertify.warning('Capture el número de dias a tomar antes de calcular las vacaciones');
					$("#dias2").val("");

				}

			} else {
				alertify.warning('Capture la fecha inicial antes de calcular las vacaciones');
				$("#fecha3").val("");
			}



		}
</script>

<script type="text/javascript">
	$(document).ready(function() {


		$('#frmAlta').submit(function(event) {

			event.preventDefault();
			var rpe = $('#rpe').val();
			var area = $('#area').val();
			var nombre = $('#nombre').val();
			var AP = $('#AP').val();
			var AM = $('#AM').val();
			var Fe = $('#Fecha').val();
			var Ant = $('#ANT').val();
			if (rpe == '' || area == '' || nombre == '' || AP == '' || AM == '' || Fe == '' || Ant == '') {
				alertify.error("Por favor ingrese todos los datos solicitados");
				return false;
			} else {

				$.ajax({
					url: "procesos/agregar.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					success: function(r) {
						if (r != false && r != 2) {
							$('#OK').hide();
							$('#frmAlta')[0].reset();
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.success("El registro se realizó con exito");
						} else if (r == 2) {

							alertify.error("¡ERROR!, RPE duplicado");

						} else {
							alertify.error("Fallo al realizar el registro, verifique los datos");
						}
					}
				});

			}



		});

	});
</script>

<script type="text/javascript">
	$(document).ready(function() {


		$('#frmEditar').submit(function(event) {

			event.preventDefault();
			var rpe = $('#rpeE').val();
			var area = $('#areaE').val();
			var nombre = $('#nombreE').val();
			var Fe = $('#FechaE').val();
			var Ant = $('#ANTE').val();
			if (rpe == '' || area == '' || nombre == '' || Fe == '' || Ant == '') {
				alertify.error("Por favor ingrese todos los datos solicitados");
				return false;
			} else {

				$.ajax({
					url: "procesos/actualizar.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					success: function(r) {
						if (r == 1) {
							$('#frmEditar')[0].reset();
							$('#modalEditar').modal('hide');
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.success("Se guardaron los cambios con exito");
						} else {
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.error("Fallo al guardar cambios, verifique los datos");
						}
					}
				});

			}



		});

	});
</script>

<script type="text/javascript">
	function eliminarDatos(rpe) {
		alertify.confirm('Eliminar un registro', '¿Seguro de eliminar este registro?', function() {

			$.ajax({
				type: "POST",
				data: "rpe=" + rpe,
				url: "procesos/eliminar.php",
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

		});
	}
</script>

<script type="text/javascript">
	function agregaFrmActualizar(rpe) {
		$.ajax({
			type: "POST",
			data: "rpe=" + rpe,
			url: "procesos/obtenDatos.php",
			success: function(r) {
				datos = jQuery.parseJSON(r);
				$('#nombre3').html(datos['nombre']);
				$('#rpe2').html("RPE: " + datos['rpe']);
				$('#area2').val(datos['area']);
				$('#fecha2').val(datos['fecha']);
				$('#ant2').val(datos['ant']);
				$('#dias2').val(datos['dias']);
				$('#FEX').val(datos['fechaEx']);
				$('#GEX').val(datos['fechaNext']);


			}
		});
	}
</script>

<script type="text/javascript">
	function agregaFrmEditar(rpe) {
		$.ajax({
			type: "POST",
			data: "rpe=" + rpe,
			url: "procesos/obtenDatos.php",
			success: function(r) {
				datos = jQuery.parseJSON(r);
				$('#OKE').hide();
				$('#nombreE').val(datos['nombre']);
				$('#rpeE').val(datos['rpe']);
				$('#areaE').val(datos['area']);
				$('#FechaE').val(datos['fecha']);
				$('#ANTE').val(datos['ant']);



			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {

		$('#frRegistro').submit(function(event) {

			event.preventDefault();
			var fechaInicial = $('#fecha1').val();
			if (fechaInicial == '') {
				alertify.error("Por favor selecciona la fecha inicial para el periodo vacacional");
				return false;
			} else {

				$.ajax({
					url: "procesos/actualizar.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					success: function(r) {
						if (r == 1) {
							$('#frRegistro')[0].reset();
							$('#modalEditar').modal('hide');
							$('#tablaDatatable').load('tablas/tabla.php');
							alertify.success("El reporte vacacional fue procesado con exito");
						} else {
							alertify.error("Fallo al procesar el reporte vacacional");
						}
					}
				});
			}




		});

	});
</script>