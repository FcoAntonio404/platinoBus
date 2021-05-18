<?php
require_once "../modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();

$sql = "SELECT id_terminal, nombre_ter, direccion_ter, ciudad_ter, telefono_ter, (SELECT CONCAT (nombre_emp,' ',apellidop_emp,' ',apellidom_emp) AS gerente FROM empleados WHERE terminales.id_empleado = empleados.id_empleado) AS gerente FROM terminales";
$result = $conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="idtablaTerminales">
		<thead style="background-color: #17a2b8;color: white; font-weight: bold;">
			<tr>
				<td>Nombre</td>
				<td>Direcci&oacute;n</td>
				<td>Tel&eacute;fono</td>
				<td>Gerente</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($mostrar = $result->fetch_array(MYSQLI_NUM)) {
			?>
				<tr>
					<td><?php echo $mostrar[1] ?></td>
					<td><?php echo $mostrar[2] . ' ' . $mostrar[3] ?></td>
					<td><?php echo $mostrar[4] ?></td>
					<td><?php echo $mostrar[5] ?></td>
					<td style="text-align: center;">
						<span class="btn btn-sm btn-warning " data-toggle="modal" data-target="#modalEditarTer" onclick="agregaFrmEditarTerminal('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-pencil"></span>
						</span>
						<span class="btn btn-sm btn-outline-secondary " onclick="eliminarTerminal('<?php echo $mostrar[0] ?>')">
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