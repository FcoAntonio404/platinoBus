<?php
require_once "../modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();

$sql = "SELECT id_autobus, numero_autobus, placa, estado, (SELECT CONCAT (nombre_emp,' ',apellidop_emp,' ',apellidom_emp) AS operador FROM empleados WHERE autobuses.id_empleado = empleados.id_empleado) AS operador FROM autobuses";
$result = $conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="idtablaTerminales">
		<thead style="background-color: #338FB6;color: white; font-weight: bold;">
			<tr>
				<td>N&uacute;mero</td>
				<td>Placa</td>
				<td>Operador</td>
				<td>Estado</td>
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
					<td><?php echo $mostrar[4] ?></td>
					<td><?php echo ($mostrar[3] == 'c') ? "Circulación" : (($mostrar[3] == 'm') ? "Mantenimiento" : "Suspendido") ?></td>
					<td style="text-align: center;">
						<span class="btn btn-sm btn-warning " data-toggle="modal" data-target="#modalEditarAutobus" onclick="agregaFrmEditarAutobus('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-pencil"></span>
						</span>
						<span class="btn btn-sm btn-outline-secondary " onclick="eliminarAutobus('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-trash"></span>
						</span>
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
		$('#idtablaTerminales').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			"pageLength": 3
		});
	});
</script>