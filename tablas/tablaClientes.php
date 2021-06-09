<?php
require_once "../modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();

$sql = "SELECT nombre_cli, apellidop_cli, apellidom_cli, correo_electronico, usuario_cli FROM cliente";
$result = $conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="idtablaClientes">
		<thead style="background-color: #338FB6;color: white; font-weight: bold;">
			<tr>
				<td>Nombre</td>
				<td>Correo</td>
				<td>Usuario</td>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($mostrar = $result->fetch_array(MYSQLI_NUM)) {
			?>
				<tr>
					<td><?php echo $mostrar[0] . " " . $mostrar[1] . " " . $mostrar[2] ?></td>
					<td><?php echo $mostrar[3] ?></td>
					<td><?php echo $mostrar[4] ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#idtablaClientes').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			"pageLength": 5
		});
	});
</script>