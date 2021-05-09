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

	<title>Terminales</title>
</head>

<body>
	<?php require_once "header.php"; ?>
	<div class="conteiner">
		<div class="row">
			<div class="col-lg-12 pr-0">
				<div class="card text-center">
					<h3 class="text-center mt-3 mb-0 d-inline-block text-primary"><span class="fa fa-map-marker"> </span> Terminales</h3>

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
												<h3 class="text-primary"><span class="fa fa-map-marker"> </span> Orizaba</h3>
												<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
												<div class="d-flex justify-content-between align-items-center">
													<div class="btn-group">
														
													</div>
													<small class="text-muted">2021</small>
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