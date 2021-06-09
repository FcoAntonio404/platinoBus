<?php
session_start();
require_once "../modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();
$fecha = date ( 'Y-m-d' );
$sql = "SELECT id_boleto, (SELECT nombre_ter FROM terminales,rutas WHERE id_terminal = id_terminal_origen AND boletos.id_ruta = rutas.id_ruta)AS origen, (SELECT nombre_ter FROM terminales, rutas WHERE id_terminal = id_terminal_destino AND boletos.id_ruta = rutas.id_ruta)AS destino, (SELECT horario FROM rutas WHERE rutas.id_ruta = boletos.id_ruta)AS horario, fecha_salida, num_asiento, estado FROM boletos WHERE fecha_salida >= '$fecha'";
$result = $conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="idtablaBoletos">
		<thead style="background-color: #17a2b8;color: white; font-weight: bold;">
			<tr>
				<td>Folio</td>
				<td>Ruta</td>
				<td>Horario</td>
				<td>Fecha salida</td>
				<td>Asiento</td>
				<td>Estado</td>
				<?php
					if($_SESSION["usuarioTipo"] == "3") {
				?>
				<td>Acciones</td>
				<?php
					}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($mostrar = $result->fetch_array(MYSQLI_NUM)) {
			?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar[1].' - '.$mostrar[2] ?></td>
					<td><?php echo $mostrar[3] ?></td>
					<td><?php echo $mostrar[4] ?></td>
					<td><?php echo $mostrar[5] ?></td>
					<td><?php echo ($mostrar[6] == 'e') ? "Espera" : (($mostrar[6] == 'c') ? "Cerrado" : "Suspendido") ?></td>
					<?php
						 if($_SESSION["usuarioTipo"] == "3") {
					?>
					<td style="text-align: center;">
						<span class="btn btn-sm btn-success " data-toggle="modal" data-target="#modalEditarEstadoBoleto" onclick="agregaFrmEditarEstado('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-check-square-o"></span>
						</span>
					</td>
					<?php
						 }
					?>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#idtablaBoletos').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			"pageLength": 3
		});
	});
</script>