<?php
require_once "../modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();

$sql = "SELECT id_ruta, (SELECT nombre_ter FROM terminales WHERE id_terminal = id_terminal_origen)AS origen, (SELECT nombre_ter FROM terminales WHERE id_terminal = id_terminal_destino)AS destino, (SELECT numero_autobus FROM autobuses WHERE autobuses.id_autobus = rutas.id_autobus) AS numero, horario, precio, estado FROM rutas";
$result = $conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="idtablaRutas">
		<thead style="background-color: #FF5338;color: white; font-weight: bold;">
			<tr>
				<td>Origen</td>
				<td>Destino</td>
				<td>N. autobus</td>
				<td>Horario</td>
				<td>Precio</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($mostrar = $result->fetch_array(MYSQLI_NUM)) {
			?>
				<tr>
					<td><?php echo $mostrar[1] ?></td>
					<td><?php echo $mostrar[2] ?></td>
					<td><?php echo $mostrar[3] ?></td>
					<td><?php echo $mostrar[4] ?></td>
					<td><?php echo $mostrar[5] ?></td>
					<td style="text-align: center;">
						<?php
						if ($mostrar[6] == 1) {
						?>
							<span class="btn btn-sm btn-outline-secondary " onclick="ocultarRuta('<?php echo $mostrar[0] ?>')">
								<span class="fa fa-eye-slash"></span>
							</span>
						<?php
						} else {
						?>
							<span class="btn btn-sm btn-outline-info " onclick="aparecerRuta('<?php echo $mostrar[0] ?>')">
								<span class="fa fa-eye"></span>
							</span>
						<?php
						}
						?>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#idtablaRutas').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			"pageLength": 3
		});
	});
</script>