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
					<h3 class="text-center mt-3 mb-0 d-inline-block text-primary"><span class="fa fa-map-marker"> </span> Terminales</h3>

					<div class="album py-2 mt-2 pb-md-4 bg-light">
						<div class="container">
							<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
								<?php
								$terminales = getTerminalesInfo();
								foreach ($terminales as $key => $terminal) :

								?>
									<!------->
									<div class="col-md-4 mt-3">
										<div class="card shadow">
											<img src="img/terminales/<?php echo $terminal->imagen; ?>" alt="logotipo" class="card-img">
											<div class="card-body">
												<h3 class="text-primary"><span class="fa fa-map-marker"> </span> <?php echo $terminal->ciudad_ter; ?> </h3>
												<p class="card-text">Platino Bus presente en la ciudad de <?php echo $terminal->ciudad_ter; ?> con la terminal <b><?php echo $terminal->nombre_ter; ?></b> ubicada en <?php echo $terminal->direccion_ter; ?>.</p>
												<div class="d-flex justify-content-between align-items-center">
													<div class="btn-group">

													</div>
													<small class="text-muted">Tel:. <?php echo $terminal->telefono_ter; ?> </small>
												</div>
											</div>
										</div>
									</div>
								<?php
								endforeach;
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